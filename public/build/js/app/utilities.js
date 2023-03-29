/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/app/utilities.js ***!
  \***************************************/
/* ************************************************************************* */
/* ********** 1. Function To Toggle Header-Search-Style1 Dropdown ********** */
/* ************************************************************************* */
var toggleSearch1Dropdown = function toggleSearch1Dropdown(event) {
  var headerSearch1 = document && document.querySelector('#js-headerSearchStyle1');

  // Exit if SearchSearchStyle1 is not present on DOM
  if (!headerSearch1) {
    return false;
  }
  var searchTextInput = headerSearch1.querySelector('.search__wrapper input');
  var searchCloseButton = headerSearch1.querySelector('.search__wrapper .search__button.close');
  var searchDropdown = document && document.querySelector('#js-headerSearchStyle1Dropdown');
  if (headerSearch1.classList.contains('active')) {
    if (event.target === searchCloseButton || searchCloseButton.contains(event.target)) {
      headerSearch1.classList.remove('active');
    } else if (!event.target.contains(searchDropdown) && event.target !== searchTextInput) {
      headerSearch1.classList.remove('active');
    }
  } else if (event.target === searchTextInput) {
    headerSearch1.classList.add('active');
  }
  return true;
};
/* ------------------------------------------------------------------------- */

/* **************************************************************************** */
/* ********** 2. Flex Overflow Container Custom Scroll Functionality ********** */
/* **************************************************************************** */

// Variable Definitions
var drag = {
  state: false,
  start: 0
};

// Assign mouseMoveHandler() onto target element directly
// eslint-disable-next-line no-unused-vars
var mouseMoveHandler = function mouseMoveHandler(currentScrollTargetContainer, event) {
  if (!currentScrollTargetContainer) {
    return false;
  }
  if (drag.state && currentScrollTargetContainer) {
    if (event.touches && event.touches.length) {
      var value = drag.elementPosition + (drag.startPosition - event.touches[0].clientX);
      currentScrollTargetContainer.scrollLeft = value;
    } else {
      currentScrollTargetContainer.scrollLeft = drag.elementPosition + (drag.startPosition - event.clientX);
    }
  }
  return true;
};

// Assign mouseDownHandler() onto target element directly
// eslint-disable-next-line no-unused-vars
var mouseDownHandler = function mouseDownHandler(currentScrollTargetContainer, event) {
  if (!currentScrollTargetContainer) return false;
  drag.state = true;
  drag.startPosition = event.clientX;
  drag.elementPosition = currentScrollTargetContainer.scrollLeft;
  currentScrollTargetContainer.style.cursor = 'grabbing';
  currentScrollTargetContainer.style.userSelect = 'none';
  currentScrollTargetContainer.onmousemove = function (e) {
    mouseMoveHandler(currentScrollTargetContainer, e);
  };
  currentScrollTargetContainer.ontouchmove = function (e) {
    mouseMoveHandler(currentScrollTargetContainer, e);
  };
  return true;
};

// Assign mouseUpHandler() onto target element directly
// eslint-disable-next-line no-unused-vars
var mouseUpHandler = function mouseUpHandler(currentScrollTargetContainer) {
  if (!currentScrollTargetContainer) return false;
  drag.state = false; // needs to be instantiated outside this function
  currentScrollTargetContainer.style.cursor = 'grab';
  currentScrollTargetContainer.style.removeProperty('user-select');
  currentScrollTargetContainer.onmousemove = null;
  currentScrollTargetContainer.ontouchmove = null;
  return true;
};
/* ------------------------------------------------------------------------- */

/* ********************************************************************* */
/* ********** 3. Function To Toggle Header-Mobile-Menu-Style1 ********** */
/* ********************************************************************* */
// eslint-disable-next-line no-unused-vars
var toggleHeader1MobileMenu = function toggleHeader1MobileMenu() {
  var mobileMenuDrawer = document.querySelector('.mobileMenu');
  var body = document.querySelector('body');
  if (mobileMenuDrawer.classList.contains('active')) {
    mobileMenuDrawer.classList.remove('active');
    body.style.overflow = 'auto';
  } else {
    mobileMenuDrawer.classList.add('active');
    body.style.overflow = 'hidden';
  }
  return true;
};
/* ------------------------------------------------------------------------- */

/* ******************************************************************************* */
/* ********** 4. Function To Toggle Header-Mobile-Menu-Style1-Dropdowns ********** */
/* ******************************************************************************* */
// eslint-disable-next-line no-unused-vars
var toggleSideNavAccordion = function toggleSideNavAccordion(targetElement) {
  var sideNavDropdown = targetElement.querySelector('.sideDropdown');
  if (!sideNavDropdown) return false;
  if (targetElement.classList.contains('active')) {
    targetElement.classList.remove('active');
  } else {
    targetElement.classList.add('active');
  }
  return true;
};
/* -------------------------------------------------------------------------------- */

/* ************************************************************************ */
/* ********** 5. Function Scroll To Selected Store On Store Page ********** */
/* ************************************************************************ */
// eslint-disable-next-line no-unused-vars
var scrollToSelectedStore = function scrollToSelectedStore(value) {
  if (value) {
    // const url = value.toLowerCase()
    window.location.hash = "#".concat(value);
  }
  return true;
};
/* ------------------------------------------------------------------------- */

