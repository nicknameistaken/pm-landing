// window.onload = function () {
window.addEventListener("load", () => {
  const getByClass = (className) => document.querySelector(`.${className}`);
  const isDesktop = window.outerWidth > 1140;
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
      const faqSection = getByClass("faq");
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
      refreshDatasetForScroll(faqSection, height, isOpening);
    }

    function refreshDatasetForScroll(faqSection, elHeight, isOpening) {
      const RATIO = 0.12;
      let latest = 0;
      for (let point in faqSection.dataset) {
        latest = parseFloat(point);
      }
      const currentTop = faqSection.dataset[latest].split(":")[1].slice(0, -1);
      console.log(currentTop);
      const newHeight = isOpening ? latest + parseFloat(elHeight) : latest;
      console.log(newHeight);
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
  window.onscroll = () => console.log(window.scrollY);

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
      console.log(wrapper.innerHTML);
      return index < lastIndex
        ? (commonWrapper.innerHTML += `<p>${text}</p>`)
        : appendToWrapper(text);
    });
  };

  const chooseBlock = getByClass("functions__choose");
  chooseBlock.addEventListener("click", (e) => {
    const chosen = getByClass("functions__choose--chosen");
    const newRole = e.target.dataset.role;

    if (!newRole || newRole === chosen.dataset.role) {
      return;
    }

    chosen.classList.remove("functions__choose--chosen");
    const newChosen = document.querySelector(`[data-role=${newRole}]`);
    newChosen.classList.add("functions__choose--chosen");

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

    updateAccordion(newCategory);
  });

  const updateAccordion = (category) => {
    const wrapper = getByClass("js-Accordion");

    wrapper.innerHTML = "";
    CATEGORIES[category].qa.forEach(
      (qa) =>
        (wrapper.innerHTML += `
      <button class="js-Accordion-title">${qa.question}
        <img src="./img/faq/arrow-down.png" alt="arrow-down">
      </button>
      <div class="js-Accordion-content">${qa.answer}</div>
      `)
    );
  };
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

  //scrollTo start
  const interactiveButtons = [
    {
      querySelector: "order",
      where: "form",
    },
    {
      querySelector: "how__arrow-block__analyse__content > button",
      where: "form",
    },
    {
      querySelector: "functions__solutions__text--more > button",
      where: "faq",
    },
    {
      querySelector: "scheme__start__presentation > button",
      where: "form",
    },
  ];
  interactiveButtons.forEach(({ querySelector, where }) => {
    const btn = getByClass(querySelector);
    btn.addEventListener("click", () => scrollTo(sectionsHeight[where]));
  });

  const sections = document.querySelectorAll(
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
    : [...sections].reduce(
        (acc, section) => ({
          ...acc,
          [section.classList[0]]: Math.ceil(
            window.pageYOffset + section.getBoundingClientRect().top
          ),
        }),
        {}
      );
  const scrollTo = (top) => {
    window.scrollTo({
      top,
      behavior: "smooth",
    });
  };

  const menuSections = document.querySelector(".menu__sections");
  menuSections.addEventListener("click", (e) => {
    const chosenSection = e.target.dataset.section;
    if (!chosenSection) return;
    scrollTo(sectionsHeight[chosenSection]);
    toggleMenu();
  });

  const phoneIcon = getByClass("phone-big");
  phoneIcon.addEventListener("click", () =>
    scrollTo(sectionsHeight["form__wrap"])
  );
  //scrollTo end

  //form start
  const formOverlay = getByClass("form__modal__overlay");
  const formModal = getByClass("form__modal");
  const formButtons = document.querySelectorAll(
    ".form__btn, .form__modal__close"
  );
  const toggleForm = () => {
    formOverlay.classList.toggle("active");
    formModal.classList.toggle("active");
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
  formSubmitBtn.addEventListener("click", (e) => {
    const inputs = document.querySelectorAll(".form__modal input");
    console.log(inputs);
    const body = [...inputs].reduce(
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
    fetch("/mail/mail.php", {
      method: "POST",
      body: JSON.stringify(body),
    })
      .then((res) => res.json())
      .then((res) => console.log(res))
      .catch((err) => console.error(err));
  });
});
