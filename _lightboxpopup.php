<div id="tab1" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_popup" enctype="multipart/form-data">


<?php
if (isset($_POST['displayingformsent_popup'])=='Save Changes') {

	//multiple values into one database cell
	if ($_POST['Popup_headclr_c']=="on") {$Popup_headclr=$_POST['Popup_headclr'];}
	elseif ($_POST['Popup_form']=="social") {$Popup_headclr="0d66ae";}
	elseif ($_POST['Popup_btnclr']=="stripe_darkred" || $_POST['Popup_btnclr']=="simple_darkred") {$Popup_headclr="a92e20";}
	elseif ($_POST['Popup_btnclr']=="stripe_red" || $_POST['Popup_btnclr']=="simple_red") {$Popup_headclr="d53929";}
	elseif ($_POST['Popup_btnclr']=="stripe_magenta" || $_POST['Popup_btnclr']=="simple_magenta") {$Popup_headclr="c73272";}
	elseif ($_POST['Popup_btnclr']=="stripe_violetmagenta" || $_POST['Popup_btnclr']=="simple_violetmagenta") {$Popup_headclr="b940b3";}
	elseif ($_POST['Popup_btnclr']=="stripe_violet" || $_POST['Popup_btnclr']=="simple_violet") {$Popup_headclr="6c4ab2";}
	elseif ($_POST['Popup_btnclr']=="stripe_blueviolet" || $_POST['Popup_btnclr']=="simple_blueviolet") {$Popup_headclr="4442ad";}
	elseif ($_POST['Popup_btnclr']=="stripe_navyblue" || $_POST['Popup_btnclr']=="simple_navyblue") {$Popup_headclr="286c9e";}
	elseif ($_POST['Popup_btnclr']=="stripe_darkblue" || $_POST['Popup_btnclr']=="simple_darkblue") {$Popup_headclr="387dab";}
	elseif ($_POST['Popup_btnclr']=="stripe_blue" || $_POST['Popup_btnclr']=="simple_blue") {$Popup_headclr="299eb9";}
	elseif ($_POST['Popup_btnclr']=="stripe_turquoise" || $_POST['Popup_btnclr']=="simple_turquoise") {$Popup_headclr="38b5af";}
	elseif ($_POST['Popup_btnclr']=="stripe_greenturquoise" || $_POST['Popup_btnclr']=="simple_greenturquoise") {$Popup_headclr="2cc183";}
	elseif ($_POST['Popup_btnclr']=="stripe_darkgreen" || $_POST['Popup_btnclr']=="simple_darkgreen") {$Popup_headclr="5ca138";}
	elseif ($_POST['Popup_btnclr']=="stripe_green" || $_POST['Popup_btnclr']=="simple_green") {$Popup_headclr="93b73f";}
	elseif ($_POST['Popup_btnclr']=="stripe_lemon" || $_POST['Popup_btnclr']=="simple_lemon") {$Popup_headclr="d6ce28";}
	elseif ($_POST['Popup_btnclr']=="stripe_yellow" || $_POST['Popup_btnclr']=="simple_yellow") {$Popup_headclr="d1bd26";}
	elseif ($_POST['Popup_btnclr']=="stripe_orange" || $_POST['Popup_btnclr']=="simple_orange") {$Popup_headclr="e68f1b";}
	else {$Popup_headclr="CC3300";}
	$Popup_head = "#".trim($Popup_headclr."|".$_POST['Popup_headtxt']."|".$_POST['Popup_headclr_c'], "#");
	$Popup_list = $_POST['Popup_point1']."|".$_POST['Popup_point2']."|".$_POST['Popup_point3']."|".$_POST['Popup_point4']."|".$_POST['Popup_point5']."|".$_POST['Popup_point6'];
	$Popup_regular = $_POST['Popup_name']."|".$_POST['Popup_email']."|".$_POST['Popup_btntxt']."|".$_POST['Popup_btnclr']."|".$_POST['Popup_name_disabled'];
	$Popup_social = "facebook";
	$Popup_background = $_POST['Popup_bg']."|".$_POST['Popup_screencolor']."|".$_POST['Popup_screenopacity'];
	$Popup_optin = trim(str_replace("|",":::",$_POST['Popup_optin1']))."|".trim($_POST['Popup_optin2'])."|".trim($_POST['Popup_optin3'])."|".trim($_POST['Popup_optin4'])."|".trim($_POST['Popup_optin5'])."|".trim($_POST['Popup_optin6'])."|".trim($_POST['Popup_optin7'])."|".trim($_POST['Popup_optin8'])."|".trim($_POST['Popup_optin9']);
    $Popup_optin = str_replace(array("\r\n", "\r", "\n"), '<br>', $Popup_optin);

	//image upload
	$Popup_file = $_FILES['Popup_file']['name'];
    $Popup_fileremove = $_POST['Popup_fileremove'];
    if ($Popup_fileremove=='on') {$Popup_file='';}
    $Popup_path = GenerationPlugin_uploads.basename($Popup_file);
    if (move_uploaded_file($_FILES['Popup_file']['tmp_name'], $Popup_path)) {
        $Popup_array = explode('.',$Popup_file);
    	$Popup_exten = $Popup_array[count($Popup_array)-1];
		if (isset($_POST['Savepreview_popup'])) {
			$Popup_image = GenerationPlugin_uploads.'Popup_image.'.$Popup_exten;
			$Popup_image_db = GenerationPlugin_uploads_db.'Popup_image.'.$Popup_exten;
        	rename($Popup_path, $Popup_image);
		}
        $Popup_image_preview = GenerationPlugin_uploads.'Popup_image_preview.'.$Popup_exten;
        $Popup_image_preview_db = GenerationPlugin_uploads_db.'Popup_image_preview.'.$Popup_exten;
		if ($Popup_image!='') { copy($Popup_image, $Popup_image_preview); }
        rename($Popup_path, $Popup_image_preview);
    } else {
        $Popup_image = $wpdb->get_var('SELECT Image FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid);
        $Popup_image_preview = $Popup_image_preview_db = $Popup_image_db = $Popup_image;
    }
	if (isset($_POST['Savepreview_popup'])) {
   		if ($Popup_fileremove=='on') {$Popup_image=''; $Popup_image_db='';}
	}
	if ($Popup_fileremove=='on') {$Popup_image_preview=''; $Popup_image_preview_db='';}

	//background upload
	$Popup_bgfile = $_FILES['Popup_bg']['name'];
	$Popup_bgfileremove = $_POST['Popup_bgremove'];
	if ($Popup_bgfileremove=='on') {$Popup_bgfile='';}
    $Popup_bgpath = GenerationPlugin_uploads.basename($Popup_bgfile);
    if (move_uploaded_file($_FILES['Popup_bg']['tmp_name'], $Popup_bgpath)) {
        $Popup_bgarray = explode('.',$Popup_bgfile);
        $Popup_bgexten = $Popup_bgarray[count($Popup_bgarray)-1];
		if (isset($_POST['Savepreview_popup'])) {
			$Popup_bgimage = GenerationPlugin_uploads.'Popup_bgimage.'.$Popup_bgexten;
			$Popup_bgimage_db = GenerationPlugin_uploads_db.'Popup_bgimage.'.$Popup_bgexten;
        	rename($Popup_bgpath, $Popup_bgimage);
		}
        $Popup_bgimage_preview = GenerationPlugin_uploads.'Popup_bgimage_preview.'.$Popup_bgexten;
        $Popup_bgimage_preview_db = GenerationPlugin_uploads_db.'Popup_bgimage_preview.'.$Popup_bgexten;
		if ($Popup_bgimage!='') { copy($Popup_bgimage, $Popup_bgimage_preview); }
        rename($Popup_bgpath, $Popup_bgimage_preview);
    } else {
        $Popup_bgimage = $wpdb->get_var('SELECT Bgimage FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid);
        $Popup_bgimage_preview = $Popup_bgimage_preview_db = $Popup_bgimage_db = $Popup_bgimage;
    }
	if (isset($_POST['Savepreview_popup'])) {
   		if ($Popup_bgfileremove=='on') {$Popup_bgimage=''; $Popup_bgimage_db='';}
	}
	if ($Popup_bgfileremove=='on') {$Popup_bgimage_preview=''; $Popup_bgimage_preview_db='';}

	//custom content image upload
	$Popup_cbgfile = $_FILES['Popup_cbg']['name'];
	$Popup_cbgfileremove = $_POST['Popup_cbgremove'];
	if ($Popup_cbgfileremove=='on') {$Popup_cbgfile='';}
    $Popup_cbgpath = GenerationPlugin_uploads.basename($Popup_cbgfile);
    if (move_uploaded_file($_FILES['Popup_cbg']['tmp_name'], $Popup_cbgpath)) {
        $Popup_cbgarray = explode('.',$Popup_cbgfile);
        $Popup_cbgexten = $Popup_cbgarray[count($Popup_cbgarray)-1];
		if (isset($_POST['Savepreview_popup'])) {
			$Popup_cbgimage = GenerationPlugin_uploads.'Popup_cbgimage.'.$Popup_cbgexten;
			$Popup_cbgimage_db = GenerationPlugin_uploads_db.'Popup_cbgimage.'.$Popup_cbgexten;
        	rename($Popup_cbgpath, $Popup_cbgimage);
		}
        $Popup_cbgimage_preview = GenerationPlugin_uploads.'Popup_cbgimage_preview.'.$Popup_cbgexten;
        $Popup_cbgimage_preview_db = GenerationPlugin_uploads_db.'Popup_cbgimage_preview.'.$Popup_cbgexten;
		if ($Popup_cbgimage!='') { copy($Popup_cbgimage, $Popup_cbgimage_preview); }
        rename($Popup_cbgpath, $Popup_cbgimage_preview);
    } else {
        $Popup_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
    	$Popup_form_tmp = preg_replace("/\\\/","",$Popup_form);
        $Popup_formx = explode("|", $Popup_form_tmp);
    	$Popup_cbgimage = $Popup_formx[5];
        $Popup_cbgimage_preview = $Popup_cbgimage_preview_db = $Popup_cbgimage_db = $Popup_cbgimage;
    }
	if (isset($_POST['Savepreview_popup'])) {
   		if ($Popup_cbgfileremove=='on') {$Popup_cbgimage=''; $Popup_cbgimage_db='';}
	}
	if ($Popup_cbgfileremove=='on') {$Popup_cbgimage_preview=''; $Popup_cbgimage_preview_db='';}
	
	$Popup_form = $_POST['Popup_form']."|".$_POST['Popup_ccontent']."|".$_POST['Popup_clink']."|".$_POST['Popup_cclick1']."|".$_POST['Popup_cblank']."|".$Popup_cbgimage_db."|".$_POST['Popup_cclick2']."|".$_POST['Popup_cwidth']."|".$_POST['Popup_cheight']."|".$_POST['Popup_cscroll'];
	$Popup_form_preview = $_POST['Popup_form']."|".$_POST['Popup_ccontent']."|".$_POST['Popup_clink']."|".$_POST['Popup_cclick1']."|".$_POST['Popup_cblank']."|".$Popup_cbgimage_preview_db."|".$_POST['Popup_cclick2']."|".$_POST['Popup_cwidth']."|".$_POST['Popup_cheight']."|".$_POST['Popup_cscroll'];
	$Popup_startdate = $_POST['Popup_dstart'];
	if ($_POST['Popup_ddays']=="") { $Popup_days = ""; }
	elseif ($Popup_startdate!="") { $Popup_days = date("Y-m-d", strtotime($Popup_startdate." + ".$_POST['Popup_ddays']." days")); }
	else { $Popup_days = date("Y-m-d", strtotime(" + ".$_POST['Popup_ddays']." days")); }
	$Popup_display = implode(',',$_POST['Popup_pagelist']).'|'.implode(',',$_POST['Popup_catlist']).'|'.implode(',',$_POST['Popup_postlist']).'|'.$_POST['Popup_showsub'].'|'.$_POST['Popup_ddelay'].'|'.$Popup_days.'|'.$Popup_startdate.'|'.$_POST['Popup_dstop'];

	//replace \n with html br before save to database
	$Popup_head=str_replace(array("\r\n", "\r", "\n"), '<br>', $Popup_head);
	$Popup_headdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Popup_headdes']);
	$Popup_formtxt=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Popup_formtxt']);
	$Popup_formdes=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Popup_formdes']);
	$Popup_spam=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Popup_spam']);

	//save to database
	if (isset($_POST['Savepreview_popup'])) {
    $wpdb->update($table_name_lightbox,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Popup_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Popup_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Popup_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Popup_image_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Popup_bgimage_db)),
    		  'Background'=>mysql_real_escape_string(trim($Popup_background)),
    		  'Title'=>mysql_real_escape_string(trim($Popup_head)),
    		  'Text'=>mysql_real_escape_string(trim($Popup_headdes)),
    		  'Formtitle'=>mysql_real_escape_string(trim($Popup_formtxt)),
    		  'Formtext'=>mysql_real_escape_string(trim($Popup_formdes)),
    		  'Listpoint'=>mysql_real_escape_string(trim($Popup_list)),
    		  'Video'=>mysql_real_escape_string(trim($_POST['Popup_video'])),
    		  'Form'=>mysql_real_escape_string(trim($Popup_form)),
    		  'Regular'=>mysql_real_escape_string(trim($Popup_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Popup_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Popup_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Popup_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Popup_active'])),
			  'Display'=>mysql_real_escape_string(trim($Popup_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_lightbox,
    	array('Theme'=>mysql_real_escape_string(trim($_POST['Popup_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Popup_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Popup_link_blank'])),
    		  'Image'=>mysql_real_escape_string(trim($Popup_image_preview_db)),
    		  'Bgimage'=>mysql_real_escape_string(trim($Popup_bgimage_preview_db)),
    		  'Background'=>mysql_real_escape_string(trim($Popup_background)),
    		  'Title'=>mysql_real_escape_string(trim($Popup_head)),
    		  'Text'=>mysql_real_escape_string(trim($Popup_headdes)),
    		  'Formtitle'=>mysql_real_escape_string(trim($Popup_formtxt)),
    		  'Formtext'=>mysql_real_escape_string(trim($Popup_formdes)),
    		  'Listpoint'=>mysql_real_escape_string(trim($Popup_list)),
    		  'Video'=>mysql_real_escape_string(trim($_POST['Popup_video'])),
    		  'Form'=>mysql_real_escape_string(trim($Popup_form_preview)),
    		  'Regular'=>mysql_real_escape_string(trim($Popup_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Popup_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Popup_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Popup_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Popup_active'])),
			  'Display'=>mysql_real_escape_string(trim($Popup_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DPopup_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_theme = preg_replace("/\\\/","",$DPopup_theme);
$DPopup_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_link = preg_replace("/\\\/","",$DPopup_link);
$DPopup_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
if ($DPopup_link_blank=="_blank") {$DPopup_link_blank="checked";}
$DPopup_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_image = preg_replace("/\\\/","",$DPopup_image);
$DPopup_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_bgimage = preg_replace("/\\\/","",$DPopup_bgimage);
if ($DPopup_image!="") {$DPopup_image_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
if ($DPopup_bgimage!="") {$DPopup_bgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}

if ($DPopup_theme=='popup1') {
	$Dpopup1_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD1.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:block"';
	$DPopup_show3 = 'style="display:none"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:block"';
}
elseif ($DPopup_theme=='popup2') {
	$Dpopup2_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD2.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:block"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:block"';
}
elseif ($DPopup_theme=='popup3') {
	$Dpopup3_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD3.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:block"';
}
elseif ($DPopup_theme=='popup4') {
	$Dpopup4_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD4.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:block"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup5') {
	$Dpopup5_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD5.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup6') {
	$Dpopup6_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD8.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:none"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:none"';
	$DPopup_show6 = 'style="display:block"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup7') {
	$Dpopup7_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD6.gif">';
	$DPopup_show1 = 'style="display:none"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:none"';
	$DPopup_show6 = 'style="display:block"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup8') {
	$Dpopup8_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD7.gif">';
	$DPopup_show1 = 'style="display:none"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:none"';
	$DPopup_show6 = 'style="display:block"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup11') {
	$Dpopup11_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL1.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:block"';
	$DPopup_show3 = 'style="display:none"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:block"';
}
elseif ($DPopup_theme=='popup12') {
	$Dpopup12_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL2.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:block"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:block"';
}
elseif ($DPopup_theme=='popup13') {
	$Dpopup13_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL3.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:block"';
}
elseif ($DPopup_theme=='popup14') {
	$Dpopup14_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL4.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:block"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup15') {
	$Dpopup15_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL5.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup16') {
	$Dpopup16_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL8.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:none"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:none"';
	$DPopup_show6 = 'style="display:block"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup17') {
	$Dpopup17_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL6.gif">';
	$DPopup_show1 = 'style="display:none"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:none"';
	$DPopup_show6 = 'style="display:block"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:none"';
}
elseif ($DPopup_theme=='popup18') {
	$Dpopup18_sel='selected'; $Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupL7.gif">';
	$DPopup_show1 = 'style="display:none"';
	$DPopup_show2 = 'style="display:none"';
	$DPopup_show3 = 'style="display:block"';
	$DPopup_show4 = 'style="display:block"';
	$DPopup_show5 = 'style="display:none"';
	$DPopup_show6 = 'style="display:block"';
	$Popup_bg1_name = 'name=""';
	$Popup_bg2_name = 'name="Popup_bg"';
	$DPopup_selectBgs1 = 'style="display:none"';
	$DPopup_selectBgs2 = 'style="display:inline"';
	$DPopup_uploadimage = 'style="display:none"';
}
else {
	$Dpopup_view='<img id="popup1img" src="'.GenerationPlugin_preview.'/popupD1.gif">';
	$DPopup_show1 = 'style="display:block"';
	$DPopup_show2 = 'style="display:block"';
	$DPopup_show3 = 'style="display:none"';
	$DPopup_show4 = 'style="display:none"';
	$DPopup_show5 = 'style="display:block"';
	$DPopup_show6 = 'style="display:none"';
	$Popup_bg1_name = 'name="Popup_bg"';
	$Popup_bg2_name = 'name=""';
	$DPopup_selectBgs1 = 'style="display:inline"';
	$DPopup_selectBgs2 = 'style="display:none"';
	$DPopup_uploadimage = 'style="display:block"';
}

$DPopup_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_btncolor = preg_replace("/\\\/","",$DPopup_btncolor);
$DPopup_btncolor = explode("|", $DPopup_btncolor);
$DPopup_btncolor = $DPopup_btncolor[3];
if ($DPopup_btncolor=='stripe_darkred') {$DpopupB1_sel='selected';} //stripe design
elseif ($DPopup_btncolor=='stripe_red') {$DpopupB2_sel='selected';}
elseif ($DPopup_btncolor=='stripe_magenta') {$DpopupB3_sel='selected';}
elseif ($DPopup_btncolor=='stripe_violetmagenta') {$DpopupB4_sel='selected';}
elseif ($DPopup_btncolor=='stripe_violet') {$DpopupB5_sel='selected';}
elseif ($DPopup_btncolor=='stripe_blueviolet') {$DpopupB6_sel='selected';}
elseif ($DPopup_btncolor=='stripe_navyblue') {$DpopupB7_sel='selected';}
elseif ($DPopup_btncolor=='stripe_darkblue') {$DpopupB8_sel='selected';}
elseif ($DPopup_btncolor=='stripe_blue') {$DpopupB9_sel='selected';}
elseif ($DPopup_btncolor=='stripe_turquoise') {$DpopupB10_sel='selected';}
elseif ($DPopup_btncolor=='stripe_greenturquoise') {$DpopupB11_sel='selected';}
elseif ($DPopup_btncolor=='stripe_darkgreen') {$DpopupB12_sel='selected';}
elseif ($DPopup_btncolor=='stripe_green') {$DpopupB13_sel='selected';}
elseif ($DPopup_btncolor=='stripe_lemon') {$DpopupB14_sel='selected';}
elseif ($DPopup_btncolor=='stripe_yellow') {$DpopupB15_sel='selected';}
elseif ($DPopup_btncolor=='stripe_orange') {$DpopupB16_sel='selected';}
elseif ($DPopup_btncolor=='simple_darkred') {$DpopupB21_sel='selected';} //simple design
elseif ($DPopup_btncolor=='simple_red') {$DpopupB22_sel='selected';}
elseif ($DPopup_btncolor=='simple_magenta') {$DpopupB23_sel='selected';}
elseif ($DPopup_btncolor=='simple_violetmagenta') {$DpopupB24_sel='selected';}
elseif ($DPopup_btncolor=='simple_violet') {$DpopupB25_sel='selected';}
elseif ($DPopup_btncolor=='simple_blueviolet') {$DpopupB26_sel='selected';}
elseif ($DPopup_btncolor=='simple_navyblue') {$DpopupB27_sel='selected';}
elseif ($DPopup_btncolor=='simple_darkblue') {$DpopupB28_sel='selected';}
elseif ($DPopup_btncolor=='simple_blue') {$DpopupB29_sel='selected';}
elseif ($DPopup_btncolor=='simple_turquoise') {$DpopupB30_sel='selected';}
elseif ($DPopup_btncolor=='simple_greenturquoise') {$DpopupB31_sel='selected';}
elseif ($DPopup_btncolor=='simple_darkgreen') {$DpopupB32_sel='selected';}
elseif ($DPopup_btncolor=='simple_green') {$DpopupB33_sel='selected';}
elseif ($DPopup_btncolor=='simple_lemon') {$DpopupB34_sel='selected';}
elseif ($DPopup_btncolor=='simple_yellow') {$DpopupB35_sel='selected';}
elseif ($DPopup_btncolor=='simple_orange') {$DpopupB36_sel='selected';}

$DPopup_backgrounds = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_backgrounds = preg_replace("/\\\/","",$DPopup_backgrounds);
$DPopup_backgrounds = explode("|", $DPopup_backgrounds);
$DPopup_background = $DPopup_backgrounds[0];
if ($DPopup_background=='bg2') {$DpopupBackground2_sel='selected';}
elseif ($DPopup_background=='bg3') {$DpopupBackground3_sel='selected';}
elseif ($DPopup_background=='bg4') {$DpopupBackground4_sel='selected';}
elseif ($DPopup_background=='bg12') {$DpopupBackground12_sel='selected';}
elseif ($DPopup_background=='bg13') {$DpopupBackground13_sel='selected';}
elseif ($DPopup_background=='bg14') {$DpopupBackground14_sel='selected';}
$DPopup_screencolor = $DPopup_backgrounds[1];
if ($DPopup_screencolor=='#FFF') {$DpopupScreencolor1_sel='selected';}
elseif ($DPopup_screencolor=='#999') {$DpopupScreencolor2_sel='selected';}
elseif ($DPopup_screencolor=='#000') {$DpopupScreencolor3_sel='selected';}
$DPopup_screenopacity = $DPopup_backgrounds[2];
if ($DPopup_screenopacity=='0') {$DpopupScreenopacity0_sel='selected';}
elseif ($DPopup_screenopacity=='0.1') {$DpopupScreenopacity1_sel='selected';}
elseif ($DPopup_screenopacity=='0.2') {$DpopupScreenopacity2_sel='selected';}
elseif ($DPopup_screenopacity=='0.3') {$DpopupScreenopacity3_sel='selected';}
elseif ($DPopup_screenopacity=='0.4') {$DpopupScreenopacity4_sel='selected';}
elseif ($DPopup_screenopacity=='0.5') {$DpopupScreenopacity5_sel='selected';}
elseif ($DPopup_screenopacity=='0.6') {$DpopupScreenopacity6_sel='selected';}
elseif ($DPopup_screenopacity=='0.7') {$DpopupScreenopacity7_sel='selected';}
elseif ($DPopup_screenopacity=='0.8') {$DpopupScreenopacity8_sel='selected';}
elseif ($DPopup_screenopacity=='0.9') {$DpopupScreenopacity9_sel='selected';}
elseif ($DPopup_screenopacity=='1') {$DpopupScreenopacity10_sel='selected';}

$DPopup_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_title_tmp = preg_replace("/\\\/","",$DPopup_title_tmp);
    $DPopup_title = explode("|", $DPopup_title_tmp);
	$DPopup_headclr = $DPopup_title[0];
	$DPopup_headtxt = $DPopup_title[1];
	$DPopup_headclr_c = $DPopup_title[2];
$DPopup_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_text = preg_replace("/\\\/","",$DPopup_text);
$DPopup_formtitle = stripslashes($wpdb->get_var('SELECT Formtitle FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_formtitle = preg_replace("/\\\/","",$DPopup_formtitle);
$DPopup_formtext = stripslashes($wpdb->get_var('SELECT Formtext FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_formtext = preg_replace("/\\\/","",$DPopup_formtext);
$DPopup_listpoint_tmp = stripslashes($wpdb->get_var('SELECT Listpoint FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_listpoint_tmp = preg_replace("/\\\/","",$DPopup_listpoint_tmp);
    $DPopup_listpoint = explode("|", $DPopup_listpoint_tmp);
	$DPopup_point1 = $DPopup_listpoint[0];
	$DPopup_point2 = $DPopup_listpoint[1];
	$DPopup_point3 = $DPopup_listpoint[2];
	$DPopup_point4 = $DPopup_listpoint[3];
	$DPopup_point5 = $DPopup_listpoint[4];
	$DPopup_point6 = $DPopup_listpoint[5];
$DPopup_video = stripslashes($wpdb->get_var('SELECT Video FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_video = preg_replace("/\\\/","",$DPopup_video);
	
$DPopup_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_form_tmp = preg_replace("/\\\/","",$DPopup_form);
    $DPopup_formx = explode("|", $DPopup_form_tmp);
	$DPopup_form = $DPopup_formx[0];
	$DPopup_formtype = $DPopup_formx[1];
	$DPopup_clink = $DPopup_formx[2];
	$DPopup_cclick1 = $DPopup_formx[3];
	$DPopup_cblank = $DPopup_formx[4];
	if ($DPopup_cblank=="_blank") {$DPopup_cblank="checked";}
	$DPopup_cbgimage = $DPopup_formx[5];
	if ($DPopup_cbgimage!="") {$DPopup_cbgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
	$DPopup_cclick2 = $DPopup_formx[6];
	$DPopup_cwidth = $DPopup_formx[7];
	$DPopup_cheight = $DPopup_formx[8];
	$DPopup_cscroll = $DPopup_formx[9];
	if ($DPopup_cscroll=="scroll") {$DPopup_cscroll="checked";}

if ($DPopup_form=='regular' || $DPopup_form=='') {
	$Dpopupf1_sel='selected';
	$Dpopupf1_view='style="display:block"'; $Dpopupf2_view='style="display:block"'; $Dpopupf3_view='style="display:none"';
	$Dpopupf4_view='style="display:none"'; $Dpopupf5_view='style="display:none"'; 
	$Dpopup_buttonss='style="display:block"'; $Dpopup_adsection='style="display:block"'; $Dpopup_adsection2='style="display:block"';
	$Dpopupf1_view_right='style="display:block"'; 
	$DPopup_stheme = 'style="display:inline"'; $DPopup_stheme_label = 'style="display:inline"';
	$Dpopup_preview1 = 'style="display:block"'; $Dpopup_preview2 = 'style="display:none"';
}
elseif ($DPopup_form=='social') {
	$Dpopupf2_sel='selected';
	$Dpopupf1_view='style="display:none"'; $Dpopupf2_view='style="display:none"'; $Dpopupf3_view='style="display:none"';
	$Dpopupf4_view='style="display:none"'; $Dpopupf5_view='style="display:none"';
	$Dpopup_buttonss='style="display:block"'; $Dpopup_adsection='style="display:block"'; $Dpopup_adsection2='style="display:block"';
	$Dpopupf1_view_right='style="display:none"';
	$DPopup_stheme = 'style="display:inline"'; $DPopup_stheme_label = 'style="display:inline"';
	$Dpopup_preview1 = 'style="display:block"'; $Dpopup_preview2 = 'style="display:none"';
}
elseif ($DPopup_form=='both') {
	$Dpopupf12_sel='selected';
	$Dpopupf1_view='style="display:block"'; $Dpopupf2_view='style="display:block"'; $Dpopupf3_view='style="display:none"';
	$Dpopupf4_view='style="display:none"'; $Dpopupf5_view='style="display:none"'; 
	$Dpopup_buttonss='style="display:block"'; $Dpopup_adsection='style="display:block"'; $Dpopup_adsection2='style="display:block"';
	$Dpopupf1_view_right='style="display:block"'; 
	$DPopup_stheme = 'style="display:inline"'; $DPopup_stheme_label = 'style="display:inline"';
	$Dpopup_preview1 = 'style="display:block"'; $Dpopup_preview2 = 'style="display:none"';
}
elseif ($DPopup_form=='link') {
	$Dpopupf3_sel='selected';
	$Dpopupf1_view='style="display:block"'; $Dpopupf2_view='style="display:none"'; $Dpopupf3_view='style="display:block"';
	$Dpopupf4_view='style="display:none"'; $Dpopupf5_view='style="display:none"';
	$Dpopup_buttonss='style="display:block"'; $Dpopup_adsection='style="display:block"'; $Dpopup_adsection2='style="display:block"';
	$Dpopupf1_view_right='style="display:none"';
	$DPopup_stheme = 'style="display:inline"'; $DPopup_stheme_label = 'style="display:inline"';
	$Dpopup_preview1 = 'style="display:block"'; $Dpopup_preview2 = 'style="display:none"';
}
elseif ($DPopup_form=='custom') {
	$Dpopupf4_sel='selected';
	$Dpopupf1_view='style="display:none"'; $Dpopupf2_view='style="display:none"'; $Dpopupf3_view='style="display:block"';
	$Dpopupf4_view='style="display:block"'; $Dpopupf5_view='style="display:block"';
	$Dpopup_buttonss='style="display:none"'; $Dpopup_adsection='style="display:none"'; $Dpopup_adsection2='style="display:none"';
	$Dpopupf1_view_right='style="display:none"';
	$DPopup_stheme = 'style="display:none"'; $DPopup_stheme_label = 'style="display:none"';
	$Dpopup_preview1 = 'style="display:none"'; $Dpopup_preview2 = 'style="display:block"';
}

if ($DPopup_formtype=='link' || $DPopup_formtype=='') {
	$Dpopupf10_sel='selected';
	$Dpopupf6_view='style="display:block"'; $Dpopupf7_view='style="display:none"'; $Dpopupf8_view='style="display:block"';
}
elseif ($DPopup_formtype=='image') {
	$Dpopupf20_sel='selected';
	$Dpopupf6_view='style="display:none"'; $Dpopupf7_view='style="display:block"'; $Dpopupf8_view='style="display:none"';
}
else {
	$Dpopupf10_sel='selected';
	$Dpopupf6_view='style="display:block"'; $Dpopupf7_view='style="display:none"'; $Dpopupf8_view='style="display:none"';
}

$DPopup_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_regular_tmp = preg_replace("/\\\/","",$DPopup_regular_tmp);
    $DPopup_regular = explode("|", $DPopup_regular_tmp);
	$Popup_fname = $DPopup_regular[0];
	$Popup_femail = $DPopup_regular[1];
	$Popup_fbtntxt = $DPopup_regular[2];
	$Popup_fbtnclr = $DPopup_regular[3];
	if ($DPopup_regular[4]=="1") {$DPopup_name_disabled="checked";}
	
$DPopup_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_spam = preg_replace("/\\\/","",$DPopup_spam);
$DPopup_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_optin = preg_replace("/<br>/","\n",$DPopup_optin);
	$DPopup_optin = preg_replace("/\\\/","",$DPopup_optin);
	$DPopup_optin = explode("|",$DPopup_optin);
	if ($DPopup_optin[4]=="on") {$DPopup_optinch="checked";}
$DPopup_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid);
	if ($DPopup_active_tmp=="on") {$DPopup_active="checked";} else {$DPopup_activated='style="background-color:#FCC"';}

	//replace html br with \n before display in text field
	$DPopup_headtxt = preg_replace("/<br>/","\n",$DPopup_headtxt);
	$DPopup_text = preg_replace("/<br>/","\n",$DPopup_text);
	$DPopup_formtitle = preg_replace("/<br>/","\n",$DPopup_formtitle);
	$DPopup_formtext = preg_replace("/<br>/","\n",$DPopup_formtext);
	$DPopup_spam = preg_replace("/<br>/","\n",$DPopup_spam);
	
$DPopup_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
    $DPopup_display = explode("|", $DPopup_displays);
	$DPopup_dpages = $DPopup_display[0];
	$DPopup_dcats = $DPopup_display[1];
	$DPopup_dposts = $DPopup_display[2];
	if (strpos($DPopup_dpages,'allpages')!==false) {$DPopup_dpagesall="checked";}
	if (strpos($DPopup_dcats,'allcats')!==false) {$DPopup_dcatsall="checked";}
	if (strpos($DPopup_dposts,'allposts')!==false) {$DPopup_dpostsall="checked";}
	//if ($DPopup_dpagesall=="" && $DPopup_dcatsall=="" && $DPopup_dpostsall=="") {$DPopup_dcheckall="";}
	$DPopup_showsub = $DPopup_display[3];
	if ($DPopup_showsub=="on") {$DPopup_showsub="checked";}
	$DPopup_ddelay = $DPopup_display[4];
	$DPopup_ddays = $DPopup_display[5];
	$DPopup_dstart = $DPopup_display[6];
	$DPopup_dstop = $DPopup_display[7];
?>

<script type="text/javascript">
function sh1_theme(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='1') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="block";
		document.getElementById("Popup_show3").style.display="none";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="Popup_bg";
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="block";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD1.gif'; ?>">');
	} else if(sel.selectedIndex=='2') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="block";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="Popup_bg"; 
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="block";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD2.gif'; ?>">');
	} else if(sel.selectedIndex=='3') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="Popup_bg";
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="block";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD3.gif'; ?>">');
	} else if(sel.selectedIndex=='4') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="block";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="Popup_bg";
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD4.gif'; ?>">');
	} else if(sel.selectedIndex=='5') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="Popup_bg";
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD5.gif'; ?>">');
	} else if(sel.selectedIndex=='6') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="none";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="none";
		document.getElementById("Popup_show6").style.display="block";
        document.getElementById("Popup_selectBgs1").name="Popup_bg";
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD8.gif'; ?>">');
	} else if(sel.selectedIndex=='7') {
		document.getElementById("Popup_show1").style.display="none";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="none";
		document.getElementById("Popup_show6").style.display="block";
        document.getElementById("Popup_selectBgs1").name="Popup_bg";
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD6.gif'; ?>">');
	} else if(sel.selectedIndex=='8' || sel.selectedIndex=='9') {
		document.getElementById("Popup_show1").style.display="none";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="none";
		document.getElementById("Popup_show6").style.display="block";
        document.getElementById("Popup_selectBgs1").name="Popup_bg";
        document.getElementById("Popup_selectBgs2").name="";
        document.getElementById("Popup_selectBgs1").style.display="inline";
        document.getElementById("Popup_selectBgs2").style.display="none";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupD7.gif'; ?>">');
	} else if(sel.selectedIndex=='10' || sel.selectedIndex=='11') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="block";
		document.getElementById("Popup_show3").style.display="none";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="block";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL1.gif'; ?>">');
	} else if(sel.selectedIndex=='12') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="block";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="block";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL2.gif'; ?>">');
	} else if(sel.selectedIndex=='13') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="block";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL3.gif'; ?>">');
	} else if(sel.selectedIndex=='14') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="block";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL4.gif'; ?>">');
	} else if(sel.selectedIndex=='15') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="block";
		document.getElementById("Popup_show6").style.display="none";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL5.gif'; ?>">');
	} else if(sel.selectedIndex=='16') {
		document.getElementById("Popup_show1").style.display="block";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="none";
		document.getElementById("Popup_show4").style.display="none";
		document.getElementById("Popup_show5").style.display="none";
		document.getElementById("Popup_show6").style.display="block";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL8.gif'; ?>">');
	} else if(sel.selectedIndex=='17') {
		document.getElementById("Popup_show1").style.display="none";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="none";
		document.getElementById("Popup_show6").style.display="block";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL6.gif'; ?>">');
	} else if(sel.selectedIndex=='18') {
		document.getElementById("Popup_show1").style.display="none";
		document.getElementById("Popup_show2").style.display="none";
		document.getElementById("Popup_show3").style.display="block";
		document.getElementById("Popup_show4").style.display="block";
		document.getElementById("Popup_show5").style.display="none";
		document.getElementById("Popup_show6").style.display="block";
        document.getElementById("Popup_selectBgs1").name="";
        document.getElementById("Popup_selectBgs2").name="Popup_bg";
        document.getElementById("Popup_selectBgs1").style.display="none";
        document.getElementById("Popup_selectBgs2").style.display="inline";
        document.getElementById("Popup_uploadimage").style.display="none";
		$jj('#popup1img').replaceWith('<img id="popup1img" src="<?php echo GenerationPlugin_preview.'/popupL7.gif'; ?>">');
	}
}
$jj(document).ready(function(){
	$jj("#Popup_name").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_email").charCount({allowed:22, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_btntxt").charCount({allowed:18, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_headtxt").charCount({allowed:42, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_headdes").charCount({allowed:170, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_formtxt").charCount({allowed:15, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_formdes").charCount({allowed:65, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_point1").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_point2").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_point3").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_point4").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_point5").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_point6").charCount({allowed:34, warning:0, /*counterText:'left: '*/});
	$jj("#Popup_spam").charCount({allowed:80, warning:0, /*counterText:'left: '*/});
});
</script>

		
        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DPopup_activated; ?>>
				<input name="Popup_active" type="checkbox" <?php echo $DPopup_active; ?>> Activate Lightbox Popup
			</div>
            <select name="Popup_theme" id="selectpopup" onchange="sh1_theme(this)" <?php echo $DPopup_stheme; ?>>
				<option value="popup1" style="color:#069; font-weight:bold">Graphite themes</option>
                <option value="popup1" <?php echo $Dpopup1_sel; ?>>vertical</option>
                <option value="popup2" <?php echo $Dpopup2_sel; ?>>product plus</option>
                <option value="popup3" <?php echo $Dpopup3_sel; ?>>product</option>
                <option value="popup4" <?php echo $Dpopup4_sel; ?>>standard</option>
                <option value="popup5" <?php echo $Dpopup5_sel; ?>>mini</option>
                <option value="popup6" <?php echo $Dpopup6_sel; ?>>video vertical</option>
                <option value="popup7" <?php echo $Dpopup7_sel; ?>>video 640 x 320</option>
                <option value="popup8" <?php echo $Dpopup8_sel; ?>>video 480 x 320</option>
				<option value="popup8">&nbsp;</option>
				<option value="popup11" style="color:#069; font-weight:bold">Silver themes</option>
                <option value="popup11" <?php echo $Dpopup11_sel; ?>>vertical</option>
                <option value="popup12" <?php echo $Dpopup12_sel; ?>>product plus</option>
                <option value="popup13" <?php echo $Dpopup13_sel; ?>>product</option>
                <option value="popup14" <?php echo $Dpopup14_sel; ?>>standard</option>
                <option value="popup15" <?php echo $Dpopup15_sel; ?>>mini</option>
                <option value="popup16" <?php echo $Dpopup16_sel; ?>>video vertical</option>
                <option value="popup17" <?php echo $Dpopup17_sel; ?>>video 640 x 320</option>
                <option value="popup18" <?php echo $Dpopup18_sel; ?>>video 480 x 320</option>
            </select> <span id="selectpopup_label" <?php echo $DPopup_stheme_label; ?>>Template</span>
			<select name="Popup_form" onchange="sh1(this)">
				<option value="regular" <?php echo $Dpopupf1_sel; ?>>regular</option>
				<option value="social" <?php echo $Dpopupf2_sel; ?>>facebook</option>
				<option value="both" <?php echo $Dpopupf12_sel; ?>>regular and facebook switch</option>
				<option value="link" <?php echo $Dpopupf3_sel; ?>>link</option>
				<option value="custom" <?php echo $Dpopupf4_sel; ?>>custom content</option>
			</select> Type of sign-up form
			<div id="xchoice11" <?php echo $Dpopupf5_view; ?>>
    			<select name="Popup_ccontent" onchange="sh10(this)">
    				<option value="link" <?php echo $Dpopupf10_sel; ?>>webpage</option>
    				<option value="image" <?php echo $Dpopupf20_sel; ?>>image</option>
    			</select> Type of custom content
			</div>
			
			<div id="ichoice12" <?php echo $Dpopupf4_view; ?>>
				<div id="ichoice15" <?php echo $Dpopupf8_view; ?>>
    				<input name="Popup_cwidth" type="text" value="<?php echo $DPopup_cwidth; ?>"> Box width in pixels
            		<br/>
    				<input name="Popup_cheight" type="text" value="<?php echo $DPopup_cheight; ?>"> Box height in pixels
            		<br/>
    				<input name="Popup_cscroll" type="checkbox" value="scroll" <?php echo $DPopup_cscroll; ?>> Show vertical scrollbar
				</div>
				<div id="ichoice13" <?php echo $Dpopupf6_view; ?>>
					<input name="Popup_clink" type="text" value="<?php echo $DPopup_clink; ?>">
					<img id="helpbtn_popup8" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        			<span class="maxfile" id="helptip_popup8">URLs starting with 'https://' will not open in box due to security reasons.</span> Link to webpage
				</div>
				<div id="ichoice14" <?php echo $Dpopupf7_view; ?>>
					<input name="Popup_cbg" type="file" size="26">
        			<?php if (filesize($DPopup_cbgimage)>=1048576) { ?>
        				<img id="helpbtn_popup9" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
        				<span class="maxfilewarning" id="helptip_popup9">Max 1Mb!</span>
        			<?php } else { ?>
        				<img id="helpbtn_popup9" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        				<span class="maxfile" id="helptip_popup9">Max 1Mb</span>
        			<?php } ?>
        			<?php echo $DPopup_cbgimage_img; ?>
					<span style="display:inline; margin-bottom:100px">Upload an image...</span>
        			<br/>
        			<input name="Popup_cbgremove" type="checkbox"> Remove uploaded image
					<br/>
    				<input name="Popup_cclick1" type="text" value="<?php echo $DPopup_cclick1; ?>"> ...or use external image
					<br/>
    				<input name="Popup_cclick2" type="text" value="<?php echo $DPopup_cclick2; ?>"> Link for <i>click</i> action
					<br/>
					<input name="Popup_cblank" type="checkbox" value="_blank" <?php echo $DPopup_cblank; ?>> Open the link in new tab
				</div>
			</div>
			
            <div id="choice10" name="choice11" <?php echo $Dpopupf1_view; ?>>
				<div id="ichoice10" <?php echo $Dpopupf2_view; ?>>
    				<input id="Popup_name" name="Popup_name" type="text" value="<?php echo $Popup_fname; ?>"> 'Name' default value
					<br/>
					<input name="Popup_name_disabled" type="checkbox" value="1" <?php echo $DPopup_name_disabled; ?>> Do not show 'Name' field in form
                    <br/>
                    <input id="Popup_email" name="Popup_email" type="text" value="<?php echo $Popup_femail; ?>"> 'Email' default value
                    <br/>
				</div>
				<div id="ichoice11" <?php echo $Dpopupf3_view; ?>>	
					<input name="Popup_link" type="text" value="<?php echo $DPopup_link; ?>"> Destin. page
					<br/>
					<input name="Popup_link_blank" type="checkbox" value="_blank" <?php echo $DPopup_link_blank; ?>> Open the page in new tab
					<br/>
				</div>
				
				<div id="Popup_buttonss" <?php echo $Dpopup_buttonss; ?>>
                <input id="Popup_btntxt" name="Popup_btntxt" type="text" value="<?php echo $Popup_fbtntxt; ?>"> Button text
                <br/>
				<select name="Popup_btnclr" id="selectButtons">
					<option style="margin-left:-136px; color:#069; font-weight:bold">Stripe design</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark.gif'; ?>)" 
						value="stripe_darkred" <?php echo $DpopupB1_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red.gif'; ?>)" 
						value="stripe_red" <?php echo $DpopupB2_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta.gif'; ?>)" 
						value="stripe_magenta" <?php echo $DpopupB3_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta.gif'; ?>)" 
						value="stripe_violetmagenta" <?php echo $DpopupB4_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet.gif'; ?>)" 
						value="stripe_violet" <?php echo $DpopupB5_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet.gif'; ?>)" 
						value="stripe_blueviolet" <?php echo $DpopupB6_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy.gif'; ?>)" 
						value="stripe_navyblue" <?php echo $DpopupB7_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark.gif'; ?>)" 
						value="stripe_darkblue" <?php echo $DpopupB8_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue.gif'; ?>)" 
						value="stripe_blue" <?php echo $DpopupB9_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise.gif'; ?>)" 
						value="stripe_turquoise" <?php echo $DpopupB10_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise.gif'; ?>)" 
						value="stripe_greenturquoise" <?php echo $DpopupB11_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark.gif'; ?>)" 
						value="stripe_darkgreen" <?php echo $DpopupB12_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green.gif'; ?>)" 
						value="stripe_green" <?php echo $DpopupB13_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon.gif'; ?>)" 
						value="stripe_lemon" <?php echo $DpopupB14_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow.gif'; ?>)" 
						value="stripe_yellow" <?php echo $DpopupB15_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange.gif'; ?>)" 
						value="stripe_orange" <?php echo $DpopupB16_sel; ?>>orange</option>
					<option>&nbsp;</option>
					<option style="margin-left:-136px; color:#069; font-weight:bold">Simple design</option>
					<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark2.gif'; ?>)" 
						value="simple_darkred" <?php echo $DpopupB21_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red2.gif'; ?>)" 
						value="simple_red" <?php echo $DpopupB22_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta2.gif'; ?>)" 
						value="simple_magenta" <?php echo $DpopupB23_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta2.gif'; ?>)" 
						value="simple_violetmagenta" <?php echo $DpopupB24_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet2.gif'; ?>)" 
                        value="simple_violet" <?php echo $DpopupB25_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet2.gif'; ?>)" 
  						value="simple_blueviolet" <?php echo $DpopupB26_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy2.gif'; ?>)" 
						value="simple_navyblue" <?php echo $DpopupB27_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark2.gif'; ?>)" 
						value="simple_darkblue" <?php echo $DpopupB28_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue2.gif'; ?>)" 
						value="simple_blue" <?php echo $DpopupB29_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise2.gif'; ?>)" 
						value="simple_turquoise" <?php echo $DpopupB30_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise2.gif'; ?>)" 
						value="simple_greenturquoise" <?php echo $DpopupB31_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark2.gif'; ?>)" 
						value="simple_darkgreen" <?php echo $DpopupB32_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green2.gif'; ?>)" 
						value="simple_green" <?php echo $DpopupB33_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon2.gif'; ?>)" 
						value="simple_lemon" <?php echo $DpopupB34_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow2.gif'; ?>)" 
						value="simple_yellow" <?php echo $DpopupB35_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange2.gif'; ?>)" 
						value="simple_orange" <?php echo $DpopupB36_sel; ?>>orange</option>
				</select> Button color
				</div>
			</div>
			
			<div id="Popup_adsection" <?php echo $Dpopup_adsection; ?>>

			<input name="Popup_headclr" type="text" id="colorpopup" value="<?php echo $DPopup_headclr; ?>" />
			<div style="margin:0 0 -25px 235px">
				<input style="position:absolute; margin:5px 0 0 -21px" name="Popup_headclr_c" type="checkbox" value="on" <?php if ($DPopup_headclr_c=="on") {echo "checked";} ?> />
				<img id="helpbtn_popup5" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="headclrhelp" id="helptip_popup5">Pick your color and check the checkbox to setup headers color different than button color.</span>
				Custom headers color
			</div>
            <br/>
			<div id="Popup_show1" <?php echo $DPopup_show1; ?>>
				<textarea id="Popup_headtxt" name="Popup_headtxt"><?php echo $DPopup_headtxt; ?></textarea>
				<img id="helpbtn_popup6" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="countdownhelp" id="helptip_popup6">Use number in brackets (max '90') to add countdown timer. Number in brackets = minutes, e.g.(57).</span>
				Header text
            <br/>
			</div>
			<div id="Popup_show2" <?php echo $DPopup_show2; ?>>
            	<textarea id="Popup_headdes" name="Popup_headdes"><?php echo $DPopup_text; ?></textarea> Header description
            <br/>
			</div>
			<div id="Popup_show3" <?php echo $DPopup_show3; ?>>
				<textarea id="Popup_formtxt" name="Popup_formtxt"><?php echo $DPopup_formtitle; ?></textarea> Form header text
            <br/>
			</div>
			<div id="Popup_show4" <?php echo $DPopup_show4; ?>>
            	<textarea id="Popup_formdes" name="Popup_formdes"><?php echo $DPopup_formtext; ?></textarea> Form header description
            <br/>
			</div>
			<div id="Popup_show5" class="m8px" <?php echo $DPopup_show5; ?>>
                <input id="Popup_point1" name="Popup_point1" type="text" value="<?php echo $DPopup_point1; ?>"> List point #1
                <br/>
                <input id="Popup_point2" name="Popup_point2" type="text" value="<?php echo $DPopup_point2; ?>"> List point #2
                <br/>
                <input id="Popup_point3" name="Popup_point3" type="text" value="<?php echo $DPopup_point3; ?>"> List point #3
                <br/>
                <input id="Popup_point4" name="Popup_point4" type="text" value="<?php echo $DPopup_point4; ?>"> List point #4
                <br/>
                <input id="Popup_point5" name="Popup_point5" type="text" value="<?php echo $DPopup_point5; ?>"> List point #5
                <br/>
                <input style="margin-bottom:-4px" id="Popup_point6" name="Popup_point6" type="text" value="<?php echo $DPopup_point6; ?>"> List point #6
			</div>
            <textarea id="Popup_spam" name="Popup_spam"><?php echo $DPopup_spam; ?></textarea> Anti-spam note
			<div id="Popup_show6" <?php echo $DPopup_show6; ?>>
            	<textarea name="Popup_video"><?php echo $DPopup_video; ?></textarea> Product video
			</div>
			
			</div>
			
			<select name="Popup_screencolor" class="GP_screenselect" style="width:133px">
					<option value="#FFF">Color</option>
    				<option value="#FFF" <?php echo $DpopupScreencolor1_sel; ?>>light</option>
    				<option value="#999" <?php echo $DpopupScreencolor2_sel; ?>>medium</option>
    				<option value="#000" <?php echo $DpopupScreencolor3_sel; ?>>dark</option>
			</select>
			<select name="Popup_screenopacity" class="GP_screenselect">
					<option value="0.8">Opacity</option>
    				<option value="0" <?php echo $DpopupScreenopacity0_sel; ?>>0 (none)</option>
    				<option value="0.1" <?php echo $DpopupScreenopacity1_sel; ?>>1</option>
    				<option value="0.2" <?php echo $DpopupScreenopacity2_sel; ?>>2</option>
    				<option value="0.3" <?php echo $DpopupScreenopacity3_sel; ?>>3</option>
    				<option value="0.4" <?php echo $DpopupScreenopacity4_sel; ?>>4</option>
    				<option value="0.5" <?php echo $DpopupScreenopacity5_sel; ?>>5 (medium)</option>
    				<option value="0.6" <?php echo $DpopupScreenopacity6_sel; ?>>6</option>
    				<option value="0.7" <?php echo $DpopupScreenopacity7_sel; ?>>7</option>
    				<option value="0.8" <?php echo $DpopupScreenopacity8_sel; ?>>8 (default)</option>
    				<option value="0.9" <?php echo $DpopupScreenopacity9_sel; ?>>9</option>
    				<option value="1" <?php echo $DpopupScreenopacity10_sel; ?>>10 (solid)</option>
			</select> <span style="display:inline">Screen background</span>
			
			<div id="Popup_adsection2" <?php echo $Dpopup_adsection2; ?>>
			
			<select <?php echo $Popup_bg1_name; ?> id="Popup_selectBgs1" <?php echo $DPopup_selectBgs1; ?>>
					<option style="margin-left:-136px">Dark backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_noise.gif'; ?>)" 
						value="bg2" <?php echo $DpopupBackground2_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_carbonfiber.gif'; ?>)" 
						value="bg3" <?php echo $DpopupBackground3_sel; ?>>carbon fiber</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_wood.gif'; ?>)" 
						value="bg4" <?php echo $DpopupBackground4_sel; ?>>wood</option>
			</select>	
			<select <?php echo $Popup_bg2_name; ?> id="Popup_selectBgs2" <?php echo $DPopup_selectBgs2; ?>>
					<option style="margin-left:-136px">Light backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_noise.gif'; ?>)" 
						value="bg12" <?php echo $DpopupBackground12_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_sparkles.gif'; ?>)" 
						value="bg13" <?php echo $DpopupBackground13_sel; ?>>sparkles</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_blur.gif'; ?>)" 
						value="bg14" <?php echo $DpopupBackground14_sel; ?>>blur</option>
			</select> <span style="display:inline">Product background</span>
			<br/>
            <input name="Popup_bg" type="file" size="26">
			<?php if (filesize($DPopup_bgimage)>=307201) { ?>
				<img id="helpbtn_popup3" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_popup3">Max 300kb!</span>
			<?php } else { ?>
				<img id="helpbtn_popup3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_popup3">Max 300kb</span>
			<?php } ?>
			<?php echo $DPopup_bgimage_img; ?>
			<br/>
			<input name="Popup_bgremove" type="checkbox"> Remove uploaded background
			<br/>
			<div id="Popup_uploadimage" <?php echo $DPopup_uploadimage; ?>>
                <input class="m8px" name="Popup_file" type="file" size="26">
    			<?php if (filesize($DPopup_image)>=81921) { ?>
    				<img id="helpbtn_popup4" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
    				<span class="maxfilewarning" id="helptip_popup4">Max 70kb! (200x220px)</span>
    			<?php } else { ?>
    				<img id="helpbtn_popup4" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
    				<span class="maxfile" id="helptip_popup4">Max 70kb (200x220px)</span>
    			<?php } ?>
    			<?php echo $DPopup_image_img; ?> Product image
    			<br/>
    			<input name="Popup_fileremove" type="checkbox"> Remove uploaded image
			</div>
        </div>
		
        </div>
            
        <div class="right_section" id="popup_checkboxes">
			<h4 class="hiddens" style="color:#690; display:none">
				Advanced settings
			</h4>
            <div class="toggle" style="color:#690; display:none">
				Choose existing box&nbsp;
				<select style="width:130px; margin-top:20px; border:1px solid #9C3" name="Popup_idd" id="selectpopupid" onchange="sh1_id(this)" <?php echo $DPopup_sid; ?>>
    				<option value="popup1">#1</option>
    				<option value="popup2">#2</option>
    				<option value="popup3">#3</option>
    			</select>
    			<span style="margin-left:5px; color:#690">or create new one&nbsp;</span>
				<input type="text" style="width:130px; margin-top:20px; border:1px solid #9C3" name="Popup_idd" id="selectpopupid" <?php echo $DPopup_sid; ?>>
    			<span style="margin-left:5px; color:#690">and click 'Save' button.</span>
				<br>
				<span style="color:#690">A/B split testing: </span>
				<select style="width:130px; margin-top:4px; margin-bottom:6px; border:1px solid #9C3" name="Popup_idd" id="selectpopupid" onchange="sh1_id(this)" <?php echo $DPopup_sid; ?>>
    				<option value="popup1">#1</option>
    				<option value="popup2">#2</option>
    				<option value="popup3">#3</option>
    			</select>
				<select style="width:130px; margin-top:4px; margin-bottom:6px; border:1px solid #9C3" name="Popup_idd" id="selectpopupid" onchange="sh1_id(this)" <?php echo $DPopup_sid; ?>>
    				<option value="popup1">#1</option>
    				<option value="popup2">#2</option>
    				<option value="popup3">#3</option>
    			</select>
				<select style="width:130px; margin-top:4px; margin-bottom:6px; border:1px solid #9C3" name="Popup_idd" id="selectpopupid" onchange="sh1_id(this)" <?php echo $DPopup_sid; ?>>
    				<option value="popup1">#1</option>
    				<option value="popup2">#2</option>
    				<option value="popup3">#3</option>
    			</select>
				<select style="width:130px; margin-top:4px; margin-bottom:6px; border:1px solid #9C3" name="Popup_idd" id="selectpopupid" onchange="sh1_id(this)" <?php echo $DPopup_sid; ?>>
    				<option value="popup1">#1</option>
    				<option value="popup2">#2</option>
    				<option value="popup3">#3</option>
    			</select>
			</div>
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_popup1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_popup1">Click here to show options.</span>
			</h4>
            <div class="toggle">
				<input style="display:inline-block" type="checkbox" name="Popup_pagelist[]" value="allpages" <?php echo $DPopup_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DPopup_dpages_front="front";
				if (strpos(','.$DPopup_dpages.',',',front,')!==false || $DPopup_displays=="") {$DPopup_dpagesch[$DPopup_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Popup_pagelist[]" value="front" '.$DPopup_dpagesch[$DPopup_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DPopup_dpages_search="search";
				if (strpos(','.$DPopup_dpages.',',',search,')!==false || $DPopup_displays=="") {$DPopup_dpagesch[$DPopup_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Popup_pagelist[]" value="search" '.$DPopup_dpagesch[$DPopup_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DPopup_dpages_author="author";
				if (strpos(','.$DPopup_dpages.',',',author,')!==false || $DPopup_displays=="") {$DPopup_dpagesch[$DPopup_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Popup_pagelist[]" value="author" '.$DPopup_dpagesch[$DPopup_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order');
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DPopup_dpages.',',','.trim($pageID).',')!==false || $DPopup_displays=="") {$DPopup_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Popup_pagelist[]" value="'.$pageID.'" '.$DPopup_dpagesch[$pageID].'>';
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
 							if (strpos(','.$DPopup_dpages.',',','.trim($childID).',')!==false || $DPopup_displays=="") {$DPopup_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Popup_pagelist[]" value="'.$childID.'" '.$DPopup_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline;" type="checkbox" name="Popup_catlist[]" value="allcats" <?php echo $DPopup_dcatsall; ?>>
				<div style="display:inline-block; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DPopup_dcats.',',','.trim($cat_id).',')!==false || $DPopup_displays=="") {$DPopup_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Popup_catlist[]" value="'.$cat_id.'" '.$DPopup_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Popup_postlist[]" value="allposts" <?php echo $DPopup_dpostsall; ?>>
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
							if (strpos(','.$DPopup_dposts.',',','.trim($id).',')!==false || $DPopup_displays=="") {$DPopup_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Popup_postlist[]" value="'.$id.'" '.$DPopup_dpostsch[$id].'>&nbsp;';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="Popup_showsub" <?php echo $DPopup_showsub; ?>>
					&nbsp;<span style="color:#069">Do NOT show to subscribers</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="popup_checkboxes_switch" <?php echo $DPopup_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				Show after <input class="showdelay" name="Popup_ddelay" type="text" value="<?php echo $DPopup_ddelay; ?>"> seconds<br>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Popup_dstart" type="text" value="<?php echo $DPopup_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Popup_dstop" type="text" value="<?php echo $DPopup_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Popup_ddays" type="text" value="<?php echo $DPopup_ddays; ?>"> days<br>
				-->

            </div>

			<h4 id="right_choice10" class="hiddens" <?php echo $Dpopupf1_view_right; ?>>
				Opt-in settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_popup7" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_popup7">Click here to show options.</span>
			</h4>
            <div id="Popup_optin" class="toggle" <?php echo $Dpopupf1_view_right; ?>>
					<div class="gpadminoptional" style="margin-bottom:0; width:535px">
						Make sure there is data in 'form action' field. Otherwise change 'form' to 'formc' in your opt-in code.
					</div>
                    <textarea name="Popup_optin1" id="gpoptinform_popup"><?php echo str_replace(":::","|",$DPopup_optin[0]); ?></textarea> Opt-in code<br/>
                    <div id="gpformarea_popup" style="display:none"></div>
                    <input type="button" value="Process" id="gpproccessit_popup"><br/>
					<textarea style="margin:3px 0" name="Popup_optin5" id="gpformaction_popup"><?php echo $DPopup_optin[4]; ?></textarea> form action<br/>
                    <select name="Popup_optin2" id="gpnamefield_popup">
    					<option value="<?php echo $DPopup_optin[1]; ?>"><?php echo $DPopup_optin[1]; ?></option>
    				</select> 'NAME' field<br/>
                    <select name="Popup_optin3" id="gpemailfield_popup">
    					<option value="<?php echo $DPopup_optin[2]; ?>"><?php echo $DPopup_optin[2]; ?></option>
    				</select> 'EMAIL' field<br/>
                    <!-- <input name="Popup_optin4" value="on" type="checkbox" id="gpdisablename_popup" <?php echo $DPopup_optinch; ?>> disable NAME field<br/> -->
                    <input type="checkbox" id="gpshowalldata_popup"> show all processed data<br/>
                    <div id="gpalldata_popup" style="display:none">
                        <textarea name="Popup_optin6" id="gphiddenfields_popup"><?php echo $DPopup_optin[5]; ?></textarea> hidden fields<br/>
                        <textarea name="Popup_optin7" id="gpignoredfields_popup"><?php echo $DPopup_optin[6]; ?></textarea> ignored fields<br/>
                        <textarea name="Popup_optin8" id="gpotherfields_popup"><?php echo $DPopup_optin[7]; ?></textarea> other fields<br/>
                        <textarea name="Popup_optin9" id="gpsubmitbutton_popup"><?php echo $DPopup_optin[8]; ?></textarea> submit button<br/>
                    </div><br/>
			</div>

        	<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_popup2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_popup2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="popup1" class="preview1" <?php echo $Dpopup_preview1; ?>><?php echo $Dpopup_view; ?></div>
			<div id="popup2" class="preview1" <?php echo $Dpopup_preview2; ?>><img src="<?php echo GenerationPlugin_preview.'/popupCC.gif'; ?>"></div>
        </div>
				
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_popup" type="hidden" value="Save Changes">
    		<input id="Savepreview_popup" name="Savepreview_popup" type="hidden" value="Savepreview_popup">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_popup').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div>
