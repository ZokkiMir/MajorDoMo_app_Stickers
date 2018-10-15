<?php
/**
* Stikeri 
* @package project
* @author Wizard <sergejey@gmail.com>
* @copyright http://majordomo.smartliving.ru/ (c)
* @version 0.1 (wizard, 22:10:13 [Oct 15, 2018])
*/
//
//
class app_stikers extends module {
/**
* app_stikers
*
* Module class constructor
*
* @access private
*/
function __construct() {
  $this->name="app_stikers";
  $this->title="Stikeri";
  $this->module_category="<#LANG_SECTION_APPLICATIONS#>";
  $this->checkInstalled();
}
/**
* saveParams
*
* Saving module parameters
*
* @access public
*/
function saveParams($data=1) {
 $p=array();
 if (IsSet($this->id)) {
  $p["id"]=$this->id;
 }
 if (IsSet($this->view_mode)) {
  $p["view_mode"]=$this->view_mode;
 }
 if (IsSet($this->edit_mode)) {
  $p["edit_mode"]=$this->edit_mode;
 }
 if (IsSet($this->tab)) {
  $p["tab"]=$this->tab;
 }
 return parent::saveParams($p);
}
/**
* getParams
*
* Getting module parameters from query string
*
* @access public
*/
function getParams() {
  global $id;
  global $mode;
  global $view_mode;
  global $edit_mode;
  global $tab;
  if (isset($id)) {
   $this->id=$id;
  }
  if (isset($mode)) {
   $this->mode=$mode;
  }
  if (isset($view_mode)) {
   $this->view_mode=$view_mode;
  }
  if (isset($edit_mode)) {
   $this->edit_mode=$edit_mode;
  }
  if (isset($tab)) {
   $this->tab=$tab;
  }
}
/**
* Run
*
* Description
*
* @access public
*/
function run() {
 global $session;
  $out=array();
  if ($this->action=='admin') {
   $this->admin($out);
  } else {
   $this->usual($out);
  }
  if (IsSet($this->owner->action)) {
   $out['PARENT_ACTION']=$this->owner->action;
  }
  if (IsSet($this->owner->name)) {
   $out['PARENT_NAME']=$this->owner->name;
  }
  $out['VIEW_MODE']=$this->view_mode;
  $out['EDIT_MODE']=$this->edit_mode;
  $out['MODE']=$this->mode;
  $out['ACTION']=$this->action;
  $out['TAB']=$this->tab;
  $this->data=$out;
  $p=new parser(DIR_TEMPLATES.$this->name."/".$this->name.".html", $this->data, $this);
  $this->result=$p->result;
}
/**
* BackEnd
*
* Module backend
*
* @access public
*/
function admin(&$out) {
 if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
  $out['SET_DATASOURCE']=1;
 }
 if ($this->data_source=='app_stikers_data' || $this->data_source=='') {
  if ($this->view_mode=='' || $this->view_mode=='search_app_stikers_data') {
   $this->search_app_stikers_data($out);
  }
  if ($this->view_mode=='edit_app_stikers_data') {
   $this->edit_app_stikers_data($out, $this->id);
  }
  if ($this->view_mode=='delete_app_stikers_data') {
   $this->delete_app_stikers_data($this->id);
   $this->redirect("?");
  }
 }
}
/**
* FrontEnd
*
* Module frontend
*
* @access public
*/
function usual(&$out) {
 $this->admin($out);
}
/**
* app_stikers_data search
*
* @access public
*/
 function search_app_stikers_data(&$out) {
  require(DIR_MODULES.$this->name.'/app_stikers_data_search.inc.php');
 }
/**
* app_stikers_data edit/add
*
* @access public
*/
 function edit_app_stikers_data(&$out, $id) {
  require(DIR_MODULES.$this->name.'/app_stikers_data_edit.inc.php');
 }
/**
* app_stikers_data delete record
*
* @access public
*/
 function delete_app_stikers_data($id) {
  $rec=SQLSelectOne("SELECT * FROM app_stikers_data WHERE ID='$id'");
  // some action for related tables
  SQLExec("DELETE FROM app_stikers_data WHERE ID='".$rec['ID']."'");
 }
/**
* Install
*
* Module installation routine
*
* @access private
*/
 function install($data='') {
  parent::install();
 }
/**
* Uninstall
*
* Module uninstall routine
*
* @access public
*/
 function uninstall() {
  SQLExec('DROP TABLE IF EXISTS app_stikers_data');
  parent::uninstall();
 }
/**
* dbInstall
*
* Database installation routine
*
* @access private
*/
 function dbInstall($data) {
/*
app_stikers_data - 
*/
  $data = <<<EOD
 app_stikers_data: ID int(10) unsigned NOT NULL auto_increment
 app_stikers_data: TITLE varchar(100) NOT NULL DEFAULT ''
 app_stikers_data: NOTES varchar(255) NOT NULL DEFAULT ''
 app_stikers_data: LEFT varchar(255) NOT NULL DEFAULT ''
 app_stikers_data: TOP varchar(255) NOT NULL DEFAULT ''
 app_stikers_data: ZINDEX varchar(255) NOT NULL DEFAULT ''
 app_stikers_data: UPDATED datetime
EOD;
  parent::dbInstall($data);
 }
// --------------------------------------------------------------------
}
/*
*
* TW9kdWxlIGNyZWF0ZWQgT2N0IDE1LCAyMDE4IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
