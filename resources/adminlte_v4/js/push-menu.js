/**
 * --------------------------------------------
 * @file AdminLTE push-menu.ts
 * @description Push menu for AdminLTE.
 * @license MIT
 * --------------------------------------------
 */

import {
  onDOMContentLoaded
} from './util/index'

import BaseComponent from 'bootstrap/js/src/base-component'

import { OverlayScrollbars } from 'overlayscrollbars'

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */
const NAME = 'push-menu'
const DATA_KEY = 'lte.push-menu'
const EVENT_KEY = `.${DATA_KEY}`

const EVENT_OPEN = `open${EVENT_KEY}`
const EVENT_COLLAPSE = `collapse${EVENT_KEY}`

const CLASS_NAME_SIDEBAR_MINI = 'sidebar-mini'
const CLASS_NAME_SIDEBAR_COLLAPSE = 'sidebar-collapse'
const CLASS_NAME_SIDEBAR_OPEN = 'sidebar-open'
const CLASS_NAME_SIDEBAR_EXPAND = 'sidebar-expand'
const CLASS_NAME_SIDEBAR_OVERLAY = 'sidebar-overlay'
const CLASS_NAME_MENU_OPEN = 'menu-open'

const SELECTOR_APP_SIDEBAR = '.app-sidebar'
const SELECTOR_SIDEBAR_MENU = '.sidebar-menu'
const SELECTOR_NAV_ITEM = '.nav-item'
const SELECTOR_NAV_TREEVIEW = '.nav-treeview'
const SELECTOR_APP_WRAPPER = '.app-wrapper'
const SELECTOR_SIDEBAR_EXPAND = `[class*="${CLASS_NAME_SIDEBAR_EXPAND}"]`
const SELECTOR_SIDEBAR_TOGGLE = '[data-lte-toggle="sidebar"]'
const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";

const DefaultType = {
  sidebarBreakpoint: 'number'
}

const Default = {
  sidebarBreakpoint: 992,
  scrollbarTheme: "os-theme-light",
  scrollbarAutoHide: "leave",
  scrollbarClickScroll: false,
}

/**
 * Class Definition
 * ====================================================
 */

class PushMenu extends BaseComponent {
  constructor(element, config) {
    super(element, config)
  }

  static get Default() {
    return Default
  }

  static get DefaultType() {
    return DefaultType
  }

  static get NAME() {
    return NAME
  }

  // TODO
  menusClose() {
    const navTreeview = document.querySelectorAll<HTMLElement>(SELECTOR_NAV_TREEVIEW)

    navTreeview.forEach(navTree => {
      navTree.style.removeProperty('display')
      navTree.style.removeProperty('height')
    })

    const navSidebar = document.querySelector(SELECTOR_SIDEBAR_MENU)
    const navItem = navSidebar?.querySelectorAll(SELECTOR_NAV_ITEM)

    if (navItem) {
      navItem.forEach(navI => {
        navI.classList.remove(CLASS_NAME_MENU_OPEN)
      })
    }
  }

  expand() {
    const event = new Event(EVENT_OPEN)

    document.body.classList.remove(CLASS_NAME_SIDEBAR_COLLAPSE)
    document.body.classList.add(CLASS_NAME_SIDEBAR_OPEN)

    this._element.dispatchEvent(event)
  }

  collapse() {
    const event = new Event(EVENT_COLLAPSE)

    document.body.classList.remove(CLASS_NAME_SIDEBAR_OPEN)
    document.body.classList.add(CLASS_NAME_SIDEBAR_COLLAPSE)

    this._element.dispatchEvent(event)
  }

  addSidebarBreakPoint() {
    const sidebarExpandList = document.querySelector(SELECTOR_SIDEBAR_EXPAND)?.classList ?? []
    const sidebarExpand = Array.from(sidebarExpandList).find(className => className.startsWith(CLASS_NAME_SIDEBAR_EXPAND)) ?? ''
    const sidebar = document.getElementsByClassName(sidebarExpand)[0]
    const sidebarContent = window.getComputedStyle(sidebar, '::before').getPropertyValue('content')
    this._config = { ...this._config, sidebarBreakpoint: Number(sidebarContent.replace(/[^\d.-]/g, '')) }

    if (window.innerWidth <= this._config.sidebarBreakpoint) {
      this.collapse()
    } else {
      if (!document.body.classList.contains(CLASS_NAME_SIDEBAR_MINI)) {
        this.expand()
      }

      if (document.body.classList.contains(CLASS_NAME_SIDEBAR_MINI) && document.body.classList.contains(CLASS_NAME_SIDEBAR_COLLAPSE)) {
        this.collapse()
      }
    }
  }

  toggle() {
    if (document.body.classList.contains(CLASS_NAME_SIDEBAR_COLLAPSE)) {
      this.expand()
    } else {
      this.collapse()
    }
  }

  init() {
    this.addSidebarBreakPoint()
  }
}

/**
 * ------------------------------------------------------------------------
 * Data Api implementation
 * ------------------------------------------------------------------------
 */

onDOMContentLoaded(() => {
  const sidebar = document?.querySelector(SELECTOR_APP_SIDEBAR)

  if (sidebar) {
    const data = new PushMenu(sidebar, Default)
    data.init()

    window.addEventListener('resize', () => {
      data.init()
    })
  }

  const sidebarOverlay = document.createElement('div')
  sidebarOverlay.className = CLASS_NAME_SIDEBAR_OVERLAY
  document.querySelector(SELECTOR_APP_WRAPPER)?.append(sidebarOverlay)

  sidebarOverlay.addEventListener('touchstart', event => {
    event.preventDefault()
    const target = event.currentTarget
    const data = new PushMenu(target, Default)
    data.collapse()
  })
  sidebarOverlay.addEventListener('click', event => {
    event.preventDefault()
    const target = event.currentTarget
    const data = new PushMenu(target, Default)
    data.collapse()
  })

  const fullBtn = document.querySelectorAll(SELECTOR_SIDEBAR_TOGGLE)

  fullBtn.forEach(btn => {
    btn.addEventListener('click', event => {
      event.preventDefault()

      let button = event.currentTarget

      if (button?.dataset.lteToggle !== 'sidebar') {
        button = button?.closest(SELECTOR_SIDEBAR_TOGGLE)
      }

      if (button) {
        event?.preventDefault()
        const data = new PushMenu(button, Default)
        data.toggle()
      }
    })
  })

  const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER)
  if (sidebarWrapper && OverlayScrollbars) {
    OverlayScrollbars(sidebarWrapper, {
      scrollbars: {
        theme: Default.scrollbarTheme,
        autoHide: Default.scrollbarAutoHide,
        clickScroll: Default.scrollbarClickScroll,
      }
    })
  }
})

export default PushMenu
