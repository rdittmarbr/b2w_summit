// Generated by CoffeeScript 1.6.3
(function() {
  var bindTooltips;

  $(function() {
    var apiMate, placeholders;
    placeholders = {
      results: '#api-mate-results',
      modal: '#post-response-modal'
    };
    apiMate = new ApiMate(placeholders);
    apiMate.start();
    bindTooltips();
    return $('#api-mate-results').on('api-mate-urls-added', function() {
      return bindTooltips();
    });
  });

  bindTooltips = function() {
    var defaultOptions;
    defaultOptions = {
      container: 'body',
      placement: 'top'
    };
    //return $('.tooltipped').tooltip(defaultOptions);
  };

}).call(this);
