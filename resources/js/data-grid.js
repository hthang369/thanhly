/*
 * Copyright (c) 2018.
 * @author Antony [leantony] Chacha
 */

'use strict';

import {getElement, onDOMContentLoaded} from 'bootstrap/js/src/util/index';
import SelectorEngine from 'bootstrap/js/src/dom/selector-engine';
import EventHandler from 'bootstrap/js/src/dom/event-handler';
import ScrollPage from '../vnnit-coreui/js/scroll-page';
import CloseButton from '../vnnit-coreui/js/close-button';
import './selector-element';
import pjax from './pjax';
import {has, isNil, isEmpty, get, forEach, merge, isFunction} from 'lodash';
import axios from 'axios';
import { Toastr, Api, UtilBase } from './utils';

function downloadFilePath(filePath) {
  if (isNil(filePath) || isEmpty(filePath)) {
    Toastr.showError('Notification', 'File not found!')
  }
  $.fileDownload(filePath)
    .done(function () {
      Toastr.showSuccess('Notification', 'Download is successfull')
    })
    .fail(function () {
      Toastr.showError('Notification', 'Download is fail')
    });
}

const FormUtils = {

  /**
   * Form submission from a modal dialog
   *
   * @param formId
   * @param modal
   */
  handleFormSubmission: function (formId, modal, options) {
    var form = getElement('#' + formId);
    var submitButton = form.findOne('[type=submit]');
    var data = new FormData(form);
    const lstDatePicker = form.find('.date-picker');
    if (lstDatePicker) {
      forEach(lstDatePicker, function (picker) {
        data.set(picker.getAttribute('name'), picker.querySelector('input').value);
      });
    }
    // var textEditor = form.querySelector('textarea');
    // if (textEditor && typeof CKEDITOR != 'undefined') {
    //   var ckeditorElement = CKEDITOR.instances[textEditor.attr('id')];
    //   if (ckeditorElement) {
    //     var textEditorData = ckeditorElement.getData();
    //     data.set(textEditor.attr('name'), textEditorData);
    //   }
    // }
    var action = form.attr('action');
    var method = form.attr('method') || 'POST';
    // var originalButtonHtml = $(submitButton).html();
    var pjaxTarget = form.data('pjax-target');
    var notification = form.data('notification-el') || 'modal-notification';
    var _this = this;

    if (!Util.showConfirmMessage(submitButton)) {
      return;
    }

    Api._callApi(method, action, data, merge({
      targetLoading: submitButton,
      onSuccess: function (response) {
        if (response.success) {
          var message = '<i class=\"fa fa-check\"></i> ';
          message += response.message;
          getElement(notification).html(_this.renderAlert('success', message));
          // if a redirect is required...
          if (response.redirectTo) {
            setTimeout(function () {
              window.location = response.redirectTo;
            }, response.redirectTimeout || 500);
          } else {
            // hide the modal after 1000 ms
            setTimeout(function () {
              modal.modal({hide: true});
              if (pjaxTarget) {
                // reload a pjax container
                pjax.reload({ container: pjaxTarget });
              }
            }, 500);
          }
        } else {
          // display message and hide modal
          var el = getElement(notification);
          el.html(_this.renderAlert('error', response.message));
          setTimeout(function () {
            modal.modal({hide: true});
          }, 500);
        }
      },
      onError: function (data) {
        console.log(data)
        var msg = void 0;
        // error handling
        switch (data.status) {
          case 500:
            msg = _this.renderAlert('error', { serverError: { message: "An error occurred on the server." } });
            break;
          case 422:
            msg = UtilBase.genarateValidationErrors(data)
            break;
          default:
            msg = _this.renderAlert('error', data);
            break;
        }
        if (data.status != 422) {
          // display errors
          var el = getElement(notification);
          el.html(msg);
        }
      }
    }, options));
  }
};

