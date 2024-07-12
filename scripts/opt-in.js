var $jj = jQuery.noConflict();


<!-- GENERAL OPT-IN: NOT IN USE (?) -->
var myFunction_gp = function(e) {
	e.preventDefault();
	$jj('#gpformarea_gp').html($jj('#gpoptinform_gp').val());
	//reset textareas
	$jj('#gpformaction_gp').val('');
	$jj('#gpregularfields_gp').val('');
	$jj('#gphiddenfields_gp').val('');
	$jj('#gpignoredfields_gp').val('');
	$jj('#gpotherfields_gp').val('');
	$jj('#gpsubmitbutton_gp').val('');
	$jj('#gpnamefield_gp option').remove();
	$jj('#gpemailfield_gp option').remove();

	$jj('#gpformaction_gp').val($jj('#gpformarea_gp [method="post"]').attr('action')); //[method="post"] instead form
	$jj('input', '#gpformarea_gp').each(function() {
		//proccess the form
		var field = 'ignoredfields';
		if ($jj(this).attr('type') == 'hidden') field = 'hiddenfields';
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') field = 'textfields';
		if ($jj(this).attr('type') == 'submit') {
    		var submitname = $jj(this).attr('name');
    		$jj('#gpsubmitbutton_gp').val(submitname);
    		if ($jj('#gpsubmitbutton_gp').val()=="") { $jj('#gpsubmitbutton_gp').val("submit"); }
			field = 'none';
		}

		//make each text field an <option> and add insert it between <select> html tag
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') {
			//var optionvalue = $jj('<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />');
			var optionvalue = $jj(this).attr('name');
			temp = '<option value="' + optionvalue + '">' + $jj(this).attr('name') + '</option>';
			$jj('#gpnamefield_gp').append(temp);
			$jj('#gpemailfield_gp').append(temp);
		}
		
		$jj('#gp' + field + '_gp').val($jj('#gp' + field + '_gp').val() + '<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />\n');
	});
	//select the second option in second dropdown field
	$jj('#gpemailfield_gp option:eq(1)').attr('selected','selected');
};

$jj('#gpproccessit_gp').click(myFunction_gp); //onclick
//$jj('#gpoptinform_gp').keyup(myFunction_gp).mouseout(myFunction_gp); //auto
//disable name field
$jj(function() {
	enable_cb_gp();
	$jj("#gpdisablename_gp").click(enable_cb_gp);
});
function enable_cb_gp() {
	if (this.checked) { $jj("#gpnamefield_gp").attr("disabled", true); }
	else { $jj("#gpnamefield_gp").removeAttr("disabled"); }
}


<!-- POPUP OPT-IN -->
var myFunction_popup = function(e) {
	e.preventDefault();
	$jj('#gpformarea_popup').html($jj('#gpoptinform_popup').val());
	//reset textareas
	$jj('#gpformaction_popup').val('');
	$jj('#gpregularfields_popup').val('');
	$jj('#gphiddenfields_popup').val('');
	$jj('#gpignoredfields_popup').val('');
	$jj('#gpotherfields_popup').val('');
	$jj('#gpsubmitbutton_popup').val('');
	$jj('#gpnamefield_popup option').remove();
	$jj('#gpemailfield_popup option').remove();
	
	$jj('#gpformaction_popup').val($jj('#gpformarea_popup [method="post"]').attr('action')); //[method="post"] instead form
	$jj('input', '#gpformarea_popup').each(function() {
		//proccess the form
		var field = 'ignoredfields';
		if ($jj(this).attr('type') == 'hidden') field = 'hiddenfields';
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') field = 'textfields';
		if ($jj(this).attr('type') == 'submit') {
    		var submitname = $jj(this).attr('name');
    		$jj('#gpsubmitbutton_popup').val(submitname);
    		if ($jj('#gpsubmitbutton_popup').val()=="") { $jj('#gpsubmitbutton_popup').val("submit"); }
			field = 'none';
		}

		//make each text field an <option> and add insert it between <select> html tag
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') {
			//var optionvalue = $jj('<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />');
			var optionvalue = $jj(this).attr('name');
			temp = '<option value="' + optionvalue + '">' + $jj(this).attr('name') + '</option>';
			$jj('#gpnamefield_popup').append(temp);
			$jj('#gpemailfield_popup').append(temp);
		}
		
		$jj('#gp' + field + '_popup').val($jj('#gp' + field + '_popup').val() + '<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />\n');
	});
	//select the second option in second dropdown field
	$jj('#gpemailfield_popup option:eq(1)').attr('selected','selected');
};

