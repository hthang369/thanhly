/*
 * Copyright (c) 2018.
 * @author Antony [leantony] Chacha
 */

'use strict';

var _grids = _grids || {};
var $api = $api || {};
var $toast = $toast || {};

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function showConfirmMessage(btnTarget) {
    var confirmation = btnTarget.data('trigger-confirm');
    var confirmationMessage = btnTarget.data('confirmation-msg') || 'Are you sure?';

    if (confirmation) {
        return confirm(confirmationMessage);
    }

    return true;
}

function callDoActionQuery(routeLink, elements, isReset = false) {
    let params = new URLSearchParams(location.search)
    params.forEach(function(val, key) {
        if (isReset)
            params.delete(key);
        else if (key == 'page')
            params.delete(key);
    });
    
    $.each(elements, function (idx, item) {
        if (item.value) {
            params.set(item.name, item.value)
        } else {
            params.delete(item.name)
        }
    });
    let url = params.toString() == '' ? '' : '?' + params.toString();
    let fullUrl = new URL(url, routeLink);
    window.location.replace(fullUrl.toString());
}

function downloadFilePath(filePath) {
    if (_.isNil(filePath) || _.isEmpty(filePath)) {
        $toast.showError('Notification', 'File not found!')
    }
    $.fileDownload(filePath)
        .done(function () {
            $toast.showSuccess('Notification', 'Download is successfull')
        })
        .fail(function () {
            $toast.showError('Notification', 'Download is fail')
        });
}

