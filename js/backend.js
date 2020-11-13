$(function (){
   'use strict' ;
    
    //Hide Placeholder On Form Fucus
    
    $('[placeholder]').focus(function()
                            {
       $(this).attr('data-text' , $(this).attr('placeholder'));
        
        $(this).attr('placeholder' , '');
        
    }).blur(function(){
        
        $(this).attr('placeholder' , $(this).attr('data-text'));
    });
    
    //paste this code under the head tag or in a separate js file.
/* $(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
*/
 //Add asterisk on Required field
 $('input').each(function(){
	 
	 if($(this).attr('required') === 'required' )
		 {
			 $(this).after('<span class="asteris">*</span>');
		 }
   });
	
	
	//confirmation massage On Button
	
	$('.confirm').click(function()
					   {
		
		return confirm('Are You Sure?');
	});
    
// switch between togin & signUp
    
    $('.loginPlat h1 span').click(function(){
        
        $(this).addClass('selected').siblings().removeClass('selected');
       console.log('.loginPlat .'+$(this).data('class'));
        $('.loginPlat form').hide();
        $('.loginPlat .'+ $(this).data('class')).fadeIn(100);
        
        
    });
    //convert Password 
    var passField = $('.password');
    $('.show-pass').hover(function(){
        passField.attr('type' , 'text');
        },function(){
        passField.attr('type' , 'password');
    });
    
 });