$jj('#gpproccessit_popup').click(myFunction_popup); //onclick
//$jj('#gpoptinform_popup').keyup(myFunction_popup).mouseout(myFunction_popup); //auto
//disable name field
$jj(function() {
	enable_cb_popup();
	$jj("#gpdisablename_popup").click(enable_cb_popup);
});
function enable_cb_popup() {
	if (this.checked) { $jj("#gpnamefield_popup").attr("disabled", true); }
	else { $jj("#gpnamefield_popup").removeAttr("disabled"); }
}
//show or hide all data processed
$jj(function() {
	show_alldata_popup();
	$jj("#gpshowalldata_popup").click(show_alldata_popup);
});
function show_alldata_popup() {
	if (this.checked) { $jj("#gpalldata_popup").show(); }
	else { $jj("#gpalldata_popup").hide(); }
}


<!-- SLIDER OPT-IN -->
var myFunction_slider = function(e) {
	e.preventDefault();
	$jj('#gpformarea_slider').html($jj('#gpoptinform_slider').val());
	//reset textareas
	$jj('#gpformaction_slider').val('');
	$jj('#gpregularfields_slider').val('');
	$jj('#gphiddenfields_slider').val('');
	$jj('#gpignoredfields_slider').val('');
	$jj('#gpotherfields_slider').val('');
	$jj('#gpsubmitbutton_slider').val('');
	$jj('#gpnamefield_slider option').remove();
	$jj('#gpemailfield_slider option').remove();

	$jj('#gpformaction_slider').val($jj('#gpformarea_slider [method="post"]').attr('action')); //[method="post"] instead form
	$jj('input', '#gpformarea_slider').each(function() {
		//proccess the form
		var field = 'ignoredfields';
		if ($jj(this).attr('type') == 'hidden') field = 'hiddenfields';
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') field = 'textfields';
		if ($jj(this).attr('type') == 'submit') {
    		var submitname = $jj(this).attr('name');
    		$jj('#gpsubmitbutton_slider').val(submitname);
    		if ($jj('#gpsubmitbutton_slider').val()=="") { $jj('#gpsubmitbutton_slider').val("submit"); }
			field = 'none';
		}

		//make each text field an <option> and add insert it between <select> html tag
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') {
			//var optionvalue = $jj('<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />');
			var optionvalue = $jj(this).attr('name');
			temp = '<option value="' + optionvalue + '">' + $jj(this).attr('name') + '</option>';
			$jj('#gpnamefield_slider').append(temp);
			$jj('#gpemailfield_slider').append(temp);
		}
		
		$jj('#gp' + field + '_slider').val($jj('#gp' + field + '_slider').val() + '<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />\n');
	});
	//select the second option in second dropdown field
	$jj('#gpemailfield_slider option:eq(1)').attr('selected','selected');
};

$jj('#gpproccessit_slider').click(myFunction_slider); //onclick
//$jj('#gpoptinform_slider').keyup(myFunction_slider).mouseout(myFunction_slider); //auto
//disable name field
$jj(function() {
	enable_cb_slider();
	$jj("#gpdisablename_slider").click(enable_cb_slider);
});
function enable_cb_slider() {
	if (this.checked) { $jj("#gpnamefield_slider").attr("disabled", true); }
	else { $jj("#gpnamefield_slider").removeAttr("disabled"); }
}
//show or hide all data processed
$jj(function() {
	show_alldata_slider();
	$jj("#gpshowalldata_slider").click(show_alldata_slider);
});
function show_alldata_slider() {
	if (this.checked) { $jj("#gpalldata_slider").show(); }
	else { $jj("#gpalldata_slider").hide(); }
}


