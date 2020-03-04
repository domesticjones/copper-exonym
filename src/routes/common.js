export default {
  init() {
    const faqToggles = document.querySelectorAll('.accordionToggle');

    function openFAQ(toggleElem, clickedIndex) {
        faqToggles.forEach((toggle, index) => {
            if(clickedIndex !== index) {
                toggle.classList.remove('rotate');
                const line = toggle.children[0].children[0];
                line.classList.remove('rotate');
                const openWrapper = toggle.parentNode.parentNode.querySelector('.leafWrapper');
                openWrapper.style.height = '0px';
            }
        });

        toggleElem.classList.toggle('rotate');
        const plusLine = toggleElem.children[0].children[0];
        plusLine.classList.toggle('rotate');
        const leafWrapper = toggleElem.parentNode.parentNode.querySelector('.leafWrapper');
        const leafContent = leafWrapper.querySelector('.leafContent');
        const leafWrapperCurrentHeight = parseInt(leafWrapper.style.height.replace('px', ''));

        leafWrapper.style.height = leafWrapperCurrentHeight === leafContent.clientHeight ? '0px' : leafContent.clientHeight + 'px';
    }

    faqToggles.forEach((toggle, index) => {
        toggle.addEventListener('click', () => {openFAQ(toggle, index)});
    });

  },
  finalize() {
  },
};
