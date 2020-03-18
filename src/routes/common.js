export default {
  init() {
      window.addEventListener('resize', updateWindowDimensions);
      updateWindowDimensions();

      addClickEvents();

      function updateWindowDimensions() {
          const navBars = document.querySelectorAll('.navbar');
          const navBarMobile = document.querySelector('.navbarMobile');

          if(window.innerWidth < 1000) {
              if(navBarMobile.classList.contains('hidden')) {
                  navBars.forEach((navBar) => {
                      navBar.classList.toggle('hidden');
                  });
              }
          }
          else {
              if(!navBarMobile.classList.contains('hidden')) {
                  navBars.forEach((navBar) => {
                      navBar.classList.toggle('hidden');
                  });
              }
          }
      }

      setTimeout(() => {
          const homeImage  = document.querySelector('.homeImage');
          homeImage.style.paddingTop = '0px';
      }, 1500);

      const faqToggles = document.querySelectorAll('.accordionToggle');
      const getAppForms = document.querySelectorAll('.getTheApp');
      const inputFields = document.querySelectorAll('.enterPhone');
      const firstOpen = document.querySelector('.firstOpen');
      firstOpen.parentNode.style.height = firstOpen.clientHeight + 'px';

      inputFields.forEach((field) => {
          const inputLabels = document.querySelectorAll('.inputLabel');
          field.addEventListener('focus', () => {
              inputLabels.forEach((label) => label.style.display = 'none');
          });
      });

      getAppForms.forEach((form) => {
          getTheApp(form);
      });

      function addClickEvents() {
          const navItems = document.querySelectorAll('.navitem');
          const getAppButton = document.querySelector('.navitemButton');
          const burger = document.querySelector('.navburger');
          const mobileMenu = document.querySelector('.absoluteMenu');
          const mobileNav = document.querySelector('.navbarMobile');

          if(getAppButton)
              getAppButton.addEventListener('click', () => {
                  openAppStore();
              });

          if(burger)
              burger.addEventListener('click', () => {
                  burger.classList.toggle('open');
                  mobileMenu.classList.toggle('open');
                  mobileNav.classList.toggle('open');
              });

          navItems.forEach((navItem) => {

              navItem.addEventListener('click', (e) => {
                  e.preventDefault();

                  const targetId = e.currentTarget.dataset.value;
                  const target = document.querySelector(`#${targetId}`);
                  const scrollTargetPosition = target.offsetTop - 64;
                  const viewPort = document.querySelector('.content');

                  if(burger && mobileMenu && mobileNav && burger.classList.contains('open')) {
                      burger.classList.toggle('open');
                      mobileMenu.classList.toggle('open');
                      mobileNav.classList.toggle('open');
                  }

                  viewPort.scroll({left: 0, top: scrollTargetPosition, behavior: 'smooth'});
              })
          });
      }

      function getTheApp(form) {
          form.addEventListener('submit', (e) => {
              e.preventDefault();

              if(window.innerWidth < 1000) {
                  openAppStore();
              }
              else {
                  const value = e.currentTarget.enterPhoneOne ? e.currentTarget.enterPhoneOne.value : e.currentTarget.enterPhoneTwo.value;

                  if(!value)
                      return alert('Please enter your phone number to Get Copper!');

                  sendSMS(e.currentTarget);
              }
          })
      }

      function openAppStore() {
          const userAgent = navigator.userAgent || navigator.vendor;

          if (/android/i.test(userAgent))
              window.open('https://play.google.com/store/apps/details?id=com.getcopper.copper', '_blank');
          else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream)
              window.open('https://itunes.apple.com/us/app/id1486647561?ls=1', '_blank');
          else
              alert('Only available on Apple App Store and Android App Store.');

      }

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

      const testimonialCarousel = document.querySelector('.testimonialCarousel');
      const carouselDots = document.querySelectorAll('.dot');
      let scrollIncrement = 0;

      const autoScroll = setInterval(() =>{
          const scrollWidth = testimonialCarousel.clientWidth;

          toggleDots();
          if(scrollIncrement === 2) {
              testimonialCarousel.scrollLeft = 0;
              incrementCount();
          }
          else {
              testimonialCarousel.scrollLeft += scrollWidth;
              incrementCount();
          }
      }, 8000);

      function incrementCount() {
          scrollIncrement = scrollIncrement === 2 ? 0 : scrollIncrement + 1;
      }

      function toggleDots(index) {
          if(typeof index === 'number') {
              carouselDots[scrollIncrement].classList.toggle('active');
              carouselDots[index].classList.toggle('active');
              scrollIncrement = index;
          }
          else {
              carouselDots[scrollIncrement].classList.toggle('active');

              if(scrollIncrement === 2)
                  carouselDots[0].classList.toggle('active');
              else
                  carouselDots[scrollIncrement + 1].classList.toggle('active');
          }
      }

      carouselDots.forEach((dot, index) => {
          dot.addEventListener('click', () => {
              window.clearInterval(autoScroll);
              const scrollWidth = testimonialCarousel.clientWidth;

              toggleDots(index);
              testimonialCarousel.scrollLeft = index * scrollWidth;
          })
      });


  },
  finalize() {
  },
};
