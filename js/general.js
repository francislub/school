
var clientBaseUrl = getRootUrl();
console.log(clientBaseUrl);
var apiBaseUrl = clientBaseUrl;

function getRootUrl() {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/";
    //if (getUrl.pathname.split('/')[0] != "") {
    //    baseUrl = baseUrl + getUrl.pathname.split('/')[0] + "/";     
    //}    
    return baseUrl;
}


function ajaxAsync(Url, Data = {}, type = "", callback = function () { alert("Done"); }) {
    $.ajax({
        url: Url,
        contentType: 'application/json; charset=UTF-8',
        type: type,
        crossDmain: true,
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET, POST, OPTIONS'
        },
        data: Data,
        beforeSend: function () {
            //document.getElementById('spinner').style.display = "block";
            $('#loader').removeClass("loader");
            $("body > *:not('#loader')").addClass("blur-out");
        },
        success: function (data) {
            submitted = true;
            callback(data);
            //$('.btn').removeClass('hidden');

        },
        failure: function (msg) {

            alert('failure');

        },
        complete: function () {
            //document.getElementById('spinner').style.display = "none";
            //$('#loader').addClass("loader");
            //$("body > *:not('#loader')").removeClass("blur-out");
        }

    });
}