'use strict';

onDOMContentLoaded(() => {
  const lstGroup = document.querySelector('.list-group')
  if (lstGroup) {
    lstGroup.on('change', '.form-check-input', (e) => {
      window.parent.postMessage({
        mceAction: 'customAction',
        data: {
          path: e.target.data('path'),
          file_name: e.target.attr('id')
        }
      })
    })
  }

})
