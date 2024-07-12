<?php
global $wpdb;
$table_name_footer = $wpdb->prefix . 'GenerationPlugin_FOOTER';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }


if ($_COOKIE["gpds_footer"]!="1") { //START IF 'DONT SHOW' IS NOT ACTIVE


$DFooter_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
$DFooter_display = explode("|", $DFooter_displays);
$DFooter_showsub = $DFooter_display[3];
if ($DFooter_showsub=="on" && $_COOKIE["gpsubscribed_footer"]=="subscribed") { /* STOP HERE */ } 
else { //START IF 'SUBSCRIBED' IS NOT ACTIVE


$DFooter_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_footer.' WHERE id='.$Duniqueid);
if ($DFooter_active_tmp=="on") { //START IF ACTIVATED


$DFooter_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_display = preg_replace("/\\\/","",$DFooter_display);
$DFooter_display = explode("|", $DFooter_display);
if ($DFooter_display[6]=='' || ($DFooter_display[6]!="" && strtotime($DFooter_display[6]) <= strtotime(date("Y-m-d")))) {
	$DFooter_ddays_1="1";
} else {$DFooter_ddays_1="0";}
if ($DFooter_display[7]=='' || ($DFooter_display[7]!="" && strtotime($DFooter_display[7]) > strtotime(date("Y-m-d")))) {
	$DFooter_ddays_2="1";
} else {$DFooter_ddays_2="0";}
if ($DFooter_ddays_1=="1" && $DFooter_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$dontshowagain = $wpdb->get_var('SELECT Dontshowagain FROM '.$table_name_general.' WHERE id=1');
	$dontshowagain = preg_replace("/\\\/","",$dontshowagain);
	if ($dontshowagain=="") {$dontshowagain = "Don't show again";} //default
$DFooter_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_theme = preg_replace("/\\\/","",$DFooter_theme);
if ($DFooter_theme=="") {$DFooter_theme = "footer1";} //default
$DFooter_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_link = preg_replace("/\\\/","",$DFooter_link);
if ($DFooter_link=="") {$DFooter_link = "#";}
$DFooter_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
if ($DFooter_link_blank!="") {$Footer_link_blank = 'target="_blank"';} else {$Footer_link_blank = 'target="_parent"';}

$DFooter_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_image = preg_replace("/\\\/","",$DFooter_image);
if ($DFooter_image=="") {$DFooter_image = GenerationPlugin_images.'/boxes/book-2.png';} //default
else { $DFooter_image = $DFooter_image;}
$DFooter_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_bgimage = preg_replace("/\\\/","",$DFooter_bgimage);

$DFooter_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_btncolor = preg_replace("/\\\/","",$DFooter_btncolor);
$DFooter_btncolor = explode("|", $DFooter_btncolor);
$DFooter_btncolor = $DFooter_btncolor[3];
if ($DFooter_btncolor=="" || $DFooter_btncolor=="Stripe design") {$DFooter_btncolor = "stripe_red";}
if ($DFooter_btncolor=="Simple design") {$DFooter_btncolor = "simple_red";}

$DFooter_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_form_tmp = preg_replace("/\\\/","",$DFooter_form);
    $DFooter_formx = explode("|", $DFooter_form_tmp);
	$DFooter_form = $DFooter_formx[0];
	$DFooter_bookmarkclr = $DFooter_formx[11];
	
$DFooter_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_background = preg_replace("/\\\/","",$DFooter_background);
if (($DFooter_form!='custom') && ($DFooter_theme=='footer1' || $DFooter_theme=='footer2')) {
	$DFooter_bgcolor = '#222';
    if ($DFooter_bgimage!="") {$DFooter_bgimage = $DFooter_bgimage;}
    elseif ($DFooter_background=='bg2') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DFooter_background=='bg3') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DFooter_background=='bg4') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} elseif ($DFooter_form=='custom' && $DFooter_bookmarkclr=='dark') {
	$DFooter_bgcolor = '#222';
    if ($DFooter_background=='bg2') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DFooter_background=='bg3') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DFooter_background=='bg4') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} elseif ($DFooter_form=='custom' && $DFooter_bookmarkclr=='light') {
	$DFooter_bgcolor = '#CCC';
    if ($DFooter_background=='bg12') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DFooter_background=='bg13') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DFooter_background=='bg14') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
} else {
	$DFooter_bgcolor = '#CCC';
    if ($DFooter_bgimage!="") {$DFooter_bgimage = $DFooter_bgimage;}
    elseif ($DFooter_background=='bg12') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DFooter_background=='bg13') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DFooter_background=='bg14') {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DFooter_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
}

