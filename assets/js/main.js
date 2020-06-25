/* -------------------------------------------------------------------
 * Plugin Name           : MContact - Modern Contact Form
 * Author Name           : Mehmet Maşa
 * Created Date          : 12 March 2020
 * Version               : 1.0.0
 * File Name             : main.js
------------------------------------------------------------------- */

$(document).ready(function(){

    $.validator.setDefaults( {
        submitHandler: function () {
            let name = $("#name").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let customerServices = $("#customerServices").val();
            let message = $("#message").val();

            axios({
                method: 'post',
                url: 'phpmailer/mail.php',
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    customerServices : customerServices,
                    message: message
                },
            })
                .then(function (response) {
                    let data = response.data;

                    if (data.success === true){
                        toastr.success('Your offer has been sent.');
                    }else{
                        toastr.error(data.msg);
                    }
                })
                .catch(function (error) {
                    toastr.success(error);
                });
        }
    } );

    $( "#contactForm" ).validate({
        errorClass: 'form-control-feedback',
        errorElement: 'div',
        highlight: function(element) {
            $(element).parents(".form-group").addClass("has-danger");
        },
        unhighlight: function(element) {
            $(element).parents(".form-group").removeClass("has-danger");
        },
        rules: {
            name: 'required',
            email: {
                required: true,
                email: true
            },
            message: {
                required:true,
                maxlength: 500
            }
        },
        messages: {
            name: 'Please enter your name.',
            email: {
                required: 'You can not leave this empty.',
                email: 'Please enter a valid email address.'
            },
            message: {
                maxlength: 'Message length must be less than 500 character.'
            }
        }
    });
});
