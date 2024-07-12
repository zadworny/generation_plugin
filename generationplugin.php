<?php
/*
Plugin Name: Generation Plugin
Plugin URI:  http://GenerationPlugin.com
Description: Turn Your Blog Into List Building Machine Working On Autopilot And Turning Your Visitors Into Subscribers.
Version:     1.5.7
Author:      Sam Zadworny
Author URI:  http://SamZadworny.com
License:	 Commercial. For personal use only, use for unlimited own websites. Not to give away or resell. All rights reserved.
*/




//CHECK FOR UPDATES
error_reporting(0);
require 'update/update.php';
$GenerationPlugin_update = new PluginUpdateChecker(
	'http://s433116487.onlinehome.info/09hw7823l6/info.json',
	__FILE__
);




//GLOBAL SETTINGS
/********* VERSION NUMBER *********/
$GenerationPlugin_version = "1.5.7"; 
/**********************************/
$GenerationPlugin_dir = trim(dirname(plugin_basename(__FILE__)), '/');
$GenerationPlugin_path = WP_PLUGIN_URL."/".$GenerationPlugin_dir."/";
$GenerationPlugin_style = $GenerationPlugin_path.'style';
$GenerationPlugin_scripts = $GenerationPlugin_path.'scripts';
$GenerationPlugin_lightbox = $GenerationPlugin_path.'lightbox';
$GenerationPlugin_facebook = $GenerationPlugin_path.'facebook';
$GenerationPlugin_uploads = '../wp-content/uploads/'; //or wp_upload_dir();
$GenerationPlugin_uploads_db_tmp = wp_upload_dir();
$GenerationPlugin_uploads_db = $GenerationPlugin_uploads_db_tmp['baseurl']."/";
//$GenerationPlugin_preview = $GenerationPlugin_path.'preview';
//online location for save a size of the plugin package:
//GenerationPlugin_images = $GenerationPlugin_path.'images';
$GenerationPlugin_images = 'http://generationplugin.com/online/images';
$GenerationPlugin_images_online = 'http://generationplugin.com/online/images'; //#1
$GenerationPlugin_preview = 'http://generationplugin.com/online/preview'; //#2

if (!defined('GenerationPlugin_version')) define('GenerationPlugin_version', $GenerationPlugin_version);
if (!defined('GenerationPlugin_dir')) define('GenerationPlugin_dir', $GenerationPlugin_dir);
if (!defined('GenerationPlugin_path')) define('GenerationPlugin_path', $GenerationPlugin_path);
if (!defined('GenerationPlugin_style')) define('GenerationPlugin_style', $GenerationPlugin_style);
if (!defined('GenerationPlugin_images')) define('GenerationPlugin_images', $GenerationPlugin_images);
if (!defined('GenerationPlugin_preview')) define('GenerationPlugin_preview', $GenerationPlugin_preview);
if (!defined('GenerationPlugin_scripts')) define('GenerationPlugin_scripts', $GenerationPlugin_scripts);
if (!defined('GenerationPlugin_lightbox')) define('GenerationPlugin_lightbox', $GenerationPlugin_lightbox);
if (!defined('GenerationPlugin_facebook')) define('GenerationPlugin_facebook', $GenerationPlugin_facebook);
if (!defined('GenerationPlugin_uploads')) define('GenerationPlugin_uploads', $GenerationPlugin_uploads);
if (!defined('GenerationPlugin_uploads_db')) define('GenerationPlugin_uploads_db', $GenerationPlugin_uploads_db);
//online location for save a size of the plugin package:
if (!defined('GenerationPlugin_images_online')) define('GenerationPlugin_images_online', $GenerationPlugin_images_online); //#1

global $wpdb;
$table_name = $wpdb->prefix . 'GenerationPlugin_';

$create1 = "CREATE TABLE ".$table_name."GENERAL (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Autoins text NOT NULL COLLATE utf8_unicode_ci,
Livecheck text NOT NULL COLLATE utf8_unicode_ci,
Affiliate text NOT NULL COLLATE utf8_unicode_ci,
License text NOT NULL COLLATE utf8_unicode_ci,
Preview text NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Dontshowagain text NOT NULL COLLATE utf8_unicode_ci,
Poweredby text NOT NULL COLLATE utf8_unicode_ci,
Minutes text NOT NULL COLLATE utf8_unicode_ci,
Seconds text NOT NULL COLLATE utf8_unicode_ci,
Jqueryfix text NOT NULL COLLATE utf8_unicode_ci,
Link_blank text NOT NULL COLLATE utf8_unicode_ci,
Switch text NOT NULL COLLATE utf8_unicode_ci,
Myemail text NOT NULL COLLATE utf8_unicode_ci,
Cookies text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";  

$create2 = "CREATE TABLE ".$table_name."LIGHTBOX (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Link text NOT NULL COLLATE utf8_unicode_ci,
Link_blank text NOT NULL COLLATE utf8_unicode_ci,
Theme text NOT NULL COLLATE utf8_unicode_ci,
Image text NOT NULL COLLATE utf8_unicode_ci,
Bgimage text NOT NULL COLLATE utf8_unicode_ci,
Background text NOT NULL COLLATE utf8_unicode_ci,
Title text NOT NULL COLLATE utf8_unicode_ci,
Text text NOT NULL COLLATE utf8_unicode_ci,
Formtitle text NOT NULL COLLATE utf8_unicode_ci,
Formtext text NOT NULL COLLATE utf8_unicode_ci,
Listpoint text NOT NULL COLLATE utf8_unicode_ci,
Video text NOT NULL COLLATE utf8_unicode_ci,
Form longtext NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Spam text NOT NULL COLLATE utf8_unicode_ci,
Optincode text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";
	
