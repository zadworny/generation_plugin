<?php
if ($_GET['t']=="r") { session_start(); $_SESSION['fbtype']='registration'; }
require_once("facebook/facebook.php");
require_once('../../../wp-config.php');

global $wpdb;
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$Dgp_social_tmp = stripslashes($wpdb->get_var('SELECT Social FROM '.$table_name_general.' WHERE id=1'));
	$Dgp_social_tmp = preg_replace("/\\\/","",$Dgp_social_tmp);
$Dgp_social = explode("|", $Dgp_social_tmp);

$config = array();
$config['appId'] = $Dgp_social[0]; //1.App ID
$config['secret'] = $Dgp_social[1]; //2.App Secret
$config['cookie'] = 'true';

$facebook = new Facebook($config);
$site_url = $Dgp_social[2]; //3.Site URL
$fbpostonwall = $Dgp_social[3]; //4.Wall message (optional)
$fbredirect = $Dgp_social[4]; //5.Redirect to page (optional)
$fbpicture = $Dgp_social[5];
$fblink = $Dgp_social[6];
$fbname = $Dgp_social[7];
$fbcaption = $Dgp_social[8];
$fbdescription = $Dgp_social[9];

$parameters = array(
   'message' => $fbpostonwall,
   'picture' => $fbpicture,
   'link' => $fblink,
   'name' => $fbname,
   'caption' => $fbcaption,
   'description' => $fbdescription
);
$parameters['access_token'] = $_SESSION['active']['access_token'];

$user = $facebook->getUser();
if ($user) {
	try {
    	$user_profile = $facebook->api('/me');
  	} catch (FacebookApiException $e) {
    	error_log($e);
    	$user = null;
  	}
}
if ($user) {
  	//$logoutUrl = $facebook->getLogoutUrl();
  	//print '<img src="https://graph.facebook.com/'.$user.'/picture">'; print_r($user_profile);
	$fbname = $user_profile['first_name'];
	$fbemail = $user_profile['email'];
	if ($fbpostonwall!='' && isset($_GET['state']) && isset($_GET['code'])) {
    	try{
        	$statusUpdate = $facebook->api("/me/feed", 'post', $parameters);
        }catch(FacebookApiException $e){
        	error_log($e);
        }
	}
} else {
	if ($fbpostonwall!='') {
      	$loginUrl = $facebook->getLoginUrl(array(
    		'scope'	=> 'publish_stream, email',
    		'redirect_uri' => $site_url
    	));
	} else {
      	$loginUrl = $facebook->getLoginUrl(array(
    		'scope'	=> 'email',
    		'redirect_uri' => $site_url
    	));
	}
	header('Location:'.$loginUrl);
}

if (isset($_GET['state']) && isset($_GET['code'])) {
    $Dgp_optin_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_general.' WHERE id=1'));
	$detectifoptin = explode("|",$Dgp_optin_tmp);
    if (trim($detectifoptin[0])=="") {
	 	$fbsign="ignoreregular";
	} else { 
		$fbsign="doregular";
        $Dgp_optin_tmp = preg_replace("/\\\/","",$Dgp_optin_tmp);
        $Dgp_optin = explode("|", $Dgp_optin_tmp);
        $Dgp_submit=$Dgp_regular[8]; //temp
        if ($Dgp_submit=='submit') { $Dgp_submit='send'; }
    } ?>
	
	<?php if ($_SESSION['fbtype']=='registration') { session_destroy(); ?>
	<form style="display:none" id="fbform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
    	<input type="text" value="<?php echo $fbname; ?>" name="user_login" />
        <input type="text" value="<?php echo $fbemail; ?>" name="user_email" />
        <?php do_action('register_form'); ?>
        <input type="submit" value="register" />
    </form>
	<?php } else { ?>
	<form style="display:none" id="fbform" action="<?php echo $Dgp_optin[4]; ?>" method="post">
    	<?php echo $Dgp_optin[5]; ?>
        <input name="<?php echo $Dgp_optin[1]; ?>" type="text" value="<?php echo $fbname; ?>" />
        <input name="<?php echo $Dgp_optin[2]; ?>" type="text" value="<?php echo $fbemail; ?>" />
    	<?php echo $Dgp_optin[7]; ?>
    	<input name="<?php echo $Dgp_submit; ?>" type="submit" value="send" />
    </form>
	<?php } ?>
    
	<span>redirecting...</span>
	
	<?php if ($fbsign=="doregular") { ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
        var $jj = jQuery.noConflict();
        $jj("#fbform").submit();
        </script>
	<?php } elseif ($fbsign=="ignoreregular" && $fbredirect!="") {
		echo '<meta http-equiv="refresh" content="0;url='.$fbredirect.'">';
	}
}

if ($user && !isset($_GET['state']) && !isset($_GET['code'])) { ?>
	<script type="text/javascript">
    <!--
	alert('Hey, you are already subscribed!\nDid you check your inbox?');
    setTimeout("self.close();");
    //--> 
    </script>
<?php } ?>