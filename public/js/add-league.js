(function ($) {
  'use strict';

  var $name = $('#name');
  var $slug = $('#slug');

  $name.on('keyup', function () {
    var slug = $(this).val().replace(/\s+/g, '-').toLowerCase();
    $slug.val(slug);
  });

}(window.jQuery));
