/**
 * --------------------------------------------
 * @file AdminLTE layout.ts
 * @description Layout for AdminLTE.
 * @license MIT
 * --------------------------------------------
 */

import {
  onDOMContentLoaded
} from './util/index'

import BaseComponent from 'bootstrap/js/src/base-component'

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */
const NAME = 'layout'
const CLASS_NAME_HOLD_TRANSITIONS = 'hold-transition'
const CLASS_NAME_APP_LOADED = 'app-loaded'
const SELECTOR_PRELOADER = '.preloader'

/**
 * Class Definition
 * ====================================================
 */

class Layout extends BaseComponent {
  constructor(element) {
    super(element)
  }

  static get NAME() {
    return NAME
  }

  holdTransition() {
    let resizeTimer
    window.addEventListener('resize', () => {
      document.body.classList.add(CLASS_NAME_HOLD_TRANSITIONS)
      clearTimeout(resizeTimer)
      resizeTimer = setTimeout(() => {
        document.body.classList.remove(CLASS_NAME_HOLD_TRANSITIONS)
      }, 400)
    })
  }
}

onDOMContentLoaded(() => {
  const data = new Layout(document.body)
  data.holdTransition()
  setTimeout(() => {
    document.body.classList.add(CLASS_NAME_APP_LOADED)
  }, 400)

  setTimeout(() => {
    const preloader = document.body.querySelector(SELECTOR_PRELOADER)
    if (preloader) {
      preloader.style.display = 'none'
    }
  }, 500)

})

export default Layout