$create3 = "CREATE TABLE ".$table_name."SLIDER (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Link text NOT NULL COLLATE utf8_unicode_ci,
Link_blank text NOT NULL COLLATE utf8_unicode_ci,
Theme text NOT NULL COLLATE utf8_unicode_ci,
Image text NOT NULL COLLATE utf8_unicode_ci,
Bgimage text NOT NULL COLLATE utf8_unicode_ci,
Background text NOT NULL COLLATE utf8_unicode_ci,
Title text NOT NULL COLLATE utf8_unicode_ci,
Text text NOT NULL COLLATE utf8_unicode_ci,
Formtitle text NOT NULL COLLATE utf8_unicode_ci,
Formtext text NOT NULL COLLATE utf8_unicode_ci,
Listpoint text NOT NULL COLLATE utf8_unicode_ci,
Video text NOT NULL COLLATE utf8_unicode_ci,
Form longtext NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Spam text NOT NULL COLLATE utf8_unicode_ci,
Optincode text NOT NULL COLLATE utf8_unicode_ci,
Slidelink text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";

$create4 = "CREATE TABLE ".$table_name."HEADER (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Link text NOT NULL COLLATE utf8_unicode_ci,
Link_blank text NOT NULL COLLATE utf8_unicode_ci,
Theme text NOT NULL COLLATE utf8_unicode_ci,
Image text NOT NULL COLLATE utf8_unicode_ci,
Bgimage text NOT NULL COLLATE utf8_unicode_ci,
Background text NOT NULL COLLATE utf8_unicode_ci,
Title text NOT NULL COLLATE utf8_unicode_ci,
Text text NOT NULL COLLATE utf8_unicode_ci,
Form longtext NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Hey text NOT NULL COLLATE utf8_unicode_ci,
Spam text NOT NULL COLLATE utf8_unicode_ci,
Optincode text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";
	
$create5 = "CREATE TABLE ".$table_name."FOOTER (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Link text NOT NULL COLLATE utf8_unicode_ci,
Link_blank text NOT NULL COLLATE utf8_unicode_ci,
Theme text NOT NULL COLLATE utf8_unicode_ci,
Image text NOT NULL COLLATE utf8_unicode_ci,
Bgimage text NOT NULL COLLATE utf8_unicode_ci,
Background text NOT NULL COLLATE utf8_unicode_ci,
Title text NOT NULL COLLATE utf8_unicode_ci,
Text text NOT NULL COLLATE utf8_unicode_ci,
Form longtext NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Spam text NOT NULL COLLATE utf8_unicode_ci,
Optincode text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";

$create6 = "CREATE TABLE ".$table_name."REGULAR (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Link text NOT NULL COLLATE utf8_unicode_ci,
Link_blank text NOT NULL COLLATE utf8_unicode_ci,
Theme text NOT NULL COLLATE utf8_unicode_ci,
Image text NOT NULL COLLATE utf8_unicode_ci,
Bgimage text NOT NULL COLLATE utf8_unicode_ci,
Background text NOT NULL COLLATE utf8_unicode_ci,
Title text NOT NULL COLLATE utf8_unicode_ci,
Text text NOT NULL COLLATE utf8_unicode_ci,
Form longtext NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Spam text NOT NULL COLLATE utf8_unicode_ci,
Optincode text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";
	
$create7 = "CREATE TABLE ".$table_name."INSIDER (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Link text NOT NULL COLLATE utf8_unicode_ci,
Link_blank text NOT NULL COLLATE utf8_unicode_ci,
Theme text NOT NULL COLLATE utf8_unicode_ci,
Bgimage text NOT NULL COLLATE utf8_unicode_ci,
Background text NOT NULL COLLATE utf8_unicode_ci,
Title text NOT NULL COLLATE utf8_unicode_ci,
Form longtext NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Spam text NOT NULL COLLATE utf8_unicode_ci,
Optincode text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";
	
$create8 = "CREATE TABLE ".$table_name."REGISTER (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Link text NOT NULL COLLATE utf8_unicode_ci,
Theme text NOT NULL COLLATE utf8_unicode_ci,
Image text NOT NULL COLLATE utf8_unicode_ci,
Bgimage text NOT NULL COLLATE utf8_unicode_ci,
Background text NOT NULL COLLATE utf8_unicode_ci,
Title text NOT NULL COLLATE utf8_unicode_ci,
Text text NOT NULL COLLATE utf8_unicode_ci,
Form longtext NOT NULL COLLATE utf8_unicode_ci,
Regular text NOT NULL COLLATE utf8_unicode_ci,
Social text NOT NULL COLLATE utf8_unicode_ci,
Sky text NOT NULL COLLATE utf8_unicode_ci,
Openlink text NOT NULL COLLATE utf8_unicode_ci,
Optincode text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";
	
$create9 = "CREATE TABLE ".$table_name."EXIT (
id mediumint(9) NOT NULL AUTO_INCREMENT,
Redirect text NOT NULL COLLATE utf8_unicode_ci,
Text text NOT NULL COLLATE utf8_unicode_ci,
Wrap text NOT NULL COLLATE utf8_unicode_ci,
Message text NOT NULL COLLATE utf8_unicode_ci,
Stop text NOT NULL COLLATE utf8_unicode_ci,
Active text NOT NULL COLLATE utf8_unicode_ci,
Display text NOT NULL COLLATE utf8_unicode_ci,
UNIQUE KEY id (id)
) COLLATE utf8_unicode_ci;";

