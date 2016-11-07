/*global $*/
function Offer(options) {
    this.applicationId = options.application_id;
    this.desc = options.description;
    this.models = [];
}

Offer.prototype.getOffers = function(applicationId) {
    var that = this;
    return $.ajax({
            url:"https://web7-1-alecsandrul.c9users.io/api/controllers/offers?id="+applicationId,
            type:"GET",
            dataType:"json",
            success:function(resp){
                //console.log(resp);
                that.models = [];
                for(var i = 0; i<resp.length; i++){
                    var offers = new Offer(resp[i]);
                    that.models.push(offers);
                }
                //console.log('Offers:' , that.models);
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            }
        });
};