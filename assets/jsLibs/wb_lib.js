site_ajax = 'http://seb.skyalcci/index.php/ajax/';

$('.not_for_js').css('display','none')
$('.js_only_block').css('display','block')
$('.js_only_inline').css('display','inline')

function accordian(id){
	if ( $('.'+id).css('display') == 'none' ){
		$('.'+id).css('display','block');
	} else {
		$('.'+id).css('display','none');
	}
}

function ingToggle(id,setting){
	var on = $('#ii'+id).attr('checked')=='checked' || $('#ip'+id).attr('checked')=='checked' ;
	if (!on){ // set display values to off if not checked
		$('#ing_info').load(site_ajax+setting+'_remove/'+id);
		$('#'+id).css('background-color','#');
		$('#'+id).css('background','rgba(0, 0, 200, 0.1)');
		$('#'+id).css('color','#ddd');
	} else { // set display values to on if checked
		$('#ing_info').load(site_ajax+setting+'_add/'+id);
		$('#'+id).css('background-color','#22a');
		$('#'+id).css('color','#fff');
	}
}

function ing_num_toggle(num){
	var on = $('#ing_num'+num).attr('checked')=='checked';
	$('#debug').load('http://seb.skyalcci/index.php/ajax/ing_num_toggle/'+num+'/'+on);
}

function checkIngAll(setting){
	$('.check_ing').attr('checked','checked')
	$('.ingredientli').css('background-color','#22a')
	$('.ingredientli').css('color','#fff')
	$('#debug').load(site_ajax+setting+'_add_all')
	return false
}

function checkIngNone(setting){
	$('.check_ing').removeAttr('checked')
	$('.ingredientli').css('background-color','#')
	$('.ingredientli').css('background','rgba(0, 0, 200, 0.1)')
	$('.ingredientli').css('color','#ddd')
	$('#debug').load(site_ajax+setting+'_remove_all')
	return false
}

function checkIngInvert(setting){
	$('#debug').load(site_ajax+setting+'_invert')
	$('.check_ing').each(
		function(index, value){
			var id = value.value
			var off = !($('#ii'+id).attr('checked') == 'checked' || $('#ii'+id).attr('checked') == 'checked')
			if (off){ // set to on if not checked
				$('#'+id).css('background-color','#22a')
				$('#'+id).css('color','#fff')
				$('#ii'+id).attr('checked','checked')
				$('#ip'+id).attr('checked','checked')
			} else { // set to off if checked
				$('#'+id).css('background-color','#')
				$('#'+id).css('background','rgba(0, 0, 200, 0.1)')
				$('#'+id).css('color','#ddd')
				$('#ii'+id).removeAttr('checked')
				$('#ip'+id).removeAttr('checked')
			}
		}
	)
	return false
}

function setPrefIngsUse(num){
	$('#debug').load('http://seb.skyalcci/index.php/ajax/set_pref_ings_use/' + num)
}

function setMinEffs(num){
	$('#debug').load('http://seb.skyalcci/index.php/ajax/set_min_effs/' + num)
}

function setPrefEffsUse(num){
	$('#debug').load('http://seb.skyalcci/index.php/ajax/set_pref_effs_use/' + num)
}


function checkEffAll(setting,type){
	//alert(site_ajax + 'effects_' + setting + '/all/' + type);
	$('#debug').load(site_ajax + 'effects_' + setting + '/all/' + type );
	if (type!='harm'){
		$('.check_benefit').attr('checked','checked');
		$('li.benefit').css('background-color','#2a2');
		$('li.benefit').css('color','#fff');
	}
	if (type !='benefit'){
		$('.check_harm').attr('checked','checked')
		$('li.harm').css('background-color','#a22')
		$('li.harm').css('color','#fff')
	}
	return false
}

