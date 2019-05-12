(function ($, Drupal) {
Drupal.AjaxCommands.prototype.refreshWeather = function (ajax, response, status) {
  console.log(response.message);
}
})(jQuery, Drupal);