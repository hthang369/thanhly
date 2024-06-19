import {has, set, isNil, isString, forEach, get, isPlainObject, zipObject, isElement, isFunction} from 'lodash';
import EventHandler from '@coreui/coreui-pro/js/src/dom/event-handler';
import SelectorEngine from '@coreui/coreui-pro/js/src/dom/selector-engine';

const SelectorElement = {
  attr: function (key, value = null) {
    if (isNil(value))
      return this.getAttribute(key);

    this.setAttribute(key, value);
    return this;
  },
  hasAttr: function (key) {
    return this.hasAttribute(key);
  },
  removeAttr: function (key) {
    this.removeAttribute(key);
    return this;
  },
  addClass: function () {
    this.classList.add(...arguments);
    return this;
  },
  removeClass: function (name) {
    this.classList.remove(name);
    return this;
  },
  toggleClass: function (name) {
    this.classList.toggle(name);
    return this;
  },
  data: function (key, value = null) {
    return this.attr(`data-${key}`, value);
  },
  removeData: function (key) {
    return this.removeAttr(`data-${key}`);
  },
  on: function (event, handle, callback) {
    EventHandler.on(this, event, handle, callback);
  },
  off: function (event, handle, callback) {
    EventHandler.off(this, event, handle, callback);
  },
  wrap: function (html) {
    const domHtml = new DOMParser().parseFromString(html, 'text/html');
    const wrapElement = domHtml.body.firstChild;
    this.parentElement.insertBefore(wrapElement, this);
    wrapElement.appendChild(this);
  },
  parents: function (selector) {
    return SelectorEngine.parents(this, selector);
  },
  clone: function () {
    return this.cloneNode(true);
  },
  show: function () {
    this.style.display = 'block';
    return this;
  },
  hide: function () {
    this.style.display = 'none';
    return this;
  },
  parent: function () {
    return this.parentElement;
  },
  css: function (key, value = null) {
    if (isString(key) && isNil(value))
      return get(this.style, key);
    else {
      const pairs = isPlainObject(key) ? key : zipObject([key], [value]);
      forEach(pairs, function (oVal, oKey) {
        set(this.style, oKey, oVal);
      });
      return this;
    }
  },
  find: function (key) {
    return SelectorEngine.find(key, this || document.documentElement);
  },
  findOne: function (key) {
    return SelectorEngine.findOne(key, this || document.documentElement);
  },
  html: function (content = null) {
    if (isNil(content)) return this.innerHTML;
    if (isString(content)) {
      this.innerHTML = content;
    } else if (Array.isArray(content)) {
      this.innerHTML = content.join('<br/>');
    } else {
      this.insertBefore(content, null);
    }
    return this;
  },
  text: function (content = null) {
    if (isNil(content)) return this.innerText;
    this.innerText = content;
    return this;
  },
  append: function (elementNode) {
    if (isElement(elementNode)) {
      this.appendChild(elementNode);
    }
    return this;
  },
  next: function () {
    return this.nextElementSibling;
  },
  load: function(url, callback) {
    fetch(url).then(response => {
      if (response.ok) {
        return response.text()
      }
    }).then(body => {
      this.html(body)
      if (isFunction(callback)) {
        callback()
      }
    })
  },
  modal: function(options) {
    return new bootstrap.default.Modal(this, options)
  }
};
HTMLFormElement.prototype.serializeObject = function () {
  const frmData = new FormData(this);
  let obj = {};
  for (let [key, value] of frmData) {
    if (obj[key]) {
      if (!Array.isArray(obj[key])) {
        obj[key] = [obj[key]];
      }
      obj[key].push(value);
    } else {
      obj[key] = value;
    }
  }
  return obj;
};
for (let [funcName, func] of Object.entries(SelectorElement)) {
  if (!has(HTMLElement.prototype, funcName)) {
    set(HTMLElement.prototype, funcName, func);
  }
}
