/*global $*/
/*global User*/
$(window).ready(function(){
    $('.sign-up-btn').on('click', function(event){
        event.preventDefault();
        // console.log('sign up pressed');
        var user = new User();
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