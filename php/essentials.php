<?php

# Get name of page currently being served
$page = substr(strrchr($_SERVER['PHP_SELF'],'/'),1,-4);

# Useful variables
$pad = '&nbsp;&nbsp;';

# Includes
require_once("php/dcon.php");

# System Parameters - Global
$sp_query = "SELECT s.id as 'sysparam_id',s.sysparam_str, s.sysparam_num, s.global_name FROM sysparam s";
$sp_result = $dbcn->query($sp_query);
while(list($sysparam_id,$sysparam_str,$sysparam_num,$global_name) = $sp_result->fetch_row())
{ 
  if($sysparam_id == 6 || $sysparam_id == 7)
      {define($global_name,$sysparam_num);} 
  else 
      {define($global_name,$sysparam_str);} 
}
$sp_result->free();

# Ststic Text - Global
$st_query = " SELECT st.text_str, st.global_name FROM static_text st";
$st_result = $dbcn->query($st_query);
while(list($text_str,$global_text_name) = $st_result->fetch_row())
{define($global_text_name,$text_str);}
$st_result->free();

# FUNCTIONS

# Get data om latest published magazine issue
function fn_Get_Latest_Issue($gli_type,$dbcn)
{
   $gli_query = "SELECT mi.id, mi.issue, mi.year, mi.title, mi.link FROM mag_issue mi WHERE mi.published=1 ORDER BY mi.issue DESC LIMIT 1";
   $gli_result = $dbcn->query($gli_query);
    while(list($mi_id,$mi_issue,$mi_year,$mi_title,$mi_link) = $gli_result->fetch_row())
    {
      $gli_recid = $mi_id;
      $gli_issue = $mi_issue;
      $gli_year = $mi_year;
      $gli_title = $mi_title;
      $gli_link = $mi_link;
    }
    $gli_result->free();
    switch($gli_type)
    {
      case "id":
        return $gli_recid;
        break;
      case "issue":
        return $gli_issue;
        break;
      case "link":
        return $gli_link;
        break;
      case "title":
        return $gli_title;
        break;
      case "url":
        return $gli_link;
        break;
      case "year":
        return $gli_year;
        break;
      default:
        return "Error";
        break;
    }
}

?>
