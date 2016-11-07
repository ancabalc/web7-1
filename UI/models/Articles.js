function Articles(){
    this.models = [];
}

Articles.prototype.getArticles = function(){
    var that = this;
    return $.ajax({
            url:,
            type:"GET",
            dataType:"json",
            success:function(resp){
                for(var i = 0; i<resp.length; i++){
                       var article = new Article(resp[i]);
                       that.models.push(article);
                }
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            }
    });
}