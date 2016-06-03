(function () {
  'use strict';

  var name = document.getElementById('name');
  var slug = document.getElementById('slug');

  function updateSlug() {
    var nameAsSlug = name.value.replace(/\s+/g, '-').toLowerCase();
    slug.value = nameAsSlug;
  }
  
  name.addEventListener('keyup', updateSlug);
  name.addEventListener('blur', updateSlug);
}());
