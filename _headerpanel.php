<div id="tab3" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_header" enctype="multipart/form-data">


<?php
if (isset($_POST['displayingformsent_header'])=='Save Changes') {

	//multiple values into one database cell
	if ($_POST['Header_headclr_c']=="on") {$Header_headclr=$_POST['Header_headclr'];}
	elseif ($_POST['Header_form']=="social") {$Header_headclr="0d66ae";}
	elseif ($_POST['Header_btnclr']=="stripe_darkred" || $_POST['Header_btnclr']=="simple_darkred") {$Header_headclr="a92e20";}
	elseif ($_POST['Header_btnclr']=="stripe_red" || $_POST['Header_btnclr']=="simple_red") {$Header_headclr="d53929";}
	elseif ($_POST['Header_btnclr']=="stripe_magenta" || $_POST['Header_btnclr']=="simple_magenta") {$Header_headclr="c73272";}
	elseif ($_POST['Header_btnclr']=="stripe_violetmagenta" || $_POST['Header_btnclr']=="simple_violetmagenta") {$Header_headclr="b940b3";}
	elseif ($_POST['Header_btnclr']=="stripe_violet" || $_POST['Header_btnclr']=="simple_violet") {$Header_headclr="6c4ab2";}
	elseif ($_POST['Header_btnclr']=="stripe_blueviolet" || $_POST['Header_btnclr']=="simple_blueviolet") {$Header_headclr="4442ad";}
	elseif ($_POST['Header_btnclr']=="stripe_navyblue" || $_POST['Header_btnclr']=="simple_navyblue") {$Header_headclr="286c9e";}
	elseif ($_POST['Header_btnclr']=="stripe_darkblue" || $_POST['Header_btnclr']=="simple_darkblue") {$Header_headclr="387dab";}
	elseif ($_POST['Header_btnclr']=="stripe_blue" || $_POST['Header_btnclr']=="simple_blue") {$Header_headclr="299eb9";}
	elseif ($_POST['Header_btnclr']=="stripe_turquoise" || $_POST['Header_btnclr']=="simple_turquoise") {$Header_headclr="38b5af";}
	elseif ($_POST['Header_btnclr']=="stripe_greenturquoise" || $_POST['Header_btnclr']=="simple_greenturquoise") {$Header_headclr="2cc183";}
	elseif ($_POST['Header_btnclr']=="stripe_darkgreen" || $_POST['Header_btnclr']=="simple_darkgreen") {$Header_headclr="5ca138";}
	elseif ($_POST['Header_btnclr']=="stripe_green" || $_POST['Header_btnclr']=="simple_green") {$Header_headclr="93b73f";}
	elseif ($_POST['Header_btnclr']=="stripe_lemon" || $_POST['Header_btnclr']=="simple_lemon") {$Header_headclr="d6ce28";}
	elseif ($_POST['Header_btnclr']=="stripe_yellow" || $_POST['Header_btnclr']=="simple_yellow") {$Header_headclr="d1bd26";}
	elseif ($_POST['Header_btnclr']=="stripe_orange" || $_POST['Header_btnclr']=="simple_orange") {$Header_headclr="e68f1b";}
	else {$Header_headclr="CC3300";}
	$Header_head = "#".trim($Header_headclr."|".$_POST['Header_headtxt']."|".$_POST['Header_headclr_c'], "#");
	$Header_regular = $_POST['Header_name']."|".$_POST['Header_email']."|".$_POST['Header_btntxt']."|".$_POST['Header_btnclr']."|".$_POST['Header_name_disabled'];
	$Header_social = "facebook";
	$Header_background = $_POST['Header_bg']."|".$_POST['Header_screencolor']."|".$_POST['Header_screenopacity'];
	$Header_optin = trim(str_replace("|",":::",$_POST['Header_optin1']))."|".trim($_POST['Header_optin2'])."|".trim($_POST['Header_optin3'])."|".trim($_POST['Header_optin4'])."|".trim($_POST['Header_optin5'])."|".trim($_POST['Header_optin6'])."|".trim($_POST['Header_optin7'])."|".trim($_POST['Header_optin8'])."|".trim($_POST['Header_optin9']);
    $Header_optin = str_replace(array("\r\n", "\r", "\n"), '<br>', $Header_optin);

	//image upload
	$Header_file = $_FILES['Header_file']['name'];
	$Header_fileremove = $_POST['Header_fileremove'];
	if ($Header_fileremove=='on') {$Header_file='';}
    $Header_path = GenerationPlugin_uploads.basename($Header_file);
    if (move_uploaded_file($_FILES['Header_file']['tmp_name'], $Header_path)) {
        $Header_array = explode('.',$Header_file);
        $Header_exten = $Header_array[count($Header_array)-1];
    	if (isset($_POST['Savepreview_header'])) {
			$Header_image = GenerationPlugin_uploads.'Header_image.'.$Header_exten;
			$Header_image_db = GenerationPlugin_uploads_db.'Header_image.'.$Header_exten;
        	rename($Header_path, $Header_image);
		}
        $Header_image_preview = GenerationPlugin_uploads.'Header_image_preview.'.$Header_exten;
        $Header_image_preview_db = GenerationPlugin_uploads_db.'Header_image_preview.'.$Header_exten;
		if ($Header_image!='') { copy($Header_image, $Header_image_preview); }
        rename($Header_path, $Header_image_preview);
    } else {
        $Header_image = $wpdb->get_var('SELECT Image FROM '.$table_name_header.' WHERE id='.$Duniqueid);
        $Header_image_preview = $Header_image_preview_db = $Header_image_db = $Header_image;
    }
	if (isset($_POST['Savepreview_header'])) {
   		if ($Header_fileremove=='on') {$Header_image=''; $Header_image_db='';}
	}
	if ($Header_fileremove=='on') {$Header_image_preview=''; $Header_image_preview_db='';}
	
	//background upload
	$Header_bgfile = $_FILES['Header_bg']['name'];
	$Header_bgfileremove = $_POST['Header_bgremove'];
	if ($Header_bgfileremove=='on') {$Header_bgfile='';}
    $Header_bgpath = GenerationPlugin_uploads.basename($Header_bgfile);
    if (move_uploaded_file($_FILES['Header_bg']['tmp_name'], $Header_bgpath)) {
        $Header_bgarray = explode('.',$Header_bgfile);
        $Header_bgexten = $Header_bgarray[count($Header_bgarray)-1];
    	if (isset($_POST['Savepreview_header'])) {
			$Header_bgimage = GenerationPlugin_uploads.'Header_bgimage.'.$Header_bgexten;
			$Header_bgimage_db = GenerationPlugin_uploads_db.'Header_bgimage.'.$Header_bgexten;
        	rename($Header_bgpath, $Header_bgimage);
		}
        $Header_bgimage_preview = GenerationPlugin_uploads.'Header_bgimage_preview.'.$Header_bgexten;
        $Header_bgimage_preview_db = GenerationPlugin_uploads_db.'Header_bgimage_preview.'.$Header_bgexten;
		if ($Header_bgimage!='') { copy($Header_bgimage, $Header_bgimage_preview); }
        rename($Header_bgpath, $Header_bgimage_preview);
    } else {
        $Header_bgimage = $wpdb->get_var('SELECT Bgimage FROM '.$table_name_header.' WHERE id='.$Duniqueid);
        $Header_bgimage_preview = $Header_bgimage_preview_db = $Header_bgimage_db = $Header_bgimage;
    }
	if (isset($_POST['Savepreview_header'])) {
   		if ($Header_bgfileremove=='on') {$Header_bgimage=''; $Header_bgimage_db='';}
	}
	if ($Header_bgfileremove=='on') {$Header_bgimage_preview=''; $Header_bgimage_preview_db='';}

	//custom content image upload
	$Header_cbgfile = $_FILES['Header_cbg']['name'];
	$Header_cbgfileremove = $_POST['Header_cbgremove'];
	if ($Header_cbgfileremove=='on') {$Header_cbgfile='';}
    $Header_cbgpath = GenerationPlugin_uploads.basename($Header_cbgfile);
    if (move_uploaded_file($_FILES['Header_cbg']['tmp_name'], $Header_cbgpath)) {
        $Header_cbgarray = explode('.',$Header_cbgfile);
        $Header_cbgexten = $Header_cbgarray[count($Header_cbgarray)-1];
		if (isset($_POST['Savepreview_header'])) {
			$Header_cbgimage = GenerationPlugin_uploads.'Header_cbgimage.'.$Header_cbgexten;
			$Header_cbgimage_db = GenerationPlugin_uploads_db.'Header_cbgimage.'.$Header_cbgexten;
        	rename($Header_cbgpath, $Header_cbgimage);
		}
        $Header_cbgimage_preview = GenerationPlugin_uploads.'Header_cbgimage_preview.'.$Header_cbgexten;
        $Header_cbgimage_preview_db = GenerationPlugin_uploads_db.'Header_cbgimage_preview.'.$Header_cbgexten;
		if ($Header_cbgimage!='') { copy($Header_cbgimage, $Header_cbgimage_preview); }
        rename($Header_cbgpath, $Header_cbgimage_preview);
    } else {
        $Header_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_header.' WHERE id='.$Duniqueid));
    	$Header_form_tmp = preg_replace("/\\\/","",$Header_form);
        $Header_formx = explode("|", $Header_form_tmp);
    	$Header_cbgimage = $Header_formx[5];
        $Header_cbgimage_preview = $Header_cbgimage_preview_db = $Header_cbgimage_db = $Header_cbgimage;
    }
	if (isset($_POST['Savepreview_header'])) {
   		if ($Header_cbgfileremove=='on') {$Header_cbgimage=''; $Header_cbgimage_db='';}
	}
	if ($Header_cbgfileremove=='on') {$Header_cbgimage_preview=''; $Header_cbgimage_preview_db='';}
	
	$Header_form = $_POST['Header_form']."|".$_POST['Header_ccontent']."|".$_POST['Header_clink']."|".$_POST['Header_cclick1']."|".$_POST['Header_cblank']."|".$Header_cbgimage_db."|".$_POST['Header_cclick2']."|".$_POST['Header_cwidth']."|".$_POST['Header_cheight']."|".$_POST['Header_cscroll']."|".$_POST['Header_cfullw']."|".$_POST['Header_bookmarkclr'];
	$Header_form_preview = $_POST['Header_form']."|".$_POST['Header_ccontent']."|".$_POST['Header_clink']."|".$_POST['Header_cclick1']."|".$_POST['Header_cblank']."|".$Header_cbgimage_preview_db."|".$_POST['Header_cclick2']."|".$_POST['Header_cwidth']."|".$_POST['Header_cheight']."|".$_POST['Header_cscroll']."|".$_POST['Header_cfullw']."|".$_POST['Header_bookmarkclr'];
	$Header_startdate = $_POST['Header_dstart'];
	if ($_POST['Header_ddays']=="") { $Header_days = ""; }
	elseif ($Header_startdate!="") { $Header_days = date("Y-m-d", strtotime($Header_startdate." + ".$_POST['Header_ddays']." days")); }
	else { $Header_days = date("Y-m-d", strtotime(" + ".$_POST['Header_ddays']." days")); }
	$Header_display = implode(',',$_POST['Header_pagelist']).'|'.implode(',',$_POST['Header_catlist']).'|'.implode(',',$_POST['Header_postlist']).'|'.$_POST['Header_showsub'].'|'.$_POST['Header_ddelay'].'|'.$Header_days.'|'.$_POST['Header_dstart'].'|'.$_POST['Header_dstop'];
	$Header_hey = $_POST['Header_heytext'].'|'.$_POST['Header_heybutton'].'|'.$_POST['Header_heylink'].'|'.$_POST['Header_heytarget'].'|'.$_POST['Header_heycolor'];

	//replace \n with html br before save to database
	$Header_head=str_replace(array("\r\n", "\r", "\n"), '<br>', $Header_head);
	$Header_headdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Header_headdes']);
	$Header_spam=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Header_spam']);
	
	//save to database
	if (isset($_POST['Savepreview_header'])) {
    $wpdb->update($table_name_header, 
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Header_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Header_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Header_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Header_image_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Header_bgimage_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Header_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Header_head)),
    		  'Text'=>mysql_real_escape_string(trim($Header_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Header_form)),
    		  'Regular'=>mysql_real_escape_string(trim($Header_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Header_social)),
    		  'Hey'=>mysql_real_escape_string(trim($Header_hey)),
    		  'Spam'=>mysql_real_escape_string(trim($Header_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Header_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Header_active'])),
			  'Display'=>mysql_real_escape_string(trim($Header_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_header, 
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Header_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Header_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Header_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Header_image_preview_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Header_bgimage_preview_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Header_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Header_head)),
    		  'Text'=>mysql_real_escape_string(trim($Header_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Header_form_preview)),
    		  'Regular'=>mysql_real_escape_string(trim($Header_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Header_social)),
    		  'Hey'=>mysql_real_escape_string(trim($Header_hey)),
    		  'Spam'=>mysql_real_escape_string(trim($Header_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Header_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Header_active'])),
			  'Display'=>mysql_real_escape_string(trim($Header_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DHeader_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_theme = preg_replace("/\\\/","",$DHeader_theme);
$DHeader_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_link = preg_replace("/\\\/","",$DHeader_link);
$DHeader_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_header.' WHERE id='.$Duniqueid));
if ($DHeader_link_blank=="_blank") {$DHeader_link_blank="checked";}
$DHeader_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_image = preg_replace("/\\\/","",$DHeader_image);
$DHeader_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_bgimage = preg_replace("/\\\/","",$DHeader_bgimage);
if ($DHeader_image!="") {$DHeader_image_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
if ($DHeader_bgimage!="") {$DHeader_bgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}

if ($DHeader_theme=='header1') {
	$Dheader1_sel='selected'; $Dheader_view='<img id="header1img" src="'.GenerationPlugin_preview.'/headerD1.gif">';
	$DHeader_show1 = 'style="display:block"';
	$Header_bg1_name = 'name="Header_bg"';
	$Header_bg2_name = 'name=""';
	$DHeader_selectBgs1 = 'style="display:inline"';
	$DHeader_selectBgs2 = 'style="display:none"';
	$DHeader_uploadimage = 'style="display:block"';
	$DHeader_formshow = 'style="display:block"';
    $Dheaderf5_view = 'style="display:none"';
    $Dheaderf4_view = 'style="display:none"';
    $Dheaderf1_view = 'style="display:block"';
    $Dheader_adsection = 'style="display:block"';
    $Dheader_adsection2 = 'style="display:none"';
}
elseif ($DHeader_theme=='header2') {
	$Dheader2_sel='selected'; $Dheader_view='<img id="header1img" src="'.GenerationPlugin_preview.'/headerD2.gif">';
	$DHeader_show1 = 'style="display:none"';
	$Header_bg1_name = 'name="Header_bg"';
	$Header_bg2_name = 'name=""';
	$DHeader_selectBgs1 = 'style="display:inline"';
	$DHeader_selectBgs2 = 'style="display:none"';
	$DHeader_uploadimage = 'style="display:none"';
	$DHeader_formshow = 'style="display:block"';
    $Dheaderf5_view = 'style="display:none"';
    $Dheaderf4_view = 'style="display:none"';
    $Dheaderf1_view = 'style="display:block"';
    $Dheader_adsection = 'style="display:block"';
    $Dheader_adsection2 = 'style="display:none"';
}
elseif ($DHeader_theme=='header3') {
	$Dheader3_sel='selected'; $Dheader_view='<img id="header1img" src="'.GenerationPlugin_preview.'/headerD3.gif">';
	$DHeader_show1 = 'style="display:block"';
	$Header_bg1_name = 'name="Header_bg"';
	$Header_bg2_name = 'name=""';
	$DHeader_selectBgs1 = 'style="display:inline"';
	$DHeader_selectBgs2 = 'style="display:none"';
	$DHeader_uploadimage = 'style="display:block"';
	$DHeader_formshow = 'style="display:none"';
    $Dheaderf5_view = 'style="display:none"';
    $Dheaderf4_view = 'style="display:none"';
    $Dheaderf1_view = 'style="display:none"';
    $Dheader_adsection = 'style="display:none"';
    $Dheader_adsection2 = 'style="display:block"';
    $Dheader_preview2 = 'style="display:none"';
}
elseif ($DHeader_theme=='header11') {
	$Dheader11_sel='selected'; $Dheader_view='<img id="header1img" src="'.GenerationPlugin_preview.'/headerL1.gif">';
	$DHeader_show1 = 'style="display:block"';
	$Header_bg1_name = 'name=""';
	$Header_bg2_name = 'name="Header_bg"';
	$DHeader_selectBgs1 = 'style="display:none"';
	$DHeader_selectBgs2 = 'style="display:inline"';
	$DHeader_uploadimage = 'style="display:block"';
	$DHeader_formshow = 'style="display:block"';
    $Dheaderf5_view = 'style="display:none"';
    $Dheaderf4_view = 'style="display:none"';
    $Dheaderf1_view = 'style="display:block"';
    $Dheader_adsection = 'style="display:block"';
    $Dheader_adsection2 = 'style="display:none"';
}
elseif ($DHeader_theme=='header12') {
	$Dheader12_sel='selected'; $Dheader_view='<img id="header1img" src="'.GenerationPlugin_preview.'/headerL2.gif">';
	$DHeader_show1 = 'style="display:none"';
	$Header_bg1_name = 'name=""';
	$Header_bg2_name = 'name="Header_bg"';
	$DHeader_selectBgs1 = 'style="display:none"';
	$DHeader_selectBgs2 = 'style="display:inline"';
	$DHeader_uploadimage = 'style="display:none"';
	$DHeader_formshow = 'style="display:block"';
    $Dheaderf5_view = 'style="display:none"';
    $Dheaderf4_view = 'style="display:none"';
    $Dheaderf1_view = 'style="display:block"';
    $Dheader_adsection = 'style="display:block"';
    $Dheader_adsection2 = 'style="display:none"';
}
elseif ($DHeader_theme=='header13') {
	$Dheader13_sel='selected'; $Dheader_view='<img id="header1img" src="'.GenerationPlugin_preview.'/headerL3.gif">';
	$DHeader_show1 = 'style="display:block"';
	$Header_bg1_name = 'name=""';
	$Header_bg2_name = 'name="Header_bg"';
	$DHeader_selectBgs1 = 'style="display:none"';
	$DHeader_selectBgs2 = 'style="display:inline"';
	$DHeader_uploadimage = 'style="display:block"';
	$DHeader_formshow = 'style="display:none"';
    $Dheaderf5_view = 'style="display:none"';
    $Dheaderf4_view = 'style="display:none"';
    $Dheaderf1_view = 'style="display:none"';
    $Dheader_adsection = 'style="display:none"';
    $Dheader_adsection2 = 'style="display:block"';
    $Dheader_preview2 = 'style="display:none"';
}
else {
	$Dheader_view='<img id="header1img" src="'.GenerationPlugin_preview.'/headerD1.gif">';
	$DHeader_show1 = 'style="display:block"';
	$Header_bg1_name = 'name="Header_bg"';
	$Header_bg2_name = 'name=""';
	$DHeader_selectBgs1 = 'style="display:inline"';
	$DHeader_selectBgs2 = 'style="display:none"';
	$DHeader_uploadimage = 'style="display:block"';
	$DHeader_formshow = 'style="display:block"';
    $Dheaderf5_view = 'style="display:none"';
    $Dheaderf4_view = 'style="display:none"';
    $Dheaderf1_view = 'style="display:block"';
    $Dheader_adsection = 'style="display:block"';
    $Dheader_adsection2 = 'style="display:none"';
}

$DHeader_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_btncolor = preg_replace("/\\\/","",$DHeader_btncolor);
$DHeader_btncolor = explode("|", $DHeader_btncolor);
$DHeader_btncolor = $DHeader_btncolor[3];
if ($DHeader_btncolor=='stripe_darkred') {$DheaderB1_sel='selected';} //stripe design
elseif ($DHeader_btncolor=='stripe_red') {$DheaderB2_sel='selected';}
elseif ($DHeader_btncolor=='stripe_magenta') {$DheaderB3_sel='selected';}
elseif ($DHeader_btncolor=='stripe_violetmagenta') {$DheaderB4_sel='selected';}
elseif ($DHeader_btncolor=='stripe_violet') {$DheaderB5_sel='selected';}
elseif ($DHeader_btncolor=='stripe_blueviolet') {$DheaderB6_sel='selected';}
elseif ($DHeader_btncolor=='stripe_navyblue') {$DheaderB7_sel='selected';}
elseif ($DHeader_btncolor=='stripe_darkblue') {$DheaderB8_sel='selected';}
elseif ($DHeader_btncolor=='stripe_blue') {$DheaderB9_sel='selected';}
elseif ($DHeader_btncolor=='stripe_turquoise') {$DheaderB10_sel='selected';}
elseif ($DHeader_btncolor=='stripe_greenturquoise') {$DheaderB11_sel='selected';}
elseif ($DHeader_btncolor=='stripe_darkgreen') {$DheaderB12_sel='selected';}
elseif ($DHeader_btncolor=='stripe_green') {$DheaderB13_sel='selected';}
elseif ($DHeader_btncolor=='stripe_lemon') {$DheaderB14_sel='selected';}
elseif ($DHeader_btncolor=='stripe_yellow') {$DheaderB15_sel='selected';}
elseif ($DHeader_btncolor=='stripe_orange') {$DheaderB16_sel='selected';}
elseif ($DHeader_btncolor=='simple_darkred') {$DheaderB21_sel='selected';} //simple design
elseif ($DHeader_btncolor=='simple_red') {$DheaderB22_sel='selected';}
elseif ($DHeader_btncolor=='simple_magenta') {$DheaderB23_sel='selected';}
elseif ($DHeader_btncolor=='simple_violetmagenta') {$DheaderB24_sel='selected';}
elseif ($DHeader_btncolor=='simple_violet') {$DheaderB25_sel='selected';}
elseif ($DHeader_btncolor=='simple_blueviolet') {$DheaderB26_sel='selected';}
elseif ($DHeader_btncolor=='simple_navyblue') {$DheaderB27_sel='selected';}
elseif ($DHeader_btncolor=='simple_darkblue') {$DheaderB28_sel='selected';}
elseif ($DHeader_btncolor=='simple_blue') {$DheaderB29_sel='selected';}
elseif ($DHeader_btncolor=='simple_turquoise') {$DheaderB30_sel='selected';}
elseif ($DHeader_btncolor=='simple_greenturquoise') {$DheaderB31_sel='selected';}
elseif ($DHeader_btncolor=='simple_darkgreen') {$DheaderB32_sel='selected';}
elseif ($DHeader_btncolor=='simple_green') {$DheaderB33_sel='selected';}
elseif ($DHeader_btncolor=='simple_lemon') {$DheaderB34_sel='selected';}
elseif ($DHeader_btncolor=='simple_yellow') {$DheaderB35_sel='selected';}
elseif ($DHeader_btncolor=='simple_orange') {$DheaderB36_sel='selected';}

$DHeader_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_background = preg_replace("/\\\/","",$DHeader_background);
if ($DHeader_background=='bg2') {$DheaderBackground2_sel='selected';}
elseif ($DHeader_background=='bg3') {$DheaderBackground3_sel='selected';}
elseif ($DHeader_background=='bg4') {$DheaderBackground4_sel='selected';}
elseif ($DHeader_background=='bg12') {$DheaderBackground12_sel='selected';}
elseif ($DHeader_background=='bg13') {$DheaderBackground13_sel='selected';}
elseif ($DHeader_background=='bg14') {$DheaderBackground14_sel='selected';}

$DHeader_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_title_tmp = preg_replace("/\\\/","",$DHeader_title_tmp);
    $DHeader_title = explode("|", $DHeader_title_tmp);
	$DHeader_headclr = $DHeader_title[0];
	$DHeader_headtxt = $DHeader_title[1];
	$DHeader_headclr_c = $DHeader_title[2];
$DHeader_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_text = preg_replace("/\\\/","",$DHeader_text);
	
$DHeader_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_form_tmp = preg_replace("/\\\/","",$DHeader_form);
    $DHeader_formx = explode("|", $DHeader_form_tmp);
	$DHeader_form = $DHeader_formx[0];
	$DHeader_formtype = $DHeader_formx[1];
	$DHeader_clink = $DHeader_formx[2];
	$DHeader_cclick1 = $DHeader_formx[3];
	$DHeader_cblank = $DHeader_formx[4];
	if ($DHeader_cblank=="_blank") {$DHeader_cblank="checked";}
	$DHeader_cbgimage = $DHeader_formx[5];
	if ($DHeader_cbgimage!="") {$DHeader_cbgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
	$DHeader_cclick2 = $DHeader_formx[6];
	$DHeader_cwidth = $DHeader_formx[7];
	$DHeader_cheight = $DHeader_formx[8];
	$DHeader_cscroll = $DHeader_formx[9];
	if ($DHeader_cscroll=="scroll") {$DHeader_cscroll="checked";}
	$DHeader_cfullw = $DHeader_formx[10];
	if ($DHeader_cfullw=="fullw") {$DHeader_cfullw="checked";}
	$DHeader_bookmarkclr = $DHeader_formx[11];
	if ($DHeader_bookmarkclr=="dark") {$Dheaderf1b_sel="selected";}
	elseif ($DHeader_bookmarkclr=="light") {$Dheaderf2b_sel="selected";}

if (($DHeader_form=='regular' || $DHeader_form=='') && ($DHeader_theme!='header3' && $DHeader_theme!='header13')) {
	$Dheaderf1_sel='selected'; 
	$Dheaderf1_view='style="display:block"'; $Dheaderf2_view='style="display:block"'; $Dheaderf3_view='style="display:none"';
	$Dheaderf4_view='style="display:none"'; $Dheaderf5_view='style="display:none"';
	$Dheader_buttonss='style="display:block"'; $Dheader_adsection='style="display:block"';
	$Dheaderf1_view_right='style="display:block"';
	$DHeader_stheme = 'style="display:inline"'; $DHeader_stheme_label = 'style="display:inline"';
	$Dheader_preview1 = 'style="display:block"'; $Dheader_preview2 = 'style="display:none"';
}
elseif (($DHeader_form=='social') && ($DHeader_theme!='header3' && $DHeader_theme!='header13')) {
	$Dheaderf2_sel='selected'; 
	$Dheaderf1_view='style="display:none"'; $Dheaderf2_view='style="display:none"'; $Dheaderf3_view='style="display:none"';
	$Dheaderf4_view='style="display:none"'; $Dheaderf5_view='style="display:none"';
	$Dheader_buttonss='style="display:block"'; $Dheader_adsection='style="display:block"';
	$Dheaderf1_view_right='style="display:none"';
	$DHeader_stheme = 'style="display:inline"'; $DHeader_stheme_label = 'style="display:inline"';
	$Dheader_preview1 = 'style="display:block"'; $Dheader_preview2 = 'style="display:none"';
}
elseif (($DHeader_form=='both') && ($DHeader_theme!='header3' && $DHeader_theme!='header13')) {
	$Dheaderf12_sel='selected'; 
	$Dheaderf1_view='style="display:block"'; $Dheaderf2_view='style="display:block"'; $Dheaderf3_view='style="display:none"';
	$Dheaderf4_view='style="display:none"'; $Dheaderf5_view='style="display:none"';
	$Dheader_buttonss='style="display:block"'; $Dheader_adsection='style="display:block"';
	$Dheaderf1_view_right='style="display:block"';
	$DHeader_stheme = 'style="display:inline"'; $DHeader_stheme_label = 'style="display:inline"';
	$Dheader_preview1 = 'style="display:block"'; $Dheader_preview2 = 'style="display:none"';
	$Dheader_h2header = 'style="display:none"';
}
elseif (($DHeader_form=='link') && ($DHeader_theme!='header3' && $DHeader_theme!='header13')) {
	$Dheaderf3_sel='selected'; 
	$Dheaderf1_view='style="display:block"'; $Dheaderf2_view='style="display:none"'; $Dheaderf3_view='style="display:block"';
	$Dheaderf4_view='style="display:none"'; $Dheaderf5_view='style="display:none"';
	$Dheader_buttonss='style="display:block"'; $Dheader_adsection='style="display:block"';
	$Dheaderf1_view_right='style="display:none"';
	$DHeader_stheme = 'style="display:inline"'; $DHeader_stheme_label = 'style="display:inline"';
	$Dheader_preview1 = 'style="display:block"'; $Dheader_preview2 = 'style="display:none"';
}
elseif (($DHeader_form=='custom') && ($DHeader_theme!='header3' && $DHeader_theme!='header13')) {
	$Dheaderf4_sel='selected'; 
	$Dheaderf1_view='style="display:none"'; $Dheaderf2_view='style="display:none"'; $Dheaderf3_view='style="display:block"';
	$Dheaderf4_view='style="display:block"'; $Dheaderf5_view='style="display:block"';
	$Dheader_buttonss='style="display:none"'; $Dheader_adsection='style="display:none"';
	$Dheaderf1_view_right='style="display:none"';
	$DHeader_stheme = 'style="display:none"'; $DHeader_stheme_label = 'style="display:none"';
	$Dheader_preview1 = 'style="display:none"'; $Dheader_preview2 = 'style="display:block"';
}

if ($DHeader_formtype=='link' || $DHeader_formtype=='') {
	$Dheaderf10_sel='selected';
	$Dheaderf6_view='style="display:block"'; $Dheaderf7_view='style="display:none"';
}
elseif ($DHeader_formtype=='image') {
	$Dheaderf20_sel='selected';
	$Dheaderf6_view='style="display:none"'; $Dheaderf7_view='style="display:block"';
}
else {
	$Dheaderf10_sel='selected';
	$Dheaderf6_view='style="display:block"'; $Dheaderf7_view='style="display:none"';
}

$DHeader_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_regular_tmp = preg_replace("/\\\/","",$DHeader_regular_tmp);
    $DHeader_regular = explode("|", $DHeader_regular_tmp);
	$Header_fname = $DHeader_regular[0];
	$Header_femail = $DHeader_regular[1];
	$Header_fbtntxt = $DHeader_regular[2];
	$Header_fbtnclr = $DHeader_regular[3];
	if ($DHeader_regular[4]=="1") {$DHeader_name_disabled="checked";}

$DHeader_hey_tmp = stripslashes($wpdb->get_var('SELECT Hey FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_hey_tmp = preg_replace("/\\\/","",$DHeader_hey_tmp);
	$DHeader_hey = explode("|", $DHeader_hey_tmp);
	$Header_heytext = $DHeader_hey[0];
	$Header_heybutton = $DHeader_hey[1];
	$Header_heylink = $DHeader_hey[2];
	$Header_heytarget = $DHeader_hey[3];
	if ($Header_heytarget=="on") {$Header_heytarget="checked";}
	$Header_heycolor = $DHeader_hey[4];
	
$DHeader_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_spam = preg_replace("/\\\/","",$DHeader_spam);
$DHeader_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_optin = preg_replace("/<br>/","\n",$DHeader_optin);
	$DHeader_optin = preg_replace("/\\\/","",$DHeader_optin);
	$DHeader_optin = explode("|",$DHeader_optin);
	if ($DHeader_optin[4]=="on") {$DHeader_optinch="checked";}
$DHeader_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_header.' WHERE id='.$Duniqueid);
	if ($DHeader_active_tmp=="on") {$DHeader_active="checked";} else {$DHeader_activated='style="background-color:#FCC"';}

	//replace html br with \n before display in text field
	$DHeader_headtxt = preg_replace("/<br>/","\n",$DHeader_headtxt);
	$DHeader_text = preg_replace("/<br>/","\n",$DHeader_text);
	$DHeader_spam = preg_replace("/<br>/","\n",$DHeader_spam);
	
$DHeader_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_header.' WHERE id='.$Duniqueid));
    $DHeader_display = explode("|", $DHeader_displays);
	$DHeader_dpages = $DHeader_display[0];
	$DHeader_dcats = $DHeader_display[1];
	$DHeader_dposts = $DHeader_display[2];
	if (strpos($DHeader_dpages,'allpages')!==false) {$DHeader_dpagesall="checked";}
	if (strpos($DHeader_dcats,'allcats')!==false) {$DHeader_dcatsall="checked";}
	if (strpos($DHeader_dposts,'allposts')!==false) {$DHeader_dpostsall="checked";}
	//if ($DHeader_dpagesall=="" && $DHeader_dcatsall=="" && $DHeader_dpostsall=="") {$DHeader_dcheckall="";}
	$DHeader_showsub = $DHeader_display[3];
	if ($DHeader_showsub=="on") {$DHeader_showsub="checked";}
	$DHeader_ddelay = $DHeader_display[4];
	$DHeader_ddays = $DHeader_display[5];
	$DHeader_dstart = $DHeader_display[6];
	$DHeader_dstop = $DHeader_display[7];
?>

<script type="text/javascript">
function sh3_theme(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='1') {
        document.getElementById("Header_show1").style.display="block";
        document.getElementById("Header_selectBgs1").name="Header_bg";
        document.getElementById("Header_selectBgs2").name="";
        document.getElementById("Header_selectBgs1").style.display="inline";
        document.getElementById("Header_selectBgs2").style.display="none";
        document.getElementById("Header_uploadimage").style.display="block";
        document.getElementById("Header_form").style.display="block";
		document.getElementById("xchoice31").style.display="none";
		document.getElementById("ichoice32").style.display="none";
		document.getElementById("choice30").style.display="block";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_adsection2").style.display="none";
		$jj('#header1').html('<img id="header1img" src="<?php echo GenerationPlugin_preview.'/headerD1.gif'; ?>">');
	} else if(sel.selectedIndex=='2') {
        document.getElementById("Header_show1").style.display="none";
        document.getElementById("Header_selectBgs1").name="Header_bg";
        document.getElementById("Header_selectBgs2").name="";
        document.getElementById("Header_selectBgs1").style.display="inline";
        document.getElementById("Header_selectBgs2").style.display="none";
        document.getElementById("Header_uploadimage").style.display="none";
        document.getElementById("Header_form").style.display="block";
		document.getElementById("xchoice31").style.display="none";
		document.getElementById("ichoice32").style.display="none";
		document.getElementById("choice30").style.display="block";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_adsection2").style.display="none";
		$jj('#header1').html('<img id="header1img" src="<?php echo GenerationPlugin_preview.'/headerD2.gif'; ?>">');
	} else if(sel.selectedIndex=='3' || sel.selectedIndex=='4') {
        document.getElementById("Header_show1").style.display="block";
        document.getElementById("Header_selectBgs1").name="Header_bg";
        document.getElementById("Header_selectBgs2").name="";
        document.getElementById("Header_selectBgs1").style.display="inline";
        document.getElementById("Header_selectBgs2").style.display="none";
        document.getElementById("Header_uploadimage").style.display="block";
        document.getElementById("Header_form").style.display="none";
		document.getElementById("xchoice31").style.display="none";
		document.getElementById("ichoice32").style.display="none";
		document.getElementById("choice30").style.display="none";
		document.getElementById("Header_adsection").style.display="none";
		document.getElementById("Header_adsection2").style.display="block";
		$jj('#header1').html('<img id="header1img" src="<?php echo GenerationPlugin_preview.'/headerD3.gif'; ?>">');
	} else if(sel.selectedIndex=='5' || sel.selectedIndex=='6') {
        document.getElementById("Header_show1").style.display="block";
        document.getElementById("Header_selectBgs1").name="";
        document.getElementById("Header_selectBgs2").name="Header_bg";
        document.getElementById("Header_selectBgs1").style.display="none";
        document.getElementById("Header_selectBgs2").style.display="inline";
        document.getElementById("Header_uploadimage").style.display="block";
        document.getElementById("Header_form").style.display="block";
		document.getElementById("xchoice31").style.display="none";
		document.getElementById("ichoice32").style.display="none";
		document.getElementById("choice30").style.display="block";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_adsection2").style.display="none";
		$jj('#header1').html('<img id="header1img" src="<?php echo GenerationPlugin_preview.'/headerL1.gif'; ?>">');
	} else if(sel.selectedIndex=='7') {
        document.getElementById("Header_show1").style.display="none";
        document.getElementById("Header_selectBgs1").name="";
        document.getElementById("Header_selectBgs2").name="Header_bg";
        document.getElementById("Header_selectBgs1").style.display="none";
        document.getElementById("Header_selectBgs2").style.display="inline";
        document.getElementById("Header_uploadimage").style.display="none";
        document.getElementById("Header_form").style.display="block";
		document.getElementById("xchoice31").style.display="none";
		document.getElementById("ichoice32").style.display="none";
		document.getElementById("choice30").style.display="block";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_adsection2").style.display="none";
		$jj('#header1').html('<img id="header1img" src="<?php echo GenerationPlugin_preview.'/headerL2.gif'; ?>">');
	} else if(sel.selectedIndex=='8') {
        document.getElementById("Header_show1").style.display="block";
        document.getElementById("Header_selectBgs1").name="";
        document.getElementById("Header_selectBgs2").name="Header_bg";
        document.getElementById("Header_selectBgs1").style.display="none";
        document.getElementById("Header_selectBgs2").style.display="inline";
        document.getElementById("Header_uploadimage").style.display="block";
        document.getElementById("Header_form").style.display="none";
		document.getElementById("xchoice31").style.display="none";
		document.getElementById("ichoice32").style.display="none";
		document.getElementById("choice30").style.display="none";
		document.getElementById("Header_adsection").style.display="none";
		document.getElementById("Header_adsection2").style.display="block";
		$jj('#header1').html('<img id="header1img" src="<?php echo GenerationPlugin_preview.'/headerL3.gif'; ?>">');
	}
}
$jj(document).ready(function(){
	$jj("#Header_name").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Header_email").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Header_btntxt").charCount({allowed:18, warning:0, /*counterText:'left: '*/});
	$jj("#Header_headtxt").charCount({allowed:25, warning:0, /*counterText:'left: '*/});
	$jj("#Header_headdes").charCount({allowed:50, warning:0, /*counterText:'left: '*/});
	$jj("#Header_spam").charCount({allowed:45, warning:0, /*counterText:'left: '*/});
});
</script>


        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DHeader_activated; ?>>
				<input name="Header_active" type="checkbox" <?php echo $DHeader_active; ?>> Activate Header Panel
			</div>
			
            <select name="Header_theme" id="selectheader" onchange="sh3_theme(this)" <?php echo $DHeader_stheme; ?>>
				<option value="header1" style="color:#069; font-weight:bold">Graphite themes</option>
                <option value="header1" <?php echo $Dheader1_sel; ?>>standard</option>
                <option value="header2" <?php echo $Dheader2_sel; ?>>mini</option>
                <option value="header3" <?php echo $Dheader3_sel; ?>>hey bar</option>
				<option value="header2">&nbsp;</option>
				<option value="header11" style="color:#069; font-weight:bold">Silver themes</option>
                <option value="header11" <?php echo $Dheader11_sel; ?>>standard</option>
                <option value="header12" <?php echo $Dheader12_sel; ?>>mini</option>
                <option value="header13" <?php echo $Dheader13_sel; ?>>hey bar</option>
            </select> <span id="selectheader_label" <?php echo $DHeader_stheme_label; ?>>Template</span>
			<div id="Header_form" <?php echo $DHeader_formshow; ?>>
    			<select name="Header_form" onchange="sh3(this)">
    				<option value="regular" <?php echo $Dheaderf1_sel; ?>>regular</option>
    				<option value="social" <?php echo $Dheaderf2_sel; ?>>facebook</option>
    				<option value="both" <?php echo $Dheaderf12_sel; ?>>regular and facebook switch</option>
    				<option value="link" <?php echo $Dheaderf3_sel; ?>>link</option>
    				<option value="custom" <?php echo $Dheaderf4_sel; ?>>custom content</option>
    			</select> Type of sign-up form
			</div>
			<div id="xchoice31" <?php echo $Dheaderf5_view; ?>>
    			<select name="Header_ccontent" onchange="sh30(this)">
    				<option value="link" <?php echo $Dheaderf10_sel; ?>>webpage</option>
    				<option value="image" <?php echo $Dheaderf20_sel; ?>>image</option>
    			</select> Type of custom content
			</div>
			
			<div id="ichoice32" <?php echo $Dheaderf4_view; ?>>
				<input name="Header_cwidth" type="text" value="<?php echo $DHeader_cwidth; ?>"> Box width in pixels
        		<br/>
				<input name="Header_cfullw" type="checkbox" value="fullw" <?php echo $DHeader_cfullw; ?>> ...or display in full width
        		<br/>
				<input name="Header_cheight" type="text" value="<?php echo $DHeader_cheight; ?>"> Box height in pixels
				<input style="display:none" name="Header_cscroll" type="checkbox" value="scroll" <?php echo $DHeader_cscroll; ?>>
				<div id="ichoice33" <?php echo $Dheaderf6_view; ?>>
					<input name="Header_clink" type="text" value="<?php echo $DHeader_clink; ?>">
					<img id="helpbtn_header8" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        			<span class="maxfile" id="helptip_header8">URLs starting with 'https://' will not open in box due to security reasons.</span> Link to webpage
				</div>
				<div id="ichoice34" <?php echo $Dheaderf7_view; ?>>
					<input name="Header_cbg" type="file" size="26">
        			<?php if (filesize($DHeader_cbgimage)>=1048576) { ?>
        				<img id="helpbtn_header9" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
        				<span class="maxfilewarning" id="helptip_header9">Max 1Mb!</span>
        			<?php } else { ?>
        				<img id="helpbtn_header9" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        				<span class="maxfile" id="helptip_header9">Max 1Mb</span>
        			<?php } ?>
        			<?php echo $DHeader_cbgimage_img; ?>
					<span style="display:inline; margin-bottom:100px">Upload an image...</span>
        			<br/>
        			<input name="Header_cbgremove" type="checkbox"> Remove uploaded image
					<br/>
    				<input name="Header_cclick1" type="text" value="<?php echo $DHeader_cclick1; ?>"> ...or use external image
					<br/>
    				<input name="Header_cclick2" type="text" value="<?php echo $DHeader_cclick2; ?>"> Link for <i>click</i> action
					<br/>
					<input name="Header_cblank" type="checkbox" value="_blank" <?php echo $DHeader_cblank; ?>> Open the link in new tab
				</div>
    			<select name="Header_bookmarkclr">
    				<option value="dark" <?php echo $Dheaderf1b_sel; ?>>dark</option>
    				<option value="light" <?php echo $Dheaderf2b_sel; ?>>light</option>
    			</select> Background color
			</div>
			
            <div id="choice30" name="choice31" <?php echo $Dheaderf1_view; ?>>
				<div id="ichoice30" <?php echo $Dheaderf2_view; ?>>
					<div id="Header_show1" <?php echo $DHeader_show1; ?>>
    					<input id="Header_name" name="Header_name" type="text" value="<?php echo $Header_fname; ?>"> 'Name' default value
					<br/>
					<input name="Header_name_disabled" type="checkbox" value="1" <?php echo $DHeader_name_disabled; ?>> Do not show 'Name' field in form
                    <br/>
					</div>
                    <input id="Header_email" name="Header_email" type="text" value="<?php echo $Header_femail; ?>"> 'Email' default value
                    <br/>
				</div>
				<div id="ichoice31" <?php echo $Dheaderf3_view; ?>>	
					<input name="Header_link" type="text" value="<?php echo $DHeader_link; ?>"> Destin. page
					<br/>
					<input name="Header_link_blank" type="checkbox" value="_blank" <?php echo $DHeader_link_blank; ?>> Open the page in new tab
					<br/>
				</div>
				
				<div id="Header_buttonss" <?php echo $Dheader_buttonss; ?>>
                <input id="Header_btntxt" name="Header_btntxt" type="text" value="<?php echo $Header_fbtntxt; ?>"> Button text
                <br/>
				<select name="Header_btnclr" id="selectButtons">
					<option style="margin-left:-136px; color:#069; font-weight:bold">Stripe design</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark.gif'; ?>)" 
						value="stripe_darkred" <?php echo $DheaderB1_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red.gif'; ?>)" 
						value="stripe_red" <?php echo $DheaderB2_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta.gif'; ?>)" 
						value="stripe_magenta" <?php echo $DheaderB3_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta.gif'; ?>)" 
						value="stripe_violetmagenta" <?php echo $DheaderB4_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet.gif'; ?>)" 
						value="stripe_violet" <?php echo $DheaderB5_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet.gif'; ?>)" 
						value="stripe_blueviolet" <?php echo $DheaderB6_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy.gif'; ?>)" 
						value="stripe_navyblue" <?php echo $DheaderB7_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark.gif'; ?>)" 
						value="stripe_darkblue" <?php echo $DheaderB8_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue.gif'; ?>)" 
						value="stripe_blue" <?php echo $DheaderB9_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise.gif'; ?>)" 
						value="stripe_turquoise" <?php echo $DheaderB10_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise.gif'; ?>)" 
						value="stripe_greenturquoise" <?php echo $DheaderB11_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark.gif'; ?>)" 
						value="stripe_darkgreen" <?php echo $DheaderB12_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green.gif'; ?>)" 
						value="stripe_green" <?php echo $DheaderB13_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon.gif'; ?>)" 
						value="stripe_lemon" <?php echo $DheaderB14_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow.gif'; ?>)" 
						value="stripe_yellow" <?php echo $DheaderB15_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange.gif'; ?>)" 
						value="stripe_orange" <?php echo $DheaderB16_sel; ?>>orange</option>
					<option>&nbsp;</option>
					<option style="margin-left:-136px; color:#069; font-weight:bold">Simple design</option>
					<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark2.gif'; ?>)" 
						value="simple_darkred" <?php echo $DheaderB21_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red2.gif'; ?>)" 
						value="simple_red" <?php echo $DheaderB22_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta2.gif'; ?>)" 
						value="simple_magenta" <?php echo $DheaderB23_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta2.gif'; ?>)" 
						value="simple_violetmagenta" <?php echo $DheaderB24_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet2.gif'; ?>)" 
                        value="simple_violet" <?php echo $DheaderB25_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet2.gif'; ?>)" 
  						value="simple_blueviolet" <?php echo $DheaderB26_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy2.gif'; ?>)" 
						value="simple_navyblue" <?php echo $DheaderB27_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark2.gif'; ?>)" 
						value="simple_darkblue" <?php echo $DheaderB28_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue2.gif'; ?>)" 
						value="simple_blue" <?php echo $DheaderB29_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise2.gif'; ?>)" 
						value="simple_turquoise" <?php echo $DheaderB30_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise2.gif'; ?>)" 
						value="simple_greenturquoise" <?php echo $DheaderB31_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark2.gif'; ?>)" 
						value="simple_darkgreen" <?php echo $DheaderB32_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green2.gif'; ?>)" 
						value="simple_green" <?php echo $DheaderB33_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon2.gif'; ?>)" 
						value="simple_lemon" <?php echo $DheaderB34_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow2.gif'; ?>)" 
						value="simple_yellow" <?php echo $DheaderB35_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange2.gif'; ?>)" 
						value="simple_orange" <?php echo $DheaderB36_sel; ?>>orange</option>
				</select> Button color
				</div>
			</div>
			
			<div id="Header_adsection" <?php echo $Dheader_adsection; ?>>
			
            <input name="Header_headclr" type="text" id="colorheader" value="<?php echo $DHeader_headclr; ?>" />
			<div style="margin:0 0 -25px 235px">
				<input style="position:absolute; margin:5px 0 0 -21px" name="Header_headclr_c" type="checkbox" value="on" <?php if ($DHeader_headclr_c=="on") {echo "checked";} ?> />
				<img id="helpbtn_header5" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="headclrhelp" id="helptip_header5">Pick your color and check the checkbox to setup headers color different than button color.</span>
				Custom headers color
			</div>
            <br/>
			<div id="Header_h2header" <?php echo $Dheader_h2header; ?>>
    			<textarea id="Header_headtxt" name="Header_headtxt"><?php echo $DHeader_headtxt; ?></textarea>
    			<img id="helpbtn_header6" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
    			<span class="countdownhelp" id="helptip_header6">Use number in brackets (max '90') to add countdown timer. Number in brackets = minutes, e.g.(57).</span>
    			Header text
                <br/>
			</div>
            <textarea id="Header_headdes" name="Header_headdes"><?php echo $DHeader_text; ?></textarea> Header description
            <br/>
            <textarea class="m8px" id="Header_spam" name="Header_spam"><?php echo $DHeader_spam; ?></textarea> Anti-spam note
            <br/>
			<select <?php echo $Header_bg1_name; ?> id="Header_selectBgs1" <?php echo $DHeader_selectBgs1; ?>>
					<option style="margin-left:-136px">Dark backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_noise.gif'; ?>)" 
						value="bg2" <?php echo $DheaderBackground2_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_carbonfiber.gif'; ?>)" 
						value="bg3" <?php echo $DheaderBackground3_sel; ?>>carbon fiber</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_wood.gif'; ?>)" 
						value="bg4" <?php echo $DheaderBackground4_sel; ?>>wood</option>
			</select>	
			<select <?php echo $Header_bg2_name; ?> id="Header_selectBgs2" <?php echo $DHeader_selectBgs2; ?>>
					<option style="margin-left:-136px">Light backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_noise.gif'; ?>)" 
						value="bg12" <?php echo $DheaderBackground12_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_sparkles.gif'; ?>)" 
						value="bg13" <?php echo $DheaderBackground13_sel; ?>>sparkles</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_blur.gif'; ?>)" 
						value="bg14" <?php echo $DheaderBackground14_sel; ?>>blur</option>
			</select> <span style="display:inline">Product background</span>
			<br/>
            <input name="Header_bg" type="file" size="26">
			<?php if (filesize($DHeader_bgimage)>=307201) { ?>
				<img id="helpbtn_header3" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_header3">Max 300kb!</span>
			<?php } else { ?>
				<img id="helpbtn_header3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_header3">Max 300kb</span>
			<?php } ?>
			<?php echo $DHeader_bgimage_img; ?>
			<br/>
			<input name="Header_bgremove" type="checkbox"> Remove uploaded background
			<br/>
			<div id="Header_uploadimage" <?php echo $DHeader_uploadimage; ?>>
                <input class="m8px" name="Header_file" type="file" size="26">
    			<?php if (filesize($DHeader_image)>=81921) { ?>
    				<img id="helpbtn_header4" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
    				<span class="maxfilewarning" id="helptip_header4">Max 70kb! (170x100px)</span>
    			<?php } else { ?>
    				<img id="helpbtn_header4" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
    				<span class="maxfile" id="helptip_header4">Max 70kb (170x100px)</span>
    			<?php } ?>
    			<?php echo $DHeader_image_img; ?> Product image
    			<br/>
    			<input name="Header_fileremove" type="checkbox"> Remove uploaded image
			</div>
        </div>
		
		<div id="Header_adsection2" <?php echo $Dheader_adsection2; ?>>
			<input name="Header_heycolor" type="text" id="colorhey" value="<?php echo $Header_heycolor; ?>" />
			&nbsp;Hey background color
			<br/>
			<textarea style="margin-top:3px" name="Header_heytext" ><?php echo $Header_heytext; ?></textarea> Hey text
			<br/>
			<input class="m8px" name="Header_heybutton" type="text" value="<?php echo $Header_heybutton; ?>"> Hey button text
			<br/>
			<input name="Header_heylink" type="text" value="<?php echo $Header_heylink; ?>"> Hey link to webpage
			<br/>
			<input name="Header_heytarget" type="checkbox" <?php echo $Header_heytarget; ?>> Open link in new tab
		</div>
		
        </div>
            
        <div class="right_section" id="header_checkboxes">
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_header1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_header1">Click here to show options.</span>
			</h4>
            <div class="toggle">
				<input style="display:inline-block;" type="checkbox" name="Header_pagelist[]" value="allpages" <?php echo $DHeader_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DHeader_dpages_front="front";
				if (strpos(','.$DHeader_dpages.',',',front,')!==false || $DHeader_displays=="") {$DHeader_dpagesch[$DHeader_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Header_pagelist[]" value="front" '.$DHeader_dpagesch[$DHeader_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DHeader_dpages_search="search";
				if (strpos(','.$DHeader_dpages.',',',search,')!==false || $DHeader_displays=="") {$DHeader_dpagesch[$DHeader_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Header_pagelist[]" value="search" '.$DHeader_dpagesch[$DHeader_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DHeader_dpages_author="author";
				if (strpos(','.$DHeader_dpages.',',',author,')!==false || $DHeader_displays=="") {$DHeader_dpagesch[$DHeader_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Header_pagelist[]" value="author" '.$DHeader_dpagesch[$DHeader_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order'); 
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DHeader_dpages.',',','.trim($pageID).',')!==false || $DHeader_displays=="") {$DHeader_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Header_pagelist[]" value="'.$pageID.'" '.$DHeader_dpagesch[$pageID].'>';
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
 							if (strpos(','.$DHeader_dpages.',',','.trim($childID).',')!==false || $DHeader_displays=="") {$DHeader_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Header_pagelist[]" value="'.$childID.'" '.$DHeader_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Header_catlist[]" value="allcats" <?php echo $DHeader_dcatsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DHeader_dcats.',',','.trim($cat_id).',')!==false || $DHeader_displays=="") {$DHeader_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Header_catlist[]" value="'.$cat_id.'" '.$DHeader_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Header_postlist[]" value="allposts" <?php echo $DHeader_dpostsall; ?>>
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
							if (strpos(','.$DHeader_dposts.',',','.trim($id).',')!==false || $DHeader_displays=="") {$DHeader_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Header_postlist[]" value="'.$id.'" '.$DHeader_dpostsch[$id].'>&nbsp;';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="Header_showsub" <?php echo $DHeader_showsub; ?>>
					&nbsp;<span style="color:#069">Do NOT show to subscribers</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="header_checkboxes_switch" <?php echo $DHeader_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				Show after <input class="showdelay" name="Header_ddelay" type="text" value="<?php echo $DHeader_ddelay; ?>"> seconds<br>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Header_dstart" type="text" value="<?php echo $DHeader_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Header_dstop" type="text" value="<?php echo $DHeader_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Header_ddays" type="text" value="<?php echo $DHeader_ddays; ?>"> days<br>
				-->
				
            </div>
			
			<h4 id="right_choice30" class="hiddens" <?php echo $Dheaderf1_view_right; ?>>
				Opt-in settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_header7" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_header7">Click here to show options.</span>
			</h4>
            <div id="Header_optin" class="toggle" <?php echo $Dheaderf1_view_right; ?>>
					<div class="gpadminoptional" style="margin-bottom:0; width:535px">
						Make sure there is data in 'form action' field. Otherwise change 'form' to 'formc' in your opt-in code.
					</div>
                    <textarea name="Header_optin1" id="gpoptinform_header"><?php echo str_replace(":::","|",$DHeader_optin[0]); ?></textarea> Opt-in code<br/>
                    <div id="gpformarea_header" style="display:none"></div>
                    <input type="button" value="Process" id="gpproccessit_header"><br/>
					<textarea style="margin:3px 0" name="Header_optin5" id="gpformaction_header"><?php echo $DHeader_optin[4]; ?></textarea> form action<br/>
                    <select name="Header_optin2" id="gpnamefield_header">
    					<option value="<?php echo $DHeader_optin[1]; ?>"><?php echo $DHeader_optin[1]; ?></option>
    				</select> 'NAME' field<br/>
                    <select name="Header_optin3" id="gpemailfield_header">
    					<option value="<?php echo $DHeader_optin[2]; ?>"><?php echo $DHeader_optin[2]; ?></option>
    				</select> 'EMAIL' field<br/>
                    <!-- <input name="Header_optin4" value="on" type="checkbox" id="gpdisablename_header" <?php echo $DHeader_optinch; ?>> disable NAME field<br/> -->
                    <input type="checkbox" id="gpshowalldata_header"> show all processed data<br/>
                    <div id="gpalldata_header" style="display:none">
                        <textarea name="Header_optin6" id="gphiddenfields_header"><?php echo $DHeader_optin[5]; ?></textarea> hidden fields<br/>
                        <textarea name="Header_optin7" id="gpignoredfields_header"><?php echo $DHeader_optin[6]; ?></textarea> ignored fields<br/>
                        <textarea name="Header_optin8" id="gpotherfields_header"><?php echo $DHeader_optin[7]; ?></textarea> other fields<br/>
                        <textarea name="Header_optin9" id="gpsubmitbutton_header"><?php echo $DHeader_optin[8]; ?></textarea> submit button<br/>
                    </div><br/>
			</div>
			
        	<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_header2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_header2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="header1" class="preview3" <?php echo $Dheader_preview1; ?>><?php echo $Dheader_view; ?></div>
			<div id="header2" class="preview3" <?php echo $Dheader_preview2; ?>><img src="<?php echo GenerationPlugin_preview.'/headerCC.gif'; ?>"></div>
        </div>

		
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_header" type="hidden" value="Save Changes">
    		<input id="Savepreview_header" name="Savepreview_header" type="hidden" value="Savepreview_header">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_header').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div>  
