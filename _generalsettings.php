		<div id="tab11" class="tab_content" style="display:none; padding:0!important">
		
		<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post"  enctype="multipart/form-data">

		<?php
		$gp_optin = str_replace("|",":::",$_POST['gp_optin1'])."|".$_POST['gp_optin2']."|".$_POST['gp_optin3']."|".$_POST['gp_optin4']."|".$_POST['gp_optin5']."|".$_POST['gp_optin6']."|".$_POST['gp_optin7']."|".$_POST['gp_optin8']."|".$_POST['gp_optin9'];
        $gp_optin = str_replace(array("\r\n", "\r", "\n"), '<br>', $gp_optin);
    	$gp_fbook = $_POST['gp_fb1']."|".$_POST['gp_fb2']."|".$_POST['gp_fb3']."|".$_POST['gp_fb4']."|".$_POST['gp_fb5']."|".$_POST['gp_fb6']."|".$_POST['gp_fb7']."|".$_POST['gp_fb8']."|".$_POST['gp_fb9']."|".$_POST['gp_fb10'];
    	$gp_d56 = $_POST['gp_d5'].'|'.$_POST['gp_d6'];
    	
    	if (isset($_POST['generalformsent_settings'])=='Save Changes' && !isset($_POST['testbutton'])) {
    		$Affiliate = $_POST['Affiliate1'].'|'.$_POST['Affiliate2'];
    		$wpdb->update($table_name_general, 
    			array('Autoins'=>trim($_POST['Autoins']),
    				  'Livecheck'=>trim($_POST['Livecheck']),
    				  'Affiliate'=>trim($Affiliate),
    				  'License'=>trim($_POST['License']),
    				  'Regular'=>trim($gp_optin),
    				  'Social'=>trim($gp_fbook),
    				  'Dontshowagain'=>trim($_POST['gp_d1']),
    				  'Poweredby'=>trim($_POST['gp_d2']),
    				  'Minutes'=>trim($_POST['gp_d3']),
    				  'Seconds'=>trim($_POST['gp_d4']),
    				  'Switch'=>trim($gp_d56),
    				  'Jqueryfix'=>trim($_POST['jqueryfix']),
    				  'Cookies'=>trim($_POST['gp_dsacookie'])
    			), 
    			array('id'=>'1')
    		);
    	}
    	$DAutoins = $wpdb->get_var('SELECT Autoins FROM '.$table_name_general.' WHERE id=1');
    	$DLivecheck = $wpdb->get_var('SELECT Livecheck FROM '.$table_name_general.' WHERE id=1');
    	$DAffiliate = $wpdb->get_var('SELECT Affiliate FROM '.$table_name_general.' WHERE id=1');
    	$gp_d1 = $wpdb->get_var('SELECT Dontshowagain FROM '.$table_name_general.' WHERE id=1');
    		$gp_d1 = preg_replace("/\\\/","",$gp_d1);
    		if ($gp_d1=="") {$gp_d1 = "Don't show again";} //default
    	$gp_d2 = $wpdb->get_var('SELECT Poweredby FROM '.$table_name_general.' WHERE id=1');
    		$gp_d2 = preg_replace("/\\\/","",$gp_d2);
    		if ($gp_d2=="") {$gp_d2 = "Proudly Powered By Generation Plugin";} //default
    	$gp_d3 = $wpdb->get_var('SELECT Minutes FROM '.$table_name_general.' WHERE id=1');
    		$gp_d3 = preg_replace("/\\\/","",$gp_d3);
    		if ($gp_d3=="") {$gp_d3 = "Minutes";} //default
    	$gp_d4 = $wpdb->get_var('SELECT Seconds FROM '.$table_name_general.' WHERE id=1');
    		$gp_d4 = preg_replace("/\\\/","",$gp_d4);
    		if ($gp_d4=="") {$gp_d4 = "Seconds";} //default
    	$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
    		$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
    		$gp_d56 = explode("|", $gp_d56_tmp);
    		$gp_d5 = $gp_d56[0];
    		$gp_d6 = $gp_d56[1];
    		if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
    		if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default
    	$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    		if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
    
    	if ($DAutoins=='on') { $SAutoins='checked'; }
    	if ($DLivecheck=='on') { $SLivecheck='checked'; }
    	$DAffiliate = explode('|',$DAffiliate);
    	if ($DAffiliate[0]=='on') { $SAffiliate='checked'; }
    	$SAffiliatelink = $DAffiliate[1];
    	if (trim($SAffiliatelink)=='Insert Your Affiliate Link' || trim($SAffiliatelink)=='') { 
    		$DAffiliatelink='Insert Your Affiliate Link';
    	} else {
    		$DAffiliatelink=$SAffiliatelink;
    	}
    	
    	$Dgp_optin = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_general.' WHERE id=1'));
    	$Dgp_optin = preg_replace("/<br>/","\n",$Dgp_optin);
    	$Dgp_optin = preg_replace("/\\\/","",$Dgp_optin);
    	$Dgp_optin = explode("|",$Dgp_optin);
    	
    	$Dgp_social_tmp = stripslashes($wpdb->get_var('SELECT Social FROM '.$table_name_general.' WHERE id=1'));
    	$Dgp_social_tmp = preg_replace("/\\\/","",$Dgp_social_tmp);
    	$Dgp_social = explode("|", $Dgp_social_tmp);
    	$gp_fb1 = $Dgp_social[0];
    	$gp_fb2 = $Dgp_social[1];
    	$gp_fb3 = $Dgp_social[2];
    	$gp_fb4 = $Dgp_social[3];
    	$gp_fb5 = $Dgp_social[4];
    	$gp_fb6 = $Dgp_social[5];
    	$gp_fb7 = $Dgp_social[6];
    	$gp_fb8 = $Dgp_social[7];
    	$gp_fb9 = $Dgp_social[8];
    	$gp_fb10 = $Dgp_social[9];
    	
    	$Jqueryfix = stripslashes($wpdb->get_var('SELECT Jqueryfix FROM '.$table_name_general.' WHERE id=1'));
    	if ($Jqueryfix=='on') { $Jqueryfix_ch='checked'; }
    	
    	$testbtntxt="SUBSCRIBE";
    	if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
    		$gpmydatatestcookie = explode("|",$_COOKIE['gpmydetails']);
    		$testname = $gpmydatatestcookie[0];
    		$testemail = $gpmydatatestcookie[1];
    	} else {
    		$testname = "Insert Your Name";
    		$testemail = "Insert Your Email";
    	}
    	
    	if ($DLivecheck=='on') {
    		?>
    		<script type="text/javascript">
            	var $jj = jQuery.noConflict();
        		$jj(document).ready(function(){
             		var user = $jj("#gpuserinput_test").val();
             		var email = $jj("#gpemailinput_test").val();
            		if(isValidUser_test(user) && isValidEmailAddress_test(email)) {
        				$jj("#gpuserinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
        				$jj("#gpemailinput_test").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
        				document.getElementById('verified_test').type="submit";
        			}
        		});
    		</script>
    		<?php
    		$testnameinput='onkeyup="isValidUserCHECK_test();" onblur="isValidUserCHECK_test();" onclick="isValidUserCHECK_test();" onfocus="isValidUserCHECK_test();"';
    		$testemailinput='onkeyup="isValidEmailCHECK_test();" onblur="isValidEmailCHECK_test();" onclick="isValidEmailCHECK_test();" onfocus="isValidEmailCHECK_test();"';
    		$testformbtn='button';
    	} else {
    		$testnameinput='';
    		$testemailinput='';
    		$testformbtn='submit';
    	}
    	?>
		
    	<input type="hidden" name="License" value="Multisite">
    	<input type="hidden" name="done" value="processed">
		<input type="hidden" id="gpkeepuserdetails_test" value="<?php echo $DAutoins; ?>">
		<input type="hidden" name="generalformsent">
		
		<div style="display:table-row">
		<div style="background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center">
				Forms settings
			</div>
			<span class="gendesc">
				<input name="Livecheck" type="checkbox" <?php echo $SLivecheck; ?>> Live checking<br/>
				<input name="Autoins" type="checkbox" <?php echo $SAutoins; ?>> Visitor's details in forms
				<p style="margin-top:10px; margin-bottom:0px">Test these features in form below.</p>
			</span>
    		<input <?php echo $testnameinput; ?> name="testname" value="<?php echo $testname; ?>" class="testinput" style="margin-top:9px; background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>'); width:212px!important; min-width:212px!important; max-width:212px!important" type="text" id="gpuserinput_test" /><br/>
    		<input <?php echo $testemailinput; ?> name="testemail" value="<?php echo $testemail; ?>" class="testinput" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>'); width:212px!important; min-width:212px!important; max-width:212px!important" type="text" id="gpemailinput_test" /><br/>
    		<input name="testbutton" class="testbutton" style="background-image:url('<?php echo GenerationPlugin_images.'/btn/red.gif'; ?>');" type="<?php echo $testformbtn; ?>" id="verified_test" value="<?php echo $testbtntxt; ?>">
		</div>
		<div style="background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center;">
				Affiliate icon
			</div>
			<span class="gendesc">
				<input name="Affiliate1" type="checkbox" <?php echo $SAffiliate; ?>> Affiliate link<br/>
				<p>Adds an icon at the bottom right corner of the page. You will earn comissions every time someone clicks that link and buys the plugin.</p>
				<!-- 
				<p style="margin-bottom:22px">Sign-up to <a href="https://www.clickbank.com/affiliateAccountSignup.htm" target="_blank">Clickbank</a> first (for free).</p>
				-->
			</span>
			<p style="text-align:center; margin-top:0px; margin-bottom:15px">
				<a href="http://generationplugin.com/affiliates" target="_blank">Click here to read details<br/>about our affiliate program</a>
			</p>
  			<input class="testinput" style="height:38px" name="Affiliate2" type="text" value="<?php echo $DAffiliatelink; ?>" >
		</div>
		<div style="width:472px; background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center; width:442px!important">
				Fixed values and cookies
			</div>
   			<span class="gendesc">
			<textarea id="gp_d1" style="width:250px" type="text" name="gp_d1"><?php echo $gp_d1; ?></textarea>
			"Don't show again" checkboxes<br/>
			<textarea id="gp_d2" style="width:250px" type="text" name="gp_d2"><?php echo $gp_d2; ?></textarea>
			"Proudly Powered By" label<br/>
			<textarea id="gp_d3" style="width:250px" type="text" name="gp_d3"><?php echo $gp_d3; ?></textarea>
			"Minutes" in countdown timer<br/>
			<textarea id="gp_d4" style="width:250px" type="text" name="gp_d4"><?php echo $gp_d4; ?></textarea>
			"Seconds" in countdown timer<br/>
			<textarea id="gp_d5" style="width:250px" type="text" name="gp_d5"><?php echo $gp_d5; ?></textarea>
			"Regular" in form switch<br/>
			<textarea id="gp_d6" style="width:250px" type="text" name="gp_d6"><?php echo $gp_d6; ?></textarea>
			"Facebook" in form switch<br/>
			<input id="gp_dsacookie" class="m8px" style="width:37px" type="text" name="gp_dsacookie" value="<?php echo $gp_dsacookie; ?>">
			"Don't show again" cookie life period in days<br/>
			</span>
		</div>
		</div>
		
		<div style="display:table-row">
		<div style="width:472px; background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center; width:442px!important">
				Facebook wall post map
			</div>
			<span class="gendesc">
				This is an image instruction for 'Facebook wall post' settings in next box.
			</span><br/>
			<div style="text-align:center; margin-top:7px">
				<img src="<?php echo GenerationPlugin_images.'/facebookpostmap.jpg'; ?>">
			</div>
		</div>
		<div style="width:472px; background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center; width:442px!important">
				Facebook wall post
			</div>
			<span class="gendesc">
    			<textarea style="width:374px; margin-top:0" name="gp_fb4" id="gp_fb4"><?php echo $gp_fb4; ?></textarea>
    			<span style="color:#C00"> Wall message</span><br/>
    			<p style="margin-bottom:0; color:#CC0">Optional fields:</p>
    			<textarea style="width:374px" name="gp_fb6" id="gp_fb6"><?php echo $gp_fb6; ?></textarea>
    			<span style="color:#C60"> Picture url</span><br/>
    			<textarea style="width:374px" name="gp_fb7" id="gp_fb7"><?php echo $gp_fb7; ?></textarea>
    			<span style="color:#369"> Link</span><br/>
    			<textarea style="width:374px" name="gp_fb8" id="gp_fb8"><?php echo $gp_fb8; ?></textarea>
    			<span style="color:#369"> Name</span><br/>
    			<textarea style="width:374px" name="gp_fb9" id="gp_fb9"><?php echo $gp_fb9; ?></textarea>
    			<span style="color:#390"> Caption</span><br/>
    			<textarea style="width:374px" name="gp_fb10" id="gp_fb10"><?php echo $gp_fb10; ?></textarea>
    			<span style="color:#939"> Description</span><br/>
			</span>
		</div>
		</div>
		
		<div style="display:table-row">
		<div style="width:472px; background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center; width:442px!important">
				Facebook opt-in form
			</div>
			<div style="margin-top:-10px!important">
       			<span class="gendesc">
    			<textarea style="border:1px solid #09C; width:302px" name="gp_optin1" id="gpoptinform_gp"><?php echo str_replace(":::","|",$Dgp_optin[0]); ?></textarea>
                <input style="width:68px" style="float:left" type="button" value="Process" id="gpproccessit_gp"> Opt-in code<br/>
                <div id="gpformarea_gp" style="display:none"></div>
                <select style="width:374px; height:23px" name="gp_optin2" id="gpnamefield_gp">
        			<option value="<?php echo $Dgp_optin[1]; ?>"><?php echo $Dgp_optin[1]; ?></option>
        		</select> 'NAME' fields
                <select style="width:374px; height:23px" name="gp_optin3" id="gpemailfield_gp">
        			<option value="<?php echo $Dgp_optin[2]; ?>"><?php echo $Dgp_optin[2]; ?></option>
        		</select> 'EMAIL' fields
                <!-- <input name="gp_optin4" value="on" type="checkbox" id="gpdisablename_gp" <?php echo $Dgp_optinch; ?>> disable NAME field<br/> -->
                <textarea style="width:374px" class="m1px" name="gp_optin5" id="gpformaction_gp"><?php echo $Dgp_optin[4]; ?></textarea> form action<br/>
                <textarea style="width:374px" name="gp_optin6" id="gphiddenfields_gp"><?php echo $Dgp_optin[5]; ?></textarea> hidden fields<br/>
                <textarea style="width:374px" name="gp_optin7" id="gpignoredfields_gp"><?php echo $Dgp_optin[6]; ?></textarea> ignored fields<br/>
                <textarea style="width:374px" name="gp_optin8" id="gpotherfields_gp"><?php echo $Dgp_optin[7]; ?></textarea> other fields<br/>
                <textarea style="width:374px" name="gp_optin9" id="gpsubmitbutton_gp"><?php echo $Dgp_optin[8]; ?></textarea> submit button<br/>
    			</span>
			</div>
		</div>
		<div style="background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center">
				Facebook app settings
			</div>
   			<span class="gendesc">
			App ID<textarea class="m1px" style="margin-bottom:3px; width:218px" name="gp_fb1"><?php echo $gp_fb1; ?></textarea><br/>
			App Secret<textarea class="m1px" style="margin-bottom:3px; width:218px" name="gp_fb2"><?php echo $gp_fb2; ?></textarea><br/>
			Site URL<input onkeydown="select();" onclick="select();" id="fbselect" style="width:218px" type="text" name="gp_fb3" value="<?php echo GenerationPlugin_path.'facebook.php'; ?>"><br/>
			Redirect to url (instead opt-in)<textarea class="m1px" style="border:1px solid #09C; width:218px" name="gp_fb5"><?php echo $gp_fb5; ?></textarea>
			</span>
		</div>
		<div style="background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center">
				External resources
			</div>
   			<span class="gendesc">
				Third party tools that I personally use and highly recommend:
			</span>
			<p style="text-align:center; line-height:170%; margin-top:12px">
				<a href="http://befe6f0gbz4v7s02jx0ncp6xee.hop.clickbank.net/" target="_blank">Traffic Black Book 2.0</a><br/>
				<a href="http://pro3000.lifestyles.hop.clickbank.net/" target="_blank">Directory Of Ezines</a><br/>
				<a href="http://www.getresponse.com/index/Zado" target="_blank">Get Response</a><br/>
				<a href="http://discount.safe-swaps.com/samzadworny" target="_blank">Safe Swaps</a>
			</p>
		</div>
		<!--
		<div class="generalbox">
			<div class="gactivate" style="text-align:center">
				More settings
			</div>
   			<span class="gendesc">
				<p style="font-size:36px; font-weight:bold; color:#EEE; text-align:center; line-height:110%">
					<br/>COMING<br/>SOON
				</p>
			</span>
		</div>
		-->
		</div>
		
		<div style="position:absolute; margin-top:-1010px; left:230px; height:56px; z-index:999" class="saveasonhover">
    		<input name="generalformsent_settings" type="hidden" value="Save Changes">
    		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
		</div>
				
		</form>
		</div> 