if (!defined('gp_create1')) define('gp_create1', $create1);	
if (!defined('gp_create2')) define('gp_create2', $create2);	
if (!defined('gp_create3')) define('gp_create3', $create3);	
if (!defined('gp_create4')) define('gp_create4', $create4);	
if (!defined('gp_create5')) define('gp_create5', $create5);	
if (!defined('gp_create6')) define('gp_create6', $create6);	
if (!defined('gp_create7')) define('gp_create7', $create7);	
if (!defined('gp_create8')) define('gp_create8', $create8);	
if (!defined('gp_create9')) define('gp_create9', $create9);	 
		
		
		

//CREATE DATABASE TABLES
function GenerationPlugin_activate() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'GenerationPlugin_';
	
	if ($wpdb->get_var('SHOW TABLES LIKE %'.$table_name.'%') != $table_name) {
		
		$sql = gp_create1.gp_create2.gp_create3.gp_create4.gp_create5.gp_create6.gp_create7.gp_create8.gp_create9;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		//insert for regular
		$wpdb->insert($table_name."GENERAL", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."LIGHTBOX", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."SLIDER", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."HEADER", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."FOOTER", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."EXIT", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."INSIDER", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."REGULAR", array('id'=>'1'), array('%d'));
		$wpdb->insert($table_name."REGISTER", array('id'=>'1'), array('%d'));
		//insert for preview
		$wpdb->insert($table_name."LIGHTBOX", array('id'=>'9999'), array('%d'));
		$wpdb->insert($table_name."SLIDER", array('id'=>'9999'), array('%d'));
		$wpdb->insert($table_name."HEADER", array('id'=>'9999'), array('%d'));
		$wpdb->insert($table_name."FOOTER", array('id'=>'9999'), array('%d'));
		$wpdb->insert($table_name."EXIT", array('id'=>'9999'), array('%d'));
		$wpdb->insert($table_name."INSIDER", array('id'=>'9999'), array('%d'));
		$wpdb->insert($table_name."REGULAR", array('id'=>'9999'), array('%d'));
		$wpdb->insert($table_name."REGISTER", array('id'=>'9999'), array('%d'));
	}
	//ADD NEW COLUMNS - VERSION 1.0.4
    global $wpdb;
    $checkfields1 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."LIGHTBOX");
    $checkfields2 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."SLIDER");
    $checkfields3 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."HEADER");
    $checkfields4 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."FOOTER");
    $checkfields5 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."REGULAR");
    $checkfields6 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."INSIDER");
    $checkfields7 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."GENERAL");
    $checkfields8 = $wpdb->get_col("SHOW FIELDS FROM ".$table_name."EXIT");
	$updatedb = '';
	//ADD NEW COLUMNS - VERSION 1.5.0
    if (!in_array("Switch", $checkfields7)) {
        $updatedb .= mysql_query("ALTER TABLE ".$table_name."GENERAL ADD Switch text NOT NULL COLLATE utf8_unicode_ci");
    }
    if (!in_array("Myemail", $checkfields7)) {
        $updatedb .= mysql_query("ALTER TABLE ".$table_name."GENERAL ADD Myemail text NOT NULL COLLATE utf8_unicode_ci");
    }
    if (!in_array("Cookies", $checkfields7)) {
        $updatedb .= mysql_query("ALTER TABLE ".$table_name."GENERAL ADD Cookies text NOT NULL COLLATE utf8_unicode_ci");
    }
    if (!in_array("Stop", $checkfields8)) {
        $updatedb .= mysql_query("ALTER TABLE ".$table_name."EXIT ADD Stop text NOT NULL COLLATE utf8_unicode_ci");
    }
    if (!in_array("Message", $checkfields8)) {
        $updatedb .= mysql_query("ALTER TABLE ".$table_name."EXIT ADD Message text NOT NULL COLLATE utf8_unicode_ci");
    }
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($updatedb);
}
register_activation_hook(__FILE__, 'GenerationPlugin_activate');




//REMOVE TABLES ON UNINSTALL
function GenerationPlugin_uninstall() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'GenerationPlugin_';
	$wpdb->query("DROP TABLE IF EXISTS ".$table_name."GENERAL, ".$table_name."LIGHTBOX, ".$table_name."SLIDER, ".$table_name."HEADER, ".$table_name."FOOTER, ".$table_name."EXIT, ".$table_name."INSIDER, ".$table_name."REGULAR, ".$table_name."REGISTER");
}
register_uninstall_hook(__FILE__, 'GenerationPlugin_uninstall');




