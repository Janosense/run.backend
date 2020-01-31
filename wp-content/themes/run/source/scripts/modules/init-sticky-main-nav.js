const settings = {
  is_fixed: false,
};

const init_sticky_main_nav = () => {
  const header = document.querySelector('.header');
  const main_nav = document.querySelector('.main-nav');
  if (main_nav && document.documentElement.clientWidth > 767) {
    window.addEventListener('scroll', (evt) => {
      if (!settings.is_fixed && window.scrollY >= (main_nav.getBoundingClientRect().top + window.scrollY)) {
        main_nav.classList.add('main-nav--fixed');
        settings.is_fixed = true;
      } else if (settings.is_fixed && window.scrollY <= (header.getBoundingClientRect().bottom + window.scrollY)) {
        main_nav.classList.remove('main-nav--fixed');
        settings.is_fixed = false;
      }
    });
  }
};

export default init_sticky_main_nav;
