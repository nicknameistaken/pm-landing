// window.onload = function () {
window.addEventListener("load", () => {
  const getByClass = (className) => document.querySelector(`.${className}`);
  const currentWidth = window.innerWidth;
  const isDesktop = currentWidth >= 1140;
  const isMobile = currentWidth <= 640;
  const initFaqSection = getByClass("faq");
  let initLatest = 0;
  for (let point in initFaqSection.dataset) {
    initLatest = parseFloat(point);
  }
  const resetHeight = () => {
    const faqSection = getByClass("faq");
    for (let point in faqSection.dataset) {
      if (point > initLatest) {
        faqSection.removeAttribute(`data-${point}`);
      }
    }
    if (isDesktop) {
      skrollr.get().refresh();
    }
  };

  function refreshDatasetForScroll(elHeight, isOpening) {
    const faqSection = getByClass("faq");
    const RATIO = 0.12;
    let latest = 0;
    for (let point in faqSection.dataset) {
      latest = parseFloat(point);
    }
    const currentTop = faqSection.dataset[latest].split(":")[1].slice(0, -1);
    const newHeight = isOpening ? latest + parseFloat(elHeight) : latest;
    if (!faqSection.dataset[newHeight]) {
      faqSection.dataset[newHeight] =
        "top: " + (currentTop - elHeight * RATIO) + "%";
    } else {
      faqSection.removeAttribute(`data-${newHeight}`);
    }
    if (isDesktop) {
      skrollr.get().refresh();
    }
  }

  var Accordion = function (options) {
    var element =
        typeof options.element === "string"
          ? document.getElementById(options.element)
          : options.element,
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
      });

      // attach only one click listener
      element.addEventListener("click", onClick);

      // accordion starts with all tabs closed
      closeAll();

      // sets the open tab - if defined
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
      [].forEach.call(element.querySelectorAll("." + contentClass), function (
        item
      ) {
        item.style.height = 0;
      });
    }

    function toggle(title, section) {
      // getting the height every time in case
      // the content was updated dynamically
      var height = section.scrollHeight;

      let isOpening;

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
      destroy: destroy,
    };
  };

  const accordion = new Accordion({
    element: "accordion",
    oneOpen: false,
  });

  if (isDesktop) {
    skrollr.init({
      forceHeight: true,
    });
  }

  // functions block start

  const ROLES = {
    portfolioManager: {
      title: "директор и руководитель портфеля",
      problems: [
        "Качество данных о проектах не позволяет анализировать и принимать решения",
        "Отчеты не дают полной картины и готовятся с опозданием",
        "Протокольные поручения долго доходят до исполнителей, отсутствует обратная связь",
        "Поэтому проблемы решаются по факту их возникновения, приходиться управлять проектами вручную",
      ],
      solutions: [
        "Достоверная информация о реализации проектов, программ и портфелей в едином окне",
        "Проверка качества данных по 24 критериям",
        "Оценка не только по бюджетам и срокам, но и по контрольным точкам, которые наглядно отображают ход реализации проекта",
        "Контроль отклонений в показателях деятельности с помощью системы e-mail-поручений",
        "Наглядные и подробные отчеты",
        "Рейтинг сотрудников",
      ],
    },

    projectOffice: {
      title: "руководитель и планировщик программ, проектный офис",
      problems: [
        "Не хватает нужной информации для принятия решений",
        "Возникают параллельные запросы по причине отсутствия системы сбора данных по проектам",
        "Решения на совещаниях принимаются не на основе фактов, а на основе чутья",
        "Сложно обеспечить личное присутствие на каждом объекте и повлиять на работников контрагентов",
        "В итоге приходится решать проблемы по факту на площадке и принимать экспертные решения, не обладая нужными компетенциями. А система управления работает неэффективно",
      ],
      solutions: [
        "Инструмент подбора команд проектов с учетом их опыта и результативности",
        "Управление текущей ситуацией через обратную связь в проектах",
        "Анализ динамики показателей деятельности ",
        "Агрегация больших данных развития методологии и управления знаниями ",
        "Шаблоны, сценарии планирования Управление мотивацией и качеством данных ",
      ],
    },

    projectEngineer: {
      title: "руководитель, планировщик и инженер проекта",
      problems: [
        "Возможны ошибки связи задач в графике и данных, отсутствие внимания к бюджету",
        "Планировщик может сделать график в логике, которая понятна только ему",
        "Сложные правила планирования мотивируют не исполнят их",
        "Исполнители могут быть не в курсе общего плана, но не говорить об этом",
        "В итоге графики не перепланируются автоматически, неполные и разношерстные данные препятствуют адекватному формированию программы и бюджета. Часть работ и поручений не выполняется вовремя, а проблемы замалчиваются.",
      ],
      solutions: [
        "Уменьшение трудозатрат на планирование и всегда актуальный график",
        "Акцентирование внимания не на рутине, а на управлении и моделировании ситуации по проектам, балансировке ресурсов на проект, расширенному контролю данных, быстрой коммуникации с подрядчиками ",
        "Единообразные графики, позволяющие реализовывать проект на одном языке",
      ],
    },
  };

  const updateContent = (role, category) => {
    const wrapper = getByClass(`functions__${category}__list`);

    wrapper.innerHTML = "";
    const commonWrapper = document.createElement("div");
    commonWrapper.classList.add(`functions__${category}__list__common`);
    const lastIndex = ROLES[role][category].length - 1;
    const appendToWrapper = (text) => {
      wrapper.appendChild(commonWrapper);
      wrapper.innerHTML += `<p>${text}</p>`;
    };
    ROLES[role][category].forEach((text, index) => {
      return index < lastIndex
        ? (commonWrapper.innerHTML += `<p>${text}</p>`)
        : appendToWrapper(text);
    });
  };

  const chooseBlock = getByClass("functions__choose");
  chooseBlock.addEventListener("click", (e) => {
    const chosenCategories = chooseBlock.getElementsByTagName("p");
    const chosen = chosenCategories[0];
    const newRole = e.target.dataset.role;
    const newChosen = document.querySelector(`[data-role=${newRole}]`);
    if (!newRole || newRole === chosen.dataset.role) {
      return;
    }
    const chosenIndex = [...chosenCategories].indexOf(chosen);
    const newChosenIndex = [...chosenCategories].indexOf(newChosen);

    const tempInnerHtml = chosen.innerHTML;
    const tempRole = chosen.dataset.role;
    chosenCategories[chosenIndex].innerHTML = newChosen.innerHTML;
    chosenCategories[chosenIndex].dataset.role = newChosen.dataset.role;
    chosenCategories[newChosenIndex].innerHTML = tempInnerHtml;
    chosenCategories[newChosenIndex].dataset.role = tempRole;

    updateContent(newRole, "problems");
    updateContent(newRole, "solutions");
  });
  // functions block end

  //faq block start

  const CATEGORIES = {
    possibilities: {
      title: "возможности",
      qa: [
        {
          question: "Чем проектный ассистент может помочь моей компании?",
          answer: "testAnswer",
        },
        {
          question: "В чем преимущества системы?",
          answer:
            "Проектный ассистент расширяет функционал MS Project и дополняет стандартную методологию управления проектами. Система встраивается в деятельность компании и ее ИТ-архитектуру, объединяет ключевых партнеров. Продукт постоянно развивается, пользователи получают техническую и методическую поддержку.",
        },
        {
          question: "Как система поможет обычному проектировщику?",
          answer: "testAnswer3",
        },
        { question: "Какая схема работы?", answer: "testAnswer4" },
      ],
    },
    interface: {
      title: "Интерфейс",
      qa: [
        { question: "testQuestion11", answer: "testAnswer11" },
        { question: "testQuestion21", answer: "testAnswer21" },
        { question: "testQuestion31", answer: "testAnswer31" },
        { question: "testQuestion41", answer: "testAnswer41" },
        { question: "testQuestion51", answer: "testAnswer51" },
      ],
    },
    introduction: {
      title: "Внедрение",
      qa: [
        { question: "testQuestion111", answer: "testAnswer111" },
        { question: "testQuestion211", answer: "testAnswer211" },
        { question: "testQuestion311", answer: "testAnswer311" },
        { question: "testQuestion411", answer: "testAnswer411" },
        { question: "testQuestion511", answer: "testAnswer511" },
        { question: "testQuestion611", answer: "testAnswer611" },
      ],
    },
    about: {
      title: "О проекте",
      qa: [
        { question: "testQuestion1111", answer: "testAnswer1112" },
        { question: "testQuestion2111", answer: "testAnswer21123" },
        { question: "testQuestion3111", answer: "testAnswer31123" },
        { question: "testQuestion4111", answer: "testAnswer41123" },
        { question: "testQuestion5111", answer: "testAnswer51123" },
      ],
    },
  };
  const accordionState = {
    FULL: "full",
    SHORT: "short",
  };
  const checkShowMoreBtn = (category) => {
    const faqMoreBtn = getByClass("faq__show-more");
    const questionsAmount = CATEGORIES[category].qa.length;
    if (questionsAmount > 5) {
      faqMoreBtn.classList.add("visible");
    } else {
      faqMoreBtn.classList.remove("visible");
    }
    faqMoreBtn.addEventListener("click", () => {
      const oneSectionHeight = 86;
      updateAccordion(category, accordionState.FULL);
      faqMoreBtn.classList.remove("visible");

      questionsAmount > 5 &&
        refreshDatasetForScroll((questionsAmount - 5) * oneSectionHeight, true);
    });
  };
  const faqTabs = getByClass("faq__header__tabs");

  faqTabs.addEventListener("click", (e) => {
    resetHeight();

    const chosen = getByClass("tab--chosen");
    const newCategory = e.target.dataset.category;

    if (!newCategory || newCategory === chosen.dataset.category) {
      return;
    }

    chosen.classList.remove("tab--chosen");
    const newChosen = document.querySelector(`[data-category=${newCategory}]`);
    newChosen.classList.add("tab--chosen");
    checkShowMoreBtn(newCategory);
    updateAccordion(newCategory, accordionState.SHORT);
  });

  const updateAccordion = (category, state) => {
    const wrapper = getByClass("js-Accordion");
    const content =
      state === accordionState.SHORT
        ? CATEGORIES[category].qa.slice(0, 5)
        : CATEGORIES[category].qa;
    wrapper.innerHTML = "";
    content.forEach(
      (qa) =>
        (wrapper.innerHTML += `
      <button class="js-Accordion-title">${qa.question}
        <img src="./img/faq/arrow-down.png" alt="arrow-down">
      </button>
      <div class="js-Accordion-content">${qa.answer}</div>
      `)
    );
  };

  const initCat = getByClass("tab--chosen").dataset.category;
  checkShowMoreBtn(initCat);
  updateAccordion(initCat, accordionState.SHORT);
  //faq block end

  //menu start
  const burger = getByClass("menu__icon");
  const menuClose = getByClass("menu__close");
  const toggleMenu = () => {
    const menu = getByClass("menu");
    menu.classList.toggle("menu--open");
  };
  burger.addEventListener("click", toggleMenu);
  menuClose.addEventListener("click", toggleMenu);
  //menu end

  //formOpen start
  const scrollToFaqButton = getByClass(
    "functions__solutions__text--more > button"
  );
  scrollToFaqButton.addEventListener("click", () => {
    scrollTo(sectionsHeight["faq"]);
  });
  const formOpenButtons = [
    {
      querySelector: "order",
      text: "Нам нужна демонстрация.",
    },
    {
      querySelector: "how__arrow-block__analyse__content > button",
      text: "Мы готовы к переговорам о сотрудничестве.",
    },
    {
      querySelector: "scheme__start__presentation > button",
      text: "Нам нужна презентация возможностей Проектного Ассистента.",
    },

    {
      querySelector: "form__btn",
      text: "",
    },
  ];

  formOpenButtons.forEach(({ querySelector, text }) => {
    const btn = getByClass(querySelector);
    const messageField = getByClass("form__message");
    btn.addEventListener("click", () => {
      messageField.value = text;
      toggleForm();
    });
  });
  //formOpen end

  //scrollTo start
  const sectionsToScroll = document.querySelectorAll(
    ".how, .result, .functions, .pros, .scheme, .faq, .form__wrap"
  );
  const sectionsHeight = isDesktop
    ? {
        how: 990,
        result: 1870,
        functions: 2765,
        pros: 3600,
        scheme: 5200,
        faq: 7230,
        form__wrap: 7600,
      }
    : [...sectionsToScroll].reduce(
        (acc, section) => ({
          ...acc,
          [section.classList[0]]: Math.ceil(
            window.pageYOffset + section.getBoundingClientRect().top
          ),
        }),
        {}
      );
  const scrollTo = (top, behavior) => {
    window.scrollTo({
      top,
      behavior: behavior || "smooth",
    });
  };

  const menuSections = document.querySelector(".menu__sections");
  menuSections.addEventListener("click", (e) => {
    const chosenSection = e.target.dataset.section;
    if (!chosenSection) return;
    scrollTo(sectionsHeight[chosenSection]);
    toggleMenu();
  });

  //toggling big phone icon
  window.onscroll = () => {
    const phoneIcon = getByClass("phone-big");
    const phoneHeader = getByClass("offer__header");
    const phoneFooter = getByClass("form__title");
    const isPhoneHeaderVisible = window.pageYOffset < phoneHeader.clientHeight;
    const isPhoneFooterVisible =
      phoneFooter.getBoundingClientRect().top < window.innerHeight;

    if (!isPhoneHeaderVisible && !isPhoneFooterVisible) {
      phoneIcon.classList.add("visible");
    } else {
      phoneIcon.classList.remove("visible");
    }
  };
  //scrollTo end

  //form start
  const formOverlay = getByClass("form__modal__overlay");
  const formModal = getByClass("form__modal");
  const formButtons = document.querySelectorAll(".form__modal__close");
  const toggleForm = () => {
    const howSection = getByClass("how");
    const resultSection = getByClass("result");
    const schemeSection = getByClass("scheme");

    formOverlay.classList.toggle("active");
    formModal.classList.toggle("active");

    if (isDesktop) {
      if (document.body.classList.contains("no-scroll")) {
        howSection.style.left = parseFloat(howSection.style.left) + 0.7 + "%";
        resultSection.style.left =
          parseFloat(resultSection.style.left) + 1.5 + "%";
        schemeSection.style.left =
          parseFloat(schemeSection.style.left) + 0.6 + "%";
      } else {
        howSection.style.left = parseFloat(howSection.style.left) - 0.7 + "%";
        resultSection.style.left =
          parseFloat(resultSection.style.left) - 1.5 + "%";
        schemeSection.style.left =
          parseFloat(schemeSection.style.left) - 0.6 + "%";
      }
    }
    document.body.classList.toggle("no-scroll");
  };
  [...formButtons, formOverlay].forEach((el) =>
    el.addEventListener("click", toggleForm)
  );

  var phoneMask = [
    "+",
    "7",
    "(",
    /[1-9]/,
    /\d/,
    /\d/,
    ")",
    " ",
    /\d/,
    /\d/,
    /\d/,
    "-",
    /\d/,
    /\d/,
    "-",
    /\d/,
    /\d/,
  ];

  const phone = getByClass("form__phone");

  var maskedInputController = vanillaTextMask.maskInput({
    inputElement: phone,
    mask: phoneMask,
  });

  const formSubmitBtn = getByClass("form__submit__btn");
  const requiredInputs = document.querySelectorAll(".form__modal > input");
  let isValid = {
    name: false,
    tel: false,
    email: false,
  };
  const checkSubmitButton = () => {
    if (Object.values(isValid).filter(Boolean).length === 3) {
      formSubmitBtn.removeAttribute("disabled");
    } else {
      formSubmitBtn.setAttribute("disabled", true);
    }
  };
  const checkField = (el) => {
    const isPhone = el.name === "tel";
    const trimmedPhone = isPhone ? el.value.replace(/[_]/gi, "") : null;

    return isPhone && trimmedPhone.length === 17
      ? true
      : !isPhone && el.value
      ? true
      : false;
  };
  requiredInputs.forEach((inp) => {
    inp.addEventListener("input", (e) => {
      isValid[inp.name] = checkField(e.target);
      checkSubmitButton();
    });
  });

  formSubmitBtn.addEventListener("click", (e) => {
    const allInputs = document.querySelectorAll(
      ".form__modal input, .form__modal textarea"
    );
    const body = [...allInputs].reduce(
      (res, inp) => ({
        ...res,
        [inp.name]:
          inp.type === "checkbox"
            ? inp.checked === true
              ? "Да"
              : "Нет"
            : inp.value,
      }),
      {}
    );
    const fd = new FormData();
    for (const val in body) {
      fd.append(val, body[val]);
    }

    //fetch for sending mail
    // fetch("scripts/mail.php", {
    //   method: "POST",
    //   body: JSON.stringify(body),
    // })
    //   .then((res) => console.log(JSON.stringify(res)))
    //   .catch((err) => console.error(err));
  });

  //recalculate left for adaptive width from 1140 to 1920

  const allSections = [getByClass("offer"), ...sectionsToScroll];
  if (isDesktop && currentWidth < 1920) {
    const MIN_WIDTH = 1140;
    const MAX_WIDTH = 1920;
    const DIFF = MAX_WIDTH - MIN_WIDTH;
    const LEFT = 20;
    const leftForCurrentWidth = LEFT * ((currentWidth - MIN_WIDTH) / DIFF);
    const leftToChange = leftForCurrentWidth - LEFT;

    allSections.forEach((section) => {
      const leftToChangeRatio = section.clientWidth / MIN_WIDTH;

      const breakpoints = [].filter
        .call(section.attributes, function (at) {
          return /^data-/.test(at.name);
        })
        .map((at) => ({ name: at.name.split("-")[1], value: at.value }));

      breakpoints.forEach((bp) => {
        const rebindLeft = (sectionClass, breakpoint) =>
          section.classList.contains(sectionClass) &&
          Number(bp.name) === breakpoint;
        if (bp.value.includes("left: ")) {
          const values = bp.value.split("left: ");
          const left = parseFloat(values[1]);
          const newLeft = left + leftToChange * leftToChangeRatio;

          if (
            rebindLeft("how", 300) ||
            rebindLeft("result", 1100) ||
            rebindLeft("functions", 2000 || rebindLeft("scheme", 4600))
          ) {
            section.dataset[bp.name] = `${values[0]} left: 100%`;
            return;
          }

          const newBpValue = `${values[0]} left: ${
            left > 100 && newLeft < 100 ? 100 : newLeft
          }%`;
          section.dataset[bp.name] = newBpValue;
        }
      });
    });

    skrollr.get().refresh();
  }
});
