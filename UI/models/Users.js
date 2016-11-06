/*global $*/

function User() {}
User.prototype.save = function(name, email, password, repassword, role, description, image) {
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
            }
        },
        error:function(xhr, status, errorMessage){
            console.log("Error status:" + status);
        }
    });
    return false;
};