<!-- HEADER OPT-IN -->
var myFunction_header = function(e) {
	e.preventDefault();
	$jj('#gpformarea_header').html($jj('#gpoptinform_header').val());
	//reset textareas
	$jj('#gpformaction_header').val('');
	$jj('#gpregularfields_header').val('');
	$jj('#gphiddenfields_header').val('');
	$jj('#gpignoredfields_header').val('');
	$jj('#gpotherfields_header').val('');
	$jj('#gpsubmitbutton_header').val('');
	$jj('#gpnamefield_header option').remove();
	$jj('#gpemailfield_header option').remove();

	$jj('#gpformaction_header').val($jj('#gpformarea_header [method="post"]').attr('action')); //[method="post"] instead form
	$jj('input', '#gpformarea_header').each(function() {
		//proccess the form
		var field = 'ignoredfields';
		if ($jj(this).attr('type') == 'hidden') field = 'hiddenfields';
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') field = 'textfields';
		if ($jj(this).attr('type') == 'submit') {
    		var submitname = $jj(this).attr('name');
    		$jj('#gpsubmitbutton_header').val(submitname);
    		if ($jj('#gpsubmitbutton_header').val()=="") { $jj('#gpsubmitbutton_header').val("submit"); }
			field = 'none';
		}

		//make each text field an <option> and add insert it between <select> html tag
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') {
			//var optionvalue = $jj('<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />');
			var optionvalue = $jj(this).attr('name');
			temp = '<option value="' + optionvalue + '">' + $jj(this).attr('name') + '</option>';
			$jj('#gpnamefield_header').append(temp);
			$jj('#gpemailfield_header').append(temp);
		}
		
		$jj('#gp' + field + '_header').val($jj('#gp' + field + '_header').val() + '<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />\n');
	});
	//select the second option in second dropdown field
	$jj('#gpemailfield_header option:eq(1)').attr('selected','selected');
};

$jj('#gpproccessit_header').click(myFunction_header); //onclick
//$jj('#gpoptinform_header').keyup(myFunction_header).mouseout(myFunction_header); //auto
//disable name field
$jj(function() {
	enable_cb_header();
	$jj("#gpdisablename_header").click(enable_cb_header);
});
function enable_cb_header() {
	if (this.checked) { $jj("#gpnamefield_header").attr("disabled", true); }
	else { $jj("#gpnamefield_header").removeAttr("disabled"); }
}
//show or hide all data processed
$jj(function() {
	show_alldata_header();
	$jj("#gpshowalldata_header").click(show_alldata_header);
});
function show_alldata_header() {
	if (this.checked) { $jj("#gpalldata_header").show(); }
	else { $jj("#gpalldata_header").hide(); }
}


