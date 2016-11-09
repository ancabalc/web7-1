/*global $*/
/*global Users*/
/*
beside jQuery library we will use 2 more libraries
http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js
http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js
*/

$(window).ready(function(){
    $('#register-form').validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                repassword: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                image: {
                    required: false,
                    extension: "png|jp?g|gif",
                    checkSizeAvatar: 102400
                }
            },
            messages: {
                name: "Scrie numele tau complet, te rog",
                email: "Te rog, introdu un email valid",
                password: {
                    required: "Te rog sa introduci o parola",
                    minlength: "Lungimea parolei sa aiba mai mult de 6 caractere"
                },
                repassword: {
                    required: "Te rog sa introduci o parola",
                    minlength: "Lungimea parolei sa aiba mai mult de 6 caractere",
                    equalTo: "Te rog, introdu aceeasi parola ca cea de mai sus"
                },
                image: {
                    extension: "Te rog introdu o poza in format .jpg, .jpeg, .png sau .gif",
                    checkSizeAvatar: "Te rog alege o poza < 100kB"
                }
            },
            submitHandler: function(form) {
                return false;
            }
        });
    
    $.validator.addMethod('checkSizeAvatar', function(value, element, bytes) {
        // bytes ~ size of the file
        // element ~ the element to validate (<input> in our case)
        // value ~ value of the element (file name)
        return this.optional(element) || (element.files[0].size <= bytes);
    });
    
    $('.sign-up-btn').on('click', function(event){
        event.preventDefault();
        var user = new Users();
        var name = $('.name-input').val();
        var email = $('.email-input').val();
        var password = $('.password-input').val();
        var repassword = $('.repassword-input').val();
        var role = $('#register-form .role-input:checked').val();
        var description = $('.description-input').val();
        var image = $('.image-input').val();
        user.save(name, email, password, repassword, role, description, image);
    });
});