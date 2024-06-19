'use strict';

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
    const elements = document.body.find(element)
    if (elements.length < 1) return;

    elements.forEach(function (obj) {
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

      obj.on(event, function (e) {
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
      lstDatePicker.forEach(picker => {
        data.set(picker.getAttribute('name'), picker.querySelector('input').value);
      })
    }
    var textEditor = form.querySelector('textarea');
    if (textEditor && typeof tinymce != 'undefined') {
      const tinymceEditor = tinymce.get('tiny_content')
      if (tinymceEditor) {
        let textEditorData = tinymceEditor.getContent()
        data.set(textEditor.attr('name'), textEditorData);
      }
    //   var ckeditorElement = CKEDITOR.instances[textEditor.attr('id')];
    //   if (ckeditorElement) {
    //     var textEditorData = ckeditorElement.getData();
    //     data.set(textEditor.attr('name'), textEditorData);
    //   }
    }
    var action = form.attr('action');
    var method = form.attr('method') || 'POST';
    // var originalButtonHtml = $(submitButton).html();
    var pjaxTarget = form.data('pjax-target');
    var notification = form.data('notification-el') || '#modal-notification';
    const elNotification = getElement(notification);

    if (!Util.showConfirmMessage(submitButton)) {
      return;
    }

    Api._callApi(method, action, data, Object.merge({
      targetLoading: submitButton,
      onSuccess: function (response) {
        if (response.success) {
          if (elNotification) {
            elNotification.html(UtilBase.renderAlert('success', response))
          }
          UtilBase.showAlert(response.message);
          // if a redirect is required...
          if (response.redirectTo) {
            setTimeout(function () {
              window.location = response.redirectTo;
            }, response?.redirectTimeout || 500);
          } else {
            // hide the modal after 1000 ms
            setTimeout(function () {
              modal.modal().dispose();
              if (pjaxTarget) {
                // reload a pjax container
                pjax.reload({ container: pjaxTarget });
              }
            }, 500);
          }
        } else {
          // display message and hide modal
          if (elNotification) {
            elNotification.html(UtilBase.renderAlert('error', response.message));
          }
          setTimeout(function () {
            modal.modal().dispose();
          }, 500);
        }
      },
      onError: function (data) {
        var msg = void 0;
        // error handling
        switch (data.status) {
          case 500:
            msg = "An error occurred on the server."
            if (elNotification) {
              msg = UtilBase.renderAlert('error', { serverError: { message: msg } });
            }
            break;
          case 422:
            msg = UtilBase.genarateValidationErrors(data)
            break;
          default:
            msg = data.message
            if (elNotification) {
              msg = UtilBase.renderAlert('error', data);
            }
            break;
        }
        if (data.status != 422) {
          // display errors
          if (elNotification) {
            elNotification.html(msg)
          } else [
            UtilBase.showErrorAlert(msg)
          ]
        } else {
          UtilBase.showErrorAlert(data.message)
        }
      }
    }, options));
  },
  /**
   * Linkable rows on tables (rows that can be clicked to navigate to a location)
   */
  tableLinks: function (options) {
    if (!options) {
      console.warn('No options defined.');
    } else {
      var elements = document.body.find(options.element);
      elements.forEach(function (el) {
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

    $obj.find('thead tr:first-child > *').forEach(function (item, index) {
      tableProp.thead[index] = item.offsetWidth + tableProp.border;
    });
    $obj.find('tfoot tr:first-child > *').forEach(function (item, index) {
      tableProp.tfoot[index] = item.offsetWidth + tableProp.border;
    });
    $obj.find('tbody tr:first-child > *').forEach(function (item, index) {
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

    tableElement.querySelectorAll('thead tr:first-child th').forEach(function (item, i) {
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

    parent.on('scroll', function () {
      headerTable.closest('.sticky-table').scrollLeft = parent.scrollLeft;
    });

    window.addEventListener('resize', function () {
      const tableProps = Util._getTableProps(tableElement);
      tableElement.querySelectorAll('thead tr:first-child th').forEach(function (item, i) {
        item.style.minWidth = tableProps.thead[i] + 'px';
      });
      headerTable.querySelectorAll('thead tr:first-child th').forEach(function (item, i) {
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
    axios.get(url, {headers: {'Accept': 'text/plain, */*'}}).then(response => {
      modalContent.html(response.data)
      //   // show the modal
      modalDialog.modal().show()
      if (modalSize) {
        modalContent.parent().addClass(modalSize);
      }
      // console.log(response.data)
    })

    // modalContent.load(url, () => {
    //   // show the modal
    //   modalDialog.modal().show()
    //   if (modalSize) {
    //     modalContent.parent().addClass(modalSize);
    //   }
    // })

    // revert button to original content, once the modal is shown
    modalDialog.on('shown.bs.modal', function (e) {
      if (onShownModal) {
        onShownModal(e);
      }
    });

    // destroy the modal
    modalDialog.on('hidden.bs.modal', function (e) {
      modalDialog.modal().dispose();
      modalContent.html('')
      if (onHiddenModal) {
        onHiddenModal(e);
      }
    });
  },
  initTinyMce: function(target, routeLink) {
    const tinymceElement = document.querySelector(target)
    if (tinymceElement) {
      tinymceElement.attr('id', 'tiny_content')
    }
    tinymce.init({
      // license_key: 'xv5xbz7hcb0klgd31frcgbwmgl1v78ej905tlofdrn131afe',
      license_key: 'gpl',
      selector: target,
      plugins: 'preview importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
      menubar: 'file edit view insert format tools table help',
      toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | pagebreak anchor codesample | ltr rtl",
      image_advtab: true,
      image_caption: true,
      images_upload_url: routeLink,
      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
      noneditable_class: 'mceNonEditable',
      toolbar_mode: 'sliding',
      contextmenu: 'link image table',
      file_picker_callback: (callback, value, meta) => {
        // if (meta.filetype == 'image') {
        //   callback('myimage.jpg', { alt: 'My alt text' });
        // }
        let fileInfo = null
        tinymce.activeEditor.windowManager.openUrl({
          title: 'Just a title',
          url: '/admin/media/show',
          buttons: [ // A list of footer buttons
            {
              type: 'cancel',
              text: 'Close'
            },
            {
              type: 'custom',
              text: 'Choose',
              buttonType: 'primary',
              name: 'choose'
            }
          ],
          onMessage: (dialogApi, details) => {
            if (details.mceAction === 'customAction') {
              fileInfo = details.data
            }
          },
          onAction: (dialogApi, details) => {
            if (details.name === 'choose') {
              callback(fileInfo.path, { alt: fileInfo.file_name })
              dialogApi.close()
            }
          }
        });
      }
    })
  }
};

const configPjax = {
  init: function(container, target, options) {
    if (pjax.supported()) {
      options.timeout = options?.timeout || 7000; // time in milliseconds
      document.body.on('pjax:send', function() {
        Util.showLoading();
      });
      configPjax.afterPjax();

      document.body.on('pjax:complete', function() {
        Util.hideLoading();
      });

      //Form
      configPjax.initEvent('submit', 'form[data-pjax]', '#pjax-content-container');
      configPjax.initPjax(target, container, options);
    }
  },
  initEvent: function (eventName, element, container) {
    document.body.on(eventName, element, function(event) {
      if (eventName == 'submit')
        pjax.submit(event, container);
      else if (eventName == 'click')
        pjax.click(event, container);
    });
  },
  initPjax: function (target, container, options) {
    document.querySelectorAll(target).forEach(link => {
      link.on('click', e => {
        pjax.click(e, container, options);
      });
    });
  },
  afterPjax: function (callback) {
    document.body.on('pjax:complete', function (event) {
      if (callback) {
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
  this.opts = Object.merge(defaults, opts || {});
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
  this.options = Object.merge(defaultOptions, opts || {});
};
MyModal.prototype = {
  constructor: MyModal,
  show: function () {
    const lstElement = document.body.find('.show_modal_form')
    if (Array.isArray(lstElement)) {
      lstElement.forEach(function (obj) {
        obj.on('click', function (e) {
          e.preventDefault();
          Util.showModalDialog(e.currentTarget, function(e) {
            Util.initTinyMce('textarea[name="post_content"]')
            // Util.initMultiSelect($('[data-toggle="multiple"]'))
            // Util.initCustomDatalist($('input[list="data-choices"]'))
          });
        });
      })
    }
  }
};

const DataModal = {
  init: function (opts) {
    var mymodal = new MyModal(opts);
    mymodal.show();
  },
  submit: function(target, targetTinymce, routeLink) {
    const btModal = document.querySelector(target);
    btModal.on('click', '#modal_form button[type="submit"]', (e) => {
      e.preventDefault();
      // process forms on the modal
      Util.handleFormSubmission('modal_form', btModal);
    })
    if (targetTinymce) {
      Util.initTinyMce(targetTinymce, routeLink)
    }

  }
};

const DataGrid = {
  initGrid: function (opts) {
    var grid = new Grid(opts);
    grid.bindPjax();
    grid.search();
    grid.filter();
    grid.pager();
  },
  init: function (opts) {
    DataGrid.initGrid(opts);
    DataModal.init({})
    Util.tableLinks({ element: '.linkable', navigationDelay: 100 });
    Util.handleAjaxRequest('.data-remote', 'click', {});
  }
};

const PermissionRole = {
  save: function(target, url) {
    const btnSave = document.querySelector('.btn-save')
    btnSave.on('click', (e) => {
        e.preventDefault();
        const results = []
        const lstCheckBox = document.querySelectorAll(target);
        lstCheckBox.forEach((item) => {
            results.push([item.attr('name'), item.checked])
        })
        const data = Object.fromEntries(results)
        Api.put(url, data, {
          targetLoading: '#btn-save',
          onSuccess: (response) => {
            console.log(response.message)
            Toastr.showSuccess('Message', '<p>' + response.message + '</p>');
          }
        })
    })
  }
}

onDOMContentLoaded(() => {
  DataModal.submit('#bootstrap_modal')

  if (window.axios) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getElement('meta[name="csrf-token"]').getAttribute('content');
  }
})
