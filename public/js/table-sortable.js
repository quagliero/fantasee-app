(function(window, document) {
  'use strict';

  function TableSortable(table) {
    this.table = table;
    this.headings = this.table.querySelectorAll('th');
    this.cols = this.getSortableCols(table.dataset.sortable || 'all');
    this.body = this.table.querySelector('tbody');
    this.rows = this.table.querySelectorAll('tbody > tr');

    this.init();
  }

  TableSortable.prototype.init = function() {
    this.createSortableCols();
  };

  TableSortable.prototype.getSortableCols = function(cols) {
    var colsMap = {};
    if (cols === 'all') {
      Array.prototype.map.call(this.headings, function(el, i) {
        colsMap[i] = 'sortable';
      });
    } else {
      cols.split(',').map(function(el, i) {
        colsMap[el] = 'sortable';
      });
    }

    return colsMap;
  };

  TableSortable.prototype.createSortableCols = function() {
    var that = this;
    this.table.classList.add('sortable');

    Array.prototype.forEach.call(this.headings, function(el, i) {
      if (that.cols[i] === 'sortable') {
        // Update UI
        var icon = document.createElement('i');
        icon.className = 'fa fa-sort';
        el.appendChild(icon);
        el.classList.add('sortable__heading');

        // Add event listener
        el.addEventListener('click', function(e) {
          var dir = (this.dataset.dir === 'asc') ? 'desc' : 'asc';
          this.dataset.dir = dir;

          Array.prototype.forEach.call(that.headings, function (el, i) {
            if (el.querySelector('[class*="fa-sort"]')) {
              el.querySelector('[class*="fa-sort"]').className = 'fa fa-sort';
            }
          });

          this.querySelector('.fa').className = 'fa fa-sort-' + dir;
          that.sortCol(i, dir);
        });
      }
    });
  };

  TableSortable.prototype.sortCol = function(col, dir) {
    var that = this;
    var toSort = Array.prototype.slice.call(this.rows);

    toSort.sort(function(a, b) {
      var colA = Number(a.getElementsByTagName('td')[col].textContent);
      var colB = Number(b.getElementsByTagName('td')[col].textContent);
      if (colA > colB) {
        return (dir === 'asc') ? 1 : -1;
      }
      if (colA < colB) {
        return (dir === 'asc') ? -1 : 1;
      }
      // a must be equal to b
      return 0;
    });

    this.rows.innerHTML = '';

    toSort.forEach(function (el) {
      that.body.appendChild(el);
    });

  };


  /* Fire off */
  Array.prototype.forEach.call(document.querySelectorAll('[data-sortable]'), function(el) {
    var sortable = new TableSortable(el);
  });

  window.TableSortable = TableSortable;
}(window, document));
