function loadIt() {
    jQuery('#notifications_response').empty();
    jQuery.get(url_global+"cms/notification", function( notifications_response ) {
        jQuery( "#notifications_response" ).html( notifications_response );
    });
}
loadIt();
setInterval(loadIt, 10000);