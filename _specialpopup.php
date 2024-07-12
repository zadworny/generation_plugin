<div id="tab7" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_reg" enctype="multipart/form-data">


<?php
if (isset($_POST['displayingformsent_reg'])=='Save Changes') {

	//multiple values into one database cell
	if ($_POST['Reg_headclr_c']=="on") {$Reg_headclr=$_POST['Reg_headclr'];}
	elseif ($_POST['Reg_form']=="social") {$Reg_headclr="0d66ae";}
	elseif ($_POST['Reg_btnclr']=="stripe_darkred" || $_POST['Reg_btnclr']=="simple_darkred") {$Reg_headclr="a92e20";}
	elseif ($_POST['Reg_btnclr']=="stripe_red" || $_POST['Reg_btnclr']=="simple_red") {$Reg_headclr="d53929";}
	elseif ($_POST['Reg_btnclr']=="stripe_magenta" || $_POST['Reg_btnclr']=="simple_magenta") {$Reg_headclr="c73272";}
	elseif ($_POST['Reg_btnclr']=="stripe_violetmagenta" || $_POST['Reg_btnclr']=="simple_violetmagenta") {$Reg_headclr="b940b3";}
	elseif ($_POST['Reg_btnclr']=="stripe_violet" || $_POST['Reg_btnclr']=="simple_violet") {$Reg_headclr="6c4ab2";}
	elseif ($_POST['Reg_btnclr']=="stripe_blueviolet" || $_POST['Reg_btnclr']=="simple_blueviolet") {$Reg_headclr="4442ad";}
	elseif ($_POST['Reg_btnclr']=="stripe_navyblue" || $_POST['Reg_btnclr']=="simple_navyblue") {$Reg_headclr="286c9e";}
	elseif ($_POST['Reg_btnclr']=="stripe_darkblue" || $_POST['Reg_btnclr']=="simple_darkblue") {$Reg_headclr="387dab";}
	elseif ($_POST['Reg_btnclr']=="stripe_blue" || $_POST['Reg_btnclr']=="simple_blue") {$Reg_headclr="299eb9";}
	elseif ($_POST['Reg_btnclr']=="stripe_turquoise" || $_POST['Reg_btnclr']=="simple_turquoise") {$Reg_headclr="38b5af";}
	elseif ($_POST['Reg_btnclr']=="stripe_greenturquoise" || $_POST['Reg_btnclr']=="simple_greenturquoise") {$Reg_headclr="2cc183";}
	elseif ($_POST['Reg_btnclr']=="stripe_darkgreen" || $_POST['Reg_btnclr']=="simple_darkgreen") {$Reg_headclr="5ca138";}
	elseif ($_POST['Reg_btnclr']=="stripe_green" || $_POST['Reg_btnclr']=="simple_green") {$Reg_headclr="93b73f";}
	elseif ($_POST['Reg_btnclr']=="stripe_lemon" || $_POST['Reg_btnclr']=="simple_lemon") {$Reg_headclr="d6ce28";}
	elseif ($_POST['Reg_btnclr']=="stripe_yellow" || $_POST['Reg_btnclr']=="simple_yellow") {$Reg_headclr="d1bd26";}
	elseif ($_POST['Reg_btnclr']=="stripe_orange" || $_POST['Reg_btnclr']=="simple_orange") {$Reg_headclr="e68f1b";}
	else {$Reg_headclr="CC3300";}
	$Reg_head = "#".trim($Reg_headclr."|".$_POST['Reg_headtxt']."|".$_POST['Reg_headclr_c'], "#");
	$Reg_regular = $_POST['Reg_name']."|".$_POST['Reg_email']."|".$_POST['Reg_btntxt']."|".$_POST['Reg_btnclr'];
	$Reg_social = "facebook";
	$Reg_background = $_POST['Reg_bg']."|".$_POST['Reg_screencolor']."|".$_POST['Reg_screenopacity'];

	//image upload
	$Reg_file = $_FILES['Reg_file']['name'];
	$Reg_fileremove = $_POST['Reg_fileremove'];
	if ($Reg_fileremove=='on') {$Reg_file='';}
    $Reg_path = GenerationPlugin_uploads.basename($Reg_file);
    if (move_uploaded_file($_FILES['Reg_file']['tmp_name'], $Reg_path)) {
        $Reg_array = explode('.',$Reg_file);
        $Reg_exten = $Reg_array[count($Reg_array)-1];
    	if (isset($_POST['Savepreview_reg'])) {
			$Reg_image = GenerationPlugin_uploads.'Reg_image.'.$Reg_exten;
			$Reg_image_db = GenerationPlugin_uploads_db.'Reg_image.'.$Reg_exten;
        	rename($Reg_path, $Reg_image);
		}
        $Reg_image_preview = GenerationPlugin_uploads.'Reg_image_preview.'.$Reg_exten;
        $Reg_image_preview_db = GenerationPlugin_uploads_db.'Reg_image_preview.'.$Reg_exten;
		if ($Reg_image!='') { copy($Reg_image, $Reg_image_preview); }
        rename($Reg_path, $Reg_image_preview);
    } else {
        $Reg_image = $wpdb->get_var('SELECT Image FROM '.$table_name_register.' WHERE id='.$Duniqueid);
        $Reg_image_preview = $Reg_image_preview_db = $Reg_image_db = $Reg_image;
    }
	if (isset($_POST['Savepreview_reg'])) {
   		if ($Reg_fileremove=='on') {$Reg_image=''; $Reg_image_db='';}
	}
	if ($Reg_fileremove=='on') {$Reg_image_preview=''; $Reg_image_preview_db='';}
	
	//background upload
	$Reg_bgfile = $_FILES['Reg_bg']['name'];
	$Reg_bgfileremove = $_POST['Reg_bgremove'];
	if ($Reg_bgfileremove=='on') {$Reg_bgfile='';}
    $Reg_bgpath = GenerationPlugin_uploads.basename($Reg_bgfile);
    if (move_uploaded_file($_FILES['Reg_bg']['tmp_name'], $Reg_bgpath)) {
        $Reg_bgarray = explode('.',$Reg_bgfile);
        $Reg_bgexten = $Reg_bgarray[count($Reg_bgarray)-1];
    	if (isset($_POST['Savepreview_reg'])) {
			$Reg_bgimage = GenerationPlugin_uploads.'Reg_bgimage.'.$Reg_bgexten;
			$Reg_bgimage_db = GenerationPlugin_uploads_db.'Reg_bgimage.'.$Reg_bgexten;
        	rename($Reg_bgpath, $Reg_bgimage);
		}
        $Reg_bgimage_preview = GenerationPlugin_uploads.'Reg_bgimage_preview.'.$Reg_bgexten;
        $Reg_bgimage_preview_db = GenerationPlugin_uploads_db.'Reg_bgimage_preview.'.$Reg_bgexten;
		if ($Reg_bgimage!='') { copy($Reg_bgimage, $Reg_bgimage_preview); }
        rename($Reg_bgpath, $Reg_bgimage_preview);
    } else {
        $Reg_bgimage = $wpdb->get_var('SELECT Bgimage FROM '.$table_name_register.' WHERE id='.$Duniqueid);
        $Reg_bgimage_preview = $Reg_bgimage_preview_db = $Reg_bgimage_db = $Reg_bgimage;
    }
	if (isset($_POST['Savepreview_reg'])) {
   		if ($Reg_bgfileremove=='on') {$Reg_bgimage=''; $Reg_bgimage_db='';}
	}
	if ($Reg_bgfileremove=='on') {$Reg_bgimage_preview=''; $Reg_bgimage_preview_db='';}

	//custom content image upload
	$Reg_cbgfile = $_FILES['Reg_cbg']['name'];
	$Reg_cbgfileremove = $_POST['Reg_cbgremove'];
	if ($Reg_cbgfileremove=='on') {$Reg_cbgfile='';}
    $Reg_cbgpath = GenerationPlugin_uploads.basename($Reg_cbgfile);
    if (move_uploaded_file($_FILES['Reg_cbg']['tmp_name'], $Reg_cbgpath)) {
        $Reg_cbgarray = explode('.',$Reg_cbgfile);
        $Reg_cbgexten = $Reg_cbgarray[count($Reg_cbgarray)-1];
		if (isset($_POST['Savepreview_reg'])) {
			$Reg_cbgimage = GenerationPlugin_uploads.'Reg_cbgimage.'.$Reg_cbgexten;
			$Reg_cbgimage_db = GenerationPlugin_uploads_db.'Reg_cbgimage.'.$Reg_cbgexten;
        	rename($Reg_cbgpath, $Reg_cbgimage);
		}
        $Reg_cbgimage_preview = GenerationPlugin_uploads.'Reg_cbgimage_preview.'.$Reg_cbgexten;
        $Reg_cbgimage_preview_db = GenerationPlugin_uploads_db.'Reg_cbgimage_preview.'.$Reg_cbgexten;
		if ($Reg_cbgimage!='') { copy($Reg_cbgimage, $Reg_cbgimage_preview); }
        rename($Reg_cbgpath, $Reg_cbgimage_preview);
    } else {
        $Reg_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_register.' WHERE id='.$Duniqueid));
    	$Reg_form_tmp = preg_replace("/\\\/","",$Reg_form);
        $Reg_formx = explode("|", $Reg_form_tmp);
    	$Reg_cbgimage = $Reg_formx[5];
        $Reg_cbgimage_preview = $Reg_cbgimage_preview_db = $Reg_cbgimage_db = $Reg_cbgimage;
    }
	if (isset($_POST['Savepreview_reg'])) {
   		if ($Reg_cbgfileremove=='on') {$Reg_cbgimage=''; $Reg_cbgimage_db='';}
	}
	if ($Reg_cbgfileremove=='on') {$Reg_cbgimage_preview=''; $Reg_cbgimage_preview_db='';}
	
	$Reg_form = $_POST['Reg_form']."|".$_POST['Reg_ccontent']."|".$_POST['Reg_clink']."|".$_POST['Reg_cclick1']."|".$_POST['Reg_cblank']."|".$Reg_cbgimage_db."|".$_POST['Reg_cclick2']."|".$_POST['Reg_cwidth']."|".$_POST['Reg_cheight']."|".$_POST['Reg_cscroll']."|".$_POST['Reg_surname']."|".$_POST['Reg_phone']."|".$_POST['Reg_subject']."|".$_POST['Reg_message']."|".$_POST['Reg_recipient']."|".$_POST['Reg_not1']."|".$_POST['Reg_not2']."|".$_POST['Reg_not3'];
	$Reg_form_preview = $_POST['Reg_form']."|".$_POST['Reg_ccontent']."|".$_POST['Reg_clink']."|".$_POST['Reg_cclick1']."|".$_POST['Reg_cblank']."|".$Reg_cbgimage_preview_db."|".$_POST['Reg_cclick2']."|".$_POST['Reg_cwidth']."|".$_POST['Reg_cheight']."|".$_POST['Reg_cscroll']."|".$_POST['Reg_surname']."|".$_POST['Reg_phone']."|".$_POST['Reg_subject']."|".$_POST['Reg_message'];
	$Reg_startdate = $_POST['Reg_dstart'];
	if ($_POST['Reg_ddays']=="") { $Reg_days = ""; }
	elseif ($Reg_startdate!="") { $Reg_days = date("Y-m-d", strtotime($Reg_startdate." + ".$_POST['Reg_ddays']." days")); }
	else { $Reg_days = date("Y-m-d", strtotime(" + ".$_POST['Reg_ddays']." days")); }
	$Reg_display = implode(',',$_POST['Reg_pagelist']).'|'.implode(',',$_POST['Reg_catlist']).'|'.implode(',',$_POST['Reg_postlist']).'|'.$_POST['Reg_showsub'].'|'.$_POST['Reg_ddelay'].'|'.$Reg_days.'|'.$_POST['Reg_dstart'].'|'.$_POST['Reg_dstop'];
	$Reg_sky = $_POST['Reg_skytitle'].'|'.$_POST['Reg_skyheader'].'|'.$_POST['Reg_skydescription'].'|'.$_POST['Reg_skylink'].'|'.$_POST['Reg_skytarget'];

	//replace \n with html br before save to database
	$Reg_head=str_replace(array("\r\n", "\r", "\n"), '<br>', $Reg_head);
	$Reg_headdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Reg_headdes']);
	
	//save to database
	if (isset($_POST['Savepreview_reg'])) {
    $wpdb->update($table_name_register,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Reg_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Reg_link'])),
    		  'Image'=>mysql_real_escape_string(trim($Reg_image_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Reg_bgimage_db)),
    		  'Background'=>mysql_real_escape_string(trim($Reg_background)),
    		  'Title'=>mysql_real_escape_string(trim($Reg_head)),
    		  'Text'=>mysql_real_escape_string(trim($Reg_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Reg_form)),
    		  'Regular'=>mysql_real_escape_string(trim($Reg_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Reg_social)),
    		  'Sky'=>mysql_real_escape_string(trim($Reg_sky)),
    		  'Openlink'=>mysql_real_escape_string(trim($_POST['Reg_openlink'])),
    		  'Optincode'=>mysql_real_escape_string(trim($_POST['Reg_optin'])),
			  'Active'=>mysql_real_escape_string(trim($_POST['Reg_active'])),
			  'Display'=>mysql_real_escape_string(trim($Reg_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_register,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Reg_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Reg_link'])),
    		  'Image'=>mysql_real_escape_string(trim($Reg_image_preview_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Reg_bgimage_preview_db)),
    		  'Background'=>mysql_real_escape_string(trim($Reg_background)),
    		  'Title'=>mysql_real_escape_string(trim($Reg_head)),
    		  'Text'=>mysql_real_escape_string(trim($Reg_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Reg_form_preview)),
    		  'Regular'=>mysql_real_escape_string(trim($Reg_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Reg_social)),
    		  'Sky'=>mysql_real_escape_string(trim($Reg_sky)),
    		  'Openlink'=>mysql_real_escape_string(trim($_POST['Reg_openlink'])),
    		  'Optincode'=>mysql_real_escape_string(trim($_POST['Reg_optin'])),
			  'Active'=>mysql_real_escape_string(trim($_POST['Reg_active'])),
			  'Display'=>mysql_real_escape_string(trim($Reg_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DReg_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_theme = preg_replace("/\\\/","",$DReg_theme);
$DReg_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_link = preg_replace("/\\\/","",$DReg_link);
$DReg_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_image = preg_replace("/\\\/","",$DReg_image);
$DReg_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_bgimage = preg_replace("/\\\/","",$DReg_bgimage);
if ($DReg_image!="") {$DReg_image_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
if ($DReg_bgimage!="") {$DReg_bgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}

if ($DReg_theme=='reg1') {
	$Dreg1_sel='selected'; $Dreg_view='<img id="reg1img" src="'.GenerationPlugin_preview.'/regD1.gif">';
	$Reg_bg1_name = 'name="Reg_bg"';
	$Reg_bg2_name = 'name=""';
	$DReg_selectBgs1 = 'style="display:inline"';
	$DReg_selectBgs2 = 'style="display:none"';
	$DReg_defmessage = 'style="display:none"';
	$DReg_uploadimage = 'style="display:inline"';
	$DReg_formshow = 'style="display:inline"';
	$Dreg_adsection5='style="display:none"';
	$Dreg_skyshowdelay = 'style="display:none"';
}
elseif ($DReg_theme=='reg2') {
	$Dreg2_sel='selected'; $Dreg_view='<img id="reg1img" src="'.GenerationPlugin_preview.'/regD2.gif">';
	$Reg_bg1_name = 'name="Reg_bg"';
	$Reg_bg2_name = 'name=""';
	$DReg_selectBgs1 = 'style="display:inline"';
	$DReg_selectBgs2 = 'style="display:none"';
	$DReg_defmessage = 'style="display:inline"';
	$DReg_uploadimage = 'style="display:none"';
	$DReg_formshow = 'style="display:none"';
	$Dreg_adsection5='style="display:none"';
	$Dreg_skyshowdelay = 'style="display:none"';
}
elseif ($DReg_theme=='reg3') {
	$Dreg3_sel='selected'; $Dreg_view='<img id="reg1img" src="'.GenerationPlugin_preview.'/regD3.gif">';
	$Reg_bg1_name = 'name="Reg_bg"';
	$Reg_bg2_name = 'name=""';
	$DReg_selectBgs1 = 'style="display:none"';
	$DReg_selectBgs2 = 'style="display:none"';
	$DReg_defmessage = 'style="display:none"';
	$DReg_uploadimage = 'style="display:none"';
	$DReg_formshow = 'style="display:none"';
	$Dregf1_view = 'style="display:none"';
	$Dregf4_view = 'style="display:none"';
	$Dregf5_view = 'style="display:none"';
	$Dreg_adsection = 'style="display:none"';
	$Dreg_adsection1 = 'style="display:none"';
	$Dreg_adsection2 = 'style="display:none"';
	$Dreg_adsection3 = 'style="display:none"';
	$Dreg_adsection4 = 'style="display:none"';
	$Dreg_adsection5 = 'style="display:block"';
	$Dreg_skytitleshow = 'style="display:none"';
	$Dreg_preview1 = 'style="display:block"'; 
	$Dreg_preview2 = 'style="display:none"';
	$Dreg_skyshowdelay = 'style="display:block"';
}
elseif ($DReg_theme=='reg11') {
	$Dreg11_sel='selected'; $Dreg_view='<img id="reg1img" src="'.GenerationPlugin_preview.'/regL1.gif">';
	$Reg_bg1_name = 'name=""';
	$Reg_bg2_name = 'name="Reg_bg"';
	$DReg_selectBgs1 = 'style="display:none"';
	$DReg_selectBgs2 = 'style="display:inline"';
	$DReg_defmessage = 'style="display:none"';
	$DReg_uploadimage = 'style="display:inline"';
	$DReg_formshow = 'style="display:inline"';
	$Dreg_adsection5='style="display:none"';
	$Dreg_skyshowdelay = 'style="display:none"';
}
elseif ($DReg_theme=='reg12') {
	$Dreg12_sel='selected'; $Dreg_view='<img id="reg1img" src="'.GenerationPlugin_preview.'/regL2.gif">';
	$Reg_bg1_name = 'name=""';
	$Reg_bg2_name = 'name="Reg_bg"';
	$DReg_selectBgs1 = 'style="display:none"';
	$DReg_selectBgs2 = 'style="display:inline"';
	$DReg_defmessage = 'style="display:inline"';
	$DReg_uploadimage = 'style="display:none"';
	$DReg_formshow = 'style="display:none"';
	$Dreg_adsection5='style="display:none"';
	$Dreg_skyshowdelay = 'style="display:none"';
}
elseif ($DReg_theme=='reg13') {
	$Dreg13_sel='selected'; $Dreg_view='<img id="reg1img" src="'.GenerationPlugin_preview.'/regL3.gif">';
	$Reg_bg1_name = 'name=""';
	$Reg_bg2_name = 'name="Reg_bg"';
	$DReg_selectBgs1 = 'style="display:none"';
	$DReg_selectBgs2 = 'style="display:none"';
	$DReg_defmessage = 'style="display:none"';
	$DReg_uploadimage = 'style="display:none"';
	$DReg_formshow = 'style="display:none"';
	$Dregf1_view = 'style="display:none"';
	$Dregf4_view = 'style="display:none"';
	$Dregf5_view = 'style="display:none"';
	$Dreg_adsection = 'style="display:none"';
	$Dreg_adsection1 = 'style="display:none"';
	$Dreg_adsection2 = 'style="display:none"';
	$Dreg_adsection3 = 'style="display:none"';
	$Dreg_adsection4 = 'style="display:none"';
	$Dreg_adsection5 = 'style="display:block"';
	$Dreg_skytitleshow = 'style="display:block"';
	$Dreg_preview1 = 'style="display:block"'; 
	$Dreg_preview2 = 'style="display:none"';
	$Dreg_skyshowdelay = 'style="display:block"';
}
else {
	$Dreg1_sel='selected'; $Dreg_view='<img id="reg1img" src="'.GenerationPlugin_preview.'/regD1.gif">';
	$Reg_bg1_name = 'name="Reg_bg"';
	$Reg_bg2_name = 'name=""';
	$DReg_selectBgs1 = 'style="display:inline"';
	$DReg_selectBgs2 = 'style="display:none"';
	$DReg_defmessage = 'style="display:none"';
	$DReg_uploadimage = 'style="display:inline"';
	$DReg_formshow = 'style="display:inline"';
	$Dreg_adsection5='style="display:none"';
	$Dreg_skyshowdelay = 'style="display:none"';
}

$DReg_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_btncolor = preg_replace("/\\\/","",$DReg_btncolor);
$DReg_btncolor = explode("|", $DReg_btncolor);
$DReg_btncolor = $DReg_btncolor[3];
if ($DReg_btncolor=='stripe_darkred') {$DregB1_sel='selected';} //stripe design
elseif ($DReg_btncolor=='stripe_red') {$DregB2_sel='selected';}
elseif ($DReg_btncolor=='stripe_magenta') {$DregB3_sel='selected';}
elseif ($DReg_btncolor=='stripe_violetmagenta') {$DregB4_sel='selected';}
elseif ($DReg_btncolor=='stripe_violet') {$DregB5_sel='selected';}
elseif ($DReg_btncolor=='stripe_blueviolet') {$DregB6_sel='selected';}
elseif ($DReg_btncolor=='stripe_navyblue') {$DregB7_sel='selected';}
elseif ($DReg_btncolor=='stripe_darkblue') {$DregB8_sel='selected';}
elseif ($DReg_btncolor=='stripe_blue') {$DregB9_sel='selected';}
elseif ($DReg_btncolor=='stripe_turquoise') {$DregB10_sel='selected';}
elseif ($DReg_btncolor=='stripe_greenturquoise') {$DregB11_sel='selected';}
elseif ($DReg_btncolor=='stripe_darkgreen') {$DregB12_sel='selected';}
elseif ($DReg_btncolor=='stripe_green') {$DregB13_sel='selected';}
elseif ($DReg_btncolor=='stripe_lemon') {$DregB14_sel='selected';}
elseif ($DReg_btncolor=='stripe_yellow') {$DregB15_sel='selected';}
elseif ($DReg_btncolor=='stripe_orange') {$DregB16_sel='selected';}
elseif ($DReg_btncolor=='simple_darkred') {$DregB21_sel='selected';} //simple design
elseif ($DReg_btncolor=='simple_red') {$DregB22_sel='selected';}
elseif ($DReg_btncolor=='simple_magenta') {$DregB23_sel='selected';}
elseif ($DReg_btncolor=='simple_violetmagenta') {$DregB24_sel='selected';}
elseif ($DReg_btncolor=='simple_violet') {$DregB25_sel='selected';}
elseif ($DReg_btncolor=='simple_blueviolet') {$DregB26_sel='selected';}
elseif ($DReg_btncolor=='simple_navyblue') {$DregB27_sel='selected';}
elseif ($DReg_btncolor=='simple_darkblue') {$DregB28_sel='selected';}
elseif ($DReg_btncolor=='simple_blue') {$DregB29_sel='selected';}
elseif ($DReg_btncolor=='simple_turquoise') {$DregB30_sel='selected';}
elseif ($DReg_btncolor=='simple_greenturquoise') {$DregB31_sel='selected';}
elseif ($DReg_btncolor=='simple_darkgreen') {$DregB32_sel='selected';}
elseif ($DReg_btncolor=='simple_green') {$DregB33_sel='selected';}
elseif ($DReg_btncolor=='simple_lemon') {$DregB34_sel='selected';}
elseif ($DReg_btncolor=='simple_yellow') {$DregB35_sel='selected';}
elseif ($DReg_btncolor=='simple_orange') {$DregB36_sel='selected';}

$DReg_backgrounds = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_backgrounds = preg_replace("/\\\/","",$DReg_backgrounds);
$DReg_backgrounds = explode("|", $DReg_backgrounds);
$DReg_background = $DReg_backgrounds[0];
if ($DReg_background=='bg2') {$DregBackground2_sel='selected';}
elseif ($DReg_background=='bg3') {$DregBackground3_sel='selected';}
elseif ($DReg_background=='bg4') {$DregBackground4_sel='selected';}
elseif ($DReg_background=='bg12') {$DregBackground12_sel='selected';}
elseif ($DReg_background=='bg13') {$DregBackground13_sel='selected';}
elseif ($DReg_background=='bg14') {$DregBackground14_sel='selected';}

$DReg_screencolor = $DReg_backgrounds[1];
if ($DReg_screencolor=='#FFF') {$DregScreencolor1_sel='selected';}
elseif ($DReg_screencolor=='#999') {$DregScreencolor2_sel='selected';}
elseif ($DReg_screencolor=='#000') {$DregScreencolor3_sel='selected';}
$DReg_screenopacity = $DReg_backgrounds[2];
if ($DReg_screenopacity=='0') {$DregScreenopacity0_sel='selected';}
elseif ($DReg_screenopacity=='0.1') {$DregScreenopacity1_sel='selected';}
elseif ($DReg_screenopacity=='0.2') {$DregScreenopacity2_sel='selected';}
elseif ($DReg_screenopacity=='0.3') {$DregScreenopacity3_sel='selected';}
elseif ($DReg_screenopacity=='0.4') {$DregScreenopacity4_sel='selected';}
elseif ($DReg_screenopacity=='0.5') {$DregScreenopacity5_sel='selected';}
elseif ($DReg_screenopacity=='0.6') {$DregScreenopacity6_sel='selected';}
elseif ($DReg_screenopacity=='0.7') {$DregScreenopacity7_sel='selected';}
elseif ($DReg_screenopacity=='0.8') {$DregScreenopacity8_sel='selected';}
elseif ($DReg_screenopacity=='0.9') {$DregScreenopacity9_sel='selected';}
elseif ($DReg_screenopacity=='1') {$DregScreenopacity10_sel='selected';}

$DReg_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_title_tmp = preg_replace("/\\\/","",$DReg_title_tmp);
    $DReg_title = explode("|", $DReg_title_tmp);
	$DReg_headclr = $DReg_title[0];
	$DReg_headtxt = $DReg_title[1];
	$DReg_headclr_c = $DReg_title[2];
$DReg_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_text = preg_replace("/\\\/","",$DReg_text);
	
$DReg_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_form_tmp = preg_replace("/\\\/","",$DReg_form);
    $DReg_formx = explode("|", $DReg_form_tmp);
	$DReg_form = $DReg_formx[0];
	$DReg_formtype = $DReg_formx[1];
	$DReg_clink = $DReg_formx[2];
	$DReg_cclick1 = $DReg_formx[3];
	$DReg_cblank = $DReg_formx[4];
	if ($DReg_cblank=="_blank") {$DReg_cblank="checked";}
	$DReg_cbgimage = $DReg_formx[5];
	if ($DReg_cbgimage!="") {$DReg_cbgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
	$DReg_cclick2 = $DReg_formx[6];
	$DReg_cwidth = $DReg_formx[7];
	$DReg_cheight = $DReg_formx[8];
	$DReg_cscroll = $DReg_formx[9];
	if ($DReg_cscroll=="scroll") {$DReg_cscroll="checked";}
	$DReg_surname = $DReg_formx[10];
	$DReg_phone = $DReg_formx[11];
	$DReg_subject = $DReg_formx[12];
	$DReg_message = $DReg_formx[13];
	$DReg_recipient = $DReg_formx[14];
	$DReg_not1 = $DReg_formx[15];
	$DReg_not2 = $DReg_formx[16];
	$DReg_not3 = $DReg_formx[17];
	if ($DReg_not1=="") {$DReg_not1="Please fill out mandatory fields!";}
	if ($DReg_not2=="") {$DReg_not2="Sending failed, please try again in a moment.";}
	if ($DReg_not3=="") {$DReg_not3="Message sent successfully, we will contact you in next 24 hours.";}

if (($DReg_form=='regular' || $DReg_form=='') && ($DReg_theme!='reg3' && $DReg_theme!='reg13')) {
	$Dregf1_sel='selected'; 
	$Dregf1_view='style="display:block"'; $Dregf2_view='style="display:block"';
	$Dregf4_view='style="display:none"'; $Dregf5_view='style="display:none"';
	$Dreg_buttonss='style="display:block"'; 
	$Dreg_adsection='style="display:block"'; $Dreg_adsection1='style="display:block"'; $Dreg_adsection2='style="display:block"';
	$DReg_stheme = 'style="display:inline"'; $DReg_stheme_label = 'style="display:inline"';
	$Dreg_preview1 = 'style="display:block"'; $Dreg_preview2 = 'style="display:none"';
}
elseif (($DReg_form=='social') && ($DReg_theme!='reg3' && $DReg_theme!='reg13')) {
	$Dregf2_sel='selected'; 
	$Dregf1_view='style="display:none"'; $Dregf2_view='style="display:none"';
	$Dregf4_view='style="display:none"'; $Dregf5_view='style="display:none"';
	$Dreg_buttonss='style="display:block"'; 
	$Dreg_adsection='style="display:block"'; $Dreg_adsection1='style="display:block"'; $Dreg_adsection2='style="display:block"';
	$DReg_stheme = 'style="display:inline"'; $DReg_stheme_label = 'style="display:inline"';
	$Dreg_preview1 = 'style="display:block"'; $Dreg_preview2 = 'style="display:none"';
}
elseif (($DReg_form=='both') && ($DReg_theme!='reg3' && $DReg_theme!='reg13')) {
	$Dregf12_sel='selected'; 
	$Dregf1_view='style="display:block"'; $Dregf2_view='style="display:block"';
	$Dregf4_view='style="display:none"'; $Dregf5_view='style="display:none"';
	$Dreg_buttonss='style="display:block"'; 
	$Dreg_adsection='style="display:block"'; $Dreg_adsection1='style="display:block"'; $Dreg_adsection2='style="display:block"';
	$DReg_stheme = 'style="display:inline"'; $DReg_stheme_label = 'style="display:inline"';
	$Dreg_preview1 = 'style="display:block"'; $Dreg_preview2 = 'style="display:none"';
}
elseif (($DReg_form=='custom') && ($DReg_theme!='reg3' && $DReg_theme!='reg13')) {
	$Dregf3_sel='selected'; 
	$Dregf1_view='style="display:none"'; $Dregf2_view='style="display:none"';
	$Dregf4_view='style="display:block"'; $Dregf5_view='style="display:block"';
	$Dreg_buttonss='style="display:none"'; 
	$Dreg_adsection='style="display:none"'; $Dreg_adsection1='style="display:none"'; $Dreg_adsection2='style="display:none"';
	$DReg_stheme = 'style="display:none"'; $DReg_stheme_label = 'style="display:none"';
	$Dreg_preview1 = 'style="display:none"'; $Dreg_preview2 = 'style="display:block"';
}

if ($DReg_formtype=='link' || $DReg_formtype=='') {
	$Dregf10_sel='selected';
	$Dregf6_view='style="display:block"'; $Dregf7_view='style="display:none"'; $Dregf8_view='style="display:block"';
}
elseif ($DReg_formtype=='image') {
	$Dregf20_sel='selected';
	$Dregf6_view='style="display:none"'; $Dregf7_view='style="display:block"'; $Dregf8_view='style="display:none"';
}
else {
	$Dregf10_sel='selected';
	$Dregf6_view='style="display:block"'; $Dregf7_view='style="display:none"'; $Dregf8_view='style="display:none"';
}

$DReg_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_regular_tmp = preg_replace("/\\\/","",$DReg_regular_tmp);
    $DReg_regular = explode("|", $DReg_regular_tmp);
	$Reg_fname = $DReg_regular[0];
	$Reg_femail = $DReg_regular[1];
	$Reg_fbtntxt = $DReg_regular[2];
	$Reg_fbtnclr = $DReg_regular[3];

$DReg_sky_tmp = stripslashes($wpdb->get_var('SELECT Sky FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_sky_tmp = preg_replace("/\\\/","",$DReg_sky_tmp);
	$DReg_sky = explode("|", $DReg_sky_tmp);
	$Reg_skytitle = $DReg_sky[0];
	$Reg_skyheader = $DReg_sky[1];
	$Reg_skydescription = $DReg_sky[2];
	$Reg_skylink = $DReg_sky[3];
	$Reg_skytarget = $DReg_sky[4];
	if ($Reg_skytarget=="on") {$Reg_skytarget="checked";}
	
$DReg_openlink = stripslashes($wpdb->get_var('SELECT Openlink FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_openlink = preg_replace("/\\\/","",$DReg_openlink);
$DReg_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_optin = preg_replace("/\\\/","",$DReg_optin);
$DReg_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_register.' WHERE id='.$Duniqueid);
	if ($DReg_active_tmp=="on") {$DReg_active="checked";} else {$DReg_activated='style="background-color:#FCC"';}

	//replace html br with \n before display in text field
	$DReg_headtxt = preg_replace("/<br>/","\n",$DReg_headtxt);
	$DReg_text = preg_replace("/<br>/","\n",$DReg_text);
	
$DReg_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_register.' WHERE id='.$Duniqueid));
    $DReg_display = explode("|", $DReg_displays);
	$DReg_dpages = $DReg_display[0];
	$DReg_dcats = $DReg_display[1];
	$DReg_dposts = $DReg_display[2];
	if (strpos($DReg_dpages,'allpages')!==false) {$DReg_dpagesall="checked";}
	if (strpos($DReg_dcats,'allcats')!==false) {$DReg_dcatsall="checked";}
	if (strpos($DReg_dposts,'allposts')!==false) {$DReg_dpostsall="checked";}
	//if ($DReg_dpagesall=="" && $DReg_dcatsall=="" && $DReg_dpostsall=="") {$DReg_dcheckall="";}
	$DReg_showsub = $DReg_display[3];
	if ($DReg_showsub=="on") {$DReg_showsub="checked";}
	$DReg_ddelay = $DReg_display[4];
	$DReg_ddays = $DReg_display[5];
	$DReg_dstart = $DReg_display[6];
	$DReg_dstop = $DReg_display[7];
?>

<script type="text/javascript">
function sh7_theme(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='1') {
        document.getElementById("Reg_selectBgs1").name="Reg_bg";
        document.getElementById("Reg_selectBgs2").name="";
        document.getElementById("Reg_selectBgs1").style.display="inline";
        document.getElementById("Reg_selectBgs2").style.display="none";
        document.getElementById("Reg_defmessage").style.display="none";
		document.getElementById("Reg_uploadimage").style.display="inline";
        document.getElementById("Reg_form").style.display="inline";
		document.getElementById("xchoice81").style.display="none";
		document.getElementById("ichoice82").style.display="none";
		document.getElementById("choice80").style.display="block";
		document.getElementById("Reg_adsection").style.display="block";
		document.getElementById("Reg_adsection1").style.display="block";
		document.getElementById("Reg_adsection2").style.display="block";
		document.getElementById("Reg_adsection3").style.display="block";
		document.getElementById("Reg_adsection4").style.display="block";
		document.getElementById("Reg_adsection5").style.display="none";
		document.getElementById("Reg_skyshowdelay").style.display="none";
		$jj('#reg1').html('<img id="reg1img" src="<?php echo GenerationPlugin_preview.'/regD1.gif'; ?>">');
	} else if(sel.selectedIndex=='2') {
        document.getElementById("Reg_selectBgs1").name="Reg_bg";
        document.getElementById("Reg_selectBgs2").name="";
        document.getElementById("Reg_selectBgs1").style.display="inline";
        document.getElementById("Reg_selectBgs2").style.display="none";
        document.getElementById("Reg_defmessage").style.display="inline";
		document.getElementById("Reg_uploadimage").style.display="none";
        document.getElementById("Reg_form").style.display="none";
		document.getElementById("xchoice81").style.display="none";
		document.getElementById("ichoice82").style.display="none";
		document.getElementById("choice80").style.display="block";
		document.getElementById("Reg_adsection").style.display="block";
		document.getElementById("Reg_adsection1").style.display="block";
		document.getElementById("Reg_adsection2").style.display="block";
		document.getElementById("Reg_adsection3").style.display="block";
		document.getElementById("Reg_adsection4").style.display="block";
		document.getElementById("Reg_adsection5").style.display="none";
		document.getElementById("Reg_skyshowdelay").style.display="none";
		$jj('#reg1').html('<img id="reg1img" src="<?php echo GenerationPlugin_preview.'/regD2.gif'; ?>">');
	} else if(sel.selectedIndex=='3' || sel.selectedIndex=='4') {
        document.getElementById("Reg_selectBgs1").name="Reg_bg";
        document.getElementById("Reg_selectBgs2").name="";
        document.getElementById("Reg_form").style.display="none";
		document.getElementById("xchoice81").style.display="none";
		document.getElementById("ichoice82").style.display="none";
		document.getElementById("choice80").style.display="none";
		document.getElementById("Reg_adsection").style.display="none";
		document.getElementById("Reg_adsection1").style.display="none";
		document.getElementById("Reg_adsection2").style.display="none";
		document.getElementById("Reg_adsection3").style.display="none";
		document.getElementById("Reg_adsection4").style.display="none";
		document.getElementById("Reg_adsection5").style.display="block";
		document.getElementById("Reg_skytitleshow").style.display="none";
		document.getElementById("Reg_skyshowdelay").style.display="block";
		$jj('#reg1').html('<img id="reg1img" src="<?php echo GenerationPlugin_preview.'/regD3.gif'; ?>">');
	} else if(sel.selectedIndex=='5' || sel.selectedIndex=='6') {
        document.getElementById("Reg_selectBgs1").name="";
        document.getElementById("Reg_selectBgs2").name="Reg_bg";
        document.getElementById("Reg_selectBgs1").style.display="none";
        document.getElementById("Reg_selectBgs2").style.display="inline";
        document.getElementById("Reg_defmessage").style.display="none";
		document.getElementById("Reg_uploadimage").style.display="inline";
        document.getElementById("Reg_form").style.display="inline";
		document.getElementById("xchoice81").style.display="none";
		document.getElementById("ichoice82").style.display="none";
		document.getElementById("choice80").style.display="block";
		document.getElementById("Reg_adsection").style.display="block";
		document.getElementById("Reg_adsection1").style.display="block";
		document.getElementById("Reg_adsection2").style.display="block";
		document.getElementById("Reg_adsection3").style.display="block";
		document.getElementById("Reg_adsection4").style.display="block";
		document.getElementById("Reg_adsection5").style.display="none";
		document.getElementById("Reg_skyshowdelay").style.display="none";
		$jj('#reg1').html('<img id="reg1img" src="<?php echo GenerationPlugin_preview.'/regL1.gif'; ?>">');
	} else if(sel.selectedIndex=='7') {
        document.getElementById("Reg_selectBgs1").name="";
        document.getElementById("Reg_selectBgs2").name="Reg_bg";
        document.getElementById("Reg_selectBgs1").style.display="none";
        document.getElementById("Reg_selectBgs2").style.display="inline";
        document.getElementById("Reg_defmessage").style.display="inline";
		document.getElementById("Reg_uploadimage").style.display="none";
        document.getElementById("Reg_form").style.display="none";
		document.getElementById("xchoice81").style.display="none";
		document.getElementById("ichoice82").style.display="none";
		document.getElementById("choice80").style.display="block";
		document.getElementById("Reg_adsection").style.display="block";
		document.getElementById("Reg_adsection1").style.display="block";
		document.getElementById("Reg_adsection2").style.display="block";
		document.getElementById("Reg_adsection3").style.display="block";
		document.getElementById("Reg_adsection4").style.display="block";
		document.getElementById("Reg_adsection5").style.display="none";
		document.getElementById("Reg_skyshowdelay").style.display="none";
		$jj('#reg1').html('<img id="reg1img" src="<?php echo GenerationPlugin_preview.'/regL2.gif'; ?>">');
	} else if(sel.selectedIndex=='8') {
        document.getElementById("Reg_selectBgs1").name="";
        document.getElementById("Reg_selectBgs2").name="Reg_bg";
        document.getElementById("Reg_form").style.display="none";
		document.getElementById("xchoice81").style.display="none";
		document.getElementById("ichoice82").style.display="none";
		document.getElementById("choice80").style.display="none";
		document.getElementById("Reg_adsection").style.display="none";
		document.getElementById("Reg_adsection1").style.display="none";
		document.getElementById("Reg_adsection2").style.display="none";
		document.getElementById("Reg_adsection3").style.display="none";
		document.getElementById("Reg_adsection4").style.display="none";
		document.getElementById("Reg_adsection5").style.display="block";
		document.getElementById("Reg_skytitleshow").style.display="block";
		document.getElementById("Reg_skyshowdelay").style.display="block";
		$jj('#reg1').html('<img id="reg1img" src="<?php echo GenerationPlugin_preview.'/regL3.gif'; ?>">');
	}
}
$jj(document).ready(function(){
	$jj("#Reg_name").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_email").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_surname").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_phone").charCount({allowed:25, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_subject").charCount({allowed:25, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_message").charCount({allowed:25, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_btntxt").charCount({allowed:18, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_headtxt").charCount({allowed:28, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_headdes").charCount({allowed:60, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_openlink").charCount({allowed:18, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_not1").charCount({allowed:60, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_not2").charCount({allowed:60, warning:0, /*counterText:'left: '*/});
	$jj("#Reg_not3").charCount({allowed:60, warning:0, /*counterText:'left: '*/});
});
</script>


        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DReg_activated; ?>>
				<input name="Reg_active" type="checkbox" <?php echo $DReg_active; ?>> Activate Registration Box
			</div>
            <select name="Reg_theme" id="selectreg" onchange="sh7_theme(this)" <?php echo $DReg_stheme; ?>>
				<option value="reg1" style="color:#069; font-weight:bold">Graphite themes</option>
                <option value="reg1" <?php echo $Dreg1_sel; ?>>registration box</option>
                <option value="reg2" <?php echo $Dreg2_sel; ?>>contact form</option>
                <option value="reg3" <?php echo $Dreg3_sel; ?>>sky popup (mac style)</option>
				<option value="reg2">&nbsp;</option>
				<option value="reg11" style="color:#069; font-weight:bold">Silver themes</option>
                <option value="reg11" <?php echo $Dreg11_sel; ?>>registration box</option>
                <option value="reg12" <?php echo $Dreg12_sel; ?>>contact form</option>
                <option value="reg13" <?php echo $Dreg13_sel; ?>>sky popup (windows style)</option>
            </select> <span id="selectreg_label" <?php echo $DReg_stheme_label; ?>>Template</span>
			<div id="Reg_form" <?php echo $DReg_formshow; ?>>
    			<select name="Reg_form" onchange="sh8(this)">
    				<option value="regular" <?php echo $Dregf1_sel; ?>>regular</option>
    				<option value="social" <?php echo $Dregf2_sel; ?>>facebook</option>
    				<option value="both" <?php echo $Dregf12_sel; ?>>regular and facebook switch</option>
					<option value="custom" <?php echo $Dregf3_sel; ?>>custom content</option>
    			</select> Type of sign-up form
			</div>
			<div id="xchoice81" <?php echo $Dregf5_view; ?>>
    			<select name="Reg_ccontent" onchange="sh80(this)">
    				<option value="link" <?php echo $Dregf10_sel; ?>>webpage</option>
    				<option value="image" <?php echo $Dregf20_sel; ?>>image</option>
    			</select> Type of custom content
			</div>
			
			<div id="ichoice82" <?php echo $Dregf4_view; ?>>
				<div id="ichoice85" <?php echo $Dregf8_view; ?>>
    				<input name="Reg_cwidth" type="text" value="<?php echo $DReg_cwidth; ?>"> Box width in pixels
            		<br/>
    				<input name="Reg_cheight" type="text" value="<?php echo $DReg_cheight; ?>"> Box height in pixels
            		<br/>
    				<input name="Reg_cscroll" type="checkbox" value="scroll" <?php echo $DReg_cscroll; ?>> Show vertical scrollbar
				</div>
				<div id="ichoice83" <?php echo $Dregf6_view; ?>>
					<input name="Reg_clink" type="text" value="<?php echo $DReg_clink; ?>">
					<img id="helpbtn_reg8" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        			<span class="maxfile" id="helptip_reg8">URLs starting with 'https://' will not open in box due to security reasons.</span> Link to webpage
				</div>
				<div id="ichoice84" <?php echo $Dregf7_view; ?>>
					<input name="Reg_cbg" type="file" size="26">
        			<?php if (filesize($DReg_cbgimage)>=1048576) { ?>
        				<img id="helpbtn_reg9" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
        				<span class="maxfilewarning" id="helptip_reg9">Max 1Mb!</span>
        			<?php } else { ?>
        				<img id="helpbtn_reg9" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        				<span class="maxfile" id="helptip_reg9">Max 1Mb</span>
        			<?php } ?>
        			<?php echo $DReg_cbgimage_img; ?>
					<span style="display:inline; margin-bottom:100px">Upload an image...</span>
        			<br/>
        			<input name="Reg_cbgremove" type="checkbox"> Remove uploaded image
					<br/>
    				<input name="Reg_cclick1" type="text" value="<?php echo $DReg_cclick1; ?>"> ...or use external image
					<br/>
    				<input name="Reg_cclick2" type="text" value="<?php echo $DReg_cclick2; ?>"> Link for <i>click</i> action
					<br/>
					<input name="Reg_cblank" type="checkbox" value="_blank" <?php echo $DReg_cblank; ?>> Open the link in new tab
				</div>
			</div>
			
            <div id="choice80" name="choice81" <?php echo $Dregf1_view; ?>>
				<div id="ichoice80" <?php echo $Dregf2_view; ?>>
    				<input id="Reg_name" name="Reg_name" type="text" value="<?php echo $Reg_fname; ?>"> 'Name' default value
                    <br/>
                    <input id="Reg_email" name="Reg_email" type="text" value="<?php echo $Reg_femail; ?>"> 'Email' default value
                    <br/>
				</div>
				
				<div id="Reg_buttonss" <?php echo $Dreg_buttonss; ?>>
                <input id="Reg_btntxt" name="Reg_btntxt" type="text" value="<?php echo $Reg_fbtntxt; ?>"> Button text
                <br/>
				<select name="Reg_btnclr" id="selectButtons">
					<option style="margin-left:-136px; color:#069; font-weight:bold">Stripe design</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark.gif'; ?>)" 
						value="stripe_darkred" <?php echo $DregB1_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red.gif'; ?>)" 
						value="stripe_red" <?php echo $DregB2_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta.gif'; ?>)" 
						value="stripe_magenta" <?php echo $DregB3_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta.gif'; ?>)" 
						value="stripe_violetmagenta" <?php echo $DregB4_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet.gif'; ?>)" 
						value="stripe_violet" <?php echo $DregB5_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet.gif'; ?>)" 
						value="stripe_blueviolet" <?php echo $DregB6_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy.gif'; ?>)" 
						value="stripe_navyblue" <?php echo $DregB7_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark.gif'; ?>)" 
						value="stripe_darkblue" <?php echo $DregB8_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue.gif'; ?>)" 
						value="stripe_blue" <?php echo $DregB9_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise.gif'; ?>)" 
						value="stripe_turquoise" <?php echo $DregB10_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise.gif'; ?>)" 
						value="stripe_greenturquoise" <?php echo $DregB11_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark.gif'; ?>)" 
						value="stripe_darkgreen" <?php echo $DregB12_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green.gif'; ?>)" 
						value="stripe_green" <?php echo $DregB13_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon.gif'; ?>)" 
						value="stripe_lemon" <?php echo $DregB14_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow.gif'; ?>)" 
						value="stripe_yellow" <?php echo $DregB15_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange.gif'; ?>)" 
						value="stripe_orange" <?php echo $DregB16_sel; ?>>orange</option>
					<option>&nbsp;</option>
					<option style="margin-left:-136px; color:#069; font-weight:bold">Simple design</option>
					<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark2.gif'; ?>)" 
						value="simple_darkred" <?php echo $DregB21_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red2.gif'; ?>)" 
						value="simple_red" <?php echo $DregB22_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta2.gif'; ?>)" 
						value="simple_magenta" <?php echo $DregB23_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta2.gif'; ?>)" 
						value="simple_violetmagenta" <?php echo $DregB24_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet2.gif'; ?>)" 
                        value="simple_violet" <?php echo $DregB25_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet2.gif'; ?>)" 
  						value="simple_blueviolet" <?php echo $DregB26_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy2.gif'; ?>)" 
						value="simple_navyblue" <?php echo $DregB27_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark2.gif'; ?>)" 
						value="simple_darkblue" <?php echo $DregB28_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue2.gif'; ?>)" 
						value="simple_blue" <?php echo $DregB29_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise2.gif'; ?>)" 
						value="simple_turquoise" <?php echo $DregB30_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise2.gif'; ?>)" 
						value="simple_greenturquoise" <?php echo $DregB31_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark2.gif'; ?>)" 
						value="simple_darkgreen" <?php echo $DregB32_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green2.gif'; ?>)" 
						value="simple_green" <?php echo $DregB33_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon2.gif'; ?>)" 
						value="simple_lemon" <?php echo $DregB34_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow2.gif'; ?>)" 
						value="simple_yellow" <?php echo $DregB35_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange2.gif'; ?>)" 
						value="simple_orange" <?php echo $DregB36_sel; ?>>orange</option>
				</select> Button color
				</div>
			</div>
			
			<div id="Reg_adsection" <?php echo $Dreg_adsection; ?>>
			
			<div id="Reg_defmessage" <?php echo $DReg_defmessage; ?>>
				<input name="Reg_recipient" type="text" value="<?php echo $DReg_recipient; ?>"> Your (recipient) email
				<br/>
				<input id="Reg_surname" name="Reg_surname" type="text" value="<?php echo $DReg_surname; ?>">
				<img id="helpbtn_reg7" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="contacthelp" id="helptip_reg7">Input fields with grey star are not mandatory, leave them empty to NOT show them in your contact form.</span>
				'Surname' value
				<span style="color:#AAA">*</span>
				<br/>
				<input id="Reg_phone" name="Reg_phone" type="text" value="<?php echo $DReg_phone; ?>"> 'Phone' value
				<span style="color:#AAA">*</span>
				<br/>
				<input id="Reg_subject" name="Reg_subject" type="text" value="<?php echo $DReg_subject; ?>"> 'Subject' value
				<span style="color:#AAA">*</span>
				<br/>
				<input id="Reg_message" name="Reg_message" type="text" value="<?php echo $DReg_message; ?>"> 'Message' value
				<br/>
				<textarea id="Reg_not1" style="margin-top:0" class="m8px" name="Reg_not1"><?php echo $DReg_not1; ?></textarea>
					Notification #1: warning
				<br/>
				<textarea id="Reg_not2" class="m8px" name="Reg_not2"><?php echo $DReg_not2; ?></textarea>
					Notification #2: warning
				<br/>
				<textarea id="Reg_not3" class="m8px" name="Reg_not3"><?php echo $DReg_not3; ?></textarea>
					Notification #3: sent
				<div style="margin-top:-5px">&nbsp;</div>
			</div>
			
            <input name="Reg_headclr" type="text" id="colorregister" value="<?php echo $DReg_headclr; ?>" />
			<div style="margin:0 0 -25px 235px">
				<input style="position:absolute; margin:5px 0 0 -21px" name="Reg_headclr_c" type="checkbox" value="on" <?php if ($DReg_headclr_c=="on") {echo "checked";} ?> />
				<img id="helpbtn_reg5" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="headclrhelp" id="helptip_reg5">Pick your color and check the checkbox to setup headers color different than button color.</span>
				Custom headers color
			</div>
            <br/>
			
			</div>
			
			<div id="Reg_adsection4" <?php echo $Dreg_adsection4; ?>>
			
            <input class="m8px" id="Reg_openlink" name="Reg_openlink" type="text" value="<?php echo $DReg_openlink; ?>"> Link button text
			
			</div>
			
			<div id="Reg_adsection1" <?php echo $Dreg_adsection1; ?>>
			
			<textarea class="m1px" id="Reg_headtxt" name="Reg_headtxt"><?php echo $DReg_headtxt; ?></textarea>
			<img id="helpbtn_reg6" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
			<span class="countdownhelp" id="helptip_reg6">Use number in brackets (max '90') to add countdown timer. Number in brackets = minutes, e.g.(57).</span>
			Header text
            <br/>
            <textarea id="Reg_headdes" name="Reg_headdes"><?php echo $DReg_text; ?></textarea> Header description
            <br/>
			
			</div>
			
			<div id="Reg_adsection3" <?php echo $Dreg_adsection3; ?>>
			
			<select name="Reg_screencolor" class="GP_screenselect" style="width:133px; margin-top:10px">
					<option value="#FFF">Color</option>
    				<option value="#FFF" <?php echo $DregScreencolor1_sel; ?>>light</option>
    				<option value="#999" <?php echo $DregScreencolor2_sel; ?>>medium</option>
    				<option value="#000" <?php echo $DregScreencolor3_sel; ?>>dark</option>
			</select>
			<select name="Reg_screenopacity" class="GP_screenselect" style="margin-top:10px">
					<option value="0.8">Opacity</option>
    				<option value="0" <?php echo $DregScreenopacity0_sel; ?>>0 (none)</option>
    				<option value="0.1" <?php echo $DregScreenopacity1_sel; ?>>1</option>
    				<option value="0.2" <?php echo $DregScreenopacity2_sel; ?>>2</option>
    				<option value="0.3" <?php echo $DregScreenopacity3_sel; ?>>3</option>
    				<option value="0.4" <?php echo $DregScreenopacity4_sel; ?>>4</option>
    				<option value="0.5" <?php echo $DregScreenopacity5_sel; ?>>5 (medium)</option>
    				<option value="0.6" <?php echo $DregScreenopacity6_sel; ?>>6</option>
    				<option value="0.7" <?php echo $DregScreenopacity7_sel; ?>>7</option>
    				<option value="0.8" <?php echo $DregScreenopacity8_sel; ?>>8 (default)</option>
    				<option value="0.9" <?php echo $DregScreenopacity9_sel; ?>>9</option>
    				<option value="1" <?php echo $DregScreenopacity10_sel; ?>>10 (solid)</option>
			</select> <span style="display:inline">Screen background</span>
			
			</div>
			
			<div id="Reg_adsection2" <?php echo $Dreg_adsection2; ?>>
			
			<select <?php echo $Reg_bg1_name; ?> id="Reg_selectBgs1" <?php echo $DReg_selectBgs1; ?>>
					<option style="margin-left:-136px">Dark backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_noise.gif'; ?>)" 
						value="bg2" <?php echo $DregBackground2_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_carbonfiber.gif'; ?>)" 
						value="bg3" <?php echo $DregBackground3_sel; ?>>carbon fiber</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_wood.gif'; ?>)" 
						value="bg4" <?php echo $DregBackground4_sel; ?>>wood</option>
			</select>	
			<select <?php echo $Reg_bg2_name; ?> id="Reg_selectBgs2" <?php echo $DReg_selectBgs2; ?>>
					<option style="margin-left:-136px">Light backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_noise.gif'; ?>)" 
						value="bg12" <?php echo $DregBackground12_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_sparkles.gif'; ?>)" 
						value="bg13" <?php echo $DregBackground13_sel; ?>>sparkles</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_blur.gif'; ?>)" 
						value="bg14" <?php echo $DregBackground14_sel; ?>>blur</option>
			</select> <span style="display:inline">Product background</span>
			<br/>
            <input name="Reg_bg" type="file" size="26">
			<?php if (filesize($DReg_bgimage)>=307201) { ?>
				<img id="helpbtn_reg3" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_reg3">Max 300kb!</span>
			<?php } else { ?>
				<img id="helpbtn_reg3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_reg3">Max 300kb</span>
			<?php } ?>
			<?php echo $DReg_bgimage_img; ?>
			<br/>
			<input name="Reg_bgremove" type="checkbox"> Remove uploaded background
			<br/>
			<div id="Reg_uploadimage" <?php echo $DReg_uploadimage; ?>>
                <input class="m8px" name="Reg_file" type="file" size="26">
    			<?php if (filesize($DReg_image)>=81921) { ?>
    				<img id="helpbtn_reg4" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
    				<span class="maxfilewarning" id="helptip_reg4">Max 70kb! (170x170px)</span>
    			<?php } else { ?>
    				<img id="helpbtn_reg4" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
    				<span class="maxfile" id="helptip_reg4">Max 70kb (170x170px)</span>
    			<?php } ?>
    			<?php echo $DReg_image_img; ?> Product image
    			<br/>
    			<input name="Reg_fileremove" type="checkbox"> Remove uploaded image
			</div>
			
        </div>
			
		<div id="Reg_adsection5" <?php echo $Dreg_adsection5; ?>>
			<div id="Reg_skytitleshow" <?php echo $Dreg_skytitleshow; ?>>
    			<input name="Reg_skytitle" type="text" value="<?php echo $Reg_skytitle; ?>"> Sky title
    			<br/>
			</div>
			<input name="Reg_skyheader" type="text" value="<?php echo $Reg_skyheader; ?>"> Sky header text
			<br/>
			<input name="Reg_skydescription" type="text" value="<?php echo $Reg_skydescription; ?>"> Sky description
			<br/>
			<input name="Reg_skylink" type="text" value="<?php echo $Reg_skylink; ?>"> Sky link to webpage
			<br/>
			<input name="Reg_skytarget" type="checkbox" <?php echo $Reg_skytarget; ?>> Open link in new tab
		</div>
		
        </div>
            
        <div class="right_section" id="reg_checkboxes">
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_reg1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_reg1">Click here to show options. Use widget to display a link button.</span>
			</h4>
            <div class="toggle">
				<div class="gpadminoptional">
					Displaying settings are optional for this tool. Read instruction for details.
				</div>
				<input style="display:inline-block;" type="checkbox" name="Reg_pagelist[]" value="allpages" <?php echo $DReg_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DReg_dpages_front="front";
				if (strpos(','.$DReg_dpages.',',',front,')!==false || $DReg_displays=="") {$DReg_dpagesch[$DReg_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Reg_pagelist[]" value="front" '.$DReg_dpagesch[$DReg_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DReg_dpages_search="search";
				if (strpos(','.$DReg_dpages.',',',search,')!==false || $DReg_displays=="") {$DReg_dpagesch[$DReg_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Reg_pagelist[]" value="search" '.$DReg_dpagesch[$DReg_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DReg_dpages_author="author";
				if (strpos(','.$DReg_dpages.',',',author,')!==false || $DReg_displays=="") {$DReg_dpagesch[$DReg_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Reg_pagelist[]" value="author" '.$DReg_dpagesch[$DReg_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order'); 
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DReg_dpages.',',','.trim($pageID).',')!==false || $DReg_displays=="") {$DReg_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Reg_pagelist[]" value="'.$pageID.'" '.$DReg_dpagesch[$pageID].'>';
					echo '&nbsp;'.$title.'<br>';
					
					//subpages
					if ($page->post_parent)	{
        				$ancestors=get_post_ancestors($page->ID);
        				$root=count($ancestors)-1;
        				$pageparent = $ancestors[$root];
        			} else {
        				$pageparent = $page->ID;
        			}
        			$children = get_pages("child_of=$pageparent&sort_column=menu_order" );
        			if ($children) {
        				foreach ($children as $child) {
        					$childtitle = $child->post_title;
        					$childID = $child->ID;
        					$childDepth = count(get_ancestors($childID, 'page'));
 							if (strpos(','.$DReg_dpages.',',','.trim($childID).',')!==false || $DReg_displays=="") {$DReg_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Reg_pagelist[]" value="'.$childID.'" '.$DReg_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Reg_catlist[]" value="allcats" <?php echo $DReg_dcatsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DReg_dcats.',',','.trim($cat_id).',')!==false || $DReg_displays=="") {$DReg_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Reg_catlist[]" value="'.$cat_id.'" '.$DReg_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Reg_postlist[]" value="allposts" <?php echo $DReg_dpostsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on posts</div>
				<div class="toggle">
             	<?php
        		//list all posts by category
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id= $cat->term_id;
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<span style="color:#CCC">'.$cat->name.'</span><br>';
                    query_posts("cat=$cat_id&post_per_page=1000");
                    if (have_posts()) { 
						while (have_posts()) {
							the_post();
                            global $id; //the page id
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							if (strpos(','.$DReg_dposts.',',','.trim($id).',')!==false || $DReg_displays=="") {$DReg_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Reg_postlist[]" value="'.$id.'" '.$DReg_dpostsch[$id].'>&nbsp;';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="Reg_showsub" <?php echo $DReg_showsub; ?>>
					&nbsp;<span style="color:#069">Do NOT show to subscribers</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="reg_checkboxes_switch" <?php echo $DReg_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				<div id="Reg_skyshowdelay" <?php echo $Dreg_skyshowdelay; ?>>
					Show after <input class="showdelay" name="Reg_ddelay" type="text" value="<?php echo $DReg_ddelay; ?>"> seconds<br>
				</div>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Reg_dstart" type="text" value="<?php echo $DReg_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Reg_dstop" type="text" value="<?php echo $DReg_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Reg_ddays" type="text" value="<?php echo $DReg_ddays; ?>"> days<br>
				-->
				
            </div>
			
        	<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_reg2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_reg2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="reg1" class="preview8" <?php echo $Dreg_preview1; ?>><?php echo $Dreg_view; ?></div>
			<div id="reg2" class="preview8" <?php echo $Dreg_preview2; ?>><img src="<?php echo GenerationPlugin_preview.'/regCC.gif'; ?>"></div>
        </div>
		
		
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_reg" type="hidden" value="Save Changes">
    		<input id="Savepreview_reg" name="Savepreview_reg" type="hidden" value="Savepreview_reg">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_reg').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div> 
