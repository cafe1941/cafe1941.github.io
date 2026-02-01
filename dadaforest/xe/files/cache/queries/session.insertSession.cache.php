<?php if(!defined('__ZBXE__')) exit();
$output->query_id = "session.insertSession";
$output->action = "insert";
$output->column_type["session_key"] = "varchar";
$output->column_type["member_srl"] = "number";
$output->column_type["expired"] = "date";
$output->column_type["val"] = "bigtext";
$output->column_type["ipaddress"] = "varchar";
$output->column_type["last_update"] = "date";
$output->column_type["cur_mid"] = "varchar";
$output->tables = array( "session"=>"session", );
$output->_tables = array( "session"=>"session", );
$output->columns = array ( array("name"=>"session_key","alias"=>"","value"=>$args->session_key),
array("name"=>"member_srl","alias"=>"","value"=>$args->member_srl?$args->member_srl:"0"),
array("name"=>"expired","alias"=>"","value"=>$args->expired),
array("name"=>"val","alias"=>"","value"=>$args->val),
array("name"=>"ipaddress","alias"=>"","value"=>$_SERVER['REMOTE_ADDR']),
array("name"=>"last_update","alias"=>"","value"=>date("YmdHis")),
array("name"=>"cur_mid","alias"=>"","value"=>$args->cur_mid),
 );
return $output; ?>