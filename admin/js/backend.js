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
    
    $('.login-page h1 span').click(function(){
        
        $(this).addClass('selected').siblings().removeClass('selected');
        
        $('.login-page form').hide();
        $('.' + $(this).data('class')).fadeIn(100);
        
        
    })
 });