/* ************************************************************************ */
/* ********** 6. Function For Scroll To Selected Store On Store Page ********** */
/* ************************************************************************ */
var handleStickySidebarScroll = function handleStickySidebarScroll() {
  var PADDING = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
  var sidebarElements = document.querySelectorAll('.js-stickySidebar');
  if (!sidebarElements.length) return false;
  var windowHeight = window.innerHeight;
  var header = document.querySelector('.header');
  var availableSpace = windowHeight - header.scrollHeight;
  sidebarElements.forEach(function (sidebar) {
    if (sidebar.scrollHeight > availableSpace) {
      sidebar.style.top = "".concat(availableSpace - sidebar.scrollHeight, "px");
    } else {
      sidebar.style.top = "".concat(header.scrollHeight + PADDING, "px");
    }
  });
  return true;
};
/* ------------------------------------------------------------------------- */

/* ************************************************************************ */
/* *********** 7. Function To Filter (Show/ Hide) DiscountCards *********** */
/* ************************************************************************ */
// eslint-disable-next-line no-unused-vars
var filterDiscountCards = function filterDiscountCards(targetElement) {
  try {
    var dataVisibility = targetElement.attributes['data-visibility'].value;
    var discountCardArray = document.querySelectorAll('.js-discountCard');
    if (!discountCardArray.length) {
      return false;
    }
    if (dataVisibility === 'all') {
      discountCardArray.forEach(function (card) {
        card.style.display = 'block';
      });
    } else {
      discountCardArray.forEach(function (card) {
        if (card.classList.contains(dataVisibility)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }
    return true;
  } catch (error) {
    // eslint-disable-next-line no-console
    console.log(error);
    return false;
  }
};
/* ------------------------------------------------------------------------- */

/* ************************************************************************ */
/* ****** 8. Function To Toggle (Show/ Hide) StoreAbout Tabs Content ****** */
/* ************************************************************************ */
// eslint-disable-next-line no-unused-vars
var toggleAboutTabs = function toggleAboutTabs(targetTabButton, tabIndex) {
  try {
    var tabButtonArray = document.querySelectorAll('.js-tabButton');
    var tabContentBoxArray = document.querySelectorAll('.js-tabContentBox');
    if (!tabContentBoxArray.length) {
      return false;
    }

    /* 1. Toggle Active Class On Tab Buttons */
    tabButtonArray.forEach(function (tabButton) {
      if (tabButton === targetTabButton) {
        tabButton.classList.add('active');
      } else {
        tabButton.classList.remove('active');
      }
    });

    /* 2. Toggle Tab Content Boxes Visibility */
    tabContentBoxArray.forEach(function (tabContentBox) {
      var aboutTabIdentity = tabContentBox.attributes['data-about-tab'].value;
      if (Number(aboutTabIdentity) === Number(tabIndex)) {
        tabContentBox.classList.add('tab__content__box--show');
        tabContentBox.classList.remove('tab__content__box--hide');
      } else {
        tabContentBox.classList.remove('tab__content__box--show');
        tabContentBox.classList.add('tab__content__box--hide');
      }
    });
    return true;
  } catch (error) {
    // eslint-disable-next-line no-console
    console.log(error);
    return false;
  }
};
/* ------------------------------------------------------------------------- */

/* ************************************************************************ */
/* ****** 9. Function To Toggle (Show/ Hide) AccordionStyle1 Content ****** */
/* ************************************************************************ */
// eslint-disable-next-line no-unused-vars
var toggleAccordion = function toggleAccordion(targetAccordionHead) {
  try {
    var accordionStyle1Array = document.querySelectorAll('.js-accordionStyle1');
    if (!accordionStyle1Array.length) {
      return false;
    }

    /* 1. Toggle Active Class On Accordion Heads */
    accordionStyle1Array.forEach(function (accordion) {
      var accordionHead = accordion.querySelector('.accordion__head');
      if (targetAccordionHead === accordionHead) {
        if (!accordionHead.classList.contains('active')) {
          accordionHead.classList.add('active');
        } else {
          accordionHead.classList.remove('active');
        }
      } else {
        accordionHead.classList.remove('active');
      }
    });
    return true;
  } catch (error) {
    // eslint-disable-next-line no-console
    console.log(error);
    return false;
  }
};
/* ------------------------------------------------------------------------- */

/* ************************************************************************* */
/* *********************** Body Click Event Listener *********************** */
/* ************************************************************************* */
document.addEventListener('click', function (event) {
  // 1. Function To Toggle Header-Search-Style1 Dropdown
  toggleSearch1Dropdown(event);
});
/* ------------------------------------------------------------------------- */

/* ************************************************************************* */
/* *********************** Window Resize Event Listener *********************** */
/* ************************************************************************* */
window.addEventListener('resize', function () {
  // 1. Handles Sticky Functionality On Sidebar Of Two Column Layouts
  handleStickySidebarScroll(10);
});
/* ------------------------------------------------------------------------- */

/* ************************************************************************* */
/* *********************** Window Load Event Listener *********************** */
/* ************************************************************************* */
window.addEventListener('load', function () {
  // 1. Handles Sticky Functionality On Sidebar Of Two Column Layouts
  handleStickySidebarScroll(10);
}, false);
/* ------------------------------------------------------------------------- */
/******/ })()
;