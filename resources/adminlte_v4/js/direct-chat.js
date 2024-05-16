/**
 * --------------------------------------------
 * @file AdminLTE direct-chat.ts
 * @description Direct chat for AdminLTE.
 * @license MIT
 * --------------------------------------------
 */

import {
  onDOMContentLoaded
} from './util/index'

import BaseComponent from 'bootstrap/js/src/base-component'

/**
 * Constants
 * ====================================================
 */

const NAME = 'direct-chat'
const DATA_KEY = 'lte.direct-chat'
const EVENT_KEY = `.${DATA_KEY}`
const EVENT_EXPANDED = `expanded${EVENT_KEY}`
const EVENT_COLLAPSED = `collapsed${EVENT_KEY}`

const SELECTOR_DATA_TOGGLE = '[data-lte-toggle="chat-pane"]'
const SELECTOR_DIRECT_CHAT = '.direct-chat'

const CLASS_NAME_DIRECT_CHAT_OPEN = 'direct-chat-contacts-open'

/**
 * Class Definition
 * ====================================================
 */

class DirectChat extends BaseComponent {
  constructor(element) {
    super(element)
  }

  static get NAME() {
    return NAME
  }

  toggle() {
    if (this._element.classList.contains(CLASS_NAME_DIRECT_CHAT_OPEN)) {
      const event = new Event(EVENT_COLLAPSED)

      this._element.classList.remove(CLASS_NAME_DIRECT_CHAT_OPEN)

      this._element.dispatchEvent(event)
    } else {
      const event = new Event(EVENT_EXPANDED)

      this._element.classList.add(CLASS_NAME_DIRECT_CHAT_OPEN)

      this._element.dispatchEvent(event)
    }
  }
}

/**
 *
 * Data Api implementation
 * ====================================================
 */

onDOMContentLoaded(() => {
  const button = document.querySelectorAll(SELECTOR_DATA_TOGGLE)

  button.forEach(btn => {
    btn.addEventListener('click', event => {
      event.preventDefault()
      const target = event.target
      const chatPane = target.closest(SELECTOR_DIRECT_CHAT)

      if (chatPane) {
        const data = new DirectChat(chatPane)
        data.toggle()
      }
    })
  })
})

export default DirectChat
