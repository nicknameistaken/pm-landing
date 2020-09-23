"use strict";

require("core-js/stable");

require("regenerator-runtime/runtime");

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.onload = function () {
  // window.addEventListener("load", () => {
  var getByClass = function getByClass(className) {
    return document.querySelector(".".concat(className));
  };

  var currentWidth = window.innerWidth;
  var isDesktop = currentWidth >= 1140;
  var allInputs = document.querySelectorAll(".form__modal input, .form__modal textarea");
  var initFaqSection = getByClass("faq");
  var initLatest = 0;

  for (var point in initFaqSection.dataset) {
    initLatest = parseFloat(point);
  }

  var resetHeight = function resetHeight() {
    var faqSection = getByClass("faq");

    for (var _point in faqSection.dataset) {
      if (_point > initLatest) {
        faqSection.removeAttribute("data-".concat(_point));
      }
    }

    if (isDesktop) {
      skrollr.get().refresh();
    }
  };

  function refreshDatasetForScroll(elHeight, isOpening) {
    var faqSection = getByClass("faq");
    var RATIO = 0.12;
    var latest = 0;

    for (var _point2 in faqSection.dataset) {
      latest = parseFloat(_point2);
    }

    var currentTop = faqSection.dataset[latest].split(":")[1].slice(0, -1);
    var newHeight = isOpening ? latest + parseFloat(elHeight) : latest;

    if (!faqSection.dataset[newHeight]) {
      faqSection.dataset[newHeight] = "top: " + (currentTop - elHeight * RATIO) + "%";
    } else {
      faqSection.removeAttribute("data-".concat(newHeight));
    }

    if (isDesktop) {
      skrollr.get().refresh();
    }
  }

  var Accordion = function Accordion(options) {
    var element = typeof options.element === "string" ? document.getElementById(options.element) : options.element,
        openTab = options.openTab,
        oneOpen = options.oneOpen || false,
        titleClass = "js-Accordion-title",
        contentClass = "js-Accordion-content";
    render();

    function render() {
      // attach classes to buttons and containers
      [].forEach.call(element.querySelectorAll("button"), function (item) {
        item.classList.add(titleClass);
        item.nextElementSibling.classList.add(contentClass);
      }); // attach only one click listener

      element.addEventListener("click", onClick); // accordion starts with all tabs closed

      closeAll(); // sets the open tab - if defined

      if (openTab) {
        open(openTab);
      }
    }

    function onClick(e) {
      if (e.target.className.indexOf(titleClass) === -1) {
        return;
      }

      if (oneOpen) {
        closeAll();
      }

      toggle(e.target, e.target.nextElementSibling);
    }

    function closeAll() {
      [].forEach.call(element.querySelectorAll("." + contentClass), function (item) {
        item.style.height = 0;
      });
    }

    function toggle(title, section) {
      // getting the height every time in case
      // the content was updated dynamically
      var height = section.scrollHeight;
      var isOpening;

      if (section.style.height === "0px" || section.style.height === "") {
        section.style.height = height + 20 + "px";
        isOpening = true;
        title.classList.add("active");
      } else {
        section.style.height = 0;
        isOpening = false;
        title.classList.remove("active");
      }

      refreshDatasetForScroll(height, isOpening);
    }

    function getTarget(n) {
      return element.querySelectorAll("." + contentClass)[n - 1];
    }

    function open(n) {
      var target = getTarget(n);

      if (target) {
        if (oneOpen) closeAll();
        target.style.height = target.scrollHeight + "px";
      }
    }

    function close(n) {
      var target = getTarget(n);

      if (target) {
        target.style.height = 0;
      }
    }

    function destroy() {
      element.removeEventListener("click", onClick);
    }

    return {
      open: open,
      close: close,
      destroy: destroy
    };
  };

  var accordion = new Accordion({
    element: "accordion",
    oneOpen: false
  });

  if (isDesktop) {
    skrollr.init({
      forceHeight: true
    });
  } // functions block start


  var ROLES = {
    portfolioManager: {
      title: "директор и руководитель портфеля",
      problems: ["Качество данных о проектах не позволяет анализировать и принимать решения", "Отчеты не дают полной картины и готовятся с опозданием", "Протокольные поручения долго доходят до исполнителей, отсутствует обратная связь", "Поэтому проблемы решаются по факту их возникновения, приходиться управлять проектами вручную"],
      solutions: ["Достоверная информация о реализации проектов, программ и портфелей в едином окне", "Проверка качества данных по 24 критериям", "Оценка не только по бюджетам и срокам, но и по контрольным точкам, которые наглядно отображают ход реализации проекта", "Контроль отклонений в показателях деятельности с помощью системы e-mail-поручений", "Наглядные и подробные отчеты", "Рейтинг сотрудников"]
    },
    projectOffice: {
      title: "руководитель и планировщик программ, проектный офис",
      problems: ["Не хватает нужной информации для принятия решений", "Возникают параллельные запросы по причине отсутствия системы сбора данных по проектам", "Решения на совещаниях принимаются не на основе фактов, а на основе чутья", "Сложно обеспечить личное присутствие на каждом объекте и повлиять на работников контрагентов", "В итоге приходится решать проблемы по факту на площадке и принимать экспертные решения, не обладая нужными компетенциями. А система управления работает неэффективно"],
      solutions: ["Инструмент подбора команд проектов с учетом их опыта и результативности", "Управление текущей ситуацией через обратную связь в проектах", "Анализ динамики показателей деятельности ", "Агрегация больших данных развития методологии и управления знаниями ", "Шаблоны, сценарии планирования Управление мотивацией и качеством данных "]
    },
    projectEngineer: {
      title: "руководитель, планировщик и инженер проекта",
      problems: ["Возможны ошибки связи задач в графике и данных, отсутствие внимания к бюджету", "Планировщик может сделать график в логике, которая понятна только ему", "Сложные правила планирования мотивируют не исполнят их", "Исполнители могут быть не в курсе общего плана, но не говорить об этом", "В итоге графики не перепланируются автоматически, неполные и разношерстные данные препятствуют адекватному формированию программы и бюджета. Часть работ и поручений не выполняется вовремя, а проблемы замалчиваются."],
      solutions: ["Уменьшение трудозатрат на планирование и всегда актуальный график", "Акцентирование внимания не на рутине, а на управлении и моделировании ситуации по проектам, балансировке ресурсов на проект, расширенному контролю данных, быстрой коммуникации с подрядчиками ", "Единообразные графики, позволяющие реализовывать проект на одном языке"]
    }
  };

  var updateContent = function updateContent(role, category) {
    var wrapper = getByClass("functions__".concat(category, "__list"));
    wrapper.innerHTML = "";
    var commonWrapper = document.createElement("div");
    commonWrapper.classList.add("functions__".concat(category, "__list__common"));
    var lastIndex = ROLES[role][category].length - 1;

    var appendToWrapper = function appendToWrapper(text) {
      wrapper.appendChild(commonWrapper);
      wrapper.innerHTML += "<p>".concat(text, "</p>");
    };

    ROLES[role][category].forEach(function (text, index) {
      return index < lastIndex ? commonWrapper.innerHTML += "<p>".concat(text, "</p>") : appendToWrapper(text);
    });
  };

  var chooseBlock = getByClass("functions__choose");
  chooseBlock.addEventListener("click", function (e) {
    var chosenCategories = chooseBlock.getElementsByTagName("p");
    var chosen = chosenCategories[0];
    var newRole = e.target.dataset.role;
    var newChosen = document.querySelector("[data-role=".concat(newRole, "]"));

    if (!newRole || newRole === chosen.dataset.role) {
      return;
    }

    var chosenIndex = _toConsumableArray(chosenCategories).indexOf(chosen);

    var newChosenIndex = _toConsumableArray(chosenCategories).indexOf(newChosen);

    var tempInnerHtml = chosen.innerHTML;
    var tempRole = chosen.dataset.role;
    chosenCategories[chosenIndex].innerHTML = newChosen.innerHTML;
    chosenCategories[chosenIndex].dataset.role = newChosen.dataset.role;
    chosenCategories[newChosenIndex].innerHTML = tempInnerHtml;
    chosenCategories[newChosenIndex].dataset.role = tempRole;
    updateContent(newRole, "problems");
    updateContent(newRole, "solutions");
  }); // functions block end
  //faq block start

  var CATEGORIES = {
    possibilities: {
      title: "возможности",
      qa: [{
        question: "Чем проектный ассистент может помочь моей компании?",
        answer: "testAnswer"
      }, {
        question: "В чем преимущества системы?",
        answer: "Проектный ассистент расширяет функционал MS Project и дополняет стандартную методологию управления проектами. Система встраивается в деятельность компании и ее ИТ-архитектуру, объединяет ключевых партнеров. Продукт постоянно развивается, пользователи получают техническую и методическую поддержку."
      }, {
        question: "Как система поможет обычному проектировщику?",
        answer: "testAnswer3"
      }, {
        question: "Какая схема работы?",
        answer: "testAnswer4"
      }]
    },
    interface: {
      title: "Интерфейс",
      qa: [{
        question: "testQuestion11",
        answer: "testAnswer11"
      }, {
        question: "testQuestion21",
        answer: "testAnswer21"
      }, {
        question: "testQuestion31",
        answer: "testAnswer31"
      }, {
        question: "testQuestion41",
        answer: "testAnswer41"
      }, {
        question: "testQuestion51",
        answer: "testAnswer51"
      }]
    },
    introduction: {
      title: "Внедрение",
      qa: [{
        question: "testQuestion111",
        answer: "testAnswer111"
      }, {
        question: "testQuestion211",
        answer: "testAnswer211"
      }, {
        question: "testQuestion311",
        answer: "testAnswer311"
      }, {
        question: "testQuestion411",
        answer: "testAnswer411"
      }, {
        question: "testQuestion511",
        answer: "testAnswer511"
      }, {
        question: "testQuestion611",
        answer: "testAnswer611"
      }]
    },
    about: {
      title: "О проекте",
      qa: [{
        question: "testQuestion1111",
        answer: "testAnswer1112"
      }, {
        question: "testQuestion2111",
        answer: "testAnswer21123"
      }, {
        question: "testQuestion3111",
        answer: "testAnswer31123"
      }, {
        question: "testQuestion4111",
        answer: "testAnswer41123"
      }, {
        question: "testQuestion5111",
        answer: "testAnswer51123"
      }]
    }
  };
  var accordionState = {
    FULL: "full",
    SHORT: "short"
  };

  var checkShowMoreBtn = function checkShowMoreBtn(category) {
    var faqMoreBtn = getByClass("faq__show-more");
    var questionsAmount = CATEGORIES[category].qa.length;

    if (questionsAmount > 5) {
      faqMoreBtn.classList.add("visible");
    } else {
      faqMoreBtn.classList.remove("visible");
    }

    faqMoreBtn.addEventListener("click", function () {
      var oneSectionHeight = 86;
      updateAccordion(category, accordionState.FULL);
      faqMoreBtn.classList.remove("visible");
      questionsAmount > 5 && refreshDatasetForScroll((questionsAmount - 5) * oneSectionHeight, true);
    });
  };

  var faqTabs = getByClass("faq__header__tabs");
  faqTabs.addEventListener("click", function (e) {
    resetHeight();
    var chosen = getByClass("tab--chosen");
    var newCategory = e.target.dataset.category;

    if (!newCategory || newCategory === chosen.dataset.category) {
      return;
    }

    chosen.classList.remove("tab--chosen");
    var newChosen = document.querySelector("[data-category=".concat(newCategory, "]"));
    newChosen.classList.add("tab--chosen");
    checkShowMoreBtn(newCategory);
    updateAccordion(newCategory, accordionState.SHORT);
  });

  var updateAccordion = function updateAccordion(category, state) {
    var wrapper = getByClass("js-Accordion");
    var content = state === accordionState.SHORT ? CATEGORIES[category].qa.slice(0, 5) : CATEGORIES[category].qa;
    wrapper.innerHTML = "";
    content.forEach(function (qa) {
      return wrapper.innerHTML += "\n        <button class=\"js-Accordion-title\">".concat(qa.question, "\n          <img src=\"./wp-content/themes/new-pm/img/faq/arrow-down.png\" alt=\"arrow-down\">\n        </button>\n        <div class=\"js-Accordion-content\">").concat(qa.answer, "</div>\n        ");
    });
  };

  var initCat = getByClass("tab--chosen").dataset.category;
  checkShowMoreBtn(initCat);
  updateAccordion(initCat, accordionState.SHORT); //faq block end
  //menu start

  var burger = getByClass("menu__icon");
  var menuClose = getByClass("menu__close");

  var toggleMenu = function toggleMenu() {
    var menu = getByClass("menu");
    menu.classList.toggle("menu--open");
  };

  burger.addEventListener("click", toggleMenu);
  menuClose.addEventListener("click", toggleMenu); //menu end
  //formOpen start

  var scrollToFaqButton = getByClass("functions__solutions__text--more > button");
  scrollToFaqButton.addEventListener("click", function () {
    scrollTo(sectionsHeight["faq"]);
  });
  var formOpenButtons = [{
    querySelector: "order",
    text: "Нам нужна демонстрация."
  }, {
    querySelector: "how__arrow-block__analyse__content > button",
    text: "Мы готовы к переговорам о сотрудничестве."
  }, {
    querySelector: "scheme__start__presentation > button",
    text: "Нам нужна презентация возможностей Проектного Ассистента."
  }, {
    querySelector: "form__btn",
    text: ""
  }];
  formOpenButtons.forEach(function (_ref) {
    var querySelector = _ref.querySelector,
        text = _ref.text;
    var btn = getByClass(querySelector);
    var messageField = getByClass("form__message");
    btn.addEventListener("click", function () {
      messageField.value = text;
      toggleForm("open");
    });
  }); //formOpen end
  //scrollTo start

  var sectionsToScroll = document.querySelectorAll(".how, .result, .functions, .pros, .scheme, .faq, .form__wrap");
  var sectionsHeight = isDesktop ? {
    how: 990,
    result: 1870,
    functions: 2765,
    pros: 3600,
    scheme: 5200,
    faq: 7230,
    form__wrap: 7600
  } : _toConsumableArray(sectionsToScroll).reduce(function (acc, section) {
    return _objectSpread(_objectSpread({}, acc), {}, _defineProperty({}, section.classList[0], Math.ceil(window.pageYOffset + section.getBoundingClientRect().top)));
  }, {});

  var scrollTo = function scrollTo(top, behavior) {
    window.scrollTo({
      top: top,
      behavior: behavior || "smooth"
    });
  };

  var menuSections = document.querySelector(".menu__sections");
  menuSections.addEventListener("click", function (e) {
    var chosenSection = e.target.dataset.section;
    if (!chosenSection) return;
    scrollTo(sectionsHeight[chosenSection]);
    toggleMenu();
  }); //toggling big phone icon

  window.onscroll = function () {
    var phoneIcon = getByClass("phone-big");
    var phoneHeader = getByClass("offer__header");
    var phoneFooter = getByClass("form__title");
    var isPhoneHeaderVisible = window.pageYOffset < phoneHeader.clientHeight;
    var isPhoneFooterVisible = phoneFooter.getBoundingClientRect().top < window.innerHeight;

    if (!isPhoneHeaderVisible && !isPhoneFooterVisible) {
      phoneIcon.classList.add("visible");
    } else {
      phoneIcon.classList.remove("visible");
    }
  }; //scrollTo end
  //form start


  var formToInitState = function formToInitState() {
    var successScreen = getByClass("success-screen");
    var error = getByClass("error");
    var btn = document.querySelector(".form__modal button");
    var checkbox = getByClass("checkbox");
    [].concat(_toConsumableArray(allInputs), [btn, checkbox]).forEach(function (inp) {
      return inp.classList.remove("success");
    });
    allInputs.forEach(function (inp) {
      return inp.value = "";
    });
    successScreen.classList.remove("active");
    error.classList.remove("active");
  };

  var formOverlay = getByClass("form__modal__overlay");
  var formModal = getByClass("form__modal");
  var formButtons = document.querySelectorAll(".form__modal__close");

  var toggleForm = function toggleForm(action) {
    var howSection = getByClass("how");
    var resultSection = getByClass("result");
    var schemeSection = getByClass("scheme");

    if (action === "open") {
      formOverlay.classList.add("active");
      formModal.classList.add("active");
    } else {
      formOverlay.classList.remove("active");
      formModal.classList.remove("active");
    }

    if (isDesktop) {
      if (document.body.classList.contains("no-scroll")) {
        howSection.style.left = parseFloat(howSection.style.left) + 0.7 + "%";
        resultSection.style.left = parseFloat(resultSection.style.left) + 1.5 + "%";
        schemeSection.style.left = parseFloat(schemeSection.style.left) + 0.6 + "%";
      } else {
        howSection.style.left = parseFloat(howSection.style.left) - 0.7 + "%";
        resultSection.style.left = parseFloat(resultSection.style.left) - 1.5 + "%";
        schemeSection.style.left = parseFloat(schemeSection.style.left) - 0.6 + "%";
      }
    }

    document.body.classList.toggle("no-scroll");
  };

  [].concat(_toConsumableArray(formButtons), [formOverlay]).forEach(function (el) {
    return el.addEventListener("click", function () {
      toggleForm("close");
      formToInitState();
    });
  });
  var phoneMask = ["+", "7", "(", /[1-9]/, /\d/, /\d/, ")", " ", /\d/, /\d/, /\d/, "-", /\d/, /\d/, "-", /\d/, /\d/];
  var phone = getByClass("form__phone");
  var maskedInputController = vanillaTextMask.maskInput({
    inputElement: phone,
    mask: phoneMask
  });
  var formSubmitBtn = getByClass("form__submit__btn");
  var requiredInputs = document.querySelectorAll(".form__modal > input");
  var isValid = {
    name: false,
    tel: false,
    email: false
  };

  var checkSubmitButton = function checkSubmitButton() {
    if (Object.values(isValid).filter(Boolean).length === 3) {
      formSubmitBtn.removeAttribute("disabled");
    } else {
      formSubmitBtn.setAttribute("disabled", true);
    }
  };

  var checkField = function checkField(el) {
    var isPhone = el.name === "tel";
    var trimmedPhone = isPhone ? el.value.replace(/[_]/gi, "") : null;
    return isPhone && trimmedPhone.length === 17 ? true : !isPhone && el.value ? true : false;
  };

  requiredInputs.forEach(function (inp) {
    inp.addEventListener("input", function (e) {
      isValid[inp.name] = checkField(e.target);
      checkSubmitButton();
    });
  });
  formSubmitBtn.addEventListener("click", function (e) {
    var body = _toConsumableArray(allInputs).reduce(function (res, inp) {
      return _objectSpread(_objectSpread({}, res), {}, _defineProperty({}, inp.name, inp.type === "checkbox" ? inp.checked === true ? "Да" : "Нет" : inp.value));
    }, {});

    var fd = new FormData();

    for (var val in body) {
      fd.append(val, body[val]);
    }

    fd.append("sendto", "aacheblukov@gmail.com"); // fetch for sending mail

    fetch("./wp-content/themes/new-pm/scripts/mail.php", {
      method: "POST",
      body: fd
    }).then(function (res) {
      return res.status === 400 ? showError() : showSuccess();
    }).catch(function (err) {
      return console.error(err);
    });
  });

  var showError = function showError() {
    var error = getByClass("error");
    error.classList.add("active");
  };

  var showSuccess = function showSuccess() {
    var checkbox = getByClass("checkbox");
    var btn = document.querySelector(".form__modal button");
    [].concat(_toConsumableArray(allInputs), [checkbox, btn]).forEach(function (inp) {
      return inp.classList.add("success");
    });
    var successScreen = getByClass("success-screen");
    successScreen.classList.add("active");
    var error = getByClass("error");
    error.classList.remove("active");
    setTimeout(function () {
      toggleForm("close");
      formToInitState();
    }, 3000);
  }; //recalculate left for adaptive width from 1140 to 1920


  var allSections = [getByClass("offer")].concat(_toConsumableArray(sectionsToScroll));

  if (isDesktop && currentWidth < 1920) {
    var MIN_WIDTH = 1140;
    var MAX_WIDTH = 1920;
    var DIFF = MAX_WIDTH - MIN_WIDTH;
    var LEFT = 20;
    var leftForCurrentWidth = LEFT * ((currentWidth - MIN_WIDTH) / DIFF);
    var leftToChange = leftForCurrentWidth - LEFT;
    allSections.forEach(function (section) {
      var leftToChangeRatio = section.clientWidth / MIN_WIDTH;
      var breakpoints = [].filter.call(section.attributes, function (at) {
        return /^data-/.test(at.name);
      }).map(function (at) {
        return {
          name: at.name.split("-")[1],
          value: at.value
        };
      });
      breakpoints.forEach(function (bp) {
        var rebindLeft = function rebindLeft(sectionClass, breakpoint) {
          return section.classList.contains(sectionClass) && Number(bp.name) === breakpoint;
        };

        if (bp.value.includes("left: ")) {
          var values = bp.value.split("left: ");
          var left = parseFloat(values[1]);
          var newLeft = left + leftToChange * leftToChangeRatio;

          if (rebindLeft("how", 300) || rebindLeft("result", 1100) || rebindLeft("functions", 2000 || rebindLeft("scheme", 4600))) {
            section.dataset[bp.name] = "".concat(values[0], " left: 100%");
            return;
          }

          var newBpValue = "".concat(values[0], " left: ").concat(left > 100 && newLeft < 100 ? 100 : newLeft, "%");
          section.dataset[bp.name] = newBpValue;
        }
      });
    });
    skrollr.get().refresh();
  } //recalculate top for fullcsreen


  var initHeight = 1000;
  var currentHeight = window.innerHeight;
  var defaultFullScreenHeight = 1080;

  if (currentHeight > initHeight) {
    //5 is diff between top for initHeight and defaultFullScreenHeight
    var RATIOS = [{
      section: "how",
      ratio: 5
    }, {
      section: "result",
      ratio: 5 + 4
    }, {
      section: "functions",
      ratio: 5 + 4 + 5
    }, {
      section: "pros",
      ratio: 5 + 4 + 5 - 12
    }, {
      section: "faq",
      ratio: 5 + 4 + 5 - 12 + 4
    }];
    RATIOS.forEach(function (block) {
      var section = getByClass(block.section);
      var breakpoints = [].filter.call(section.attributes, function (at) {
        return /^data-/.test(at.name);
      }).map(function (at) {
        return {
          name: at.name.split("-")[1],
          value: at.value
        };
      });
      breakpoints.forEach(function (bp) {
        if (bp.value.includes("top:")) {
          var values = bp.value.replace(/(top:|\;| )|(\d+\.\d+\%)|(left: \d+\.\d+\%)/g, "$2|$3").split("|").filter(Boolean);
          var top = parseFloat(values[0]);
          var topDiff = currentHeight / defaultFullScreenHeight * block.ratio;
          var newBpValue = "top: ".concat(top - topDiff, "%; ").concat(values[1] ? values[1] : "").concat(values[2] ? values[2] : "", " ");
          section.dataset[bp.name] = newBpValue;

          if (bp.name === "4600" && block.section === "pros") {
            section.dataset[bp.name] = "top: ".concat(-88.5, "%; ").concat(values[1] ? values[1] : "", " ").concat(values[2] ? values[2] : "");
          }
        }
      });
    });

    if (isDesktop) {
      skrollr.get().refresh();
    }
  }
};