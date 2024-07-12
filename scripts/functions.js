var $jj = jQuery.noConflict();


<!-- TABS.JS ONCLICK EVENT -->
$jj("div.menu .menu_tabs").click(function() {
	$jj("div.menu .menu_tabs").removeClass("menu_tabs_active"); //Remove any "active" class
	$jj(this).addClass("menu_tabs_active"); //Add "active" class to selected tab
	$jj(".tab_content").css('display','none'); //Hide all tab content
	var activeTab = $jj(this).attr("href"); //Find the href attribute value to identify the active tab + content
	$jj(activeTab).fadeIn(); //Fade in the active ID content
	return false;
});
	
	
<!-- SHOW / HIDE DIV PANELS -->
$jj(document).ready(function(){
	$jj(".advanced_section .toggle").hide(); $jj(".advanced_section .hiddens").click(function(){ 	
		$jj(this).toggleClass("active").next().slideToggle("slow"); 
	});
	$jj(".right_section .toggle").hide(); $jj(".right_section .hiddens").click(function(){ 	
		$jj(this).toggleClass("active").next().slideToggle("slow"); 
	});
});


<!-- CHECK / UNCHECK ALL CHECKBOXES IN 'DISPLAYING SETTINGS' -->
$jj(document).ready(function(){
	$jj('#popup_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#popup_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
	$jj('#slider_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#slider_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
	$jj('#header_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#header_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
	$jj('#footer_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#footer_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
	$jj('#regular_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#regular_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
	$jj('#inside_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#inside_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
	$jj('#reg_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#reg_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
	$jj('#exit_checkboxes_switch').on('click',function(){
		$jj('input[type=checkbox]','#exit_checkboxes').prop('checked',$jj(this).prop('checked'));
	});
});


<!-- SHOW / HIDE DIV ON SELECT -->
<!-- button section -->
function sh1(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='2') {
		document.getElementById("choice10").style.display="block";
		document.getElementById("xchoice11").style.display="none";
        document.getElementById("ichoice10").style.display="block";
        document.getElementById("ichoice11").style.display="none";
        document.getElementById("ichoice12").style.display="none";
		document.getElementById("right_choice10").style.display="block";
		document.getElementById("Popup_adsection").style.display="block";
		document.getElementById("Popup_adsection2").style.display="block";
		document.getElementById("Popup_buttonss").style.display="block";
		document.getElementById("selectpopup").style.display="inline";
		document.getElementById("selectpopup_label").style.display="inline";
		document.getElementById("popup1").style.display="block";
		document.getElementById("popup2").style.display="none";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice10").style.display="none";
		document.getElementById("xchoice11").style.display="none";
        document.getElementById("ichoice10").style.display="none";
        document.getElementById("ichoice11").style.display="none";
        document.getElementById("ichoice12").style.display="none";
		document.getElementById("right_choice10").style.display="none";
		document.getElementById("Popup_adsection").style.display="block";
		document.getElementById("Popup_adsection2").style.display="block";
		document.getElementById("Popup_buttonss").style.display="block";
		document.getElementById("selectpopup").style.display="inline";
		document.getElementById("selectpopup_label").style.display="inline";
		document.getElementById("popup1").style.display="block";
		document.getElementById("popup2").style.display="none";
	} else if(sel.selectedIndex=='3') {
    	document.getElementById("choice10").style.display="block";
		document.getElementById("xchoice11").style.display="none";
        document.getElementById("ichoice10").style.display="none";
        document.getElementById("ichoice11").style.display="block";
        document.getElementById("ichoice12").style.display="none";
		document.getElementById("right_choice10").style.display="none";
		document.getElementById("Popup_adsection").style.display="block";
		document.getElementById("Popup_adsection2").style.display="block";
		document.getElementById("Popup_buttonss").style.display="block";
		document.getElementById("selectpopup").style.display="inline";
		document.getElementById("selectpopup_label").style.display="inline";
		document.getElementById("popup1").style.display="block";
		document.getElementById("popup2").style.display="none";
	} else if(sel.selectedIndex=='4') {
    	document.getElementById("choice10").style.display="none";
		document.getElementById("xchoice11").style.display="block";
        document.getElementById("ichoice10").style.display="none";
        document.getElementById("ichoice11").style.display="none";
        document.getElementById("ichoice12").style.display="block";
		document.getElementById("right_choice10").style.display="none";
		document.getElementById("Popup_adsection").style.display="none";
		document.getElementById("Popup_adsection2").style.display="none";
		document.getElementById("Popup_buttonss").style.display="none";
		document.getElementById("selectpopup").style.display="none";
		document.getElementById("selectpopup_label").style.display="none";
		document.getElementById("popup1").style.display="none";
		document.getElementById("popup2").style.display="block";
	}
}
function sh2(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='2') {
		document.getElementById("choice20").style.display="block";
		document.getElementById("xchoice21").style.display="none";
        document.getElementById("ichoice20").style.display="block";
        document.getElementById("ichoice21").style.display="none";
        document.getElementById("ichoice22").style.display="none";
		document.getElementById("right_choice20").style.display="block";
		document.getElementById("Slider_adsection").style.display="block";
		document.getElementById("Slider_adsection2").style.display="block";
		document.getElementById("Slider_buttonss").style.display="block";
		document.getElementById("selectslider").style.display="inline";
		document.getElementById("selectslider_label").style.display="inline";
		document.getElementById("slider1").style.display="block";
		document.getElementById("slider2").style.display="none";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice20").style.display="none";
		document.getElementById("xchoice21").style.display="none";
        document.getElementById("ichoice20").style.display="none";
        document.getElementById("ichoice21").style.display="none";
        document.getElementById("ichoice22").style.display="none";
		document.getElementById("right_choice20").style.display="none";
		document.getElementById("Slider_adsection").style.display="block";
		document.getElementById("Slider_adsection2").style.display="block";
		document.getElementById("Slider_buttonss").style.display="block";
		document.getElementById("selectslider").style.display="inline";
		document.getElementById("selectslider_label").style.display="inline";
		document.getElementById("slider1").style.display="block";
		document.getElementById("slider2").style.display="none";
	} else if(sel.selectedIndex=='3') {
    	document.getElementById("choice20").style.display="block";
		document.getElementById("xchoice21").style.display="none";
        document.getElementById("ichoice20").style.display="none";
        document.getElementById("ichoice21").style.display="block";
        document.getElementById("ichoice22").style.display="none";
		document.getElementById("right_choice20").style.display="none";
		document.getElementById("Slider_adsection").style.display="block";
		document.getElementById("Slider_adsection2").style.display="block";
		document.getElementById("Slider_buttonss").style.display="block";
		document.getElementById("selectslider").style.display="inline";
		document.getElementById("selectslider_label").style.display="inline";
		document.getElementById("slider1").style.display="block";
		document.getElementById("slider2").style.display="none";
	} else if(sel.selectedIndex=='4') {
    	document.getElementById("choice20").style.display="none";
		document.getElementById("xchoice21").style.display="block";
        document.getElementById("ichoice20").style.display="none";
        document.getElementById("ichoice21").style.display="block";
        document.getElementById("ichoice22").style.display="block";
		document.getElementById("right_choice20").style.display="none";
		document.getElementById("Slider_adsection").style.display="none";
		document.getElementById("Slider_adsection2").style.display="none";
		document.getElementById("Slider_buttonss").style.display="none";
		document.getElementById("selectslider").style.display="none";
		document.getElementById("selectslider_label").style.display="none";
		document.getElementById("slider1").style.display="none";
		document.getElementById("slider2").style.display="block";
	}
}
function sh3(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("choice30").style.display="block";
		document.getElementById("xchoice31").style.display="none";
        document.getElementById("ichoice30").style.display="block";
        document.getElementById("ichoice31").style.display="none";
        document.getElementById("ichoice32").style.display="none";
		document.getElementById("right_choice30").style.display="block";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_buttonss").style.display="block";
		document.getElementById("selectheader").style.display="inline";
		document.getElementById("selectheader_label").style.display="inline";
		document.getElementById("header1").style.display="block";
		document.getElementById("header2").style.display="none";
		document.getElementById("Header_h2header").style.display="block";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice30").style.display="none";
		document.getElementById("xchoice31").style.display="none";
        document.getElementById("ichoice30").style.display="none";
        document.getElementById("ichoice31").style.display="none";
        document.getElementById("ichoice32").style.display="none";
		document.getElementById("right_choice30").style.display="none";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_buttonss").style.display="block";
		document.getElementById("selectheader").style.display="inline";
		document.getElementById("selectheader_label").style.display="inline";
		document.getElementById("header1").style.display="block";
		document.getElementById("header2").style.display="none";
		document.getElementById("Header_h2header").style.display="block";
	} else if(sel.selectedIndex=='2') {
		document.getElementById("choice30").style.display="block";
		document.getElementById("xchoice31").style.display="none";
        document.getElementById("ichoice30").style.display="block";
        document.getElementById("ichoice31").style.display="none";
        document.getElementById("ichoice32").style.display="none";
		document.getElementById("right_choice30").style.display="block";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_buttonss").style.display="block";
		document.getElementById("selectheader").style.display="inline";
		document.getElementById("selectheader_label").style.display="inline";
		document.getElementById("header1").style.display="block";
		document.getElementById("header2").style.display="none";
		document.getElementById("Header_h2header").style.display="none";
	} else if(sel.selectedIndex=='3') {
    	document.getElementById("choice30").style.display="block";
		document.getElementById("xchoice31").style.display="none";
        document.getElementById("ichoice30").style.display="none";
        document.getElementById("ichoice31").style.display="block";
        document.getElementById("ichoice32").style.display="none";
		document.getElementById("right_choice30").style.display="none";
		document.getElementById("Header_adsection").style.display="block";
		document.getElementById("Header_buttonss").style.display="block";
		document.getElementById("selectheader").style.display="inline";
		document.getElementById("selectheader_label").style.display="inline";
		document.getElementById("header1").style.display="block";
		document.getElementById("header2").style.display="none";
		document.getElementById("Header_h2header").style.display="block";
	} else if(sel.selectedIndex=='4') {
    	document.getElementById("choice30").style.display="none";
		document.getElementById("xchoice31").style.display="block";
        document.getElementById("ichoice30").style.display="none";
        document.getElementById("ichoice31").style.display="none";
        document.getElementById("ichoice32").style.display="block";
		document.getElementById("right_choice30").style.display="none";
		document.getElementById("Header_adsection").style.display="none";
		document.getElementById("Header_buttonss").style.display="none";
		document.getElementById("selectheader").style.display="none";
		document.getElementById("selectheader_label").style.display="none";
		document.getElementById("header1").style.display="none";
		document.getElementById("header2").style.display="block";
		document.getElementById("Header_h2header").style.display="block";
	}
}
function sh4(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='2') {
		document.getElementById("choice40").style.display="block";
		document.getElementById("xchoice41").style.display="none";
        document.getElementById("ichoice40").style.display="block";
        document.getElementById("ichoice41").style.display="none";
        document.getElementById("ichoice42").style.display="none";
		document.getElementById("right_choice40").style.display="block";
		document.getElementById("Footer_adsection").style.display="block";
		document.getElementById("Footer_buttonss").style.display="block";
		document.getElementById("selectfooter").style.display="inline";
		document.getElementById("selectfooter_label").style.display="inline";
		document.getElementById("footer1").style.display="block";
		document.getElementById("footer2").style.display="none";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice40").style.display="none";
		document.getElementById("xchoice41").style.display="none";
        document.getElementById("ichoice40").style.display="none";
        document.getElementById("ichoice41").style.display="none";
        document.getElementById("ichoice42").style.display="none";
		document.getElementById("right_choice40").style.display="none";
		document.getElementById("Footer_adsection").style.display="block";
		document.getElementById("Footer_buttonss").style.display="block";
		document.getElementById("selectfooter").style.display="inline";
		document.getElementById("selectfooter_label").style.display="inline";
		document.getElementById("footer1").style.display="block";
		document.getElementById("footer2").style.display="none";
	} else if(sel.selectedIndex=='3') {
    	document.getElementById("choice40").style.display="block";
		document.getElementById("xchoice41").style.display="none";
        document.getElementById("ichoice40").style.display="none";
        document.getElementById("ichoice41").style.display="block";
        document.getElementById("ichoice42").style.display="none";
		document.getElementById("right_choice40").style.display="none";
		document.getElementById("Footer_adsection").style.display="block";
		document.getElementById("Footer_buttonss").style.display="block";
		document.getElementById("selectfooter").style.display="inline";
		document.getElementById("selectfooter_label").style.display="inline";
		document.getElementById("footer1").style.display="block";
		document.getElementById("footer2").style.display="none";
	} else if(sel.selectedIndex=='4') {
    	document.getElementById("choice40").style.display="none";
		document.getElementById("xchoice41").style.display="block";
        document.getElementById("ichoice40").style.display="none";
        document.getElementById("ichoice41").style.display="none";
        document.getElementById("ichoice42").style.display="block";
		document.getElementById("right_choice40").style.display="none";
		document.getElementById("Footer_adsection").style.display="none";
		document.getElementById("Footer_buttonss").style.display="none";
		document.getElementById("selectfooter").style.display="none";
		document.getElementById("selectfooter_label").style.display="none";
		document.getElementById("footer1").style.display="none";
		document.getElementById("footer2").style.display="block";
	}
}
function sh5(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='2') {
		document.getElementById("choice50").style.display="block";
		document.getElementById("xchoice51").style.display="none";
        document.getElementById("ichoice50").style.display="block";
        document.getElementById("ichoice51").style.display="none";
        document.getElementById("ichoice52").style.display="none";
		document.getElementById("right_choice50").style.display="block";
		document.getElementById("Exit_adsection").style.display="block";
		document.getElementById("Exit_buttonss").style.display="block";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice50").style.display="none";
		document.getElementById("xchoice51").style.display="none";
        document.getElementById("ichoice50").style.display="none";
        document.getElementById("ichoice51").style.display="none";
        document.getElementById("ichoice52").style.display="none";
		document.getElementById("right_choice50").style.display="none";
		document.getElementById("Exit_adsection").style.display="block";
		document.getElementById("Exit_buttonss").style.display="block";
	} else if(sel.selectedIndex=='3') {
    	document.getElementById("choice50").style.display="block";
		document.getElementById("xchoice51").style.display="none";
        document.getElementById("ichoice50").style.display="none";
        document.getElementById("ichoice51").style.display="block";
        document.getElementById("ichoice52").style.display="none";
		document.getElementById("right_choice50").style.display="none";
		document.getElementById("Exit_adsection").style.display="block";
		document.getElementById("Exit_buttonss").style.display="block";
	} else if(sel.selectedIndex=='4') {
    	document.getElementById("choice50").style.display="none";
		document.getElementById("xchoice51").style.display="block";
        document.getElementById("ichoice50").style.display="none";
        document.getElementById("ichoice51").style.display="none";
        document.getElementById("ichoice52").style.display="block";
		document.getElementById("right_choice50").style.display="none";
		document.getElementById("Exit_adsection").style.display="none";
		document.getElementById("Exit_buttonss").style.display="none";
	}
}
function sh6(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='2') {
		document.getElementById("choice60").style.display="block";
		document.getElementById("xchoice61").style.display="none";
        document.getElementById("ichoice60").style.display="block";
        document.getElementById("ichoice61").style.display="none";
        document.getElementById("ichoice62").style.display="none";
		document.getElementById("right_choice60").style.display="block";
		document.getElementById("Inside_adsection").style.display="block";
		document.getElementById("Inside_buttonss").style.display="block";
		document.getElementById("selectinside").style.display="inline";
		document.getElementById("selectinside_label").style.display="inline";
		document.getElementById("inside1").style.display="block";
		document.getElementById("inside2").style.display="none";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice60").style.display="none";
		document.getElementById("xchoice61").style.display="none";
        document.getElementById("ichoice60").style.display="none";
        document.getElementById("ichoice61").style.display="none";
        document.getElementById("ichoice62").style.display="none";
		document.getElementById("right_choice60").style.display="none";
		document.getElementById("Inside_adsection").style.display="block";
		document.getElementById("Inside_buttonss").style.display="block";
		document.getElementById("selectinside").style.display="inline";
		document.getElementById("selectinside_label").style.display="inline";
		document.getElementById("inside1").style.display="block";
		document.getElementById("inside2").style.display="none";
	} else if(sel.selectedIndex=='3') {
    	document.getElementById("choice60").style.display="block";
		document.getElementById("xchoice61").style.display="none";
        document.getElementById("ichoice60").style.display="none";
        document.getElementById("ichoice61").style.display="block";
        document.getElementById("ichoice62").style.display="none";
		document.getElementById("right_choice60").style.display="none";
		document.getElementById("Inside_adsection").style.display="block";
		document.getElementById("Inside_buttonss").style.display="block";
		document.getElementById("selectinside").style.display="inline";
		document.getElementById("selectinside_label").style.display="inline";
		document.getElementById("inside1").style.display="block";
		document.getElementById("inside2").style.display="none";
	} else if(sel.selectedIndex=='4') {
    	document.getElementById("choice60").style.display="none";
		document.getElementById("xchoice61").style.display="block";
        document.getElementById("ichoice60").style.display="none";
        document.getElementById("ichoice61").style.display="none";
        document.getElementById("ichoice62").style.display="block";
		document.getElementById("right_choice60").style.display="none";
		document.getElementById("Inside_adsection").style.display="none";
		document.getElementById("Inside_buttonss").style.display="none";
		document.getElementById("selectinside").style.display="none";
		document.getElementById("selectinside_label").style.display="none";
		document.getElementById("inside1").style.display="none";
		document.getElementById("inside2").style.display="block";
	}
}
function sh7(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='2') {
		document.getElementById("choice70").style.display="block";
		document.getElementById("xchoice71").style.display="none";
        document.getElementById("ichoice70").style.display="block";
        document.getElementById("ichoice71").style.display="none";
        document.getElementById("ichoice72").style.display="none";
		document.getElementById("right_choice70").style.display="block";
		document.getElementById("Regular_adsection").style.display="block";
		document.getElementById("Regular_buttonss").style.display="block";
		document.getElementById("selectregular").style.display="inline";
		document.getElementById("selectregular_label").style.display="inline";
		document.getElementById("regular1").style.display="block";
		document.getElementById("regular2").style.display="none";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice70").style.display="none";
		document.getElementById("xchoice71").style.display="none";
        document.getElementById("ichoice70").style.display="none";
        document.getElementById("ichoice71").style.display="none";
        document.getElementById("ichoice72").style.display="none";
		document.getElementById("right_choice70").style.display="none";
		document.getElementById("Regular_adsection").style.display="block";
		document.getElementById("Regular_buttonss").style.display="block";
		document.getElementById("selectregular").style.display="inline";
		document.getElementById("selectregular_label").style.display="inline";
		document.getElementById("regular1").style.display="block";
		document.getElementById("regular2").style.display="none";
	} else if(sel.selectedIndex=='3') {
    	document.getElementById("choice70").style.display="block";
		document.getElementById("xchoice71").style.display="none";
        document.getElementById("ichoice70").style.display="none";
        document.getElementById("ichoice71").style.display="block";
        document.getElementById("ichoice72").style.display="none";
		document.getElementById("right_choice70").style.display="none";
		document.getElementById("Regular_adsection").style.display="block";
		document.getElementById("Regular_buttonss").style.display="block";
		document.getElementById("selectregular").style.display="inline";
		document.getElementById("selectregular_label").style.display="inline";
		document.getElementById("regular1").style.display="block";
		document.getElementById("regular2").style.display="none";
	} else if(sel.selectedIndex=='4') {
    	document.getElementById("choice70").style.display="none";
		document.getElementById("xchoice71").style.display="block";
        document.getElementById("ichoice70").style.display="none";
        document.getElementById("ichoice71").style.display="none";
        document.getElementById("ichoice72").style.display="block";
		document.getElementById("right_choice70").style.display="none";
		document.getElementById("Regular_adsection").style.display="none";
		document.getElementById("Regular_buttonss").style.display="none";
		document.getElementById("selectregular").style.display="none";
		document.getElementById("selectregular_label").style.display="none";
		document.getElementById("regular1").style.display="none";
		document.getElementById("regular2").style.display="block";
	}
}
function sh8(sel) {
	if(sel.selectedIndex=='0' || sel.selectedIndex=='2') {
		document.getElementById("choice80").style.display="block";
		document.getElementById("xchoice81").style.display="none";
        document.getElementById("ichoice80").style.display="block";
        document.getElementById("ichoice82").style.display="none";
		document.getElementById("Reg_adsection").style.display="block";
		document.getElementById("Reg_adsection1").style.display="block";
		document.getElementById("Reg_adsection2").style.display="block";
		document.getElementById("Reg_buttonss").style.display="block";
		document.getElementById("selectreg").style.display="inline";
		document.getElementById("selectreg_label").style.display="inline";
		document.getElementById("reg1").style.display="block";
		document.getElementById("reg2").style.display="none";
	} else if(sel.selectedIndex=='1') {
        document.getElementById("choice80").style.display="none";
		document.getElementById("xchoice81").style.display="none";
        document.getElementById("ichoice80").style.display="none";
        document.getElementById("ichoice82").style.display="none";
		document.getElementById("Reg_adsection").style.display="block";
		document.getElementById("Reg_adsection1").style.display="block";
		document.getElementById("Reg_adsection2").style.display="block";
		document.getElementById("Reg_buttonss").style.display="block";
		document.getElementById("selectreg").style.display="inline";
		document.getElementById("selectreg_label").style.display="inline";
		document.getElementById("reg1").style.display="block";
		document.getElementById("reg2").style.display="none";
	} else if(sel.selectedIndex=='3') {
        document.getElementById("choice80").style.display="none";
		document.getElementById("xchoice81").style.display="block";
        document.getElementById("ichoice80").style.display="none";
        document.getElementById("ichoice82").style.display="block";
		document.getElementById("Reg_adsection").style.display="none";
		document.getElementById("Reg_adsection1").style.display="none";
		document.getElementById("Reg_adsection2").style.display="none";
		document.getElementById("Reg_buttonss").style.display="none";
		document.getElementById("selectreg").style.display="none";
		document.getElementById("selectreg_label").style.display="none";
		document.getElementById("reg1").style.display="none";
		document.getElementById("reg2").style.display="block";
	}
}
function sh10(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice13").style.display="block";
		document.getElementById("ichoice14").style.display="none";
		document.getElementById("ichoice15").style.display="block";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice13").style.display="none";
		document.getElementById("ichoice14").style.display="block";
		document.getElementById("ichoice15").style.display="none";
	}
}
function sh20(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice23").style.display="block";
		document.getElementById("ichoice24").style.display="none";
		document.getElementById("ichoice27").style.display="block";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice23").style.display="none";
		document.getElementById("ichoice24").style.display="block";
		document.getElementById("ichoice27").style.display="none";
	}
}
function sh30(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice33").style.display="block";
		document.getElementById("ichoice34").style.display="none";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice33").style.display="none";
		document.getElementById("ichoice34").style.display="block";
	}
}
function sh40(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice43").style.display="block";
		document.getElementById("ichoice44").style.display="none";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice43").style.display="none";
		document.getElementById("ichoice44").style.display="block";
	}
}
function sh50(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice53").style.display="block";
		document.getElementById("ichoice54").style.display="none";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice53").style.display="none";
		document.getElementById("ichoice54").style.display="block";
	}
}
function sh60(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice63").style.display="block";
		document.getElementById("ichoice64").style.display="none";
		document.getElementById("ichoice65").style.display="block";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice63").style.display="none";
		document.getElementById("ichoice64").style.display="block";
		document.getElementById("ichoice65").style.display="none";
	}
}
function sh70(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice73").style.display="block";
		document.getElementById("ichoice74").style.display="none";
		document.getElementById("ichoice75").style.display="block";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice73").style.display="none";
		document.getElementById("ichoice74").style.display="block";
		document.getElementById("ichoice75").style.display="none";
	}
}
function sh80(sel) {
	if(sel.selectedIndex=='0') {
		document.getElementById("ichoice83").style.display="block";
		document.getElementById("ichoice84").style.display="none";
		document.getElementById("ichoice85").style.display="block";
	} else if(sel.selectedIndex=='1') {
		document.getElementById("ichoice83").style.display="none";
		document.getElementById("ichoice84").style.display="block";
		document.getElementById("ichoice85").style.display="none";
	}
}


