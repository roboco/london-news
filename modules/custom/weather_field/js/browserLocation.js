(function ($, Drupal) {
    Drupal.behaviors.BrowserLocation = {
        attach: function (context, settings) {
            $('#wf-location', context).once('search').bind('focus', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
                function showPosition(position) {
                    this.innerHTML = position.coords.latitude +
                        "/" + position.coords.longitude;
                }
            });
        }
    };
})(jQuery, Drupal);