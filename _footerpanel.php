<div id="tab4" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_footer" enctype="multipart/form-data">


<?php
if (isset($_POST['displayingformsent_footer'])=='Save Changes') {

	//multiple values into one database cell
	if ($_POST['Footer_headclr_c']=="on") {$Footer_headclr=$_POST['Footer_headclr'];}
	elseif ($_POST['Footer_form']=="social") {$Footer_headclr="0d66ae";}
	elseif ($_POST['Footer_btnclr']=="stripe_darkred" || $_POST['Footer_btnclr']=="simple_darkred") {$Footer_headclr="a92e20";}
	elseif ($_POST['Footer_btnclr']=="stripe_red" || $_POST['Footer_btnclr']=="simple_red") {$Footer_headclr="d53929";}
	elseif ($_POST['Footer_btnclr']=="stripe_magenta" || $_POST['Footer_btnclr']=="simple_magenta") {$Footer_headclr="c73272";}
	elseif ($_POST['Footer_btnclr']=="stripe_violetmagenta" || $_POST['Footer_btnclr']=="simple_violetmagenta") {$Footer_headclr="b940b3";}
	elseif ($_POST['Footer_btnclr']=="stripe_violet" || $_POST['Footer_btnclr']=="simple_violet") {$Footer_headclr="6c4ab2";}
	elseif ($_POST['Footer_btnclr']=="stripe_blueviolet" || $_POST['Footer_btnclr']=="simple_blueviolet") {$Footer_headclr="4442ad";}
	elseif ($_POST['Footer_btnclr']=="stripe_navyblue" || $_POST['Footer_btnclr']=="simple_navyblue") {$Footer_headclr="286c9e";}
	elseif ($_POST['Footer_btnclr']=="stripe_darkblue" || $_POST['Footer_btnclr']=="simple_darkblue") {$Footer_headclr="387dab";}
	elseif ($_POST['Footer_btnclr']=="stripe_blue" || $_POST['Footer_btnclr']=="simple_blue") {$Footer_headclr="299eb9";}
	elseif ($_POST['Footer_btnclr']=="stripe_turquoise" || $_POST['Footer_btnclr']=="simple_turquoise") {$Footer_headclr="38b5af";}
	elseif ($_POST['Footer_btnclr']=="stripe_greenturquoise" || $_POST['Footer_btnclr']=="simple_greenturquoise") {$Footer_headclr="2cc183";}
	elseif ($_POST['Footer_btnclr']=="stripe_darkgreen" || $_POST['Footer_btnclr']=="simple_darkgreen") {$Footer_headclr="5ca138";}
	elseif ($_POST['Footer_btnclr']=="stripe_green" || $_POST['Footer_btnclr']=="simple_green") {$Footer_headclr="93b73f";}
	elseif ($_POST['Footer_btnclr']=="stripe_lemon" || $_POST['Footer_btnclr']=="simple_lemon") {$Footer_headclr="d6ce28";}
	elseif ($_POST['Footer_btnclr']=="stripe_yellow" || $_POST['Footer_btnclr']=="simple_yellow") {$Footer_headclr="d1bd26";}
	elseif ($_POST['Footer_btnclr']=="stripe_orange" || $_POST['Footer_btnclr']=="simple_orange") {$Footer_headclr="e68f1b";}
	else {$Footer_headclr="CC3300";}
	$Footer_head = "#".trim($Footer_headclr."|".$_POST['Footer_headtxt']."|".$_POST['Footer_headclr_c'], "#");
	$Footer_regular = $_POST['Footer_name']."|".$_POST['Footer_email']."|".$_POST['Footer_btntxt']."|".$_POST['Footer_btnclr']."|".$_POST['Footer_name_disabled'];
	$Footer_social = "facebook";
	$Footer_background = $_POST['Footer_bg']."|".$_POST['Footer_screencolor']."|".$_POST['Footer_screenopacity'];
	$Footer_optin = trim(str_replace("|",":::",$_POST['Footer_optin1']))."|".trim($_POST['Footer_optin2'])."|".trim($_POST['Footer_optin3'])."|".trim($_POST['Footer_optin4'])."|".trim($_POST['Footer_optin5'])."|".trim($_POST['Footer_optin6'])."|".trim($_POST['Footer_optin7'])."|".trim($_POST['Footer_optin8'])."|".trim($_POST['Footer_optin9']);
    $Footer_optin = str_replace(array("\r\n", "\r", "\n"), '<br>', $Footer_optin);

	//image upload
	$Footer_file = $_FILES['Footer_file']['name'];
	$Footer_fileremove = $_POST['Footer_fileremove'];
	if ($Footer_fileremove=='on') {$Footer_file='';}
    $Footer_path = GenerationPlugin_uploads.basename($Footer_file);
    if (move_uploaded_file($_FILES['Footer_file']['tmp_name'], $Footer_path)) {
        $Footer_array = explode('.',$Footer_file);
        $Footer_exten = $Footer_array[count($Footer_array)-1];
    	if (isset($_POST['Savepreview_footer'])) {
			$Footer_image = GenerationPlugin_uploads.'Footer_image.'.$Footer_exten;
			$Footer_image_db = GenerationPlugin_uploads_db.'Footer_image.'.$Footer_exten;
        	rename($Footer_path, $Footer_image);
		}
        $Footer_image_preview = GenerationPlugin_uploads.'Footer_image_preview.'.$Footer_exten;
        $Footer_image_preview_db = GenerationPlugin_uploads_db.'Footer_image_preview.'.$Footer_exten;
		if ($Footer_image!='') { copy($Footer_image, $Footer_image_preview); }
        rename($Footer_path, $Footer_image_preview);
    } else {
        $Footer_image = $wpdb->get_var('SELECT Image FROM '.$table_name_footer.' WHERE id='.$Duniqueid);
        $Footer_image_preview = $Footer_image_preview_db = $Footer_image_db = $Footer_image;
    }
	if (isset($_POST['Savepreview_footer'])) {
   		if ($Footer_fileremove=='on') {$Footer_image=''; $Footer_image_db='';}
	}
	if ($Footer_fileremove=='on') {$Footer_image_preview=''; $Footer_image_preview_db='';}
	
	//background upload
	$Footer_bgfile = $_FILES['Footer_bg']['name'];
	$Footer_bgfileremove = $_POST['Footer_bgremove'];
	if ($Footer_bgfileremove=='on') {$Footer_bgfile='';}
    $Footer_bgpath = GenerationPlugin_uploads.basename($Footer_bgfile);
    if (move_uploaded_file($_FILES['Footer_bg']['tmp_name'], $Footer_bgpath)) {
        $Footer_bgarray = explode('.',$Footer_bgfile);
        $Footer_bgexten = $Footer_bgarray[count($Footer_bgarray)-1];
    	if (isset($_POST['Savepreview_footer'])) {
			$Footer_bgimage = GenerationPlugin_uploads.'Footer_bgimage.'.$Footer_bgexten;
			$Footer_bgimage_db = GenerationPlugin_uploads_db.'Footer_bgimage.'.$Footer_bgexten;
        	rename($Footer_bgpath, $Footer_bgimage);
		}
        $Footer_bgimage_preview = GenerationPlugin_uploads.'Footer_bgimage_preview.'.$Footer_bgexten;
        $Footer_bgimage_preview_db = GenerationPlugin_uploads_db.'Footer_bgimage_preview.'.$Footer_bgexten;
		if ($Footer_bgimage!='') { copy($Footer_bgimage, $Footer_bgimage_preview); }
        rename($Footer_bgpath, $Footer_bgimage_preview);
    } else {
        $Footer_bgimage = $wpdb->get_var('SELECT Bgimage FROM '.$table_name_footer.' WHERE id='.$Duniqueid);
        $Footer_bgimage_preview = $Footer_bgimage_preview_db = $Footer_bgimage_db = $Footer_bgimage;
    }
	if (isset($_POST['Savepreview_footer'])) {
   		if ($Footer_bgfileremove=='on') {$Footer_bgimage=''; $Footer_bgimage_db='';}
	}
	if ($Footer_bgfileremove=='on') {$Footer_bgimage_preview=''; $Footer_bgimage_preview_db='';}

	//custom content image upload
	$Footer_cbgfile = $_FILES['Footer_cbg']['name'];
	$Footer_cbgfileremove = $_POST['Footer_cbgremove'];
	if ($Footer_cbgfileremove=='on') {$Footer_cbgfile='';}
    $Footer_cbgpath = GenerationPlugin_uploads.basename($Footer_cbgfile);
    if (move_uploaded_file($_FILES['Footer_cbg']['tmp_name'], $Footer_cbgpath)) {
        $Footer_cbgarray = explode('.',$Footer_cbgfile);
        $Footer_cbgexten = $Footer_cbgarray[count($Footer_cbgarray)-1];
		if (isset($_POST['Savepreview_footer'])) {
			$Footer_cbgimage = GenerationPlugin_uploads.'Footer_cbgimage.'.$Footer_cbgexten;
			$Footer_cbgimage_db = GenerationPlugin_uploads_db.'Footer_cbgimage.'.$Footer_cbgexten;
        	rename($Footer_cbgpath, $Footer_cbgimage);
		}
        $Footer_cbgimage_preview = GenerationPlugin_uploads.'Footer_cbgimage_preview.'.$Footer_cbgexten;
        $Footer_cbgimage_preview_db = GenerationPlugin_uploads_db.'Footer_cbgimage_preview.'.$Footer_cbgexten;
		if ($Footer_cbgimage!='') { copy($Footer_cbgimage, $Footer_cbgimage_preview); }
        rename($Footer_cbgpath, $Footer_cbgimage_preview);
    } else {
    	$Footer_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
    	$Footer_form_tmp = preg_replace("/\\\/","",$Footer_form);
        $Footer_formx = explode("|", $Footer_form_tmp);
    	$Footer_cbgimage = $Footer_formx[5];
        $Footer_cbgimage_preview = $Footer_cbgimage_preview_db = $Footer_cbgimage_db = $Footer_cbgimage;
    }
	if (isset($_POST['Savepreview_footer'])) {
   		if ($Footer_cbgfileremove=='on') {$Footer_cbgimage=''; $Footer_cbgimage_db='';}
	}
	if ($Footer_cbgfileremove=='on') {$Footer_cbgimage_preview=''; $Footer_cbgimage_preview_db='';}
	
	$Footer_form = $_POST['Footer_form']."|".$_POST['Footer_ccontent']."|".$_POST['Footer_clink']."|".$_POST['Footer_cclick1']."|".$_POST['Footer_cblank']."|".$Footer_cbgimage_db."|".$_POST['Footer_cclick2']."|".$_POST['Footer_cwidth']."|".$_POST['Footer_cheight']."|".$_POST['Footer_cscroll']."|".$_POST['Footer_cfullw']."|".$_POST['Footer_bookmarkclr'];
	$Footer_form_preview = $_POST['Footer_form']."|".$_POST['Footer_ccontent']."|".$_POST['Footer_clink']."|".$_POST['Footer_cclick1']."|".$_POST['Footer_cblank']."|".$Footer_cbgimage_preview_db."|".$_POST['Footer_cclick2']."|".$_POST['Footer_cwidth']."|".$_POST['Footer_cheight']."|".$_POST['Footer_cscroll']."|".$_POST['Footer_cfullw']."|".$_POST['Footer_bookmarkclr'];
	$Footer_startdate = $_POST['Footer_dstart'];
	if ($_POST['Footer_ddays']=="") { $Footer_days = ""; }
	elseif ($Footer_startdate!="") { $Footer_days = date("Y-m-d", strtotime($Footer_startdate." + ".$_POST['Footer_ddays']." days")); }
	else { $Footer_days = date("Y-m-d", strtotime(" + ".$_POST['Footer_ddays']." days")); }
	$Footer_display = implode(',',$_POST['Footer_pagelist']).'|'.implode(',',$_POST['Footer_catlist']).'|'.implode(',',$_POST['Footer_postlist']).'|'.$_POST['Footer_showsub'].'|'.$_POST['Footer_ddelay'].'|'.$Footer_days.'|'.$_POST['Footer_dstart'].'|'.$_POST['Footer_dstop'];

	//replace \n with html br before save to database
	$Footer_head=str_replace(array("\r\n", "\r", "\n"), '<br>', $Footer_head);
	$Footer_headdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Footer_headdes']);
	$Footer_spam=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Footer_spam']);
	
	//save to database
	if (isset($_POST['Savepreview_footer'])) {
    $wpdb->update($table_name_footer, 
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Footer_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Footer_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Footer_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Footer_image_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Footer_bgimage_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Footer_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Footer_head)),
    		  'Text'=>mysql_real_escape_string(trim($Footer_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Footer_form)),
    		  'Regular'=>mysql_real_escape_string(trim($Footer_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Footer_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Footer_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Footer_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Footer_active'])),
			  'Display'=>mysql_real_escape_string(trim($Footer_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_footer, 
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Footer_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Footer_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Footer_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Footer_image_preview_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Footer_bgimage_preview_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Footer_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Footer_head)),
    		  'Text'=>mysql_real_escape_string(trim($Footer_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Footer_form_preview)),
    		  'Regular'=>mysql_real_escape_string(trim($Footer_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Footer_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Footer_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Footer_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Footer_active'])),
			  'Display'=>mysql_real_escape_string(trim($Footer_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DFooter_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_theme = preg_replace("/\\\/","",$DFooter_theme);
$DFooter_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_link = preg_replace("/\\\/","",$DFooter_link);
$DFooter_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
if ($DFooter_link_blank=="_blank") {$DFooter_link_blank="checked";}
$DFooter_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_image = preg_replace("/\\\/","",$DFooter_image);
$DFooter_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_bgimage = preg_replace("/\\\/","",$DFooter_bgimage);
if ($DFooter_image!="") {$DFooter_image_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
if ($DFooter_bgimage!="") {$DFooter_bgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}

if ($DFooter_theme=='footer1') {
	$Dfooter1_sel='selected'; $Dfooter_view='<img id="footer1img" src="'.GenerationPlugin_preview.'/footerD1.gif">';
	$DFooter_show1 = 'style="display:block"';
	$DFooter_show2 = 'style="display:block"';
	$Footer_bg1_name = 'name="Footer_bg"';
	$Footer_bg2_name = 'name=""';
	$DFooter_selectBgs1 = 'style="display:inline"';
	$DFooter_selectBgs2 = 'style="display:none"';
}
elseif ($DFooter_theme=='footer2') {
	$Dfooter2_sel='selected'; $Dfooter_view='<img id="footer1img" src="'.GenerationPlugin_preview.'/footerD2.gif">';
	$DFooter_show1 = 'style="display:none"';
	$DFooter_show2 = 'style="display:none"';
	$Footer_bg1_name = 'name="Footer_bg"';
	$Footer_bg2_name = 'name=""';
	$DFooter_selectBgs1 = 'style="display:inline"';
	$DFooter_selectBgs2 = 'style="display:none"';
}
elseif ($DFooter_theme=='footer11') {
	$Dfooter11_sel='selected'; $Dfooter_view='<img id="footer1img" src="'.GenerationPlugin_preview.'/footerL1.gif">';
	$DFooter_show1 = 'style="display:block"';
	$DFooter_show2 = 'style="display:block"';
	$Footer_bg1_name = 'name=""';
	$Footer_bg2_name = 'name="Footer_bg"';
	$DFooter_selectBgs1 = 'style="display:none"';
	$DFooter_selectBgs2 = 'style="display:inline"';
}
elseif ($DFooter_theme=='footer12') {
	$Dfooter12_sel='selected'; $Dfooter_view='<img id="footer1img" src="'.GenerationPlugin_preview.'/footerL2.gif">';
	$DFooter_show1 = 'style="display:none"';
	$DFooter_show2 = 'style="display:none"';
	$Footer_bg1_name = 'name=""';
	$Footer_bg2_name = 'name="Footer_bg"';
	$DFooter_selectBgs1 = 'style="display:none"';
	$DFooter_selectBgs2 = 'style="display:inline"';
}
else {
	$Dfooter_view='<img id="footer1img" src="'.GenerationPlugin_preview.'/footerD1.gif">';
	$DFooter_show1 = 'style="display:block"';
	$DFooter_show2 = 'style="display:block"';
	$Footer_bg1_name = 'name="Footer_bg"';
	$Footer_bg2_name = 'name=""';
	$DFooter_selectBgs1 = 'style="display:inline"';
	$DFooter_selectBgs2 = 'style="display:none"';
}

$DFooter_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_btncolor = preg_replace("/\\\/","",$DFooter_btncolor);
$DFooter_btncolor = explode("|", $DFooter_btncolor);
$DFooter_btncolor = $DFooter_btncolor[3];
if ($DFooter_btncolor=='stripe_darkred') {$DfooterB1_sel='selected';} //stripe design
elseif ($DFooter_btncolor=='stripe_red') {$DfooterB2_sel='selected';}
elseif ($DFooter_btncolor=='stripe_magenta') {$DfooterB3_sel='selected';}
elseif ($DFooter_btncolor=='stripe_violetmagenta') {$DfooterB4_sel='selected';}
elseif ($DFooter_btncolor=='stripe_violet') {$DfooterB5_sel='selected';}
elseif ($DFooter_btncolor=='stripe_blueviolet') {$DfooterB6_sel='selected';}
elseif ($DFooter_btncolor=='stripe_navyblue') {$DfooterB7_sel='selected';}
elseif ($DFooter_btncolor=='stripe_darkblue') {$DfooterB8_sel='selected';}
elseif ($DFooter_btncolor=='stripe_blue') {$DfooterB9_sel='selected';}
elseif ($DFooter_btncolor=='stripe_turquoise') {$DfooterB10_sel='selected';}
elseif ($DFooter_btncolor=='stripe_greenturquoise') {$DfooterB11_sel='selected';}
elseif ($DFooter_btncolor=='stripe_darkgreen') {$DfooterB12_sel='selected';}
elseif ($DFooter_btncolor=='stripe_green') {$DfooterB13_sel='selected';}
elseif ($DFooter_btncolor=='stripe_lemon') {$DfooterB14_sel='selected';}
elseif ($DFooter_btncolor=='stripe_yellow') {$DfooterB15_sel='selected';}
elseif ($DFooter_btncolor=='stripe_orange') {$DfooterB16_sel='selected';}
elseif ($DFooter_btncolor=='simple_darkred') {$DfooterB21_sel='selected';} //simple design
elseif ($DFooter_btncolor=='simple_red') {$DfooterB22_sel='selected';}
elseif ($DFooter_btncolor=='simple_magenta') {$DfooterB23_sel='selected';}
elseif ($DFooter_btncolor=='simple_violetmagenta') {$DfooterB24_sel='selected';}
elseif ($DFooter_btncolor=='simple_violet') {$DfooterB25_sel='selected';}
elseif ($DFooter_btncolor=='simple_blueviolet') {$DfooterB26_sel='selected';}
elseif ($DFooter_btncolor=='simple_navyblue') {$DfooterB27_sel='selected';}
elseif ($DFooter_btncolor=='simple_darkblue') {$DfooterB28_sel='selected';}
elseif ($DFooter_btncolor=='simple_blue') {$DfooterB29_sel='selected';}
elseif ($DFooter_btncolor=='simple_turquoise') {$DfooterB30_sel='selected';}
elseif ($DFooter_btncolor=='simple_greenturquoise') {$DfooterB31_sel='selected';}
elseif ($DFooter_btncolor=='simple_darkgreen') {$DfooterB32_sel='selected';}
elseif ($DFooter_btncolor=='simple_green') {$DfooterB33_sel='selected';}
elseif ($DFooter_btncolor=='simple_lemon') {$DfooterB34_sel='selected';}
elseif ($DFooter_btncolor=='simple_yellow') {$DfooterB35_sel='selected';}
elseif ($DFooter_btncolor=='simple_orange') {$DfooterB36_sel='selected';}

$DFooter_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_background = preg_replace("/\\\/","",$DFooter_background);
if ($DFooter_background=='bg2') {$DfooterBackground2_sel='selected';}
elseif ($DFooter_background=='bg3') {$DfooterBackground3_sel='selected';}
elseif ($DFooter_background=='bg4') {$DfooterBackground4_sel='selected';}
elseif ($DFooter_background=='bg12') {$DfooterBackground12_sel='selected';}
elseif ($DFooter_background=='bg13') {$DfooterBackground13_sel='selected';}
elseif ($DFooter_background=='bg14') {$DfooterBackground14_sel='selected';}

$DFooter_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_title_tmp = preg_replace("/\\\/","",$DFooter_title_tmp);
    $DFooter_title = explode("|", $DFooter_title_tmp);
	$DFooter_headclr = $DFooter_title[0];
	$DFooter_headtxt = $DFooter_title[1];
	$DFooter_headclr_c = $DFooter_title[2];
$DFooter_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_text = preg_replace("/\\\/","",$DFooter_text);

$DFooter_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_form_tmp = preg_replace("/\\\/","",$DFooter_form);
    $DFooter_formx = explode("|", $DFooter_form_tmp);
	$DFooter_form = $DFooter_formx[0];
	$DFooter_formtype = $DFooter_formx[1];
	$DFooter_clink = $DFooter_formx[2];
	$DFooter_cclick1 = $DFooter_formx[3];
	$DFooter_cblank = $DFooter_formx[4];
	if ($DFooter_cblank=="_blank") {$DFooter_cblank="checked";}
	$DFooter_cbgimage = $DFooter_formx[5];
	if ($DFooter_cbgimage!="") {$DFooter_cbgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
	$DFooter_cclick2 = $DFooter_formx[6];
	$DFooter_cwidth = $DFooter_formx[7];
	$DFooter_cheight = $DFooter_formx[8];
	$DFooter_cscroll = $DFooter_formx[9];
	if ($DFooter_cscroll=="scroll") {$DFooter_cscroll="checked";}
	$DFooter_cfullw = $DFooter_formx[10];
	if ($DFooter_cfullw=="fullw") {$DFooter_cfullw="checked";}
	$DFooter_bookmarkclr = $DFooter_formx[11];
	if ($DFooter_bookmarkclr=="dark") {$Dfooterf1b_sel="selected";}
	elseif ($DFooter_bookmarkclr=="light") {$Dfooterf2b_sel="selected";}

if ($DFooter_form=='regular' || $DFooter_form=='') {
	$Dfooterf1_sel='selected'; 
	$Dfooterf1_view='style="display:block"'; $Dfooterf2_view='style="display:block"'; $Dfooterf3_view='style="display:none"';
	$Dfooterf4_view='style="display:none"'; $Dfooterf5_view='style="display:none"';
	$Dfooter_buttonss='style="display:block"'; $Dfooter_adsection='style="display:block"';
	$Dfooterf1_view_right='style="display:block"';
	$DFooter_stheme = 'style="display:inline"'; $DFooter_stheme_label = 'style="display:inline"';
	$Dfooter_preview1 = 'style="display:block"'; $Dfooter_preview2 = 'style="display:none"';
}
elseif ($DFooter_form=='social') {
	$Dfooterf2_sel='selected'; 
	$Dfooterf1_view='style="display:none"'; $Dfooterf2_view='style="display:none"'; $Dfooterf3_view='style="display:none"';
	$Dfooterf4_view='style="display:none"'; $Dfooterf5_view='style="display:none"';
	$Dfooter_buttonss='style="display:block"'; $Dfooter_adsection='style="display:block"';
	$Dfooterf1_view_right='style="display:none"';
	$DFooter_stheme = 'style="display:inline"'; $DFooter_stheme_label = 'style="display:inline"';
	$Dfooter_preview1 = 'style="display:block"'; $Dfooter_preview2 = 'style="display:none"';
}
elseif ($DFooter_form=='both') {
	$Dfooterf12_sel='selected'; 
	$Dfooterf1_view='style="display:block"'; $Dfooterf2_view='style="display:block"'; $Dfooterf3_view='style="display:none"';
	$Dfooterf4_view='style="display:none"'; $Dfooterf5_view='style="display:none"';
	$Dfooter_buttonss='style="display:block"'; $Dfooter_adsection='style="display:block"';
	$Dfooterf1_view_right='style="display:block"';
	$DFooter_stheme = 'style="display:inline"'; $DFooter_stheme_label = 'style="display:inline"';
	$Dfooter_preview1 = 'style="display:block"'; $Dfooter_preview2 = 'style="display:none"';
}
elseif ($DFooter_form=='link') {
	$Dfooterf3_sel='selected'; 
	$Dfooterf1_view='style="display:block"'; $Dfooterf2_view='style="display:none"'; $Dfooterf3_view='style="display:block"';
	$Dfooterf4_view='style="display:none"'; $Dfooterf5_view='style="display:none"';
	$Dfooter_buttonss='style="display:block"'; $Dfooter_adsection='style="display:block"';
	$Dfooterf1_view_right='style="display:none"';
	$DFooter_stheme = 'style="display:inline"'; $DFooter_stheme_label = 'style="display:inline"';
	$Dfooter_preview1 = 'style="display:block"'; $Dfooter_preview2 = 'style="display:none"';
}
elseif ($DFooter_form=='custom') {
	$Dfooterf4_sel='selected'; 
	$Dfooterf1_view='style="display:none"'; $Dfooterf2_view='style="display:none"'; $Dfooterf3_view='style="display:block"';
	$Dfooterf4_view='style="display:block"'; $Dfooterf5_view='style="display:block"';
	$Dfooter_buttonss='style="display:none"'; $Dfooter_adsection='style="display:none"';
	$Dfooterf1_view_right='style="display:none"';
	$DFooter_stheme = 'style="display:none"'; $DFooter_stheme_label = 'style="display:none"';
	$Dfooter_preview1 = 'style="display:none"'; $Dfooter_preview2 = 'style="display:block"';
}

if ($DFooter_formtype=='link' || $DFooter_formtype=='') {
	$Dfooterf10_sel='selected';
	$Dfooterf6_view='style="display:block"'; $Dfooterf7_view='style="display:none"';
}
elseif ($DFooter_formtype=='image') {
	$Dfooterf20_sel='selected';
	$Dfooterf6_view='style="display:none"'; $Dfooterf7_view='style="display:block"';
}
else {
	$Dfooterf10_sel='selected';
	$Dfooterf6_view='style="display:block"'; $Dfooterf7_view='style="display:none"';
}

$DFooter_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_regular_tmp = preg_replace("/\\\/","",$DFooter_regular_tmp);
    $DFooter_regular = explode("|", $DFooter_regular_tmp);
	$Footer_fname = $DFooter_regular[0];
	$Footer_femail = $DFooter_regular[1];
	$Footer_fbtntxt = $DFooter_regular[2];
	$Footer_fbtnclr = $DFooter_regular[3];
	if ($DFooter_regular[4]=="1") {$DFooter_name_disabled="checked";}
	
$DFooter_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_spam = preg_replace("/\\\/","",$DFooter_spam);
$DFooter_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_optin = preg_replace("/<br>/","\n",$DFooter_optin);
	$DFooter_optin = preg_replace("/\\\/","",$DFooter_optin);
	$DFooter_optin = explode("|",$DFooter_optin);
	if ($DFooter_optin[4]=="on") {$DFooter_optinch="checked";}
$DFooter_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_footer.' WHERE id='.$Duniqueid);
	if ($DFooter_active_tmp=="on") {$DFooter_active="checked";} else {$DFooter_activated='style="background-color:#FCC"';}

	//replace html br with \n before display in text field
	$DFooter_headtxt = preg_replace("/<br>/","\n",$DFooter_headtxt);
	$DFooter_text = preg_replace("/<br>/","\n",$DFooter_text);
	$DFooter_spam = preg_replace("/<br>/","\n",$DFooter_spam);
	
$DFooter_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
    $DFooter_display = explode("|", $DFooter_displays);
	$DFooter_dpages = $DFooter_display[0];
	$DFooter_dcats = $DFooter_display[1];
	$DFooter_dposts = $DFooter_display[2];
	if (strpos($DFooter_dpages,'allpages')!==false) {$DFooter_dpagesall="checked";}
	if (strpos($DFooter_dcats,'allcats')!==false) {$DFooter_dcatsall="checked";}
	if (strpos($DFooter_dposts,'allposts')!==false) {$DFooter_dpostsall="checked";}
	//if ($DFooter_dpagesall=="" && $DFooter_dcatsall=="" && $DFooter_dpostsall=="") {$DFooter_dcheckall="";}
	$DFooter_showsub = $DFooter_display[3];
	if ($DFooter_showsub=="on") {$DFooter_showsub="checked";}
	$DFooter_ddelay = $DFooter_display[4];
	$DFooter_ddays = $DFooter_display[5];
	$DFooter_dstart = $DFooter_display[6];
	$DFooter_dstop = $DFooter_display[7];
?>

<script type="text/javascript">
function sh4_theme(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='1') {
        document.getElementById("Footer_show1").style.display="block";
        document.getElementById("Footer_show2").style.display="block";
        document.getElementById("Footer_selectBgs1").name="Footer_bg";
        document.getElementById("Footer_selectBgs2").name="";
        document.getElementById("Footer_selectBgs1").style.display="inline";
        document.getElementById("Footer_selectBgs2").style.display="none";
		$jj('#footer1').html('<img id="footer1img" src="<?php echo GenerationPlugin_preview.'/footerD1.gif'; ?>">');
	} else if(sel.selectedIndex=='2' || sel.selectedIndex=='3') {
        document.getElementById("Footer_show1").style.display="none";
        document.getElementById("Footer_show2").style.display="none";
        document.getElementById("Footer_selectBgs1").name="Footer_bg";
        document.getElementById("Footer_selectBgs2").name="";
        document.getElementById("Footer_selectBgs1").style.display="inline";
        document.getElementById("Footer_selectBgs2").style.display="none";
		$jj('#footer1').html('<img id="footer1img" src="<?php echo GenerationPlugin_preview.'/footerD2.gif'; ?>">');
	} else if(sel.selectedIndex=='4' || sel.selectedIndex=='5') {
        document.getElementById("Footer_show1").style.display="block";
        document.getElementById("Footer_show2").style.display="block";
        document.getElementById("Footer_selectBgs1").name="";
        document.getElementById("Footer_selectBgs2").name="Footer_bg";
        document.getElementById("Footer_selectBgs1").style.display="none";
        document.getElementById("Footer_selectBgs2").style.display="inline";
		$jj('#footer1').html('<img id="footer1img" src="<?php echo GenerationPlugin_preview.'/footerL1.gif'; ?>">');
	} else if(sel.selectedIndex=='6') {
        document.getElementById("Footer_show1").style.display="none";
        document.getElementById("Footer_show2").style.display="none";
        document.getElementById("Footer_selectBgs1").name="";
        document.getElementById("Footer_selectBgs2").name="Footer_bg";
        document.getElementById("Footer_selectBgs1").style.display="none";
        document.getElementById("Footer_selectBgs2").style.display="inline";
		$jj('#footer1').html('<img id="footer1img" src="<?php echo GenerationPlugin_preview.'/footerL2.gif'; ?>">');
	}
}
$jj(document).ready(function(){
	$jj("#Footer_name").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Footer_email").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Footer_btntxt").charCount({allowed:18, warning:0, /*counterText:'left: '*/});
	$jj("#Footer_headtxt").charCount({allowed:25, warning:0, /*counterText:'left: '*/});
	$jj("#Footer_headdes").charCount({allowed:50, warning:0, /*counterText:'left: '*/});
	$jj("#Footer_spam").charCount({allowed:45, warning:0, /*counterText:'left: '*/});
});
</script>


        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DFooter_activated; ?>>
				<input name="Footer_active" type="checkbox" <?php echo $DFooter_active; ?>> Activate Footer Panel
			</div>
            <select name="Footer_theme" id="selectfooter" onchange="sh4_theme(this)" <?php echo $DFooter_stheme; ?>>
				<option value="footer1" style="color:#069; font-weight:bold">Graphite themes</option>
                <option value="footer1" <?php echo $Dfooter1_sel; ?>>standard</option>
                <option value="footer2" <?php echo $Dfooter2_sel; ?>>mini</option>
				<option value="footer2">&nbsp;</option>
				<option value="footer11" style="color:#069; font-weight:bold">Silver themes</option>
                <option value="footer11" <?php echo $Dfooter11_sel; ?>>standard</option>
                <option value="footer12" <?php echo $Dfooter12_sel; ?>>mini</option>
            </select> <span id="selectfooter_label" <?php echo $DFooter_stheme_label; ?>>Template</span>
			<select name="Footer_form" onchange="sh4(this)">
				<option value="regular" <?php echo $Dfooterf1_sel; ?>>regular</option>
				<option value="social" <?php echo $Dfooterf2_sel; ?>>facebook</option>
				<option value="both" <?php echo $Dfooterf12_sel; ?>>regular and facebook switch</option>
				<option value="link" <?php echo $Dfooterf3_sel; ?>>link</option>
				<option value="custom" <?php echo $Dfooterf4_sel; ?>>custom content</option>
			</select> Type of sign-up form
			<div id="xchoice41" <?php echo $Dfooterf5_view; ?>>
    			<select name="Footer_ccontent" onchange="sh40(this)">
    				<option value="link" <?php echo $Dfooterf10_sel; ?>>webpage</option>
    				<option value="image" <?php echo $Dfooterf20_sel; ?>>image</option>
    			</select> Type of custom content
			</div>

			<div id="ichoice42" <?php echo $Dfooterf4_view; ?>>
				<input name="Footer_cwidth" type="text" value="<?php echo $DFooter_cwidth; ?>"> Box width in pixels
        		<br/>
				<input name="Footer_cfullw" type="checkbox" value="fullw" <?php echo $DFooter_cfullw; ?>> ...or display in full width
        		<br/>
				<input name="Footer_cheight" type="text" value="<?php echo $DFooter_cheight; ?>"> Box height in pixels
				<input style="display:none" name="Footer_cscroll" type="checkbox" value="scroll" <?php echo $DFooter_cscroll; ?>>
				<div id="ichoice43" <?php echo $Dfooterf6_view; ?>>
					<input name="Footer_clink" type="text" value="<?php echo $DFooter_clink; ?>">
					<img id="helpbtn_footer8" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        			<span class="maxfile" id="helptip_footer8">URLs starting with 'https://' will not open in box due to security reasons.</span> Link to webpage
				</div>
				<div id="ichoice44" <?php echo $Dfooterf7_view; ?>>
					<input name="Footer_cbg" type="file" size="26">
        			<?php if (filesize($DFooter_cbgimage)>=1048576) { ?>
        				<img id="helpbtn_footer9" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
        				<span class="maxfilewarning" id="helptip_footer9">Max 1Mb!</span>
        			<?php } else { ?>
        				<img id="helpbtn_footer9" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        				<span class="maxfile" id="helptip_footer9">Max 1Mb</span>
        			<?php } ?>
        			<?php echo $DFooter_cbgimage_img; ?>
					<span style="display:inline; margin-bottom:100px">Upload an image...</span>
        			<br/>
        			<input name="Footer_cbgremove" type="checkbox"> Remove uploaded image
					<br/>
    				<input name="Footer_cclick1" type="text" value="<?php echo $DFooter_cclick1; ?>"> ...or use external image
					<br/>
    				<input name="Footer_cclick2" type="text" value="<?php echo $DFooter_cclick2; ?>"> Link for <i>click</i> action
					<br/>
					<input name="Footer_cblank" type="checkbox" value="_blank" <?php echo $DFooter_cblank; ?>> Open the link in new tab
				</div>
    			<select name="Footer_bookmarkclr">
    				<option value="dark" <?php echo $Dfooterf1b_sel; ?>>dark</option>
    				<option value="light" <?php echo $Dfooterf2b_sel; ?>>light</option>
    			</select> Background color
			</div>
			
            <div id="choice40" name="choice41" <?php echo $Dfooterf1_view; ?>>
				<div id="ichoice40" <?php echo $Dfooterf2_view; ?>>
					<div id="Footer_show1" <?php echo $DFooter_show1; ?>>
    					<input id="Footer_name" name="Footer_name" type="text" value="<?php echo $Footer_fname; ?>"> 'Name' default value
					<br/>
					<input name="Footer_name_disabled" type="checkbox" value="1" <?php echo $DFooter_name_disabled; ?>> Do not show 'Name' field in form
                    <br/>
					</div>
                    <input id="Footer_email" name="Footer_email" type="text" value="<?php echo $Footer_femail; ?>"> 'Email' default value
                    <br/>
				</div>
				<div id="ichoice41" <?php echo $Dfooterf3_view; ?>>	
					<input name="Footer_link" type="text" value="<?php echo $DFooter_link; ?>"> Destin. page
					<br/>
					<input name="Footer_link_blank" type="checkbox" value="_blank" <?php echo $DFooter_link_blank; ?>> Open the page in new tab
					<br/>
				</div>
				
				<div id="Footer_buttonss" <?php echo $Dfooter_buttonss; ?>>
                <input id="Footer_btntxt" name="Footer_btntxt" type="text" value="<?php echo $Footer_fbtntxt; ?>"> Button text
                <br/>
				<select name="Footer_btnclr" id="selectButtons">
					<option style="margin-left:-136px; color:#069; font-weight:bold">Stripe design</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark.gif'; ?>)" 
						value="stripe_darkred" <?php echo $DfooterB1_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red.gif'; ?>)" 
						value="stripe_red" <?php echo $DfooterB2_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta.gif'; ?>)" 
						value="stripe_magenta" <?php echo $DfooterB3_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta.gif'; ?>)" 
						value="stripe_violetmagenta" <?php echo $DfooterB4_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet.gif'; ?>)" 
						value="stripe_violet" <?php echo $DfooterB5_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet.gif'; ?>)" 
						value="stripe_blueviolet" <?php echo $DfooterB6_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy.gif'; ?>)" 
						value="stripe_navyblue" <?php echo $DfooterB7_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark.gif'; ?>)" 
						value="stripe_darkblue" <?php echo $DfooterB8_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue.gif'; ?>)" 
						value="stripe_blue" <?php echo $DfooterB9_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise.gif'; ?>)" 
						value="stripe_turquoise" <?php echo $DfooterB10_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise.gif'; ?>)" 
						value="stripe_greenturquoise" <?php echo $DfooterB11_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark.gif'; ?>)" 
						value="stripe_darkgreen" <?php echo $DfooterB12_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green.gif'; ?>)" 
						value="stripe_green" <?php echo $DfooterB13_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon.gif'; ?>)" 
						value="stripe_lemon" <?php echo $DfooterB14_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow.gif'; ?>)" 
						value="stripe_yellow" <?php echo $DfooterB15_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange.gif'; ?>)" 
						value="stripe_orange" <?php echo $DfooterB16_sel; ?>>orange</option>
					<option>&nbsp;</option>
					<option style="margin-left:-136px; color:#069; font-weight:bold">Simple design</option>
					<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark2.gif'; ?>)" 
						value="simple_darkred" <?php echo $DfooterB21_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red2.gif'; ?>)" 
						value="simple_red" <?php echo $DfooterB22_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta2.gif'; ?>)" 
						value="simple_magenta" <?php echo $DfooterB23_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta2.gif'; ?>)" 
						value="simple_violetmagenta" <?php echo $DfooterB24_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet2.gif'; ?>)" 
                        value="simple_violet" <?php echo $DfooterB25_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet2.gif'; ?>)" 
  						value="simple_blueviolet" <?php echo $DfooterB26_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy2.gif'; ?>)" 
						value="simple_navyblue" <?php echo $DfooterB27_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark2.gif'; ?>)" 
						value="simple_darkblue" <?php echo $DfooterB28_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue2.gif'; ?>)" 
						value="simple_blue" <?php echo $DfooterB29_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise2.gif'; ?>)" 
						value="simple_turquoise" <?php echo $DfooterB30_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise2.gif'; ?>)" 
						value="simple_greenturquoise" <?php echo $DfooterB31_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark2.gif'; ?>)" 
						value="simple_darkgreen" <?php echo $DfooterB32_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green2.gif'; ?>)" 
						value="simple_green" <?php echo $DfooterB33_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon2.gif'; ?>)" 
						value="simple_lemon" <?php echo $DfooterB34_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow2.gif'; ?>)" 
						value="simple_yellow" <?php echo $DfooterB35_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange2.gif'; ?>)" 
						value="simple_orange" <?php echo $DfooterB36_sel; ?>>orange</option>
				</select> Button color
				</div>
			</div>
			
			<div id="Footer_adsection" <?php echo $Dfooter_adsection; ?>>
			
			<input name="Footer_headclr" type="text" id="colorfooter" value="<?php echo $DFooter_headclr; ?>" />
			<div style="margin:0 0 -25px 235px">
				<input style="position:absolute; margin:5px 0 0 -21px" name="Footer_headclr_c" type="checkbox" value="on" <?php if ($DFooter_headclr_c=="on") {echo "checked";} ?> />
				<img id="helpbtn_footer5" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="headclrhelp" id="helptip_footer5">Pick your color and check the checkbox to setup headers color different than button color.</span>
				Custom headers color
			</div>
            <br/>
			<div id="Footer_show2" <?php echo $DFooter_show2; ?>>
				<textarea id="Footer_headtxt" name="Footer_headtxt"><?php echo $DFooter_headtxt; ?></textarea>
				<img id="helpbtn_footer6" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="countdownhelp" id="helptip_footer6">Use number in brackets (max '90') to add countdown timer. Number in brackets = minutes, e.g.(57).</span>
				Header text
            <br/>
			</div>
            <textarea id="Footer_headdes" name="Footer_headdes"><?php echo $DFooter_text; ?></textarea> Header description
            <br/>
            <textarea class="m8px" id="Footer_spam" name="Footer_spam"><?php echo $DFooter_spam; ?></textarea> Anti-spam note
            <br/>
			<select <?php echo $Footer_bg1_name; ?> id="Footer_selectBgs1" <?php echo $DFooter_selectBgs1; ?>>
					<option style="margin-left:-136px">Dark backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_noise.gif'; ?>)" 
						value="bg2" <?php echo $DfooterBackground2_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_carbonfiber.gif'; ?>)" 
						value="bg3" <?php echo $DfooterBackground3_sel; ?>>carbon fiber</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_wood.gif'; ?>)" 
						value="bg4" <?php echo $DfooterBackground4_sel; ?>>wood</option>
			</select>	
			<select <?php echo $Footer_bg2_name; ?> id="Footer_selectBgs2" <?php echo $DFooter_selectBgs2; ?>>
					<option style="margin-left:-136px">Light backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_noise.gif'; ?>)" 
						value="bg12" <?php echo $DfooterBackground12_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_sparkles.gif'; ?>)" 
						value="bg13" <?php echo $DfooterBackground13_sel; ?>>sparkles</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_blur.gif'; ?>)" 
						value="bg14" <?php echo $DfooterBackground14_sel; ?>>blur</option>
			</select> <span style="display:inline">Product background</span>
			<br/>
            <input name="Footer_bg" type="file" size="26">
			<?php if (filesize($DFooter_bgimage)>=307201) { ?>
				<img id="helpbtn_footer3" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_footer3">Max 300kb!</span>
			<?php } else { ?>
				<img id="helpbtn_footer3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_footer3">Max 300kb</span>
			<?php } ?>
			<?php echo $DFooter_bgimage_img; ?>
			<br/>
			<input name="Footer_bgremove" type="checkbox"> Remove uploaded background
			<br/>
            <input class="m8px" name="Footer_file" type="file" size="26">
			<?php if (filesize($DFooter_image)>=81921) { ?>
				<img id="helpbtn_footer4" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_footer4">Max 70kb! (200x220px)</span>
			<?php } else { ?>
				<img id="helpbtn_footer4" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_footer4">Max 70kb (200x220px)</span>
			<?php } ?>
			<?php echo $DFooter_image_img; ?> Product image
			<br/>
			<input name="Footer_fileremove" type="checkbox"> Remove uploaded image
        </div>
		
        </div>
            
        <div class="right_section" id="footer_checkboxes">
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_footer1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_footer1">Click here to show options.</span>
			</h4>
            <div class="toggle">
				<input style="display:inline-block;" type="checkbox" name="Footer_pagelist[]" value="allpages" <?php echo $DFooter_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DFooter_dpages_front="front";
				if (strpos(','.$DFooter_dpages.',',',front,')!==false || $DFooter_displays=="") {$DFooter_dpagesch[$DFooter_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Footer_pagelist[]" value="front" '.$DFooter_dpagesch[$DFooter_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DFooter_dpages_search="search";
				if (strpos(','.$DFooter_dpages.',',',search,')!==false || $DFooter_displays=="") {$DFooter_dpagesch[$DFooter_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Footer_pagelist[]" value="search" '.$DFooter_dpagesch[$DFooter_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DFooter_dpages_author="author";
				if (strpos(','.$DFooter_dpages.',',',author,')!==false || $DFooter_displays=="") {$DFooter_dpagesch[$DFooter_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Footer_pagelist[]" value="author" '.$DFooter_dpagesch[$DFooter_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order'); 
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DFooter_dpages.',',','.trim($pageID).',')!==false || $DFooter_displays=="") {$DFooter_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Footer_pagelist[]" value="'.$pageID.'" '.$DFooter_dpagesch[$pageID].'>';
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
 							if (strpos(','.$DFooter_dpages.',',','.trim($childID).',')!==false || $DFooter_displays=="") {$DFooter_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Footer_pagelist[]" value="'.$childID.'" '.$DFooter_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Footer_catlist[]" value="allcats" <?php echo $DFooter_dcatsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DFooter_dcats.',',','.trim($cat_id).',')!==false || $DFooter_displays=="") {$DFooter_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Footer_catlist[]" value="'.$cat_id.'" '.$DFooter_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Footer_postlist[]" value="allposts" <?php echo $DFooter_dpostsall; ?>>
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
							if (strpos(','.$DFooter_dposts.',',','.trim($id).',')!==false || $DFooter_displays=="") {$DFooter_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Footer_postlist[]" value="'.$id.'" '.$DFooter_dpostsch[$id].'>&nbsp;';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="Footer_showsub" <?php echo $DFooter_showsub; ?>>
					&nbsp;<span style="color:#069">Do NOT show to subscribers</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="footer_checkboxes_switch" <?php echo $DFooter_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				Show after <input class="showdelay" name="Footer_ddelay" type="text" value="<?php echo $DFooter_ddelay; ?>"> seconds<br>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Footer_dstart" type="text" value="<?php echo $DFooter_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Footer_dstop" type="text" value="<?php echo $DFooter_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Footer_ddays" type="text" value="<?php echo $DFooter_ddays; ?>"> days<br>
				-->
				
            </div>
			
			<h4 id="right_choice40" class="hiddens" <?php echo $Dfooterf1_view_right; ?>>
				Opt-in settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_footer7" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_footer7">Click here to show options.</span>
			</h4>
            <div id="Footer_optin" class="toggle" <?php echo $Dfooterf1_view_right; ?>>
					<div class="gpadminoptional" style="margin-bottom:0; width:535px">
						Make sure there is data in 'form action' field. Otherwise change 'form' to 'formc' in your opt-in code.
					</div>
                    <textarea name="Footer_optin1" id="gpoptinform_footer"><?php echo str_replace(":::","|",$DFooter_optin[0]); ?></textarea> Opt-in code<br/>
                    <div id="gpformarea_footer" style="display:none"></div>
                    <input type="button" value="Process" id="gpproccessit_footer"><br/>
					<textarea style="margin:3px 0" name="Footer_optin5" id="gpformaction_footer"><?php echo $DFooter_optin[4]; ?></textarea> form action<br/>
                    <select name="Footer_optin2" id="gpnamefield_footer">
    					<option value="<?php echo $DFooter_optin[1]; ?>"><?php echo $DFooter_optin[1]; ?></option>
    				</select> 'NAME' field<br/>
                    <select name="Footer_optin3" id="gpemailfield_footer">
    					<option value="<?php echo $DFooter_optin[2]; ?>"><?php echo $DFooter_optin[2]; ?></option>
    				</select> 'EMAIL' field<br/>
                    <!-- <input name="Footer_optin4" value="on" type="checkbox" id="gpdisablename_footer" <?php echo $DFooter_optinch; ?>> disable NAME field<br/> -->
                    <input type="checkbox" id="gpshowalldata_footer"> show all processed data<br/>
                    <div id="gpalldata_footer" style="display:none">
                        <textarea name="Footer_optin6" id="gphiddenfields_footer"><?php echo $DFooter_optin[5]; ?></textarea> hidden fields<br/>
                        <textarea name="Footer_optin7" id="gpignoredfields_footer"><?php echo $DFooter_optin[6]; ?></textarea> ignored fields<br/>
                        <textarea name="Footer_optin8" id="gpotherfields_footer"><?php echo $DFooter_optin[7]; ?></textarea> other fields<br/>
                        <textarea name="Footer_optin9" id="gpsubmitbutton_footer"><?php echo $DFooter_optin[8]; ?></textarea> submit button<br/>
                    </div><br/>
			</div>
			
        	<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_footer2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_footer2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="footer1" class="preview4" <?php echo $Dfooter_preview1; ?>><?php echo $Dfooter_view; ?></div>
			<div id="footer2" class="preview4" <?php echo $Dfooter_preview2; ?>><img src="<?php echo GenerationPlugin_preview.'/footerCC.gif'; ?>"></div>
        </div>

		
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_footer" type="hidden" value="Save Changes">
    		<input id="Savepreview_footer" name="Savepreview_footer" type="hidden" value="Savepreview_footer">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_footer').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div>  
