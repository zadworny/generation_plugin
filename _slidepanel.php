<div id="tab2" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_slider" enctype="multipart/form-data">


<?php
if (isset($_POST['displayingformsent_slider'])=='Save Changes') {

	//multiple values into one database cell
	if ($_POST['Slider_headclr_c']=="on") {$Slider_headclr=$_POST['Slider_headclr'];}
	elseif ($_POST['Slider_form']=="social") {$Slider_headclr="0d66ae";}
	elseif ($_POST['Slider_btnclr']=="stripe_darkred" || $_POST['Slider_btnclr']=="simple_darkred") {$Slider_headclr="a92e20";}
	elseif ($_POST['Slider_btnclr']=="stripe_red" || $_POST['Slider_btnclr']=="simple_red") {$Slider_headclr="d53929";}
	elseif ($_POST['Slider_btnclr']=="stripe_magenta" || $_POST['Slider_btnclr']=="simple_magenta") {$Slider_headclr="c73272";}
	elseif ($_POST['Slider_btnclr']=="stripe_violetmagenta" || $_POST['Slider_btnclr']=="simple_violetmagenta") {$Slider_headclr="b940b3";}
	elseif ($_POST['Slider_btnclr']=="stripe_violet" || $_POST['Slider_btnclr']=="simple_violet") {$Slider_headclr="6c4ab2";}
	elseif ($_POST['Slider_btnclr']=="stripe_blueviolet" || $_POST['Slider_btnclr']=="simple_blueviolet") {$Slider_headclr="4442ad";}
	elseif ($_POST['Slider_btnclr']=="stripe_navyblue" || $_POST['Slider_btnclr']=="simple_navyblue") {$Slider_headclr="286c9e";}
	elseif ($_POST['Slider_btnclr']=="stripe_darkblue" || $_POST['Slider_btnclr']=="simple_darkblue") {$Slider_headclr="387dab";}
	elseif ($_POST['Slider_btnclr']=="stripe_blue" || $_POST['Slider_btnclr']=="simple_blue") {$Slider_headclr="299eb9";}
	elseif ($_POST['Slider_btnclr']=="stripe_turquoise" || $_POST['Slider_btnclr']=="simple_turquoise") {$Slider_headclr="38b5af";}
	elseif ($_POST['Slider_btnclr']=="stripe_greenturquoise" || $_POST['Slider_btnclr']=="simple_greenturquoise") {$Slider_headclr="2cc183";}
	elseif ($_POST['Slider_btnclr']=="stripe_darkgreen" || $_POST['Slider_btnclr']=="simple_darkgreen") {$Slider_headclr="5ca138";}
	elseif ($_POST['Slider_btnclr']=="stripe_green" || $_POST['Slider_btnclr']=="simple_green") {$Slider_headclr="93b73f";}
	elseif ($_POST['Slider_btnclr']=="stripe_lemon" || $_POST['Slider_btnclr']=="simple_lemon") {$Slider_headclr="d6ce28";}
	elseif ($_POST['Slider_btnclr']=="stripe_yellow" || $_POST['Slider_btnclr']=="simple_yellow") {$Slider_headclr="d1bd26";}
	elseif ($_POST['Slider_btnclr']=="stripe_orange" || $_POST['Slider_btnclr']=="simple_orange") {$Slider_headclr="e68f1b";}
	else {$Slider_headclr="CC3300";}
	$Slider_head = "#".trim($Slider_headclr."|".$_POST['Slider_headtxt']."|".$_POST['Slider_headclr_c'], "#");
	$Slider_list = $_POST['Slider_point1']."|".$_POST['Slider_point2']."|".$_POST['Slider_point3']."|".$_POST['Slider_point4']."|".$_POST['Slider_point5']."|".$_POST['Slider_point6'];
	$Slider_regular = $_POST['Slider_name']."|".$_POST['Slider_email']."|".$_POST['Slider_btntxt']."|".$_POST['Slider_btnclr']."|".$_POST['Slider_name_disabled'];
	$Slider_social = "facebook";
	$Slider_background = $_POST['Slider_bg']."|".$_POST['Slider_screencolor']."|".$_POST['Slider_screenopacity'];
	$Slider_optin = trim(str_replace("|",":::",$_POST['Slider_optin1']))."|".trim($_POST['Slider_optin2'])."|".trim($_POST['Slider_optin3'])."|".trim($_POST['Slider_optin4'])."|".trim($_POST['Slider_optin5'])."|".trim($_POST['Slider_optin6'])."|".trim($_POST['Slider_optin7'])."|".trim($_POST['Slider_optin8'])."|".trim($_POST['Slider_optin9']);
    $Slider_optin = str_replace(array("\r\n", "\r", "\n"), '<br>', $Slider_optin);

	//image upload
	$Slider_file = $_FILES['Slider_file']['name'];
    $Slider_fileremove = $_POST['Slider_fileremove'];
    if ($Slider_fileremove=='on') {$Slider_file='';}
    $Slider_path = GenerationPlugin_uploads.basename($Slider_file);
    if (move_uploaded_file($_FILES['Slider_file']['tmp_name'], $Slider_path)) {
        $Slider_array = explode('.',$Slider_file);
    	$Slider_exten = $Slider_array[count($Slider_array)-1];
		if (isset($_POST['Savepreview_slider'])) {
			$Slider_image = GenerationPlugin_uploads.'Slider_image.'.$Slider_exten;
			$Slider_image_db = GenerationPlugin_uploads_db.'Slider_image.'.$Slider_exten;
        	rename($Slider_path, $Slider_image);
		}
        $Slider_image_preview = GenerationPlugin_uploads.'Slider_image_preview.'.$Slider_exten;
        $Slider_image_preview_db = GenerationPlugin_uploads_db.'Slider_image_preview.'.$Slider_exten;
		if ($Slider_image!='') { copy($Slider_image, $Slider_image_preview); }
        rename($Slider_path, $Slider_image_preview);
    } else {
        $Slider_image = $wpdb->get_var('SELECT Image FROM '.$table_name_slider.' WHERE id='.$Duniqueid);
        $Slider_image_preview = $Slider_image_preview_db = $Slider_image_db = $Slider_image;
    }
	if (isset($_POST['Savepreview_slider'])) {
   		if ($Slider_fileremove=='on') {$Slider_image=''; $Slider_image_db='';}
	}
	if ($Slider_fileremove=='on') {$Slider_image_preview=''; $Slider_image_preview_db='';}

	//background upload
	$Slider_bgfile = $_FILES['Slider_bg']['name'];
	$Slider_bgfileremove = $_POST['Slider_bgremove'];
	if ($Slider_bgfileremove=='on') {$Slider_bgfile='';}
    $Slider_bgpath = GenerationPlugin_uploads.basename($Slider_bgfile);
    if (move_uploaded_file($_FILES['Slider_bg']['tmp_name'], $Slider_bgpath)) {
        $Slider_bgarray = explode('.',$Slider_bgfile);
        $Slider_bgexten = $Slider_bgarray[count($Slider_bgarray)-1];
    	if (isset($_POST['Savepreview_slider'])) {
			$Slider_bgimage = GenerationPlugin_uploads.'Slider_bgimage.'.$Slider_bgexten;
			$Slider_bgimage_db = GenerationPlugin_uploads_db.'Slider_bgimage.'.$Slider_bgexten;
        	rename($Slider_bgpath, $Slider_bgimage);
		}
        $Slider_bgimage_preview = GenerationPlugin_uploads.'Slider_bgimage_preview.'.$Slider_bgexten;
        $Slider_bgimage_preview_db = GenerationPlugin_uploads_db.'Slider_bgimage_preview.'.$Slider_bgexten;
		if ($Slider_bgimage!='') { copy($Slider_bgimage, $Slider_bgimage_preview); }
        rename($Slider_bgpath, $Slider_bgimage_preview);
    } else {
        $Slider_bgimage = $wpdb->get_var('SELECT Bgimage FROM '.$table_name_slider.' WHERE id='.$Duniqueid);
        $Slider_bgimage_preview = $Slider_bgimage_preview_db = $Slider_bgimage_db = $Slider_bgimage;
    }
	if (isset($_POST['Savepreview_slider'])) {
   		if ($Slider_bgfileremove=='on') {$Slider_bgimage=''; $Slider_bgimage_db='';}
	}
	if ($Slider_bgfileremove=='on') {$Slider_bgimage_preview=''; $Slider_bgimage_preview_db='';}

	//custom content image upload
	$Slider_cbgfile = $_FILES['Slider_cbg']['name'];
	$Slider_cbgfileremove = $_POST['Slider_cbgremove'];
	if ($Slider_cbgfileremove=='on') {$Slider_cbgfile='';}
    $Slider_cbgpath = GenerationPlugin_uploads.basename($Slider_cbgfile);
    if (move_uploaded_file($_FILES['Slider_cbg']['tmp_name'], $Slider_cbgpath)) {
        $Slider_cbgarray = explode('.',$Slider_cbgfile);
        $Slider_cbgexten = $Slider_cbgarray[count($Slider_cbgarray)-1];
		if (isset($_POST['Savepreview_slider'])) {
			$Slider_cbgimage = GenerationPlugin_uploads.'Slider_cbgimage.'.$Slider_cbgexten;
			$Slider_cbgimage_db = GenerationPlugin_uploads_db.'Slider_cbgimage.'.$Slider_cbgexten;
        	rename($Slider_cbgpath, $Slider_cbgimage);
		}
        $Slider_cbgimage_preview = GenerationPlugin_uploads.'Slider_cbgimage_preview.'.$Slider_cbgexten;
        $Slider_cbgimage_preview_db = GenerationPlugin_uploads_db.'Slider_cbgimage_preview.'.$Slider_cbgexten;
		if ($Slider_cbgimage!='') { copy($Slider_cbgimage, $Slider_cbgimage_preview); }
        rename($Slider_cbgpath, $Slider_cbgimage_preview);
    } else {
        $Slider_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
    	$Slider_form_tmp = preg_replace("/\\\/","",$Slider_form);
        $Slider_formx = explode("|", $Slider_form_tmp);
    	$Slider_cbgimage = $Slider_formx[5];
        $Slider_cbgimage_preview = $Slider_cbgimage_preview_db = $Slider_cbgimage_db = $Slider_cbgimage;
    }
	if (isset($_POST['Savepreview_slider'])) {
   		if ($Slider_cbgfileremove=='on') {$Slider_cbgimage=''; $Slider_cbgimage_db='';}
	}
	if ($Slider_cbgfileremove=='on') {$Slider_cbgimage_preview=''; $Slider_cbgimage_preview_db='';}
	
	$Slider_form = $_POST['Slider_form']."|".$_POST['Slider_ccontent']."|".$_POST['Slider_clink']."|".$_POST['Slider_cclick1']."|".$_POST['Slider_cblank']."|".$Slider_cbgimage_db."|".$_POST['Slider_cclick2']."|".$_POST['Slider_cwidth']."|".$_POST['Slider_cheight']."|".$_POST['Slider_cscroll']."|".$_POST['Slider_orientation']."|".$_POST['Slider_cfullw']."|".$_POST['Slider_bookmarkclr'];
	$Slider_form_preview = $_POST['Slider_form']."|".$_POST['Slider_ccontent']."|".$_POST['Slider_clink']."|".$_POST['Slider_cclick1']."|".$_POST['Slider_cblank']."|".$Slider_cbgimage_preview_db."|".$_POST['Slider_cclick2']."|".$_POST['Slider_cwidth']."|".$_POST['Slider_cheight']."|".$_POST['Slider_cscroll']."|".$_POST['Slider_orientation']."|".$_POST['Slider_cfullw']."|".$_POST['Slider_bookmarkclr'];
	$Slider_startdate = $_POST['Slider_dstart'];
	if ($_POST['Slider_ddays']=="") { $Slider_days = ""; }
	elseif ($Slider_startdate!="") { $Slider_days = date("Y-m-d", strtotime($Slider_startdate." + ".$_POST['Slider_ddays']." days")); }
	else { $Slider_days = date("Y-m-d", strtotime(" + ".$_POST['Slider_ddays']." days")); }
	$Slider_display = implode(',',$_POST['Slider_pagelist']).'|'.implode(',',$_POST['Slider_catlist']).'|'.implode(',',$_POST['Slider_postlist']).'|'.$_POST['Slider_showsub'].'|'.$_POST['Slider_ddelay'].'|'.$Slider_days.'|'.$_POST['Slider_dstart'].'|'.$_POST['Slider_dstop'];

	//replace \n with html br before save to database
	$Slider_head=str_replace(array("\r\n", "\r", "\n"), '<br>', $Slider_head);
	$Slider_headdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Slider_headdes']);
	$Slider_formtxt=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Slider_formtxt']);
	$Slider_formdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Slider_formdes']);
	$Slider_spam=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Slider_spam']);
	
	//save to database
	if (isset($_POST['Savepreview_slider'])) {
    $wpdb->update($table_name_slider,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Slider_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Slider_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Slider_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Slider_image_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Slider_bgimage_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Slider_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Slider_head)),
    		  'Text'=>mysql_real_escape_string(trim($Slider_headdes)),
    		  'Formtitle'=>mysql_real_escape_string(trim($Slider_formtxt)),
    		  'Formtext'=>mysql_real_escape_string(trim($Slider_formdes)),
    		  'Listpoint'=>mysql_real_escape_string(trim($Slider_list)),
    		  'Video'=>mysql_real_escape_string(trim($_POST['Slider_video'])),
    		  'Form'=>mysql_real_escape_string(trim($Slider_form)),
    		  'Regular'=>mysql_real_escape_string(trim($Slider_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Slider_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Slider_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Slider_optin)),
    		  'Slidelink'=>mysql_real_escape_string(trim($_POST['Slider_bookmark'])),
			  'Active'=>mysql_real_escape_string(trim($_POST['Slider_active'])),
			  'Display'=>mysql_real_escape_string(trim($Slider_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_slider,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Slider_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Slider_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Slider_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Slider_image_preview_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Slider_bgimage_preview_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Slider_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Slider_head)),
    		  'Text'=>mysql_real_escape_string(trim($Slider_headdes)),
    		  'Formtitle'=>mysql_real_escape_string(trim($Slider_formtxt)),
    		  'Formtext'=>mysql_real_escape_string(trim($Slider_formdes)),
    		  'Listpoint'=>mysql_real_escape_string(trim($Slider_list)),
    		  'Video'=>mysql_real_escape_string(trim($_POST['Slider_video'])),
    		  'Form'=>mysql_real_escape_string(trim($Slider_form_preview)),
    		  'Regular'=>mysql_real_escape_string(trim($Slider_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Slider_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Slider_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Slider_optin)),
    		  'Slidelink'=>mysql_real_escape_string(trim($_POST['Slider_bookmark'])),
			  'Active'=>mysql_real_escape_string(trim($_POST['Slider_active'])),
			  'Display'=>mysql_real_escape_string(trim($Slider_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DSlider_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_theme = preg_replace("/\\\/","",$DSlider_theme);
$DSlider_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_link = preg_replace("/\\\/","",$DSlider_link);
$DSlider_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
if ($DSlider_link_blank=="_blank") {$DSlider_link_blank="checked";}
$DSlider_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_image = preg_replace("/\\\/","",$DSlider_image);
$DSlider_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_bgimage = preg_replace("/\\\/","",$DSlider_bgimage);
if ($DSlider_image!="") {$DSlider_image_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
if ($DSlider_bgimage!="") {$DSlider_bgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}

if ($DSlider_theme=='slider1') {
	$Dslider1_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD5T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider2') {
	$Dslider2_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD5B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider3') {
	$Dslider3_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD5L.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider4') {
	$Dslider4_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD5R.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider5') {
	$Dslider5_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD4T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider6') {
	$Dslider6_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD4B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider7') {
	$Dslider7_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD3T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider8') {
	$Dslider8_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD3B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider9') {
	$Dslider9_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD2T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider10') {
	$Dslider10_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD2B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider11') {
	$Dslider11_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD1T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider12') {
	$Dslider12_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD1B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider13') {
	$Dslider13_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD8T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider14') {
	$Dslider14_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD8B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider15') {
	$Dslider15_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD8L.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider16') {
	$Dslider16_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD8R.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider17') {
	$Dslider17_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD6T.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider18') {
	$Dslider18_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD6B.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider19') {
	$Dslider19_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD7T.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider20') {
	$Dslider20_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD7B.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:none"';
}
else if ($DSlider_theme=='slider31') {
	$Dslider31_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL5T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider32') {
	$Dslider32_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL5B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider33') {
	$Dslider33_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL5L.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider34') {
	$Dslider34_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL5R.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider35') {
	$Dslider35_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL4T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider36') {
	$Dslider36_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL4B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider37') {
	$Dslider37_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL3T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider38') {
	$Dslider38_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL3B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:block"';
}
elseif ($DSlider_theme=='slider39') {
	$Dslider39_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL2T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider40') {
	$Dslider40_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL2B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider41') {
	$Dslider41_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL1T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider42') {
	$Dslider42_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL1B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider43') {
	$Dslider43_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL8T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider44') {
	$Dslider44_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL8B.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider45') {
	$Dslider45_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL8L.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider46') {
	$Dslider46_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL8R.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider47') {
	$Dslider47_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL6T.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider48') {
	$Dslider48_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL6B.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider49') {
	$Dslider49_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL7T.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
elseif ($DSlider_theme=='slider50') {
	$Dslider50_sel='selected'; $Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideL7B.gif">';
	$DSlider_show1 = 'style="display:none"';
	$DSlider_show2 = 'style="display:none"';
	$DSlider_show3 = 'style="display:block"';
	$DSlider_show4 = 'style="display:block"';
	$DSlider_show5 = 'style="display:none"';
	$DSlider_show6 = 'style="display:block"';
	$Slider_bg1_name = 'name=""';
	$Slider_bg2_name = 'name="Slider_bg"';
	$DSlider_selectBgs1 = 'style="display:none"';
	$DSlider_selectBgs2 = 'style="display:inline"';
	$DSlider_uploadimage = 'style="display:none"';
}
else {
	$Dslider_view='<img id="slider1img" src="'.GenerationPlugin_preview.'/slideD5T.gif">';
	$DSlider_show1 = 'style="display:block"';
	$DSlider_show2 = 'style="display:block"';
	$DSlider_show3 = 'style="display:none"';
	$DSlider_show4 = 'style="display:none"';
	$DSlider_show5 = 'style="display:block"';
	$DSlider_show6 = 'style="display:none"';
	$Slider_bg1_name = 'name="Slider_bg"';
	$Slider_bg2_name = 'name=""';
	$DSlider_selectBgs1 = 'style="display:inline"';
	$DSlider_selectBgs2 = 'style="display:none"';
	$DSlider_uploadimage = 'style="display:block"';
}

$DSlider_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_btncolor = preg_replace("/\\\/","",$DSlider_btncolor);
$DSlider_btncolor = explode("|", $DSlider_btncolor);
$DSlider_btncolor = $DSlider_btncolor[3];
if ($DSlider_btncolor=='stripe_darkred') {$DsliderB1_sel='selected';} //stripe design
elseif ($DSlider_btncolor=='stripe_red') {$DsliderB2_sel='selected';}
elseif ($DSlider_btncolor=='stripe_magenta') {$DsliderB3_sel='selected';}
elseif ($DSlider_btncolor=='stripe_violetmagenta') {$DsliderB4_sel='selected';}
elseif ($DSlider_btncolor=='stripe_violet') {$DsliderB5_sel='selected';}
elseif ($DSlider_btncolor=='stripe_blueviolet') {$DsliderB6_sel='selected';}
elseif ($DSlider_btncolor=='stripe_navyblue') {$DsliderB7_sel='selected';}
elseif ($DSlider_btncolor=='stripe_darkblue') {$DsliderB8_sel='selected';}
elseif ($DSlider_btncolor=='stripe_blue') {$DsliderB9_sel='selected';}
elseif ($DSlider_btncolor=='stripe_turquoise') {$DsliderB10_sel='selected';}
elseif ($DSlider_btncolor=='stripe_greenturquoise') {$DsliderB11_sel='selected';}
elseif ($DSlider_btncolor=='stripe_darkgreen') {$DsliderB12_sel='selected';}
elseif ($DSlider_btncolor=='stripe_green') {$DsliderB13_sel='selected';}
elseif ($DSlider_btncolor=='stripe_lemon') {$DsliderB14_sel='selected';}
elseif ($DSlider_btncolor=='stripe_yellow') {$DsliderB15_sel='selected';}
elseif ($DSlider_btncolor=='stripe_orange') {$DsliderB16_sel='selected';}
elseif ($DSlider_btncolor=='simple_darkred') {$DsliderB21_sel='selected';} //simple design
elseif ($DSlider_btncolor=='simple_red') {$DsliderB22_sel='selected';}
elseif ($DSlider_btncolor=='simple_magenta') {$DsliderB23_sel='selected';}
elseif ($DSlider_btncolor=='simple_violetmagenta') {$DsliderB24_sel='selected';}
elseif ($DSlider_btncolor=='simple_violet') {$DsliderB25_sel='selected';}
elseif ($DSlider_btncolor=='simple_blueviolet') {$DsliderB26_sel='selected';}
elseif ($DSlider_btncolor=='simple_navyblue') {$DsliderB27_sel='selected';}
elseif ($DSlider_btncolor=='simple_darkblue') {$DsliderB28_sel='selected';}
elseif ($DSlider_btncolor=='simple_blue') {$DsliderB29_sel='selected';}
elseif ($DSlider_btncolor=='simple_turquoise') {$DsliderB30_sel='selected';}
elseif ($DSlider_btncolor=='simple_greenturquoise') {$DsliderB31_sel='selected';}
elseif ($DSlider_btncolor=='simple_darkgreen') {$DsliderB32_sel='selected';}
elseif ($DSlider_btncolor=='simple_green') {$DsliderB33_sel='selected';}
elseif ($DSlider_btncolor=='simple_lemon') {$DsliderB34_sel='selected';}
elseif ($DSlider_btncolor=='simple_yellow') {$DsliderB35_sel='selected';}
elseif ($DSlider_btncolor=='simple_orange') {$DsliderB36_sel='selected';}

$DSlider_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_background = preg_replace("/\\\/","",$DSlider_background);
if ($DSlider_background=='bg2') {$DsliderBackground2_sel='selected';}
elseif ($DSlider_background=='bg3') {$DsliderBackground3_sel='selected';}
elseif ($DSlider_background=='bg4') {$DsliderBackground4_sel='selected';}
elseif ($DSlider_background=='bg12') {$DsliderBackground12_sel='selected';}
elseif ($DSlider_background=='bg13') {$DsliderBackground13_sel='selected';}
elseif ($DSlider_background=='bg14') {$DsliderBackground14_sel='selected';}

$DSlider_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_title_tmp = preg_replace("/\\\/","",$DSlider_title_tmp);
    $DSlider_title = explode("|", $DSlider_title_tmp);
	$DSlider_headclr = $DSlider_title[0];
	$DSlider_headtxt = $DSlider_title[1];
	$DSlider_headclr_c = $DSlider_title[2];
$DSlider_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_text = preg_replace("/\\\/","",$DSlider_text);
$DSlider_formtitle = stripslashes($wpdb->get_var('SELECT Formtitle FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_formtitle = preg_replace("/\\\/","",$DSlider_formtitle);
$DSlider_formtext = stripslashes($wpdb->get_var('SELECT Formtext FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_formtext = preg_replace("/\\\/","",$DSlider_formtext);
$DSlider_listpoint_tmp = stripslashes($wpdb->get_var('SELECT Listpoint FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_listpoint_tmp = preg_replace("/\\\/","",$DSlider_listpoint_tmp);
    $DSlider_listpoint = explode("|", $DSlider_listpoint_tmp);
	$DSlider_point1 = $DSlider_listpoint[0];
	$DSlider_point2 = $DSlider_listpoint[1];
	$DSlider_point3 = $DSlider_listpoint[2];
	$DSlider_point4 = $DSlider_listpoint[3];
	$DSlider_point5 = $DSlider_listpoint[4];
	$DSlider_point6 = $DSlider_listpoint[5];
$DSlider_video = stripslashes($wpdb->get_var('SELECT Video FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_video = preg_replace("/\\\/","",$DSlider_video);
	
$DSlider_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_form_tmp = preg_replace("/\\\/","",$DSlider_form);
    $DSlider_formx = explode("|", $DSlider_form_tmp);
	$DSlider_form = $DSlider_formx[0];
	$DSlider_formtype = $DSlider_formx[1];
	$DSlider_clink = $DSlider_formx[2];
	$DSlider_cclick1 = $DSlider_formx[3];
	$DSlider_cblank = $DSlider_formx[4];
	if ($DSlider_cblank=="_blank") {$DSlider_cblank="checked";}
	$DSlider_cbgimage = $DSlider_formx[5];
	if ($DSlider_cbgimage!="") {$DSlider_cbgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
	$DSlider_cclick2 = $DSlider_formx[6];
	$DSlider_cwidth = $DSlider_formx[7];
	$DSlider_cheight = $DSlider_formx[8];
	$DSlider_cscroll = $DSlider_formx[9];
	if ($DSlider_cscroll=="scroll") {$DSlider_cscroll="checked";}
	$DSlider_orientation = $DSlider_formx[10];
	if ($DSlider_orientation=="top") {
		$Dsliderf1a_sel="selected"; $Dslider_view2='<img id="slider2img" src="'.GenerationPlugin_preview.'/slideCT.gif">';
		$Dsliderf8_view='style="display:block"'; $Dsliderf9_view='style="display:block"';
	} elseif ($DSlider_orientation=="bottom") {
		$Dsliderf2a_sel="selected"; $Dslider_view2='<img id="slider2img" src="'.GenerationPlugin_preview.'/slideCB.gif">';
		$Dsliderf8_view='style="display:block"'; $Dsliderf9_view='style="display:block"';
	} elseif ($DSlider_orientation=="left") {
		$Dsliderf3a_sel="selected"; $Dslider_view2='<img id="slider2img" src="'.GenerationPlugin_preview.'/slideCL.gif">';
		$Dsliderf8_view='style="display:none"'; $Dsliderf9_view='style="display:none"';
	} elseif ($DSlider_orientation=="right") {
		$Dsliderf4a_sel="selected"; $Dslider_view2='<img id="slider2img" src="'.GenerationPlugin_preview.'/slideCR.gif">';
		$Dsliderf8_view='style="display:none"'; $Dsliderf9_view='style="display:none"';
	} else {
		$Dsliderf1a_sel="selected"; $Dslider_view2='<img id="slider2img" src="'.GenerationPlugin_preview.'/slideCT.gif">';
	}
	$DSlider_cfullw = $DSlider_formx[11];
	if ($DSlider_cfullw=="fullw") {$DSlider_cfullw="checked";}
	$DSlider_bookmarkclr = $DSlider_formx[12];
	if ($DSlider_bookmarkclr=="dark") {$Dsliderf1b_sel="selected";}
	elseif ($DSlider_bookmarkclr=="light") {$Dsliderf2b_sel="selected";}

if ($DSlider_form=='regular' || $DSlider_form=='') {
	$Dsliderf1_sel='selected';
	$Dsliderf1_view='style="display:block"'; $Dsliderf2_view='style="display:block"'; $Dsliderf3_view='style="display:none"';
	$Dsliderf4_view='style="display:none"'; $Dsliderf5_view='style="display:none"'; 
	$Dslider_buttonss='style="display:block"'; $Dslider_adsection='style="display:block"'; $Dslider_adsection2='style="display:block"';
	$Dsliderf1_view_right='style="display:block"'; 
	$DSlider_stheme = 'style="display:inline"'; $DSlider_stheme_label = 'style="display:inline"';
	$Dslider_preview1 = 'style="display:block"'; $Dslider_preview2 = 'style="display:none"';
}
elseif ($DSlider_form=='social') {
	$Dsliderf2_sel='selected';
	$Dsliderf1_view='style="display:none"'; $Dsliderf2_view='style="display:none"'; $Dsliderf3_view='style="display:none"';
	$Dsliderf4_view='style="display:none"'; $Dsliderf5_view='style="display:none"';
	$Dslider_buttonss='style="display:block"'; $Dslider_adsection='style="display:block"'; $Dslider_adsection2='style="display:block"';
	$Dsliderf1_view_right='style="display:none"';
	$DSlider_stheme = 'style="display:inline"'; $DSlider_stheme_label = 'style="display:inline"';
	$Dslider_preview1 = 'style="display:block"'; $Dslider_preview2 = 'style="display:none"';
}
elseif ($DSlider_form=='both') {
	$Dsliderf12_sel='selected';
	$Dsliderf1_view='style="display:block"'; $Dsliderf2_view='style="display:block"'; $Dsliderf3_view='style="display:none"';
	$Dsliderf4_view='style="display:none"'; $Dsliderf5_view='style="display:none"'; 
	$Dslider_buttonss='style="display:block"'; $Dslider_adsection='style="display:block"'; $Dslider_adsection2='style="display:block"';
	$Dsliderf1_view_right='style="display:block"'; 
	$DSlider_stheme = 'style="display:inline"'; $DSlider_stheme_label = 'style="display:inline"';
	$Dslider_preview1 = 'style="display:block"'; $Dslider_preview2 = 'style="display:none"';
}
elseif ($DSlider_form=='link') {
	$Dsliderf3_sel='selected';
	$Dsliderf1_view='style="display:block"'; $Dsliderf2_view='style="display:none"'; $Dsliderf3_view='style="display:block"';
	$Dsliderf4_view='style="display:none"'; $Dsliderf5_view='style="display:none"';
	$Dslider_buttonss='style="display:block"'; $Dslider_adsection='style="display:block"'; $Dslider_adsection2='style="display:block"';
	$Dsliderf1_view_right='style="display:none"';
	$DSlider_stheme = 'style="display:inline"'; $DSlider_stheme_label = 'style="display:inline"';
	$Dslider_preview1 = 'style="display:block"'; $Dslider_preview2 = 'style="display:none"';
}
elseif ($DSlider_form=='custom') {
	$Dsliderf4_sel='selected';
	$Dsliderf1_view='style="display:none"'; $Dsliderf2_view='style="display:none"'; $Dsliderf3_view='style="display:block"';
	$Dsliderf4_view='style="display:block"'; $Dsliderf5_view='style="display:block"';
	$Dslider_buttonss='style="display:none"'; $Dslider_adsection='style="display:none"'; $Dslider_adsection2='style="display:none"';
	$Dsliderf1_view_right='style="display:none"';
	$DSlider_stheme = 'style="display:none"'; $DSlider_stheme_label = 'style="display:none"';
	$Dslider_preview1 = 'style="display:none"'; $Dslider_preview2 = 'style="display:block"';
}

if ($DSlider_formtype=='link' || $DSlider_formtype=='') {
	$Dsliderf10_sel='selected';
	$Dsliderf6_view='style="display:block"'; $Dsliderf7_view='style="display:none"'; $Dsliderf10_view='style="display:block"';
}
elseif ($DSlider_formtype=='image') {
	$Dsliderf20_sel='selected';
	$Dsliderf6_view='style="display:none"'; $Dsliderf7_view='style="display:block"'; $Dsliderf10_view='style="display:none"';
}
else {
	$Dsliderf10_sel='selected';
	$Dsliderf6_view='style="display:block"'; $Dsliderf7_view='style="display:none"'; $Dsliderf10_view='style="display:block"';
}

$DSlider_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_regular_tmp = preg_replace("/\\\/","",$DSlider_regular_tmp);
    $DSlider_regular = explode("|", $DSlider_regular_tmp);
	$Slider_fname = $DSlider_regular[0];
	$Slider_femail = $DSlider_regular[1];
	$Slider_fbtntxt = $DSlider_regular[2];
	$Slider_fbtnclr = $DSlider_regular[3];
	if ($DSlider_regular[4]=="1") {$DSlider_name_disabled="checked";}
	
$DSlider_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_spam = preg_replace("/\\\/","",$DSlider_spam);
$DSlider_bookmark = stripslashes($wpdb->get_var('SELECT Slidelink FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_bookmark = preg_replace("/\\\/","",$DSlider_bookmark);
$DSlider_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_optin = preg_replace("/<br>/","\n",$DSlider_optin);
	$DSlider_optin = preg_replace("/\\\/","",$DSlider_optin);
	$DSlider_optin = explode("|",$DSlider_optin);
	if ($DSlider_optin[4]=="on") {$DSlider_optinch="checked";}
$DSlider_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_slider.' WHERE id='.$Duniqueid);
	if ($DSlider_active_tmp=="on") {$DSlider_active="checked";} else {$DSlider_activated='style="background-color:#FCC"';}

	//replace html br with \n before display in text field
	$DSlider_headtxt = preg_replace("/<br>/","\n",$DSlider_headtxt);
	$DSlider_text = preg_replace("/<br>/","\n",$DSlider_text);
	$DSlider_formtitle = preg_replace("/<br>/","\n",$DSlider_formtitle);
	$DSlider_formtext = preg_replace("/<br>/","\n",$DSlider_formtext);
	$DSlider_spam = preg_replace("/<br>/","\n",$DSlider_spam);

$DSlider_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
    $DSlider_display = explode("|", $DSlider_displays);
	$DSlider_dpages = $DSlider_display[0];
	$DSlider_dcats = $DSlider_display[1];
	$DSlider_dposts = $DSlider_display[2];
	if (strpos($DSlider_dpages,'allpages')!==false) {$DSlider_dpagesall="checked";}
	if (strpos($DSlider_dcats,'allcats')!==false) {$DSlider_dcatsall="checked";}
	if (strpos($DSlider_dposts,'allposts')!==false) {$DSlider_dpostsall="checked";}
	//if ($DSlider_dpagesall=="" && $DSlider_dcatsall=="" && $DSlider_dpostsall=="") {$DSlider_dcheckall="";}
	$DSlider_showsub = $DSlider_display[3];
	if ($DSlider_showsub=="on") {$DSlider_showsub="checked";}
	$DSlider_ddelay = $DSlider_display[4];
	$DSlider_ddays = $DSlider_display[5];
	$DSlider_dstart = $DSlider_display[6];
	$DSlider_dstop = $DSlider_display[7];
?>

<script type="text/javascript">
function sh2_theme(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='1' || sel.selectedIndex=='2' || sel.selectedIndex=='3' || sel.selectedIndex=='4') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="block";
		document.getElementById("Slider_show3").style.display="none";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="block";
		if(sel.selectedIndex=='0' || sel.selectedIndex=='1') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD5T.gif'; ?>">');
		} else if(sel.selectedIndex=='2') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD5B.gif'; ?>">');
		} else if(sel.selectedIndex=='3') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD5L.gif'; ?>">');
		} else if(sel.selectedIndex=='4') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD5R.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='5' || sel.selectedIndex=='6') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="block";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="block";
		if(sel.selectedIndex=='5') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD4T.gif'; ?>">');
		} else if(sel.selectedIndex=='6') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD4B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='7' || sel.selectedIndex=='8') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="block";
		if(sel.selectedIndex=='7') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD3T.gif'; ?>">');
		} else if(sel.selectedIndex=='8') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD3B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='9' || sel.selectedIndex=='10') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="block";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='9') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD2T.gif'; ?>">');
		} else if(sel.selectedIndex=='10') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD2B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='11' || sel.selectedIndex=='12') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='11') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD1T.gif'; ?>">');
		} else if(sel.selectedIndex=='12') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD1B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='13' || sel.selectedIndex=='14' || sel.selectedIndex=='15' || sel.selectedIndex=='16') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="none";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="none";
		document.getElementById("Slider_show6").style.display="block";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='13') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD8T.gif'; ?>">');
		} else if(sel.selectedIndex=='14') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD8B.gif'; ?>">');
		} else if(sel.selectedIndex=='15') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD8L.gif'; ?>">');
		} else if(sel.selectedIndex=='16') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD8R.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='17' || sel.selectedIndex=='18') {
		document.getElementById("Slider_show1").style.display="none";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="none";
		document.getElementById("Slider_show6").style.display="block";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='17') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD6T.gif'; ?>">');
		} else if(sel.selectedIndex=='18') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD6B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='19' || sel.selectedIndex=='20' || sel.selectedIndex=='21') {
		document.getElementById("Slider_show1").style.display="none";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="none";
		document.getElementById("Slider_show6").style.display="block";
        document.getElementById("Slider_selectBgs1").name="Slider_bg";
        document.getElementById("Slider_selectBgs2").name="";
        document.getElementById("Slider_selectBgs1").style.display="inline";
        document.getElementById("Slider_selectBgs2").style.display="none";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='19') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD7T.gif'; ?>">');
		} else if(sel.selectedIndex=='20' || sel.selectedIndex=='21') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideD7B.gif'; ?>">');
		}
	}else if(sel.selectedIndex=='22' || sel.selectedIndex=='23' || sel.selectedIndex=='24' || sel.selectedIndex=='25' || sel.selectedIndex=='26') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="block";
		document.getElementById("Slider_show3").style.display="none";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="block";
		if(sel.selectedIndex=='22' || sel.selectedIndex=='23') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL5T.gif'; ?>">');
		} else if(sel.selectedIndex=='24') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL5B.gif'; ?>">');
		} else if(sel.selectedIndex=='25') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL5L.gif'; ?>">');
		} else if(sel.selectedIndex=='26') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL5R.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='27' || sel.selectedIndex=='28') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="block";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="block";
		if(sel.selectedIndex=='27') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL4T.gif'; ?>">');
		} else if(sel.selectedIndex=='28') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL4B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='29' || sel.selectedIndex=='30') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="block";
		if(sel.selectedIndex=='29') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL3T.gif'; ?>">');
		} else if(sel.selectedIndex=='30') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL3B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='31' || sel.selectedIndex=='32') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="block";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='31') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL2T.gif'; ?>">');
		} else if(sel.selectedIndex=='32') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL2B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='33' || sel.selectedIndex=='34') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="block";
		document.getElementById("Slider_show6").style.display="none";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='33') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL1T.gif'; ?>">');
		} else if(sel.selectedIndex=='34') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL1B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='35' || sel.selectedIndex=='36' || sel.selectedIndex=='37' || sel.selectedIndex=='38') {
		document.getElementById("Slider_show1").style.display="block";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="none";
		document.getElementById("Slider_show4").style.display="none";
		document.getElementById("Slider_show5").style.display="none";
		document.getElementById("Slider_show6").style.display="block";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='35') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL8T.gif'; ?>">');
		} else if(sel.selectedIndex=='36') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL8B.gif'; ?>">');
		} else if(sel.selectedIndex=='37') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL8L.gif'; ?>">');
		} else if(sel.selectedIndex=='38') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL8R.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='39' || sel.selectedIndex=='40') {
		document.getElementById("Slider_show1").style.display="none";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="none";
		document.getElementById("Slider_show6").style.display="block";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='39') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL6T.gif'; ?>">');
		} else if(sel.selectedIndex=='40') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL6B.gif'; ?>">');
		}
	} else if(sel.selectedIndex=='41' || sel.selectedIndex=='42') {
		document.getElementById("Slider_show1").style.display="none";
		document.getElementById("Slider_show2").style.display="none";
		document.getElementById("Slider_show3").style.display="block";
		document.getElementById("Slider_show4").style.display="block";
		document.getElementById("Slider_show5").style.display="none";
		document.getElementById("Slider_show6").style.display="block";
        document.getElementById("Slider_selectBgs1").name="";
        document.getElementById("Slider_selectBgs2").name="Slider_bg";
        document.getElementById("Slider_selectBgs1").style.display="none";
        document.getElementById("Slider_selectBgs2").style.display="inline";
        document.getElementById("Slider_uploadimage").style.display="none";
		if(sel.selectedIndex=='41') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL7T.gif'; ?>">');
		} else if(sel.selectedIndex=='42') {
			$jj('#slider1').html('<img id="slider1img" src="<?php echo GenerationPlugin_preview.'/slideL7B.gif'; ?>">');
		}
	}
}
function sh2_orientation(sel) {
		if(sel.selectedIndex=='0') {
			$jj('#slider2').html('<img id="slider2img" src="<?php echo GenerationPlugin_preview.'/slideCT.gif'; ?>">');
			document.getElementById("ichoice25").style.display="block";
			document.getElementById("ichoice26").style.display="block";
		} else if(sel.selectedIndex=='1') {
			$jj('#slider2').html('<img id="slider2img" src="<?php echo GenerationPlugin_preview.'/slideCB.gif'; ?>">');
			document.getElementById("ichoice25").style.display="block";
			document.getElementById("ichoice26").style.display="block";
		} else if(sel.selectedIndex=='2') {
			$jj('#slider2').html('<img id="slider2img" src="<?php echo GenerationPlugin_preview.'/slideCL.gif'; ?>">');
			document.getElementById("ichoice25").style.display="none";
			document.getElementById("ichoice26").style.display="none";
		} else if(sel.selectedIndex=='3') {
			$jj('#slider2').html('<img id="slider2img" src="<?php echo GenerationPlugin_preview.'/slideCR.gif'; ?>">');
			document.getElementById("ichoice25").style.display="none";
			document.getElementById("ichoice26").style.display="none";
		}
}
$jj(document).ready(function(){
	$jj("#Slider_name").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_email").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_btntxt").charCount({allowed:18, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_bookmark").charCount({allowed:15, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_headtxt").charCount({allowed:42, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_headdes").charCount({allowed:170, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_formtxt").charCount({allowed:15, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_formdes").charCount({allowed:65, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_point1").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_point2").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_point3").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_point4").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_point5").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_point6").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Slider_spam").charCount({allowed:80, warning:0, /*counterText:'left: '*/});
});
</script>


        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DSlider_activated; ?>>
				<input name="Slider_active" type="checkbox" <?php echo $DSlider_active; ?>> Activate Slide Panel
			</div>
            <select name="Slider_theme" id="selectslider" onchange="sh2_theme(this)" <?php echo $DSlider_stheme; ?>>
				<option value="slider1" style="color:#069; font-weight:bold">Graphite themes</option>
                <option value="slider1" <?php echo $Dslider1_sel; ?>>vertical top</option>
                <option value="slider2" <?php echo $Dslider2_sel; ?>>vertical bottom</option>
                <option value="slider3" <?php echo $Dslider3_sel; ?>>vertical left</option>
                <option value="slider4" <?php echo $Dslider4_sel; ?>>vertical right</option>
                <option value="slider5" <?php echo $Dslider5_sel; ?>>product plus top</option>
                <option value="slider6" <?php echo $Dslider6_sel; ?>>product plus bottom</option>
                <option value="slider7" <?php echo $Dslider7_sel; ?>>product top</option>
                <option value="slider8" <?php echo $Dslider8_sel; ?>>product bottom</option>
                <option value="slider9" <?php echo $Dslider9_sel; ?>>standard top</option>
                <option value="slider10" <?php echo $Dslider10_sel; ?>>standard bottom</option>
                <option value="slider11" <?php echo $Dslider11_sel; ?>>mini top</option>
                <option value="slider12" <?php echo $Dslider12_sel; ?>>mini bottom</option>
                <option value="slider13" <?php echo $Dslider13_sel; ?>>video vertical top</option>
                <option value="slider14" <?php echo $Dslider14_sel; ?>>video vertical bottom</option>
                <option value="slider15" <?php echo $Dslider15_sel; ?>>video vertical left</option>
                <option value="slider16" <?php echo $Dslider16_sel; ?>>video vertical right</option>
                <option value="slider17" <?php echo $Dslider17_sel; ?>>video 640 x 320 top</option>
                <option value="slider18" <?php echo $Dslider18_sel; ?>>video 640 x 320 bottom</option>
                <option value="slider19" <?php echo $Dslider19_sel; ?>>video 480 x 320 top</option>
                <option value="slider20" <?php echo $Dslider20_sel; ?>>video 480 x 320 bottom</option>
				<option value="slider20">&nbsp;</option>
				<option value="slider31" style="color:#069; font-weight:bold">Silver themes</option>
                <option value="slider31" <?php echo $Dslider31_sel; ?>>vertical top</option>
                <option value="slider32" <?php echo $Dslider32_sel; ?>>vertical bottom</option>
                <option value="slider33" <?php echo $Dslider33_sel; ?>>vertical left</option>
                <option value="slider34" <?php echo $Dslider34_sel; ?>>vertical right</option>
                <option value="slider35" <?php echo $Dslider35_sel; ?>>product plus top</option>
                <option value="slider36" <?php echo $Dslider36_sel; ?>>product plus bottom</option>
                <option value="slider37" <?php echo $Dslider37_sel; ?>>product top</option>
                <option value="slider38" <?php echo $Dslider38_sel; ?>>product bottom</option>
                <option value="slider39" <?php echo $Dslider39_sel; ?>>standard top</option>
                <option value="slider40" <?php echo $Dslider40_sel; ?>>standard bottom</option>
                <option value="slider41" <?php echo $Dslider41_sel; ?>>mini top</option>
                <option value="slider42" <?php echo $Dslider42_sel; ?>>mini bottom</option>
                <option value="slider43" <?php echo $Dslider43_sel; ?>>video vertical top</option>
                <option value="slider44" <?php echo $Dslider44_sel; ?>>video vertical bottom</option>
                <option value="slider45" <?php echo $Dslider45_sel; ?>>video vertical left</option>
                <option value="slider46" <?php echo $Dslider46_sel; ?>>video vertical right</option>
                <option value="slider47" <?php echo $Dslider47_sel; ?>>video 640 x 320 top</option>
                <option value="slider48" <?php echo $Dslider48_sel; ?>>video 640 x 320 bottom</option>
                <option value="slider49" <?php echo $Dslider49_sel; ?>>video 480 x 320 top</option>
                <option value="slider50" <?php echo $Dslider50_sel; ?>>video 480 x 320 bottom</option>
            </select> <span id="selectslider_label" <?php echo $DSlider_stheme_label; ?>>Template</span>
			<select name="Slider_form" onchange="sh2(this)">
				<option value="regular" <?php echo $Dsliderf1_sel; ?>>regular</option>
				<option value="social" <?php echo $Dsliderf2_sel; ?>>facebook</option>
				<option value="both" <?php echo $Dsliderf12_sel; ?>>regular and facebook switch</option>
				<option value="link" <?php echo $Dsliderf3_sel; ?>>link</option>
				<option value="custom" <?php echo $Dsliderf4_sel; ?>>custom content</option>
			</select> Type of sign-up form
			<div id="xchoice21" <?php echo $Dsliderf5_view; ?>>
    			<select name="Slider_ccontent" onchange="sh20(this)">
    				<option value="link" <?php echo $Dsliderf10_sel; ?>>webpage</option>
    				<option value="image" <?php echo $Dsliderf20_sel; ?>>image</option>
    			</select> Type of custom content
			</div>
			
			<div id="ichoice22" <?php echo $Dsliderf4_view; ?>>
				<input name="Slider_cwidth" type="text" value="<?php echo $DSlider_cwidth; ?>"> Box width in pixels
        		<br/>
				<div id="ichoice26" <?php echo $Dsliderf9_view; ?>>
					<input name="Slider_cfullw" type="checkbox" value="fullw" <?php echo $DSlider_cfullw; ?>> ...or display in full width
        			<br/>
				</div>
				<div id="ichoice25" <?php echo $Dsliderf8_view; ?>>
					<input name="Slider_cheight" type="text" value="<?php echo $DSlider_cheight; ?>"> Box height in pixels
        			<br/>
				</div>
				<div id="ichoice27" <?php echo $Dsliderf10_view; ?>>
					<input name="Slider_cscroll" type="checkbox" value="scroll" <?php echo $DSlider_cscroll; ?>> Show vertical scrollbar
				</div>
				<div id="ichoice23" <?php echo $Dsliderf6_view; ?>>
					<input name="Slider_clink" type="text" value="<?php echo $DSlider_clink; ?>">
					<img id="helpbtn_slider8" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        			<span class="maxfile" id="helptip_slider8">URLs starting with 'https://' will not open in box due to security reasons.</span> Link to webpage
				</div>
				<div id="ichoice24" <?php echo $Dsliderf7_view; ?>>
					<input name="Slider_cbg" type="file" size="26">
        			<?php if (filesize($DSlider_cbgimage)>=1048576) { ?>
        				<img id="helpbtn_slider9" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
        				<span class="maxfilewarning" id="helptip_slider9">Max 1Mb!</span>
        			<?php } else { ?>
        				<img id="helpbtn_slider9" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        				<span class="maxfile" id="helptip_slider9">Max 1Mb</span>
        			<?php } ?>
        			<?php echo $DSlider_cbgimage_img; ?>
					<span style="display:inline; margin-bottom:100px">Upload an image...</span>
        			<br/>
        			<input name="Slider_cbgremove" type="checkbox"> Remove uploaded image
					<br/>
    				<input name="Slider_cclick1" type="text" value="<?php echo $DSlider_cclick1; ?>"> ...or use external image
					<br/>
    				<input name="Slider_cclick2" type="text" value="<?php echo $DSlider_cclick2; ?>"> Link for <i>click</i> action
					<br/>
					<input name="Slider_cblank" type="checkbox" value="_blank" <?php echo $DSlider_cblank; ?>> Open the link in new tab
				</div>
    			<select name="Slider_orientation" onchange="sh2_orientation(this)">
    				<option value="top" <?php echo $Dsliderf1a_sel; ?>>top</option>
    				<option value="bottom" <?php echo $Dsliderf2a_sel; ?>>bottom</option>
    				<option value="left" <?php echo $Dsliderf3a_sel; ?>>left</option>
    				<option value="right" <?php echo $Dsliderf4a_sel; ?>>right</option>
    			</select> Position
    			<select name="Slider_bookmarkclr">
    				<option value="dark" <?php echo $Dsliderf1b_sel; ?>>dark</option>
    				<option value="light" <?php echo $Dsliderf2b_sel; ?>>light</option>
    			</select> Bookmark color
			</div>
			
            <div id="choice20" name="choice21" <?php echo $Dsliderf1_view; ?>>
				<div id="ichoice20" <?php echo $Dsliderf2_view; ?>>
    				<input id="Slider_name" name="Slider_name" type="text" value="<?php echo $Slider_fname; ?>"> 'Name' default value
					<br/>
					<input name="Slider_name_disabled" type="checkbox" value="1" <?php echo $DSlider_name_disabled; ?>> Do not show 'Name' field in form
                    <br/>
                    <input id="Slider_email" name="Slider_email" type="text" value="<?php echo $Slider_femail; ?>"> 'Email' default value
                    <br/>
				</div>
				<div id="ichoice21" <?php echo $Dsliderf3_view; ?>>	
					<input name="Slider_link" type="text" value="<?php echo $DSlider_link; ?>"> Destin. page
					<br/>
					<input name="Slider_link_blank" type="checkbox" value="_blank" <?php echo $DSlider_link_blank; ?>> Open the page in new tab
					<br/>
				</div>
				
				<div id="Slider_buttonss" <?php echo $Dslider_buttonss; ?>>
                <input id="Slider_btntxt" name="Slider_btntxt" type="text" value="<?php echo $Slider_fbtntxt; ?>"> Button text
                <br/>
				<select name="Slider_btnclr" id="selectButtons">
					<option style="margin-left:-136px; color:#069; font-weight:bold">Stripe design</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark.gif'; ?>)" 
						value="stripe_darkred" <?php echo $DsliderB1_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red.gif'; ?>)" 
						value="stripe_red" <?php echo $DsliderB2_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta.gif'; ?>)" 
						value="stripe_magenta" <?php echo $DsliderB3_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta.gif'; ?>)" 
						value="stripe_violetmagenta" <?php echo $DsliderB4_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet.gif'; ?>)" 
						value="stripe_violet" <?php echo $DsliderB5_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet.gif'; ?>)" 
						value="stripe_blueviolet" <?php echo $DsliderB6_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy.gif'; ?>)" 
						value="stripe_navyblue" <?php echo $DsliderB7_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark.gif'; ?>)" 
						value="stripe_darkblue" <?php echo $DsliderB8_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue.gif'; ?>)" 
						value="stripe_blue" <?php echo $DsliderB9_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise.gif'; ?>)" 
						value="stripe_turquoise" <?php echo $DsliderB10_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise.gif'; ?>)" 
						value="stripe_greenturquoise" <?php echo $DsliderB11_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark.gif'; ?>)" 
						value="stripe_darkgreen" <?php echo $DsliderB12_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green.gif'; ?>)" 
						value="stripe_green" <?php echo $DsliderB13_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon.gif'; ?>)" 
						value="stripe_lemon" <?php echo $DsliderB14_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow.gif'; ?>)" 
						value="stripe_yellow" <?php echo $DsliderB15_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange.gif'; ?>)" 
						value="stripe_orange" <?php echo $DsliderB16_sel; ?>>orange</option>
					<option>&nbsp;</option>
					<option style="margin-left:-136px; color:#069; font-weight:bold">Simple design</option>
					<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark2.gif'; ?>)" 
						value="simple_darkred" <?php echo $DsliderB21_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red2.gif'; ?>)" 
						value="simple_red" <?php echo $DsliderB22_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta2.gif'; ?>)" 
						value="simple_magenta" <?php echo $DsliderB23_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta2.gif'; ?>)" 
						value="simple_violetmagenta" <?php echo $DsliderB24_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet2.gif'; ?>)" 
                        value="simple_violet" <?php echo $DsliderB25_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet2.gif'; ?>)" 
  						value="simple_blueviolet" <?php echo $DsliderB26_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy2.gif'; ?>)" 
						value="simple_navyblue" <?php echo $DsliderB27_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark2.gif'; ?>)" 
						value="simple_darkblue" <?php echo $DsliderB28_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue2.gif'; ?>)" 
						value="simple_blue" <?php echo $DsliderB29_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise2.gif'; ?>)" 
						value="simple_turquoise" <?php echo $DsliderB30_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise2.gif'; ?>)" 
						value="simple_greenturquoise" <?php echo $DsliderB31_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark2.gif'; ?>)" 
						value="simple_darkgreen" <?php echo $DsliderB32_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green2.gif'; ?>)" 
						value="simple_green" <?php echo $DsliderB33_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon2.gif'; ?>)" 
						value="simple_lemon" <?php echo $DsliderB34_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow2.gif'; ?>)" 
						value="simple_yellow" <?php echo $DsliderB35_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange2.gif'; ?>)" 
						value="simple_orange" <?php echo $DsliderB36_sel; ?>>orange</option>
				</select> Button color
				</div>
			</div>
			
			<div id="Slider_adsection" <?php echo $Dslider_adsection; ?>>
			
            <input name="Slider_headclr" type="text" id="colorslider" value="<?php echo $DSlider_headclr; ?>" />
			<div style="margin:0 0 -25px 235px">
				<input style="position:absolute; margin:5px 0 0 -21px" name="Slider_headclr_c" type="checkbox" value="on" <?php if ($DSlider_headclr_c=="on") {echo "checked";} ?> />
				<img id="helpbtn_slider5" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="headclrhelp" id="helptip_slider5">Pick your color and check the checkbox to setup headers color different than button color.</span>
				Custom headers color
			</div>
            <br/>
			<div id="Slider_show1" <?php echo $DSlider_show1; ?>>
				<textarea id="Slider_headtxt" name="Slider_headtxt"><?php echo $DSlider_headtxt; ?></textarea>
				<img id="helpbtn_slider6" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="countdownhelp" id="helptip_slider6">Use number in brackets (max '90') to add countdown timer. Number in brackets = minutes, e.g.(57).</span>
				Header text
            <br/>
			</div>
			<div id="Slider_show2" <?php echo $DSlider_show2; ?>>
            <textarea id="Slider_headdes" name="Slider_headdes"><?php echo $DSlider_text; ?></textarea> Header description
            <br/>
			</div>
			<div id="Slider_show3" <?php echo $DSlider_show3; ?>>
				<textarea id="Slider_formtxt" name="Slider_formtxt"><?php echo $DSlider_formtitle; ?></textarea> Form header text
            <br/>
			</div>
			<div id="Slider_show4" <?php echo $DSlider_show4; ?>>
            	<textarea id="Slider_formdes" name="Slider_formdes"><?php echo $DSlider_formtext; ?></textarea> Form header description
            <br/>
			</div>
			<div id="Slider_show5" class="m8px" <?php echo $DSlider_show5; ?>>
                <input id="Slider_point1" name="Slider_point1" type="text" value="<?php echo $DSlider_point1; ?>"> List point #1
                <br/>
                <input id="Slider_point2" name="Slider_point2" type="text" value="<?php echo $DSlider_point2; ?>"> List point #2
                <br/>
                <input id="Slider_point3" name="Slider_point3" type="text" value="<?php echo $DSlider_point3; ?>"> List point #3
                <br/>
                <input id="Slider_point4" name="Slider_point4" type="text" value="<?php echo $DSlider_point4; ?>"> List point #4
                <br/>
                <input id="Slider_point5" name="Slider_point5" type="text" value="<?php echo $DSlider_point5; ?>"> List point #5
                <br/>
                <input style="margin-bottom:-4px" id="Slider_point6" name="Slider_point6" type="text" value="<?php echo $DSlider_point6; ?>"> List point #6
			</div>
            <textarea id="Slider_spam" name="Slider_spam"><?php echo $DSlider_spam; ?></textarea> Anti-spam note
			<div id="Slider_show6" <?php echo $DSlider_show6; ?>>
            	<textarea name="Slider_video"><?php echo $DSlider_video; ?></textarea> Product video
			</div>
			
			</div>
			
            <input class="m8px" id="Slider_bookmark" name="Slider_bookmark" type="text" value="<?php echo $DSlider_bookmark; ?>"> Bookmark text
			
			<div id="Slider_adsection2" <?php echo $Dslider_adsection2; ?>>
			
			<select <?php echo $Slider_bg1_name; ?> id="Slider_selectBgs1" <?php echo $DSlider_selectBgs1; ?>>
					<option style="margin-left:-136px">Dark backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_noise.gif'; ?>)" 
						value="bg2" <?php echo $DsliderBackground2_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_carbonfiber.gif'; ?>)" 
						value="bg3" <?php echo $DsliderBackground3_sel; ?>>carbon fiber</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_wood.gif'; ?>)" 
						value="bg4" <?php echo $DsliderBackground4_sel; ?>>wood</option>
			</select>	
			<select <?php echo $Slider_bg2_name; ?> id="Slider_selectBgs2" <?php echo $DSlider_selectBgs2; ?>>
					<option style="margin-left:-136px">Light backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_noise.gif'; ?>)" 
						value="bg12" <?php echo $DsliderBackground12_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_sparkles.gif'; ?>)" 
						value="bg13" <?php echo $DsliderBackground13_sel; ?>>sparkles</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_blur.gif'; ?>)" 
						value="bg14" <?php echo $DsliderBackground14_sel; ?>>blur</option>
			</select> <span style="display:inline">Product background</span>
			<br/>
            <input name="Slider_bg" type="file" size="26">
			<?php if (filesize($DSlider_bgimage)>=307201) { ?>
				<img id="helpbtn_slider3" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_slider3">Max 300kb!</span>
			<?php } else { ?>
				<img id="helpbtn_slider3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_slider3">Max 300kb</span>
			<?php } ?>
			<?php echo $DSlider_bgimage_img; ?>
			<br/>
			<input name="Slider_bgremove" type="checkbox"> Remove uploaded background
			<br/>
			<div id="Slider_uploadimage" <?php echo $DSlider_uploadimage; ?>>
                <input class="m8px" name="Slider_file" type="file" size="26">
    			<?php if (filesize($DSlider_image)>=81921) { ?>
    				<img id="helpbtn_slider4" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
    				<span class="maxfilewarning" id="helptip_slider4">Max 70kb! (200x220px)</span>
    			<?php } else { ?>
    				<img id="helpbtn_slider4" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
    				<span class="maxfile" id="helptip_slider4">Max 70kb (200x220px)</span>
    			<?php } ?>
    			<?php echo $DSlider_image_img; ?> Product image
    			<br/>
    			<input name="Slider_fileremove" type="checkbox"> Remove uploaded image
			</div>
        </div>
		
        </div>
            
        <div class="right_section" id="slider_checkboxes">
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_slider1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_slider1">Click here to show options.</span>
			</h4>
            <div class="toggle">
				<input style="display:inline-block;" type="checkbox" name="Slider_pagelist[]" value="allpages" <?php echo $DSlider_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DSlider_dpages_front="front";
				if (strpos(','.$DSlider_dpages.',',',front,')!==false || $DSlider_displays=="") {$DSlider_dpagesch[$DSlider_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Slider_pagelist[]" value="front" '.$DSlider_dpagesch[$DSlider_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DSlider_dpages_search="search";
				if (strpos(','.$DSlider_dpages.',',',search,')!==false || $DSlider_displays=="") {$DSlider_dpagesch[$DSlider_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Slider_pagelist[]" value="search" '.$DSlider_dpagesch[$DSlider_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DSlider_dpages_author="author";
				if (strpos(','.$DSlider_dpages.',',',author,')!==false || $DSlider_displays=="") {$DSlider_dpagesch[$DSlider_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Slider_pagelist[]" value="author" '.$DSlider_dpagesch[$DSlider_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order'); 
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DSlider_dpages.',',','.trim($pageID).',')!==false || $DSlider_displays=="") {$DSlider_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Slider_pagelist[]" value="'.$pageID.'" '.$DSlider_dpagesch[$pageID].'>';
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
 							if (strpos(','.$DSlider_dpages.',',','.trim($childID).',')!==false || $DSlider_displays=="") {$DSlider_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Slider_pagelist[]" value="'.$childID.'" '.$DSlider_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Slider_catlist[]" value="allcats" <?php echo $DSlider_dcatsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DSlider_dcats.',',','.trim($cat_id).',')!==false || $DSlider_displays=="") {$DSlider_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Slider_catlist[]" value="'.$cat_id.'" '.$DSlider_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Slider_postlist[]" value="allposts" <?php echo $DSlider_dpostsall; ?>>
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
							if (strpos(','.$DSlider_dposts.',',','.trim($id).',')!==false || $DSlider_displays=="") {$DSlider_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Slider_postlist[]" value="'.$id.'" '.$DSlider_dpostsch[$id].'>';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="Slider_showsub" <?php echo $DSlider_showsub; ?>>
					&nbsp;<span style="color:#069">Do NOT show to subscribers</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="slider_checkboxes_switch" <?php echo $DSlider_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				Show after <input class="showdelay" name="Slider_ddelay" type="text" value="<?php echo $DSlider_ddelay; ?>"> seconds<br>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Slider_dstart" type="text" value="<?php echo $DSlider_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Slider_dstop" type="text" value="<?php echo $DSlider_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Slider_ddays" type="text" value="<?php echo $DSlider_ddays; ?>"> days<br>
				-->
				
            </div>
			
			<h4 id="right_choice20" class="hiddens" <?php echo $Dsliderf1_view_right; ?>>
				Opt-in settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_slider7" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_slider7">Click here to show options.</span>
			</h4>
            <div id="Slider_optin" class="toggle" <?php echo $Dsliderf1_view_right; ?>>
					<div class="gpadminoptional" style="margin-bottom:0; width:535px">
						Make sure there is data in 'form action' field. Otherwise change 'form' to 'formc' in your opt-in code.
					</div>
                    <textarea name="Slider_optin1" id="gpoptinform_slider"><?php echo str_replace(":::","|",$DSlider_optin[0]); ?></textarea> Opt-in code<br/>
                    <div id="gpformarea_slider" style="display:none"></div>
                    <input type="button" value="Process" id="gpproccessit_slider"><br/>
					<textarea style="margin:3px 0" name="Slider_optin5" id="gpformaction_slider"><?php echo $DSlider_optin[4]; ?></textarea> form action<br/>
                    <select name="Slider_optin2" id="gpnamefield_slider">
    					<option value="<?php echo $DSlider_optin[1]; ?>"><?php echo $DSlider_optin[1]; ?></option>
    				</select> 'NAME' field<br/>
                    <select name="Slider_optin3" id="gpemailfield_slider">
    					<option value="<?php echo $DSlider_optin[2]; ?>"><?php echo $DSlider_optin[2]; ?></option>
    				</select> 'EMAIL' field<br/>
                    <!-- <input name="Slider_optin4" value="on" type="checkbox" id="gpdisablename_slider" <?php echo $DSlider_optinch; ?>> disable NAME field<br/> -->
                    <input type="checkbox" id="gpshowalldata_slider"> show all processed data<br/>
                    <div id="gpalldata_slider" style="display:none">
                        <textarea name="Slider_optin6" id="gphiddenfields_slider"><?php echo $DSlider_optin[5]; ?></textarea> hidden fields<br/>
                        <textarea name="Slider_optin7" id="gpignoredfields_slider"><?php echo $DSlider_optin[6]; ?></textarea> ignored fields<br/>
                        <textarea name="Slider_optin8" id="gpotherfields_slider"><?php echo $DSlider_optin[7]; ?></textarea> other fields<br/>
                        <textarea name="Slider_optin9" id="gpsubmitbutton_slider"><?php echo $DSlider_optin[8]; ?></textarea> submit button<br/>
                    </div><br/>
			</div>
			
        	<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_slider2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_slider2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="slider1" class="preview2" <?php echo $Dslider_preview1; ?>><?php echo $Dslider_view; ?></div>
			<div id="slider2" class="preview2" <?php echo $Dslider_preview2; ?>><?php echo $Dslider_view2; ?></div>
        </div>
		
		
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_slider" type="hidden" value="Save Changes">
    		<input id="Savepreview_slider" name="Savepreview_slider" type="hidden" value="Savepreview_slider">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_slider').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div>  