const Util = {
  /**
   * Handle an ajax request from a button, form, link, etc
   *
   * @param element
   * @param event
   * @param options
   */
  handleAjaxRequest: function (element, event, options) {
    event = event || 'click';
    if (element.length < 1) return;

    forEach(element, function (obj) {
      const pjaxContainer = obj.getAttribute('data-pjax-target');
      // const refresh = obj.getAttribute('data-refresh-page');
      const frmTarget = getElement('#'+obj.getAttribute('data-form-id'));
      const isForm = obj.matches('form');
      const ajaxMethod = obj.getAttribute('data-method') || 'POST';
      const ajaxUrl = obj.getAttribute('href') || obj.getAttribute('data-action');
      const ajaxData = obj.getAttribute('data-value');
      if (isForm || frmTarget) {
        let tmpForm = isForm ? obj : frmTarget;
        ajaxMethod = tmpForm.attr('method');
        ajaxUrl = tmpForm.attr('action');
        ajaxData = tmpForm.serializeObject();
      }

      EventHandler.on(obj, event, function (e) {
        e.preventDefault();
        if (!Util.showConfirmMessage(obj)) {
          return;
        }
        if (isForm || frmTarget) {
          let tmpForm = isForm ? obj : frmTarget;
          ajaxData = tmpForm.serializeObject();
        }
        Api._callApi(ajaxMethod, ajaxUrl, ajaxData, _.merge({
          contentType: 'application/json',
          targetLoading: obj,
          pjaxContainer: pjaxContainer
        }, options))
      });
    });
  },
  /**
   * Linkable rows on tables (rows that can be clicked to navigate to a location)
   */
  tableLinks: function (options) {
    if (!options) {
      console.warn('No options defined.');
    } else {
      var elements = SelectorEngine.find(options.element);
      forEach(elements, function (el) {
        var link = el.data('url');
        el.css({ 'cursor': 'pointer' });
        el.on('click', function (e) {
          setTimeout(function () {
            window.location = link;
          }, options.navigationDelay || 100);
        });
      });
    }
  },
  /*
  * return object
  * Widths of each thead cell and tbody cell for the first rows.
  * Used in fixing widths for the fixed header and optional footer.
  */
  _getTableProps: function ($obj) {
    var tableProp = {
      thead: {},
      tbody: {},
      tfoot: {},
      border: 0
    };
    // borderCollapse = 1;

    // tableProp.border = ($obj.find('th:first-child').outerWidth() - $obj.find('th:first-child').innerWidth()) / borderCollapse;

    forEach($obj.find('thead tr:first-child > *'), function (item, index) {
      tableProp.thead[index] = item.offsetWidth + tableProp.border;
    });
    forEach($obj.find('tfoot tr:first-child > *'), function (item, index) {
      tableProp.tfoot[index] = item.offsetWidth + tableProp.border;
    });
    forEach($obj.find('tbody tr:first-child > *'), function (item, index) {
      tableProp.tbody[index] = item.offsetWidth + tableProp.border;
    });

    return tableProp;
  },

  filterMultiSelect: function (element, params, options) {
    if (element.length < 1) return;

    element.each(function (i, obj) {
      $(obj).multiselect(_.merge({
        nonSelectedText: _.get(params, 'nonSelectedText'),
        selectAllText: _.get(params, 'selectAllText'),
        includeSelectAllOption: true,
        numberDisplayed: _.get(params, 'numberDisplay'),
        onInitialized: function (select, container) {
          $(container).find('.form-check-label').addClass('custom-control-label').removeClass('form-check-label');
          if (_.has(params, 'onInitialized')) {
            params.onInitialized.call(select, container);
          }
        }
      }, options));
      $(obj).off('change').on('change', function () {
        let elelemts = [
          { 'name': $(obj).attr('name'), 'value': $(obj).val().join(',') }
        ];
        Util.callDoActionQuery(_.get(params, 'routeLink'), elelemts)
      });
    });
  },
  initMultiSelect: function (element, params, options) {
    if (element.length < 1) return;

    element.each(function (i, obj) {
      $(obj).multiselect(_.merge({
        buttonTextAlignment: 'left',
        nonSelectedText: _.get(params, 'nonSelectedText'),
        selectAllText: _.get(params, 'selectAllText'),
        includeSelectAllOption: true,
        numberDisplayed: _.get(params, 'numberDisplay'),
        onInitialized: function (select, container) {
          // $(container).find('.form-check-label').addClass('custom-control-label').removeClass('form-check-label');
          if (_.has(params, 'onInitialized')) {
            params.onInitialized.call(select, container);
          }
        }
      }, options));
    });
  },
  initCustomDatalist: function (element) {
    if (element.length < 1) return;

    element.each(function (i, obj) {
      let elementInput = $(obj);
      let elementDatalist = $(obj).next();
      $(obj).attr('list', '').attr('data-toggle', 'dropdown');
      $(elementDatalist).addClass('dropdown-menu');

      $(elementInput).on('focus', function() {
          $(elementDatalist).find('option').css('display', 'block')
      }).on('input', function() {
          let inputVal = $(this).val().toLowerCase();
          $(elementDatalist).find('option').each(function(key, item) {
              if (item.value.toLowerCase().indexOf(inputVal) > -1) {
                  item.style.display = 'block';
              } else {
                  item.style.display = 'none';
              }
          })
      })
      $(elementDatalist).find('option').each(function(key, item) {
          item.onclick = function() {
              $(obj).val(item.value);
              $(elementInput).dropdown('hide');
          }
      });
    });
  },
  callDoActionQuery: function (routeLink, elements, isReset) {
    let params = new URLSearchParams(location.search)
    params.forEach(function (val, key) {
      if (isReset)
        params.delete(key);
      else if (key == 'page')
        params.delete(key);
    });

    forEach(elements, function (item) {
      if (item.value) {
        params.set(item.name, item.value)
      } else {
        params.delete(item.name)
      }
    });

    let url = params.toString() == '' ? '' : '?' + params.toString();
    let fullUrl = new URL(url, routeLink);
    window.location.replace(fullUrl.toString());
  },
  showConfirmMessage: function (btnTarget) {
    var confirmation = btnTarget.getAttribute('data-trigger-confirm');
    var confirmationMessage = btnTarget.getAttribute('data-confirmation-msg') || 'Are you sure?';

    if (confirmation) {
      return confirm(confirmationMessage);
    }

    return true;
  },
  stickyHeaderTable: function () {
    let tableElement = getElement('#data-table');
    var tableProps = Util._getTableProps(tableElement);
    let parent = tableElement.parentElement;

    forEach(tableElement.querySelectorAll('thead tr:first-child th'), function (item, i) {
      item.style.minWidth = tableProps.thead[i] + 'px';
    });

    if (!parent.closest('.table-wrapper')) {
      const tableWrapper = document.createElement('div');
      tableWrapper.classList.add('table-wrapper');
      parent.parentElement.insertBefore(tableWrapper, parent);
      tableWrapper.appendChild(parent);
    }

    const headerTable = tableElement.cloneNode(true);
    const stickyTable = document.createElement('div');
    stickyTable.classList.add('table-responsive', 'sticky-table', 'sticky-top');
    stickyTable.appendChild(headerTable);
    headerTable.classList.add('mb-0');
    headerTable.querySelector('tbody').remove();
    if (headerTable.querySelectorAll('thead tr').length > 1) {
      headerTable.querySelector('thead tr:last-child').remove();
    }
    parent.closest('.table-wrapper').insertBefore(stickyTable, parent);

    tableElement.classList.add('content-table');

    EventHandler.on(parent, 'scroll', function () {
      headerTable.closest('.sticky-table').scrollLeft = parent.scrollLeft;
    });

    EventHandler.on(window, 'resize', function () {
      const tableProps = Util._getTableProps(tableElement);
      forEach(tableElement.querySelectorAll('thead tr:first-child th'), function (item, i) {
        item.style.minWidth = tableProps.thead[i] + 'px';
      });
      forEach(headerTable.querySelectorAll('thead tr:first-child th'), function (item, i) {
        item.style.minWidth = tableProps.thead[i] + 'px';
      });
    });
  },
  showLoading: function () {
    setTimeout(function() {
      let preloaderElement = getElement('.preloader');
      preloaderElement.removeAttr('style');
      preloaderElement.firstElementChild.show();
    }, 200);
  },
  hideLoading: function () {
    setTimeout(function() {
      let preloaderElement = getElement('.preloader');
      preloaderElement.css('height', 0);
      preloaderElement.firstElementChild.hide();
    }, 200);
  },
  showModalDialog: function (btnTarget, onShownModal = null, onHiddenModal = null) {
    var btn = getElement(btnTarget);
    var modalDialog = getElement('#bootstrap_modal');
    var modalSize = btn.data('modal-size');

    if (!Util.showConfirmMessage(btn)) {
      return;
    }

    // load the modal into the container put on the html
    const url = btn.attr('href') || btn.data('href');
    const modalContent = getElement('.modal-content');
    fetch(url).then(response => {
      if (response.ok) {
        return response.text()
      }
    }).then(body => {
      // show the modal
      modalDialog.modal().show()
      if (modalSize) {
        modalContent.parent().addClass(modalSize);
      }
      modalContent.html(body)
    })

    // revert button to original content, once the modal is shown
    modalDialog.on('shown.bs.modal', function (e) {
      if (isFunction(onShownModal)) {
        onShownModal(e);
      }
    });

    // destroy the modal
    modalDialog.on('hidden.bs.modal', function (e) {
      modalDialog.modal().dispose();
      modalContent.html('')
      if (isFunction(onHiddenModal)) {
        onHiddenModal(e);
      }
    });
  }
};