//HEAD
function GenerationPlugin_head() {

	?>
	<style type="text/css">
	.Generation_plugin .menuimg {
         float:left;
         margin:-10px 10px 0 0;
    }
    .Generation_plugin h2 {
         font-family:arial; 
         font-weight:normal; 
         font-size:23px;
         margin-bottom:30px;
    }
    .Generation_plugin .changessaved { 
         position:fixed;
         margin-top:-42px;
         margin-left:-132px;
         border:1px solid #390;
         padding:25px 0 0 95px;
         width:180px;
         height:60px;
         left:50%;
         top:50%;
         color:#390;
         font-size:18px;
         font-weight:bold;
         text-align:left;
         vertical-align:middle;
         box-shadow: 0 0 10px rgba(0,0,0,0.5);
         -moz-border-radius:5px;
         border-radius:5px;
         z-index:200;
    	 text-shadow:1px 1px 0 #FFF;
    }
    .Generation_plugin .GP_cookiessaved { 
         margin-left:-137px;
         width:190px;
    }
    .Generation_plugin .changessaved span { 
         font-size:12px;
         font-weight:normal;
    	 text-shadow:1px 1px 0 #FFF;
    }
    .Generation_plugin #pageloader,
    .Generation_plugin #pageloader2 { 
    	 position:fixed;
      	 margin-top:-33px;
       	 margin-left:-33px;
       	 width:66px;
       	 height:66px;
       	 left:50%;
       	 top:50%;
       	 vertical-align:middle;
       	 z-index:100;
    }
	</style>
	<?php
	wp_enqueue_style('style main', GenerationPlugin_style.'/style-admin.css');
	
	if (!isset($_POST['displayingformsent_popup']) &&
		!isset($_POST['displayingformsent_slider']) &&
		!isset($_POST['displayingformsent_header']) &&
		!isset($_POST['displayingformsent_footer']) &&
		!isset($_POST['displayingformsent_regular']) &&
		!isset($_POST['displayingformsent_inside']) &&
		!isset($_POST['displayingformsent_reg']) &&
		!isset($_POST['displayingformsent_exit'])) {
	}
	
	if (!wp_script_is('jquery')) {
        wp_deregister_script('jquery'); 
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', false, '1.8.2'); 
		wp_enqueue_script('jquery');
    }
	
	wp_enqueue_script('script_gpfunctions', GenerationPlugin_scripts.'/functions.js', array("jquery"), "1.8.2");
	wp_enqueue_script('script_gpcharcount', GenerationPlugin_scripts.'/charcount.js', array("jquery"), "1.8.2");
	wp_enqueue_script('script_gpcolorpicker', GenerationPlugin_scripts.'/colorPicker.js', array("jquery"), "1.8.2");
	wp_enqueue_script('script_gpopt-in', GenerationPlugin_scripts.'/opt-in.js', array("jquery"), "1.8.2");
	wp_enqueue_script('script_gpcookies', GenerationPlugin_scripts.'/jquery.cookie.js', array("jquery"), "1.8.2");
    ?>
	<script type="text/javascript">
    	var $jj = jQuery.noConflict();
    	function isValidUserCHECK_test() {
    		var user = $jj("#gpuserinput_test").val();
    		var email = $jj("#gpemailinput_test").val();
    		if(user != 0) {
    			if(isValidUser_test(user)) {
    				$jj("#gpuserinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				if(isValidEmailAddress_test(email)) {
    					document.getElementById('verified_test').type="submit";
    				}
    			} else {
    				$jj("#gpuserinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_test').type="button";
    			}
    		} else {
    			$jj("#gpuserinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_test').type="button";
    		}
    	}
    	function isValidEmailCHECK_test() {
    		var user = $jj("#gpuserinput_test").val();
    		var email = $jj("#gpemailinput_test").val();
    		if(email != 0) {
    			if(isValidEmailAddress_test(email)) {
    				$jj("#gpemailinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				if(isValidUser_test(user)) {
    					document.getElementById('verified_test').type="submit";
    				}
    			} else {
    				$jj("#gpemailinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_test').type="button";
    			}
    		} else {
    			$jj("#gpemailinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_test').type="button";
    		}
    	}
    	function isValidUser_test(user) {
     		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
     		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
     		return patternone.test(user);
    	}
    	function isValidEmailAddress_test(email) {
     		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
     		return pattern.test(email);
    }
    </script>
	<?php
}
add_action('admin_head', 'GenerationPlugin_head');




//ADD 'SETTINGS' LINK
function GenerationPlugin_settingslink($links, $file) {
    static $this_plugin;
    if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
    if ($file == $this_plugin){
    	$settings_link = '<a href="admin.php?page=GenerationPlugin">'.__("Settings", "gpsettingspage").'</a>';
     	array_push($links, $settings_link); //unshift - adds link before other links
    }
    return $links;
}
add_filter('plugin_action_links', 'GenerationPlugin_settingslink', 10, 2);




//MENU
function GenerationPlugin_menu() {
	add_menu_page('Generation Options', 'Generation', 'manage_options', 'GenerationPlugin', 'GenerationPlugin_formssettings', GenerationPlugin_images.'/generation.png');
	add_submenu_page('GenerationPlugin', 'Generation - Forms settings', 'Forms settings', 'manage_options', 'GenerationPlugin', 'GenerationPlugin_formssettings');
	add_submenu_page('GenerationPlugin', 'Generation - General settings', 'General settings', 'manage_options', 'GenerationPlugin_generalsettings', 'GenerationPlugin_generalsettings');
}
add_action('admin_menu', 'GenerationPlugin_menu');




//USER CONTENT
include "content.php";




//CLEAR COOKIES
if (isset($_POST['displayingformsent_cookies'])=='Save Changes') {
	function gpclearallcookiesnow() {
    	setcookie('gpds_popup', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpds_header', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpds_footer', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('timer_popup', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('timer_slider', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('timer_header', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('timer_footer', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('timer_regular', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('timer_inside', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('timer_reg', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('testformcookie', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('userdts_forms', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpmydetails', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpsubscribed_popup', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpsubscribed_slider', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpsubscribed_header', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpsubscribed_footer', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpsubscribed_regular', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpsubscribed_inside', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    	setcookie('gpsubscribed_reg', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
    }
    add_action('init', 'gpclearallcookiesnow');
}




//SECRET CODE
function secretencode($pass) {
    $encrypt = md5($pass);
    $new = substr($encrypt,5,15);
    $n1 = str_replace("0","2",$new);
    $n2 = str_replace("1","3",$n1);
    $n3 = str_replace("I","K",$n2);
    $n4 = str_replace("i","k",$n3);
    $n5 = str_replace("L","N",$n4);
    $n6 = str_replace("l","n",$n5);
    $n7 = str_replace("O","R",$n6);
    $n8 = str_replace("o","r",$n7);
    $final = strtoupper($n8);
    return $final;
}




//OPT-IN FORMS PAGE
function GenerationPlugin_formssettings() {

	global $wpdb;
	$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL'; 
	$table_name_lightbox = $wpdb->prefix . 'GenerationPlugin_LIGHTBOX';
	$table_name_slider = $wpdb->prefix . 'GenerationPlugin_SLIDER';
	$table_name_header = $wpdb->prefix . 'GenerationPlugin_HEADER';
	$table_name_footer = $wpdb->prefix . 'GenerationPlugin_FOOTER';
	$table_name_exit = $wpdb->prefix . 'GenerationPlugin_EXIT';
	$table_name_insider = $wpdb->prefix . 'GenerationPlugin_INSIDER';
	$table_name_regular = $wpdb->prefix . 'GenerationPlugin_REGULAR';
	$table_name_register = $wpdb->prefix . 'GenerationPlugin_REGISTER';

	require 'facebook/require.php'; //sec
			
	if (isset($_POST['displayingformsent_preview'])=='Save Changes' && !isset($_POST['testbutton'])) {
		if ($_POST['displayingformsent_previewstatus']=='' || $_POST['displayingformsent_previewstatus']=='off') {
			$DPreviewsave = 'on';
		} else { 
			$DPreviewsave = 'off'; 
		}
		$wpdb->update($table_name_general, array('Preview'=>trim($DPreviewsave)), array('id'=>'1'));
	}
	$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
			
	if ($DPreview=='' || $DPreview=='off') {
		$DPreview_mode = 'savepreview_off';
	} else {
		$DPreview_mode = 'savepreview_on';
	}
	?>

    <div id="Generation_plugin_load" class="Generation_plugin">

	<img class="menuimg" src="<?php echo GenerationPlugin_images.'/generation_optinforms.png'; ?>">
	<h2>Forms settings</h2>

	<div id="pageloader">
		<img src="<?php echo GenerationPlugin_images.'/pageloader.gif'; ?>">
	</div>
	
	<div id="gpsaveinfo" style="display:none">
	
		<?php if (!isset($_POST['displayingformsent_popup']) && 
				  !isset($_POST['displayingformsent_slider']) && 
				  !isset($_POST['displayingformsent_header']) && 
				  !isset($_POST['displayingformsent_footer']) && 
				  !isset($_POST['displayingformsent_regular']) && 
				  !isset($_POST['displayingformsent_inside']) && 
				  !isset($_POST['displayingformsent_reg']) && 
				  !isset($_POST['displayingformsent_exit'])) { ?>
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
         $jj(document).ready(function() {
         	//CONTENT
         	$jj("div.menu .menu_tabs:first").addClass("menu_tabs_active").show(); //Activate first tab
         	$jj("#pageloader").fadeOut(0); //Hide loader
         	$jj("#gpsaveinfo").fadeIn(0); //Show save info
         	$jj("#pagemenu").delay(50).fadeIn(1500); //Show menu
         	$jj(".tab_content:first").delay(50).fadeIn(1500); //Show first tab content
         	//On Click Event
         	//Moved to functions.js
         });
		</script>
		<?php } ?>
		
       	<?php if (isset($_POST['displayingformsent_preview'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() { $jj('#savemessage_preview').delay(4800).fadeOut(800); });
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_preview" class="changessaved">CHANGES SAVED<br><span>for Preview Mode</span></div>
       	<?php } ?>
       
       	<?php if (isset($_POST['displayingformsent_popup'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab1").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab1").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_popup').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_popup" class="changessaved">CHANGES SAVED<br><span>for Lightbox Popup</span></div>
       	<?php } ?>
       
       	<?php if (isset($_POST['displayingformsent_slider'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab2").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab2").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_slide').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_slide" class="changessaved">CHANGES SAVED<br><span>for Slide Panel Opt-in</span></div>
       	<?php } ?>
           
       	<?php if (isset($_POST['displayingformsent_header'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab3").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab3").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_header').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_header" class="changessaved">CHANGES SAVED<br><span>for Header Panel Opt-in</span></div>
       	<?php } ?>
           
       	<?php if (isset($_POST['displayingformsent_footer'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab4").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab4").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_footer').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_footer" class="changessaved">CHANGES SAVED<br><span>for Footer Panel Opt-in</span></div>
       	<?php } ?>
           
       	<?php if (isset($_POST['displayingformsent_regular'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab5").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab5").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_regular').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_regular" class="changessaved">CHANGES SAVED<br><span>for Sidebar Opt-in</span></div>
       	<?php } ?>
           
       	<?php if (isset($_POST['displayingformsent_inside'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab6").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab6").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_inside').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_inside" class="changessaved">CHANGES SAVED<br><span>for Inpost Opt-in</span></div>
       	<?php } ?>
           
       	<?php if (isset($_POST['displayingformsent_reg'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab7").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab7").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_reg').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_reg" class="changessaved">CHANGES SAVED<br><span>for Registration Popup</span></div>
       	<?php } ?>
       
       	<?php if (isset($_POST['displayingformsent_exit'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() {
            	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
            	$jj("#ttab8").addClass("menu_tabs_active");
            	$jj(".tab_content").css('display','none');
            	var activeTab = $jj("#ttab8").attr("href");
            	$jj(activeTab).delay(50).fadeIn(1500);
				$jj("#pagemenu").delay(50).fadeIn(1500);
				$jj("#gpsaveinfo").fadeIn(0);
				$jj("#pageloader").fadeOut(0);
    			$jj('#savemessage_exit').delay(4800).fadeOut(800);
			});
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_exit" class="changessaved">CHANGES SAVED<br><span>for Exit Popup</span></div>
       	<?php } ?>
       
       	<?php if (isset($_POST['displayingformsent_cookies'])=='Save Changes') { ?>
       		<script type="text/javascript">
       		$jj(document).ready(function() { $jj('#savemessage_cookies').delay(4800).fadeOut(800); });
       		$jj(document).ready(function() { $jj('#hidecookiesdiv').css('display','none'); });
       		</script>
       		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_cookies" class="changessaved GP_cookiessaved">COOKIES CLEARED<br><span>for Generation Plugin</span></div>
       	<?php } ?>
		
	</div>
	
    <div class="menu" id="pagemenu" style="display:none">
		<a class="menu_tabs" id="ttab1" href="#tab1"><span class="but-desc"><strong>Lightbox</strong><br><em>popup opt-in</em></span></a>
		<a class="menu_tabs" id="ttab2" href="#tab2"><span class="but-desc"><strong>Sliding</strong><br><em>panel opt-in</em></span></a>
		<a class="menu_tabs" id="ttab3" href="#tab3"><span class="but-desc"><strong>Header</strong><br><em>panel opt-in</em></span></a>
		<a class="menu_tabs" id="ttab4" href="#tab4"><span class="but-desc"><strong>Footer</strong><br><em>panel opt-in</em></span></a>
		<a class="menu_tabs" id="ttab5" href="#tab5"><span class="but-desc"><strong>Sidebar</strong><br><em>box opt-in</em></span></a>
		<a class="menu_tabs" id="ttab6" href="#tab6"><span class="but-desc"><strong>Inpost</strong><br><em>box opt-in</em></span></a>
		<a class="menu_tabs" id="ttab7" href="#tab7"><span class="but-desc"><strong>Special</strong><br><em>popup boxes</em></span></a>
		<a class="menu_tabs" id="ttab8" href="#tab8"><span class="but-desc"><strong>Exit</strong><br><em>popup box</em></span></a>
		<!-- PREVIEW MODE ON/OFF -->
		<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_preview" enctype="multipart/form-data">
			<input name="displayingformsent_preview" type="hidden" value="Save Changes">
			<input name="displayingformsent_previewstatus" type="hidden" value="<?php echo $DPreview; ?>">
			<div style="position:absolute; margin-top:-55px; left:798px; height:56px; z-index:998" class="opennewonhover">
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/<?php echo $DPreview_mode; ?>.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
				<div style="position:absolute; display:none; z-index:98" class="opennewshow">
					<a class="menu_tabs_dark" href="<?php echo '../index.php'; ?>" target="_blank">
            			<span class="but-desc"><strong>Preview</strong><br><em>in new tab</em></span>
            		</a>
    			</div>
				<div style="margin-left:225px; margin-top:-55px">
        			<a href="<?php echo GP_helpdesk; ?>" target="_blank">
            			<img src="<?php echo GenerationPlugin_images.'/helpdesk.png'; ?>" title="HELPDESK">
            		</a>
        		</div>
        	</div>
		</form>
		<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_form_cookies" name="GenerationPlugin_form_cookies">
			<input name="displayingformsent_cookies" type="hidden" value="Save Changes">
    		<div id="hidecookiesdiv">
				<?php if (isset($_COOKIE["gpds_footer"]) || isset($_COOKIE["timer_popup"]) || isset($_COOKIE["timer_slider"]) || isset($_COOKIE["timer_header"]) || isset($_COOKIE["timer_footer"]) || isset($_COOKIE["timer_regular"]) || isset($_COOKIE["timer_inside"]) || isset($_COOKIE["timer_reg"]) || isset($_COOKIE["testformcookie"]) || isset($_COOKIE["userdts_forms"]) || isset($_COOKIE["gpmydetails"]) || isset($_COOKIE["gpsubscribed_popup"]) || isset($_COOKIE["gpsubscribed_slider"]) || isset($_COOKIE["gpsubscribed_header"]) || isset($_COOKIE["gpsubscribed_footer"]) || isset($_COOKIE["gpsubscribed_regular"]) || isset($_COOKIE["gpsubscribed_inside"]) || isset($_COOKIE["gpsubscribed_reg"])) { ?>
    			<p style="position:absolute; margin-top:0; left:800px; width:190px; color:#09C; font-size:11px; cursor:pointer" onClick="document.forms['GenerationPlugin_form_cookies'].submit(); return false;">
    				Clear all cookies for Generation Plugin
    			</p>
				<?php } ?>
        	</div>
		</form>
    </div>
	
	<?php
    //PREVIEW MODE ON/OFF
    $DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
    get_currentuserinfo();
    global $user_level;
    if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }
	
	if (facebookrequire=='positive') { //sec
    	include "_lightboxpopup.php";
    	include "_slidepanel.php";
    	include "_headerpanel.php";
    	include "_footerpanel.php";
    	include "_sidebarbox.php";
    	include "_inpostbox.php";
    	include "_specialpopup.php";
    	include "_exitpopup.php";
	} else { ?>
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
			<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="button">
		</div>
		<br/>
		<div class="left_section" style="width:1068px">
        	<h4>ACTIVATION</h4>
			<p style="color:#222; line-height:15%">
				Please follow all the steps below to license this copy of the Generation Plugin.
			</p>
			<p style="color:#777; line-height:150%; margin-top:30px">
				1. Copy your website's url: <span style="color:#21759b; cursor:text"><?php echo get_home_url(); ?></span><br/>
				2. Login to your <a href="http://www.generationplugin.com/login" target="_blank">members page</a>, paste it into
				'Add license' input field there and click 'Save' button;<br>
				3. Copy generated activation code from your members page;<br>
				4. Back to THIS page, paste it into the input box below and click 'License this website' button.
			</p>
			<?php echo $secretid_msg_db.$secretid_msg; ?>
			<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post">
				<input name="activate" style="min-height:35px; padding-top:6px; color:#777" type="submit" value="License this website">
				<input name="secretid" style="float:left; min-height:35px; padding:3px 7px" type="text">
			</form>
			<p style="color:#777; line-height:150%">
				<span style="color:red">IMPORTANT: </span>
				If you have just updated the plugin on this blog (this is not first installation),
				<br>please go to 'Plugins' page and deactivate and activate the Generation Plugin again, 
				<br>otherwise you'll not be able to license the plugin.
			</p>
			<p style="color:#777; line-height:150%">
				<span style="color:red">IMPORTANT: </span>
				Please use email address from your members dashboard when contacting our helpdesk with
    			<br>technical questions or issues. We can help you only when we are sure that you are
    			<br>registered and legal user of the plugin.
			</p>
		</div>
	<?php } ?>

	</div>
<?php }




//GENERAL SETTINGS PAGE
function GenerationPlugin_generalsettings() {

	?>
	<script type="text/javascript">
	var $jj = jQuery.noConflict();
    $jj(document).ready(function(){
    	$jj("#gp_d1").charCount({allowed:16, warning:0, /*counterText:'left: '*/});
    	$jj("#gp_d2").charCount({allowed:56, warning:0, /*counterText:'left: '*/});
    	$jj("#gp_d3").charCount({allowed:10, warning:0, /*counterText:'left: '*/});
    	$jj("#gp_d4").charCount({allowed:10, warning:0, /*counterText:'left: '*/});
    	$jj("#gp_d5").charCount({allowed:10, warning:0, /*counterText:'left: '*/});
    	$jj("#gp_d6").charCount({allowed:10, warning:0, /*counterText:'left: '*/});
		
    	//default values in form
    	$jj('input[type=text]').each(function(){ $jj(this).data('default', this.value); });
		$jj('input[type=text]').focusin(function(){ if (this.value==$jj(this).data('default')) {this.value='';} });
		$jj('input[type=text]').focusout(function(){ if (this.value=='') {this.value=$jj(this).data('default');} });
    	$jj('#fbselect').focusin(function(){this.value=$jj(this).data('default');}) //reset the action for fb select field
		$jj('#fbselect').focusout(function(){this.value=$jj(this).data('default');}); //reset the action for fb select field
    });
	</script>
	<?php

	global $wpdb;
	$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
	
	require 'facebook/require.php'; //sec
	?>

	<div class="Generation_plugin">
	
	<div id="gpsaveinfo2" style="display:none">
		<?php if (!isset($_POST['generalformsent_settings']) && 
				  !isset($_POST['generalformsent_timemachine']) && 
				  !isset($_POST['generalformsent_statistics'])) { ?>
    		<script type="text/javascript">
    		var $jj = jQuery.noConflict();
             $jj(document).ready(function() {
             	//CONTENT
             	$jj("div.menu .menu_tabs:first").addClass("menu_tabs_active").show(); //Activate first tab
             	$jj("#pageloader2").fadeOut(0); //Hide loader
             	$jj("#gpsaveinfo2").fadeIn(0); //Show save info
             	$jj("#pagemenu2").delay(50).fadeIn(1500); //Show menu
             	$jj(".tab_content:first").delay(50).fadeIn(1500); //Show first tab content
             	//On Click Event
             	//Moved to functions.js
             });
    		</script>
		<?php } ?>
		
    	<?php if (isset($_POST['generalformsent_settings'])=='Save Changes') { ?>
    		<script type="text/javascript">
    		$jj(document).ready(function() {
    			$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
                $jj("#ttab11").addClass("menu_tabs_active");
                $jj(".tab_content").css('display','none');
                var activeTab2 = $jj("#ttab11").attr("href");
                $jj(activeTab2).delay(50).fadeIn(1500);
    			$jj("#pagemenu2").delay(50).fadeIn(1500);
    			$jj("#gpsaveinfo2").fadeIn(0);
    			$jj("#pageloader2").fadeOut(0);
        		$jj('#savemessage_general').delay(4800).fadeOut(800);
    		});
    		</script>
    		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_general" class="changessaved">CHANGES SAVED<br><span>for General Settings Page</span></div>
    	<?php } ?>
    	
    	<?php if (isset($_POST['generalformsent_timemachine'])=='Save Changes') { ?>
    		<script type="text/javascript">
    		$jj(document).ready(function() {
    			$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
                $jj("#ttab12").addClass("menu_tabs_active");
                $jj(".tab_content").css('display','none');
                var activeTab2 = $jj("#ttab12").attr("href");
                $jj(activeTab2).delay(50).fadeIn(1500);
    			$jj("#pagemenu2").delay(50).fadeIn(1500);
    			$jj("#gpsaveinfo2").fadeIn(0);
    			$jj("#pageloader2").fadeOut(0);
        		$jj('#savemessage_timemachine').delay(4800).fadeOut(800);
    		});
    		</script>
    		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_timemachine" class="changessaved">CHANGES SAVED<br><span>for Time Machine Page</span></div>
    	<?php } ?>
    	
    	<?php if (isset($_POST['generalformsent_statistics'])=='Save Changes') { ?>
    		<script type="text/javascript">
    		$jj(document).ready(function() {
    			$jj("div.menu .menu_tabs").removeClass("menu_tabs_active");
                $jj("#ttab13").addClass("menu_tabs_active");
                $jj(".tab_content").css('display','none');
                var activeTab2 = $jj("#ttab13").attr("href");
                $jj(activeTab2).delay(50).fadeIn(1500);
    			$jj("#pagemenu2").delay(50).fadeIn(1500);
    			$jj("#gpsaveinfo2").fadeIn(0);
    			$jj("#pageloader2").fadeOut(0);
        		$jj('#savemessage_statistics').delay(4800).fadeOut(800);
    		});
    		</script>
    		<div style="background:url(<?php echo GenerationPlugin_images.'/changessaved.png'; ?>) 15px center no-repeat rgba(204,255,204,0.8);" id="savemessage_statistics" class="changessaved">CHANGES SAVED<br><span>for Statistics Page</span></div>
    	<?php } ?>
	</div>
	
	<img class="menuimg" src="<?php echo GenerationPlugin_images.'/generation_generalsettings.png'; ?>">
    <h2>General settings</h2>

	<div id="pageloader2">
		<img src="<?php echo GenerationPlugin_images.'/pageloader.gif'; ?>">
	</div>

	<div id="left_section">
	
		<div class="menu" id="pagemenu2" style="display:none">
    		<a class="menu_tabs" id="ttab11" href="#tab11"><span class="but-desc"><strong>General</strong><br><em>settings</em></span></a>
    		<a class="menu_tabs" id="ttab12" href="#tab12"><span class="but-desc"><strong>Time</strong><br><em>machine</em></span></a>
        	<a href="<?php echo GP_helpdesk; ?>" target="_blank">
        		<img style="margin:0 0 0 165px" src="<?php echo GenerationPlugin_images.'/helpdesk.png'; ?>" title="HELPDESK">
        	</a>
   	 	</div><br/><br/>
		
		<?php
		if (facebookrequire=='positive') { //sec
    		include "_generalsettings.php";
    		include "_generaltimemachine.php";
		} else { ?>
    		<div class="left_section" style="width:1068px">
            	<h4>ACTIVATION</h4>
    			<p style="color:#222; line-height:15%">
    				Please follow all the steps below to license this copy of the Generation Plugin.
    			</p>
    			<p style="color:#777; line-height:150%; margin-top:30px">
    				1. Copy your website's url: <span style="color:#21759b; cursor:text"><?php echo get_home_url(); ?></span><br/>
    				2. Login to your <a href="http://www.generationplugin.com/login" target="_blank">members page</a>, paste it into
    				'Add license' input field there and click 'Save' button;<br>
    				3. Copy generated activation code from your members page;<br>
    				4. Back to THIS page, paste it into the input box below and click 'License this website' button.
    			</p>
    			<?php echo $secretid_msg_db.$secretid_msg; ?>
    			<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post">
    				<input name="activate" style="min-height:35px; padding-top:6px; color:#777" type="submit" value="License this website">
    				<input name="secretid" style="float:left; min-height:35px; padding:3px 7px" type="text">
    			</form>
    			<p style="color:#777; line-height:150%">
    				<span style="color:red">IMPORTANT: </span>
    				If you have just updated the plugin on this blog (this is not first installation),
    				<br>please go to 'Plugins' page and deactivate and activate the Generation Plugin again, 
    				<br>otherwise you'll not be able to license the plugin.
    			</p>
    			<p style="color:#777; line-height:150%">
    				<span style="color:red">IMPORTANT: </span>
    				Please use email address from your members dashboard when contacting our helpdesk with
    				<br>technical questions or issues. We can help you only when we are sure that you are
    				<br>registered and legal user of the plugin.
    			</p>
    		</div>
		<?php } ?>

		<script type="text/javascript">
        var $jj = jQuery.noConflict();
		if ($jj("#gpkeepuserdetails_test").val()=="on") {
        	//save user data to cookies
            $jj("#GenerationPlugin_generalform").submit(function(){
            	var gpmydetails = $jj("#gpuserinput_test").val() + '|' + $jj("#gpemailinput_test").val();
                $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10});
        	});
		}
		</script>

	</div>
	</div>
<?php } ?>