(function ($) {
    if (typeof $ === 'undefined') {
        throw new Error('Requires jQuery');
    }

    $.fn.serializeObject = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    $.fn.modal = function (options) {
        return new bootstrap.Modal(this, options);
    }

    var toastr = {
        renderTitle: function renderTitle(title) {
            var $titleToast = $('<b />', { class: 'mr-auto toast-title' }).text(title);
            return $titleToast;
        },
        renderHeader: function renderHeader(title, color, icon) {
            var $iconHeader = $('<i />', { class: 'bi '+icon });
            var $imgHeader = $('<span />', { class: 'rounded mr-2 mb-0 h5 text-'+color }).append($iconHeader);
            var $toastHeader = $('<div />', { class: 'toast-header' });
            var $btnClose = $('<button />', {
                type: 'button',
                class: 'ml-2 mb-1 close',
                'data-dismiss': 'toast',
                'aria-label': 'Close'
            }).html('<span aria-hidden="true">&times;</span>')
            $toastHeader.append($imgHeader).append(this.renderTitle(title)).append($btnClose);
            return $toastHeader;
        },
        renderBody: function renderBody(content) {
            var $bodyToast = $('<div />', { class: 'toast-body' });
            $bodyToast.html(content);
            return $bodyToast;
        },
        render: function render(title, content, color, icon) {
            var $toast = $('<div />', {
                class: 'toast',
                role: 'alert',
                'aria-live': 'assertive',
                'aria-atomic': 'true',
                'data-delay': '5000'
            });
            $toast.append(this.renderHeader(title, color, icon)).append(this.renderBody(content));
            $("#popupToast").html($toast);
            return $toast;
        },
        showSuccess: function showSuccess(title, content) {
            return this.render(title, content, 'success', 'bi-check-circle-fill').toast('show');
        },
        showError: function showError(title, content) {
            return this.render(title, content, 'danger', 'bi-x-circle-fill').toast('show');
        }
    };
    $toast = toastr;

    $api = {
        _callApi: function (apiMethod, apiUrl, apiData, options) {
            let apiContentType = _.get(options, 'contentType', false);
            let targetLoading = _.get(options, 'targetLoading', null);
            let loadingText = null;
            let btnTarget = null;
            if (targetLoading) {
                loadingText = $(targetLoading).data('loading');
                btnTarget = $(targetLoading).html();
            }
            $.ajax({
                method: apiMethod,
                url: apiUrl,
                data: apiData,
                dataType: 'json',
                contentType: apiContentType,
                processData: false,
                beforeSend: function beforeSend() {
                    if (_.has(options, 'beforeSend')) {
                        options.beforeSend.call(this);
                    }
                    if (targetLoading) {
                        $(targetLoading).attr('disabled', 'disabled').addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;' + loadingText);
                    }
                },
                complete: function complete() {
                    if (_.has(options, 'onComplete')) {
                        options.onComplete.call(this);
                    }
                    if (targetLoading) {
                        $(targetLoading).html(btnTarget).removeAttr('disabled').removeClass('disabled');
                    }
                },
                success: function success(data) {
                    _grids.formUtils.clearFormValidationErrors();
                    if (_.has(options, 'onSuccess')) {
                        options.onSuccess.call(this, data);
                    } else {
                        if (_.has(options, 'pjaxContainer') && !_.isNil(options.pjaxContainer)) {
                            $.pjax.reload({ container: options.pjaxContainer });
                        }
                        if (typeof toastr !== 'undefined') {
                            if (_.get(data, 'success')) {
                                toastr.showSuccess('Message', '<p>' + _.get(data, 'message') + '</p>');
                            }
                        }
                    }
                },
                error: function error(data) {
                    if (_.has(options, 'onError')) {
                        options.onError.call(this, data);
                    } else {
                        if (typeof toastr !== 'undefined') {
                            let err = _grids.formUtils.genarateValidationErrors(data.responseJSON);
                            toastr.showError('Message', '<ul>' + err + '</ul>');
                        } else {
                            alert('An error occurred');
                        }
                    }
                }
            });
        },
        get: function (url, params, options) {
            if (url == '') return;
            params = params || {};
            var urlSearch = new URLSearchParams();
            for (const [key, value] of Object.entries(params)) {
                urlSearch.append(key, value);
            }
            this._callApi('GET', url + '?' + urlSearch.toString(), null, options)
        },
        post: function (url, data, options) {
            if (url == '') return;
            // options = Object.assign({ contentType: 'application/json' }, options);
            this._callApi('POST', url, data, options);
        },
        put: function (url, data, options) {
            if (url == '') return;
            options = Object.assign({ contentType: 'application/json' }, options);
            this._callApi('PUT', url, data, options);
        },
        delete: function (url, data, options) {
            if (url == '') return;
            options = Object.assign({ contentType: 'application/json' }, options);
            this._callApi('DELETE', url, data, options);
        },
    }

    /**
       * Shared utilities
       *
       * @type object
       * @public
       */
    _grids.utils = {
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

            element.each(function (i, obj) {
                obj = $(obj);
                var pjaxContainer = obj.data('pjax-target');
                var refresh = obj.data('refresh-page');
                let frmTarget = obj.data('form-id') ? $('#' + obj.data('form-id')) : null;
                var isForm = obj.is('form');
                var ajaxMethod = obj.data('method') || 'POST';
                var ajaxUrl = obj.attr('href') || obj.data('action');
                var ajaxData = obj.data('value');
                if (_.isObject(ajaxData)) {
                    ajaxData = JSON.stringify(ajaxData);
                }
                if (isForm || frmTarget) {
                    let tmpForm = isForm ? obj : frmTarget;
                    ajaxMethod = tmpForm.attr('method');
                    ajaxUrl = tmpForm.attr('action');
                    ajaxData = JSON.stringify(tmpForm.serializeObject());
                }

                obj.on(event, function (e) {
                    e.preventDefault();
                    if (!showConfirmMessage(obj)) {
                        return;
                    }
                    if (isForm || frmTarget) {
                        let tmpForm = isForm ? obj : frmTarget;
                        ajaxData = JSON.stringify(tmpForm.serializeObject());
                    }
                    $api._callApi(ajaxMethod, ajaxUrl, ajaxData, _.merge({
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
                var elements = $(options.element);
                elements.each(function (i, obj) {
                    var el = $(obj);
                    var link = el.data('url');
                    el.css({ 'cursor': 'pointer' });
                    el.click(function (e) {
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
            },
                borderCollapse = 1;

            // tableProp.border = ($obj.find('th:first-child').outerWidth() - $obj.find('th:first-child').innerWidth()) / borderCollapse;

            $obj.find('thead tr:first-child > *').each(function (index) {
                tableProp.thead[index] = $(this).outerWidth() + tableProp.border;
            });

            $obj.find('tfoot tr:first-child > *').each(function (index) {
                tableProp.tfoot[index] = $(this).outerWidth() + tableProp.border;
            });

            $obj.find('tbody tr:first-child > *').each(function (index) {
                tableProp.tbody[index] = $(this).outerWidth() + tableProp.border;
            });

            return tableProp;
        },
        getProgressButton(target, success) {
            if (target) {
                let loadingText = $(target).data('loading');
                let btnTarget = $(target).data('text');

                if (success) {
                    $(target).attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;' + loadingText);
                } else {
                    $(target).html(btnTarget).removeAttr('disabled');
                }
            }
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
                        {'name': $(obj).attr('name'), 'value': $(obj).val().join(',')}
                    ];
                    callDoActionQuery(_.get(params, 'routeLink'), elelemts)
                });
            });
        }
    }

    /**
     * Initialization
     *
     * @param opts
     */
    var grid = function () {
        function grid(opts) {
            _classCallCheck(this, grid);

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
            this.opts = $.extend({}, defaults, opts || {});
        }

        /**
         * Enable pjax
         *
         * @param container the root element for which html contents shall be replaced
         * @param target the element in the root element that will trigger the pjax request
         * @param afterPjax a function that will be executed after the pjax request is done
         * @param options
         */
        _createClass(grid, [
            {
                key: 'setupPjax',
                value: function setupPjax(container, target, afterPjax, options) {
                    var _this2 = this;

                    // global timeout
                    $.pjax.defaults.timeout = options.timeout || 3000;
                    $(document).pjax(target, container, options);
                    $(document).on('ready pjax:end', function (event) {
                        afterPjax($(event.target));
                        // internal calls
                        setupDateRangePicker(_this2);
                    });
                }
            },
            {
                key: 'stickyHeaderTable',
                value: function stickyHeaderTable() {
                    let tableElement = $(this.opts.id);
                    var tableProps = _grids.utils._getTableProps(tableElement);
                    let parent = tableElement.parent();

                    tableElement.find('thead tr:first-child th').each(function(i, item) {
                        $(item).css('min-width', tableProps.thead[i] + 'px');
                    });

                    if (!parent.closest('.table-wrapper').length) {
                        parent.wrap('<div class="table-wrapper"></div>');
                    }

                    let headerTable = tableElement.clone().wrap('<div class="table-responsive sticky-table sticky-top"></div>');
                    headerTable.find('tbody').remove();
                    if (headerTable.find('thead tr').length > 1) {
                        headerTable.find('thead tr:last-child').remove();
                    }
                    headerTable.closest('.sticky-table').insertBefore(parent);

                    tableElement.addClass('content-table');

                    parent.scroll(function() {
                        headerTable.closest('.sticky-table').scrollLeft(parent.scrollLeft())
                    });

                    $(window).resize(function() {
                        var tableProps = _grids.utils._getTableProps(tableElement);
                        tableElement.find('thead tr:first-child th').each(function(i, item) {
                            $(item).css('min-width', tableProps.thead[i] + 'px');
                        });
                        headerTable.find('thead tr:first-child th').each(function(i, item) {
                            $(item).css('min-width', tableProps.thead[i] + 'px');
                        });
                    });
                }
            },
            /**
             * Initialize pjax functionality
             */
            {
                key: 'bindPjax',
                value: function bindPjax() {
                    this.setupPjax(this.opts.id, 'a[data-trigger-pjax=1]', this.opts.pjax.afterPjax, this.opts.pjax.pjaxOptions);

                    setupDateRangePicker(this);

                    this.stickyHeaderTable();
                }
            },
            /**
             * Pjax per row filter
             */
            {
                key: 'filter',
                value: function filter() {
                    var _this3 = this;

                    let btnFilter = $(this.opts.filterForm.btnName);
                    var form = $(this.opts.filterForm.target).find('.form-control');
                    let routeLink = this.opts.filterForm.routeLink;

                    if (form.length > 0) {
                        btnFilter.click(function () {
                            callDoActionQuery(routeLink, form)
                        });
                    }
                }
            },
            /**
             * Pjax search
             */
            {
                key: 'search',
                value: function search() {
                    var _this4 = this;

                    var form = $(this.opts.searchForm);

                    if (form.length > 0) {
                        $(document).on('submit', this.opts.searchForm, function (event) {
                            $.pjax.submit(event, _this4.opts.id, _this4.opts.pjax.pjaxOptions);
                        });
                    }
                }
            },
            /**
             * Pjax pager
             */
            {
                key: 'pager',
                value: function pager() {
                    let target = $(this.opts.pagerDropdown.target);
                    let routeLink = this.opts.filterForm.routeLink;
                    target.change(function (e) {
                        callDoActionQuery(routeLink, [e.target]);
                    });
                }
            }
        ]);

        return grid;
    }();

    /**
     * Setup date range picker
     *
     * @param instance
     */

    function setupDateRangePicker(instance) {
        if (instance.opts.dateRangeSelector) {
            if (typeof daterangepicker !== 'function') {
                console.warn('date range picker option requires https://github.com/dangrossman/bootstrap-daterangepicker.git');
            } else {
                var start = moment().subtract(29, 'days');
                var end = moment();
                var element = $(instance.opts.dateRangeSelector);
                element.daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    autoUpdateInput: false,
                    locale: {
                        format: 'YYYY-MM-DD',
                        cancelLabel: 'Clear'
                    }
                });

                element.on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                });

                element.on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                });
            }
        }
    }

    /**
     * The global grid object
     *
     * @type object
     * @public
     */
    _grids.grid = {
        init: function (options) {
            var obj = new grid(options);
            obj.bindPjax();
            obj.search();
            obj.filter();
            obj.pager();
        }
    };

    _grids.formUtils = {
        showAlert: function showAlert(message) {
            if (typeof toastr !== 'undefined') {
                toastr.showSuccess('Message', message);
            }
        },
        /**
         * Return html that can be used to render a bootstrap alert on the form
         *
         * @param type
         * @param response
         * @returns {string}
         */
        renderAlert: function renderAlert(type, response) {
            var validTypes = ['success', 'error', 'notice'];
            var html = '';
            if (typeof type === 'undefined' || $.inArray(type, validTypes) < 0) {
                type = validTypes[0];
            }
            if (type === 'success') {
                html += '<div class="alert alert-success">';
            } else if (type === 'error') {
                html += '<div class="alert alert-danger">';
            } else {
                html += '<div class="alert alert-warning">';
            }
            html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            // add a heading
            if (type === 'error') {
                if (response.serverError) {
                    html += response.serverError.message || 'A server error occurred.';
                    html = '<strong>' + html + '</strong>';
                    return html;
                } else {
                    html += response.message || 'Please fix the following errors';
                    html = '<strong>' + html + '</strong>';
                    var errs = this.genarateValidationErrors(response);
                    return html + errs + '</div>';
                }
            } else {
                return html + response + '</div>';
            }
        },
        genarateValidationErrors: function genarateValidationErrors(response) {
            let listErr = response.errors || response.validation || {}
            let errorsHtml = this.getValidationErrors(listErr);
            this.showFormValidationErrors(listErr);
            return errorsHtml;
        },
        /**
         * process validation errors from json to html
         * @param response
         * @returns {string}
         */
        getValidationErrors: function getValidationErrors(response) {
            var errorsHtml = '';
            $.each(response, function (key, value) {
                if (_.isArray(value)) {
                    errorsHtml += _.join(_.map(value, function(item) {
                        return '<li>' + item + '</li>'
                    }), '');
                }
                else
                    errorsHtml += '<li>' + value + '</li>';
            });
            return errorsHtml;
        },
        showFormValidationErrors: function showFormValidationErrors(response) {
            this.clearFormValidationErrors();
            $.each(response, function (key, value) {
                let form = $('[name="'+key+'"]').parents('form');
                let element = form.addClass('was-validated').find('[name="'+key+'"]:visible');
                if (element.length > 0) {
                    let elementTarget = element[0].tagName == 'INPUT' ? element[0] : (element.find('input:visible')[0] || element.find('select')[0]);
                    elementTarget.setCustomValidity(value);
                    $(element).addClass('is-invalid').next().html(value);
                }
            });
        },
        clearFormValidationErrors: function clearFormValidationErrors() {
            let formValid = $('.needs-validation');
            formValid.find('.form-control').each(function(key, item) {
                $(item).removeClass('is-invalid').next().html('');
                if (item.tagName == 'INPUT' || item.tagName == 'SELECT')
                    item.setCustomValidity('')
            });
        },
        /**
         * Form submission from a modal dialog
         *
         * @param formId
         * @param modal
         */
        handleFormSubmission: function (formId, modal, options) {
            var form = $('#' + formId);
            var submitButton = form.find(':submit');
            var data = new FormData(document.getElementById(formId));
            var textEditor = form.find('textarea');
            if (textEditor && typeof CKEDITOR != 'undefined') {
                var ckeditorElement = CKEDITOR.instances[textEditor.attr('id')];
                if (ckeditorElement) {
                    var textEditorData = ckeditorElement.getData();
                    data.set(textEditor.attr('name'), textEditorData);
                }
            }
            var action = form.attr('action');
            var method = form.attr('method') || 'POST';
            var originalButtonHtml = $(submitButton).html();
            var pjaxTarget = form.data('pjax-target');
            var notification = form.data('notification-el') || 'modal-notification';
            var _this = this;

            if (!showConfirmMessage(submitButton)) {
                return;
            }

            $api._callApi(method, action, data, _.merge({
                targetLoading: submitButton,
                onSuccess: function (response) {
                    if (response.success) {
                        var message = '<i class=\"fa fa-check\"></i> ';
                        message += response.message;
                        $('#' + notification).html(_this.renderAlert('success', message));
                        // if a redirect is required...
                        if (response.redirectTo) {
                            setTimeout(function () {
                                window.location = response.redirectTo;
                            }, response.redirectTimeout || 500);
                        } else {
                            // hide the modal after 1000 ms
                            setTimeout(function () {
                                modal.modal('hide');
                                if (pjaxTarget) {
                                    // reload a pjax container
                                    $.pjax.reload({ container: pjaxTarget });
                                }
                            }, 500);
                        }
                    } else {
                        // display message and hide modal
                        var el = $(notification);
                        el.html(_this.renderAlert('error', response.message));
                        setTimeout(function () {
                            modal.modal('hide');
                        }, 500);
                    }
                },
                onError: function (data) {
                    var msg = void 0;
                    // error handling
                    switch (data.status) {
                        case 500:
                            msg = _this.renderAlert('error', { serverError: { message: "An error occurred on the server." } });
                            break;
                        default:
                            msg = _this.renderAlert('error', data.responseJSON);
                            break;
                    }
                    if (data.status != 422) {
                        // display errors
                        var el = $('#' + notification);
                        el.html(msg);
                    }
                }
            }, options));
        }
    }

    var modal = function () {
        function modal(options) {
            _classCallCheck(this, modal);

            var defaultOptions = {};
            this.options = $.extend({}, defaultOptions, options || {});
        }

        /**
         * Show a modal dialog dynamically
         */
        _createClass(modal, [{
            key: 'show',
            value: function show() {
                $('.show_modal_form').on('click', function (e) {
                    e.preventDefault();
                    var btn = $(this);
                    var btnHtml = btn.html();
                    var modalDialog = $('#bootstrap_modal');
                    var modalSize = btn.data('modal-size');

                    if (!showConfirmMessage(btn)) {
                        return;
                    }

                    // show spinner as soon as user click is triggered
                    btn.attr('disabled', 'disabled').addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;loading');

                    // load the modal into the container put on the html
                    $('.modal-content').load($(this).attr('href') || $(this).data('href'), function (response, status, xhr) {
                        // check authenication
                        if (status == 'error' && xhr.status == 401) {
                            let res = JSON.parse(response);
                            location.href = res.redirect;
                        }
                        // show the modal
                        $('#bootstrap_modal').modal({ show: true });
                        $('.modal-content').parent('div').addClass('modal-dialog-centered');
                        // alter size
                        if (modalSize) {
                            $('.modal-content').parent('div').addClass(modalSize);
                        }
                    });

                    // revert button to original content, once the modal is shown
                    modalDialog.on('shown.bs.modal', function (e) {
                        $(btn).html(btnHtml).removeAttr('disabled').removeClass('disabled');
                    });

                    // destroy the modal
                    modalDialog.on('hidden.bs.modal', function (e) {
                        $(this).modal('dispose');
                        $('.modal-content').html('')
                    });
                });
            }
        }]);

        return modal;
    }();

    $('#bootstrap_modal').off('click', '#modal_form button[type="submit"]').on('click', '#modal_form button[type="submit"]', function (e) {
        e.preventDefault();
        // process forms on the modal
        _grids.formUtils.handleFormSubmission('modal_form', $('#bootstrap_modal'));
    });

    /**
     * The global modal object
     *
     * @type object
     * @public
     */
    _grids.modal = {
        init: function (options) {
            var obj = new modal(options);
            obj.show();
        }
    };

    /**
   * Initialize stuff
   */
    _grids.init = function () {
        // date picker
        if (typeof daterangepicker !== 'function') {
            console.warn('date picker option requires https://github.com/dangrossman/bootstrap-daterangepicker.git');
        } else {
            var element = $('.grid-datepicker');
            element.daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                minYear: 1901,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            element.on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            element.on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        }
        // initialize modal js
        _grids.modal.init({});
        // table links
        _grids.utils.tableLinks({ element: '.linkable', navigationDelay: 100 });
        // setup ajax listeners
        _grids.utils.handleAjaxRequest($('.data-remote'), 'click', {});
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').addClass('active');
        } else {
            $('.back-to-top').removeClass('active');
        }
    });
    if (!$('#navbarNavDropdown').hasClass('show')) {
        $('.main-content').removeClass('col-md-9');
    }

    $('.back-to-top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1500);
        return false;
    });

    $('#navbarNavDropdown').on('show.bs.collapse', function() {
        $('.main-content').addClass('col-md-9')
    }).on('hidden.bs.collapse', function() {
        if (!$(this).hasClass('show')) {
            $('.main-content').removeClass('col-md-9')
        }
    });

    $('.btn-download').click(function(e) {
        e.preventDefault();
        let filePath = $(this).data('file');
        downloadFilePath(filePath);
    });

    return _grids;
})(jQuery);