const configPjax = {
  init: function(container, target, options) {
    if (pjax.supported()) {
      options.timeout = _.get(options, 'timeout', 7000); // time in milliseconds
      EventHandler.on(document, 'pjax:send', function() {
        Util.showLoading();
      });
      configPjax.afterPjax();

      EventHandler.on(document, 'pjax:complete', function() {
        Util.hideLoading();
      });

      //Form
      configPjax.initEvent('submit', 'form[data-pjax]', '#pjax-content-container');
      configPjax.initPjax(target, container, options);
    }
  },
  initEvent: function (eventName, element, container) {
    EventHandler.on(document, eventName, element, function(event) {
      if (eventName == 'submit')
        pjax.submit(event, container);
      else if (eventName == 'click')
        pjax.click(event, container);
    });
  },
  initPjax: function (target, container, options) {
    SelectorEngine.find(target).forEach(link => {
      link.on('click', e => {
        pjax.click(e, container, options);
      });
    });
  },
  afterPjax: function (callback) {
    EventHandler.on(document, 'pjax:complete', function (event) {
      if (isFunction(callback)) {
        callback(event.currentTarget);
      }
      Util.hideLoading();
    });
  },
  redirectPjax: function (url = '') {
    if(!url) return false;

    pjax({url: url, container: '#pjax-content-container'});
  }
};

