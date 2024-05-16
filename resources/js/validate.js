import Config from "bootstrap/js/src/util/config";
import EventHandler from 'bootstrap/js/src/dom/event-handler';
import { getElement } from "bootstrap/js/src/util";

const format = (source, params) => {
  if ( arguments.length === 1 ) {
		return function() {
			var args = Array.from( arguments );
			args.unshift( source );
			return format.apply( this, args );
		};
	}
	if ( params === undefined ) {
		return source;
	}
	if ( arguments.length > 2 && params.constructor !== Array  ) {
		params = Array.from( arguments ).slice( 1 );
	}
	if ( params.constructor !== Array ) {
		params = [ params ];
	}
	params.forEach(function( n, i ) {
		source = source.replace( new RegExp( "\\{" + i + "\\}", "g" ), function() {
			return n;
		} );
	} );
	return source;
};

const defaultOptions = {
  messages: {
    required: "This field is required.",
		remote: "Please fix this field.",
		email: "Please enter a valid email address.",
		url: "Please enter a valid URL.",
		date: "Please enter a valid date.",
		dateISO: "Please enter a valid date (ISO).",
		number: "Please enter a valid number.",
		digits: "Please enter only digits.",
		equalTo: "Please enter the same value again.",
		maxlength: format( "Please enter no more than {0} characters." ),
		minlength: format( "Please enter at least {0} characters." ),
		rangelength: format( "Please enter a value between {0} and {1} characters long." ),
		range: format( "Please enter a value between {0} and {1}." ),
		max: format( "Please enter a value less than or equal to {0}." ),
		min: format( "Please enter a value greater than or equal to {0}." ),
		step: format( "Please enter a multiple of {0}." )
  },
  groups: {},
  rules: {},
  errorClass: "error",
  pendingClass: "pending",
  validClass: "valid",
  errorElement: "label",
  focusCleanup: false,
  focusInvalid: true,
  errorContainer: $( [] ),
  errorLabelContainer: $( [] ),
  onsubmit: true,
  ignore: ":hidden",
  ignoreTitle: false,

};

class Validator extends Config {
  static get Default() {
    return defaultOptions;
  }

  static get DefaultType() {
    return {}
  }

  static get NAME() {
    return '';
  }

