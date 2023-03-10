/**
* Template Name: Lumia - v2.2.1
* Template URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
!(function($) {
    "use strict";

    // Back to top button
    $(window).scroll(function() {
    //   if ($(window).scrollTop() > 100) {
    //     $('#header').addClass('fixed-top');
    //   }
    //   else {
    //     $('#header').removeClass('fixed-top');
    //   }
      if ($(this).scrollTop() > 100) {
        $('.back-to-top').addClass('active');
      } else {
        $('.back-to-top').removeClass('active');
      }
    });

    $('.back-to-top').click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 1500);
      return false;
    });

    $('.php-email-form').validate({

        errorClass: 'invalid-feedback',
        validClass: 'valid-feedback',
        highlight: function(element, errorClass, validClass) {
            $(element.form).addClass('was-validated')
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element.form).removeClass('was-validated')
        },
        submitHandler: function(form) {
            // do other things for a valid form
            var btn = $(form).find('.btn')
            var btnText = btn.val()
            $.ajax({
				type:"POST",
				url: form.action,
				data: new FormData(form),
                contentType: false,
                processData : false,
				beforeSend:function(request){
                    $('.loading').addClass('d-block')
					$(btn).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> '+btnText);
				},
				success:function(answer){
                    $('.loading').removeClass('d-block')
                    $(btn).text(btnText)
                    $('.sent-message').addClass('d-block')
				},
                error: function error(data) {
                    $('.loading').removeClass('d-block')
                    $(btn).text(btnText)
                    var errs = data.responseJSON.validation || {}
                    var errorsHtml = '';
                    $.each(errs, function (key, value) {
                        errorsHtml += '<p>' + value + '</p>';
                    });
                    $('.error-message').html(errorsHtml)
                }
			});

            return false;
        }
    });

    // var forms = document.querySelectorAll('.php-email-form');

    // Array.prototype.slice.call(forms)
    // .forEach(function (form) {
    //   form.addEventListener('submit', function (event) {
    //     if (!form.checkValidity()) {
    //       event.preventDefault()
    //       event.stopPropagation()
    //     }

    //     form.classList.add('was-validated')
    //   }, false)
    // })

  })(jQuery);