const Grid = function (opts) {
  var defaults = {
    /**
     * The ID of the html element containing the grid
     */
    id: '#some-grid',
    /**
     * The ID of the html element containing the filter form
     */
    filterForm: undefined,
    /**
     * The ID of the html element containing the search form
     */
    searchForm: undefined,
    /**
     *
     */
    pagerDropdown: undefined,
    /**
     * The CSS class of the columns that are sortable
     */
    sortLinks: 'data-sort',
    /**
     * The selector of a date range filter
     */
    dateRangeSelector: '.date-range',
    /**
     * PJAX
     */
    pjax: {
      /**
       * Any extra pjax plugin options
       */
      pjaxOptions: {},

      /**
       * Something to do once the PJAX request has been finished
       */
      afterPjax: function afterPjax(e) { }
    }
  };
  this.opts = merge(defaults, opts || {});
};
Grid.prototype = {
  constructor: Grid,
  setupPjax: function (container, target, afterPjax, options) {
    options.timeout = options.timeout || 3000;
    configPjax.init(container, target, options)
    configPjax.afterPjax(afterPjax);
  },
  bindPjax: function () {
    this.setupPjax(this.opts.id, 'a[data-trigger-pjax]', this.opts.pjax.afterPjax, this.opts.pjax.pjaxOptions);

    // setupDateRangePicker(this);

    Util.stickyHeaderTable();
  },
  filter: function () {
    const form = getElement(this.opts.filterForm.target);
    if (form) {
      let btnFilter = getElement(this.opts.filterForm.btnName);
      var formCtrl = form.find('.form-control');
      let routeLink = this.opts.filterForm.routeLink;

      if (formCtrl.length > 0) {
        btnFilter.on('click', function () {
          Util.callDoActionQuery(routeLink, formCtrl);
        });
      }
    }


  },
  search: function () {
    const form = getElement(this.opts.searchForm);

    if (form) {
      form.on('submit', function (event) {
        pjax.submit(event, this.opts.id, this.opts.pjax.pjaxOptions);
      });
    }
  },
  pager: function () {
    let target = getElement(this.opts.pagerDropdown.target);
    if (target) {
      let routeLink = this.opts.filterForm.routeLink;
      target.on('change', function (e) {
        Util.callDoActionQuery(routeLink, [e.target]);
      });
    }
  }
};

