/*global $*/
function Applications(){
    this.models = [];
}

Applications.prototype.getApplications = function(){
    var that = this;
    return $.ajax({
            url:"https://web7-1-andreipuscas.c9users.io/api/Applications",
            type:"GET",
            dataType:"json",
            success:function(resp){
                for(var i = 0; i<resp.length; i++){
                       var application = new application(resp[i]);
                       that.models.push(application);
                }
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            }
    });
    
}