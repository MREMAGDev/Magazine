<?php

    include('php/essentials.php');
    
    $datestamp = date('YmdHis');
    $filename = "test.csv";
    $archivefile = UPLOAD_PATH."archive/".$filename.$datestamp;
    $lockfile = UPLOAD_PATH."indexloader.lock";
    $debug = FALSE;
    $keywords = array();
    $month_str = array(
                'Invalid Month',
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December');
    $publish = 0;
    $link = "";
    $link_ok = FALSE;
    if (file_exists($lockfile)) {
        file_put_contents($lockfile,$datestamp." ERROR:- CSV Load aborted, lockfile from previous run found!\n");
        exit(1);
    } else {
        file_put_contents($lockfile,"CSV Load In progress! [".$datestamp."]\n");
    }
	if (($handle = fopen(UPLOAD_PATH.$filename, "r")) == TRUE) {
    	while (($data = fgetcsv($handle, 1000, ",")) == TRUE) {
        	$num = count($data);
        	switch ($data[0]) {
        		case 'Issue':
        			$issue = intval($data[1]);
        			break;
	        	case 'Month':
                                $month = $month_str[intval($data[1])];
        			break;
        		case 'Year':
        			$year = intval($data[1]);
        			break;
                        case 'Link':
                                $link = $data[1];
                                if(stristr($link,'https://issuu.com/drmepublishingltd/') !== FALSE) {
                                    $link_ok = TRUE;
                                } else {
                                    $link = "";
                                }
                                break;
                        case 'Publish':
                                if (strtoupper(substr($data[1],0,1)) == "Y") {
                                   $publish = 1;
                                }
                                break;
	        	default:
    	    		if (intval($data[0]) > 1) {
                            $page = intval($data[0]);
                            $author = $data[1];
                            $title = $data[2];
                            $index = 0;
                            for ($field=3; $field < $num; $field++) {
        			$keywords[$index] = $data[$field];
        			$index++;
                            }
                            // Debug 
                            if ($debug) {
        		 	print $issue.', '.$page.', '.$author.', '.$title."\n"; 	       
        			print_r($keywords);
                            }
                            $num_kwds = count($keywords);
                            $kwd_str = "";
                            $new_str = TRUE;
                            for ($kwd=0; $kwd < $num_kwds; $kwd++) {
        			if ($keywords[$kwd] != "") {
                                    if($new_str) {
        				$new_str = FALSE;
                                    } else {
                                        $kwd_str .= ",";
                                    }
        			}
        			$kwd_str .= $keywords[$kwd];
                            }
                            // Debug
                            if ($debug) {
        	            	print $kwd_str."\n";
                            }
	                    // Insert new index entry into DB here
                            $index_insert="INSERT INTO mag_search(issue, keywords, author, article, page, year) VALUES($issue, '$kwd_str', '$author', '$title', $page, $year)";
                            $result1=$dbcn->query($index_insert);
                            $result1->free();
                        }
        		break;
        	}                
     	}
    	fclose($handle);
	}
	// Debug
	if ($debug) {
	  print 'Issue '.$issue.' '.$month.' '.$year."\n";
	}
	// Insert new Issue Header into DB here
        if ($link_ok == FALSE) {
            $publish = 0;
        }
        $mag_title=$month." ".$year;
        $issue_insert="INSERT INTO mag_issue(issue, year, title, link, published) VALUES($issue, $year,' $mag_title', '$link', $publish)";
        $result2=$dbcn->query($issue_insert);
        $result2->free();
    if(copy(UPLOAD_PATH.$filename, $archivefile)) {
        unlink(UPLOAD_PATH.$filename);
        unlink($lockfile);
    } else {
        file_put_contents($lockfile,$datestamp." ERROR:- Unable to archive uploaded CSV File!\n");
        exit(1);
    }
   exit(0);
?>

