<div id="tab6" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_inside" enctype="multipart/form-data">


<?php
if (isset($_POST['displayingformsent_inside'])=='Save Changes') {

	//multiple values into one database cell
	if ($_POST['Inside_headclr_c']=="on") {$Inside_headclr=$_POST['Inside_headclr'];}
	elseif ($_POST['Inside_form']=="social") {$Inside_headclr="0d66ae";}
	elseif ($_POST['Inside_btnclr']=="stripe_darkred" || $_POST['Inside_btnclr']=="simple_darkred") {$Inside_headclr="a92e20";}
	elseif ($_POST['Inside_btnclr']=="stripe_red" || $_POST['Inside_btnclr']=="simple_red") {$Inside_headclr="d53929";}
	elseif ($_POST['Inside_btnclr']=="stripe_magenta" || $_POST['Inside_btnclr']=="simple_magenta") {$Inside_headclr="c73272";}
	elseif ($_POST['Inside_btnclr']=="stripe_violetmagenta" || $_POST['Inside_btnclr']=="simple_violetmagenta") {$Inside_headclr="b940b3";}
	elseif ($_POST['Inside_btnclr']=="stripe_violet" || $_POST['Inside_btnclr']=="simple_violet") {$Inside_headclr="6c4ab2";}
	elseif ($_POST['Inside_btnclr']=="stripe_blueviolet" || $_POST['Inside_btnclr']=="simple_blueviolet") {$Inside_headclr="4442ad";}
	elseif ($_POST['Inside_btnclr']=="stripe_navyblue" || $_POST['Inside_btnclr']=="simple_navyblue") {$Inside_headclr="286c9e";}
	elseif ($_POST['Inside_btnclr']=="stripe_darkblue" || $_POST['Inside_btnclr']=="simple_darkblue") {$Inside_headclr="387dab";}
	elseif ($_POST['Inside_btnclr']=="stripe_blue" || $_POST['Inside_btnclr']=="simple_blue") {$Inside_headclr="299eb9";}
	elseif ($_POST['Inside_btnclr']=="stripe_turquoise" || $_POST['Inside_btnclr']=="simple_turquoise") {$Inside_headclr="38b5af";}
	elseif ($_POST['Inside_btnclr']=="stripe_greenturquoise" || $_POST['Inside_btnclr']=="simple_greenturquoise") {$Inside_headclr="2cc183";}
	elseif ($_POST['Inside_btnclr']=="stripe_darkgreen" || $_POST['Inside_btnclr']=="simple_darkgreen") {$Inside_headclr="5ca138";}
	elseif ($_POST['Inside_btnclr']=="stripe_green" || $_POST['Inside_btnclr']=="simple_green") {$Inside_headclr="93b73f";}
	elseif ($_POST['Inside_btnclr']=="stripe_lemon" || $_POST['Inside_btnclr']=="simple_lemon") {$Inside_headclr="d6ce28";}
	elseif ($_POST['Inside_btnclr']=="stripe_yellow" || $_POST['Inside_btnclr']=="simple_yellow") {$Inside_headclr="d1bd26";}
	elseif ($_POST['Inside_btnclr']=="stripe_orange" || $_POST['Inside_btnclr']=="simple_orange") {$Inside_headclr="e68f1b";}
	else {$Inside_headclr="CC3300";}
	$Inside_head = "#".trim($Inside_headclr."|".$_POST['Inside_headtxt']."|".$_POST['Inside_headclr_c'], "#");
	$Inside_regular = $_POST['Inside_name']."|".$_POST['Inside_email']."|".$_POST['Inside_btntxt']."|".$_POST['Inside_btnclr']."|".$_POST['Inside_name_disabled'];
	$Inside_social = "facebook";
	$Inside_background = $_POST['Inside_bg']."|".$_POST['Inside_screencolor']."|".$_POST['Inside_screenopacity'];
	$Inside_optin = trim(str_replace("|",":::",$_POST['Inside_optin1']))."|".trim($_POST['Inside_optin2'])."|".trim($_POST['Inside_optin3'])."|".trim($_POST['Inside_optin4'])."|".trim($_POST['Inside_optin5'])."|".trim($_POST['Inside_optin6'])."|".trim($_POST['Inside_optin7'])."|".trim($_POST['Inside_optin8'])."|".trim($_POST['Inside_optin9']);
    $Inside_optin = str_replace(array("\r\n", "\r", "\n"), '<br>', $Inside_optin);
	
	//background upload
	$Inside_bgfile = $_FILES['Inside_bg']['name'];
	$Inside_bgfileremove = $_POST['Inside_bgremove'];
	if ($Inside_bgfileremove=='on') {$Inside_bgfile='';}
    $Inside_bgpath = GenerationPlugin_uploads.basename($Inside_bgfile);
    if (move_uploaded_file($_FILES['Inside_bg']['tmp_name'], $Inside_bgpath)) {
        $Inside_bgarray = explode('.',$Inside_bgfile);
        $Inside_bgexten = $Inside_bgarray[count($Inside_bgarray)-1];
    	if (isset($_POST['Savepreview_inside'])) {
			$Inside_bgimage = GenerationPlugin_uploads.'Inside_bgimage.'.$Inside_bgexten;
			$Inside_bgimage_db = GenerationPlugin_uploads_db.'Inside_bgimage.'.$Inside_bgexten;
        	rename($Inside_bgpath, $Inside_bgimage);
		}
        $Inside_bgimage_preview = GenerationPlugin_uploads.'Inside_bgimage_preview.'.$Inside_bgexten;
		if ($Inside_bgimage!='') { copy($Inside_bgimage, $Inside_bgimage_preview); }
        rename($Inside_bgpath, $Inside_bgimage_preview);
    } else {
        $Inside_bgimage = $wpdb->get_var('SELECT Bgimage FROM '.$table_name_insider.' WHERE id='.$Duniqueid);
        $Inside_bgimage_preview = $Inside_bgimage_preview_db = $Inside_bgimage_db = $Inside_bgimage;
    }
	if (isset($_POST['Savepreview_inside'])) {
   		if ($Inside_bgfileremove=='on') {$Inside_bgimage=''; $Inside_bgimage_db='';}
	}
	if ($Inside_bgfileremove=='on') {$Inside_bgimage_preview=''; $Inside_bgimage_preview_db='';}

	//custom content image upload
	$Inside_cbgfile = $_FILES['Inside_cbg']['name'];
	$Inside_cbgfileremove = $_POST['Inside_cbgremove'];
	if ($Inside_cbgfileremove=='on') {$Inside_cbgfile='';}
    $Inside_cbgpath = GenerationPlugin_uploads.basename($Inside_cbgfile);
    if (move_uploaded_file($_FILES['Inside_cbg']['tmp_name'], $Inside_cbgpath)) {
        $Inside_cbgarray = explode('.',$Inside_cbgfile);
        $Inside_cbgexten = $Inside_cbgarray[count($Inside_cbgarray)-1];
		if (isset($_POST['Savepreview_inside'])) {
			$Inside_cbgimage = GenerationPlugin_uploads.'Inside_cbgimage.'.$Inside_cbgexten;
			$Inside_cbgimage_db = GenerationPlugin_uploads_db.'Inside_cbgimage.'.$Inside_cbgexten;
        	rename($Inside_cbgpath, $Inside_cbgimage);
		}
        $Inside_cbgimage_preview = GenerationPlugin_uploads.'Inside_cbgimage_preview.'.$Inside_cbgexten;
        $Inside_cbgimage_preview_db = GenerationPlugin_uploads_db.'Inside_cbgimage_preview.'.$Inside_cbgexten;
		if ($Inside_cbgimage!='') { copy($Inside_cbgimage, $Inside_cbgimage_preview); }
        rename($Inside_cbgpath, $Inside_cbgimage_preview);
    } else {
        $Inside_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
    	$Inside_form_tmp = preg_replace("/\\\/","",$Inside_form);
        $Inside_formx = explode("|", $Inside_form_tmp);
    	$Inside_cbgimage = $Inside_formx[5];
        $Inside_cbgimage_preview = $Inside_cbgimage_preview_db = $Inside_cbgimage_db = $Inside_cbgimage;
    }
	if (isset($_POST['Savepreview_inside'])) {
   		if ($Inside_cbgfileremove=='on') {$Inside_cbgimage=''; $Inside_cbgimage_db='';}
	}
	if ($Inside_cbgfileremove=='on') {$Inside_cbgimage_preview=''; $Inside_cbgimage_preview_db='';}
	
	$Inside_form = $_POST['Inside_form']."|".$_POST['Inside_ccontent']."|".$_POST['Inside_clink']."|".$_POST['Inside_cclick1']."|".$_POST['Inside_cblank']."|".$Inside_cbgimage_db."|".$_POST['Inside_cclick2']."|".$_POST['Inside_cwidth']."|".$_POST['Inside_cheight']."|".$_POST['Inside_cscroll'];
	$Inside_form_preview = $_POST['Inside_form']."|".$_POST['Inside_ccontent']."|".$_POST['Inside_clink']."|".$_POST['Inside_cclick1']."|".$_POST['Inside_cblank']."|".$Inside_cbgimage_preview_db."|".$_POST['Inside_cclick2']."|".$_POST['Inside_cwidth']."|".$_POST['Inside_cheight']."|".$_POST['Inside_cscroll'];
	$Inside_startdate = $_POST['Inside_dstart'];
	if ($_POST['Inside_ddays']=="") { $Inside_days = ""; }
	elseif ($Inside_startdate!="") { $Inside_days = date("Y-m-d", strtotime($Inside_startdate." + ".$_POST['Inside_ddays']." days")); }
	else { $Inside_days = date("Y-m-d", strtotime(" + ".$_POST['Inside_ddays']." days")); }
	$Inside_display = implode(',',$_POST['Inside_pagelist']).'|'.implode(',',$_POST['Inside_catlist']).'|'.implode(',',$_POST['Inside_postlist']).'|'.$_POST['Inside_showsub'].'|'.$_POST['Inside_ddelay'].'|'.$Inside_days.'|'.$_POST['Inside_dstart'].'|'.$_POST['Inside_dstop'];

	//replace \n with html br before save to database
	$Inside_head=str_replace(array("\r\n", "\r", "\n"), '<br>', $Inside_head);
	$Inside_spam=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Inside_spam']);
	
	//save to database
	if (isset($_POST['Savepreview_inside'])) {
    $wpdb->update($table_name_insider, 
		array('Theme'=>mysql_real_escape_string(trim($_POST['Inside_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Inside_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Inside_link_blank'])),
    		  'Bgimage'=>mysql_real_escape_string(trim($Inside_bgimage_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Inside_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Inside_head)),
    		  'Form'=>mysql_real_escape_string(trim($Inside_form)),
    		  'Regular'=>mysql_real_escape_string(trim($Inside_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Inside_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Inside_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Inside_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Inside_active'])),
			  'Display'=>mysql_real_escape_string(trim($Inside_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_insider, 
		array('Theme'=>mysql_real_escape_string(trim($_POST['Inside_theme'])),
    		  'Link'=>mysql_real_escape_string(trim($_POST['Inside_link'])),
    		  'Link_blank'=>mysql_real_escape_string(trim($_POST['Inside_link_blank'])),
    		  'Bgimage'=>mysql_real_escape_string(trim($Inside_bgimage_preview_db)),
    		  'Background'=>mysql_real_escape_string(trim($_POST['Inside_bg'])),
    		  'Title'=>mysql_real_escape_string(trim($Inside_head)),
    		  'Form'=>mysql_real_escape_string(trim($Inside_form_preview)),
    		  'Regular'=>mysql_real_escape_string(trim($Inside_regular)),
    		  'Social'=>mysql_real_escape_string(trim($Inside_social)),
    		  'Spam'=>mysql_real_escape_string(trim($Inside_spam)),
    		  'Optincode'=>mysql_real_escape_string(trim($Inside_optin)),
			  'Active'=>mysql_real_escape_string(trim($_POST['Inside_active'])),
			  'Display'=>mysql_real_escape_string(trim($Inside_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DInside_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_theme = preg_replace("/\\\/","",$DInside_theme);
$DInside_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_link = preg_replace("/\\\/","",$DInside_link);
$DInside_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
if ($DInside_link_blank=="_blank") {$DInside_link_blank="checked";}
$DInside_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_bgimage = preg_replace("/\\\/","",$DInside_bgimage);
if ($DInside_bgimage!="") { $DInside_bgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">'; }

if ($DInside_theme=='inside1') {
	$Dinside1_sel='selected'; $Dinside_view='<img id="inside1img" src="'.GenerationPlugin_preview.'/insideD1.gif">';
	$DInside_show1 = 'style="display:block"';
	$DInside_show2 = 'style="display:block"';
	$Inside_bg1_name = 'name="Inside_bg"';
	$Inside_bg2_name = 'name=""';
	$DInside_selectBgs1 = 'style="display:inline"';
	$DInside_selectBgs2 = 'style="display:none"';
}
elseif ($DInside_theme=='inside2') {
	$Dinside2_sel='selected'; $Dinside_view='<img id="inside1img" src="'.GenerationPlugin_preview.'/insideD2.gif">';
	$DInside_show1 = 'style="display:none"';
	$DInside_show2 = 'style="display:none"';
	$Inside_bg1_name = 'name="Inside_bg"';
	$Inside_bg2_name = 'name=""';
	$DInside_selectBgs1 = 'style="display:inline"';
	$DInside_selectBgs2 = 'style="display:none"';
}
elseif ($DInside_theme=='inside11') {
	$Dinside11_sel='selected'; $Dinside_view='<img id="inside1img" src="'.GenerationPlugin_preview.'/insideL1.gif">';
	$DInside_show1 = 'style="display:block"';
	$DInside_show2 = 'style="display:block"';
	$Inside_bg1_name = 'name=""';
	$Inside_bg2_name = 'name="Inside_bg"';
	$DInside_selectBgs1 = 'style="display:none"';
	$DInside_selectBgs2 = 'style="display:inline"';
}
elseif ($DInside_theme=='inside12') {
	$Dinside12_sel='selected'; $Dinside_view='<img id="inside1img" src="'.GenerationPlugin_preview.'/insideL2.gif">';
	$DInside_show1 = 'style="display:none"';
	$DInside_show2 = 'style="display:none"';
	$Inside_bg1_name = 'name=""';
	$Inside_bg2_name = 'name="Inside_bg"';
	$DInside_selectBgs1 = 'style="display:none"';
	$DInside_selectBgs2 = 'style="display:inline"';
}
else {
	$Dinside_view='<img id="inside1img" src="'.GenerationPlugin_preview.'/insideD1.gif">';
	$DInside_show1 = 'style="display:block"';
	$DInside_show2 = 'style="display:block"';
	$Inside_bg1_name = 'name="Inside_bg"';
	$Inside_bg2_name = 'name=""';
	$DInside_selectBgs1 = 'style="display:inline"';
	$DInside_selectBgs2 = 'style="display:none"';
}

$DInside_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_btncolor = preg_replace("/\\\/","",$DInside_btncolor);
$DInside_btncolor = explode("|", $DInside_btncolor);
$DInside_btncolor = $DInside_btncolor[3];
if ($DInside_btncolor=='stripe_darkred') {$DinsideB1_sel='selected';} //stripe design
elseif ($DInside_btncolor=='stripe_red') {$DinsideB2_sel='selected';}
elseif ($DInside_btncolor=='stripe_magenta') {$DinsideB3_sel='selected';}
elseif ($DInside_btncolor=='stripe_violetmagenta') {$DinsideB4_sel='selected';}
elseif ($DInside_btncolor=='stripe_violet') {$DinsideB5_sel='selected';}
elseif ($DInside_btncolor=='stripe_blueviolet') {$DinsideB6_sel='selected';}
elseif ($DInside_btncolor=='stripe_navyblue') {$DinsideB7_sel='selected';}
elseif ($DInside_btncolor=='stripe_darkblue') {$DinsideB8_sel='selected';}
elseif ($DInside_btncolor=='stripe_blue') {$DinsideB9_sel='selected';}
elseif ($DInside_btncolor=='stripe_turquoise') {$DinsideB10_sel='selected';}
elseif ($DInside_btncolor=='stripe_greenturquoise') {$DinsideB11_sel='selected';}
elseif ($DInside_btncolor=='stripe_darkgreen') {$DinsideB12_sel='selected';}
elseif ($DInside_btncolor=='stripe_green') {$DinsideB13_sel='selected';}
elseif ($DInside_btncolor=='stripe_lemon') {$DinsideB14_sel='selected';}
elseif ($DInside_btncolor=='stripe_yellow') {$DinsideB15_sel='selected';}
elseif ($DInside_btncolor=='stripe_orange') {$DinsideB16_sel='selected';}
elseif ($DInside_btncolor=='simple_darkred') {$DinsideB21_sel='selected';} //simple design
elseif ($DInside_btncolor=='simple_red') {$DinsideB22_sel='selected';}
elseif ($DInside_btncolor=='simple_magenta') {$DinsideB23_sel='selected';}
elseif ($DInside_btncolor=='simple_violetmagenta') {$DinsideB24_sel='selected';}
elseif ($DInside_btncolor=='simple_violet') {$DinsideB25_sel='selected';}
elseif ($DInside_btncolor=='simple_blueviolet') {$DinsideB26_sel='selected';}
elseif ($DInside_btncolor=='simple_navyblue') {$DinsideB27_sel='selected';}
elseif ($DInside_btncolor=='simple_darkblue') {$DinsideB28_sel='selected';}
elseif ($DInside_btncolor=='simple_blue') {$DinsideB29_sel='selected';}
elseif ($DInside_btncolor=='simple_turquoise') {$DinsideB30_sel='selected';}
elseif ($DInside_btncolor=='simple_greenturquoise') {$DinsideB31_sel='selected';}
elseif ($DInside_btncolor=='simple_darkgreen') {$DinsideB32_sel='selected';}
elseif ($DInside_btncolor=='simple_green') {$DinsideB33_sel='selected';}
elseif ($DInside_btncolor=='simple_lemon') {$DinsideB34_sel='selected';}
elseif ($DInside_btncolor=='simple_yellow') {$DinsideB35_sel='selected';}
elseif ($DInside_btncolor=='simple_orange') {$DinsideB36_sel='selected';}

$DInside_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_background = preg_replace("/\\\/","",$DInside_background);
if ($DInside_background=='bg2') {$DinsideBackground2_sel='selected';}
elseif ($DInside_background=='bg3') {$DinsideBackground3_sel='selected';}
elseif ($DInside_background=='bg4') {$DinsideBackground4_sel='selected';}
elseif ($DInside_background=='bg12') {$DinsideBackground12_sel='selected';}
elseif ($DInside_background=='bg13') {$DinsideBackground13_sel='selected';}
elseif ($DInside_background=='bg14') {$DinsideBackground14_sel='selected';}

$DInside_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_title_tmp = preg_replace("/\\\/","",$DInside_title_tmp);
    $DInside_title = explode("|", $DInside_title_tmp);
	$DInside_headclr = $DInside_title[0];
	$DInside_headtxt = $DInside_title[1];
	$DInside_headclr_c = $DInside_title[2];
$DInside_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_text = preg_replace("/\\\/","",$DInside_text);
	
$DInside_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_form_tmp = preg_replace("/\\\/","",$DInside_form);
    $DInside_formx = explode("|", $DInside_form_tmp);
	$DInside_form = $DInside_formx[0];
	$DInside_formtype = $DInside_formx[1];
	$DInside_clink = $DInside_formx[2];
	$DInside_cclick1 = $DInside_formx[3];
	$DInside_cblank = $DInside_formx[4];
	if ($DInside_cblank=="_blank") {$DInside_cblank="checked";}
	$DInside_cbgimage = $DInside_formx[5];
	if ($DInside_cbgimage!="") {$DInside_cbgimage_img='<img title="image uploaded" src="'.GenerationPlugin_images.'/imgok.png">';}
	$DInside_cclick2 = $DInside_formx[6];
	$DInside_cwidth = $DInside_formx[7];
	$DInside_cheight = $DInside_formx[8];
	$DInside_cscroll = $DInside_formx[9];
	if ($DInside_cscroll=="scroll") {$DInside_cscroll="checked";}

if ($DInside_form=='regular' || $DInside_form=='') {
	$Dinsidef1_sel='selected'; 
	$Dinsidef1_view='style="display:block"'; $Dinsidef2_view='style="display:block"'; $Dinsidef3_view='style="display:none"';
	$Dinsidef4_view='style="display:none"'; $Dinsidef5_view='style="display:none"';
	$Dinside_buttonss='style="display:block"'; $Dinside_adsection='style="display:block"';
	$Dinsidef1_view_right='style="display:block"';
	$DInside_stheme = 'style="display:inline"'; $DInside_stheme_label = 'style="display:inline"';
	$Dinside_preview1 = 'style="display:block"'; $Dinside_preview2 = 'style="display:none"';
}
elseif ($DInside_form=='social') {
	$Dinsidef2_sel='selected'; 
	$Dinsidef1_view='style="display:none"'; $Dinsidef2_view='style="display:none"'; $Dinsidef3_view='style="display:none"';
	$Dinsidef4_view='style="display:none"'; $Dinsidef5_view='style="display:none"';
	$Dinside_buttonss='style="display:block"'; $Dinside_adsection='style="display:block"';
	$Dinsidef1_view_right='style="display:none"';
	$DInside_stheme = 'style="display:inline"'; $DInside_stheme_label = 'style="display:inline"';
	$Dinside_preview1 = 'style="display:block"'; $Dinside_preview2 = 'style="display:none"';
}
elseif ($DInside_form=='both') {
	$Dinsidef12_sel='selected'; 
	$Dinsidef1_view='style="display:block"'; $Dinsidef2_view='style="display:block"'; $Dinsidef3_view='style="display:none"';
	$Dinsidef4_view='style="display:none"'; $Dinsidef5_view='style="display:none"';
	$Dinside_buttonss='style="display:block"'; $Dinside_adsection='style="display:block"';
	$Dinsidef1_view_right='style="display:block"';
	$DInside_stheme = 'style="display:inline"'; $DInside_stheme_label = 'style="display:inline"';
	$Dinside_preview1 = 'style="display:block"'; $Dinside_preview2 = 'style="display:none"';
}
elseif ($DInside_form=='link') {
	$Dinsidef3_sel='selected'; 
	$Dinsidef1_view='style="display:block"'; $Dinsidef2_view='style="display:none"'; $Dinsidef3_view='style="display:block"';
	$Dinsidef4_view='style="display:none"'; $Dinsidef5_view='style="display:none"';
	$Dinside_buttonss='style="display:block"'; $Dinside_adsection='style="display:block"';
	$Dinsidef1_view_right='style="display:none"';
	$DInside_stheme = 'style="display:inline"'; $DInside_stheme_label = 'style="display:inline"';
	$Dinside_preview1 = 'style="display:block"'; $Dinside_preview2 = 'style="display:none"';
}
elseif ($DInside_form=='custom') {
	$Dinsidef4_sel='selected'; 
	$Dinsidef1_view='style="display:none"'; $Dinsidef2_view='style="display:none"'; $Dinsidef3_view='style="display:block"';
	$Dinsidef4_view='style="display:block"'; $Dinsidef5_view='style="display:block"';
	$Dinside_buttonss='style="display:none"'; $Dinside_adsection='style="display:none"';
	$Dinsidef1_view_right='style="display:none"';
	$DInside_stheme = 'style="display:none"'; $DInside_stheme_label = 'style="display:none"';
	$Dinside_preview1 = 'style="display:none"'; $Dinside_preview2 = 'style="display:block"';
}

if ($DInside_formtype=='link' || $DInside_formtype=='') {
	$Dinsidef10_sel='selected';
	$Dinsidef6_view='style="display:block"'; $Dinsidef7_view='style="display:none"'; $Dinsidef8_view='style="display:block"';
}
elseif ($DInside_formtype=='image') {
	$Dinsidef20_sel='selected';
	$Dinsidef6_view='style="display:none"'; $Dinsidef7_view='style="display:block"'; $Dinsidef8_view='style="display:none"';
}
else {
	$Dinsidef10_sel='selected';
	$Dinsidef6_view='style="display:block"'; $Dinsidef7_view='style="display:none"'; $Dinsidef8_view='style="display:none"';
}

$DInside_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_regular_tmp = preg_replace("/\\\/","",$DInside_regular_tmp);
    $DInside_regular = explode("|", $DInside_regular_tmp);
	$Inside_fname = $DInside_regular[0];
	$Inside_femail = $DInside_regular[1];
	$Inside_fbtntxt = $DInside_regular[2];
	$Inside_fbtnclr = $DInside_regular[3];
	if ($DInside_regular[4]=="1") {$DInside_name_disabled="checked";}
	
$DInside_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_spam = preg_replace("/\\\/","",$DInside_spam);
$DInside_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_optin = preg_replace("/<br>/","\n",$DInside_optin);
	$DInside_optin = preg_replace("/\\\/","",$DInside_optin);
	$DInside_optin = explode("|",$DInside_optin);
	if ($DInside_optin[4]=="on") {$DInside_optinch="checked";}
$DInside_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_insider.' WHERE id='.$Duniqueid);
	if ($DInside_active_tmp=="on") {$DInside_active="checked";} else {$DInside_activated='style="background-color:#FCC"';}

	//replace html br with \n before display in text field
	$DInside_headtxt = preg_replace("/<br>/","\n",$DInside_headtxt);
	$DInside_spam = preg_replace("/<br>/","\n",$DInside_spam);
	
$DInside_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
    $DInside_display = explode("|", $DInside_displays);
	$DInside_dpages = $DInside_display[0];
	$DInside_dcats = $DInside_display[1];
	$DInside_dposts = $DInside_display[2];
	if (strpos($DInside_dpages,'allpages')!==false) {$DInside_dpagesall="checked";}
	if (strpos($DInside_dcats,'allcats')!==false) {$DInside_dcatsall="checked";}
	if (strpos($DInside_dposts,'allposts')!==false) {$DInside_dpostsall="checked";}
	//if ($DInside_dpagesall=="" && $DInside_dcatsall=="" && $DInside_dpostsall=="") {$DInside_dcheckall="";}
	$DInside_showsub = $DInside_display[3];
	if ($DInside_showsub=="on") {$DInside_showsub="checked";}
	$DInside_ddelay = $DInside_display[4];
	$DInside_ddays = $DInside_display[5];
	$DInside_dstart = $DInside_display[6];
	$DInside_dstop = $DInside_display[7];
?>

<script type="text/javascript">
function sh6_theme(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='1') {
        document.getElementById("Inside_show1").style.display="block";
        document.getElementById("Inside_show2").style.display="block";
        document.getElementById("Inside_selectBgs1").name="Inside_bg";
        document.getElementById("Inside_selectBgs2").name="";
        document.getElementById("Inside_selectBgs1").style.display="inline";
        document.getElementById("Inside_selectBgs2").style.display="none";
		$jj('#inside1').html('<img id="inside1img" src="<?php echo GenerationPlugin_preview.'/insideD1.gif'; ?>">'); 
	} else if(sel.selectedIndex=='2' || sel.selectedIndex=='3') {
        document.getElementById("Inside_show1").style.display="none";
        document.getElementById("Inside_show2").style.display="none";
        document.getElementById("Inside_selectBgs1").name="Inside_bg";
        document.getElementById("Inside_selectBgs2").name="";
        document.getElementById("Inside_selectBgs1").style.display="inline";
        document.getElementById("Inside_selectBgs2").style.display="none";
		$jj('#inside1').html('<img id="inside1img" src="<?php echo GenerationPlugin_preview.'/insideD2.gif'; ?>">'); 
	} else if(sel.selectedIndex=='4' || sel.selectedIndex=='5') {
        document.getElementById("Inside_show1").style.display="block";
        document.getElementById("Inside_show2").style.display="block";
        document.getElementById("Inside_selectBgs1").name="";
        document.getElementById("Inside_selectBgs2").name="Inside_bg";
        document.getElementById("Inside_selectBgs1").style.display="none";
        document.getElementById("Inside_selectBgs2").style.display="inline";
		$jj('#inside1').html('<img id="inside1img" src="<?php echo GenerationPlugin_preview.'/insideL1.gif'; ?>">'); 
	} else if(sel.selectedIndex=='6') {
        document.getElementById("Inside_show1").style.display="none";
        document.getElementById("Inside_show2").style.display="none";
        document.getElementById("Inside_selectBgs1").name="";
        document.getElementById("Inside_selectBgs2").name="Inside_bg";
        document.getElementById("Inside_selectBgs1").style.display="none";
        document.getElementById("Inside_selectBgs2").style.display="inline";
		$jj('#inside1').html('<img id="inside1img" src="<?php echo GenerationPlugin_preview.'/insideL2.gif'; ?>">'); 
	}
}
$jj(document).ready(function(){
	$jj("#Inside_name").charCount({allowed:20, warning:0, /*counterText:'left: '*/});
	$jj("#Inside_email").charCount({allowed:20, warning:0, /*counterText:'left: '*/});
	$jj("#Inside_btntxt").charCount({allowed:14, warning:0, /*counterText:'left: '*/});
	$jj("#Inside_headtxt").charCount({allowed:40, warning:0, /*counterText:'left: '*/});
	$jj("#Inside_spam").charCount({allowed:120, warning:0, /*counterText:'left: '*/});
});
</script>

        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DInside_activated; ?>>
				<input name="Inside_active" type="checkbox" <?php echo $DInside_active; ?>> Activate Inside Optin
			</div>
            <select name="Inside_theme" id="selectinside" onchange="sh6_theme(this)" <?php echo $DInside_stheme; ?>>
				<option value="inside1" style="color:#069; font-weight:bold">Graphite themes</option>
                <option value="inside1" <?php echo $Dinside1_sel; ?>>standard</option>
                <option value="inside2" <?php echo $Dinside2_sel; ?>>mini</option>
				<option value="inside2">&nbsp;</option>
				<option value="inside11" style="color:#069; font-weight:bold">Silver themes</option>
                <option value="inside11" <?php echo $Dinside11_sel; ?>>standard</option>
                <option value="inside12" <?php echo $Dinside12_sel; ?>>mini</option>
            </select> <span id="selectinside_label" <?php echo $DInside_stheme_label; ?>>Template</span>
			<select name="Inside_form" onchange="sh6(this)">
				<option value="regular" <?php echo $Dinsidef1_sel; ?>>regular</option>
				<option value="social" <?php echo $Dinsidef2_sel; ?>>facebook</option>
				<option value="both" <?php echo $Dinsidef12_sel; ?>>regular and facebook switch</option>
				<option value="link" <?php echo $Dinsidef3_sel; ?>>link</option>
				<option value="custom" <?php echo $Dinsidef4_sel; ?>>custom content</option>
			</select> Type of sign-up form
			<div id="xchoice61" <?php echo $Dinsidef5_view; ?>>
    			<select name="Inside_ccontent" onchange="sh60(this)">
    				<option value="link" <?php echo $Dinsidef10_sel; ?>>webpage</option>
    				<option value="image" <?php echo $Dinsidef20_sel; ?>>image</option>
    			</select> Type of custom content
			</div>
			
			<div id="ichoice62" <?php echo $Dinsidef4_view; ?>>
				<div id="ichoice65" <?php echo $Dinsidef8_view; ?>>
    				<input name="Inside_cwidth" type="text" value="<?php echo $DInside_cwidth; ?>"> Box width in pixels
            		<br/>
    				<input name="Inside_cheight" type="text" value="<?php echo $DInside_cheight; ?>"> Box height in pixels
    				<input style="display:none" name="Inside_cscroll" type="checkbox" value="scroll" <?php echo $DInside_cscroll; ?>>
				</div>
				<div id="ichoice63" <?php echo $Dinsidef6_view; ?>>
					<input name="Inside_clink" type="text" value="<?php echo $DInside_clink; ?>">
					<img id="helpbtn_inside8" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        			<span class="maxfile" id="helptip_inside8">URLs starting with 'https://' will not open in box due to security reasons.</span> Link to webpage
				</div>
				<div id="ichoice64" <?php echo $Dinsidef7_view; ?>>
					<input name="Inside_cbg" type="file" size="26">
        			<?php if (filesize($DInside_cbgimage)>=1048576) { ?>
        				<img id="helpbtn_inside9" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
        				<span class="maxfilewarning" id="helptip_inside9">Max 1Mb!</span>
        			<?php } else { ?>
        				<img id="helpbtn_inside9" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
        				<span class="maxfile" id="helptip_inside9">Max 1Mb</span>
        			<?php } ?>
        			<?php echo $DInside_cbgimage_img; ?>
					<span style="display:inline; margin-bottom:100px">Upload an image...</span>
        			<br/>
        			<input name="Inside_cbgremove" type="checkbox"> Remove uploaded image
					<br/>
    				<input name="Inside_cclick1" type="text" value="<?php echo $DInside_cclick1; ?>"> ...or use external image
					<br/>
    				<input name="Inside_cclick2" type="text" value="<?php echo $DInside_cclick2; ?>"> Link for <i>click</i> action
					<br/>
					<input name="Inside_cblank" type="checkbox" value="_blank" <?php echo $DInside_cblank; ?>> Open the link in new tab
				</div>
			</div>
			
            <div id="choice60" name="choice61" <?php echo $Dinsidef1_view; ?>>
				<div id="ichoice60" <?php echo $Dinsidef2_view; ?>>
    				<input id="Inside_name" name="Inside_name" type="text" value="<?php echo $Inside_fname; ?>"> 'Name' default value
					<br/>
					<input name="Inside_name_disabled" type="checkbox" value="1" <?php echo $DInside_name_disabled; ?>> Do not show 'Name' field in form
                    <br/>
                    <input id="Inside_email" name="Inside_email" type="text" value="<?php echo $Inside_femail; ?>"> 'Email' default value
                    <br/>
				</div>
				<div id="ichoice61" <?php echo $Dinsidef3_view; ?>>	
					<input name="Inside_link" type="text" value="<?php echo $DInside_link; ?>"> Destin. page
					<br/>
					<input name="Inside_link_blank" type="checkbox" value="_blank" <?php echo $DInsider_link_blank; ?>> Open the page in new tab
					<br/>
				</div>
				
				<div id="Inside_buttonss" <?php echo $Dinside_buttonss; ?>>
                <input id="Inside_btntxt" name="Inside_btntxt" type="text" value="<?php echo $Inside_fbtntxt; ?>"> Button text
                <br/>
				<select name="Inside_btnclr" id="selectButtons">
					<option style="margin-left:-136px; color:#069; font-weight:bold">Stripe design</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark.gif'; ?>)" 
						value="stripe_darkred" <?php echo $DinsideB1_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red.gif'; ?>)" 
						value="stripe_red" <?php echo $DinsideB2_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta.gif'; ?>)" 
						value="stripe_magenta" <?php echo $DinsideB3_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta.gif'; ?>)" 
						value="stripe_violetmagenta" <?php echo $DinsideB4_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet.gif'; ?>)" 
						value="stripe_violet" <?php echo $DinsideB5_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet.gif'; ?>)" 
						value="stripe_blueviolet" <?php echo $DinsideB6_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy.gif'; ?>)" 
						value="stripe_navyblue" <?php echo $DinsideB7_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark.gif'; ?>)" 
						value="stripe_darkblue" <?php echo $DinsideB8_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue.gif'; ?>)" 
						value="stripe_blue" <?php echo $DinsideB9_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise.gif'; ?>)" 
						value="stripe_turquoise" <?php echo $DinsideB10_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise.gif'; ?>)" 
						value="stripe_greenturquoise" <?php echo $DinsideB11_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark.gif'; ?>)" 
						value="stripe_darkgreen" <?php echo $DinsideB12_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green.gif'; ?>)" 
						value="stripe_green" <?php echo $DinsideB13_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon.gif'; ?>)" 
						value="stripe_lemon" <?php echo $DinsideB14_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow.gif'; ?>)" 
						value="stripe_yellow" <?php echo $DinsideB15_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange.gif'; ?>)" 
						value="stripe_orange" <?php echo $DinsideB16_sel; ?>>orange</option>
					<option>&nbsp;</option>
					<option style="margin-left:-136px; color:#069; font-weight:bold">Simple design</option>
					<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/reddark2.gif'; ?>)" 
						value="simple_darkred" <?php echo $DinsideB21_sel; ?>>dark red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/red2.gif'; ?>)" 
						value="simple_red" <?php echo $DinsideB22_sel; ?>>red</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/magenta2.gif'; ?>)" 
						value="simple_magenta" <?php echo $DinsideB23_sel; ?>>magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violetmagenta2.gif'; ?>)" 
						value="simple_violetmagenta" <?php echo $DinsideB24_sel; ?>>violet magenta</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/violet2.gif'; ?>)" 
                        value="simple_violet" <?php echo $DinsideB25_sel; ?>>violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blueviolet2.gif'; ?>)" 
  						value="simple_blueviolet" <?php echo $DinsideB26_sel; ?>>blue violet</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluenavy2.gif'; ?>)" 
						value="simple_navyblue" <?php echo $DinsideB27_sel; ?>>navy blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/bluedark2.gif'; ?>)" 
						value="simple_darkblue" <?php echo $DinsideB28_sel; ?>>dark blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/blue2.gif'; ?>)" 
						value="simple_blue" <?php echo $DinsideB29_sel; ?>>blue</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/turquoise2.gif'; ?>)" 
						value="simple_turquoise" <?php echo $DinsideB30_sel; ?>>turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greenturquoise2.gif'; ?>)" 
						value="simple_greenturquoise" <?php echo $DinsideB31_sel; ?>>green turquoise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/greendark2.gif'; ?>)" 
						value="simple_darkgreen" <?php echo $DinsideB32_sel; ?>>dark green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/green2.gif'; ?>)" 
						value="simple_green" <?php echo $DinsideB33_sel; ?>>green</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/lemon2.gif'; ?>)" 
						value="simple_lemon" <?php echo $DinsideB34_sel; ?>>lemon</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/yellow2.gif'; ?>)" 
						value="simple_yellow" <?php echo $DinsideB35_sel; ?>>yellow</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images_online.'/buttons/orange2.gif'; ?>)" 
						value="simple_orange" <?php echo $DinsideB36_sel; ?>>orange</option>
				</select> Button color
				</div>
			</div>
			
			<div id="Inside_adsection" <?php echo $Dinside_adsection; ?>>

			<input name="Inside_headclr" type="text" id="colorinside" value="<?php echo $DInside_headclr; ?>" />
			<div style="margin:0 0 -25px 235px">
				<input style="position:absolute; margin:5px 0 0 -21px" name="Inside_headclr_c" type="checkbox" value="on" <?php if ($DInside_headclr_c=="on") {echo "checked";} ?> />
				<img id="helpbtn_inside5" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="headclrhelp" id="helptip_inside5">Pick your color and check the checkbox to setup headers color different than button color.</span>
				Custom headers color
			</div>
            <br/>
			<div id="Inside_show1" <?php echo $DInside_show1; ?>>
				<textarea id="Inside_headtxt" name="Inside_headtxt"><?php echo $DInside_headtxt; ?></textarea>
				<img id="helpbtn_inside6" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="countdownhelp" id="helptip_inside6">Use number in brackets (max '90') to add countdown timer. Number in brackets = minutes, e.g.(57).</span>
				Header text
            <br/>
			</div>
			<div id="Inside_show2" <?php echo $DInside_show2; ?>>
            	<textarea class="m8px" id="Inside_spam" name="Inside_spam"><?php echo $DInside_spam; ?></textarea> Anti-spam note
            <br/>
			</div>
			<select <?php echo $Inside_bg1_name; ?> id="Inside_selectBgs1" <?php echo $DInside_selectBgs1; ?>>
					<option style="margin-left:-136px">Dark backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_noise.gif'; ?>)" 
						value="bg2" <?php echo $DinsideBackground2_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_carbonfiber.gif'; ?>)" 
						value="bg3" <?php echo $DinsideBackground3_sel; ?>>carbon fiber</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/d_wood.gif'; ?>)" 
						value="bg4" <?php echo $DinsideBackground4_sel; ?>>wood</option>
			</select>	
			<select <?php echo $Inside_bg2_name; ?> id="Inside_selectBgs2" <?php echo $DInside_selectBgs2; ?>>
					<option style="margin-left:-136px">Light backgrounds</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_noise.gif'; ?>)" 
						value="bg12" <?php echo $DinsideBackground12_sel; ?>>noise</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_sparkles.gif'; ?>)" 
						value="bg13" <?php echo $DinsideBackground13_sel; ?>>sparkles</option>
    				<option style="background-image:url(<?php echo GenerationPlugin_images.'/backgrounds/l_blur.gif'; ?>)" 
						value="bg14" <?php echo $DinsideBackground14_sel; ?>>blur</option>
			</select> <span style="display:inline">Product background</span>
			<br/>
            <input name="Inside_bg" type="file" size="26">
			<?php if (filesize($DInside_bgimage)>=307201) { ?>
				<img id="helpbtn_inside3" src="<?php echo GenerationPlugin_images.'/warning.png'; ?>">
				<span class="maxfilewarning" id="helptip_inside3">Max 300kb!</span>
			<?php } else { ?>
				<img id="helpbtn_inside3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span class="maxfile" id="helptip_inside3">Max 300kb</span>
			<?php } ?>
			<?php echo $DInside_bgimage_img; ?>
			<br/>
			<input name="Inside_bgremove" type="checkbox"> Remove uploaded background
        </div>
		
        </div>
            
        <div class="right_section" id="inside_checkboxes">
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_inside1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_inside1">Click here to show options. Use shortcode [gpinpost] to display.</span>
			</h4>
            <div class="toggle">
				<div class="gpadminoptional">
					Displaying settings are optional for this tool. Read instruction for details.
				</div>
				<input style="display:inline-block;" type="checkbox" name="Inside_pagelist[]" value="allpages" <?php echo $DInside_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DInside_dpages_front="front";
				if (strpos(','.$DInside_dpages.',',',front,')!==false || $DInside_displays=="") {$DInside_dpagesch[$DInside_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Inside_pagelist[]" value="front" '.$DInside_dpagesch[$DInside_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DInside_dpages_search="search";
				if (strpos(','.$DInside_dpages.',',',search,')!==false || $DInside_displays=="") {$DInside_dpagesch[$DInside_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Inside_pagelist[]" value="search" '.$DInside_dpagesch[$DInside_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DInside_dpages_author="author";
				if (strpos(','.$DInside_dpages.',',',author,')!==false || $DInside_displays=="") {$DInside_dpagesch[$DInside_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Inside_pagelist[]" value="author" '.$DInside_dpagesch[$DInside_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order'); 
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DInside_dpages.',',','.trim($pageID).',')!==false || $DInside_displays=="") {$DInside_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Inside_pagelist[]" value="'.$pageID.'" '.$DInside_dpagesch[$pageID].'>';
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
 							if (strpos(','.$DInside_dpages.',',','.trim($childID).',')!==false || $DInside_displays=="") {$DInside_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Inside_pagelist[]" value="'.$childID.'" '.$DInside_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Inside_catlist[]" value="allcats" <?php echo $DInside_dcatsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DInside_dcats.',',','.trim($cat_id).',')!==false || $DInside_displays=="") {$DInside_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Inside_catlist[]" value="'.$cat_id.'" '.$DInside_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Inside_postlist[]" value="allposts" <?php echo $DInside_dpostsall; ?>>
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
							if (strpos(','.$DInside_dposts.',',','.trim($id).',')!==false || $DInside_displays=="") {$DInside_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Inside_postlist[]" value="'.$id.'" '.$DInside_dpostsch[$id].'>&nbsp;';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="Inside_showsub" <?php echo $DInside_showsub; ?>>
					&nbsp;<span style="color:#069">Do NOT show to subscribers</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="inside_checkboxes_switch" <?php echo $DInside_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Inside_dstart" type="text" value="<?php echo $DInside_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Inside_dstop" type="text" value="<?php echo $DInside_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Inside_ddays" type="text" value="<?php echo $DInside_ddays; ?>"> days<br>
				-->
				
            </div>
			
			<h4 id="right_choice60" class="hiddens" <?php echo $Dinsidef1_view_right; ?>>
				Opt-in settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_inside7" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_inside7">Click here to show options.</span>
			</h4>
            <div id="Inside_optin" class="toggle" <?php echo $Dinsidef1_view_right; ?>>
					<div class="gpadminoptional" style="margin-bottom:0; width:535px">
						Make sure there is data in 'form action' field. Otherwise change 'form' to 'formc' in your opt-in code.
					</div>
                    <textarea name="Inside_optin1" id="gpoptinform_inside"><?php echo str_replace(":::","|",$DInside_optin[0]); ?></textarea> Opt-in code<br/>
                    <div id="gpformarea_inside" style="display:none"></div>
                    <input type="button" value="Process" id="gpproccessit_inside"><br/>
					<textarea style="margin:3px 0" name="Inside_optin5" id="gpformaction_inside"><?php echo $DInside_optin[4]; ?></textarea> form action<br/>
                    <select name="Inside_optin2" id="gpnamefield_inside">
    					<option value="<?php echo $DInside_optin[1]; ?>"><?php echo $DInside_optin[1]; ?></option>
    				</select> 'NAME' field<br/>
                    <select name="Inside_optin3" id="gpemailfield_inside">
    					<option value="<?php echo $DInside_optin[2]; ?>"><?php echo $DInside_optin[2]; ?></option>
    				</select> 'EMAIL' field<br/>
                    <!-- <input name="Inside_optin4" value="on" type="checkbox" id="gpdisablename_inside" <?php echo $DInside_optinch; ?>> disable NAME field<br/> -->
                    <input type="checkbox" id="gpshowalldata_inside"> show all processed data<br/>
                    <div id="gpalldata_inside" style="display:none">
                        <textarea name="Inside_optin6" id="gphiddenfields_inside"><?php echo $DInside_optin[5]; ?></textarea> hidden fields<br/>
                        <textarea name="Inside_optin7" id="gpignoredfields_inside"><?php echo $DInside_optin[6]; ?></textarea> ignored fields<br/>
                        <textarea name="Inside_optin8" id="gpotherfields_inside"><?php echo $DInside_optin[7]; ?></textarea> other fields<br/>
                        <textarea name="Inside_optin9" id="gpsubmitbutton_inside"><?php echo $DInside_optin[8]; ?></textarea> submit button<br/>
                    </div><br/>
			</div>
			
			<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_inside2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_inside2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="inside1" class="preview6" <?php echo $Dinside_preview1; ?>><?php echo $Dinside_view; ?></div>
			<div id="inside2" class="preview6" <?php echo $Dinside_preview2; ?>><img src="<?php echo GenerationPlugin_preview.'/insideCC.gif'; ?>"></div>
        </div>

		
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_inside" type="hidden" value="Save Changes">
    		<input id="Savepreview_inside" name="Savepreview_inside" type="hidden" value="Savepreview_inside">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_inside').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div>  
