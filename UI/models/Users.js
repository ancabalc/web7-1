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

Users.prototype.save = function(formData) {
    $.ajax({
        type:"POST",
        url:"/api/accounts/create",
        data: formData,
        processData:false,
        contentType:false,
        success:function(resp){
            if (resp.id) {
                window.location.href = "login.html";
            }
        },
        error:function(xhr, status, errorMessage){
            console.log("Error status:" + status);
        }
    });
    return false;
};

Users.prototype.updateUser = function(name,description,image) {
        
        var ajaxOptions = {
            url:"/api/users/update",
            type:"POST",
            dataType:"json",
            data:{
                name:name,
                description:description,
                image:image,
            },
            success:function(resp){
                window.updateResp = resp;
                window.currentUser = resp;
                console.log("Your profile is updated!");
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            },
            complete:function(){
                console.log("AJAX Request has completed");
            }
        };
        return $.ajax(ajaxOptions);
};

Users.prototype.getUserProfile= function(){
        var that = this;
        return $.ajax({
            url:"/api/accounts/getUserProfile",
            type:"GET",
            dataType:"json",
            success:function(resp){
                var users = currentUser(resp.user);
                that.model = users;
                    if($('.role-input:checked')==='provider'){
                        window.location.href = "/pages/provider.html";
                    }else {
                        window.location.href = "/pages/client.html";
                    }
                },
            error:function(xhr,status,errorMessage){
                if(xhr.status == 401) {
                    window.location.href = "index.html";
                }
                console.log("Error status:"+status);
            }
        });
};