/**
 * --------------------------------------------
 * @file AdminLTE fullscreen.ts
 * @description Fullscreen plugin for AdminLTE.
 * @license MIT
 * --------------------------------------------
 */

import {
  onDOMContentLoaded
} from './util/index'

import BaseComponent from 'bootstrap/js/src/base-component'

/**
 * Constants
 * ============================================================================
 */
const NAME = 'fullscreen'
const DATA_KEY = 'lte.fullscreen'
const EVENT_KEY = `.${DATA_KEY}`
const EVENT_MAXIMIZED = `maximized${EVENT_KEY}`
const EVENT_MINIMIZED = `minimized${EVENT_KEY}`

const SELECTOR_FULLSCREEN_TOGGLE = '[data-lte-toggle="fullscreen"]'
const SELECTOR_MAXIMIZE_ICON = '[data-lte-icon="maximize"]'
const SELECTOR_MINIMIZE_ICON = '[data-lte-icon="minimize"]'

/**
 * Class Definition.
 * ============================================================================
 */
class FullScreen extends BaseComponent {
  constructor(element, config) {
    super(element, config)
  }

  static get NAME() {
    return NAME
  }

  inFullScreen() {
    const event = new Event(EVENT_MAXIMIZED)

    const iconMaximize = document.querySelector<HTMLElement>(SELECTOR_MAXIMIZE_ICON)
    const iconMinimize = document.querySelector<HTMLElement>(SELECTOR_MINIMIZE_ICON)

    void document.documentElement.requestFullscreen()

    if (iconMaximize) {
      iconMaximize.style.display = 'none'
    }

    if (iconMinimize) {
      iconMinimize.style.display = 'block'
    }

    this._element.dispatchEvent(event)
  }

  outFullscreen() {
    const event = new Event(EVENT_MINIMIZED)

    const iconMaximize = document.querySelector<HTMLElement>(SELECTOR_MAXIMIZE_ICON)
    const iconMinimize = document.querySelector<HTMLElement>(SELECTOR_MINIMIZE_ICON)

    void document.exitFullscreen()

    if (iconMaximize) {
      iconMaximize.style.display = 'block'
    }

    if (iconMinimize) {
      iconMinimize.style.display = 'none'
    }

    this._element.dispatchEvent(event)
  }

  toggleFullScreen() {
    if (document.fullscreenEnabled) {
      if (document.fullscreenElement) {
        this.outFullscreen()
      } else {
        this.inFullScreen()
      }
    }
  }
}

/**
 * Data Api implementation
 * ============================================================================
 */
onDOMContentLoaded(() => {
  const buttons = document.querySelectorAll(SELECTOR_FULLSCREEN_TOGGLE)

  buttons.forEach(btn => {
    btn.addEventListener('click', event => {
      event.preventDefault()

      const target = event.target
      const button = target.closest(SELECTOR_FULLSCREEN_TOGGLE)

      if (button) {
        const data = new FullScreen(button, undefined)
        data.toggleFullScreen()
      }
    })
  })
})

export default FullScreen