<!-- FOOTER OPT-IN -->
var myFunction_footer = function(e) {
	e.preventDefault();
	$jj('#gpformarea_footer').html($jj('#gpoptinform_footer').val());
	//reset textareas
	$jj('#gpformaction_footer').val('');
	$jj('#gpregularfields_footer').val('');
	$jj('#gphiddenfields_footer').val('');
	$jj('#gpignoredfields_footer').val('');
	$jj('#gpotherfields_footer').val('');
	$jj('#gpsubmitbutton_footer').val('');
	$jj('#gpnamefield_footer option').remove();
	$jj('#gpemailfield_footer option').remove();

	$jj('#gpformaction_footer').val($jj('#gpformarea_footer [method="post"]').attr('action')); //[method="post"] instead form
	$jj('input', '#gpformarea_footer').each(function() {
		//proccess the form
		var field = 'ignoredfields';
		if ($jj(this).attr('type') == 'hidden') field = 'hiddenfields';
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') field = 'textfields';
		if ($jj(this).attr('type') == 'submit') {
    		var submitname = $jj(this).attr('name');
    		$jj('#gpsubmitbutton_footer').val(submitname);
    		if ($jj('#gpsubmitbutton_footer').val()=="") { $jj('#gpsubmitbutton_footer').val("submit"); }
			field = 'none';
		}

		//make each text field an <option> and add insert it between <select> html tag
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') {
			//var optionvalue = $jj('<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />');
			var optionvalue = $jj(this).attr('name');
			temp = '<option value="' + optionvalue + '">' + $jj(this).attr('name') + '</option>';
			$jj('#gpnamefield_footer').append(temp);
			$jj('#gpemailfield_footer').append(temp);
		}
		
		$jj('#gp' + field + '_footer').val($jj('#gp' + field + '_footer').val() + '<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />\n');
	});
	//select the second option in second dropdown field
	$jj('#gpemailfield_footer option:eq(1)').attr('selected','selected');
};

$jj('#gpproccessit_footer').click(myFunction_footer); //onclick
//$jj('#gpoptinform_footer').keyup(myFunction_footer).mouseout(myFunction_footer); //auto
//disable name field
$jj(function() {
	enable_cb_footer();
	$jj("#gpdisablename_footer").click(enable_cb_footer);
});
function enable_cb_footer() {
	if (this.checked) { $jj("#gpnamefield_footer").attr("disabled", true); }
	else { $jj("#gpnamefield_footer").removeAttr("disabled"); }
}
//show or hide all data processed
$jj(function() {
	show_alldata_footer();
	$jj("#gpshowalldata_footer").click(show_alldata_footer);
});
function show_alldata_footer() {
	if (this.checked) { $jj("#gpalldata_footer").show(); }
	else { $jj("#gpalldata_footer").hide(); }
}


<!-- REGULAR OPT-IN -->
var myFunction_regular = function(e) {
	e.preventDefault();
	$jj('#gpformarea_regular').html($jj('#gpoptinform_regular').val());
	//reset textareas
	$jj('#gpformaction_regular').val('');
	$jj('#gpregularfields_regular').val('');
	$jj('#gphiddenfields_regular').val('');
	$jj('#gpignoredfields_regular').val('');
	$jj('#gpotherfields_regular').val('');
	$jj('#gpsubmitbutton_regular').val('');
	$jj('#gpnamefield_regular option').remove();
	$jj('#gpemailfield_regular option').remove();

	$jj('#gpformaction_regular').val($jj('#gpformarea_regular [method="post"]').attr('action')); //[method="post"] instead form
	$jj('input', '#gpformarea_regular').each(function() {
		//proccess the form
		var field = 'ignoredfields';
		if ($jj(this).attr('type') == 'hidden') field = 'hiddenfields';
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') field = 'textfields';
		if ($jj(this).attr('type') == 'submit') {
    		var submitname = $jj(this).attr('name');
    		$jj('#gpsubmitbutton_regular').val(submitname);
    		if ($jj('#gpsubmitbutton_regular').val()=="") { $jj('#gpsubmitbutton_regular').val("submit"); }
			field = 'none';
		}

		//make each text field an <option> and add insert it between <select> html tag
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') {
			//var optionvalue = $jj('<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />');
			var optionvalue = $jj(this).attr('name');
			temp = '<option value="' + optionvalue + '">' + $jj(this).attr('name') + '</option>';
			$jj('#gpnamefield_regular').append(temp);
			$jj('#gpemailfield_regular').append(temp);
		}
		
		$jj('#gp' + field + '_regular').val($jj('#gp' + field + '_regular').val() + '<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />\n');
	});
	//select the second option in second dropdown field
	$jj('#gpemailfield_regular option:eq(1)').attr('selected','selected');
};

