<?php
/********** FUNCTION START **********/
function gpregularreturn() {



global $wpdb;
$table_name_regular = $wpdb->prefix . 'GenerationPlugin_REGULAR';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }


$DRegular_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
$DRegular_display = explode("|", $DRegular_displays);
$DRegular_showsub = $DRegular_display[3];
if ($DRegular_showsub=="on" && $_COOKIE["gpsubscribed_regular"]=="subscribed") { /* STOP HERE */ } 
else { //START IF 'SUBSCRIBED' IS NOT ACTIVE


$DRegular_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_regular.' WHERE id='.$Duniqueid);
if ($DRegular_active_tmp=="on") { //START IF ACTIVATED


$DRegular_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
$DRegular_display = explode("|", $DRegular_display);
if ($DRegular_display[6]=='' || ($DRegular_display[6]!="" && strtotime($DRegular_display[6]) <= strtotime(date("Y-m-d")))) {
	$DRegular_ddays_1="1";
} else {$DRegular_ddays_1="0";}
if ($DRegular_display[7]=='' || ($DRegular_display[7]!="" && strtotime($DRegular_display[7]) > strtotime(date("Y-m-d")))) {
	$DRegular_ddays_2="1";
} else {$DRegular_ddays_2="0";}
if ($DRegular_ddays_1=="1" && $DRegular_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$DRegular_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_theme = preg_replace("/\\\/","",$DRegular_theme);
if ($DRegular_theme=="") {$DRegular_theme = "regular1";} //default
$DRegular_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_link = preg_replace("/\\\/","",$DRegular_link);
if ($DRegular_link=="") {$DRegular_link = "#";} //default
$DRegular_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
if ($DRegular_link_blank!="") {$Regular_link_blank = 'target="_blank"';} else {$Regular_link_blank = 'target="_parent"';}

$DRegular_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_image = preg_replace("/\\\/","",$DRegular_image);
if ($DRegular_image=="") {$DRegular_image = GenerationPlugin_images.'/boxes/book-2.png';} //default
else { $DRegular_image = $DRegular_image;}
$DRegular_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_bgimage = preg_replace("/\\\/","",$DRegular_bgimage);

$DRegular_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_btncolor = preg_replace("/\\\/","",$DRegular_btncolor);
$DRegular_btncolor = explode("|", $DRegular_btncolor);
$DRegular_btncolor = $DRegular_btncolor[3];
if ($DRegular_btncolor=="" || $DRegular_btncolor=="Stripe design") {$DRegular_btncolor = "stripe_red";} //default
if ($DRegular_btncolor=="Simple design") {$DRegular_btncolor = "simple_red";}

$DRegular_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_background = preg_replace("/\\\/","",$DRegular_background);
if ($DRegular_theme=='regular1' || $DRegular_theme=='regular2' || $DRegular_theme=='regular3' || $DRegular_theme=='regular4') {
	$DRegular_bgcolor = '#222';
    if ($DRegular_bgimage!="") {$DRegular_bgimage = $DRegular_bgimage;}
    elseif ($DRegular_background=='bg2') {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DRegular_background=='bg3') {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DRegular_background=='bg4') {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} else {
	$DRegular_bgcolor = '#CCC';
    if ($DRegular_bgimage!="") {$DRegular_bgimage = $DRegular_bgimage;}
    elseif ($DRegular_background=='bg12') {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DRegular_background=='bg13') {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DRegular_background=='bg14') {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DRegular_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
}

$DRegular_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_title_tmp = preg_replace("/\\\/","",$DRegular_title_tmp);
    $DRegular_title = explode("|", $DRegular_title_tmp);
	$DRegular_headclr = $DRegular_title[0];
	if ($DRegular_headclr=="" || $DRegular_headclr=="#") {$DRegular_headclr = "#CC3300";} //default
	$DRegular_headtxt = $DRegular_title[1];
	if ($DRegular_headtxt=="") {$DRegular_headtxt = "Header Title<br>Goes Here!";} //default
	if (strpos($DRegular_headtxt,"(")!==false) {
		$DRegular_headtxt=explode("(",$DRegular_headtxt);
		$DRegular_headtxtF=$DRegular_headtxt[0]; //front
		$DRegular_headtxt=explode(")",$DRegular_headtxt[1]);
		$DRegular_headtxtT=$DRegular_headtxt[0]; //time
		$DRegular_headtxtE=$DRegular_headtxt[1]; //end
		$DRegular_countdown="on";
	}
    function gpcountdown_regular($atts) {    
    	extract(shortcode_atts(array("time" => "10", "front" => "", "end" => "", "type" => "regular"),$atts));
    	return gpcountdownreturn($time,$front,$end,$type);
    }
    add_shortcode("gpcountdown_regular", "gpcountdown_regular");
$DRegular_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_text = preg_replace("/\\\/","",$DRegular_text);
if ($DRegular_text=="") {$DRegular_text = "Short Description Of Your Product Goes Here. This Is Just Sample Text. Lorem Ipsum.";} //default
$DRegular_formtitle = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_formtitle = preg_replace("/\\\/","",$DRegular_formtitle);
if ($DRegular_formtitle=="") {$DRegular_formtitle = "Your Details";} //default
$DRegular_formtext = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_formtext = preg_replace("/\\\/","",$DRegular_formtext);
if ($DRegular_formtext=="") {$DRegular_formtext = "This is an example of form text, edit it in admin panel.";} //default

$DRegular_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_form_tmp = preg_replace("/\\\/","",$DRegular_form);
    $DRegular_formx = explode("|", $DRegular_form_tmp);
	$DRegular_form = $DRegular_formx[0];
	$DRegular_formtype = $DRegular_formx[1];
	$DRegular_clink = $DRegular_formx[2];
	$DRegular_cclick1 = $DRegular_formx[3];
	$DRegular_cblank = $DRegular_formx[4];
	if ($DRegular_cblank=="_blank") {$DRegular_cblank="_blank";} else {$DRegular_cblank="_top";}
	$DRegular_cbgimage = $DRegular_formx[5];
	if ($DRegular_cbgimage!='') {$DRegular_cimage = $DRegular_cbgimage;} else {$DRegular_cimage = $DRegular_cclick1;}
	$DRegular_cclick2 = $DRegular_formx[6];
	$DRegular_cwidth = $DRegular_formx[7];
	if ($DRegular_cwidth=="") {$DRegular_cwidth="760";} //default
	$DRegular_cwidth_i = $DRegular_cwidth - 20;
	$DRegular_cheight = $DRegular_formx[8];
	if ($DRegular_cheight=="") {$DRegular_cheight="360";} //default
	$DRegular_cheight_i = $DRegular_cheight - 8;
	$DRegular_cscroll = $DRegular_formx[9];
	if ($DRegular_cscroll=="scroll") {$DRegular_cscroll="scroll";} else {$DRegular_cscroll="hidden";}
	if ($DRegular_form=="") {$DRegular_form="link";} //default
	
$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
	$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
	$gp_d56 = explode("|", $gp_d56_tmp);
	$gp_d5 = $gp_d56[0];
	$gp_d6 = $gp_d56[1];
	if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
	if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default

if ($DRegular_form=='regular' || $DRegular_form=='') {
	$DRegularf1_view='style="display:block"'; $DRegularf2_view='style="display:none"'; $DRegularf3_view='style="display:none"';
}
elseif ($DRegular_form=='social') {
	$DRegularf1_view='style="display:none"'; $DRegularf2_view='style="display:block"'; $DRegularf3_view='style="display:none"';
}
elseif ($DRegular_form=='both') {
	$DRegularf1_view='style="display:block"'; $DRegularf2_view='style="display:none"'; $DRegularf3_view='style="display:none"';
}
elseif ($DRegular_form=='link') {
	$DRegularf1_view='style="display:none"'; $DRegularf2_view='style="display:none"'; $DRegularf3_view='style="display:block"';
}

$DRegular_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_regular_tmp = preg_replace("/\\\/","",$DRegular_regular_tmp);
    $DRegular_regular = explode("|", $DRegular_regular_tmp);
	$Regular_fname = $DRegular_regular[0];
	if ($Regular_fname=="") {$Regular_fname = "Insert your name";} //default
	$Regular_femail = $DRegular_regular[1];
	if ($Regular_femail=="") {$Regular_femail = "Insert your email";} //default
	$Regular_fbtntxt = $DRegular_regular[2];
	if ($Regular_fbtntxt=="") {$Regular_fbtntxt = "SUBSCRIBE";} //default
	if ($DRegular_regular[4]=="1") {$Regular_name_disabled="style='display:none'";}
	
$DRegular_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_spam = preg_replace("/\\\/","",$DRegular_spam);
if ($DRegular_spam=="") {$DRegular_spam = "We will not share your details with anyone, we promise!";} //default
$DRegular_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
	$DRegular_optin = preg_replace("/<br>/","\n",$DRegular_optin);
	$DRegular_optin = preg_replace("/\\\/","",$DRegular_optin);
	$DRegular_optin = explode("|",$DRegular_optin);
	$DRegular_optinsubmit = $DRegular_optin[8];

$DRegular_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_regular.' WHERE id='.$Duniqueid));
    $DRegular_display = explode("|", $DRegular_display);
	$DRegular_dpages = $DRegular_display[0];
	$DRegular_dcats = $DRegular_display[1];
	$DRegular_dposts = $DRegular_display[2];
	$DRegular_showsub = $DRegular_display[3];
	if ($DRegular_showsub=="on") {$DRegular_showsub="checked";}
	$DRegular_ddelay = $DRegular_display[4];
	if ($DRegular_ddelay<0 || $DRegular_ddelay=="0" || $DRegular_ddelay=="") { $DRegular_ddelay="0"; }
	$DRegular_ddays = (strtotime($DRegular_display[5]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	if ($DRegular_ddays<0 || $DRegular_ddays=="0") { $DRegular_ddays="0"; }
?>

<?php
//DISPLAYING

//prepare page list in array
$DRegular_dpages_explode=explode(",",$DRegular_dpages);
foreach ($DRegular_dpages_explode as $DRegular_dpages_explode_element) { $DRegular_dpages_array[]=$DRegular_dpages_explode_element; }
//prepare category list in array
$DRegular_dcats_explode=explode(",",$DRegular_dcats);
foreach ($DRegular_dcats_explode as $DRegular_dcats_explode_element) { $DRegular_dcats_array[]=$DRegular_dcats_explode_element; }
//prepare posts list in array
$DRegular_dposts_explode=explode(",",$DRegular_dposts);
foreach ($DRegular_dposts_explode as $DRegular_dposts_explode_element) { $DRegular_dposts_array[]=$DRegular_dposts_explode_element; }

if (((strpos($DRegular_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DRegular_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DRegular_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DRegular_dpages.',',',author,')!==false) || //author page
	 (is_page($DRegular_dpages_array)))) || //pages and subpages
   ((strpos($DRegular_dcats,'allcats')!==false) &&
	 (is_category($DRegular_dcats_array))) || //category pages
   ((strpos($DRegular_dposts,'allposts')!==false) &&
	 (is_single($DRegular_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>

		
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
        $jj(document).ready(function(){
            var $sidebarheight = null;
            $sidebarheight = $jj("#GP_sidebar").height();
			$jj("#GP_sidebarbox").css({"min-height": $sidebarheight+20});

			<!-- script.js : FORM HELPER -->
        	$jj('input[type="text"], input[type="password"], textarea').each(function() {
        		var default_value = this.value;
        		$jj(this).focus(function() {
        			if (!$jj(this).hasClass('dirty'))
        				this.value = (this.value == default_value)? ''  : this.value;
        			$jj(this).parents('form').addClass('active');
        		});
        		$jj(this).blur(function() {
        			if (!$jj(this).hasClass('dirty'))
        				this.value= (this.value== '') ? default_value   : this.value;
        	 		if ($jj(this).val().length == 0 || !$jj(this).hasClass('dirty'))
        				$jj(this).parents('form').removeClass('active');
        		});
            });
        });
        </script>
		
		<script type="text/javascript">
     	var $jj = jQuery.noConflict();
     	function isValidUserCHECK_regular() {
     		var user_regular = $jj("#gpuserinput_regular").val();
     		var email_regular = $jj("#gpemailinput_regular").val();
     		if(user_regular != 0) {
     			if(isValidUser_regular(user_regular)) {
     				$jj("#gpuserinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
     				if(isValidEmailAddress_regular(email_regular)) {
     					document.getElementById('verified_regular').type="submit";
     				}
     			} else {
     				$jj("#gpuserinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('verified_regular').type="button";
     			}
     		} else {
     			$jj("#gpuserinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('verified_regular').type="button";
     		}
     	}
     	function isValidEmailCHECK_regular() {
     		var user_regular = $jj("#gpuserinput_regular").val();
     		var email_regular = $jj("#gpemailinput_regular").val();
     		if(email_regular != 0) {
     			if(isValidEmailAddress_regular(email_regular)) {
     				$jj("#gpemailinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
     				if(isValidUser_regular(user_regular)) {
     					document.getElementById('verified_regular').type="submit";
     				}
     			} else {
     				$jj("#gpemailinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('verified_regular').type="button";
     			}
     		} else {
     			$jj("#gpemailinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('verified_regular').type="button";
     		}
     	}
     	function isValidUser_regular(user_regular) {
      		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
      		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
      		return patternone.test(user_regular);
     	}
     	function isValidEmailAddress_regular(email_regular) {
      		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
      		return pattern.test(email_regular);
     	}
     	</script>
		<?php
        global $wpdb;
        $table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
        $DAutoins = $wpdb->get_var('SELECT Autoins FROM '.$table_name_general.' WHERE id=1');
        $DLivecheck = $wpdb->get_var('SELECT Livecheck FROM '.$table_name_general.' WHERE id=1');

		if ($DLivecheck=='on') {
			?>
			<script type="text/javascript">
         	var $jj = jQuery.noConflict();
    		$jj(document).ready(function(){
         		var user_regular = $jj("#gpuserinput_regular").val();
         		var email_regular = $jj("#gpemailinput_regular").val();
        		if(isValidUser_regular(user_regular) && isValidEmailAddress_regular(email_regular)) {
    				$jj("#gpuserinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				$jj("#gpemailinput_regular").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				document.getElementById('verified_regular').type="submit";
    			}
    		});
			</script>
			<?php
        	$gpnameinput_regular='onkeyup="isValidUserCHECK_regular();" onblur="isValidUserCHECK_regular();" onclick="isValidUserCHECK_regular();" onfocus="isValidUserCHECK_regular();"';
        	$gpemailinput_regular='onkeyup="isValidEmailCHECK_regular();" onblur="isValidEmailCHECK_regular();" onclick="isValidEmailCHECK_regular();" onfocus="isValidEmailCHECK_regular();"';
        	$gpformbtn_regular='button';
        } else {
        	$gpnameinput_regular='';
        	$gpemailinput_regular='';
        	$gpformbtn_regular='submit';
        }
		if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
			$gpmydatapopupcookie = explode("|",$_COOKIE['gpmydetails']);
			$Regular_fname = $gpmydatapopupcookie[0];
			$Regular_femail = $gpmydatapopupcookie[1];
		}
		?>

		<script type="text/javascript">
		var $jj = jQuery.noConflict();
    	$jj(document).ready(function() {
			//default values in form
			$jj('input[type=text]').each(function(){ $jj(this).data('default', this.value); });
			$jj('input[type=text]').focusin(function(){ if (this.value==$jj(this).data('default')) {this.value='';} });
			$jj('input[type=text]').focusout(function(){ if (this.value=='') {this.value=$jj(this).data('default');} });
		});
		//Form switch
		$jj(document).ready( function(){ 
        	$jj(".GP_s_en_regular").click(function(){
        		var parent = $jj(this).parents('.GP_s_regular');
        		$jj('.GP_s_di_regular',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Regular_s_show2').fadeOut(500);
        		$jj('#Regular_s_show1').delay(505).fadeIn(500);
        	});
        	$jj(".GP_s_di_regular").click(function(){
        		var parent = $jj(this).parents('.GP_s_regular');
        		$jj('.GP_s_en_regular',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Regular_s_show1').fadeOut(500);
        		$jj('#Regular_s_show2').delay(505).fadeIn(500);
        	});
			var switchwidth1 = $jj('.GP_s_en_regular').width();
			var switchwidth2 = $jj('.GP_s_di_regular').width();
			var switchwidth = switchwidth1+switchwidth2;
			$jj('.GP_s_regular').css({'width': ''+switchwidth+''});
        });
		</script>
		<div style="position:fixed; top:-9999; visibility:hidden" class="GP_s_regular">
            <label class="GP_s_en_regular"><span><?php echo $gp_d5; ?></span></label>
            <label class="GP_s_di_regular"><span><?php echo $gp_d6; ?></span></label>
        </div>
		
		<style>
		.Generation_plug.GP_sidebar h2 strong span {
		  color:<?php echo $DRegular_headclr; ?>;
		}
		</style>
		
		<?php
		if ($DRegular_theme=='regular11' || $DRegular_theme=='regular12' || $DRegular_theme=='regular13' || $DRegular_theme=='regular14') {
			wp_enqueue_style('style user_light-5', GenerationPlugin_style.'/style-light-5.css');
		}
		?>

		<?php if ($DRegular_form=='custom') { ?>
		<!-- product -->
		<div class="Generation_plug GP_sidebar" id="GP_sidebarbox">
            <div class="GP_box-sign-up" id="GP_sidebar">
				<?php if ($DRegular_formtype=='link' || $DRegular_formtype=='') { ?>
                <div class="GP_box-container" style="background:#FFF; width:auto!important; 
					height:<?php echo $DRegular_cheight; ?>px!important; overflow:hidden"
				>
					<div class="GP_content" style="overflow:hidden; margin:0!important; margin-top:0!important; 
						margin-right:0!important; margin-bottom:0!important; margin-left:0!important; 
						padding:0!important; padding-top:0!important; padding-right:0!important; 
						padding-bottom:0!important; padding-left:0!important; 
						width:auto!important; height:<?php echo $DRegular_cheight; ?>px!important;"
					>
                        <iframe class="GP_pmzero" src="<?php echo $DRegular_clink; ?>" width="100%" style="height:100%; width:100%; overflow-x:hidden; overflow-y:hidden" ></iframe>
                    </div>
                </div>
				<?php } elseif ($DRegular_formtype=='image') { ?>
				<div class="GP_box-container" style="background:#FFF; width:auto!important; 
					height:auto!important; overflow:hidden"
				>
					<div class="GP_content" style="overflow:hidden; margin:0 auto!important; margin-top:0!important; 
						margin-bottom:0!important;
						padding:0!important; padding-top:0!important; padding-right:0!important; 
						padding-bottom:0!important; padding-left:0!important; 
						width:auto!important; height:auto!important"
					>
                        <a href="<?php echo $DRegular_cclick2; ?>" target="<?php echo $DRegular_cblank; ?>">
							<img style="overflow:hidden; display:block; margin:0 auto"; src="<?php echo $DRegular_cimage; ?>">
						</a>
                    </div>
                </div>
				<?php } ?>
				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png' ?>">
            </div>
		</div>
		<?php } elseif ($DRegular_theme=='regular1' || $DRegular_theme=='regular11') { ?>
		<!-- product -->
		<div class="Generation_plug GP_sidebar" id="GP_sidebarbox">
            <div class="GP_box-sign-up <?php echo 'GP_'.$DRegular_btncolor; ?>" id="GP_sidebar">
                <div class="GP_box-container" style="background: <?php echo $DRegular_bgcolor; ?> url('<?php echo $DRegular_bgimage; ?>') repeat center center;">
                    <div class="GP_content">
                        <h2 style="padding:0 12px 0 12px"><strong style="color:<?php echo '#FFF'; /*$DRegular_headclr;*/ ?>;"><?php if ($DRegular_countdown=="on") {do_shortcode("[gpcountdown_regular time=".$DRegular_headtxtT." front='".$DRegular_headtxtF."' end='".$DRegular_headtxtE."']");} else {echo $DRegular_headtxt;} ?></strong></h2>
						<figure><img src="<?php echo $DRegular_image; ?>" alt="" /></figure>
                        <p class="GP_a-center GP_fs12"><?php echo $DRegular_text; ?></p>
                        <div class="GP_form-login-block">
					
        					<?php if ($DRegular_form=='both') { ?>
        						<div id="GP_s_regular" class="GP_f_regular GP_s_regular">
                                	<input style="display:none" type="radio" id="GP_s_r1_regular" name="GP_f_regular" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_regular" name="GP_f_regular" />
                           			<br/>
                                	<label for="GP_s_r1_regular" class="GP_s_en_regular selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_regular" class="GP_s_di_regular"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
					
							<div id="Regular_s_show1" <?php echo $DRegularf1_view; ?>>
                            <form id="gpformsubmit_regular" action="<?php echo $DRegular_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
        							<li style="display:none"><?php echo $DRegular_optin[5]; ?></li>
                                    <li <?php echo $Regular_name_disabled; ?>><input id="gpuserinput_regular" <?php echo $gpnameinput_regular; ?> name="<?php echo $DRegular_optin[1]; ?>" type="text" value="<?php echo $Regular_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; min-width:100%!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_regular" <?php echo $gpemailinput_regular; ?> name="<?php echo $DRegular_optin[2]; ?>" type="text" value="<?php echo $Regular_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; min-width:100%!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DRegular_optin[7]; ?></li>
                                    <li><input id="verified_regular" name="<?php echo $DRegular_optinsubmit; ?>" type="<?php echo $gpformbtn_regular; ?>" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                </ul>
                            </form>
        					<input type="hidden" id="gpkeepuserdetails_regular" value="<?php echo $DAutoins; ?>">
        					<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
        					if ($jj("#gpkeepuserdetails_regular").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_regular").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_regular").val() + '|' + $jj("#gpemailinput_regular").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
        					}
                            //save user data to cookies
                            $jj("#verified_regular").click(function(){
                                $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                            });
        					</script>
							</div>
        					<div id="Regular_s_show2" class="GP_f-left-fb" <?php echo $DRegularf2_view; ?>>
        						<a id="verifiedfb_regular" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
        					</div>
      						<div <?php echo $DRegularf3_view; ?>>
                				<a id="verifiedlink_regular" class="GP_nodecor" href="<?php echo $DRegular_link; ?>" <?php echo $Regular_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" /></li>
                				</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
              				</div>
							<p class="GP_icon GP_padlock GP_nomarginbottom"><?php echo $DRegular_spam; ?></p>
                        </div>
                    </div>
                </div> 
				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png' ?>">
            </div>
		</div>
		<?php } elseif ($DRegular_theme=='regular2' || $DRegular_theme=='regular12') { ?>
		<!-- standard -->
		<div class="Generation_plug GP_sidebar" id="GP_sidebarbox">
            <div class="GP_box-sign-up <?php echo 'GP_'.$DRegular_btncolor; ?>" id="GP_sidebar">
                <div class="GP_box-container" style="background: <?php echo $DRegular_bgcolor; ?> url('<?php echo $DRegular_bgimage; ?>') repeat center center;">
                    <div class="GP_content">
                        <h2 style="padding:0 12px 0 12px; margin-bottom:-20px!important"><strong style="color:<?php echo '#FFF'; /*$DRegular_headclr;*/ ?>;"><?php if ($DRegular_countdown=="on") {do_shortcode("[gpcountdown_regular time=".$DRegular_headtxtT." front='".$DRegular_headtxtF."' end='".$DRegular_headtxtE."']");} else {echo $DRegular_headtxt;} ?></strong></h2>
                        <p class="GP_a-center GP_fs12"><?php echo $DRegular_text; ?></p>
                        <div class="GP_form-login-block">
					
        					<?php if ($DRegular_form=='both') { ?>
        						<div id="GP_s_regular" class="GP_f_regular GP_s_regular">
                                	<input style="display:none" type="radio" id="GP_s_r1_regular" name="GP_f_regular" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_regular" name="GP_f_regular" />
                           			<br/>
                                	<label for="GP_s_r1_regular" class="GP_s_en_regular selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_regular" class="GP_s_di_regular"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
					
							<div id="Regular_s_show1" <?php echo $DRegularf1_view; ?>>
                            <form id="gpformsubmit_regular" action="<?php echo $DRegular_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
        							<li style="display:none"><?php echo $DRegular_optin[5]; ?></li>
                                    <li <?php echo $Regular_name_disabled; ?>><input id="gpuserinput_regular" <?php echo $gpnameinput_regular; ?> name="<?php echo $DRegular_optin[1]; ?>" type="text" value="<?php echo $Regular_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; min-width:100%!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_regular" <?php echo $gpemailinput_regular; ?> name="<?php echo $DRegular_optin[2]; ?>" type="text" value="<?php echo $Regular_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; min-width:100%!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DRegular_optin[7]; ?></li>
                                    <li><input id="verified_regular" name="<?php echo $DRegular_optinsubmit; ?>" type="<?php echo $gpformbtn_regular; ?>" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" /></li>
                                </ul>
                            </form>
        					<input type="hidden" id="gpkeepuserdetails_regular" value="<?php echo $DAutoins; ?>">
        					<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
        					if ($jj("#gpkeepuserdetails_regular").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_regular").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_regular").val() + '|' + $jj("#gpemailinput_regular").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
        					}
                            //save user data to cookies
                            $jj("#verified_regular").click(function(){
                                $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                            });
        					</script>
							</div>
        					<div id="Regular_s_show2" class="GP_f-left-fb" <?php echo $DRegularf2_view; ?>>
        						<a id="verifiedfb_regular" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
        					</div>
      						<div <?php echo $DRegularf3_view; ?>>
                				<a id="verifiedlink_regular" class="GP_nodecor" href="<?php echo $DRegular_link; ?>" <?php echo $Regular_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" /></li>
                				</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
              				</div>
							<p class="GP_icon GP_padlock GP_nomarginbottom"><?php echo $DRegular_spam; ?></p>
                        </div>
                    </div>
                </div>
				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png' ?>">
            </div>
        </div>
		<?php } elseif ($DRegular_theme=='regular3' || $DRegular_theme=='regular13') { ?>
		<!-- mini -->
		<div class="Generation_plug GP_sidebar" id="GP_sidebarbox">
            <div class="GP_box-sign-up" <?php echo 'GP_'.$DRegular_btncolor; ?>" id="GP_sidebar">
                <div class="GP_box-container" style="background: <?php echo $DRegular_bgcolor; ?> url('<?php echo $DRegular_bgimage; ?>') repeat center center;">
                    <div class="GP_content">
                        <h2 style="padding:0 12px 0 12px" class="GP_w-height"><strong style="color:<?php echo $DRegular_headclr; ?>;"><?php if ($DRegular_countdown=="on") {do_shortcode("[gpcountdown_regular time=".$DRegular_headtxtT." front='".$DRegular_headtxtF."' end='".$DRegular_headtxtE."']");} else {echo $DRegular_headtxt;} ?></strong></h2>
                        <div class="GP_form-login-block">
					
        					<?php if ($DRegular_form=='both') { ?>
        						<div id="GP_s_regular" class="GP_f_regular GP_s_regular">
                                	<input style="display:none" type="radio" id="GP_s_r1_regular" name="GP_f_regular" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_regular" name="GP_f_regular" />
                           			<br/>
                                	<label for="GP_s_r1_regular" class="GP_s_en_regular selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_regular" class="GP_s_di_regular"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
					
							<div id="Regular_s_show1" <?php echo $DRegularf1_view; ?>>
                            <form id="gpformsubmit_regular" action="<?php echo $DRegular_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
        							<li style="display:none"><?php echo $DRegular_optin[5]; ?></li>
                                    <li <?php echo $Regular_name_disabled; ?>><input id="gpuserinput_regular" <?php echo $gpnameinput_regular; ?> name="<?php echo $DRegular_optin[1]; ?>" type="text" value="<?php echo $Regular_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; min-width:100%!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_regular" <?php echo $gpemailinput_regular; ?> name="<?php echo $DRegular_optin[2]; ?>" type="text" value="<?php echo $Regular_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; min-width:100%!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DRegular_optin[7]; ?></li>
                                    <li><input id="verified_regular" name="<?php echo $DRegular_optinsubmit; ?>" type="<?php echo $gpformbtn_regular; ?>" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" /></li>
                                </ul>
                            </form>
        					<input type="hidden" id="gpkeepuserdetails_regular" value="<?php echo $DAutoins; ?>">
        					<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
        					if ($jj("#gpkeepuserdetails_regular").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_regular").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_regular").val() + '|' + $jj("#gpemailinput_regular").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
        					}
                            //save user data to cookies
                            $jj("#verified_regular").click(function(){
                                $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                            });
        					</script>
							</div>
        					<div id="Regular_s_show2" class="GP_f-left-fb" <?php echo $DRegularf2_view; ?>>
        						<a id="verifiedfb_regular" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
        					</div>
      						<div <?php echo $DRegularf3_view; ?>>
                				<a id="verifiedlink_regular" class="GP_nodecor" href="<?php echo $DRegular_link; ?>" <?php echo $Regular_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" /></li>
                				</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
              				</div>
							<p class="GP_icon GP_padlock GP_nomarginbottom"><?php echo $DRegular_spam; ?></p>
                        </div>                    
                    </div>
                </div>
				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png' ?>">
            </div>
        </div>
		<?php } elseif ($DRegular_theme=='regular4' || $DRegular_theme=='regular14') { ?>
		<!-- micro -->
		<div class="Generation_plug GP_sidebar" id="GP_sidebarbox">
            <div class="GP_box-sign-up" <?php echo 'GP_'.$DRegular_btncolor; ?>" id="GP_sidebar">
                <div class="GP_box-container" style="background: <?php echo $DRegular_bgcolor; ?> url('<?php echo $DRegular_bgimage; ?>') repeat center center;">
                    <div class="GP_content">
                        <h2 style="padding:0 12px 0 12px" class="GP_w-height"><strong style="color:<?php echo $DRegular_headclr; ?>;"><?php if ($DRegular_countdown=="on") {do_shortcode("[gpcountdown_regular time=".$DRegular_headtxtT." front='".$DRegular_headtxtF."' end='".$DRegular_headtxtE."']");} else {echo $DRegular_headtxt;} ?></strong></h2>
                        <div class="GP_form-login-block">

        					<?php if ($DRegular_form=='both') { ?>
        						<div id="GP_s_regular" class="GP_f_regular GP_s_regular">
                                	<input style="display:none" type="radio" id="GP_s_r1_regular" name="GP_f_regular" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_regular" name="GP_f_regular" />
                           			<br/>
                                	<label for="GP_s_r1_regular" class="GP_s_en_regular selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_regular" class="GP_s_di_regular"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
					
							<div id="Regular_s_show1" <?php echo $DRegularf1_view; ?>>
                            <form id="gpformsubmit_regular" action="<?php echo $DRegular_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
        							<li style="display:none"><?php echo $DRegular_optin[5]; ?></li>
                                    <li style="display:none"><input id="gpuserinput_regular" <?php echo $gpnameinput_regular; ?> name="<?php echo $DRegular_optin[1]; ?>" type="text" value="<?php echo 'Subscriber'; /*$Regular_fname;*/ ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:155px!important; min-width:155px!important; max-width:155px!important" /></li>
                                    <li><input id="gpemailinput_regular" <?php echo $gpemailinput_regular; ?> name="<?php echo $DRegular_optin[2]; ?>" type="text" value="<?php echo $Regular_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DRegular_optin[7]; ?></li>
                                    <li><input id="verified_regular" name="<?php echo $DRegular_optinsubmit; ?>" type="<?php echo $gpformbtn_regular; ?>" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" /></li>
                                </ul>
                            </form>
        					<input type="hidden" id="gpkeepuserdetails_regular" value="<?php echo $DAutoins; ?>">
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
        					if ($jj("#gpkeepuserdetails_regular").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_regular").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_regular").val() + '|' + $jj("#gpemailinput_regular").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
        					}
                            //save user data to cookies
                            $jj("#verified_regular").click(function(){
                                $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                            });
        					</script>
							</div>
        					<div id="Regular_s_show2" class="GP_f-left-fb" <?php echo $DRegularf2_view; ?>>
        						<a id="verifiedfb_regular" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
        					</div>
      						<div <?php echo $DRegularf3_view; ?>>
                				<a id="verifiedlink_regular" class="GP_nodecor" href="<?php echo $DRegular_link; ?>" <?php echo $Regular_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Regular_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DRegular_btncolor; ?>" /></li>
                				</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_regular").click(function(){
                                    $jj.cookie("gpsubscribed_regular", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
              				</div>
							<p class="GP_icon GP_padlock GP_nomarginbottom"><?php echo $DRegular_spam; ?></p>
                        </div>                    
                    </div>
                </div>
				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png' ?>">
            </div>
        </div>
		<?php } ?>


<?php 
} //displaying settings
} //STOP IF DAYS OK
} //STOP IF ACTIVATED
} //START IF 'SUBSCRIBED' IS NOT ACTIVE


/********** FUNCTION STOP **********/
}

//widget
wp_register_sidebar_widget(
    'GenerationPluginID1',
    'Generation Plugin - Sidebar Opt-in',
    'gpregularreturn',
    array(
        'description' => 'Displays "Generation Plugin" sidebar opt-in form'
    )
);
?>