$DFooter_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_title_tmp = preg_replace("/\\\/","",$DFooter_title_tmp);
    $DFooter_title = explode("|", $DFooter_title_tmp);
	$DFooter_headclr = $DFooter_title[0];
	if ($DFooter_headclr=="" || $DFooter_headclr=="#") {$DFooter_headclr = "#CC3300";} //default
	$DFooter_headtxt = $DFooter_title[1];
	if ($DFooter_headtxt=="") {$DFooter_headtxt = "Header Title Goes Here!";} //default
	if (strpos($DFooter_headtxt,"(")!==false) {
		$DFooter_headtxt=explode("(",$DFooter_headtxt);
		$DFooter_headtxtF=$DFooter_headtxt[0]; //front
		$DFooter_headtxt=explode(")",$DFooter_headtxt[1]);
		$DFooter_headtxtT=$DFooter_headtxt[0]; //time
		$DFooter_headtxtE=$DFooter_headtxt[1]; //end
		$DFooter_countdown="on";
	}
    function gpcountdown_footer($atts) {    
    	extract(shortcode_atts(array("time" => "10", "front" => "", "end" => "", "type" => "footer"),$atts));
    	return gpcountdownreturn($time,$front,$end,$type);
    }
    add_shortcode("gpcountdown_footer", "gpcountdown_footer");
$DFooter_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_text = preg_replace("/\\\/","",$DFooter_text);
if ($DFooter_text=="") {$DFooter_text="This is an example of subtitle or description text. Lorem ipsum.";} //default

$DFooter_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_form_tmp = preg_replace("/\\\/","",$DFooter_form);
    $DFooter_formx = explode("|", $DFooter_form_tmp);
	$DFooter_form = $DFooter_formx[0];
	$DFooter_formtype = $DFooter_formx[1];
	$DFooter_clink = $DFooter_formx[2];
	$DFooter_cclick1 = $DFooter_formx[3];
	$DFooter_cblank = $DFooter_formx[4];
	if ($DFooter_cblank=="_blank") {$DFooter_cblank="_blank";} else {$DFooter_cblank="_top";}
	$DFooter_cbgimage = $DFooter_formx[5];
	if ($DFooter_cbgimage!='') {$DFooter_cimage = $DFooter_cbgimage;} else {$DFooter_cimage = $DFooter_cclick1;}
	$DFooter_cclick2 = $DFooter_formx[6];
	$DFooter_cwidth = $DFooter_formx[7];
	if ($DFooter_cwidth=="") {$DFooter_cwidth="760";} //default
	$DFooter_cwidth_i = $DFooter_cwidth - 8;
	$DFooter_cheight = $DFooter_formx[8];
	if ($DFooter_cheight=="") {$DFooter_cheight="360";} //default
	$DFooter_cheight_i = $DFooter_cheight - 8;
	$DFooter_cscroll = $DFooter_formx[9];
	if ($DFooter_cscroll=="scroll") {$DFooter_cscroll="scroll";} else {$DFooter_cscroll="hidden";}
	if ($DFooter_form=="") {$DFooter_form="link";} //default
	$DFooter_cfullw = $DFooter_formx[10];
	$DFooter_bookmarkclr = $DFooter_formx[11];
	
