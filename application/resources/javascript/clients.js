$('html').mouseover(function(e){
	
	var strClass = e.target.getAttribute('class');
	if(strClass != null && strClass.indexOf("sage") !== -1){
		console.log('show ' + e.target.getAttribute('class') );
		$('.sage .sub-menu').show();
	} else {
		$('.sage .sub-menu').hide();
	}
});