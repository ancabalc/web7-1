/*global $*/
/*global Users*/
$(window).ready(function(){
    var users = new Users();
    var id = 1;
    var userDef = users.getUser(id);
    userDef.done(populateUser);
    var image = null;
    
    function populateUser(){
        var userModel = users.model;
        $("[name='name']").val(userModel.name);
        $("[job='job']").val(userModel.job);
        $("[name='description']").val(userModel.description);
        image = userModel.image;
        $(".img-responsive").attr("src", 'https://web7-1-mihaitm.c9users.io/uploads/' + userModel.image);
        
    }
    function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.img-responsive').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$("#file").change(function(){
    readURL(this);
});
    
    $("[type='submit']").on("click",function(ev){
        ev.preventDefault();
 
        var formData = new FormData();
        var nameValue = $("[name='name']").val();
        var jobValue = $("[job='job']").val();
        var descriptionValue = $("#description").val();
        var fileInput = $("[name='image']")[0];
        
        formData.append("name",nameValue);
        formData.append("job",jobValue);
        formData.append("description", descriptionValue);
        formData.append("id",id);
        
        if(fileInput.files[0]) {
            formData.append("image", fileInput.files[0]);
        } else {
            formData.append("image", image);
        }
        
        $.ajax({
            url:"https://web7-1-mihaitm.c9users.io/uploads?id="+id,
            type:"POST",
            data:formData,
            processData:false,
            contentType:false,
            success:function(resp){
                window.location.href = "https://web7-1-mihaitm.c9users.io/UI/pages/user-profile.html";
            },
            error:function(){
                console.log("Oops! Update profile failed");
            }
        });
        
    });
});