<!-- SHOW HELP ON MOUSEOVER -->
$jj(function() {
    $jj('#helptip_popup1').hide(); 
	$jj('#helpbtn_popup1').hover(function(){$jj('#helptip_popup1').fadeIn();},function(){$jj('#helptip_popup1').fadeOut();});
    $jj('#helptip_popup2').hide(); 
	$jj('#helpbtn_popup2').hover(function(){$jj('#helptip_popup2').fadeIn();},function(){$jj('#helptip_popup2').fadeOut();});
	$jj('#helptip_popup3').hide(); 
	$jj('#helpbtn_popup3').hover(function(){$jj('#helptip_popup3').fadeIn();},function(){$jj('#helptip_popup3').fadeOut();});
	$jj('#helptip_popup4').hide(); 
	$jj('#helpbtn_popup4').hover(function(){$jj('#helptip_popup4').fadeIn();},function(){$jj('#helptip_popup4').fadeOut();});
	$jj('#helptip_popup5').hide(); 
	$jj('#helpbtn_popup5').hover(function(){$jj('#helptip_popup5').fadeIn();},function(){$jj('#helptip_popup5').fadeOut();});
	$jj('#helptip_popup6').hide(); 
	$jj('#helpbtn_popup6').hover(function(){$jj('#helptip_popup6').fadeIn();},function(){$jj('#helptip_popup6').fadeOut();});
	$jj('#helptip_popup7').hide(); 
	$jj('#helpbtn_popup7').hover(function(){$jj('#helptip_popup7').fadeIn();},function(){$jj('#helptip_popup7').fadeOut();});
	$jj('#helptip_popup8').hide(); 
	$jj('#helpbtn_popup8').hover(function(){$jj('#helptip_popup8').fadeIn();},function(){$jj('#helptip_popup8').fadeOut();});
	$jj('#helptip_popup9').hide(); 
	$jj('#helpbtn_popup9').hover(function(){$jj('#helptip_popup9').fadeIn();},function(){$jj('#helptip_popup9').fadeOut();});
	
    $jj('#helptip_slider1').hide(); 
	$jj('#helpbtn_slider1').hover(function(){$jj('#helptip_slider1').fadeIn();},function(){$jj('#helptip_slider1').fadeOut();});
    $jj('#helptip_slider2').hide(); 
	$jj('#helpbtn_slider2').hover(function(){$jj('#helptip_slider2').fadeIn();},function(){$jj('#helptip_slider2').fadeOut();});
    $jj('#helptip_slider3').hide(); 
	$jj('#helpbtn_slider3').hover(function(){$jj('#helptip_slider3').fadeIn();},function(){$jj('#helptip_slider3').fadeOut();});
    $jj('#helptip_slider4').hide(); 
	$jj('#helpbtn_slider4').hover(function(){$jj('#helptip_slider4').fadeIn();},function(){$jj('#helptip_slider4').fadeOut();});
    $jj('#helptip_slider5').hide(); 
	$jj('#helpbtn_slider5').hover(function(){$jj('#helptip_slider5').fadeIn();},function(){$jj('#helptip_slider5').fadeOut();});
    $jj('#helptip_slider6').hide(); 
	$jj('#helpbtn_slider6').hover(function(){$jj('#helptip_slider6').fadeIn();},function(){$jj('#helptip_slider6').fadeOut();});
    $jj('#helptip_slider7').hide(); 
	$jj('#helpbtn_slider7').hover(function(){$jj('#helptip_slider7').fadeIn();},function(){$jj('#helptip_slider7').fadeOut();});
    $jj('#helptip_slider8').hide(); 
	$jj('#helpbtn_slider8').hover(function(){$jj('#helptip_slider8').fadeIn();},function(){$jj('#helptip_slider8').fadeOut();});
    $jj('#helptip_slider9').hide(); 
	$jj('#helpbtn_slider9').hover(function(){$jj('#helptip_slider9').fadeIn();},function(){$jj('#helptip_slider9').fadeOut();});
	
    $jj('#helptip_header1').hide(); 
	$jj('#helpbtn_header1').hover(function(){$jj('#helptip_header1').fadeIn();},function(){$jj('#helptip_header1').fadeOut();});
    $jj('#helptip_header2').hide(); 
	$jj('#helpbtn_header2').hover(function(){$jj('#helptip_header2').fadeIn();},function(){$jj('#helptip_header2').fadeOut();});
    $jj('#helptip_header3').hide(); 
	$jj('#helpbtn_header3').hover(function(){$jj('#helptip_header3').fadeIn();},function(){$jj('#helptip_header3').fadeOut();});
    $jj('#helptip_header4').hide(); 
	$jj('#helpbtn_header4').hover(function(){$jj('#helptip_header4').fadeIn();},function(){$jj('#helptip_header4').fadeOut();});
    $jj('#helptip_header5').hide(); 
	$jj('#helpbtn_header5').hover(function(){$jj('#helptip_header5').fadeIn();},function(){$jj('#helptip_header5').fadeOut();});
    $jj('#helptip_header6').hide(); 
	$jj('#helpbtn_header6').hover(function(){$jj('#helptip_header6').fadeIn();},function(){$jj('#helptip_header6').fadeOut();});
    $jj('#helptip_header7').hide(); 
	$jj('#helpbtn_header7').hover(function(){$jj('#helptip_header7').fadeIn();},function(){$jj('#helptip_header7').fadeOut();});
    $jj('#helptip_header8').hide(); 
	$jj('#helpbtn_header8').hover(function(){$jj('#helptip_header8').fadeIn();},function(){$jj('#helptip_header8').fadeOut();});
    $jj('#helptip_header9').hide(); 
	$jj('#helpbtn_header9').hover(function(){$jj('#helptip_header9').fadeIn();},function(){$jj('#helptip_header9').fadeOut();});
	
    $jj('#helptip_footer1').hide(); 
	$jj('#helpbtn_footer1').hover(function(){ $jj('#helptip_footer1').fadeIn(); },function(){ $jj('#helptip_footer1').fadeOut(); });
    $jj('#helptip_footer2').hide(); 
	$jj('#helpbtn_footer2').hover(function(){ $jj('#helptip_footer2').fadeIn(); },function(){ $jj('#helptip_footer2').fadeOut(); });
    $jj('#helptip_footer3').hide(); 
	$jj('#helpbtn_footer3').hover(function(){ $jj('#helptip_footer3').fadeIn(); },function(){ $jj('#helptip_footer3').fadeOut(); });
    $jj('#helptip_footer4').hide(); 
	$jj('#helpbtn_footer4').hover(function(){ $jj('#helptip_footer4').fadeIn(); },function(){ $jj('#helptip_footer4').fadeOut(); });
    $jj('#helptip_footer5').hide(); 
	$jj('#helpbtn_footer5').hover(function(){ $jj('#helptip_footer5').fadeIn(); },function(){ $jj('#helptip_footer5').fadeOut(); });
    $jj('#helptip_footer6').hide(); 
	$jj('#helpbtn_footer6').hover(function(){ $jj('#helptip_footer6').fadeIn(); },function(){ $jj('#helptip_footer6').fadeOut(); });
    $jj('#helptip_footer7').hide(); 
	$jj('#helpbtn_footer7').hover(function(){ $jj('#helptip_footer7').fadeIn(); },function(){ $jj('#helptip_footer7').fadeOut(); });
    $jj('#helptip_footer8').hide(); 
	$jj('#helpbtn_footer8').hover(function(){ $jj('#helptip_footer8').fadeIn(); },function(){ $jj('#helptip_footer8').fadeOut(); });
    $jj('#helptip_footer9').hide(); 
	$jj('#helpbtn_footer9').hover(function(){ $jj('#helptip_footer9').fadeIn(); },function(){ $jj('#helptip_footer9').fadeOut(); });
	
    $jj('#helptip_regular1').hide(); 
	$jj('#helpbtn_regular1').hover(function(){$jj('#helptip_regular1').fadeIn();},function(){$jj('#helptip_regular1').fadeOut();});
    $jj('#helptip_regular2').hide(); 
	$jj('#helpbtn_regular2').hover(function(){$jj('#helptip_regular2').fadeIn();},function(){$jj('#helptip_regular2').fadeOut();});
    $jj('#helptip_regular3').hide(); 
	$jj('#helpbtn_regular3').hover(function(){$jj('#helptip_regular3').fadeIn();},function(){$jj('#helptip_regular3').fadeOut();});
    $jj('#helptip_regular4').hide(); 
	$jj('#helpbtn_regular4').hover(function(){$jj('#helptip_regular4').fadeIn();},function(){$jj('#helptip_regular4').fadeOut();});
    $jj('#helptip_regular5').hide(); 
	$jj('#helpbtn_regular5').hover(function(){$jj('#helptip_regular5').fadeIn();},function(){$jj('#helptip_regular5').fadeOut();});
    $jj('#helptip_regular6').hide(); 
	$jj('#helpbtn_regular6').hover(function(){$jj('#helptip_regular6').fadeIn();},function(){$jj('#helptip_regular6').fadeOut();});
    $jj('#helptip_regular7').hide(); 
	$jj('#helpbtn_regular7').hover(function(){$jj('#helptip_regular7').fadeIn();},function(){$jj('#helptip_regular7').fadeOut();});
    $jj('#helptip_regular8').hide(); 
	$jj('#helpbtn_regular8').hover(function(){$jj('#helptip_regular8').fadeIn();},function(){$jj('#helptip_regular8').fadeOut();});
    $jj('#helptip_regular9').hide(); 
	$jj('#helpbtn_regular9').hover(function(){$jj('#helptip_regular9').fadeIn();},function(){$jj('#helptip_regular9').fadeOut();});
	
	$jj('#helptip_inside1').hide(); 
	$jj('#helpbtn_inside1').hover(function(){$jj('#helptip_inside1').fadeIn();},function(){$jj('#helptip_inside1').fadeOut();});
    $jj('#helptip_inside2').hide(); 
	$jj('#helpbtn_inside2').hover(function(){$jj('#helptip_inside2').fadeIn();},function(){$jj('#helptip_inside2').fadeOut();});
    $jj('#helptip_inside3').hide(); 
	$jj('#helpbtn_inside3').hover(function(){$jj('#helptip_inside3').fadeIn();},function(){$jj('#helptip_inside3').fadeOut();});
    $jj('#helptip_inside4').hide(); 
	$jj('#helpbtn_inside4').hover(function(){$jj('#helptip_inside4').fadeIn();},function(){$jj('#helptip_inside4').fadeOut();});
    $jj('#helptip_inside5').hide(); 
	$jj('#helpbtn_inside5').hover(function(){$jj('#helptip_inside5').fadeIn();},function(){$jj('#helptip_inside5').fadeOut();});
    $jj('#helptip_inside6').hide(); 
	$jj('#helpbtn_inside6').hover(function(){$jj('#helptip_inside6').fadeIn();},function(){$jj('#helptip_inside6').fadeOut();});
    $jj('#helptip_inside7').hide(); 
	$jj('#helpbtn_inside7').hover(function(){$jj('#helptip_inside7').fadeIn();},function(){$jj('#helptip_inside7').fadeOut();});
    $jj('#helptip_inside8').hide(); 
	$jj('#helpbtn_inside8').hover(function(){$jj('#helptip_inside8').fadeIn();},function(){$jj('#helptip_inside8').fadeOut();});
    $jj('#helptip_inside9').hide(); 
	$jj('#helpbtn_inside9').hover(function(){$jj('#helptip_inside9').fadeIn();},function(){$jj('#helptip_inside9').fadeOut();});
	
    $jj('#helptip_reg1').hide(); 
	$jj('#helpbtn_reg1').hover(function(){$jj('#helptip_reg1').fadeIn();},function(){$jj('#helptip_reg1').fadeOut();});
    $jj('#helptip_reg2').hide(); 
	$jj('#helpbtn_reg2').hover(function(){$jj('#helptip_reg2').fadeIn();},function(){$jj('#helptip_reg2').fadeOut();});
    $jj('#helptip_reg3').hide(); 
	$jj('#helpbtn_reg3').hover(function(){$jj('#helptip_reg3').fadeIn();},function(){$jj('#helptip_reg3').fadeOut();});
    $jj('#helptip_reg4').hide(); 
	$jj('#helpbtn_reg4').hover(function(){$jj('#helptip_reg4').fadeIn();},function(){$jj('#helptip_reg4').fadeOut();});
    $jj('#helptip_reg5').hide(); 
	$jj('#helpbtn_reg5').hover(function(){$jj('#helptip_reg5').fadeIn();},function(){$jj('#helptip_reg5').fadeOut();});
    $jj('#helptip_reg6').hide(); 
	$jj('#helpbtn_reg6').hover(function(){$jj('#helptip_reg6').fadeIn();},function(){$jj('#helptip_reg6').fadeOut();});
    $jj('#helptip_reg7').hide(); 
	$jj('#helpbtn_reg7').hover(function(){$jj('#helptip_reg7').fadeIn();},function(){$jj('#helptip_reg7').fadeOut();});
    $jj('#helptip_reg8').hide(); 
	$jj('#helpbtn_reg8').hover(function(){$jj('#helptip_reg8').fadeIn();},function(){$jj('#helptip_reg8').fadeOut();});
    $jj('#helptip_reg9').hide(); 
	$jj('#helpbtn_reg9').hover(function(){$jj('#helptip_reg9').fadeIn();},function(){$jj('#helptip_reg9').fadeOut();});
	
    $jj('#helptip_exit1').hide(); 
	$jj('#helpbtn_exit1').hover(function(){$jj('#helptip_exit1').fadeIn();},function(){$jj('#helptip_exit1').fadeOut();});
    $jj('#helptip_exit2').hide(); 
	$jj('#helpbtn_exit2').hover(function(){$jj('#helptip_exit2').fadeIn();},function(){$jj('#helptip_exit2').fadeOut();});
    $jj('#helptip_exit3').hide(); 
	$jj('#helpbtn_exit3').hover(function(){$jj('#helptip_exit3').fadeIn();},function(){$jj('#helptip_exit3').fadeOut();});
    $jj('#helptip_exit4').hide(); 
	$jj('#helpbtn_exit4').hover(function(){$jj('#helptip_exit4').fadeIn();},function(){$jj('#helptip_exit4').fadeOut();});
    $jj('#helptip_exit5').hide(); 
	$jj('#helpbtn_exit5').hover(function(){$jj('#helptip_exit5').fadeIn();},function(){$jj('#helptip_exit5').fadeOut();});
});


<!-- SHOW 'SAVE AS' BUTTON ON MOUSEOVER -->
$jj(function() {
	$jj('.opennewshow').hide();
	$jj('.opennewonhover').hover(function(){$jj('.opennewshow').fadeIn();}, function(){$jj('.opennewshow').fadeOut();});
});
$jj(function() {
	$jj('.saveasshow').hide();
	$jj('.saveasonhover').hover(function(){$jj('.saveasshow').fadeIn();}, function(){$jj('.saveasshow').fadeOut();});
});