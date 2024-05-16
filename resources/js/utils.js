'use strict';

import {getElement} from '@coreui/coreui-pro/js/src/util/index';
import CloseButton from '../vnnit-coreui/js/close-button';
import {get, has, isNil, forIn, map, forEach, isElement} from 'lodash';
import './selector-element';

const isVisibleElement = (element) => {
  return isElement(element) ? (element.offsetWidth > 0 || element.offsetHeight > 0) : false;
};

const Toastr = {
  renderTitle: function (title) {
    const titleToast = document.createElement('strong');
    titleToast.classList.add('me-auto');
    titleToast.textContent = title;
    return titleToast;
  },
  renderHeader: function (title, color, icon) {
    // Create the icon element
    const iconHeader = document.createElement('i');
    iconHeader.classList.add('bi', icon);

    // Create the image element
    const imgHeader = document.createElement('span');
    imgHeader.classList.add('rounded', 'me-2', 'mb-0', 'h5', 'text-' + color);
    imgHeader.appendChild(iconHeader);

    // Create the toast header element
    const toastHeader = document.createElement('div');
    toastHeader.classList.add('toast-header');

    // Create the close button element
    const btnClose = new CloseButton({name: 'toast', className: ['ms-2', 'mb-1']});

    // Append the image element, title element, and close button element to the toast header element
    toastHeader.appendChild(imgHeader);
    toastHeader.appendChild(this.renderTitle(title));
    toastHeader.appendChild(btnClose.getElement());

    return toastHeader;
  },
  renderBody: function (content) {
    const bodyToast = document.createElement('div');
    bodyToast.classList.add('toast-body');
    bodyToast.innerHTML = content;
    return bodyToast;
  },
  render: function (title, content, color, icon) {
    const toast = document.createElement('div');
    toast.classList.add('toast');
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    toast.setAttribute('data-coreui-delay', 5000);

    toast.appendChild(this.renderHeader(title, color, icon));
    toast.appendChild(this.renderBody(content));

    if (!document.body.querySelector('.toast-container')) {
      const toastContainer = document.createElement('div');
      toastContainer.classList.add('toast-container', 'position-fixed', 'top-0', 'end-0', 'p-3');
    }

    const popupToast = getElement('.toast-container');
    popupToast.appendChild(toast);
    return toast;
  },
  showSuccess: function (title, content) {
    const toast = new bootstrap.Toast(this.render(title, content, 'success', 'bi-check-circle-fill'));
    return toast.show();
  },
  showError: function (title, content) {
    const toast = new bootstrap.Toast(this.render(title, content, 'success', 'bi-x-circle-fill'));
    return toast.show();
  }
};

const UtilBase = {
  getProgressButton: function (target, success) {
    if (target) {
      const targetElement = getElement(target);
      const loadingText = targetElement.data('loading') || 'Loading'
      const btnTarget = targetElement.data('text') || targetElement.html();

      if (success) {
        targetElement.data('text', btnTarget);
        targetElement.attr('disabled', 'disabled').addClass('disabled').html('<i class="spinner-border spinner-border-sm"></i>&nbsp;' + loadingText);
      } else {
        targetElement.html(btnTarget).removeAttr('disabled').removeClass('disabled');
      }
    }
  },
  genarateValidationErrors: function (response) {
    let listErr = response.errors || response.validation || {}
    let errorsHtml = this.getValidationErrors(listErr);
    this.showFormValidationErrors(listErr);
    return errorsHtml;
  },
  getValidationErrors: function (response) {
    var errorsHtml = '';
    forEach(response, function (value, key) {
      if (Array.isArray(value)) {
        errorsHtml += map(value, function (item) {
          return '<li>' + item + '</li>'
        }).join('');
      }
      else
        errorsHtml += '<li>' + value + '</li>';
    });
    return errorsHtml;
  },
  showFormValidationErrors: function (response) {
    this.clearFormValidationErrors();
    forEach(response, function (value, key) {
      const elementSelector = getElement('[name="' + key + '"]');
      if (elementSelector) {
        const form = get(elementSelector.parents('form'), 0);
        if (form) {
          form.classList.add('was-validated');
          const element = form.findOne('[name="' + key + '"]');
          if (element && isVisibleElement(element)) {
            const elementTarget = element.tagName == 'INPUT' ? element : (element.findOne('input') || element.findOne('select'));
            if (isVisibleElement(elementTarget)) {
              elementTarget.setCustomValidity(value);
              element.addClass('is-invalid');
              element.next().html(value);
            }
          }
        }
      }
    });
  },
  clearFormValidationErrors: function () {
    const formValid = getElement('.needs-validation');
    if (formValid) {
      forEach(formValid.querySelectorAll('.form-control'), function(item, key) {
        item.removeClass('is-invalid');
        item.next().html('');
        if (item.tagName == 'INPUT' || item.tagName == 'SELECT')
          item.setCustomValidity('')
      });
    }
  }
};

const Api = {
  _callApi: async function (apiMethod, apiUrl, apiData, options) {
    let apiHeaders = get(options, 'headers', {});
    let apiResponseType = get(options, 'responseType', 'json');
    let targetLoading = get(options, 'targetLoading', null);
    if (has(options, 'beforeSend')) {
      options.beforeSend.call(this);
    }
    if (targetLoading) {
      UtilBase.getProgressButton(targetLoading, true);
    }

    await window.axios.request({
      method: apiMethod,
      url: apiUrl,
      data: apiData,
      responseType: apiResponseType,
      headers: apiHeaders,
    }).then(async (response) => {
      const {data, status} = await response;
      UtilBase.clearFormValidationErrors();
      UtilBase.getProgressButton(targetLoading, false);
      if (has(options, 'onSuccess')) {
        options.onSuccess.call(this, data);
      } else {
        if (has(options, 'pjaxContainer') && !isNil(options.pjaxContainer)) {
          pjax.reload({ container: options.pjaxContainer });
        }
        if (typeof Toastr !== 'undefined') {
          if (get(response.data, 'success')) {
            Toastr.showSuccess('Message', '<p>' + get(response.data, 'message') + '</p>');
          }
        }
      }
    }).catch(async (err) => {
      const {data, status} = await err.response;
      UtilBase.getProgressButton(targetLoading, false);
      if (has(options, 'onError')) {
        options.onError.call(this, {...data, status});
      } else {
        if (typeof Toastr !== 'undefined') {
          let err = UtilBase.genarateValidationErrors(data);
          Toastr.showError('Message', '<ul>' + err + '</ul>');
        } else {
          alert('An error occurred');
        }
      }
    });
  },
  get: function (url, params, options) {
    if (url == '') return;
    const urlParse = new URL(url);
    params = params || {};
    forIn(Object.entries(params), function (value, key) {
      urlParse.searchParams.append(key, value);
    });

    this._callApi('GET', urlParse.toString(), null, options)
  },
  post: function (url, data, options) {
    if (url == '') return;
    this._callApi('POST', url, data, options);
  },
  put: function (url, data, options) {
    if (url == '') return;
    this._callApi('PUT', url, data, options);
  },
  delete: function (url, data, options) {
    if (url == '') return;
    this._callApi('DELETE', url, data, options);
  }
};

export {Toastr, UtilBase, Api}
