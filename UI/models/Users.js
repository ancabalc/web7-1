/*global $*/

function Users() {
    this.models = [];
}

Users.prototype.loginUser = function(email,password) {
        
        var ajaxOptions = {
            url:"/api/accounts/login",
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

Users.prototype.save = function(name, email, password, repassword, role, description, image) {
    $.ajax({
        type:"POST",
        url:"https://web7-1-ccampean.c9users.io/api/accounts/create",
        data: {
            name: name,
            email: email,
            password: password,
            repassword: repassword,
            role: role,
            description: description,
            image: image
        },
        success:function(resp){
            if (resp.id) {
                window.location.href = "index.html";
            } else {
                console.log(resp);
            }
        },
        error:function(xhr, status, errorMessage){
            console.log("Error status:" + status);
        }
    });
    return false;
};