'use strict';

import './selector-element';
import pjax from './pjax';
import ScrollPage from '../vnnit-coreui/js/scroll-page';
import { Api, Toastr, UtilBase } from './utils';
import { getElement, onDOMContentLoaded } from 'bootstrap/js/src/util';
import { merge } from 'lodash';

onDOMContentLoaded(() => {
  ScrollPage.render()
});

window.Toastr = Toastr;
window.UtilBase = UtilBase;
window.Api = Api;
window.onDOMContentLoaded = onDOMContentLoaded
window.getElement = getElement
window.pjax = pjax
Object.prototype.merge = merge
