<?php
if(!$_POST) exit;

$xx = 'xx';
$from = $_POST['email'];
$to = $_POST['recipient'];
$subject = $_POST['subject'];
$x1 = $_POST['name'];
$x2 = $_POST['surname'];
$x3 = $_POST['phone'];
$x4 = $_POST['message'];
$n1 = $_POST['not1'];
$n2 = $_POST['not2'];
$n3 = $_POST['not3'];
if ($n1=="") {$n1="Please fill out mandatory fields!";}
if ($n2=="") {$n2="Sending failed, please try again in a moment.";}
if ($n3=="") {$n3="Message sent successfully, we will contact you in next 24 hours.";}
//defaults
$deffrom = $_POST['defemail'];
$defsubject = $_POST['defsubject'];
$defx1 = $_POST['defname'];
$defx2 = $_POST['defsurname'];
$defx3 = $_POST['defphone'];
$defx4 = $_POST['defmessage'];

if ($subject=='' || $subject==$defsubject) {$subject="Message from your blog";}
if ($from=='' || $from==$deffrom) {$from='';}
if ($x1!='' && $x1!=$defx1) {$x1=$x1.'
';} else {$x1='';}
if ($x2!='' && $x2!=$defx2) {$x2=$x2.'
';} else {$x2='';}
if ($x3!='' && $x3!=$defx3) {$x3=$x3.'
';} else {$x3='';}
if ($x4!='' && $x4!=$defx4) {$x4='
'.$x4.'
';} else {$x4='';}

$content=$x1.$x2.$x3.$x4;
$content=trim(str_replace("<br/>","
",$content));
$content=trim(str_replace("<br>","
",$content));

/* developers: uncomment (remove '//' before '$' sign) to make particular field mandatory */
if (//$subject=='' || /*subject*/
	$from=='' || /*email*/
    $x1=='' || /*name*/
    //$x2=='' || /*surname*/
    //$x3=='' || /*phone*/
    $x4=='' || /*message*/
	$xx!='xx' /*dummy, do not edit*/
	) {
    $warning = "<p style='text-align:center; margin:0 auto; color:red; line-height:140%; font-size:13px'>";
		$warning .= $n1;
	$warning .= "</p>";
} elseif (mail($to,$subject,$content,"From: ".$from."
")) {
    $sent = "<p style='text-align:center; margin:0 auto; color:green; line-height:140%; font-size:13px' id='gpsuccesssent'>";
    	$sent .= $n3;
    $sent .= "</p>";
} else {
    $warning = "<p style='text-align:center; margin:0 auto; color:red; line-height:140%; font-size:13px'>";
		$warning .= $n2;
	$warning .= "</p>";
}

if (isset($warning)) {
	echo '<div style="position:absolute; bottom:34px; width:432px; padding:15px; border:none; background-color:#FDD; border-radius:5px; margin:-20px 8px 0 0" class="gpwarning">';
		echo $warning;
	echo '</div>';
} elseif (isset($sent)) {
	echo '<div style="width:432px; padding:15px; border:none; background-color:#DFD; border-radius:5px; margin:0 8px 35px 0">';
		echo $sent;
	echo '</div>';
}
?>