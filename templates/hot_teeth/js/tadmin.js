/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2015 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
$ = jQuery;

var jqSet = 0; 
var jqSetInterval =  setInterval(function(){
	$ = jQuery;
	jqSet++;
	if(jqSet == 50)
		clearInterval(jqSetInterval);
},100);
 
var TabsInit = false;
var HORTabsInit = false;
var surogatID = 0;
var stabitem_n = 0;

function getSurogateID(){
	surogatID++;
	return String(surogatID);
}

function doExport(base,handlerurl,withName){

	if(!withName || withName == '' || withName == undefined) {
		alert('Please enter a valid name for template!');
		return;
	}

	jQuery.ajax({
		url: base + handlerurl,
		type: 'POST',
		data: jQuery('#style-form').serialize(),
		cache: false
	}).done(function( html ) {
		var vals = html.split("|");
		if(vals[0] == "OK"){
			window.location = base + "templates/" + TADMIN_TEMPLATE_FOLDER + "/export/" + vals[1];
		}else{
			alert(html);
		}
	});
	return false;
}

jQuery(window).load(function(){
	jQuery('LI.active').removeClass('active');
   
	jQuery('ul.nav-tabs LI')
							.removeClass('ui-tabs-selected')
							.removeClass('ui-state-active');
   
    if(jQuery("nav.navbar")[0]){
		// Joomla 3
		var optContainer = jQuery('DIV.tab-pane#options');
        var menu = null;
		var dtlPanel = null;
		var fieldpanels = null;
		var maPanel = null;
		
		if(!optContainer[0]){ // Joomla 3.2+

			jQuery('DIV.tab-content').attr('id','options').addClass('tab-pane');

			optContainer = jQuery('.tab-content#options');

			menu = jQuery("<ul id='tadmin_menu'>").prependTo(optContainer);

			fieldpanels = optContainer.find('> DIV.tab-pane');
			
			fieldpanels.each(function(ind){
				var tTilte = jQuery('ul.nav-tabs a[href="#' + jQuery(this).attr('id') + '"]').text();
				jQuery('ul.nav-tabs a[href="#' + jQuery(this).attr('id') + '"]').parent().remove();
				menu.append(jQuery('<li><a href="#' +  jQuery(this).attr('id') + '" >' + tTilte + '</a></li>'));
				jQuery(this).removeClass('tab-pane').addClass('tadmin_tab');
			});

			jQuery(window).load(function(){
				jQuery('.curvedContainer').css('float','left').css('margin-left','0');
				jQuery('.tabcontent:not(:first)').css('display','none');

				jQuery(window).resize(function(){
					jQuery('.curvedContainer').each(function(i){
						jQuery(this).innerWidth(jQuery(this).parent().innerWidth() - jQuery('.curvedContainer').parent().find('.hortabs').innerWidth() - 20);
						});
					});
				jQuery(window).trigger('resize');
			});

		}else{

			optContainer.addClass('tab-pane');
			menu = jQuery("<ul id='tadmin_menu'></ul>").prependTo(optContainer);
			menu.append(jQuery('<li><a href="#tadmin_tab_details">' + TADMIN_LANG.details + '</a></li>'));
			dtlPanel = jQuery("<div class='tadmin_tab' id='tadmin_tab_details'></div>").appendTo(optContainer);
			jQuery(".tab-content #details").appendTo(dtlPanel);
			menu.append(jQuery('<li><a href="#tadmin_tab_menusassignment">' + TADMIN_LANG.menusassignment + '</a></li>'));
			maPanel = jQuery("<div class='tadmin_tab' id='tadmin_tab_menusassignment'></div>").appendTo(optContainer);
			jQuery(".tab-content #assignment").appendTo(maPanel);
			
		}
		
		optContainer.find('> .accordion').remove();
		
		optContainer.tabs({
			fx: { opacity: 'toggle' },
			show: function (event, ui) {
					if (TabsInit) {
						jQuery.cookie('tadmin_tab_cookie', optContainer.tabs("option", "selected") || optContainer.tabs("option", "active"), { expires: 7, path: '/' });
						//jQuery.cookie('subtab_tab_cookie', jQuery(this).attr("id"), { expires: 7, path: '/' });
						jQuery(window).trigger('resize');
					} else TabsInit = true;
				},
			selected: (jQuery.cookie('tadmin_tab_cookie') != null)?		parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0,
			active: (jQuery.cookie('tadmin_tab_cookie') != null)?		parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0
		});
		
		jQuery('DIV#options div.tadmin_tab').each(function(ind){
			if(jQuery(this).find('.subtabstart')[0]){
				var htabs = jQuery('<div class="hortabscontainer"></div>');
				jQuery(this).prepend(htabs);
				var htabs_menu = jQuery('<div class="hortabs"></div>');
				var htabs_tabs = jQuery('<div class="curvedContainer"></div>');
				htabs.append(htabs_menu);
				htabs.append(htabs_tabs);

				var Title = TADMSCRIPTTRANS.general;
				if(jQuery(this).find('> .control-group:first .subtabstart')[0]){
					Title = jQuery(this).find('.control-group:first label').text();
					jQuery(this).find('> .control-group:first').remove();
				}

				var menu_item = jQuery('<div id="stid' + (stabitem_n++) + '" class="tab selected first subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
				var tab_item  = jQuery('<div class="tabcontent" style="display:block"><div class="adminformlist" ></div></div>');
				menu_item.appendTo(htabs_menu);
				tab_item.appendTo(htabs_tabs);

				jQuery(this).find('> .control-group').each(function(index){

					if(jQuery(this).find('.subtabstart')[0]){

						Title = jQuery(this).find('label').text();
						if(!jQuery.trim(Title))
							Title = jQuery(this).find('h3').text();

						menu_item = jQuery('<div id="stid' + (stabitem_n++) + '"  class="tab subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
						tab_item  = jQuery('<div class="tabcontent"  style="display:none"><div class="adminformlist" ></div></div>');

						menu_item.appendTo(htabs_menu);
						tab_item.appendTo(htabs_tabs);

						jQuery(this).remove();

					}else{

						jQuery(this).appendTo(tab_item.find('.adminformlist'));

					}

				});
			menu_item.addClass('last');

			}
		});
		
		jQuery('.tadmin_tab .control-group').append(jQuery('<div style="clear:both;"></div>'));

/////////////////////////////////////////////////////////////////////////////////
	}else{
/////////////////////////////////////////////////////////////////////////////////

		jQuery("<ul id='tadmin_menu'><li><a href='#tadmin_tab1' ><span>" + TADMSCRIPTTRANS.general + "</span></a></li></ul>").appendTo(jQuery('FORM#style-form'));

			var fieldpanels = jQuery('.pane-sliders > .panel');
			fieldpanels.each(function(ind){
			jQuery("#tadmin_menu").append(jQuery('<li><a href="#tadmin_tab' + String(2 + ind) + '" >' + jQuery(jQuery(this).find('.title a')[0]).html() + '</a></li>'));
		});

		var jpan = jQuery("FORM#style-form > DIV[class != 'clr']");
		var dcont = jQuery('<div class="tadmin_tab" id="tadmin_tab1" ></div>');
		dcont.appendTo(jQuery('FORM#style-form'));
		dcont.append(jQuery(jpan[0]).children());
		dcont.append(jQuery(jpan[2]).children());
		dcont.children('fieldset').first().css('float','left');	
	
		jQuery(jQuery(jpan[1]).children()[0]).children('.panel').each(function(ind){
			var ffc = jQuery("<div class='tadmin_tab' id='tadmin_tab" + String(2 + ind) + "'></div>");
			ffc.appendTo(jQuery('FORM#style-form'));
			var fset = jQuery(this).find('.pane-slider .panelform');
			fset.appendTo(ffc);
		});
	
		jQuery(jpan[0]).remove();
		jQuery(jpan[1]).remove();
		jQuery(jpan[2]).remove();
		jQuery('FORM#style-form >.clr').remove();

		/* Moving Assignments Tab to the end - START */
		jQuery('#tadmin_menu li a').first().attr("href","#tadmin_tab8");
		jQuery('#tadmin_menu li').first().clone(true).appendTo('#tadmin_menu');
		jQuery("#tadmin_menu li").first().remove();
		jQuery('div#tadmin_tab1').attr("id","tadmin_tab8");
		/* Moving Assignments Tab to the end - END */
	
		jQuery('FORM#style-form').tabs({
			fx: { opacity: 'toggle' },
			show: function (event, ui) {
				if (TabsInit) {
					jQuery.cookie('tadmin_tab_cookie', jQuery('FORM#style-form').tabs("option", "selected") || optContainer.tabs("option", "active"), { expires: 7, path: '/' });
				} else TabsInit = true;
			},
			selected: (jQuery.cookie('tadmin_tab_cookie') != null)? 	parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0,
			active: (jQuery.cookie('tadmin_tab_cookie') != null)? 		parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0
		});
	
	
		jQuery('FORM#style-form > div[id != "tadmin_tab1"]').each(function(ind){
			var ul = jQuery(this).find('fieldset > ul').first();
			if(ul[0]){
				if(ul.find('.subtabstart')[0]){
					var htabs = jQuery('<div class="hortabscontainer"></div>');
					ul.parent().prepend(htabs);
					var htabs_menu = jQuery('<div class="hortabs"></div>');
					var htabs_tabs = jQuery('<div class="curvedContainer"></div>');
					htabs.append(htabs_menu);
					htabs.append(htabs_tabs);

					var Title = TADMSCRIPTTRANS.general;
					if(ul.children('LI').first().find('.subtabstart')[0]){
						Title = ul.find('LI').first().find('.subtabstart').text();
						ul.children('LI').first().remove();
					}

					var menu_item = jQuery('<div  id="stid' + (stabitem_n++) + '" class="tab selected first subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
					var tab_item  = jQuery('<div class="tabcontent"  style="display:block"><ul class="adminformlist" ></ul></div>');
					menu_item.appendTo(htabs_menu);
					tab_item.appendTo(htabs_tabs);

        			ul.children('LI').each(function(index){
						if(jQuery(this).find('.subtabstart')[0]){
							Title = jQuery(this).find('.subtabstart').text();
							menu_item = jQuery('<div  id="stid' + (stabitem_n++) + '"  class="tab subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
							tab_item  = jQuery('<div class="tabcontent"  style="display:none"><ul class="adminformlist" ></ul><div style="clear:both;"></div></div>');
							menu_item.appendTo(htabs_menu);
							tab_item.appendTo(htabs_tabs);
							jQuery(this).remove();
						}else{
							jQuery(this).appendTo(tab_item.find('.adminformlist'));
						}
					});
					menu_item.addClass('last');
				}
			}
		});
/////////////////////////////////////////////////////////////////////////////////
	}
	
	jQuery('.subtab_menu_item').click(function(){
		jQuery.cookie('subtab_tab_cookie', jQuery(this).attr("id"), { expires: 7, path: '/' });
		jQuery(window).trigger('resize');
	});
	
	if(jQuery('#' + jQuery.cookie('subtab_tab_cookie') )[0]){
		jQuery(window).load(function(){
			jQuery('#' + jQuery.cookie('subtab_tab_cookie') ).trigger('click');
		});
	}
	
});

jQuery(window).load(function(){
 
	if(!HORTabsInit){

		window.hortabswap = function(tab){
			var curMenu= tab;

			curMenu.parent().find('*')	.removeClass("selected")
										.removeClass('ui-tabs-selected')
										.removeClass('ui-state-active');

			curMenu	.addClass("selected")
					.addClass('ui-tabs-selected')
					.addClass('ui-state-active');

			var index = curMenu.index();
			
			curMenu.parent().parent().find(".curvedContainer .tabcontent").css("display","none");
			
			jQuery(curMenu.parent().parent().find(".curvedContainer .tabcontent")[index]).css("display","block");
			
			jQuery(curMenu.attr('href')).show();
			
			var designation = curMenu.closest('.tadmin_tab').attr('id');
			jQuery.cookie(designation, curMenu.index(), { expires: 7, path: '/' });
		};
	
		jQuery(".hortabs .tab").click(function() {
			window.hortabswap(jQuery(this));
		});
		
		
		jQuery('.tadmin_tab').each(function(i){
			if(jQuery.cookie(jQuery(this).attr('id'))){
				window.hortabswap(jQuery(jQuery(this).find('.hortabs .tab')[ parseInt(jQuery.cookie(jQuery(this).attr('id')))]));
			}
		});
		
		HORTabsInit = true;

	}
});

jQuery.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
        encodeURIComponent(key), '=',
        options.raw ? value : encodeURIComponent(value),
        options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
        options.path ? '; path=' + options.path : '',
        options.domain ? '; domain=' + options.domain : '',
        options.secure ? '; secure' : ''
    ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

	
	jQuery(document).on('click',"#tadmin_menu [role='tab']", function(){
		try{
			jQuery.cookie('tadmin_tab_cookie', jQuery(this).index(), { expires: 30, path: '/' });
			jQuery(window).trigger('resize');
		}
		catch(ex){
			
		}
	});

var created = false;

var mini_settings = function(){
	jQuery.minicolors.defaults.theme='bootstrap';
	if(created)
		jQuery(".mini.settings").each(function(){ jQuery(this).minicolors('destroy');});
	jQuery(".mini.settings").each(function(){ jQuery(this).minicolors();});
	created = true;
};

jQuery(document).ready(function(){

	jQuery('.menusSettingsContainer').on('mouseenter', function(){
		jQuery(this).find('.chzn-container').first().mousedown(); 	
	});
	
	jQuery(document).on('click','.menusSettingsTab',mini_settings);
	jQuery(document).on('change','.MenuTypeSelect',mini_settings);

	if(!window.checkColor){
		window.checkColor = function(jEL){
			try{
				var rgbArr = jEL.css('backgroundColor').toLowerCase().replace('rgb(','').replace(')','').split(',');
				rgbArr[0] = parseInt(rgbArr[0]);
				rgbArr[1] = parseInt(rgbArr[1]);
				rgbArr[2] = parseInt(rgbArr[2]);

				if( rgbArr[0] + rgbArr[1] + rgbArr[2] <  380){
					jEL.css('color','white');
				}else{
					jEL.css('color','black');
				}
			}catch(e){}
		};
	}
});

var flipcounter = 0;
jQuery(document).ready(function(){

	if(!window.createFlipYesNo){
		window.createFlipYesNo = function(obj){
			flipcounter++;
			obj = jQuery(obj);
			if(String(obj.attr('flipcreated')) == "1") return;
			obj.attr('flipcreated','1');

			var sHtml = '<ul id="flip' + String(flipcounter) + '" class="flipyesno" style="list-style:none;width:54px;height:24px;margin:2px 0;padding:0;float:left;overflow:hidden;">' +
		              '<li style="position:relative;left:' + (obj.val() == "1" ? "0px" : "-55px" ) + ';background: url(' + TADMIN_JOOMLABASE + '/templates/' + TADMIN_TEMPLATE_FOLDER + '/images/ipbutton.png' + ') no-repeat 0 -14px;width: 108px;height:24px;margin:0;padding:0;"><span></span></li>' +
		           '</ul>';
			var flip_obj = jQuery(sHtml);
			flip_obj.insertAfter(obj);
			flip_obj.disableSelection();

			flip_obj.find('LI').click(function(){
				if(parseInt(jQuery(this).css('left')) == 0){
					jQuery(this).animate({left:'-55px'},300);
					obj.val(0);
				}else{
					jQuery(this).animate({left:'0px'},300);
					obj.val(1);
				}
			}).disableSelection(); 

		};
   
		jQuery('.flipyesno').each(function(ind){
			if(!jQuery(this).closest('.menu_parms_panel')[0])
			window.createFlipYesNo(jQuery(this));
		});
	}

});

jQuery(document).ready(function(){

	jQuery('.width_value input').each(function(ind){
		var WIDTH_ID = jQuery(this).attr('id');
		if(WIDTH_ID!="jform_params_gridSystem"){
			jQuery("#width" + WIDTH_ID).slider({
			value:jQuery(this).val(),
			min: 312,
			max: 1872,
			step: 12,
			slide: function( event, ui ) {
				jQuery("#" + WIDTH_ID).val(  ui.value );
				jQuery("#disp" + WIDTH_ID).html( ui.value + "px");
			},
			orientation: "horizontal"
		});
	
		}
	});

	// make tabs in Menus Settings
	jQuery('div.menusSettingsContainer').hide();
	jQuery('h4.menusSettingsTab').click(function() {
		jQuery(this).toggleClass('opentab');
		jQuery(this).next().slideToggle(300);
	});

	// fixes bug in Firefox
	if(jQuery.browser.mozilla){
		setTimeout(function(){
			jQuery('.LayoutModel *').enableSelection();
		},500);
	}

});

//GOOGLE FONTS INTEGRATION
var menu_name="";
var menu_type="";
var parameter_for="";
var newValHot="";

function saveParams(){

	var menus = JSON.parse(jQuery("#jform_params_mnucfg").val());
	for(var i=0; i<menus.length;i++ ){
		if ( menus[i]['name']==menu_name && menus[i]['type']==menu_type){
				var obj = JSON.parse(newValHot.replace(/\\'/g, "\'"));
				menus[i]['config']["'"+parameter_for+"'"]=newValHot;
				menus[i]['config']["'font_family_"+parameter_for+"'"]=obj['fontFamily'];
				JSON.stringify(menus);
				jQuery("#jform_params_mnucfg").val(menus);
				
				jQuery("[menu='"+menu_name+"']").next().find("[parameter='"+parameter_for+"']").prev().val(obj['fontFamily']).trigger('change');
				jQuery("[menu='"+menu_name+"']").next().find("[parameter='"+parameter_for+"']").prev().attr("data-original-title",obj['fontFamily']);
				jQuery("[menu='"+menu_name+"']").next().find("[parameter='"+parameter_for+"']").val(newValHot);
				//jQuery("[menu='"+menu_name+"']").next().find("[parameter='"+parameter_for+"']").prev().trigger('change');
		}
	}

};
function saveParams2(id){

	jQuery("#"+id).val(newValHot);
	newValHot = newValHot.replace(/\\'/g, "\'");
	var obj = JSON.parse(newValHot);
	jQuery("#"+id).prev().val(obj['fontFamily']).trigger('change');
	jQuery("#"+id).prev().attr("data-original-title", obj['fontFamily']);

};

//PARAMS FOR FONTS IN TAB
function saveParams3(){
	var obj = JSON.parse(newValHot);
	var urlObject = JSON.parse(jQuery("#jform_params_googleUrl").val());
	var singleAdd = [];

	if(typeof urlObject[obj['fontFamily']] !== 'undefined'){
		urlObject[obj['fontFamily']]['variant']=obj['variant'];
		urlObject[obj['fontFamily']]['charsets'] = obj['charsets'];
	}
	else{
		urlObject[obj['fontFamily']]={};
		urlObject[obj['fontFamily']]['variant']=obj['variant'];
		urlObject[obj['fontFamily']]['charsets'] = obj['charsets'];
	}
	jQuery("#jform_params_googleUrl").val(JSON.stringify(urlObject));
	jQuery(".googleFontPreview").remove();
	Joomla.submitbutton('style.apply');
};

function removeFonts(){
	var urlObject = JSON.parse(jQuery("#jform_params_googleUrl").val());
	var for_remove = [];
	var tmp1 = {};
	tmp1['fontFamily'] = "Arial, Helvetica, sans-serif";
	tmp1['fontWeight'] = "normal";
	tmp1['fontStyle'] = "normal";
	
	jQuery('.selected_fonts input:checked').each(function(){
		var val = jQuery(this).val();
		
		jQuery('[parameter="font_family_hotfont"]').each(function(){
			var tmp = JSON.parse(jQuery(this).val().replace(/\\'/g, "\'"));
			if(tmp['fontFamily'] == val ){
				
				var menu_name = jQuery(this).parents('div.menusSettingsContainer').find('[menu]').attr("menu");
				var menu_type = jQuery(this).parents('div.menusSettingsContainer').find('[menu]').val();
				
				var menus = JSON.parse(jQuery("#jform_params_mnucfg").val());
				for(var i=0; i<menus.length;i++ ){
					if ( menus[i]['name']==menu_name && menus[i]['type']==menu_type){
							menus[i]['config']['font_family_hotfont']=tmp1;
							menus[i]['config']['font_family_hotfont_lbl']=tmp1['fontFamily'];
							JSON.stringify(menus);
							jQuery("#jform_params_mnucfg").val(menus);
							
							jQuery("[menu='"+menu_name+"']").next().find('[parameter="font_family_hotfont"]').prev().val(tmp1['fontFamily']).trigger('change');
							jQuery("[menu='"+menu_name+"']").next().find('[parameter="font_family_hotfont"]').prev().attr("data-original-title",tmp1['fontFamily']);
							jQuery("[menu='"+menu_name+"']").next().find('[parameter="font_family_hotfont"]').val(JSON.stringify(tmp1));
							//jQuery("[menu='"+menu_name+"']").next().find("[parameter='"+parameter_for+"']").prev().trigger('change');
					}
				}
				
				/*
				jQuery(this).val(JSON.stringify(tmp1));
				jQuery(this).prev().val("Arial, Helvetica, sans-serif");*/
			}
		});
		jQuery("input.font").each(function(){
			var tmp = JSON.parse(jQuery(this).val().replace(/\\'/g, "\'"));
			if(tmp['fontFamily'] == val ){
				jQuery(this).val(JSON.stringify(tmp1));
			}
		});
		
		delete urlObject[val];
	});
	jQuery("#jform_params_googleUrl").val(JSON.stringify(urlObject));
	
	setTimeout(function(){
		Joomla.submitbutton('style.apply');
	},500);
}

//this function adds some options to already included fonts
/*
function addCharset(cur_ind){
	var obj = JSON.parse(newValHot);
	var charsets = [];
	jQuery("#tooltip_font"+cur_ind+" input[checked='checked']").each(function(){
			charsets.push(jQuery(this).attr("text"));
	});
	obj['charsets'] = charsets;
	newValHot = JSON.stringify(obj);
	
	var urlObject = JSON.parse(jQuery("#jform_params_googleUrl").val());
	var singleAdd = [];

	if(typeof urlObject[obj['fontFamily']] !== 'undefined'){
		if(urlObject[obj['fontFamily']]['variant'].indexOf(obj['variant'])==-1){
			var str = urlObject[obj['fontFamily']]['variant'];
			str+=","+obj['variant'];
			urlObject[obj['fontFamily']]['variant']=str;
		}
		
		for (var m=0; m<obj['charsets'].length; m++){
			if(jQuery.inArray(obj['charsets'][m],urlObject[obj['fontFamily']]['charsets'])==-1)
			{
				var arr= urlObject[obj['fontFamily']]['charsets'];
				arr.push(obj['charsets'][m]);
				urlObject[obj['fontFamily']]['charsets']=arr;
			}
		}
	}
	else{
		urlObject[obj['fontFamily']]={};
		urlObject[obj['fontFamily']]['variant']=obj['variant'];
		urlObject[obj['fontFamily']]['charsets'] = obj['charsets'];
	}
	jQuery("#jform_params_googleUrl").val(JSON.stringify(urlObject));
};*/

//this function deletes all unused google font
/*
function recheckFamilies(){
	var urlObject2 = JSON.parse(jQuery("#jform_params_googleUrl").val());
	var active_families = [];
	jQuery("input[json='true']").each(function(){
		var obj = JSON.parse(jQuery(this).val().replace(/\\'/g, "\'"));
		if(typeof obj['googleFont'] !== 'undefined')
			if(obj['googleFont']=="yes"){
				active_families.push(obj['fontFamily']);
			}
	});
	for(var object in urlObject2){
		if(jQuery.inArray(object,active_families) ==-1){
			delete urlObject2[object];
		}
	}

	jQuery("#jform_params_googleUrl").val(JSON.stringify(urlObject2)).trigger('change');
};
*/
function initializeForSystem(){
	jQuery("#sbox-window .chzn-container").remove();
	jQuery("#sbox-window select").chosen();
};
function initializeForGoogle(){
	jQuery("#sbox-window .chzn-container").remove();
	jQuery("#sbox-content select").multiselect();
};
function initializeForGoogleMenu(){
	jQuery("#sbox-window .chzn-container").remove();
	jQuery("#sbox-content select").multiselect();
};
(function() {
	var wf = document.createElement('script');
	wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
	  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	wf.type = 'text/javascript';
	wf.async = 'true';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(wf, s);
})();
var once = true;
jQuery(document).ready(function(){
		
		jQuery('[data-toggle="tooltip_font"]').tooltip();
	
		var fromSearch = false;
		var weightId = ""; 
		var styleId = "";
		var family = "";
		var style = "";
		var weight = "";
		var id = "";
		var from_menu = false;
		var object = [];
		var categories = [];
		var charsets = [];
		var subset = "";
		
		var weights = {
				100:"Thin",
				200:"Extra Light",
				300:"Light",
				400:"Normal",
				500:"Medium",
				600:"Semi Bold",
				700:"Bold",
				800:"Extra Bold ",
				900:"Black"
			}
		
		var link=jQuery("link[href*='tadmin.css']").attr("href");
		var first = link.indexOf("templates/");
		var second = link.indexOf("/css");
		
		link = link.substring(first+10,second);
		var json_google;
		jQuery.getJSON('../templates/'+link+'/js/google-fonts.json', function(){	 
		}).done(function( json ) {
			json_google = json;
		}).fail(function() {
				alert("Google fonts can't be loaded");
		});
		
			  
	
		function changeText(){
			family = jQuery("#sbox-window select:eq(0)").val();
			weight = jQuery('#sbox-window select:eq(1)').val();
			style = jQuery('#sbox-window select:eq(2)').val();
		
			jQuery("#sbox-window .textPreview").css({
				'font-family' : family,
				'font-style' : style,
				'font-weight' : weight
			});
				
			newValHot = JSON.stringify({'fontFamily':family,'fontWeight':weight,'fontStyle':style,'googleFont':'no'});
			newValHot = newValHot.replace(/\'/g, "\\'");

			if(from_menu){
				jQuery("#system button").first().attr('onclick',"saveParams();window.parent.jModalClose();");
			}
			else{
				jQuery("#system button").first().attr('onclick',"saveParams2('"+id+"');window.parent.jModalClose();");
			}
			
			
		};
		jQuery(document).on('change',"select[menu]",function(){
			SqueezeBox.assign(jQuery('a.modal.menu').get(), {
					parse: 'rel'
				});
		});
		jQuery(document).on('mousedown','.tabcontent .system, .menusSettingsContainer .system',function(){
			newValHot = "";
			
			from_menu = jQuery(this).hasClass('menu');
			if(from_menu && once)
			{  

				once = false;	
				SqueezeBox.initialize({});
				SqueezeBox.assign($('a.modal').get(), {
					parse: 'rel'
				});

			}
			
			jQuery("#system .fontPreview").html("");
			var for_parse = jQuery(this).prev().val().replace(/\\'/g, "\'");
			for_parse = for_parse.replace(/\\'/g, "\'");
			var currentValues = JSON.parse(for_parse);
			
			family = currentValues['fontFamily'];
			weight = currentValues['fontWeight'];
			style = currentValues['fontStyle'];
			var google_font = currentValues['googleFont'];

			id = jQuery(this).prev().attr("id");
			
			if(google_font=="yes"){
				setTimeout(function(){
					jQuery("#sbox-window select:eq(0)").val("Arial, Helvetica, sans-serif").trigger("liszt:updated");
					jQuery('#sbox-window select:eq(1)').val('normal').trigger("liszt:updated");
					jQuery('#sbox-window select:eq(2)').val('normal').trigger("liszt:updated");
				},500);
				
				jQuery("#system .textPreview").css({
					'font-family' : "Arial, Helvetica, sans-serif",
					'font-style' : 'normal',
					'font-weight' : 'normal'
				});
				jQuery("#system .fontPreview").append("Arial, Helvetica, sans-serif");
				family = "Arial, Helvetica, sans-serif";
				weight = "normal";
				style = "normal";
			}
			else {
				setTimeout(function(){
					jQuery("#sbox-window select:eq(0)").val(family).trigger("liszt:updated");
					jQuery('#sbox-window select:eq(1)').val(weight).trigger("liszt:updated");
					jQuery('#sbox-window select:eq(2)').val(style).trigger("liszt:updated");
				},500);
				
				jQuery("#system .textPreview").css({
					'font-family' : family,
					'font-style' : style,
					'font-weight' : weight
				});
				jQuery("#system .fontPreview").append(family);
			}
			
			//newValHot = JSON.stringify({'fontFamily':family,'fontWeight':weight,'fontStyle':style,'googleFont':'no'}).replace(/'/g, '\\\'');
			newValHot = JSON.stringify({'fontFamily':family,'fontWeight':weight,'fontStyle':style,'googleFont':'no'});
			newValHot = newValHot.replace(/\'/g, "\\'");
			
			
			
			if(from_menu){
				menu_name = jQuery(this).parents('div.menusSettingsContainer').find('[menu]').attr("menu");
				menu_type = jQuery(this).parents('div.menusSettingsContainer').find('[menu]').val();
				parameter_for = jQuery(this).prev().attr("parameter");
				
				jQuery("#system button").first().attr('onclick',"saveParams();window.parent.jModalClose();");
			}
			else{
				jQuery("#system button").first().attr('onclick',"saveParams2('"+id+"');window.parent.jModalClose();");
			}
			
		});
		jQuery(document).on('change',"#sbox-window .fonts select, #sbox-window .weightAndStyle select",function(){
			if(jQuery(this).val().length>15){
				jQuery("#sbox-window .fontPreview").html("");
				jQuery("#sbox-window .fontPreview").append(jQuery(this).val());
			}
			changeText();
			
		});
		
		jQuery(document).keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				event.preventDefault();   
				jQuery(".search_field").trigger("change");
				
			}
		});
		
		//ZA GOOGLE FONT
		var gFont = false;
		//FIRST CLICK
		jQuery(document).on('mousedown','.tabcontent .google, .menusSettingsContainer .google',function(e){
			from_menu = jQuery(this).hasClass('menu');
			gFont = true;
			newValHot = "";
			object = [];
			if(from_menu && once)
			{  

				once = false;	
				SqueezeBox.initialize({});
				SqueezeBox.assign(jQuery('a.modal').get(), {
					parse: 'rel'
				});

			}
			if(from_menu){
				menu_name = jQuery(this).parents('div.menusSettingsContainer').find('[menu]').attr("menu");
				menu_type = jQuery(this).parents('div.menusSettingsContainer').find('[menu]').val();
				parameter_for = jQuery(this).prev().prev().attr("parameter");	
				jQuery("#google button").first().attr('onclick',"saveParams();window.parent.jModalClose();");
			}
			else{
				id = jQuery(this).siblings("input[type='hidden']").attr("id");
				jQuery("#google button").first().attr('onclick',"saveParams2('"+id+"');window.parent.jModalClose();");
			}
			
			var for_parse = jQuery(this).prev().prev().val();
			for_parse = for_parse.replace(/\\'/g,"'");
			var currentValues = JSON.parse(for_parse);
			
			//added
			var googleFonts = JSON.parse(jQuery("#jform_params_googleUrl").val());
			
			var keys = Object.keys(googleFonts);
			
			var k = 0;
			for(i = 0 ; i < json_google.items.length; i++){
				
				if(jQuery.inArray(json_google.items[i]['family'],keys)!=-1){
					object[k]=json_google.items[i];
					if(googleFonts[json_google.items[i]['family']]['variant'].constructor === Array)
						object[k]['variants']=googleFonts[json_google.items[i]['family']]['variant'];
					else
					{
						var temp = [];
						temp.push(googleFonts[json_google.items[i]['family']]['variant']);
						object[k]['variants']=temp;
					}
						
					object[k]['subsets']=googleFonts[json_google.items[i]['family']]['charsets'];
					k++;
				}
				/*
				if(jQuery.inArray(subset,json_google.items[i]['subsets'])!=-1){
					if(jQuery.inArray(json_google.items[i]['category'],categories)!=-1){
						object[k]=json_google.items[i];
						k++;
					}
				}*/
			}
	
	
			setTimeout(function(){	
				jQuery("#sbox-content .googleFontPreview")[0].onscroll = function(){
				jQuery('#sbox-content .googleFontPreview [data-toggle="tooltip"]').popover('hide');
				jQuery('#sbox-content .in.close_it').collapse('hide');
			
				setTimeout(function(){
					renderFont();
				},100);
					
				}
				apendFonts();
				renderFont();
			},500);
			
			setTimeout(function(){
				jQuery('.multiselect-container.dropdown-menu').first().find('li a label').each(function(){
					for(var k=0;k<currentValues['categories'].length;k++){
						if(jQuery(this).find('input').val() == currentValues['categories'][k])
							jQuery(this).trigger('click');
					}
				});
				
				jQuery('.multiselect-container.dropdown-menu').last().find('li a label').each(function(){
					if(jQuery(this).find('input').val() == currentValues['subset'])
						jQuery(this).trigger('click');							
				});
				
				jQuery("#collapseList"+currentValues['index']+" input[value='"+currentValues['variant']+"']").trigger('click');
				
				jQuery("#tooltip_font"+currentValues['index']+" input").each(function(){
					for(k=0 ; k< currentValues['charsets'].length;k++){
						if(jQuery(this).attr("text")==currentValues['charsets'][k]){
							jQuery(this).attr('checked','checked');
						}
					}
				});
				
				jQuery(".well[num='"+currentValues['index']+"']").trigger('click');
				
				smooth_scroll();
			},500);
			/*
			else{
				setTimeout(function(){
				jQuery('.multiselect-container.dropdown-menu').first().find('li a label').each(function(){	
						if(jQuery(this).find('input').val() == 'sans-serif')
							jQuery(this).trigger('click');
					
				});
				
				jQuery('.multiselect-container.dropdown-menu').last().find('li a label').each(function(){
					if(jQuery(this).find('input').val() == 'latin')
						jQuery(this).trigger('click');							
				});
				},500);
			}*/
			
		});
		
		function smooth_scroll(){
			container = jQuery('.googleFontPreview').last();
			scrollTo = jQuery('.well.selected');
			
			container.animate({
				scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
				},100);
		};
		//FONT CHANGE
		jQuery(document).on('click',"#sbox-content .panel-collapse input[type='checkbox']", function(){
			var current_style= jQuery(this).next('span').attr('style');
			var index = jQuery(this).parents('.panel-collapse').attr('id').replace(/\D/g,'');
			var current_label = jQuery(this).prev().html();
			jQuery(".well[num='"+index+"']").find('.custom_label p').html(current_label);
			jQuery(".well[num='"+index+"']").find('.custom_label span').attr("style",current_style);
			jQuery(".well[num='"+index+"']").find('.custom_label span').attr("variant",jQuery(this).next('span').attr('variant'));
			jQuery(this).parent().siblings('div').find('input').prop('checked',false);
			jQuery('#sbox-content .in').collapse('hide');
			
		});
		
		jQuery(document).on('click',".popover.in input[type='checkbox']", function(){
			var id_new = jQuery(this).parents('.popover').prev().attr("data-pop");
			var property = jQuery(this).attr('text');
			if(jQuery(this).attr('checked')){
				jQuery("#"+id_new).find('input[text="'+property+'"]').attr('checked','checked');
			}
			else
				jQuery("#"+id_new).find('input[text="'+property+'"]').attr('checked',false);
			
			
		});
		
		jQuery(document).on('mouseleave','.popover',function(){
			var id_new = jQuery(this).prev().attr("data-pop");
			jQuery('#sbox-content .googleFontPreview  [data-toggle="tooltip"]').popover('hide');
			
		});	
		
		jQuery(document).on('click',"a[data-toggle='tooltip']",function(e){
			e.stopImmediatePropagation();
		});
		
		//FONT CHANGE AND SAVE VALUES
		
		jQuery(document).on('click','#sbox-content .well, #sbox-content .panel-collapse.in input[type="checkbox"]', function(){
			if((jQuery(this).hasClass('well') && jQuery(this).hasClass('unselected')) || jQuery(this).hasClass('selected')){
				//solving class problems
				jQuery(this).removeClass('unselected');
				jQuery(this).addClass('selected');
				jQuery(this).siblings('.well').removeClass('selected');
				jQuery(this).siblings('.well').addClass('unselected');
				jQuery(this).siblings('.panel-collapse').addClass('close_it');
				jQuery(this).next().removeClass('close_it');
				var index = jQuery(this).attr('num');
				var current_family = object[index].family;
				if(fromSearch){
					var cat = [object[index].category];
					categories = cat;
					subset = "latin";
					
					var k = 0;
					for(i = 0 ; i < json_google.items.length; i++){
						if(jQuery.inArray(subset,json_google.items[i]['subsets'])!=-1){
							if(jQuery.inArray(json_google.items[i]['category'],categories)!=-1){
								k++;
								if(json_google.items[i]['family'] == current_family){
									index = k-1;
									break;
								}
									
							}
						}
					}
				}
				else{
					categories = jQuery('#sbox-window .cat').find('select').val();
					subset = jQuery('#sbox-window .sub').find('select').val();
				}
				
				//adding button action

				var variant = jQuery(this).find('.custom_label span').attr('variant');
				
				var style_sub = variant.replace(/[0-9]/g, '');
				var weight_sub = variant.replace(/\D/g,'');
				if(style_sub == weight_sub){
					style_sub="normal";
				}
				if(weight_sub==""){
					weight_sub = "400";
				}
				if(style_sub == "" || style_sub == "regular"){
					style_sub = "normal";
				}
				smooth_scroll();
				newValHot = JSON.stringify({'fontFamily':current_family,'fontWeight':weight_sub,'fontStyle':style_sub,'googleFont':'yes', 'variant':variant, 'categories':categories, 'subset':subset,'index':index,'charsets':charsets});
				//newValHot = newValHot.replace(/'/g, '\\\'');	
			}
			else if(jQuery(this).is('input')){
				var num = jQuery(this).parents('.panel-collapse').prev().attr('num');
				setTimeout(function(){
					jQuery(".well[num='"+num+"']").trigger('click');
				},500);
			}
		});
			
		function loadFonts(){
			fromSearch = false;
			jQuery("#features .search_field").val("");
			var k = 0;
			for(i = 0 ; i < json_google.items.length; i++){
				if(jQuery.inArray(subset,json_google.items[i]['subsets'])!=-1){
					if(jQuery.inArray(json_google.items[i]['category'],categories)!=-1){
						object[k]=json_google.items[i];
						k++;
					}
				}
			}
		
			apendFonts2();
		};
		
		function loadFontsSearch(term){
			//OPTIONAL
			fromSearch = true;
			if(term==""){
				
				loadFonts();
				return;
			}
			var k = 0;
			for(i = 0 ; i < json_google.items.length; i++){	
				if(json_google.items[i]['family'].toLowerCase().indexOf(term.toLowerCase())>=0){
					object[k]=json_google.items[i];
					k++;
				}
			}
			
			apendFonts2();
		};
		
		function apendFonts(){
			jQuery('#sbox-window .googleFontPreview').html("");
			for(i = 0; i < object.length; i++){
				var style_sub = object[i].variants[0].replace(/[0-9]/g, '');
				var weight_sub = object[i].variants[0].replace(/\D/g,'');
				if(style_sub == weight_sub){
					style_sub="normal";
				}
				if(weight_sub==""){
					weight_sub = "400";
				}
				if(style_sub == "" || style_sub == "regular"){
					style_sub = "normal";
				}
				jQuery('#sbox-window .googleFontPreview').append("<div class='well unselected' num='"+i+"'> <div><span style='font-weight: 900;'>"+object[i].family+"</span><div style='display: inline-block; margin-left: 20px;'><a href='#collapseList"+i+"' aria-expanded='true' data-toggle='collapse' aria-controls='collapseListGroup"+i+"'>"+object[i].variants.length+" Styles</a></div><span style='float: right;'><a data-toggle='tooltip' data-pop='tooltip_font"+i+"' data-placement='bottom' title='Charsets'>"+object[i].subsets.length+" Charsets</a></span></div><hr><div class='custom_label not_loaded'><p>"+weights[weight_sub]+"  "+weight_sub+" "+(style_sub == "normal" ? "" : style_sub)+"</p><span style='font-family:"+object[i].family+"; font-style:"+style_sub+"; font-size:28px; font-weight:"+parseInt(weight_sub)+";' variant='"+object[i].variants[0]+"'>Wizard boy Jack loves the grumpy Queen's fox.</div></div><div id='collapseList"+i+"' class='panel-collapse collapse' role='tabpanel' aria-expanded='true'></div>");
			}
			
			for(i = 0; i < object.length; i++){
				jQuery("#sbox-window .googleFontPreview #collapseList"+i+"").append("<p style='font-weight: 900;'>"+object[i].family+" <span style='font-weight: 400;'>"+object[i].variants.length+" Styles "+object[i].subsets.length+" Charsets</span></p>");
				for(k = 0; k < object[i].variants.length; k++){
					var style_sub = object[i].variants[k].replace(/[0-9]/g, '');
					var weight_sub = object[i].variants[k].replace(/\D/g,'');
					if(style_sub == weight_sub){
						style_sub="normal";
					}
					if(weight_sub==""){
						weight_sub = "400";
					}
					if(style_sub == "" || style_sub == "regular"){
						style_sub = "normal";
					}
					if(k==0){
						jQuery("#sbox-window .googleFontPreview #collapseList"+i+"").append("<div class='checkbox'><p>"+weights[weight_sub]+"  "+weight_sub+" "+(style_sub == "normal" ? "" : style_sub)+"</p><input type='checkbox' value='"+object[i].variants[k]+"' checked='checked'><span style='font-family:"+object[i].family+"; font-style:"+style_sub+"; font-size:22px; font-weight:"+parseInt(weight_sub)+";'  variant='"+object[i].variants[k]+"'>Wizard boy Jack loves the grumpy Queen's fox.</span></div>");
					}
					else{
						jQuery("#sbox-window .googleFontPreview #collapseList"+i+"").append("<div class='checkbox'><p>"+weights[weight_sub]+"  "+weight_sub+" "+(style_sub == "normal" ? "" : style_sub)+"</p><input type='checkbox' value='"+object[i].variants[k]+"'><span style='font-family:"+object[i].family+"; font-style:"+style_sub+"; font-size:22px; font-weight:"+parseInt(weight_sub)+";'  variant='"+object[i].variants[k]+"'>Wizard boy Jack loves the grumpy Queen's fox.</span></div>");
					}
				}
				
			}
		};
		
		
		function renderFont(){
			var fontStringAll=[];
			
			jQuery('#sbox-window .googleFontPreview div.well').each(function(){
				
				if(jQuery(this).visible()){	
					var i = jQuery(this).attr("num");
					var fontString = "";
					fontString+= object[i].family.replace(/\s/g,"+");
					fontString+= ":";
					var k=0;
					for(k = 0; k<object[i].variants.length-1; k++){
						fontString+=object[i].variants[k]+",";
					}
					fontString+=object[i].variants[k];
					fontStringAll.push(fontString);
					
					jQuery(this).find('.custom_label').removeClass("not_loaded");
					
				}
				
			});
			
			if(fontStringAll.length > 0){
					WebFont.load({
						google: { 
							families: fontStringAll 
					} 
				}); 
			}
			
			for(i = 0; i < object.length; i++){
				if(jQuery("#sbox-window .googleFontPreview .well[num="+i+"]").find("div[id='tooltip_font"+i+"']").length>=1)
					continue;
				var prepared_tooltip = "";
				for(k = 0; k < object[i].subsets.length; k++){
					if(object[i].subsets[k]!="latin")
						prepared_tooltip+="<input type='checkbox' text='"+object[i].subsets[k]+"'>"+object[i].subsets[k]+"<br>";
					else
						prepared_tooltip+="<input type='checkbox' checked='checked' text='"+object[i].subsets[k]+"'>"+object[i].subsets[k]+"<br>";
				}
				jQuery("#sbox-window .googleFontPreview .well[num="+i+"]").append("<div style='display: none;' id='tooltip_font"+i+"' class='hidden_checkbox'>"+prepared_tooltip+"</div>");
			}
			
			
			jQuery('#sbox-content .googleFontPreview [data-toggle="tooltip"]').popover({
				delay: { show: 500, hide: 0 },
				placement: 'bottom',
				trigger: 'click',
				html: true,
				content: function() {
					
					
					var pop_dest = jQuery(this).attr("data-pop");
					return jQuery("#"+pop_dest).html();
				}
			});
		};	
		
		jQuery(document).on('change',"#features .search_field",function(){
			categories = jQuery('#features .cat').find('select').val();
			subset = jQuery('#features .sub').find('select').val();
			object = [];
			
			loadFontsSearch(jQuery(this).val());
			
			renderFont2();
			
			jQuery("#features .googleFontPreview")[0].onscroll = function(){
				jQuery('#features .googleFontPreview [data-toggle="tooltip"]').popover('hide');
				jQuery('#features .in.close_it').collapse('hide');
			
				setTimeout(function(){
					renderFont2();
				},100);
				
			}
			
			jQuery("#sbox-content")[0].onscroll = function(){
				jQuery('#sbox-content .googleFontPreview  [data-toggle="tooltip"]').popover('hide');
				jQuery('#sbox-content .in.close_it').collapse('hide');
				
				setTimeout(function(){
					renderFont2();
				},100);
				
			}
		});
		/*
		jQuery(document).on('change',"#sbox-window .multiselect-container",function(){	
		
			categories = jQuery('#sbox-window .cat').find('select').val();
			subset = jQuery('#sbox-window .sub').find('select').val();
			object = [];
		
			loadFonts();
			
			renderFont();
			
			jQuery("#sbox-content")[0].onscroll = function(){
				jQuery('#sbox-content .googleFontPreview  [data-toggle="tooltip"]').popover('hide');
				jQuery('#sbox-content .in.close_it').collapse('hide');
				
				setTimeout(function(){
					renderFont();
				},100);
				
			}
			jQuery("#sbox-content .googleFontPreview")[0].onscroll = function(){
				jQuery('#sbox-content .googleFontPreview [data-toggle="tooltip"]').popover('hide');
				jQuery('#sbox-content .in.close_it').collapse('hide');
			
				setTimeout(function(){
					renderFont();
				},100);
				
			}
			
			
		});*/
		
		
		//FEATURES SCRIPT
		
		var googleFonts = JSON.parse(jQuery("#jform_params_googleUrl").val());
		
		var keys = Object.keys(googleFonts);
		if(keys.length>0){		
			jQuery(".selected_fonts .note").text("Included fonts:");
			for(i = 0; i< keys.length; i++){
				jQuery(".selected_fonts").append("<input type='checkbox' value='"+keys[i]+"'>"+keys[i]+"<br>")
			}
		}
		else{
			jQuery('.selected_fonts').next('button').attr("disabled","");
			jQuery(".selected_fonts .note").text("No fonts selected");
		}
		
		jQuery(document).on('click','#features .well, #features .panel-collapse.in input[type="checkbox"]', function(){
			
			if((jQuery(this).hasClass('well') && jQuery(this).hasClass('unselected')) || jQuery(this).hasClass('selected')){
				//solving class problems
				jQuery(this).removeClass('unselected');
				jQuery(this).addClass('selected');
				jQuery(this).siblings('.well').removeClass('selected');
				jQuery(this).siblings('.well').addClass('unselected');
				jQuery(this).siblings('.panel-collapse').addClass('close_it');
				jQuery(this).next().removeClass('close_it');
				var index = jQuery(this).attr('num');
				var current_family = object[index].family;
			
				categories = jQuery('#features .cat').find('select').val();
				subset = jQuery('#features .sub').find('select').val();
				
				var charsets = [];
				jQuery("#tooltip_font2"+index).first().find("input[checked='checked']").each(function(){
					charsets.push(jQuery(this).attr("text"));
				});
				
				var variants = [];
				jQuery("#collapseList2"+index).find("input:checked").each(function(){
					variants.push(jQuery(this).val());
				});
			
				//adding button action

				var variant = jQuery(this).find('.custom_label span').attr('variant');
				
				var style_sub = variant.replace(/[0-9]/g, '');
				var weight_sub = variant.replace(/\D/g,'');
				if(style_sub == weight_sub){
					style_sub="normal";
				}
				if(weight_sub==""){
					weight_sub = "400";
				}
				if(style_sub == "" || style_sub == "regular"){
					style_sub = "normal";
				}
			
				//smooth_scroll();
				newValHot = JSON.stringify({'fontFamily':current_family,'fontWeight':weight_sub,'fontStyle':style_sub,'googleFont':'no', 'variant':variants, 'categories':categories, 'subset':subset,'index':index,'charsets':charsets});
		
			}
			else if(jQuery(this).is('input')){
				var num = jQuery(this).parents('.panel-collapse').prev().attr('num');
				setTimeout(function(){
					jQuery(".well[num='"+num+"']").trigger('click');
				},500);
			}
			
		});
		
		
		
		jQuery(document).on("change","#category, #subset",function(){
			object = [];
			categories = jQuery('#features .cat').find('select').val();
			subset = jQuery('#features .sub').find('select').val();
			var k = 0;
			for(i = 0 ; i < json_google.items.length; i++){
				if(jQuery.inArray(subset,json_google.items[i]['subsets'])!=-1){
					if(jQuery.inArray(json_google.items[i]['category'],categories)!=-1){
						object[k]=json_google.items[i];
						k++;
					}
				}
			}
		
			apendFonts2();
			renderFont2();
			
			jQuery("#features .googleFontPreview")[0].onscroll = function(){
				jQuery('#features .googleFontPreview [data-toggle="tooltip"]').popover('hide');
				jQuery('#features .in.close_it').collapse('hide');
			
				setTimeout(function(){
					renderFont2();
				},100);
				
			}
		});
		
		function apendFonts2(){
			jQuery('#features .googleFontPreview').html("");
			for(i = 0; i < object.length; i++){
				var style_sub = object[i].variants[0].replace(/[0-9]/g, '');
				var weight_sub = object[i].variants[0].replace(/\D/g,'');
				if(style_sub == weight_sub){
					style_sub="normal";
				}
				if(weight_sub==""){
					weight_sub = "400";
				}
				if(style_sub == "" || style_sub == "regular"){
					style_sub = "normal";
				}
				jQuery('#features .googleFontPreview').append("<div class='well unselected' num='"+i+"'> <div><span style='font-weight: 900;'>"+object[i].family+"</span><div style='display: inline-block; margin-left: 20px;'><a href='#collapseList2"+i+"' aria-expanded='true' data-toggle='collapse' aria-controls='collapseList2Group"+i+"'>"+object[i].variants.length+" Styles</a></div><span style='float: right;'><a data-toggle='tooltip' data-pop='tooltip_font2"+i+"' data-placement='bottom' title='Charsets'>"+object[i].subsets.length+" Charsets</a></span></div><hr><div class='custom_label not_loaded'><p>"+weights[weight_sub]+"  "+weight_sub+" "+(style_sub == "normal" ? "" : style_sub)+"</p><span style='font-family:"+object[i].family+"; font-style:"+style_sub+"; font-size:28px; font-weight:"+parseInt(weight_sub)+";' variant='"+object[i].variants[0]+"'>Wizard boy Jack loves the grumpy Queen's fox.</div></div><div id='collapseList2"+i+"' class='panel-collapse collapse' role='tabpanel' aria-expanded='true'></div>");
			}
			
			for(i = 0; i < object.length; i++){
				jQuery("#features .googleFontPreview #collapseList2"+i+"").append("<p style='font-weight: 900;'>"+object[i].family+" <span style='font-weight: 400;'>"+object[i].variants.length+" Styles "+object[i].subsets.length+" Charsets</span></p>");
				for(k = 0; k < object[i].variants.length; k++){
					
					var style_sub = object[i].variants[k].replace(/[0-9]/g, '');
					var weight_sub = object[i].variants[k].replace(/\D/g,'');
					if(style_sub == weight_sub){
						style_sub="normal";
					}
					if(weight_sub==""){
						weight_sub = "400";
					}
					if(style_sub == "" || style_sub == "regular"){
						style_sub = "normal";
					}
					if(k == 0){
						jQuery("#features .googleFontPreview #collapseList2"+i+"").append("<div class='checkbox'><p>"+weights[weight_sub]+"  "+weight_sub+" "+(style_sub == "normal" ? "" : style_sub)+"</p><input type='checkbox' value='"+object[i].variants[k]+"' checked='checked'><span style='font-family:"+object[i].family+"; font-style:"+style_sub+"; font-size:22px; font-weight:"+parseInt(weight_sub)+";'  variant='"+object[i].variants[k]+"'>Wizard boy Jack loves the grumpy Queen's fox.</span></div>");
					}
					else{
						jQuery("#features .googleFontPreview #collapseList2"+i+"").append("<div class='checkbox'><p>"+weights[weight_sub]+"  "+weight_sub+" "+(style_sub == "normal" ? "" : style_sub)+"</p><input type='checkbox' value='"+object[i].variants[k]+"'><span style='font-family:"+object[i].family+"; font-style:"+style_sub+"; font-size:22px; font-weight:"+parseInt(weight_sub)+";'  variant='"+object[i].variants[k]+"'>Wizard boy Jack loves the grumpy Queen's fox.</span></div>");
					}
				}
				
			}
		};
		
		function renderFont2(){
			var fontStringAll=[];
			
			jQuery('#features .googleFontPreview div.well').each(function(){
				
				if(jQuery(this).visible()){	
					var i = jQuery(this).attr("num");
					var fontString = "";
					fontString+= object[i].family.replace(/\s/g,"+");
					fontString+= ":";
					var k=0;
					for(k = 0; k<object[i].variants.length-1; k++){
						fontString+=object[i].variants[k]+",";
					}
					fontString+=object[i].variants[k];
					fontStringAll.push(fontString);
					
					jQuery(this).find('.custom_label').removeClass("not_loaded");
					
				}
				
			});
			if(fontStringAll.length > 0){
					WebFont.load({
						google: { 
							families: fontStringAll 
					} 
				}); 
			}
			
			for(i = 0; i < object.length; i++){
				if(jQuery("#sbox-window .googleFontPreview .well[num="+i+"]").find("div[id='tooltip_font2"+i+"']").length>=1)
					continue;
				var prepared_tooltip = "";
				for(k = 0; k < object[i].subsets.length; k++){
					if(object[i].subsets[k]!="latin")
						prepared_tooltip+="<input type='checkbox' text='"+object[i].subsets[k]+"'>"+object[i].subsets[k]+"<br>";
					else
						prepared_tooltip+="<input type='checkbox' checked='checked' text='"+object[i].subsets[k]+"'>"+object[i].subsets[k]+"<br>";
				}
				jQuery("#features .googleFontPreview .well[num="+i+"]").append("<div style='display: none;' id='tooltip_font2"+i+"' class='hidden_checkbox'>"+prepared_tooltip+"</div>");
			}
			
			
			jQuery('#features .googleFontPreview [data-toggle="tooltip"]').popover({
				delay: { show: 500, hide: 0 },
				placement: 'bottom',
				trigger: 'click',
				html: true,
				content: function() {
					
					
					var pop_dest = jQuery(this).attr("data-pop");
					return jQuery("#"+pop_dest).html();
				}
			});
		};	
		
		/*
		setTimeout(function(){
			jQuery(".tabcontent:nth-child(5) #subset").trigger("change");
		},500);*/
		

});
//END GOOGLE FONT INTEGRATION 

//LAYOUT SETTINGS

function initializeForSettings(){
	jQuery('.hasTooltip').tooltip({"html": true,"container": "body", "tooltipClass" : "new_one"});
	jQuery("#sbox-window .chzn-container").remove();
	jQuery("#sbox-window select").chosen();
	
	setTimeout(function(){			
			jQuery('#sbox-window ul.flipyesno').each(function(ind){
				var obj = jQuery(this).prev();
				var flip_obj = jQuery(jQuery(this));
				flip_obj.disableSelection();

				flip_obj.find('LI').click(function(){
					if(parseInt(jQuery(this).css('left')) == 0){
						jQuery(this).animate({left:'-55px'},300);
						obj.val(0);
					}else{
						jQuery(this).animate({left:'0px'},300);
						obj.val(1);
					}
				}).disableSelection(); 
			});
		},500);
	
	setTimeout(function(){	
		SqueezeBox.initialize({})
		SqueezeBox.assign(jQuery('a.modal.background').get(), {
			parse: 'rel'
		});	
	},1000);
};
var settings_row_index = 0;
var layout_object = {};
function saveSettingsParams(){
	var temp_settings= { } ;
	
	temp_settings.p1 = jQuery('#sbox-window .settings_name').val();
	temp_settings.p2 = jQuery('#sbox-window .settings_class').val();
	temp_settings.p3 = jQuery('#sbox-window .settings_heading').val();
	temp_settings.p4 = jQuery('#sbox-window .minicolors-input').val();
	temp_settings.p5 = jQuery('#sbox-window .flipyesno.background').val();
	temp_settings.p6 = jQuery("#sbox-window .chzn-done.vertical_align").val();
	temp_settings.p7 = jQuery("#sbox-window .chzn-done.horizontal_align").val();
	temp_settings.p8 = jQuery("#sbox-window .chzn-done.image_repeat").val();
	temp_settings.p9 = jQuery('#sbox-window .flipyesno.fixed_background').val();
	temp_settings.p10 = jQuery('#sbox-window .minicolors-input').val();
	temp_settings.p11 = jQuery('#sbox-window .flipyesno.parallax').val();
	temp_settings.p12 = jQuery("#sbox-window .chzn-done.scroll_speed").val();
	temp_settings.p13 = jQuery('#sbox-window .flipyesno.collapse').val();
	temp_settings.p14 = jQuery('#sbox-window .flipyesno.full').val();
	temp_settings.p15 = jQuery('#sbox-window .flipyesno.floating').val();
	temp_settings.p16 = jQuery("#sbox-window .settings_image").val();
	temp_settings.p17 = jQuery('#sbox-window .background_size').val();
	temp_settings.p18 = jQuery('#sbox-window .container_type').val();
	
	var settings_name = "row"+settings_row_index;
	
	jQuery("#sortable .edit_row:nth-child("+settings_row_index+")").attr("layout_settings",JSON.stringify(temp_settings));
	layout_object[settings_name].settings = temp_settings;
	jQuery('#jform_params_layoutdesign').trigger('change');
}
jQuery(document).ready(function(){
	
	var settings_current = {};
	
	setTimeout(function(){	
		SqueezeBox.initialize({});
		SqueezeBox.assign(jQuery('a.modal').get(), {
			parse: 'rel'
		});
	},500);	
	
	jQuery(document).on("mousedown",".modal.btn.settings",function(){
		settings_row_index = jQuery('.modal.btn.settings').index(this);
		window.mini_settings();
		
		if(jQuery('#jform_params_layoutdesign').val()!="")
			layout_object = JSON.parse(jQuery('#jform_params_layoutdesign').val());
		else
			layout_object = JSON.parse("{}");
		

		var settings_name = "row"+settings_row_index;
		
		settings_current = JSON.parse(jQuery("#sortable .edit_row:nth-child("+settings_row_index+")").attr("layout_settings"));

		setTimeout(function(){

			///// text inputs

			jQuery('#sbox-window .settings_name').val(settings_current.p1);
			jQuery('#sbox-window .settings_class').val(settings_current.p2);
			jQuery('#sbox-window .settings_heading').val(settings_current.p3);
			jQuery('#sbox-window .background_size').val(settings_current.p17);
			
			///// minicolors picker

			if(settings_current.p4==""){
				jQuery('#sbox-window .minicolors-input').val("");
			}
			else{
				jQuery('#sbox-window .minicolors-input').val(settings_current.p4);
			}
			window.mini_settings();

			///// lists

			if(settings_current.p6!="")
				jQuery("#sbox-window .chzn-done.vertical_align").val(settings_current.p6).trigger('liszt:updated');
				
			if(settings_current.p7!="")
				jQuery("#sbox-window .chzn-done.horizontal_align").val(settings_current.p7).trigger('liszt:updated');
			
			if(settings_current.p8!="")
				jQuery("#sbox-window .chzn-done.image_repeat").val(settings_current.p8).trigger('liszt:updated');

			if(settings_current.p12!="")
				jQuery("#sbox-window .chzn-done.scroll_speed").val(settings_current.p12).trigger('liszt:updated');
			
			if(settings_current.p16!="")
				jQuery("#sbox-window .settings_image").val(settings_current.p16).trigger('liszt:updated');

			if(settings_current.p18!="")
				jQuery("#sbox-window .container_type.chzn-done").val(settings_current.p18).trigger('liszt:updated');
			
			///// flip yes/no

			if(settings_current.p5=="" || settings_current.p5=="0"){
				jQuery('#sbox-window .flipyesno.background').val(0);
			}
			else{
				jQuery('#sbox-window .flipyesno.background').val(1).next().find('li').trigger('click');
			}
			
			if(settings_current.p9=="" || settings_current.p9=="0"){
				jQuery('#sbox-window .flipyesno.fixed_background').val(0);
			}
			else{
				jQuery('#sbox-window .flipyesno.fixed_background').val(1).next().find('li').trigger('click');
			}
			
			if(settings_current.p11=="" || settings_current.p11=="0"){
				jQuery('#sbox-window .flipyesno.parallax').val(0);
			}
			else{
				jQuery('#sbox-window .flipyesno.parallax').val(1).next().find('li').trigger('click');
			}
			
			if(settings_current.p13=="" || settings_current.p13=="0"){
				jQuery('#sbox-window .flipyesno.collapse').val(0);
			}
			else{
				jQuery('#sbox-window .flipyesno.collapse').val(1).next().find('li').trigger('click');
			}
			
			if(settings_current.p14=="" || settings_current.p14=="0"){
				jQuery('#sbox-window .flipyesno.full').val(0);
			}
			else{
				jQuery('#sbox-window .flipyesno.full').val(1).next().find('li').trigger('click');
			}
			
			if(settings_current.p15=="" || settings_current.p15=="0"){
				jQuery('#sbox-window .flipyesno.floating').val(0);
			}
			else{
				jQuery('#sbox-window .flipyesno.floating').val(1).next().find('li').trigger('click');
			}
			
		},900);
		
		/*SqueezeBox.initialize({});
		SqueezeBox.assign($('a.modal').get(), {
			parse: 'rel'
		});	*/
	});
});


