<div id="tab5" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_regular" enctype="multipart/form-data">

<?php
if (isset($_POST['displayingformsent_regular'])=='Save Changes') {

	//multiple values into one database cell
	if ($_POST['Regular_headclr_c']=="on") {$Regular_headclr=$_POST['Regular_headclr'];}
	elseif ($_POST['Regular_form']=="social") {$Regular_headclr="0d66ae";}
	elseif ($_POST['Regular_btnclr']=="stripe_darkred" || $_POST['Regular_btnclr']=="simple_darkred") {$Regular_headclr="a92e20";}
	elseif ($_POST['Regular_btnclr']=="stripe_red" || $_POST['Regular_btnclr']=="simple_red") {$Regular_headclr="d53929";}
	elseif ($_POST['Regular_btnclr']=="stripe_magenta" || $_POST['Regular_btnclr']=="simple_magenta") {$Regular_headclr="c73272";}
	elseif ($_POST['Regular_btnclr']=="stripe_violetmagenta" || $_POST['Regular_btnclr']=="simple_violetmagenta") {$Regular_headclr="b940b3";}
	elseif ($_POST['Regular_btnclr']=="stripe_violet" || $_POST['Regular_btnclr']=="simple_violet") {$Regular_headclr="6c4ab2";}
	elseif ($_POST['Regular_btnclr']=="stripe_blueviolet" || $_POST['Regular_btnclr']=="simple_blueviolet") {$Regular_headclr="4442ad";}
	elseif ($_POST['Regular_btnclr']=="stripe_navyblue" || $_POST['Regular_btnclr']=="simple_navyblue") {$Regular_headclr="286c9e";}
	elseif ($_POST['Regular_btnclr']=="stripe_darkblue" || $_POST['Regular_btnclr']=="simple_darkblue") {$Regular_headclr="387dab";}
	elseif ($_POST['Regular_btnclr']=="stripe_blue" || $_POST['Regular_btnclr']=="simple_blue") {$Regular_headclr="299eb9";}
	elseif ($_POST['Regular_btnclr']=="stripe_turquoise" || $_POST['Regular_btnclr']=="simple_turquoise") {$Regular_headclr="38b5af";}
	elseif ($_POST['Regular_btnclr']=="stripe_greenturquoise" || $_POST['Regular_btnclr']=="simple_greenturquoise") {$Regular_headclr="2cc183";}
	elseif ($_POST['Regular_btnclr']=="stripe_darkgreen" || $_POST['Regular_btnclr']=="simple_darkgreen") {$Regular_headclr="5ca138";}
	elseif ($_POST['Regular_btnclr']=="stripe_green" || $_POST['Regular_btnclr']=="simple_green") {$Regular_headclr="93b73f";}
	elseif ($_POST['Regular_btnclr']=="stripe_lemon" || $_POST['Regular_btnclr']=="simple_lemon") {$Regular_headclr="d6ce28";}
	elseif ($_POST['Regular_btnclr']=="stripe_yellow" || $_POST['Regular_btnclr']=="simple_yellow") {$Regular_headclr="d1bd26";}
	elseif ($_POST['Regular_btnclr']=="stripe_orange" || $_POST['Regular_btnclr']=="simple_orange") {$Regular_headclr="e68f1b";}
	else {$Regular_headclr="CC3300";}
	$Regular_head = "#".trim($Regular_headclr."|".$_POST['Regular_headtxt']."|".$_POST['Regular_headclr_c'], "#");
	$Regular_regular = $_POST['Regular_name']."|".$_POST['Regular_email']."|".$_POST['Regular_btntxt']."|".$_POST['Regular_btnclr']."|".$_POST['Regular_name_disabled'];
	$Regular_social = "facebook";
	$Regular_background = $_POST['Regular_bg']."|".$_POST['Regular_screencolor']."|".$_POST['Regular_screenopacity'];
	$Regular_optin = trim(str_replace("|",":::",$_POST['Regular_optin1']))."|".trim($_POST['Regular_optin2'])."|".trim($_POST['Regular_optin3'])."|".trim($_POST['Regular_optin4'])."|".trim($_POST['Regular_optin5'])."|".trim($_POST['Regular_optin6'])."|".trim($_POST['Regular_optin7'])."|".trim($_POST['Regular_optin8'])."|".trim($_POST['Regular_optin9']);
    $Regular_optin = str_replace(array("\r\n", "\r", "\n"), '<br>', $Regular_optin);

	//image upload
	$Regular_file = $_FILES['Regular_file']['name'];
	$Regular_fileremove = $_POST['Regular_fileremove'];
	if ($Regular_fileremove=='on') {$Regular_file='';}
    $Regular_path = GenerationPlugin_uploads.basename($Regular_file);
    if (move_uploaded_file($_FILES['Regular_file']['tmp_name'], $Regular_path)) {
        $Regular_array = explode('.',$Regular_file);
        $Regular_exten = $Regular_array[count($Regular_array)-1];
    	if (isset($_POST['Savepreview_regular'])) {
			$Regular_image = GenerationPlugin_uploads.'Regular_image.'.$Regular_exten;
			$Regular_image_db = GenerationPlugin_uploads_db.'Regular_image.'.$Regular_exten;
        	rename($Regular_path, $Regular_image);
		}
        $Regular_image_preview = GenerationPlugin_uploads.'Regular_image_preview.'.$Regular_exten;
        $Regular_image_preview_db = GenerationPlugin_uploads_db.'Regular_image_preview.'.$Regular_exten;
		if ($Regular_image!='') { copy($Regular_image, $Regular_image_preview); }
        rename($Regular_path, $Regular_image_preview);
    } else {
        $Regular_image = $wpdb->get_var('SELECT Image FROM '.$table_name_regular.' WHERE id='.$Duniqueid);
        $Regular_image_preview = $Regular_image_preview_db = $Regular_image_db = $Regular_image;
    }
	if (isset($_POST['Savepreview_regular'])) {
   		if ($Regular_fileremove=='on') {$Regular_image=''; $Regular_image_db='';}
	}
	if ($Regular_fileremove=='on') {$Regular_image_preview=''; $Regular_image_preview_db='';}
	
	//background upload
	$Regular_bgfile = $_FILES['Regular_bg']['name'];
	$Regular_bgfileremove = $_POST['Regular_bgremove'];
	if ($Regular_bgfileremove=='on') {$Regular_bgfile='';}
    $Regular_bgpath = GenerationPlugin_uploads.basename($Regular_bgfile);
    if (move_uploaded_file($_FILES['Regular_bg']['tmp_name'], $Regular_bgpath)) {
        $Regular_bgarray = explode('.',$Regular_bgfile);
        $Regular_bgexten = $Regular_bgarray[count($Regular_bgarray)-1];
    	if (isset($_POST['Savepreview_regular'])) {
			$Regular_bgimage = GenerationPlugin_uploads.'Regular_bgimage.'.$Regular_bgexten;
			$Regular_bgimage_db = GenerationPlugin_uploads_db.'Regular_bgimage.'.$Regular_bgexten;
        	rename($Regular_bgpath, $Regular_bgimage);
		}
        $Regular_bgimage_preview = GenerationPlugin_uploads.'Regular_bgimage_preview.'.$Regular_bgexten;
        $Regular_bgimage_preview_db = GenerationPlugin_uploads_db.'Regular_bgimage_preview.'.$Regular_bgexten;
		if ($Regular_bgimage!='') { copy($Regular_bgimage, $Regular_bgimage_preview); }
        rename($Regular_bgpath, $Regular_bgimage_preview);
    } else {
        $Regular_bgimage = $wpdb->get_var('SELECT Bgimage FROM '.$table_name_regular.' WHERE id='.$Duniqueid);
        $Regular_bgimage_preview = $Regular_bgimage_preview_db = $Regular_bgimage_db = $Regular_bgimage;
    }
	if (isset($_POST['Savepreview_regular'])) {
   		if ($Regular_bgfileremove=='on') {$Regular_bgimage=''; $Regular_bgimage_db='';}
	}
	if ($Regular_bgfileremove=='on') {$Regular_bgimage_preview=''; $Regular_bgimage_preview_db='';}

	//custom content image upload
	$Regular_cbgfile = $_FILES['Regular_cbg']['name'];
	$Regular_cbgfileremove = $_POST['Regular_cbgremove'];
	if ($Regular_cbgfileremove=='on') {$Regular_cbgfile='';}
    $Regular_cbgpath = GenerationPlugin_uploads.basename($Regular_cbgfile);
    if (move_uploaded_file($_FILES['Regular_cbg']['tmp_name'], $Regular_cbgpath)) {
        $Regular_cbgarray = explode('.',$Regular_cbgfile);
        $Regular_cbgexten = $Regular_cbgarray[count($Regular_cbgarray)-1];
		if (isset($_POST['Savepreview_regular'])) {
			$Regular_cbgimage = GenerationPlugin_uploads.'Regular_cbgimage.'.$Regular_cbgexten;
			$Regular_cbgimage_db = GenerationPlugin_uploads_db.'Regular_cbgimage.'.$Regular_cbgexten;
        	rename($Regular_cbgpath, $Regular_cbgimage);
		}
        $Regular_cbgimage_preview = GenerationPlugin_uploads.'Regular_cbgimage_preview.'.$Regular_cbgexten;
        $Regular_cbgimage_preview_db = GenerationPlugin_uploads_db.'Regular_cbgimage_preview.'.$Regular_cbgexten;
		if ($Regular_cbgimage!='') { copy($Regular_cbgimage, $Regular_cbgimage_preview); }
        rename($Regular_cbgpath, $Regular_cbgimage_preview);
    } else {
        $Regular_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
    	$Regular_form_tmp = preg_replace("/\\\/","",$Regular_form);
        $Regular_formx = explode("|", $Regular_form_tmp);
    	$Regular_cbgimage = $Regular_formx[5];
        $Regular_cbgimage_preview = $Regular_cbgimage_preview_db = $Regular_cbgimage_db = $Regular_cbgimage;
    }
	if (isset($_POST['Savepreview_regular'])) {
   		if ($Regular_cbgfileremove=='on') {$Regular_cbgimage=''; $Regular_cbgimage_db='';}
	}
	if ($Regular_cbgfileremove=='on') {$Regular_cbgimage_preview=''; $Regular_cbgimage_preview_db='';}
	
	$Regular_form = $_POST['Regular_form']."|".$_POST['Regular_ccontent']."|".$_POST['Regular_clink']."|".$_POST['Regular_cclick1']."|".$_POST['Regular_cblank']."|".$Regular_cbgimage_preview_db."|".$_POST['Regular_cclick2']."|".$_POST['Regular_cwidth']."|".$_POST['Regular_cheight']."|".$_POST['Regular_cscroll'];
	$Regular_form_preview = $_POST['Regular_form']."|".$_POST['Regular_ccontent']."|".$_POST['Regular_clink']."|".$_POST['Regular_cclick1']."|".$_POST['Regular_cblank']."|".$Regular_cbgimage_db."|".$_POST['Regular_cclick2']."|".$_POST['Regular_cwidth']."|".$_POST['Regular_cheight']."|".$_POST['Regular_cscroll'];
	$Regular_startdate = $_POST['Regular_dstart'];
	if ($_POST['Regular_ddays']=="") { $Regular_days = ""; }
	elseif ($Regular_startdate!="") { $Regular_days = date("Y-m-d", strtotime($Regular_startdate." + ".$_POST['Regular_ddays']." days")); }
	else { $Regular_days = date("Y-m-d", strtotime(" + ".$_POST['Regular_ddays']." days")); }
	$Regular_display = implode(',',$_POST['Regular_pagelist']).'|'.implode(',',$_POST['Regular_catlist']).'|'.implode(',',$_POST['Regular_postlist']).'|'.$_POST['Regular_showsub'].'|'.$_POST['Regular_ddelay'].'|'.$Regular_days.'|'.$_POST['Regular_dstart'].'|'.$_POST['Regular_dstop'];

	//replace \n with html br before save to database
	$Regular_head=str_replace(array("\r\n", "\r", "\n"), '<br>', $Regular_head);
	$Regular_headdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Regular_headdes']);
	$Regular_spam=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Regular_spam']);
	
	//save to database
	if (isset($_POST['Savepreview_regular'])) {
    $wpdb->update($table_name_regular,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Regular_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Regular_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Regular_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Regular_image_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Regular_bgimage_db)),
    		  'Title'=>mysql_real_escape_string(trim($Regular_head)),
    		  'Text'=>mysql_real_escape_string(trim($Regular_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Regular_form)),
    		  'Regular'=>mysql_real_escape_string(trim($Regular_regular)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Regular_bg'])),
    		  'Social'=>mysql_real_escape_string(trim($Regular_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Regular_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Regular_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Regular_active'])),
			  'Display'=>mysql_real_escape_string(trim($Regular_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_regular,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Regular_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Regular_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Regular_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Regular_image_preview_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Regular_bgimage_preview_db)),
    		  'Title'=>mysql_real_escape_string(trim($Regular_head)),
    		  'Text'=>mysql_real_escape_string(trim($Regular_headdes)),
    		  'Form'=>mysql_real_escape_string(trim($Regular_form_preview)),
    		  'Regular'=>mysql_real_escape_string(trim($Regular_regular)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Regular_bg'])),
    		  'Social'=>mysql_real_escape_string(trim($Regular_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Regular_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Regular_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Regular_active'])),
			  'Display'=>mysql_real_escape_string(trim($Regular_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DRegular_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_theme = preg_replace("/\\\/","",$DRegular_theme);
$DRegular_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_link = preg_replace("/\\\/","",$DRegular_link);
$DRegular_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
if ($DRegular_link_blank=="_blank") {$DRegular_link_blank="checked";}
$DRegular_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_image = preg_replace("/\\\/","",$DRegular_image);
$DRegular_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_bgimage = preg_replace("/\\\/","",$DRegular_bgimage);
if ($DRegular_image!="") {$DRegular_image_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
if ($DRegular_bgimage!="") {$DRegular_bgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}

if ($DRegular_theme=='regular1') {
	$Dregular1_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularD1.gif">';
	$DRegular_show1 = 'style="display:block"';
	$DRegular_showcolor = 'style="display:none"';
	$DRegular_show2 = 'style="display:block"';
	$Regular_bg1_name = 'name="Regular_bg"';
	$Regular_bg2_name = 'name=""';
	$DRegular_selectBgs1 = 'style="display:inline"';
	$DRegular_selectBgs2 = 'style="display:none"';
	$DRegular_uploadimage = 'style="display:block"';
}
elseif ($DRegular_theme=='regular2') {
	$Dregular2_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularD2.gif">';
	$DRegular_show1 = 'style="display:block"';
	$DRegular_showcolor = 'style="display:none"';
	$DRegular_show2 = 'style="display:block"';
	$Regular_bg1_name = 'name="Regular_bg"';
	$Regular_bg2_name = 'name=""';
	$DRegular_selectBgs1 = 'style="display:inline"';
	$DRegular_selectBgs2 = 'style="display:none"';
	$DRegular_uploadimage = 'style="display:none"';
}
elseif ($DRegular_theme=='regular3') {
	$Dregular3_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularD3.gif">';
	$DRegular_show1 = 'style="display:block"';
	$DRegular_showcolor = 'style="display:block"';
	$DRegular_show2 = 'style="display:none"';
	$Regular_bg1_name = 'name="Regular_bg"';
	$Regular_bg2_name = 'name=""';
	$DRegular_selectBgs1 = 'style="display:inline"';
	$DRegular_selectBgs2 = 'style="display:none"';
	$DRegular_uploadimage = 'style="display:none"';
}
elseif ($DRegular_theme=='regular4') {
	$Dregular4_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularD4.gif">';
	$DRegular_show1 = 'style="display:none"';
	$DRegular_showcolor = 'style="display:block"';
	$DRegular_show2 = 'style="display:none"';
	$Regular_bg1_name = 'name="Regular_bg"';
	$Regular_bg2_name = 'name=""';
	$DRegular_selectBgs1 = 'style="display:inline"';
	$DRegular_selectBgs2 = 'style="display:none"';
	$DRegular_uploadimage = 'style="display:none"';
}
elseif ($DRegular_theme=='regular11') {
	$Dregular11_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularL1.gif">';
	$DRegular_show1 = 'style="display:block"';
	$DRegular_showcolor = 'style="display:none"';
	$DRegular_show2 = 'style="display:block"';
	$Regular_bg1_name = 'name=""';
	$Regular_bg2_name = 'name="Regular_bg"';
	$DRegular_selectBgs1 = 'style="display:none"';
	$DRegular_selectBgs2 = 'style="display:inline"';
	$DRegular_uploadimage = 'style="display:block"';
}
elseif ($DRegular_theme=='regular12') {
	$Dregular12_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularL2.gif">';
	$DRegular_show1 = 'style="display:block"';
	$DRegular_showcolor = 'style="display:none"';
	$DRegular_show2 = 'style="display:block"';
	$Regular_bg1_name = 'name=""';
	$Regular_bg2_name = 'name="Regular_bg"';
	$DRegular_selectBgs1 = 'style="display:none"';
	$DRegular_selectBgs2 = 'style="display:inline"';
	$DRegular_uploadimage = 'style="display:none"';
}
elseif ($DRegular_theme=='regular13') {
	$Dregular13_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularL3.gif">';
	$DRegular_show1 = 'style="display:block"';
	$DRegular_showcolor = 'style="display:block"';
	$DRegular_show2 = 'style="display:none"';
	$Regular_bg1_name = 'name=""';
	$Regular_bg2_name = 'name="Regular_bg"';
	$DRegular_selectBgs1 = 'style="display:none"';
	$DRegular_selectBgs2 = 'style="display:inline"';
	$DRegular_uploadimage = 'style="display:none"';
}
elseif ($DRegular_theme=='regular14') {
	$Dregular14_sel='selected'; $Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularL4.gif">';
	$DRegular_show1 = 'style="display:none"';
	$DRegular_showcolor = 'style="display:block"';
	$DRegular_show2 = 'style="display:none"';
	$Regular_bg1_name = 'name=""';
	$Regular_bg2_name = 'name="Regular_bg"';
	$DRegular_selectBgs1 = 'style="display:none"';
	$DRegular_selectBgs2 = 'style="display:inline"';
	$DRegular_uploadimage = 'style="display:none"';
}
else {
	$Dregular_view='<img id="regular1img" src="'.GenerationPlugin_preview.'/regularD1.gif">';
	$DRegular_show1 = 'style="display:block"';
	$DRegular_showcolor = 'style="display:none"';
	$DRegular_show2 = 'style="display:block"';
	$Regular_bg1_name = 'name="Regular_bg"';
	$Regular_bg2_name = 'name=""';
	$DRegular_selectBgs1 = 'style="display:inline"';
	$DRegular_selectBgs2 = 'style="display:none"';
	$DRegular_uploadimage = 'style="display:block"';
}

$DRegular_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_btncolor = preg_replace("/\\\/","",$DRegular_btncolor);
$DRegular_btncolor = explode("|", $DRegular_btncolor);
$DRegular_btncolor = $DRegular_btncolor[3];
if ($DRegular_btncolor=='stripe_darkred') {$DregularB1_sel='selected';} //stripe design
elseif ($DRegular_btncolor=='stripe_red') {$DregularB2_sel='selected';}
elseif ($DRegular_btncolor=='stripe_magenta') {$DregularB3_sel='selected';}
elseif ($DRegular_btncolor=='stripe_violetmagenta') {$DregularB4_sel='selected';}
elseif ($DRegular_btncolor=='stripe_violet') {$DregularB5_sel='selected';}
elseif ($DRegular_btncolor=='stripe_blueviolet') {$DregularB6_sel='selected';}
elseif ($DRegular_btncolor=='stripe_navyblue') {$DregularB7_sel='selected';}
elseif ($DRegular_btncolor=='stripe_darkblue') {$DregularB8_sel='selected';}
elseif ($DRegular_btncolor=='stripe_blue') {$DregularB9_sel='selected';}
elseif ($DRegular_btncolor=='stripe_turquoise') {$DregularB10_sel='selected';}
elseif ($DRegular_btncolor=='stripe_greenturquoise') {$DregularB11_sel='selected';}
elseif ($DRegular_btncolor=='stripe_darkgreen') {$DregularB12_sel='selected';}
elseif ($DRegular_btncolor=='stripe_green') {$DregularB13_sel='selected';}
elseif ($DRegular_btncolor=='stripe_lemon') {$DregularB14_sel='selected';}
elseif ($DRegular_btncolor=='stripe_yellow') {$DregularB15_sel='selected';}
elseif ($DRegular_btncolor=='stripe_orange') {$DregularB16_sel='selected';}
elseif ($DRegular_btncolor=='simple_darkred') {$DregularB21_sel='selected';} //simple design
elseif ($DRegular_btncolor=='simple_red') {$DregularB22_sel='selected';}
elseif ($DRegular_btncolor=='simple_magenta') {$DregularB23_sel='selected';}
elseif ($DRegular_btncolor=='simple_violetmagenta') {$DregularB24_sel='selected';}
elseif ($DRegular_btncolor=='simple_violet') {$DregularB25_sel='selected';}
elseif ($DRegular_btncolor=='simple_blueviolet') {$DregularB26_sel='selected';}
elseif ($DRegular_btncolor=='simple_navyblue') {$DregularB27_sel='selected';}
elseif ($DRegular_btncolor=='simple_darkblue') {$DregularB28_sel='selected';}
elseif ($DRegular_btncolor=='simple_blue') {$DregularB29_sel='selected';}
elseif ($DRegular_btncolor=='simple_turquoise') {$DregularB30_sel='selected';}
elseif ($DRegular_btncolor=='simple_greenturquoise') {$DregularB31_sel='selected';}
elseif ($DRegular_btncolor=='simple_darkgreen') {$DregularB32_sel='selected';}
elseif ($DRegular_btncolor=='simple_green') {$DregularB33_sel='selected';}
elseif ($DRegular_btncolor=='simple_lemon') {$DregularB34_sel='selected';}
elseif ($DRegular_btncolor=='simple_yellow') {$DregularB35_sel='selected';}
elseif ($DRegular_btncolor=='simple_orange') {$DregularB36_sel='selected';}

$DRegular_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_background = preg_replace("/\\\/","",$DRegular_background);
if ($DRegular_background=='bg2') {$DregularBackground2_sel='selected';}
elseif ($DRegular_background=='bg3') {$DregularBackground3_sel='selected';}
elseif ($DRegular_background=='bg4') {$DregularBackground4_sel='selected';}
elseif ($DRegular_background=='bg12') {$DregularBackground12_sel='selected';}
elseif ($DRegular_background=='bg13') {$DregularBackground13_sel='selected';}
elseif ($DRegular_background=='bg14') {$DregularBackground14_sel='selected';}

$DRegular_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_title_tmp = preg_replace("/\\\/","",$DRegular_title_tmp);
    $DRegular_title = explode("|", $DRegular_title_tmp);
	$DRegular_headclr = $DRegular_title[0];
	$DRegular_headtxt = $DRegular_title[1];
	$DRegular_headclr_c = $DRegular_title[2];
$DRegular_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_text = preg_replace("/\\\/","",$DRegular_text);
	
$DRegular_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_form_tmp = preg_replace("/\\\/","",$DRegular_form);
    $DRegular_formx = explode("|", $DRegular_form_tmp);
	$DRegular_form = $DRegular_formx[0];
	$DRegular_formtype = $DRegular_formx[1];
	$DRegular_clink = $DRegular_formx[2];
	$DRegular_cclick1 = $DRegular_formx[3];
	$DRegular_cblank = $DRegular_formx[4];
	if ($DRegular_cblank=="_blank") {$DRegular_cblank="checked";}
	$DRegular_cbgimage = $DRegular_formx[5];
	if ($DRegular_cbgimage!="") {$DRegular_cbgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
	$DRegular_cclick2 = $DRegular_formx[6];
	$DRegular_cwidth = $DRegular_formx[7];
	$DRegular_cheight = $DRegular_formx[8];
	$DRegular_cscroll = $DRegular_formx[9];
	if ($DRegular_cscroll=="scroll") {$DRegular_cscroll="checked";}

if ($DRegular_form=='regular' || $DRegular_form=='') {
	$Dregularf1_sel='selected'; 
	$Dregularf1_view='style="display:block"'; $Dregularf2_view='style="display:block"'; $Dregularf3_view='style="display:none"';
	$Dregularf4_view='style="display:none"'; $Dregularf5_view='style="display:none"';
	$Dregular_buttonss='style="display:block"'; $Dregular_adsection='style="display:block"';
	$Dregularf1_view_right='style="display:block"';
	$DRegular_stheme = 'style="display:inline"'; $DRegular_stheme_label = 'style="display:inline"';
	$Dregular_preview1 = 'style="display:block"'; $Dregular_preview2 = 'style="display:none"';
}
elseif ($DRegular_form=='social') {
	$Dregularf2_sel='selected'; 
	$Dregularf1_view='style="display:none"'; $Dregularf2_view='style="display:none"'; $Dregularf3_view='style="display:none"';
	$Dregularf4_view='style="display:none"'; $Dregularf5_view='style="display:none"';
	$Dregular_buttonss='style="display:block"'; $Dregular_adsection='style="display:block"';
	$Dregularf1_view_right='style="display:none"';
	$DRegular_stheme = 'style="display:inline"'; $DRegular_stheme_label = 'style="display:inline"';
	$Dregular_preview1 = 'style="display:block"'; $Dregular_preview2 = 'style="display:none"';
}
elseif ($DRegular_form=='both') {
	$Dregularf12_sel='selected'; 
	$Dregularf1_view='style="display:block"'; $Dregularf2_view='style="display:block"'; $Dregularf3_view='style="display:none"';
	$Dregularf4_view='style="display:none"'; $Dregularf5_view='style="display:none"';
	$Dregular_buttonss='style="display:block"'; $Dregular_adsection='style="display:block"';
	$Dregularf1_view_right='style="display:block"';
	$DRegular_stheme = 'style="display:inline"'; $DRegular_stheme_label = 'style="display:inline"';
	$Dregular_preview1 = 'style="display:block"'; $Dregular_preview2 = 'style="display:none"';
}
elseif ($DRegular_form=='link') {
	$Dregularf3_sel='selected'; 
	$Dregularf1_view='style="display:block"'; $Dregularf2_view='style="display:none"'; $Dregularf3_view='style="display:block"';
	$Dregularf4_view='style="display:none"'; $Dregularf5_view='style="display:none"';
	$Dregular_buttonss='style="display:block"'; $Dregular_adsection='style="display:block"';
	$Dregularf1_view_right='style="display:none"';
	$DRegular_stheme = 'style="display:inline"'; $DRegular_stheme_label = 'style="display:inline"';
	$Dregular_preview1 = 'style="display:block"'; $Dregular_preview2 = 'style="display:none"';
}
elseif ($DRegular_form=='custom') {
	$Dregularf4_sel='selected'; 
	$Dregularf1_view='style="display:none"'; $Dregularf2_view='style="display:none"'; $Dregularf3_view='style="display:block"';
	$Dregularf4_view='style="display:block"'; $Dregularf5_view='style="display:block"';
	$Dregular_buttonss='style="display:none"'; $Dregular_adsection='style="display:none"';
	$Dregularf1_view_right='style="display:none"';
	$DRegular_stheme = 'style="display:none"'; $DRegular_stheme_label = 'style="display:none"';
	$Dregular_preview1 = 'style="display:none"'; $Dregular_preview2 = 'style="display:block"';
}

if ($DRegular_formtype=='link' || $DRegular_formtype=='') {
	$Dregularf10_sel='selected';
	$Dregularf6_view='style="display:block"'; $Dregularf7_view='style="display:none"'; $Dregularf8_view='style="display:block"';
}
elseif ($DRegular_formtype=='image') {
	$Dregularf20_sel='selected';
	$Dregularf6_view='style="display:none"'; $Dregularf7_view='style="display:block"'; $Dregularf8_view='style="display:none"';
}
else {
	$Dregularf10_sel='selected';
	$Dregularf6_view='style="display:block"'; $Dregularf7_view='style="display:none"'; $Dregularf8_view='style="display:none"';
}

$DRegular_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_regular_tmp = preg_replace("/\\\/","",$DRegular_regular_tmp);
    $DRegular_regular = explode("|", $DRegular_regular_tmp);
	$Regular_fname = $DRegular_regular[0];
	$Regular_femail = $DRegular_regular[1];
	$Regular_fbtntxt = $DRegular_regular[2];
	$Regular_fbtnclr = $DRegular_regular[3];	
	if ($DRegular_regular[4]=="1") {$DRegular_name_disabled="checked";}
	
$DRegular_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_spam = preg_replace("/\\\/","",$DRegular_spam);
$DRegular_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_optin = preg_replace("/<br>/","\n",$DRegular_optin);
	$DRegular_optin = preg_replace("/\\\/","",$DRegular_optin);
	$DRegular_optin = explode("|",$DRegular_optin);
	if ($DRegular_optin[4]=="on") {$DRegular_optinch="checked";}
$DRegular_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_regular.' WHERE id='.$Duniqueid);
	if ($DRegular_active_tmp=="on") {$DRegular_active="checked";} else {$DRegular_activated='style="background-color:#FCC"';}

	//replace html br with \n before display in text field
	$DRegular_headtxt = preg_replace("/<br>/","\n",$DRegular_headtxt);
	$DRegular_text = preg_replace("/<br>/","\n",$DRegular_text);
	$DRegular_spam = preg_replace("/<br>/","\n",$DRegular_spam);
	
$DRegular_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
    $DRegular_display = explode("|", $DRegular_displays);
	$DRegular_dpages = $DRegular_display[0];
	$DRegular_dcats = $DRegular_display[1];
	$DRegular_dposts = $DRegular_display[2];
	if (strpos($DRegular_dpages,'allpages')!==false) {$DRegular_dpagesall="checked";}
	if (strpos($DRegular_dcats,'allcats')!==false) {$DRegular_dcatsall="checked";}
	if (strpos($DRegular_dposts,'allposts')!==false) {$DRegular_dpostsall="checked";}
	//if ($DRegular_dpagesall=="" && $DRegular_dcatsall=="" && $DRegular_dpostsall=="") {$DRegular_dcheckall="";}
	$DRegular_showsub = $DRegular_display[3];
	if ($DRegular_showsub=="on") {$DRegular_showsub="checked";}
	$DRegular_ddelay = $DRegular_display[4];
	$DRegular_ddays = $DRegular_display[5];
	$DRegular_dstart = $DRegular_display[6];
	$DRegular_dstop = $DRegular_display[7];
?>

<script type="text/javascript">
function sh5_theme(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='1') {
        document.getElementById("Regular_show1").style.display="block";
        document.getElementById("Regular_show2").style.display="block";
        document.getElementById("Regular_showcolor").style.display="none";
        document.getElementById("Regular_selectBgs1").name="Regular_bg";
        document.getElementById("Regular_selectBgs2").name="";
        document.getElementById("Regular_selectBgs1").style.display="inline";
        document.getElementById("Regular_selectBgs2").style.display="none";
        document.getElementById("Regular_uploadimage").style.display="block";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularD1.gif'; ?>">');
	} else if(sel.selectedIndex=='2') {
        document.getElementById("Regular_show1").style.display="block";
        document.getElementById("Regular_show2").style.display="block";
        document.getElementById("Regular_showcolor").style.display="none";
        document.getElementById("Regular_selectBgs1").name="Regular_bg";
        document.getElementById("Regular_selectBgs2").name="";
        document.getElementById("Regular_selectBgs1").style.display="inline";
        document.getElementById("Regular_selectBgs2").style.display="none";
        document.getElementById("Regular_uploadimage").style.display="none";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularD2.gif'; ?>">');
	} else if(sel.selectedIndex=='3') {
        document.getElementById("Regular_show1").style.display="block";
        document.getElementById("Regular_show2").style.display="none";
        document.getElementById("Regular_showcolor").style.display="block";
        document.getElementById("Regular_selectBgs1").name="Regular_bg";
        document.getElementById("Regular_selectBgs2").name="";
        document.getElementById("Regular_selectBgs1").style.display="inline";
        document.getElementById("Regular_selectBgs2").style.display="none";
        document.getElementById("Regular_uploadimage").style.display="none";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularD3.gif'; ?>">');
	} else if(sel.selectedIndex=='4' || sel.selectedIndex=='5') {
        document.getElementById("Regular_show1").style.display="none";
        document.getElementById("Regular_show2").style.display="none";
        document.getElementById("Regular_showcolor").style.display="block";
        document.getElementById("Regular_selectBgs1").name="Regular_bg";
        document.getElementById("Regular_selectBgs2").name="";
        document.getElementById("Regular_selectBgs1").style.display="inline";
        document.getElementById("Regular_selectBgs2").style.display="none";
        document.getElementById("Regular_uploadimage").style.display="none";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularD4.gif'; ?>">');
	} else if(sel.selectedIndex=='6' || sel.selectedIndex=='7') {
        document.getElementById("Regular_show1").style.display="block";
        document.getElementById("Regular_show2").style.display="block";
        document.getElementById("Regular_showcolor").style.display="none";
        document.getElementById("Regular_selectBgs1").name="";
        document.getElementById("Regular_selectBgs2").name="Regular_bg";
        document.getElementById("Regular_selectBgs1").style.display="none";
        document.getElementById("Regular_selectBgs2").style.display="inline";
        document.getElementById("Regular_uploadimage").style.display="block";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularL1.gif'; ?>">');
	} else if(sel.selectedIndex=='8') {
        document.getElementById("Regular_show1").style.display="block";
        document.getElementById("Regular_show2").style.display="block";
        document.getElementById("Regular_showcolor").style.display="none";
        document.getElementById("Regular_selectBgs1").name="";
        document.getElementById("Regular_selectBgs2").name="Regular_bg";
        document.getElementById("Regular_selectBgs1").style.display="none";
        document.getElementById("Regular_selectBgs2").style.display="inline";
        document.getElementById("Regular_uploadimage").style.display="none";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularL2.gif'; ?>">');
	} else if(sel.selectedIndex=='9') {
        document.getElementById("Regular_show1").style.display="block";
        document.getElementById("Regular_show2").style.display="none";
        document.getElementById("Regular_showcolor").style.display="block";
        document.getElementById("Regular_selectBgs1").name="";
        document.getElementById("Regular_selectBgs2").name="Regular_bg";
        document.getElementById("Regular_selectBgs1").style.display="none";
        document.getElementById("Regular_selectBgs2").style.display="inline";
        document.getElementById("Regular_uploadimage").style.display="none";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularL3.gif'; ?>">');
	} else if(sel.selectedIndex=='10') {
        document.getElementById("Regular_show1").style.display="none";
        document.getElementById("Regular_show2").style.display="none";
        document.getElementById("Regular_showcolor").style.display="block";
        document.getElementById("Regular_selectBgs1").name="";
        document.getElementById("Regular_selectBgs2").name="Regular_bg";
        document.getElementById("Regular_selectBgs1").style.display="none";
        document.getElementById("Regular_selectBgs2").style.display="inline";
        document.getElementById("Regular_uploadimage").style.display="none";
		$jj('#regular1').html('<img id="regular1img" src="<?php echo GenerationPlugin_preview.'/regularL4.gif'; ?>">');
	}
}
$jj(document).ready(function(){
	$jj("#Regular_name").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Regular_email").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Regular_btntxt").charCount({allowed:18, warning:0, /*counterText:'left: '*/});
	$jj("#Regular_headtxt").charCount({allowed:25, warning:0, /*counterText:'left: '*/});
	$jj("#Regular_headdes").charCount({allowed:80, warning:0, /*counterText:'left: '*/});
	$jj("#Regular_spam").charCount({allowed:80, warning:0, /*counterText:'left: '*/});
});
</script>


        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DRegular_activated; ?>>
				<input name="Regular_active" type="checkbox" <?php echo $DRegular_active; ?>> Activate Regular Optin
			</div>
            <select name="Regular_theme" id="selectregular" onchange="sh5_theme(this)" <?php echo $DRegular_stheme; ?>>
				<option value="regular1" style="color:#069; font-weight:bold">Graphite themes</option>
                <option value="regular1" <?php echo $Dregular1_sel; ?>>product</option>
                <option value="regular2" <?php echo $Dregular2_sel; ?>>standard</option>
                <option value="regular3" <?php echo $Dregular3_sel; ?>>mini</option>
                <option value="regular4" <?php echo $Dregular4_sel; ?>>micro</option>
				<option value="regular4">&nbsp;</option>
				<option value="regular11" style="color:#069; font-weight:bold">Silver themes</option>
                <option value="regular11" <?php echo $Dregular11_sel; ?>>product</option>
                <option value="regular12" <?php echo $Dregular12_sel; ?>>standard</option>
                <option value="regular13" <?php echo $Dregular13_sel; ?>>mini</option>
                <option value="regular14" <?php echo $Dregular14_sel; ?>>micro</option>
            </select> <span id="selectregular_label" <?php echo $DRegular_stheme_label; ?>>Template</span>
			<select name="Regular_form" onchange="sh7(this)">
				<option value="regular" <?php echo $Dregularf1_sel; ?>>regular</option>
				<option value="social" <?php echo $Dregularf2_sel; ?>>facebook</option>
				<option value="both" <?php echo $Dregularf12_sel; ?>>regular and facebook switch</option>
				<option value="link" <?php echo $Dregularf3_sel; ?>>link</option>
				<option value="custom" <?php echo $Dregularf4_sel; ?>>custom content</option>
			</select> Type of sign-up form
			<div id="xchoice71" <?php echo $Dregularf5_view; ?>>
    			<select name="Regular_ccontent" onchange="sh70(this)">
    				<option value="link" <?php echo $Dregularf10_sel; ?>>webpage</option>
    				<option value="image" <?php echo $Dregularf20_sel; ?>>image</option>
    			</select> Type of custom content
			</div>
			
			<div id="ichoice72" <?php echo $Dregularf4_view; ?>>
				<input style="display:none" name="Regular_cwidth" type="text" value="<?php echo $DRegular_cwidth; ?>">
				<div id="ichoice75" <?php echo $Dregularf8_view; ?>>
					<input name="Regular_cheight" type="text" value="<?php echo $DRegular_cheight; ?>"> Box height in pixels
				</div>
				<input style="display:none" name="Regular_cscroll" type="checkbox" value="scroll" <?php echo $DRegular_cscroll; ?>>
				<div id="ichoice73" <?php echo $Dregularf6_view; ?>>
					<input name="Regular_clink" type="text" value="<?php echo $DRegular_clink; ?>">
					<img id="helpbtn_regular8" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        			<span class="maxfile" id="helptip_regular8">URLs starting with 'https://' will not open in box due to security reasons.</span> Link to webpage
				</div>
				<div id="ichoice74" <?php echo $Dregularf7_view; ?>>
					<input name="Regular_cbg" type="file" size="26">
        			<?php if (filesize($DRegular_cbgimage)>=1048576) { ?>
        				<img id="helpbtn_regular9" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
        				<span class="maxfilewarning" id="helptip_regular9">Max 1Mb!</span>
        			<?php } else { ?>
        				<img id="helpbtn_regular9" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        				<span class="maxfile" id="helptip_regular9">Max 1Mb</span>
        			<?php } ?>
        			<?php echo $DRegular_cbgimage_img; ?>
					<span style="display:inline; margin-bottom:100px">Upload an image...</span>
        			<br/>
        			<input name="Regular_cbgremove" type="checkbox"> Remove uploaded image
					<br/>
    				<input name="Regular_cclick1" type="text" value="<?php echo $DRegular_cclick1; ?>"> ...or use external image
					<br/>
    				<input name="Regular_cclick2" type="text" value="<?php echo $DRegular_cclick2; ?>"> Link for <i>click</i> action
					<br/>
					<input name="Regular_cblank" type="checkbox" value="_blank" <?php echo $DRegular_cblank; ?>> Open the link in new tab
				</div>
			</div>
			
            <div id="choice70" name="choice71"  <?php echo $Dregularf1_view; ?>>
				<div id="ichoice70" <?php echo $Dregularf2_view; ?>>
					<div id="Regular_show1" <?php echo $DRegular_show1; ?>>
    					<input id="Regular_name" name="Regular_name" type="text" value="<?php echo $Regular_fname; ?>"> 'Name' default value
					<br/>
					<input name="Regular_name_disabled" type="checkbox" value="1" <?php echo $DRegular_name_disabled; ?>> Do not show 'Name' field in form
                    <br/>
					</div>
                    <input id="Regular_email" name="Regular_email" type="text" value="<?php echo $Regular_femail; ?>"> 'Email' default value
                    <br/>
				</div>
				<div id="ichoice71" <?php echo $Dregularf3_view; ?>>	
					<input name="Regular_link" type="text" value="<?php echo $DRegular_link; ?>"> Destin. page
					<br/>
					<input name="Regular_link_blank" type="checkbox" value="_blank" <?php echo $DRegular_link_blank; ?>> Open the page in new tab
					<br/>
				</div>
				
				<div id="Regular_buttonss" <?php echo $Dregular_buttonss; ?>>
                <input id="Regular_btntxt" name="Regular_btntxt" type="text" value="<?php echo $Regular_fbtntxt; ?>"> Button text
                <br/>
				<select name="Regular_btnclr" id="selectButtons">
					<option style="margin-left:-136px; color:#069; font-weight:bold">Stripe design</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark.gif'; ?>)" 
						value="stripe_darkred" <?php echo $DregularB1_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red.gif'; ?>)" 
						value="stripe_red" <?php echo $DregularB2_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta.gif'; ?>)" 
						value="stripe_magenta" <?php echo $DregularB3_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta.gif'; ?>)" 
						value="stripe_violetmagenta" <?php echo $DregularB4_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet.gif'; ?>)" 
						value="stripe_violet" <?php echo $DregularB5_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet.gif'; ?>)" 
						value="stripe_blueviolet" <?php echo $DregularB6_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy.gif'; ?>)" 
						value="stripe_navyblue" <?php echo $DregularB7_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark.gif'; ?>)" 
						value="stripe_darkblue" <?php echo $DregularB8_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue.gif'; ?>)" 
						value="stripe_blue" <?php echo $DregularB9_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise.gif'; ?>)" 
						value="stripe_turquoise" <?php echo $DregularB10_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise.gif'; ?>)" 
						value="stripe_greenturquoise" <?php echo $DregularB11_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark.gif'; ?>)" 
						value="stripe_darkgreen" <?php echo $DregularB12_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green.gif'; ?>)" 
						value="stripe_green" <?php echo $DregularB13_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon.gif'; ?>)" 
						value="stripe_lemon" <?php echo $DregularB14_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow.gif'; ?>)" 
						value="stripe_yellow" <?php echo $DregularB15_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange.gif'; ?>)" 
						value="stripe_orange" <?php echo $DregularB16_sel; ?>>orange</option>
					<option>&nbsp;</option>
					<option style="margin-left:-136px; color:#069; font-weight:bold">Simple design</option>
					<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark2.gif'; ?>)" 
						value="simple_darkred" <?php echo $DregularB21_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red2.gif'; ?>)" 
						value="simple_red" <?php echo $DregularB22_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta2.gif'; ?>)" 
						value="simple_magenta" <?php echo $DregularB23_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta2.gif'; ?>)" 
						value="simple_violetmagenta" <?php echo $DregularB24_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet2.gif'; ?>)" 
                        value="simple_violet" <?php echo $DregularB25_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet2.gif'; ?>)" 
  						value="simple_blueviolet" <?php echo $DregularB26_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy2.gif'; ?>)" 
						value="simple_navyblue" <?php echo $DregularB27_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark2.gif'; ?>)" 
						value="simple_darkblue" <?php echo $DregularB28_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue2.gif'; ?>)" 
						value="simple_blue" <?php echo $DregularB29_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise2.gif'; ?>)" 
						value="simple_turquoise" <?php echo $DregularB30_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise2.gif'; ?>)" 
						value="simple_greenturquoise" <?php echo $DregularB31_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark2.gif'; ?>)" 
						value="simple_darkgreen" <?php echo $DregularB32_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green2.gif'; ?>)" 
						value="simple_green" <?php echo $DregularB33_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon2.gif'; ?>)" 
						value="simple_lemon" <?php echo $DregularB34_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow2.gif'; ?>)" 
						value="simple_yellow" <?php echo $DregularB35_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange2.gif'; ?>)" 
						value="simple_orange" <?php echo $DregularB36_sel; ?>>orange</option>
				</select> Button color
				</div>
			</div>
			
			<div id="Regular_adsection" <?php echo $Dregular_adsection; ?>>
			
			<div id="Regular_showcolor" <?php echo $DRegular_showcolor; ?>>
            	<input name="Regular_headclr" type="text" id="colorregular" value="<?php echo $DRegular_headclr; ?>" />
    			<div style="margin:0 0 -25px 235px">
    				<input style="position:absolute; margin:5px 0 0 -21px" name="Regular_headclr_c" type="checkbox" value="on" <?php if ($DRegular_headclr_c=="on") {echo "checked";} ?> />
					<img id="helpbtn_regular5" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
					<span class="headclrhelp" id="helptip_regular5">Pick your color and check the checkbox to setup headers color different than button color.</span>
    				Custom headers color
    			</div>
            <br/>
			</div>
			<textarea id="Regular_headtxt" name="Regular_headtxt"><?php echo $DRegular_headtxt; ?></textarea>
			<img id="helpbtn_regular6" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
			<span class="countdownhelp" id="helptip_regular6">Use number in brackets (max '90') to add countdown timer. Number in brackets = minutes, e.g.(57).</span>
			Header text
            <br/>
			<div id="Regular_show2" <?php echo $DRegular_show2; ?>>
            	<textarea id="Regular_headdes" name="Regular_headdes"><?php echo $DRegular_text; ?></textarea> Header description
            <br/>
			</div>
            <textarea class="m8px" id="Regular_spam" name="Regular_spam"><?php echo $DRegular_spam; ?></textarea> Anti-spam note
            <br/>
			<select <?php echo $Regular_bg1_name; ?> id="Regular_selectBgs1" <?php echo $DRegular_selectBgs1; ?>>
					<option style="margin-left:-136px">Dark backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_noise.gif'; ?>)" 
						value="bg2" <?php echo $DregularBackground2_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_carbonfiber.gif'; ?>)" 
						value="bg3" <?php echo $DregularBackground3_sel; ?>>carbon fiber</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_wood.gif'; ?>)" 
						value="bg4" <?php echo $DregularBackground4_sel; ?>>wood</option>
			</select>	
			<select <?php echo $Regular_bg2_name; ?> id="Regular_selectBgs2" <?php echo $DRegular_selectBgs2; ?>>
					<option style="margin-left:-136px">Light backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_noise.gif'; ?>)" 
						value="bg12" <?php echo $DregularBackground12_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_sparkles.gif'; ?>)" 
						value="bg13" <?php echo $DregularBackground13_sel; ?>>sparkles</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_blur.gif'; ?>)" 
						value="bg14" <?php echo $DregularBackground14_sel; ?>>blur</option>
			</select> <span style="display:inline">Product background</span>
			<br/>
            <input name="Regular_bg" type="file" size="26">
			<?php if (filesize($DRegular_bgimage)>=307201) { ?>
				<img id="helpbtn_regular3" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_regular3">Max 300kb!</span>
			<?php } else { ?>
				<img id="helpbtn_regular3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_regular3">Max 300kb</span>
			<?php } ?>
			<?php echo $DRegular_bgimage_img; ?>
			<br/>
			<input name="Regular_bgremove" type="checkbox"> Remove uploaded background
			<br/>
			<div id="Regular_uploadimage" <?php echo $DRegular_uploadimage; ?>>
                <input class="m8px" name="Regular_file" type="file" size="26">
    			<?php if (filesize($DRegular_image)>=81921) { ?>
    				<img id="helpbtn_regular4" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
    				<span class="maxfilewarning" id="helptip_regular4">Max 70kb! (200x220px)</span>
    			<?php } else { ?>
    				<img id="helpbtn_regular4" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
    				<span class="maxfile" id="helptip_regular4">Max 70kb (200x220px)</span>
    			<?php } ?>
    			<?php echo $DRegular_image_img; ?> Product image
    			<br/>
    			<input name="Regular_fileremove" type="checkbox"> Remove uploaded image
			</div>
        </div>
		
        </div>
            
        <div class="right_section" id="regular_checkboxes">
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_regular1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_regular1">Click here to show options. Use widget to display.</span>
			</h4>
            <div class="toggle">
				<div class="gpadminoptional">
					Displaying settings are optional for this tool. Read instruction for details.
				</div>
				<input style="display:inline-block;" type="checkbox" name="Regular_pagelist[]" value="allpages" <?php echo $DRegular_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DRegular_dpages_front="front";
				if (strpos(','.$DRegular_dpages.',',',front,')!==false || $DRegular_displays=="") {$DRegular_dpagesch[$DRegular_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Regular_pagelist[]" value="front" '.$DRegular_dpagesch[$DRegular_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DRegular_dpages_search="search";
				if (strpos(','.$DRegular_dpages.',',',search,')!==false || $DRegular_displays=="") {$DRegular_dpagesch[$DRegular_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Regular_pagelist[]" value="search" '.$DRegular_dpagesch[$DRegular_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DRegular_dpages_author="author";
				if (strpos(','.$DRegular_dpages.',',',author,')!==false || $DRegular_displays=="") {$DRegular_dpagesch[$DRegular_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Regular_pagelist[]" value="author" '.$DRegular_dpagesch[$DRegular_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order'); 
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DRegular_dpages.',',','.trim($pageID).',')!==false || $DRegular_displays=="") {$DRegular_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Regular_pagelist[]" value="'.$pageID.'" '.$DRegular_dpagesch[$pageID].'>';
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
 							if (strpos(','.$DRegular_dpages.',',','.trim($childID).',')!==false || $DRegular_displays=="") {$DRegular_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Regular_pagelist[]" value="'.$childID.'" '.$DRegular_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Regular_catlist[]" value="allcats" <?php echo $DRegular_dcatsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DRegular_dcats.',',','.trim($cat_id).',')!==false || $DRegular_displays=="") {$DRegular_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Regular_catlist[]" value="'.$cat_id.'" '.$DRegular_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Regular_postlist[]" value="allposts" <?php echo $DRegular_dpostsall; ?>>
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
							if (strpos(','.$DRegular_dposts.',',','.trim($id).',')!==false || $DRegular_displays=="") {$DRegular_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Regular_postlist[]" value="'.$id.'" '.$DRegular_dpostsch[$id].'>&nbsp;';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="Regular_showsub" <?php echo $DRegular_showsub; ?>>
					&nbsp;<span style="color:#069">Do NOT show to subscribers</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="regular_checkboxes_switch" <?php echo $DRegular_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Regular_dstart" type="text" value="<?php echo $DRegular_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Regular_dstop" type="text" value="<?php echo $DRegular_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Regular_ddays" type="text" value="<?php echo $DRegular_ddays; ?>"> days<br>
				-->
				
            </div>
			
			<h4 id="right_choice70" class="hiddens" <?php echo $Dregularf1_view_right; ?>>
				Opt-in settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_regular7" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_regular7">Click here to show options.</span>
			</h4>
            <div id="Regular_optin" class="toggle" <?php echo $Dregularf1_view_right; ?>>
					<div class="gpadminoptional" style="margin-bottom:0; width:535px">
						Make sure there is data in 'form action' field. Otherwise change 'form' to 'formc' in your opt-in code.
					</div>
                    <textarea name="Regular_optin1" id="gpoptinform_regular"><?php echo str_replace(":::","|",$DRegular_optin[0]); ?></textarea> Opt-in code<br/>
                    <div id="gpformarea_regular" style="display:none"></div>
                    <input type="button" value="Process" id="gpproccessit_regular"><br/>
					<textarea style="margin:3px 0" name="Regular_optin5" id="gpformaction_regular"><?php echo $DRegular_optin[4]; ?></textarea> form action<br/>
                    <select name="Regular_optin2" id="gpnamefield_regular">
    					<option value="<?php echo $DRegular_optin[1]; ?>"><?php echo $DRegular_optin[1]; ?></option>
    				</select> 'NAME' field<br/>
                    <select name="Regular_optin3" id="gpemailfield_regular">
    					<option value="<?php echo $DRegular_optin[2]; ?>"><?php echo $DRegular_optin[2]; ?></option>
    				</select> 'EMAIL' field<br/>
                    <!-- <input name="Regular_optin4" value="on" type="checkbox" id="gpdisablename_regular" <?php echo $DRegular_optinch; ?>> disable NAME field<br/> -->
                    <input type="checkbox" id="gpshowalldata_regular"> show all processed data<br/>
                    <div id="gpalldata_regular" style="display:none">
                        <textarea name="Regular_optin6" id="gphiddenfields_regular"><?php echo $DRegular_optin[5]; ?></textarea> hidden fields<br/>
                        <textarea name="Regular_optin7" id="gpignoredfields_regular"><?php echo $DRegular_optin[6]; ?></textarea> ignored fields<br/>
                        <textarea name="Regular_optin8" id="gpotherfields_regular"><?php echo $DRegular_optin[7]; ?></textarea> other fields<br/>
                        <textarea name="Regular_optin9" id="gpsubmitbutton_regular"><?php echo $DRegular_optin[8]; ?></textarea> submit button<br/>
                    </div><br/>
			</div>
			
        	<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_regular2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_regular2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="regular1" class="preview7" <?php echo $Dregular_preview1; ?>><?php echo $Dregular_view; ?></div>
			<div id="regular2" class="preview7" <?php echo $Dregular_preview2; ?>><img src="<?php echo GenerationPlugin_preview.'/regularCC.gif'; ?>"></div>
        </div>

		
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_regular" type="hidden" value="Save Changes">
    		<input id="Savepreview_regular" name="Savepreview_regular" type="hidden" value="Savepreview_regular">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_regular').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div>  
