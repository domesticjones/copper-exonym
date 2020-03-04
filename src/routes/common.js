export default {
  init() {
      window.addEventListener('resize', updateWindowDimensions);
      updateWindowDimensions();

      function updateWindowDimensions() {
          const html = document.documentElement;
          const navBarWrapper = document.querySelector('.navbarWrapper');
          const navLogo = document.getElementById('navbarLogo');

          if(window.innerWidth < 1000) {
              html.style.fontSize = '10px';
              navBarWrapper.innerHTML = '<nav class="navbar mobile">' +
                  '<a data-value="home" class="navitem mobile"><img src="' + navLogo.innerHTML + '" alt="copper" /></a>' +
                  '<div class="buttonAndNav">' +
                  '<a id="downloadOne" class="navitemButton button space">Download the App</a>' +
                  '<div class="navburger">\n' +
                  '  <span></span>\n' +
                  '  <span></span>\n' +
                  '  <span></span>\n' +
                  '  <span></span>\n' +
                  '</div>' +
                  '</div>' +
                  '</nav>' +
                  '<div class="absoluteMenu">' +
                  '<a data-value="features" class="navitem">Features</a>' +
                  '<a data-value="security" class="navitem">Safety &amp; Security</a>' +
                  '<a data-value="testimonials" class="navitem">Testimonials</a>' +
                  '<a data-value="faq" class="navitem">FAQ</a>' +
                  '</div>';
          }
          else {
              navBarWrapper.style.justifyContent = 'center';
              navBarWrapper.innerHTML = '<nav class="navbar">' +
                  '<a data-value="home" class="navitem space"><img src="' + navLogo.innerHTML + '" alt="copper" /></a>' +
                  '<a data-value="features" class="navitem">Features</a>' +
                  '<a data-value="security" class="navitem">Safety &amp; Security</a>' +
                  '<a data-value="testimonials" class="navitem">Testimonials</a>' +
                  '<a data-value="faq" class="navitem">FAQ</a>' +
                  '</nav>';
          }
          if(window.innerWidth < 1400) {
              html.style.fontSize = '12px';
          }

          addClickEvents();
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
          const mobileNav = document.querySelector('.navbar');

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
                  const targetId = e.currentTarget.dataset.value;
                  const target = document.querySelector(`#${targetId}`);
                  const scrollTargetPosition = target.offsetTop - 64;
                  const viewPort = document.querySelector('.content');

                  if(burger && mobileMenu && mobileNav && burger.classList.length === 2) {
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
      let scrollIncrement = 0;

      setInterval(() =>{
          const containerWidth = testimonialCarousel.clientWidth;
          let scrollAmount = 0;

          toggleDots();
          const slideTimer = setInterval(function(){
              if(scrollIncrement === 2) {
                  testimonialCarousel.scrollLeft -= 60;
                  scrollAmount += 60;

                  if(scrollAmount >= containerWidth * 3){
                      window.clearInterval(slideTimer);
                      incrementCount();
                  }
              }
              else {
                  testimonialCarousel.scrollLeft += 30;
                  scrollAmount += 30;

                  if(scrollAmount >= containerWidth){
                      window.clearInterval(slideTimer);
                      incrementCount();
                  }
              }

          }, 25);
      }, 8000);

      function incrementCount() {
          scrollIncrement = scrollIncrement === 2 ? 0 : scrollIncrement + 1;
      }

      function toggleDots() {
          const carouselDots = document.querySelectorAll('.dot');
          carouselDots[scrollIncrement].classList.toggle('active');

          if(scrollIncrement === 2)
              carouselDots[0].classList.toggle('active');
          else
              carouselDots[scrollIncrement + 1].classList.toggle('active');
      }


  },
  finalize() {
  },
};
