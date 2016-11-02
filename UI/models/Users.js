/*global $*/
function Users(){
    this.models = [];
}

Users.prototype.loginUser = function(email,password) {
        
        var ajaxOptions = {
            url:"https://web7-1-alecsandrul.c9users.io/api/accounts/login",
            type:"POST",
            dataType:"json",
            data:{
                email:email,
                password:password
            },
            success:function(resp){
                window.loginResp = resp;
                window.currentUser = resp;
                console.log("You're logged in!");
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            },
            complete:function(){
                console.log("AJAX Req has completed");
            }
        };
        return $.ajax(ajaxOptions);
};