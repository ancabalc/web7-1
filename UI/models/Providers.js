/*global $*/
function Provider(options) {
    this.name = options.name;
    this.role = options.role;
    this.email = options.email;
    this.description = options.description;
    this.models = [];
}

Provider.prototype.getTopThree = function(){
    var that = this;
    return $.ajax({
            url:"https://web7-1new-georgianam.c9users.io/api/users/listUsers",
            type:"GET",
            dataType:"json",
            success:function(resp){
                for(var i = 0; i<resp.length; i++){
                    var provider = new Provider(resp[i]);
                    that.models.push(provider);
                }
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            }
    });
};