$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
	$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
	$gp_d56 = explode("|", $gp_d56_tmp);
	$gp_d5 = $gp_d56[0];
	$gp_d6 = $gp_d56[1];
	if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
	if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default

if ($DFooter_form=='regular' || $DFooter_form=='') {
	$DFooterf1_view='style="display:inline"'; $DFooterf2_view='style="display:none"'; $DFooterf3_view='style="display:none"'; $DFooter_wider='';
}
elseif ($DFooter_form=='social') {
	$DFooterf1_view='style="display:none"'; $DFooterf2_view='style="display:inline; margin-right:20px!important"'; $DFooterf3_view='style="display:none"'; $DFooter_wider='style="width:1125px; min-width:1125px; max-width:1125px"';
}
elseif ($DFooter_form=='both') {
	$DFooterf1_view='style="display:inline"'; $DFooterf2_view='style="display:none"'; $DFooterf3_view='style="display:none"'; $DFooter_wider='style="width:1125px; min-width:1125px; max-width:1125px"';
}
elseif ($DFooter_form=='link') {
	$DFooterf1_view='style="display:none"'; $DFooterf2_view='style="display:none"'; $DFooterf3_view='style="display:inline"'; $DFooter_wider='style="width:1125px; min-width:1125px; max-width:1125px"';
}

$DFooter_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_regular_tmp = preg_replace("/\\\/","",$DFooter_regular_tmp);
    $DFooter_regular = explode("|", $DFooter_regular_tmp);
	$Footer_fname = $DFooter_regular[0];
	if ($Footer_fname=="") {$Footer_fname="Insert your name";} //default
	$Footer_femail = $DFooter_regular[1];
	if ($Footer_femail=="") {$Footer_femail="Insert your email";} //default
	$Footer_fbtntxt = $DFooter_regular[2];
	if ($Footer_fbtntxt=="") {$Footer_fbtntxt="Subscribe";} //default
	$Footer_fbtnclr = $DFooter_regular[3];
	if ($Footer_fbtnclr=="") {$Footer_fbtnclr="stripe_red";} //default
	if ($DFooter_regular[4]=="1") {$Footer_name_disabled="style='display:none'";}
	
$DFooter_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_spam = preg_replace("/\\\/","",$DFooter_spam);
if ($DFooter_spam=="") {$DFooter_spam="We will not share your details with anyone, we promise!";} //default
$DFooter_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
	$DFooter_optin = preg_replace("/<br>/","\n",$DFooter_optin);
	$DFooter_optin = preg_replace("/\\\/","",$DFooter_optin);
	$DFooter_optin = explode("|",$DFooter_optin);
	$DFooter_optinsubmit = $DFooter_optin[8];
	