$jj('#gpproccessit_regular').click(myFunction_regular); //onclick
//$jj('#gpoptinform_regular').keyup(myFunction_regular).mouseout(myFunction_regular); //auto
//disable name field
$jj(function() {
	enable_cb_regular();
	$jj("#gpdisablename_regular").click(enable_cb_regular);
});
function enable_cb_regular() {
	if (this.checked) { $jj("#gpnamefield_regular").attr("disabled", true); }
	else { $jj("#gpnamefield_regular").removeAttr("disabled"); }
}
//show or hide all data processed
$jj(function() {
	show_alldata_regular();
	$jj("#gpshowalldata_regular").click(show_alldata_regular);
});
function show_alldata_regular() {
	if (this.checked) { $jj("#gpalldata_regular").show(); }
	else { $jj("#gpalldata_regular").hide(); }
}


<!-- INSIDE OPT-IN -->
var myFunction_inside = function(e) {
	e.preventDefault();
	$jj('#gpformarea_inside').html($jj('#gpoptinform_inside').val());
	//reset textareas
	$jj('#gpformaction_inside').val('');
	$jj('#gpregularfields_inside').val('');
	$jj('#gphiddenfields_inside').val('');
	$jj('#gpignoredfields_inside').val('');
	$jj('#gpotherfields_inside').val('');
	$jj('#gpsubmitbutton_inside').val('');
	$jj('#gpnamefield_inside option').remove();
	$jj('#gpemailfield_inside option').remove();

	$jj('#gpformaction_inside').val($jj('#gpformarea_inside [method="post"]').attr('action')); //[method="post"] instead form
	$jj('input', '#gpformarea_inside').each(function() {
		//proccess the form
		var field = 'ignoredfields';
		if ($jj(this).attr('type') == 'hidden') field = 'hiddenfields';
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') field = 'textfields';
		if ($jj(this).attr('type') == 'submit') {
    		var submitname = $jj(this).attr('name');
    		$jj('#gpsubmitbutton_inside').val(submitname);
    		if ($jj('#gpsubmitbutton_inside').val()=="") { $jj('#gpsubmitbutton_inside').val("submit"); }
			field = 'none';
		}

		//make each text field an <option> and add insert it between <select> html tag
		if ($jj(this).attr('type') == 'text' || $jj(this).attr('type') == 'email') {
			//var optionvalue = $jj('<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />');
			var optionvalue = $jj(this).attr('name');
			temp = '<option value="' + optionvalue + '">' + $jj(this).attr('name') + '</option>';
			$jj('#gpnamefield_inside').append(temp);
			$jj('#gpemailfield_inside').append(temp);
		}
		
		$jj('#gp' + field + '_inside').val($jj('#gp' + field + '_inside').val() + '<input type="' + $jj(this).attr('type') + '" name="' + $jj(this).attr('name') + '" value="'+ $jj(this).val() +'" />\n');
	});
	//select the second option in second dropdown field
	$jj('#gpemailfield_inside option:eq(1)').attr('selected','selected');
};

$jj('#gpproccessit_inside').click(myFunction_inside); //onclick
//$jj('#gpoptinform_inside').keyup(myFunction_inside).mouseout(myFunction_inside); //auto
//disable name field
$jj(function() {
	enable_cb_inside();
	$jj("#gpdisablename_inside").click(enable_cb_inside);
});
function enable_cb_inside() {
	if (this.checked) { $jj("#gpnamefield_inside").attr("disabled", true); }
	else { $jj("#gpnamefield_inside").removeAttr("disabled"); }
}
//show or hide all data processed
$jj(function() {
	show_alldata_inside();
	$jj("#gpshowalldata_inside").click(show_alldata_inside);
});
function show_alldata_inside() {
	if (this.checked) { $jj("#gpalldata_inside").show(); }
	else { $jj("#gpalldata_inside").hide(); }
}