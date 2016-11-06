/*global $*/
/*global Users*/
$(window).ready(function(){
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