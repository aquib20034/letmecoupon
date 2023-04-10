/* ************************************************************************* */
/* ********** 1. Function To Toggle Header-Search-Style1 Dropdown ********** */
/* ************************************************************************* */
const toggleSearch1Dropdown = (event) => {
    const headerSearch1 = document && document.querySelector('#js-headerSearchStyle1');

    // Exit if SearchSearchStyle1 is not present on DOM
    if (!headerSearch1) {
        return false;
    }

    const searchTextInput = headerSearch1.querySelector('.search__wrapper input');
    const searchCloseButton = headerSearch1.querySelector('.search__wrapper .search__button.close');
    const searchDropdown = document && document.querySelector('#js-headerSearchStyle1Dropdown');

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
const drag = {
    state: false,
    start: 0,
};

// Assign mouseMoveHandler() onto target element directly
// eslint-disable-next-line no-unused-vars
const mouseMoveHandler = (currentScrollTargetContainer, event) => {
    if (!currentScrollTargetContainer) { return false; }

    if (drag.state && currentScrollTargetContainer) {
        if (event.touches && event.touches.length) {
            const value =
                drag.elementPosition +
                (drag.startPosition - event.touches[0].clientX);
            currentScrollTargetContainer.scrollLeft = value;
        } else {
            currentScrollTargetContainer.scrollLeft =
                drag.elementPosition +
                (drag.startPosition - event.clientX);
        }
    }
    return true;
};

// Assign mouseDownHandler() onto target element directly
// eslint-disable-next-line no-unused-vars
const mouseDownHandler = (currentScrollTargetContainer, event) => {
    if (!currentScrollTargetContainer) return false;

    drag.state = true;
    drag.startPosition = event.clientX;
    drag.elementPosition = currentScrollTargetContainer.scrollLeft;
    currentScrollTargetContainer.style.cursor = 'grabbing';
    currentScrollTargetContainer.style.userSelect = 'none';
    currentScrollTargetContainer.onmousemove = (e) => {
        mouseMoveHandler(currentScrollTargetContainer, e);
    };
    currentScrollTargetContainer.ontouchmove = (e) => {
        mouseMoveHandler(currentScrollTargetContainer, e);
    };
    return true;
};

// Assign mouseUpHandler() onto target element directly
// eslint-disable-next-line no-unused-vars
const mouseUpHandler = (currentScrollTargetContainer) => {
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
const toggleHeader1MobileMenu = () => {
    const mobileMenuDrawer = document.querySelector('.mobileMenu');
    const body = document.querySelector('body');

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
const toggleSideNavAccordion = (targetElement) => {
    const sideNavDropdown = targetElement.querySelector('.sideDropdown');

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
const scrollToSelectedStore = (value) => {
    if (value) {
        // const url = value.toLowerCase()
        window.location.hash = `#${value}`;
    }
    return true;
};
/* ------------------------------------------------------------------------- */


/* ************************************************************************ */
/* ********** 6. Function For Scroll To Selected Store On Store Page ********** */
/* ************************************************************************ */
const handleStickySidebarScroll = (PADDING = 0) => {
    const sidebarElements = document.querySelectorAll('.js-stickySidebar');

    if (!sidebarElements.length) return false;


    const windowHeight = window.innerHeight;
    const header = document.querySelector('.header');
    const availableSpace = windowHeight - header.scrollHeight;

    sidebarElements.forEach((sidebar) => {
        if (sidebar.scrollHeight > availableSpace) {
            sidebar.style.top = `${availableSpace - sidebar.scrollHeight}px`;
        } else {
            sidebar.style.top = `${header.scrollHeight + PADDING}px`;
        }
    });

    return true;
};
/* ------------------------------------------------------------------------- */


/* ************************************************************************ */
/* *********** 7. Function To Filter (Show/ Hide) DiscountCards *********** */
/* ************************************************************************ */
// eslint-disable-next-line no-unused-vars
const filterDiscountCards = (targetElement) => {
    try {
        const dataVisibility = targetElement.attributes['data-visibility'].value;
        const discountCardArray = document.querySelectorAll('.js-discountCard');

        if (!discountCardArray.length) {
            return false;
        }


        if (dataVisibility === 'all') {
            discountCardArray.forEach((card) => {
                card.style.display = 'block';
            });
        } else {
            discountCardArray.forEach((card) => {
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
const toggleAboutTabs = (targetTabButton, tabIndex) => {
    try {
        const tabButtonArray = document.querySelectorAll('.js-tabButton');
        const tabContentBoxArray = document.querySelectorAll('.js-tabContentBox');

        if (!tabContentBoxArray.length) {
            return false;
        }

        /* 1. Toggle Active Class On Tab Buttons */
        tabButtonArray.forEach((tabButton) => {
            if (tabButton === targetTabButton) {
                tabButton.classList.add('active');
            } else {
                tabButton.classList.remove('active');
            }
        });

        /* 2. Toggle Tab Content Boxes Visibility */
        tabContentBoxArray.forEach((tabContentBox) => {
            const aboutTabIdentity = tabContentBox.attributes['data-about-tab'].value;

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
const toggleAccordion = (targetAccordionHead) => {
    try {
        const accordionStyle1Array = document.querySelectorAll('.js-accordionStyle1');

        if (!accordionStyle1Array.length) {
            return false;
        }

        /* 1. Toggle Active Class On Accordion Heads */
        accordionStyle1Array.forEach((accordion) => {
            const accordionHead = accordion.querySelector('.accordion__head');

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
document.addEventListener('click', (event) => {
    // 1. Function To Toggle Header-Search-Style1 Dropdown
    toggleSearch1Dropdown(event);
});
/* ------------------------------------------------------------------------- */


/* ************************************************************************* */
/* *********************** Window Resize Event Listener *********************** */
/* ************************************************************************* */
window.addEventListener('resize', () => {
    // 1. Handles Sticky Functionality On Sidebar Of Two Column Layouts
    handleStickySidebarScroll(10);
});
/* ------------------------------------------------------------------------- */

/* ************************************************************************* */
/* *********************** Window Load Event Listener *********************** */
/* ************************************************************************* */
window.addEventListener('load', () => {
    // 1. Handles Sticky Functionality On Sidebar Of Two Column Layouts
    handleStickySidebarScroll(10);
}, false);
/* ------------------------------------------------------------------------- */