  init() {
    this.labelContainer = document.querySelector( this.settings.errorLabelContainer );
    this.errorContext = this.labelContainer.length && this.labelContainer || getElement( this.currentForm );
    this.containers = Array.from(document.querySelectorAll(this.settings.errorContainer + ', ' + this.settings.errorLabelContainer));
    this.submitted = {};
    this.valueCache = {};
    this.pendingRequest = 0;
    this.pending = {};
    this.invalid = {};

    let currentForm = getElement(this.currentForm),
		    groups = ( this.groups = {} ),
        rules;

    Object.entries(this.settings.groups).forEach(function([key, value]) {
      if (typeof value === "string") {
        value = value.split(/\s/);
      }
      value.forEach(function(name) {
        groups[name] = key;
      });
    });
    rules = this.settings.rules;
    Object.entries(rules).forEach(function([key, value]) {
        rules[key] = validatorNormalizeRule(value);
    });

    function delegate(event) {
      const isContentEditable = this.getAttribute('contenteditable') !== undefined
      // Set form expando on contenteditable
      if ( !this.form && isContentEditable ) {
        this.form = document.querySelector('form').closest('form')[0];
        this.name = this.getAttribute('name');
      }

      // Ignore the element if it belongs to another form. This will happen mainly
      // when setting the `form` attribute of an input to the id of another form.
      if ( currentForm !== this.form ) {
        return;
      }
      const validator = this.form.dataset.validator;
      const eventType = `on${event.type.replace(/^validate/, '')}`;
      const settings = validator.settings;
      if (settings[eventType] && !this.is(settings.ignore)) {
        settings[eventType].call(validator, this, event);
      }
    }

    EventHandler.on(currentForm, 'focusin.validate focusout.validate keyup.validate',
      'input:text, input[type="password"], input[type="file"], select, textarea, input[type="number"], input[type="search"], input[type="tel"], input[type="url"], input[type="email"], input[type="datetime"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime-local"], input[type="range"], input[type="color"], input[type="radio"], input[type="checkbox"], [contenteditable], input[type="button"]',
      delegate);

    EventHandler.on(currentForm, 'click.validate', 'select, option, input[type="radio"], input[type="checkbox"]', delegate);

    if (this.settings.invalidHandler) {
      EventHandler.on(currentForm, 'invalid-form.validate', this.settings.invalidHandler);
    }
  }
  form() {
    this.checkForm();
    // Extend submitted and invalid objects with errorMap
    Object.assign(this.submitted, this.errorMap);
    this.invalid = Object.assign({}, this.errorMap);

    // Trigger invalid-form event if not valid
    if (!this.valid()) {
      this.currentForm.dispatchEvent(new CustomEvent('invalid-form', { detail: [this] }));
    }
    this.showErrors();
    return this.valid();
  }
  checkForm() {
    this.prepareForm();
    for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
      this.check(elements[i]);
    }
    return this.valid();
  }
  prepareForm() {

  }
  check(element) {
    element = this.validationTargetFor(this.clean(element));
  }
  clean(selector) {
    return selector[0];
  }
  elements() {
    // Get all input elements (except submit, reset, image, and disabled)
    return this.currentForm.querySelectorAll(
      'input, select, textarea, [contenteditable]'
    ).filter(element => {
      // Exclude specific types and disabled elements
      if (element.matches(":submit, :reset, :image, :disabled")) return false;

      // Check if element matches the ignore list
      if (this.settings.ignore && element.matches(this.settings.ignore)) return false;

      // Handle contenteditable elements
      const name = element.name || element.getAttribute("name");
      const isContentEditable = element.getAttribute("contenteditable") !== undefined && element.getAttribute("contenteditable") !== "false";

      if (!name && this.settings.debug && console) {
        console.error("%o has no name assigned", element);
      }

      if (isContentEditable) {
        element.form = element.closest("form")[0];
        element.name = name;
      }

      // Ignore elements from different forms
      if (element.form !== this.currentForm) return false;

      // Skip elements with no rules or already cached
      if (!(name in rulesCache) || Object.keys(element.rules()).length === 0) return false;

      rulesCache[name] = true;
      return true;
    });
  }
  showErrors() {
    if (errors) {
      // Extend errorMap and build errorList
      Object.assign(this.errorMap, errors);
      this.errorList = Object.entries(this.errorMap).map(([name, message]) => ({
        message,
        element: this.findByName(name)[0],
      }));

      // Filter successList to exclude elements with errors
      this.successList = this.successList.filter(element => !(element.name in errors));
    }
    // Show errors using settings or default method
    if ( this.settings.showErrors ) {
      this.settings.showErrors.call( this, this.errorMap, this.errorList );
    } else {
      this.defaultShowErrors();
    }
  }
  valid() {
    return this.size() === 0;
  }
  size() {
    return this.errorList.length;
  }
  defaultShowErrors() {
    let i, elements, error;
    for (i = 0; this.errorList[i]; i++) {
      error = this.errorList[i];

      if (this.settings.highlight) {
        this.settings.highlight.call(this, error.element, this.settings.errorClass, this.settings.validClass);
      }

      this.showLabel(error.element, error.message);
    }
    if (this.errorList.length) {
      this.toShow = this.toShow.concat(Array.from(this.containers));
    }
    if (this.settings.success) {
      for (i = 0; this.successList[i]; i++) {
        this.showLabel(this.successList[i]);
      }
    }
    if (this.settings.unhighlight) {
      elements = this.validElements();

      for (i = 0; elements[i]; i++) {
        this.settings.unhighlight.call(this, elements[i], this.settings.errorClass, this.settings.validClass);
      }
    }
    this.toHide = this.toHide.filter(el => !this.toShow.includes(el));
    this.hideErrors();
    this.addWrapper( this.toShow ).show();
  }
  validationTargetFor(element) {
    // If radio/checkbox, validate first element in group instead
    if (this.checkable(element)) {
      element = this.findByName(element.name);
    }

    // Always apply ignore filter
    return document.querySelector(`${element}:not(${this.settings.ignore})`);
  }
  checkable(element) {
    return (/radio|checkbox/i).test(element.type);
  }
  findByName(name) {
    return this.currentForm.querySelector(`[name="${this.escapeCssMeta(name)}"]`)
  }
  escapeCssMeta(string) {
    if (string === undefined) {
      return "";
    }

    return string.replace(/([\\!"#$%&'()*+,./:;<=>?@\[\]^`{|}~])/g, "\\$1");
  }
  showLabel(element, message) {
    let place, group, errorID, v;
    const error = this.errorsFor(element);
    const elementID = this.idOrName(element);
    const describedBy = element.getAttribute("aria-describedby");
    if (error.length) {
      // Refresh error/success class
      error.classList.remove(this.settings.validClass);
      error.classList.add(this.settings.errorClass);

      // Replace message on existing label
      if (this.settings && this.settings.escapeHtml) {
        error.textContent = message || '';
      } else {
        error.innerHTML = message || '';
      }
    } else {
      // Create new error element
      error = document.createElement(this.settings.errorElement);
      error.id = `${elementID}-error`;
      error.classList.add(this.settings.errorClass);

      if (this.settings && this.settings.escapeHtml) {
        error.textContent = message || '';
      } else {
        error.innerHTML = message || '';
      }

      // Maintain reference to the element to be placed into the DOM
      place = error;
      if (this.settings.wrapper) {
        // Make sure the element is visible, even in IE
        // actually showing the wrapped element is handled elsewhere
        error.style.display = "none";
        error.style.display = "block";
        place = this.wrap(error, this.settings.wrapper).parentElement;
      }
      if (this.labelContainer.length) {
        this.labelContainer.appendChild(place);
      } else if (this.settings.errorPlacement) {
        this.settings.errorPlacement.call(this, place, element);
      } else {
        element.parentNode.insertBefore(place, element.nextSibling);
      }
      // Link error back to the element
      if (error.tagName.toLowerCase() === 'label') {
        // If the error is a label, then associate using 'for'
        error.setAttribute("for", elementID);
      } else if (!error.closest(`label[for="${this.escapeCssMeta(elementID)}"]`)) {
        errorID = error.id;
        // Respect existing non-error aria-describedby
        if (!describedBy) {
          describedBy = errorID;
        } else if (!describedBy.match(new RegExp("\\b" + this.escapeCssMeta(errorID) + "\\b"))) {
          // Add to end of list if not already present
          describedBy += " " + errorID;
        }
        element.setAttribute("aria-describedby", describedBy);

        // If this element is grouped, then assign to all elements in the same group
        group = this.groups[element.name];
        if (group) {
          v = this;
          Object.entries(v.groups).forEach(([name, testgroup]) => {
            if (testgroup === group) {
              const elementsInGroup = document.querySelectorAll(`[name='${v.escapeCssMeta(name)}']`);
              elementsInGroup.forEach((el) => {
                el.setAttribute("aria-describedby", error.id);
              });
            }
          });
        }
      }
    }
    if (!message && this.settings.success) {
      error.textContent = "";
      if (typeof this.settings.success === "string") {
        error.classList.add(this.settings.success);
      } else {
        this.settings.success(error, element);
      }
    }
    this.toShow.push(error);
  }
  validElements() {
    return this.currentElements.filter(el => !this.invalidElements().includes(el));
  }
  invalidElements() {
    return this.errorList.map(error => error.element);
  }
  hideErrors() {

  }
  addWrapper() {

  }
  wrap(target, element) {
    const wrapElement = document.createElement(element);
    target.parentElement.insertBefore(wrapElement, target);
    wrapElement.appendChild(target);
    return wrapElement;
  }
  errorsFor(element) {
    const name = this.escapeCssMeta(this.idOrName(element));
    const describer = element.getAttribute('aria-describedby');
    const selector = `label[for="${name}"], label[for="${name}"] *`;
    // 'aria-describedby' should directly reference the error element
    if ( describer ) {
      selector = `${selector}, #${this.escapeCssMeta(describer)}`.replace(/\s+/g, ", #");
    }

    return this.errors().filter(err => err.matches(selector));
  }
  idOrName(element) {
    return this.groups[element.name] || (this.checkable(element) ? element.name : element.id || element.name);
  }
  escapeCssMeta(string) {
    if (string === undefined) {
      return "";
    }

    return string.replace( /([\\!"#$%&'()*+,./:;<=>?@\[\]^`{|}~])/g, "\\$1" );
  }
}
