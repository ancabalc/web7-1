$(window).ready(function(){
    
    function checkSession(){
            $.ajax({
                url:"/api/accounts/check-session",
                type:"GET",
                success:function(resp) {
                    if (resp.logged ===  true ){
                        //window.location.href = "/UI/pages";
                        $('.userProfile').addClass('active');
                        $('.userProfile').removeClass('hide');
                        $('.signUp').addClass('hide');
                        $('.signIn').addClass('hide');
                        console.log(resp.user.email);
                    } else {
                        $('.userProfile').addClass('hide');
                        $('.signUp').addClass('active');
                        $('.signUp').removeClass('hide');
                        $('.signIn').addClass('active');
                        $('.logoutBtn').addClass('hide');
                        $('.newApplication').addClass('hide');
                        
                        //$(".userLogged").append(resp.user.email);
                    }
                }
            })
        }
        
    checkSession();
    
    $(".logoutBtn").on("click",function() {
            $.ajax({
                url: '/api/accounts/logout',
                success: function(){
                    window.location.href = "/UI/pages/";
                }
            });
        });
});