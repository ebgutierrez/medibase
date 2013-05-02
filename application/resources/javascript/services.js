var imageResult = null;
var imageName = null;

var serviceId = 0;
var clicked = 0;
var reader;
var progress

$(document).ready(function(){

	
	progress = document.querySelector('.percent');

	initTinyMce();


	/*$('.fade-box').ajaxStart(function(){
		$(this).show();
	});

	$('.fade-box').ajaxStop(function(){
		$(this).hide();
	});*/

	var wHeight;
	var wWidth;
	var lHeight;
	var lWidth;
	var sHeight;
	var sWidth;
	var lTop;
	var lLeft;
	var sTop;
	var sLeft;

	wHeight = $(window).height();
	wWidth = $(window).width();

	lHeight = $('.fade-box .loading').height();
	lWidth = $('.fade-box .loading').width();

	lTop = (wHeight - lHeight) / 2;
	lLeft = (wWidth - lWidth) / 2;


	
	$('.fade-box .loading').css({
		'top': lTop + 'px',
		'left': lLeft + 'px'
	});

	//document.getElementById('file_image').addEventListener('change', handleFileSelect, false);

	//var int=self.setTimeout(function(){resizeImage()},1);

});

$('html').mouseover(function(e){
	console.log(e.target.getAttribute('class') );
	var strClass = e.target.getAttribute('class');
	if(strClass != null && strClass.indexOf("sage") !== -1){
		$('.sage .sub-menu').show();
	} else {
		$('.sage .sub-menu').hide();
	}
});

function addCatSubcat(base_url,type){
	$.ajax({
		url:base_url + 'Auth/Admin/fetchAddCatSubcat?type=' + type,
		success:function(result){
			$('.general-data').html(result);
		}
	});
}

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



function abortRead() {
	reader.abort();
}

function errorHandler(evt) {
	switch(evt.target.error.code) {
	  	case evt.target.error.NOT_FOUND_ERR:
	    	alert('File Not Found!');
	    	break;
	  	case evt.target.error.NOT_READABLE_ERR:
	    	alert('File is not readable');
	    	break;
	  	case evt.target.error.ABORT_ERR:
	    	break; // noop
	  	default:
	  	  	alert('An error occurred reading this file.');
	};
}

function updateProgress(evt) {
	// evt is an ProgressEvent.
	if (evt.lengthComputable) {
		if(!$('#img_src').is(":visible"))
			$('.description').css('margin-top','	35px');

		var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
		// Increase the progress bar length.
		if (percentLoaded < 100) {
			progress.style.width = percentLoaded + '%';
			progress.textContent = percentLoaded + '%';

		}
	}
}

function handleFileSelect(evt) {
	// Reset progress indicator on new file selection.
    progress.style.width = '0%';
    progress.textContent = '0%';

    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      	// Only process image files.
      	if (!f.type.match('image.*')) {
        	alert('Invalid image');
      	}
      	if(f.size > (1024 * 1024 * 2))
      		alert('File side exceeds limit');

      	reader = new FileReader();

      	reader.onerror = errorHandler;
    	reader.onprogress = updateProgress;
    	reader.onabort = function(e) {
      		alert('File read cancelled');
    	};
		reader.onloadstart = function(e) {
      		document.getElementById('progress_bar').className = 'loading';
    	};
    	$('#overlap').val(f.name);

    	reader.onload = function(e){
    		progress.style.width = '100%';
  			progress.textContent = '100%';
  			
 			setTimeout(function(){hideProgressBar(e)}, 2000);
    	}
      	// Closure to capture the file information.
      	/*reader.onload = (function(theFile) {
        	return function(e) {
        		progress.style.width = '100%';
      			progress.textContent = '100%';
     			setTimeout(function(){hideProgressBar(e)}, 2000);
        	};
      	})(f);*/

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
      //reader.readAsBinaryString(f);
    }
}

function hideProgressBar(e){
	document.getElementById('progress_bar').className='';
	$('.description').css('margin-top','0');
	$('#img_src').show();
	$('#img_src').attr('src',e.target.result);
}


function getImage(){
	$('#img_src').attr('src', imageResult);
	
	resizeImage();

	$('#overlap').val(imageName);
}

function resizeImage(){
	sampleImage = new Image();
	sampleImage.src = $('#img_src').attr('src');

	imgWidth = sampleImage.width;
	imgHeight = sampleImage.height;

	console.log('image w: ' + imgWidth + '\n image h: ' + imgHeight);				

	
	reqWidth = 300;
	reqHeight = 300;

	hRatio = 1;
	wRatio = 1;

	inSampleSize = 1;

	if(imgWidth > reqWidth || imgHeight > reqHeight) {
		hRatio = imgHeight/reqHeight;
		wRatio = imgWidth/reqWidth;

		console.log('ratio w: ' + wRatio + '\n ratio h: ' + hRatio);

		inSampleSize = hRatio > wRatio ? hRatio : wRatio;
	}
	
	//do {
		imgWidth /= inSampleSize;
		imgHeight /= inSampleSize;
		console.log('new image w: ' + imgWidth + '\n new image h: ' + imgHeight);			
	//}while(imgWidth > reqWidth && imgHeight > reqHeight);

	$('#img_src').css({
		width:imgWidth + 'px',
		height:imgHeight + 'px'
	});
}

function removeSelected(base_url,remove_id){
	var splitId = remove_id.split('_');
	var cat_id = '';
	var subcat_id = '';
	var type = '';




	switch(splitId[0]) {
		case 'cat':
			cat_id = splitId[1];
			type = "category";
			break;		
		case 'subcat':
			cat_id = splitId[2];
			subcat_id = splitId[1];
			type = "subcategory";
			break;		
	}

	var conf = confirm("Are you sure you want to delete this " + type + " ?" );

	if(conf) {
		$.ajax({
			url:base_url + 'Auth/Admin/removeSelected',
			type:'post',
			data:{'cat_id': cat_id, 'subcat_id' : subcat_id},
			success:function(result){
				if(result)
					window.location = base_url + 'Auth/Services/edit';
			}
		});
	}
	
}

function readMore(elementId,srvId){
	if(serviceId != srvId) {
		$('#' + srvId).animate({height: '+=100%'},5);
		$('#img_' + srvId).height($('#' + srvId).height());
		//$('#img_' + srvId).animate({height: $('#' + srvId).height()},3000);
		$('#' + elementId).html('Less');

		serviceId = srvId;
	} else {
		$('#' + srvId).height(150);
		$('#img_' + srvId).height(150);
		//	$('#' + srvId).animate({height: '150'},3000);
		$('#' + elementId).html('Read More...');		
		serviceId = 0;
	}
}