'use strict';

import {getElement, onDOMContentLoaded} from '@coreui/coreui-pro/js/src/util/index';
import EventHandler from '@coreui/coreui-pro/js/src/dom/event-handler';
import ScrollPage from '../vnnit-coreui/js/scroll-page';
import {Api, UtilBase} from './utils';
import Swiper from 'swiper';
import {Pagination, Autoplay} from 'swiper/modules';

onDOMContentLoaded(() => {
  const forms = getElement('.needs-validation');
  if (forms) {
    forms.setAttribute('novalidate', true);
    EventHandler.on(forms, 'submit', event => {
      forms.classList.add('was-validated');
      event.preventDefault();
      UtilBase.clearFormValidationErrors();
      if (!forms.checkValidity()) {
        event.stopPropagation();
      } else {
        const loading = forms.querySelector('.loading');
        Api.post(forms.action, Object.fromEntries(new FormData(forms)), {
          beforeSend: () => {
            loading.show();
          },
          onSuccess: () => {
            loading.hide();
          },
          onError: (errs) => {
            loading.hide();
            if (errs) {
              let err = UtilBase.genarateValidationErrors(errs);
              forms.querySelector('.error-message').html('<ul>' + err + '</ul>').show();
            }
          }
        });
      }
    });
  }

  ScrollPage.render();

  const swiper = new Swiper('.mySwiper', {
    modules: [Pagination, Autoplay],
    slidesPerView: 1,
    spaceBetween: 15,
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false
    },
    breakpoints: {
      768: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      }
    }
  });
});