function checkEffNone(setting,type){
	//alert(site_ajax + 'effects_' + setting + '/clear/' + type);
	$('#debug').load(site_ajax + 'effects_' + setting + '/clear/' + type );
	if (type!='harm'){
		$('.check_benefit').removeAttr('checked')
		$('li.benefit').css('background-color','#')
		$('li.benefit').css('background','rgba(0, 200, 0, 0.1)')
		$('li.benefit').css('color','#ddd')
	}
	if (type !='benefit'){
		$('.check_harm').removeAttr('checked')
		$('li.harm').css('background-color','#')
		$('li.harm').css('background','rgba(200, 0, 0, 0.1)')
		$('li.harm').css('color','#ddd')
	}
	return false
}

function checkEffInvert(setting, type){
	//alert(site_ajax + 'effects_' + setting + '/invert/' + type);
	$('#debug').load(site_ajax + 'effects_' + setting + '/invert/' + type );
	if (setting!='pref'){
		checkExclEffInvert(type);
	}
	if (setting!='excl'){
		checkPrefEffInvert(type);
	}
	return false
}

function checkExclEffInvert(type){
	$('.check_effect.check_'+type).each(
		function(index, value){
			var id = value.value
			var off = $('#ee'+id).attr('checked') != 'checked'
			if (off){ // set to on if not checked
				$('.harm#lee'+id).css('background-color','#a22')
				$('.benefit#lee'+id).css('background-color','#2a2')
				$('#ele'+id).css('color','#fff')
				$('#ee'+id).attr('checked','checked')
			} else { // set to off if checked
				$('#lee'+id).css('background-color','#')
				$('.harm#lee'+id).css('background','rgba(200, 0, 0, 0.1)')
				$('.benefit#lee'+id).css('background','rgba(0, 200, 0, 0.1)')
				$('#ele'+id).css('color','#ddd')
				$('#ee'+id).removeAttr('checked')
			}
		}
	)
	return false
}

function checkPrefEffInvert(type){
	$('.check_effect.check_'+type).each(
		function(index, value){
			var id = value.value
			var off = $('#ep'+id).attr('checked') != 'checked'
			if (off){ // set to on if not checked
				$('.harm#lep'+id).css('background-color','#a22')
				$('.benefit#lep'+id).css('background-color','#2a2')
				$('#elp'+id).css('color','#fff')
				$('#ep'+id).attr('checked','checked')
			} else { // set to off if checked
				$('#lep'+id).css('background-color','#')
				$('.harm#lep'+id).css('background','rgba(200, 0, 0, 0.1)')
				$('.benefit#lep'+id).css('background','rgba(0, 200, 0, 0.1)')
				$('#elp'+id).css('color','#ddd')
				$('#ep'+id).removeAttr('checked')
			}
		}
	)
	return false
}


function effTogglePref(id){
	//alert(site_ajax + 'pref_eff_toggle/' + id );
	$('#eff_info').load(site_ajax + 'pref_eff_toggle/' + id );
	var off = $('#ep'+id).attr('checked') != 'checked'
	// toggle the li color - brighter if checked
	if (off){
		$('#lep'+id).css('background-color','#')
		$('.benefit#lep'+id).css('background','rgba(0, 200, 0, 0.1)')
		$('.harm#lep'+id).css('background','rgba(200, 0, 0, 0.1)')
		$('#elp'+id).css('color','#ddd')
	} else {
		$('.benefit#lep'+id).css('background-color','#2a2')
		$('.harm#lep'+id).css('background-color','#a22')
		$('#elp'+id).css('color','#fff')
	}
}

function effToggleExc(id){
	//alert(site_ajax + 'excl_eff_toggle/' + id);
	$('#eff_info').load(site_ajax + 'excl_eff_toggle/' + id );
	var off = $('#ee'+id).attr('checked') != 'checked'
	// toggle the li color - brighter if checked
	if (off){
		$('#lee'+id).css('background-color','#')
		$('.benefit#lee'+id).css('background','rgba(0, 200, 0, 0.1)')
		$('.harm#lee'+id).css('background','rgba(200, 0, 0, 0.1)')
		$('#ele'+id).css('color','#ddd')
	} else {
		$('.benefit#lee'+id).css('background-color','#2a2')
		$('.harm#lee'+id).css('background-color','#a22')
		$('#ele'+id).css('color','#fff')
	}
}
