/*global $*/
/*global Users*/
$(window).ready(function(){
    
    $(".login-btn").on("click", function(e) {
        e.preventDefault();
        //console.log("here");
        var user = new Users();
        var email = $("[name='email-value']").val();
        var password = $("[name='password']").val();
        var userDef = user.loginUser(email,password);
        userDef.done(listUser);
    });
    
    function listUser() {
         if(window.loginResp.errors) {
            $('.invalidCredentials').html('');
            var invalidCredentialsText = "Invalid Credentials!";
            $(".invalidCredentials").append(invalidCredentialsText);
         }
         else {
            window.location.href = "/UI/pages/";
         }
    }
        
});