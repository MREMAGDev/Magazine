<?php

    include('php/essentials.php');
    
    $datestamp = date('YmdHis');
    $filepath = "/home/robert/";
    $filename = "testpublish.csv";
    $archivefile = $filepath."archive/".$filename.$datestamp;
    $lockfile = $filepath."publisher.lock";
    $publish = 0;
    $link = "";
    $link_ok = FALSE;
    if (file_exists($lockfile)) {
        file_put_contents($lockfile,$datestamp." ERROR:- Pulisher lockfile from previous run found!\n");
        exit(1);
    } else {
        file_put_contents($lockfile,"Publication In progress! [".$datestamp."]\n");
    }
	if (($handle = fopen($filepath.$filename, "r")) == TRUE) {
    	while (($data = fgetcsv($handle, 1000, ",")) == TRUE) {
        	$num = count($data);
        	switch ($data[0]) {
        		case 'Issue':
        			$issue = intval($data[1]);
        			break;
	        	case 'Link':
                                $link = $data[1];
                                if(stristr($link,"https://issuu.com/drmepublishingltd/") !== FALSE) {
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
        	}                
     	}
    	fclose($handle);
	}
	// Debug
	if ($debug) {
	  print 'Issue '.$issue.' '.$link.' '.$publish."\n";
	}
	// Update Issue Header in DB here
        if ($link_ok == TRUE && $publish == 1) {
            $issue_query="SELECT issue FROM mag_issue WHERE issue-$issue";
            $result1=$dbcn->query($issue_query);
            $issue_loaded=$result1->num_rows;
            if($issue_loaded == 1) {
                $publish_update="UPDATE mag_issue SET link='$link', published=$publish WHERE issue=$issue";
                $result2=$dbcn->query($publish_update);
                $result2->free();
            } else {
                file_put_contents($lockfile,$datestamp." ERROR:- No magazine issue header record found for issue ".$issue."!\n");
                $result1->free();
                exit(1);
            }
        }
        $result1->free();
    if(copy($filepath.$filename, $archivefile)) {
        unlink($filepath.$filename);
        unlink($lockfile);
    } else {
        file_put_contents($lockfile,$datestamp." ERROR:- Unable to archive upoaded publication trigger file for issue ".$issue."!\n");
        exit(1);
    }
   exit(0);    
?>

