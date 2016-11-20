/*global $*/
$(window).ready(function(){
    
    function checkSession(){
            $.ajax({
                url:"/api/accounts/check-session",
                type:"GET",
                success:function(resp) {
                    if (resp.logged ===  true ){
                        var menu = 
                        '<div class="collapse navbar-collapse nav-collapse">' +
                            '<div class="menu-container">' +
                                '<ul class="navbar-nav navbar-nav-right">' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-item-child js-home" href="index.html">Home</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-item-child js-applications" href="applications.html">Applications</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-item-child js-profile" href="user-profile.html">User Profile</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a href="#" class="nav-item-child logoutBtn" id="abc">Logout</a>' +
                                    '</li>' +
                                '</ul>' +
                            '</div>' +
                        '</div>';
                        $('.menu').append(menu);
                        activeClass();
                        
                        $(".logoutBtn").on("click",function() {
                            $.ajax({
                                url: '/api/accounts/logout',
                                success: function(){
                                    window.location.href = "/UI/pages/index.html";
                                }
                            });
                        });
                    } else {
                        var menu =
                        '<div class="collapse navbar-collapse nav-collapse">' +
                            '<div class="menu-container">' +
                                '<ul class="navbar-nav navbar-nav-right">' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-item-child js-home" href="index.html">Home</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-item-child js-applications" href="applications.html">Applications</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-item-child js-signup" href="signup.html">Sign Up</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-item-child js-login" href="login.html">Sign In</a>' +
                                    '</li>' +
                                '</ul>' +
                            '</div>' +
                        '</div>';
                        $('.menu').append(menu);
                        activeClass();

                    }
                    
                }
            });
        }
        
        
    checkSession();
    
    
        
    function activeClass() {
            if (window.location.href.indexOf("index") != -1) {
                $('.js-home').addClass('active');
            } else if (window.location.href.indexOf("applications") != -1) {
                $('.js-applications').addClass('active');
            } else if (window.location.href.indexOf("signup") != -1) {
                $('.js-signup').addClass('active');
            } else if (window.location.href.indexOf("login") != -1) {
                $('.js-login').addClass('active');
            } else if (window.location.href.indexOf("user-profile") != -1) {
                $('.js-profile').addClass('active');
            } 
        }
});