$DFooter_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_footer.' WHERE id='.$Duniqueid));
    $DFooter_display = explode("|", $DFooter_display);
	$DFooter_dpages = $DFooter_display[0];
	$DFooter_dcats = $DFooter_display[1];
	$DFooter_dposts = $DFooter_display[2];
	$DFooter_showsub = $DFooter_display[3];
	if ($DFooter_showsub=="on") {$DFooter_showsub="checked";}
	$DFooter_ddelay = $DFooter_display[4];
	if ($DFooter_ddelay<0 || $DFooter_ddelay=="0" || $DFooter_ddelay=="") { $DFooter_ddelay="0"; }
	$DFooter_ddays = (strtotime($DFooter_display[5]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	if ($DFooter_ddays<0 || $DFooter_ddays=="0") { $DFooter_ddays="0"; }
?>

<?php
//DISPLAYING

//prepare page list in array
$DFooter_dpages_explode=explode(",",$DFooter_dpages);
foreach ($DFooter_dpages_explode as $DFooter_dpages_explode_element) { $DFooter_dpages_array[]=$DFooter_dpages_explode_element; }
//prepare category list in array
$DFooter_dcats_explode=explode(",",$DFooter_dcats);
foreach ($DFooter_dcats_explode as $DFooter_dcats_explode_element) { $DFooter_dcats_array[]=$DFooter_dcats_explode_element; }
//prepare posts list in array
$DFooter_dposts_explode=explode(",",$DFooter_dposts);
foreach ($DFooter_dposts_explode as $DFooter_dposts_explode_element) { $DFooter_dposts_array[]=$DFooter_dposts_explode_element; }

if (((strpos($DFooter_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DFooter_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DFooter_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DFooter_dpages.',',',author,')!==false) || //author page
	 (is_page($DFooter_dpages_array)))) || //pages and subpages
   ((strpos($DFooter_dcats,'allcats')!==false) &&
	 (is_category($DFooter_dcats_array))) || //category pages
   ((strpos($DFooter_dposts,'allposts')!==false) &&
	 (is_single($DFooter_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>

		<script type="text/javascript">
     	var $jj = jQuery.noConflict();
     	function isValidUserCHECK_footer() {
     		var user_footer = $jj("#gpuserinput_footer").val();
     		var email_footer = $jj("#gpemailinput_footer").val();
     		if(user_footer != 0) {
     			if(isValidUser_footer(user_footer)) {
     				$jj("#gpuserinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
     				if(isValidEmailAddress_footer(email_footer)) {
     					document.getElementById('verified_footer').type="submit";
     				}
     			} else {
     				$jj("#gpuserinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('verified_footer').type="button";
     			}
     		} else {
     			$jj("#gpuserinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('verified_footer').type="button";
     		}
     	}
     	function isValidEmailCHECK_footer() {
     		var user_footer = $jj("#gpuserinput_footer").val();
     		var email_footer = $jj("#gpemailinput_footer").val();
     		if(email_footer != 0) {
     			if(isValidEmailAddress_footer(email_footer)) {
     				$jj("#gpemailinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
     				if(isValidUser_footer(user_footer)) {
     					document.getElementById('verified_footer').type="submit";
     				}
     			} else {
     				$jj("#gpemailinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('verified_footer').type="button";
     			}
     		} else {
     			$jj("#gpemailinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('verified_footer').type="button";
     		}
     	}
     	function isValidUser_footer(user_footer) {
      		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
      		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
      		return patternone.test(user_footer);
     	}
     	function isValidEmailAddress_footer(email_footer) {
      		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
      		return pattern.test(email_footer);
     	}
     	</script>
		<?php
		if ($DLivecheck=='on') { 
			?>
			<script type="text/javascript">
         	var $jj = jQuery.noConflict();
     		$jj(document).ready(function(){
          		var user_footer = $jj("#gpuserinput_footer").val();
          		var email_footer = $jj("#gpemailinput_footer").val();
         		if(isValidUser_footer(user_footer) && isValidEmailAddress_footer(email_footer)) {
     				$jj("#gpuserinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
     				$jj("#gpemailinput_footer").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
     				document.getElementById('verified_footer').type="submit";
     			}
     		});
			</script>
			<?php
        	$gpnameinput_footer='onkeyup="isValidUserCHECK_footer();" onblur="isValidUserCHECK_footer();" onclick="isValidUserCHECK_footer();" onfocus="isValidUserCHECK_footer();"';
        	$gpemailinput_footer='onkeyup="isValidEmailCHECK_footer();" onblur="isValidEmailCHECK_footer();" onclick="isValidEmailCHECK_footer();" onfocus="isValidEmailCHECK_footer();"';
        	$gpformbtn_footer='button';
        } else {
        	$gpnameinput_footer='';
        	$gpemailinput_footer='';
        	$gpformbtn_footer='submit';
        }
		if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
			$gpmydatapopupcookie = explode("|",$_COOKIE['gpmydetails']);
			$Footer_fname = $gpmydatapopupcookie[0];
			$Footer_femail = $gpmydatapopupcookie[1];
		}
		?>
		
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
        $jj(document).ready(function(){
			//default values in form
			$jj('input[type=text]').each(function(){ $jj(this).data('default', this.value); });
			$jj('input[type=text]').focusin(function(){ if (this.value==$jj(this).data('default')) {this.value='';} });
			$jj('input[type=text]').focusout(function(){ if (this.value=='') {this.value=$jj(this).data('default');} });
			setTimeout(function(){
            	$jj("#GP_footer_delay").css({ 'position': 'fixed', 'z-index': '99999' }).fadeIn(800);
            	$jj("#GP_footer-container .GP_close").click(function(){
            		$jj(this).parents("#GP_footer-container").animate({ opacity: 'hide' }, 800);
            	});
			},<?php echo $DFooter_ddelay;?>*1000);
        });
		//Don't show again checkbox
		$jj(document).ready(function(){ 
        	$jj("#gpds_footer").change(function() {
        		if($jj(this).is(":checked")) { $jj.cookie("gpds_footer", "1", {expires: 7, path: '/'}); }
				else { $jj.cookie("gpds_footer", "0", {expires: 7, path: '/'}); }
        	});
        });
		//Form switch
		$jj(document).ready( function(){ 
        	$jj(".GP_s_en_footer").click(function(){
        		var parent = $jj(this).parents('.GP_s_footer');
        		$jj('.GP_s_di_footer',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Footer_s_show2').fadeOut(500);
        		$jj('#Footer_s_show1').delay(505).fadeIn(500);
        	});
        	$jj(".GP_s_di_footer").click(function(){
        		var parent = $jj(this).parents('.GP_s_footer');
        		$jj('.GP_s_en_footer',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Footer_s_show1').fadeOut(500);
        		$jj('#Footer_s_show2').delay(505).fadeIn(500);
        	});
			var switchwidth1 = $jj('.GP_s_en_footer').width();
			var switchwidth2 = $jj('.GP_s_di_footer').width();
			var switchwidth = switchwidth1+switchwidth2;
			$jj('.GP_s_footer').css({'width': ''+switchwidth+''});
        });
        </script>
		<div style="position:fixed; top:-9999; visibility:hidden" class="GP_s_footer">
            <label class="GP_s_en_footer"><span><?php echo $gp_d5; ?></span></label>
            <label class="GP_s_di_footer"><span><?php echo $gp_d6; ?></span></label>
        </div>
		
		<style>
		#GP_footer_delay {
		  display:none;
		}
		.Generation_plug.GP_footer h2 strong span {
		  color:<?php echo $DFooter_headclr; ?>;
		}
        input[id=gpds_footer] {
          display:none;
        }
        input[id=gpds_footer] + label {
          background: url('<?php echo GenerationPlugin_images."/boxes/unchecked.png"; ?>');
          height: 16px;
          width: 16px;
          display:inline-block;
          padding: 0;
		  margin-bottom: -5px;
        }
        input[id=gpds_footer]:checked + label {
          background: url('<?php echo GenerationPlugin_images."/boxes/checked.png"; ?>');
          height: 16px;
          width: 16px;
          display:inline-block;
          padding: 0;
		  margin-bottom: -5px;
        }
        </style>

		
		<?php
		if ($DFooter_theme=='footer11' || $DFooter_theme=='footer12') {
			wp_enqueue_style('style user_light-4', GenerationPlugin_style.'/style-light-4.css');
		}
		?>
		
		<?php if ($DFooter_form=='custom') { 
			  if ($DFooter_cfullw=="fullw") {$DFooter_cwidth = '100%';} 
			  else {$DFooter_cwidth = $DFooter_cwidth.'px';} ?>
		<div class="Generation_plug GP_footer" id="GP_footer_delay" style="display:none">
        	<div id="GP_footer-container" style="background: <?php echo $DFooter_bgcolor; ?> url('<?php echo $DFooter_bgimage; ?>') repeat center center; width:100%!important; 
				height:<?php echo $DFooter_cheight; ?>px!important"
			>
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:2px 45px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_footer" type="checkbox" name="gpds_footer"><label for="gpds_footer"></label>
			</div>
			<?php if ($DFooter_formtype=='link' || $DFooter_formtype=='') { ?>
                <div class="GP_footer" style="overflow:hidden; margin:0 auto!important; margin-top:0!important; 
					margin-bottom:0!important;
					padding:0!important; padding-top:0!important; padding-right:0!important; 
					padding-bottom:0!important; padding-left:0!important; 
					height:<?php echo $DFooter_cheight; ?>px!important;
					width:<?php echo $DFooter_cwidth; ?>!important"
				>
					<iframe class="GP_pmzero" src="<?php echo $DFooter_clink; ?>" width="100%" style="height:100%; width:100%; overflow-x:hidden; overflow-y:hidden" ></iframe>
				</div>
            <?php } elseif ($DFooter_formtype=='image') { ?>
				<div class="GP_footer" style="overflow:hidden; margin:0 auto!important; margin-top:0!important; 
					margin-bottom:0!important;
					padding:0!important; padding-top:0!important; padding-right:0!important; 
					padding-bottom:0!important; padding-left:0!important; 
					height:<?php echo $DFooter_cheight; ?>px!important;
					width:<?php echo $DFooter_cwidth; ?>!important"
				>
					<a href="<?php echo $DFooter_cclick2; ?>" target="<?php echo $DFooter_cblank; ?>">
						<img style="overflow:hidden"; src="<?php echo $DFooter_cimage; ?>">
					</a>
				</div>
            <?php } ?>
            <a href="#" title="Close" class="GP_icon GP_close GP_right-top">Close</a>
        	</div>
		</div>
		<?php } ?>
		<?php if (($DFooter_theme=='footer1' || $DFooter_theme=='footer11') && $DFooter_form!='custom') { ?>
		<div style="backg" class="Generation_plug GP_footer" id="GP_footer_delay" style="display:none">
        	<div id="GP_footer-container" style="background: <?php echo $DFooter_bgcolor; ?> url('<?php echo $DFooter_bgimage; ?>') repeat center center;">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:2px 45px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_footer" type="checkbox" name="gpds_footer"><label for="gpds_footer"></label>
			</div>
            <div id="GP_footer">
				<img src="<?php echo $DFooter_image; ?>" alt="" class="GP_book" />
                <div class="GP_col-left">
                    <div class="GP_o-hidden">
					
						<?php if ($DFooter_form=='both') { 
							$DFooter_switchmargin = '&nbsp;&nbsp;&nbsp;'; 
							$DFooterf2_view = 'style="display:none!important; margin-right:20px!important"';
							$Dfooterh2_switchdisplay = 'style="display:none!important"'; ?>
    						<div style="display:inline" id="GP_s_footer" class="GP_f_footer GP_s_footer">
                            	<input style="display:none" type="radio" id="GP_s_r1_footer" name="GP_f_footer" checked />
                            	<input style="display:none" type="radio" id="GP_s_r2_footer" name="GP_f_footer" />
                       			<br/>
                            	<label for="GP_s_r1_footer" class="GP_s_en_footer selected"><span><?php echo $gp_d5; ?></span></label>
                            	<label for="GP_s_r2_footer" class="GP_s_di_footer"><span><?php echo $gp_d6; ?></span></label>
                            </div>
    					<?php } else {$Dfooterh2_switchdisplay = 'style="display:inline!important"';} ?>
						
                        <h2 <?php echo $Dfooterh2_switchdisplay; ?>><strong style="color:<?php echo $DFooter_headclr; ?>"><?php if ($DFooter_countdown=="on") {do_shortcode("[gpcountdown_footer time=".$DFooter_headtxtT." front='".$DFooter_headtxtF."' end='".$DFooter_headtxtE."']");} else {echo $DFooter_headtxt;} ?></strong></h2>
                        <p class="GP_desc"><?php echo $DFooter_switchmargin; ?>&nbsp;<?php echo $DFooter_text; ?></p>
                    </div>
                    <div class="GP_form-login-inline">
						<div id="Footer_s_show1" <?php echo $DFooterf1_view; ?>>
                        <form id="gpformsubmit_footer" action="<?php echo $DFooter_optin[4]; ?>" method="post">
                            <ul class="GP_f-left">
    							<li style="display:none"><?php echo $DFooter_optin[5]; ?></li>
                                <li <?php echo $Footer_name_disabled; ?>><input id="gpuserinput_footer" <?php echo $gpnameinput_footer; ?> name="<?php echo $DFooter_optin[1]; ?>" type="text" value="<?php echo $Footer_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                <li><input id="gpemailinput_footer" <?php echo $gpemailinput_footer; ?> name="<?php echo $DFooter_optin[2]; ?>" type="text" value="<?php echo $Footer_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
    							<li><?php echo $DFooter_optin[7]; ?></li>
                                <li><input id="verified_footer" name="<?php echo $DFooter_optinsubmit; ?>" type="<?php echo $gpformbtn_footer; ?>" value="<?php echo $Footer_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DFooter_btncolor; ?>" /></li>
                            </ul>
                        </form>
						<input type="hidden" id="gpkeepuserdetails_footer" value="<?php echo $DAutoins; ?>">
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
    					if ($jj("#gpkeepuserdetails_footer").val()=="on") {
                            //save user data to cookies
                            $jj("#gpformsubmit_footer").submit(function(){
                                var gpmydetails = $jj("#gpuserinput_footer").val() + '|' + $jj("#gpemailinput_footer").val();
                                $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            });
    					}
                        //save user data to cookies
                        $jj("#verified_footer").click(function(){
                            $jj.cookie("gpsubscribed_footer", "subscribed", {expires: 7, path: '/'});
                        });
    					</script>
						</div>
    					<div id="Footer_s_show2" class="GP_f-left-fb" <?php echo $DFooterf2_view; ?>>
    						<a id="verifiedfb_footer" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        		<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        	</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedfb_footer").click(function(){
                                $jj.cookie("gpsubscribed_footer", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
    					</div>
  						<div class="GP_linkv" <?php echo $DFooterf3_view; ?>>
            				<a id="verifiedlink_footer" href="<?php echo $DFooter_link; ?>" <?php echo $Footer_link_blank; ?>>
            					<li style="display:inline"><input type="button" value="<?php echo $Footer_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DFooter_btncolor; ?>" /></li>
            					<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
            				</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedlink_footer").click(function(){
                                $jj.cookie("gpsubscribed_footer", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
          				</div>
                        <p style="display:inline" class="GP_icon GP_padlock"><?php echo $DFooter_spam; ?></p>
                    </div>
                </div>
            </div>
            <a href="#" title="Close" class="GP_icon GP_close GP_right-top">Close</a>
        	</div>
		</div>
		<?php } ?>
		<?php if (($DFooter_theme=='footer2' || $DFooter_theme=='footer12') && $DFooter_form!='custom') { ?>
		<div class="Generation_plug GP_footer" id="GP_footer_delay" style="display:none">
        	<div id="GP_footer-container" class="GP_footer-mini" style="background: <?php echo $DFooter_bgcolor; ?> url('<?php echo $DFooter_bgimage; ?>') repeat center center;">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:2px 45px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_footer" type="checkbox" name="gpds_footer"><label for="gpds_footer"></label>
			</div>
            <div id="GP_footer" <?php echo $DFooter_wider; ?>>
				<img src="<?php echo $DFooter_image; ?>" alt="" class="GP_book" style="top:-152px!important" />
                <div class="GP_col-left">
                    <div class="GP_o-hidden GP_f-left" style="width:180px; margin-left:220px">
					
						<?php if ($DFooter_form=='both') { 
							$DFooterf2_view='style="display:none!important; margin-right:20px!important"';
							$DFooter_subtitleh = 'position:absolute; max-height:12px!important'; ?>
    						<div style="margin:-9px 0 33px auto!important; position:relative;" id="GP_s_footer" class="GP_f_footer GP_s_footer">
                            	<input style="display:none" type="radio" id="GP_s_r1_footer" name="GP_f_footer" checked />
                            	<input style="display:none" type="radio" id="GP_s_r2_footer" name="GP_f_footer" />
                       			<br/>
                            	<label for="GP_s_r1_footer" class="GP_s_en_footer selected"><span><?php echo $gp_d5; ?></span></label>
                            	<label for="GP_s_r2_footer" class="GP_s_di_footer"><span><?php echo $gp_d6; ?></span></label>
                            </div>
    					<?php } ?>
						
                        <p class="GP_desc" style="line-height:130%; text-align:right <?php echo $DFooter_subtitleh; ?>">
							&nbsp;<?php echo $DFooter_text; ?>
						</p>
                    </div>
                    <div class="GP_form-login-inline" style="margin-top:4px">
						<div id="Footer_s_show1" <?php echo $DFooterf1_view; ?>>
                        <form id="gpformsubmit_footer" action="<?php echo $DFooter_optin[4]; ?>" method="post">
                            <ul class="GP_f-left">
    							<li style="display:none"><?php echo $DFooter_optin[5]; ?></li>
								<li style="display:none"><input id="gpuserinput_footer" <?php echo $gpnameinput_footer; ?> name="<?php echo $DFooter_optin[1]; ?>" type="text" value="<?php echo 'Subscriber'; /*$Footer_fname;*/ ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                <li><input id="gpemailinput_footer" <?php echo $gpemailinput_footer; ?> name="<?php echo $DFooter_optin[2]; ?>" type="text" value="<?php echo $Footer_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
    							<li><?php echo $DFooter_optin[7]; ?></li>
                                <li><input id="verified_footer" name="<?php echo $DFooter_optinsubmit; ?>" type="<?php echo $gpformbtn_footer; ?>" value="<?php echo $Footer_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DFooter_btncolor; ?>" /></li>
                            </ul>
                        </form>
						<input type="hidden" id="gpkeepuserdetails_footer" value="<?php echo $DAutoins; ?>">
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
    					if ($jj("#gpkeepuserdetails_footer").val()=="on") {
                            //save user data to cookies
                            $jj("#gpformsubmit_footer").submit(function(){
                                var gpmydetails = $jj("#gpuserinput_footer").val() + '|' + $jj("#gpemailinput_footer").val();
                                $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            });
    					}
                        //save user data to cookies
                        $jj("#verified_footer").click(function(){
                            $jj.cookie("gpsubscribed_footer", "subscribed", {expires: 7, path: '/'});
                        });
    					</script>
						</div>
    					<div id="Footer_s_show2" class="GP_f-left-fb" <?php echo $DFooterf2_view; ?>>
    						<a id="verifiedfb_footer" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        		<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        	</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedfb_footer").click(function(){
                                $jj.cookie("gpsubscribed_footer", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
    					</div>
  						<div class="GP_linkv" <?php echo $DFooterf3_view; ?>>
            				<a id="verifiedlink_footer" href="<?php echo $DFooter_link; ?>" <?php echo $Footer_link_blank; ?>>
            					<li style="display:inline"><input type="button" value="<?php echo $Footer_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DFooter_btncolor; ?>" /></li>
            					<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
            				</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedlink_footer").click(function(){
                                $jj.cookie("gpsubscribed_footer", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
          				</div>
                        <p style="display:inline" class="GP_icon GP_padlock"><?php echo $DFooter_spam; ?></p>
                    </div>
                </div>
            </div>
            <a href="#" title="Close" class="GP_icon GP_close GP_right-top">Close</a>
        	</div>
		</div>
		<?php } ?>
		
		
<?php 
} //displaying settings
} //STOP IF DAYS OK
} //STOP IF ACTIVATED 
} //START IF 'SUBSCRIBED' IS NOT ACTIVE
} //STOP IF 'DONT SHOW' IS NOT ACTIVE
?>
