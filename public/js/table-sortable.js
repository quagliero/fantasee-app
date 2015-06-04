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
          if (this.dataset.dir === 'asc') {
            this.dataset.dir = 'desc';
          } else {
            this.dataset.dir = 'asc';
          }

          Array.prototype.forEach.call(document.querySelectorAll('.sortable > thead > tr > th > [class*="fa-sort"]'), function (el) {
            el.className = 'fa fa-sort';
          });

          var dir = this.dataset.dir;
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
      if (dir == 'asc') {
        if (colA > colB) {
          return 1;
        }
        if (colA < colB) {
          return -1;
        }
      } else {
        if (colA < colB) {
          return 1;
        }
        if (colA > colB) {
          return -1;
        }
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
