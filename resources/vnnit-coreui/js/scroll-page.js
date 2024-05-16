import EventHandler from "bootstrap/js/src/dom/event-handler";
import SelectorEngine from "bootstrap/js/src/dom/selector-engine";
import Config from "bootstrap/js/src/util/config";
import {uniq} from 'lodash';

const NAME = 'scroll-page';
const EVENT_KEY = 'click';

const defaultClass = ['position-fixed', 'scroll-page', 'd-flex', 'flex-column'];

const Default = {
  direction: 'both',
  iconTop: ['bi', 'bi-arrow-up-circle'],
  iconBottom: ['bi', 'bi-arrow-down-circle'],
  className: ''
};

const DefaultType = {
  direction: 'string',
  iconTop: '(array|string)',
  iconBottom: '(array|string)',
  className: 'string'
}

class ScrollPage extends Config {
  constructor(config) {
    super();
    this._config = this._getConfig(config)
    this._element = null;
    this._triggerEvents();
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

  _configAfterMerge(config) {
    defaultClass.push(config.className);
    config.classList = defaultClass;
    return config
  }

  static render(type = null, options = null) {
    const cfgOpts = options ?? {};
    cfgOpts.direction = type ?? 'both';
    return new ScrollPage(cfgOpts);
  }

  // Private
  _getElement() {
    if (!this._element) {
      const scrollPage = document.createElement('div');
      let className = this._config.className;
      if (className.length > 0) {
        if (!Array.isArray(className)) {
          className = className.split(' ');
        }
        this._config.classList.push(...uniq(className));
      }
      let lstClassName = this._config.classList.filter(item => {
        return item.length > 0;
      });

      scrollPage.classList.add(...lstClassName);
      switch (this._config.direction) {
        case 'top':
          this._renderScrollTop(scrollPage);
          break;
        case 'bottom':
          this._renderScrollBottom(scrollPage);
          break;
        default:
          this._renderScrollTop(scrollPage);
          this._renderScrollBottom(scrollPage);
          break;
      }

      document.body.appendChild(scrollPage);

      this._element = scrollPage;
    }

    return this._element;
  }

  _renderScrollTop(wrapper) {
    const scrollTop = document.createElement('a');
    scrollTop.classList.add('scroll-to-top', 'fade');
    scrollTop.appendChild(this._renderIcon('top'));
    if (wrapper) {
      wrapper.appendChild(scrollTop);
    }
    return scrollTop;
  }

  _renderScrollBottom(wrapper) {
    const scrollBottom = document.createElement('a');
    scrollBottom.classList.add('scroll-to-bottom', 'fade');
    scrollBottom.appendChild(this._renderIcon('bottom'));
    if (wrapper) {
      wrapper.appendChild(scrollBottom);
    }
    return scrollBottom;
  }

  _renderIcon(type) {
    const icon = document.createElement('i');
    let className = type === 'top' ? (this._config.iconTop) : (this._config.iconBottom);
    if (!Array.isArray(className)) {
      className = [className];
    }
    icon.classList.add(...className);
    return icon;
  }

  _getTransition(type) {
    const defaultOpts = {top: 0, behavior: 'auto'};
    if (this._config.isAnimate) {
      defaultOpts.behavior = 'smooth';
    }
    if (type === 'bottom') {
      defaultOpts.top = document.body.clientHeight;
    }
    return defaultOpts;
  }

  _triggerEvents() {
    const elementTop = this._triggerEventType('top');
    const elementBottom = this._triggerEventType('bottom');

    EventHandler.on(window, 'scroll', function (e) {
      if (document.scrollingElement.scrollTop > 100) {
        elementTop.classList.add('show');
        elementTop.classList.remove('hide');
        elementBottom.classList.add('show');
        elementBottom.classList.remove('hide');
        if (document.scrollingElement.scrollHeight - document.scrollingElement.scrollTop - document.scrollingElement.clientHeight <= 0) {
          elementBottom.classList.add('hide');
          elementBottom.classList.remove('show');
        }
      } else {
        elementTop.classList.add('hide');
        elementTop.classList.remove('show');
        elementBottom.classList.add('show');
        elementBottom.classList.remove('hide');
      }
    });
  }

  _triggerEventType(type) {
    const scrollPage = this._getElement();
    const scrollType = SelectorEngine.findOne(`.scroll-to-${type}`, scrollPage);
    const optsTransition = this._getTransition(type);

    EventHandler.on(scrollType, EVENT_KEY, function (e) {
      e.preventDefault();

      window.scrollTo(optsTransition);
    });

    return scrollType;
  }
}

export default ScrollPage;
