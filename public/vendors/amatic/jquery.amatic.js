
// * Amatic JS
// * Version - 1.0
// * Licensed under the MIT license - http://opensource.org/licenses/MIT
// * Renan Diaz
// * Copyright (c) 2017 


(function ( $ ) {
	
	
$.fn.amatic = function( css, options ) {

//	DETECT IF PLUGIN IS SET	
	if ($(this).is(document)){
			
		
		// Default options.
        var options = $.extend({

			newclass: "",
			loader: "fa fa-circle-o-notch",
			loader_complete: "fa fa-check",
			fade_in: true,
			fade_out: true,
			animate_in: "",
			animate_out: "",
			time_out: 2000
			
			
        }, options );
				
		
		
//	REMOVE HTML TIME OUT
		
		var remove_time = options.time_out + 500;
		
//	AJAX START
		
		this.ajaxStart( function(){
		
			
		if($('#amatic-element').length <= 0){
			
		$("body").append( "<div id='amatic-element' class='amatic-element' style='display: none;'><i class='"+options.loader+" rotating'></i></div>" );
		
		}
			
			
		if(css !== ""){
		
		$("#amatic-element").css(css); //Add css if is set
		
		}
			
		$("#amatic-element").addClass(options.newclass); //Add class if is set			
		
		$("#amatic-element").addClass("animated "+options.animate_in); //Add animation if is set			

		switch(options.fade_in){ //detect fadeIn config	
				
			case true :
			
				if(options.animate_in !== ""){
				
				   $("#amatic-element").show(); 
				
				}else{
				
				   $("#amatic-element").fadeIn();
				
				}			
				
			break;
			
				
			case false :
			
			   	$("#amatic-element").show(); 

			break;
		
		}

			
			
		});

		
//	AJAX SUCCESS	
		
		this.ajaxSuccess(function(){

		setTimeout(function(){
			
		$("#amatic-element").html("<i class='"+options.loader_complete+"'></i>"); 
		
		}, 1000);
			
		});


//	AJAX COMPLETE	
		
		this.ajaxComplete( function(){
		
		$("#amatic-element").removeClass("animated "+options.animate_in); //remove initial animation if is set			
			
		$("#amatic-element").addClass("animated "+options.animate_out); //Add animation if is set			

			
			
			switch (options.fade_out){//detect fadeOut config	
				
			case true :
			
				if(options.animate_out !== ""){
				
				   $("#amatic-element").hide(); 
				
				}else{
				
				   $("#amatic-element").fadeOut();
				
				}	
					
			break;
			
			case false :
			
			   	$("#amatic-element").hide(); 

			break;
			
			}
		
		
		setTimeout(function(){	$("#amatic-element").remove();	}, remove_time);
			
		});
		
	}else{
		
// SETUP ERROR MSG			
		console.log("Ajaxmatic no se inicio correctamente.");
						
	} 

};
	

	
}( jQuery ));