/**
	Slide object

	This script will be the one to handle slide 
	events which is seen in the header part
	of the main page
*/

var _slide;

function slider(base_url,image_url){
	slide = new Slide();

	/*
	$('.banner_loader').ajaxStart(function(){
		$(this).show();
		$('.pic_container').hide();
	});

	$('.banner_loader').ajaxStop(function(){
		$(this).hide();
		$('.pic_container').show();
	});*/


	$.ajax({
		url: base_url + 'Slide',
		async:false,
		success:function(result){
			str =  eval(result);

			for(i = 0; i < str.length; i++) {
				slide.setImage(image_url + '/slide/' + str[i]);
			}			
			
		}
	});

	slide.setImageContainer('.pic_container');	
	slide.startSlide(slide);
}

//Initialize object
function Slide(){
	this._timeout = 5000;
	this._width = 673;
	this._images = new Array();
	this._slideId = 0;
	this._imageIndex = 0;
	this._imageContainer = ''
}

//method to start slide animation
Slide.prototype.startSlide = function(slide){
	_slide = slide;
	$('.pic_container').width(960 * slide.getImage().length);
	for(index = 0; index < slide.getImage().length; index++) {
		$('.pic_container').append('<img id="img_' + index + '" src="' + slide.getImage()[index] + '"   width="960px" height="300px">');
	}
	this._slideId = setInterval("slideToLeft()",6000);
}

function slideToLeft() {
	if(_slide.getImageIndex() >= 0) {

		if(_slide.getImageIndex() < _slide.getImage().length - 1) {
			$('.pic_container').animate(
				{
			    	marginLeft: '-=960'
			  	}, 
		  		3000
		  	);

		  	_slide.setImageIndex( _slide.getImageIndex() + 1);
		} else {
			_slide.setImageIndex(0);
			$('.pic_container').animate({
		    	marginLeft: '0'
		  	}, 
		  	2000);	
		}

	} 

	
}


/*=======================================================================
	SETTERS
========================================================================*/
Slide.prototype.setImage = function(path) {
	found = false;

	for(index =  0; index < this._images.length; index++) {
		if(path == this._images[index]) {
			found = true;
			break;
		}
	}

	if(!found)
		this._images.push(path);
};

Slide.prototype.setImageContainer = function(container) {
		this._imageContainer = container;
};

Slide.prototype.setImageIndex = function(value) {
		this._imageIndex = value;
};



/*=======================================================================
	GETTERS
========================================================================*/
Slide.prototype.getImage = function(){
	return this._images;
};

Slide.prototype.getImageIndex = function(){
	return this._imageIndex;
};

Slide.prototype.getSlideId = function(){
	return this._slideId;
};

Slide.prototype.getImageContainer = function(){
	return this._imageContainer;
};


