// window.onload = function () {
document.addEventListener("DOMContentLoaded", function () {
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

      toggle(e.target.nextElementSibling);
    }

    function closeAll() {
      [].forEach.call(element.querySelectorAll("." + contentClass), function (
        item
      ) {
        item.style.height = 0;
      });
    }

    function toggle(el) {
      // getting the height every time in case
      // the content was updated dynamically
      var height = el.scrollHeight;

      if (el.style.height === "0px" || el.style.height === "") {
        el.style.height = height + "px";
      } else {
        el.style.height = 0;
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
    openTab: 1,
    oneOpen: false,
  });

  skrollr.init({
    forceHeight: true,
  });
  window.onscroll = () => console.log(window.scrollY);

  const getByClass = (className) => document.querySelector(`.${className}`);

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
    ROLES[role][category].forEach(
      (text) => (wrapper.innerHTML += `<p>${text}</p>`)
    );
  };

  const chooseBlock = getByClass("functions__choose");
  chooseBlock.addEventListener("click", (e) => {
    const chosen = getByClass("functions__choose--chosen");
    const newRole = e.target.dataset.role;
    if (!e.target.dataset || newRole === chosen.dataset.role) {
      return;
    }
    chosen.classList.remove("functions__choose--chosen");
    const newChosen = document.querySelector(`[data-role=${newRole}]`);
    newChosen.classList.add("functions__choose--chosen");

    updateContent(newRole, "problems");
    updateContent(newRole, "solutions");
  });
});
// functions block end
