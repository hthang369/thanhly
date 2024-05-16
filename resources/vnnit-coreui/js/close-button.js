import Config from "bootstrap/js/src/util/config";
import Data from 'bootstrap/js/src/dom/data.js'
import {isString, uniqWith, isEmpty, isNil} from 'lodash';

const NAME = 'close-button';
const DATA_KEY = 'bs.close-button';
const defaultClass = 'btn-close'
const Default = {
  className: '',
  name: ''
};

const DefaultType = {
  className: '(string|array)',
  name: 'string'
}

class CloseButton extends Config {
  constructor(config) {
    super();
    this._config = this._getConfig(config);

    this._element = Data.get(this.DATA_KEY, this.DATA_KEY);
    if (!this._element) {
      const btnClose = this.render();
      Data.set(this.DATA_KEY, this.DATA_KEY, btnClose);
      this._element = btnClose;
    }
  }

  // Getters
  static get Default() {
    return Default;
  }

  static get DefaultType() {
    return DefaultType;
  }

  static get NAME() {
    return NAME;
  }

  static get DATA_KEY() {
    return `${DATA_KEY}.${this._config.name}`
  }

  getElement() {
    return this._element;
  }

  _configAfterMerge(config) {
    const classList = isString(config.className) ? config.className.split(' ') : [config.className];
    classList.push(defaultClass);
    config.className = uniqWith(classList, !isEmpty);
    return config;
  }

  render() {
    const btnClose = document.createElement('button');
    btnClose.classList.add(...this._config.className);
    btnClose.setAttribute('type', 'button');
    btnClose.setAttribute('aria-label', 'Close');
    if (!isNil(this._config.name)) {
      btnClose.setAttribute('data-bs-dismiss', this._config.name);
    }
    return btnClose;
  }
}

export default CloseButton;
