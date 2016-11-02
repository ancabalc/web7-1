function Offer(options) {
    this.applicationId = options.application_id;
    this.desc = options.description;
}

Offer.prototype.getOffers = function(applicationId) {
    var that = this;
    return $.ajax({
            url:"https://web7-1-alecsandrul.c9users.io/api/controllers/offers?id="+applicationId,
            type:"GET",
            dataType:"json",
            success:function(resp){
                for(var i = 0; i<resp.length; i++){
                    var offer = new Offer(resp[i]);
                    that.models.push(offer);
                }
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            }
        });
}