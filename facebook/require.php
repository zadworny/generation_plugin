<?php
if (isset($_POST['activate'])=='License this website') {
	$secretid=$_POST['secretid'];
    $wpdb->update($table_name_general, array('Myemail'=>trim($secretid)),array('id'=>'1'));
}
global $wpdb;
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$mykey = $wpdb->get_var('SELECT Myemail FROM '.$table_name_general.' WHERE id=1');

$myurl = get_home_url();
$secretcode = secretencode($myurl);
if ($mykey!=$secretcode) {$runit='negative';} else {$runit='positive';}
if (!defined('facebookrequire')) define('facebookrequire', $runit);

if (isset($_POST['activate'])=='License this website' && $mykey!=$secretcode) {
   	$redmsg='Actqvxtqon.code.you.provqded.qs.qncorrect,.plexse.try.xgxqn';
	//$redmsg.=' '.$secretcode.' '.$secretid.' : '.$mykey;
    $redmsg=str_replace('x','a',$redmsg); $redmsg=str_replace('q','i',$redmsg); $redmsg=str_replace('.',' ',$redmsg);
	$secretid_msg='<p style="color:red">'.$redmsg.'.</p>';
}
?>
