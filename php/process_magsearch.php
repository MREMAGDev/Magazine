<?php

  # Process authors
  # Process Selection List
  $all=0;
  $values = $_POST['authstr'];
  foreach ($values as $val)
  {
    if ($val == 0) {$all=1;}
    $auth_list.=$val.',';
  }
  # If not ALL drop the trailing comma, otherwise set to 0
  if($all == 1) {$auth_list=0;} else {$auth_list = substr($auth_list,0,-1);}


  # Process magazine Issue
  # Process Selection List
  $all=0;
  $values = $_POST['issuestr'];
  foreach ($values as $val)
  {
    if ($val == 0) {$all=1;}
    $issue_list.=$val.',';
  }
  # If not ALL drop the trailing comma, otherwise set to 0
  if($all == 1) {$issue_list=0;} else {$issue_list = substr($issue_list,0,-1);}


  # Build Query Elements
  # Build author query

  $conditions=0;

  if($auth_list == 0)
  { $authors=""; } else {
    $conditions++;
    $authors="author IN(";
    $auth_query = "SELECT author FROM authors WHERE id IN(".$auth_list.")";
    $auth_result = $dbcn->query($auth_query);
    if($auth_result->num_rows > 0)
    {
      while(list($author)=$auth_result->fetch_row())
      {
         $authors=$authors."'".$author."',";
      }
    }
    $auth_result->free();
    $authors=substr($authors,0,-1).")";
  }

  # Build Issue query
  if($issue_list == 0)
  { $issue_list=""; } else {
    $conditions++;
    if($auth_list <> 0) {$and = ' AND';} else {$and = "";}
    $issue_list=$and." issue IN(".$issue_list.")"; }

  # Sort WHERE clause
  if($conditions == 0) {$where = "";} else {$where = "WHERE ";}


  # Build Main Query
  $query = "SELECT issue, author, article, page FROM mag_search ".$where.$authors.$issue_list." ORDER BY issue, page";


  # Show Advers & Search Results
  include('php/build_ad_array.php');

  echo '<div class="wrapper style2">';
  echo '<section class="container">';
  echo '<div class="row double">';
  echo '<div class="11u">';

  echo '<table>';
  echo '<tr><td valign="top">';

  # Process Adverts
  include('php/display_ads.php');

  echo '</td><td>'.$pad.$pad.'</td><td valign="top">';

  echo '<header class="major">';
  echo '<h2><center>Magazine Search Results</center></h2>';
  echo '<span class="byline">contents</span>';
  echo '</header>';

  # Process Search Results
  $search_result = $dbcn->query($query);
  $result_count = $search_result->num_rows;
  if($result_count == 0)
  {
    if($authors == 0) {$authors="ALL";}
    if($issue_list == 0) {$issue_list="ALL";}
    echo "No Articles were found by this search. Your search parameters were:</br>";
    echo "Authors : ".$authors."</br>";
    echo "Issues : ".$issue_list."</br>";
    echo "Please try again with different selections.";
  } else {
    $last_issue = 0;
    $first_set = 0;
    while(list($issue, $author, $article, $page_no) = $search_result->fetch_row())
    {
      if($issue <> $last_issue)
      {
        # Get Issue Header Details
        $issue_query = "SELECT title, link FROM mag_issue WHERE issue = ".$issue;
        $issue_result = $dbcn->query($issue_query);
        if($issue_result->num_rows > 0)
        {
          while(list($title, $link) = $issue_result->fetch_row())
          {
            if($first_set <> 0) {echo '</table>';}
            $first_set++;
            echo '<p><h2>Issue '.trim($issue).' '.trim($title).'</h2></p>';
            echo '<table>';
          }
        }
        # Finish with issue header
        $issue_result->free();
      }
      $last_issue = $issue;
      echo '<tr><td>Page '.trim($page_no).$pad.'</td><td>'.trim($author).$pad.'</td><td>'.trim($article).'</td></tr>';
    }
    # Finish with search results
    $search_result->free();
    echo '</table>';
  }

  echo '</td></tr><tr><td>'.$pad.'</td><td>'.$pad.'</td></tr>';
  echo '</table>';

  echo '</div>';
  echo '</div>';
  echo '</div>';

?>