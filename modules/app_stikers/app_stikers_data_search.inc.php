<?php
/*
* @version 0.1 (wizard)
*/
 global $session;
  if ($this->owner->name=='panel') {
   $out['CONTROLPANEL']=1;
  }
  $qry="1";
  // search filters
  // QUERY READY
  global $save_qry;
  if ($save_qry) {
   $qry=$session->data['app_stikers_data_qry'];
  } else {
   $session->data['app_stikers_data_qry']=$qry;
  }
  if (!$qry) $qry="1";
  $sortby_app_stikers_data="ID DESC";
  $out['SORTBY']=$sortby_app_stikers_data;
  // SEARCH RESULTS
  $res=SQLSelect("SELECT * FROM app_stikers_data WHERE $qry ORDER BY ".$sortby_app_stikers_data);
  if ($res[0]['ID']) {
   //paging($res, 100, $out); // search result paging
   $total=count($res);
   for($i=0;$i<$total;$i++) {
    // some action for every record if required
   }
   $out['RESULT']=$res;
  }
