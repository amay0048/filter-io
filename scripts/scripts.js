(function($) {
    "use strict";
    
    /* COUNTDOWN */
	$("#countdown").countdown({
		date: "10 December 2013", // Put your date here
		format: "on"
	});
    
    /* SMOOTH SCROLL */
    $('.nav-link').click(function(event){		
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
    });
    
    /* TOOLTIPS */
    $('.tool-tip').tooltip();
    
    /* CONTACT FORM */
	$('#contact-form').ketchup().submit(function() {
        if ($(this).ketchup('isValid')) {
            var action = $(this).attr('action');
            $.ajax({
                type: "POST",
                url : action,
                data: {
                    contactname: $('#contact-name').val(),
                    contactemail: $('#contact-email').val(),
                    contactwebsite: $('#contact-website').val(),
                    contactmessage: $('#contact-message').val()
                },
                success: function() {
                    $('#contact-error').fadeOut();
                    $('#contact-success').fadeOut();
                    $('#contact-success').html('Success! Thanks for contacting us!').fadeIn();
                },
                error: function() {
                    $('#contact-error').fadeOut();
                    $('#contact-success').fadeOut();
                    $('#contact-error').html('Sorry, an error occurred.').fadeIn();
                }
            });
        }
        return false;
    });
	
	/* NEWSLETTER FORM */
	$('#newsletter-form').ketchup().submit(function() {
		if ($(this).ketchup('isValid')) {
			var action = $(this).attr('action');
			$.ajax({
				url: action,
				type: 'POST',
				data: {
					newsletter_email: $('#newsletter-email').val()
				},
				success: function(data) {
                    $('#newsletter-error').fadeOut();
                    $('#newsletter-success').fadeOut();
                    $('#newsletter-success').html(data).fadeIn();
                },
                error: function() {
                    $('#newsletter-error').fadeOut();
                    $('#newsletter-success').fadeOut();
                    $('#newsletter-error').html('Sorry, an error occurred.').fadeIn();
                }
			});
		}
		return false;
	});
    
    /* ANIMATIONS */
    jQuery('.navbar-brand').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInLeft');
		}
	});
    jQuery('.navbar-nav a').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInRight');
		}
	});
    jQuery('.main-heading').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInDown');
		}
	});
    jQuery('.time').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated bounceIn');
		}
	});
    jQuery('#newsletter-form').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated bounceIn');
		}
	});
    jQuery('.about-item').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInUp');
		}
	});
    jQuery('.contact-infos').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInLeft');
		}
	});
    jQuery('#contact-form').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInRight');
		}
	});
    jQuery('.copyright').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInLeft');
		}
	});
    jQuery('.footer-middle').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated bounceIn');
		}
	});
    jQuery('.social-icons').bind('inview', function (event, visible) {
		if (visible == true) {
			jQuery(this).addClass('animated fadeInRight');
		}
	});
    
})(jQuery);