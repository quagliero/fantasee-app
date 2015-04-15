(function ($) {
  'use strict';

  var $counters = $('[data-counter]');


  function animateNumber(el, start, target) {
    var number = start;
    var animate = setInterval(function () {
      el.innerHTML = number;
      if (number >= target) {
        clearInterval(animate);
      }
      number++;
    }, 10);
  }

  $(document).ready(function () {
    $counters.each(function (i) {
      var $this = $(this);
      var start = $this.data('counter-start') || 0;
      var count = $this.data('counter');
      var el = $this.get(0);
      animateNumber(el, start, count);
    });
  });

}(window.jQuery));
