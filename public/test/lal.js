

var callBackGetSuccess = function(data) {
 console.log("donnees api", data)
}


function buttonClickGET() {
    var url = "https://api.openweathermap.org/data/2.5/weather?q={London}&appid={fe567942eb919c65c1e3ed7265ffa8a4}"

    $.get(url, callBackGetSuccess).done(function() {
        //alert ("second success" );
    })
        .fail(function() {
            alert("error");
        })
        .always(function (){
            //alert( "finished" );
        });


}