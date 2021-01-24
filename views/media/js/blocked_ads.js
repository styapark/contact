var base = window.location.protocol + '//' + window.location.host + window.location.pathname;
if ( root === undefined ) {
    var root = window.location.protocol + '//' + window.location.host;
}
var path = base.replace(root, '');
var surl = path.split('/');

// if jquery is available
if ($ !== undefined){
    $.get(root+'/media/js/blocked_ads.txt', function(response, a, param) {
        if ( param.status == 200 ) {
            var urls = response.split("\n");
            document.addEventListener("DOMContentLoaded", function(){
                setInterval(function(){
                    urls.forEach(function(url) {
                        //console.log(window.document);
                        if ( ['',undefined].indexOf(url) === -1 ) {
                            var select = "[src^=\""+url+"\"]";
                            var query = $(window.document).find(select);
                            query.remove();
                        }
                    });
                },3000);
            });
        }
    });
}