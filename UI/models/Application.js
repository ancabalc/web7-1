/*global $*/
function Application(options){
    this.title = options.title;
    this.description = options.description;
    
}

Application.prototype.createApplication = function(){
    var that = this;
    return $.ajax({
            url:"/api/applications/create",
            type:"POST",
            dataType:"json",
            success:function(resp){
                for(var i = 0; i<resp.length; i++){
                      var application = new Application(resp[i]);
                      that.models.push(application);
                }
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            }
    });
    
};