const MyModal = function (opts) {
  var defaultOptions = {};
  this.options = merge(defaultOptions, opts || {});
};
MyModal.prototype = {
  constructor: MyModal,
  show: function () {
    forEach(SelectorEngine.find('.show_modal_form'), function (obj) {
      obj.on('click', function (e) {
        e.preventDefault();
        Util.showModalDialog(e.currentTarget, function(e) {
          // Util.initMultiSelect($('[data-toggle="multiple"]'))
          // Util.initCustomDatalist($('input[list="data-choices"]'))
        });
      });
    });
  }
};

const DataModal = {
  init: function (opts) {
    var mymodal = new MyModal(opts);
    mymodal.show();
  }
};

const DataGrid = {
  initGrid: function (opts) {
    var grid = new Grid(opts);
    // grid.bindPjax();
    grid.search();
    grid.filter();
    grid.pager();
  },
  init: function (opts) {
    DataGrid.initGrid(opts);
    DataModal.init({})
    Util.tableLinks({ element: '.linkable', navigationDelay: 100 });
    Util.handleAjaxRequest(SelectorEngine.find('.data-remote'), 'click', {});
  }
};

// const ServiceInstance = {
//   initEvent: function(target, eventName, callback = null) {
//     Util.handleAjaxRequest(getElement(target), 'click');
//   },
//   init: function () {
//     ServiceInstance.initEvent('.btn-start', 'click');
//     ServiceInstance.initEvent('.btn-stop', 'click');
//     ServiceInstance.initEvent('.btn-restart', 'click');
//   }
// };

onDOMContentLoaded(() => {
  // const btModal = document.querySelector('#bootstrap_modal');
  // EventHandler.on(btModal, 'click', '#modal_form button[type="submit"]', function(e) {
  //   e.preventDefault();
  //   // process forms on the modal
  //   FormUtils.handleFormSubmission('modal_form', btModal);
  // });

  // setTimeout(() => {
  //   if (axios) {
  //     axios.defaults.headers.common['X-CSRF-TOKEN'] = getElement('meta[name="csrf-token"]').getAttribute('content');
  //   }
  // }, 1000);

  ScrollPage.render()
});

window.Toastr = Toastr;
window.Util = Util;
window.FormUtils = FormUtils;
window.Api = Api;
window.configPjax = configPjax;
window.Grid = Grid;
window.MyModal = MyModal;
window.DataModal = DataModal;
window.DataGrid = DataGrid;
// window.ServiceInstance = ServiceInstance;

//   $(document).on('ajaxSend', function() {
//     Util.showLoading();
//   }).on('ajaxComplete', function() {
//     Util.hideLoading();
//   }).on('ajaxError', function() {
//     Util.hideLoading();
//   });

//   $(window).scroll(function () {
//     if ($(this).scrollTop() > 100) {
//       $('.back-to-top').addClass('active');
//     } else {
//       $('.back-to-top').removeClass('active');
//     }
//   });
//   if (!$('#navbarNavDropdown').hasClass('show')) {
//     $('.main-content').removeClass('col-md-9');
//   }

//   $('.back-to-top').click(function () {
//     $('html, body').animate({
//       scrollTop: 0
//     }, 1500);
//     return false;
//   });

//   $('#navbarNavDropdown').on('show.bs.collapse', function () {
//     $('.main-content').addClass('col-md-9')
//   }).on('hidden.bs.collapse', function () {
//     if (!$(this).hasClass('show')) {
//       $('.main-content').removeClass('col-md-9')
//     }
//   });

//   $('.btn-download').click(function (e) {
//     e.preventDefault();
//     let filePath = $(this).data('file');
//     downloadFilePath(filePath);
//   });

//   configPjax.initPjax('nav[data-pjax] .nav-sidebar a', '#pjax-content-container');
//   configPjax.afterPjax(function() {
//     if (_.isFunction(loadInitDataGrid)) {
//       loadInitDataGrid();
//     }
//   });
//   window.addEventListener('DOMContentLoaded', function() {
//     Util.hideLoading();
//   });
// })(jQuery);
