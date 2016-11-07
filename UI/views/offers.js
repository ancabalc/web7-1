$(window).ready(function(){
    
    var offer = new Offer(1);
    var offersDef = offer.getOffers(1);
    offersDef.done(listOffers);
    
    function listOffers() {
        var offersModels = offer.models;
        //console.log(offer.models[0].desc);
        for(var i=0;i<offersModels.length;i++) {
            var offerHtml = "<h2>name</h2>" +
            "<p class='offerDesc'>" + offersModels[i].desc + " </p>";
            $('.returned').append(offerHtml);
            //console.log(offersModels[i].desc);

        }
    }
});
    