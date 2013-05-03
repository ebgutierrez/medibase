$(document).ready(function(){
	initTinyMce();
});

function initTinyMce(){
	
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "{$css}/tiny_mce/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "{$javascript}/tiny_mce/lists/template_list.js",
		external_link_list_url : "{$javascript}/tiny_mce/lists/link_list.js",
		external_image_list_url : "{$javascript}/tiny_mce/lists/image_list.js",
		media_external_list_url : "{$javascript}/tiny_mce/lists/media_list.js",


		width: "100%"
	});
	
}

function removePage(base_url,id){
	var confirmBox = confirm("Are you sure you want to remove this page?");
	if(confirmBox) {
		$.ajax({
			url:base_url + 'Auth/PAges/removePage',
			type:'post',
			data:{'id':id},
			success:function(result){
				if(result){
					window.location = base_url + 'Auth/Pages';
				}
			}
		});
	}
}