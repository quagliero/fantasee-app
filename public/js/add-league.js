(function () {
  'use strict';

  var name = document.getElementById('name');
  var slug = document.getElementById('slug');

  name.addEventListener('keyup', function () {
    var nameAsSlug = this.value.replace(/\s+/g, '-').toLowerCase();
    slug.value = nameAsSlug;
  });

}());
