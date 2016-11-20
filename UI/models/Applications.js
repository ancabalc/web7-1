/*global $*/
    function Applications(options){
        this.models = [];
    }
    
    Applications.prototype.getApplications = function(){
    var that = this;
    return $.ajax({

            url:"/api/applications",
            type:"GET",
            dataType:"json",
            success:function(resp){
                for(var i = 0; i<resp.length; i++){
                       var application = new Applications(resp[i]);
                       that.models.push(application);
                }
            },
            error:function(xhr,status,errorMessage){
                console.log("Error status:"+status);
            }
    });
    
};

Applications.prototype.getLoggedUserApplications = function() {
    return $.ajax({
        url: "/api/applications/for-user",
        type: "GET",
        dataType: "json",
        success: function(resp) {
            console.log(resp);
            var containerApplications = $('.append-app-here');
            for (var i = 0; i <= resp.length; i++) {
                var boxApplication = 
                '<div class="col-sm-4 sm-margin-b-50">' +
                    '<div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".3s">' +
                        '<div class="bg-color-white margin-b-20">' +
                            '<div class="wow zoomIn" data-wow-duration=".3" data-wow-delay=".1s">' +
                                '<img class="img-responsive" src="../layout/img/770x860/01.jpg" alt="Team Image">' +
                            '</div>' +
                        '</div>' +
                        '<h3>' + resp[i]["title"] + '</h3>' +
                        '<p>' + resp[i]["description"] + '</p>' +
                        '<p>' + resp[i]["creation_date"] + '</p>' +
                        '<a class="link" href="submit-offer.html">Apply for it</a>' +
                    '</div>' +
                '</div>';
                containerApplications.append(boxApplication);
            }
        },
        error: function(xhr, status, errorMessage) {
            console.log("Error status for logged user: " + status);
        }
    });
};