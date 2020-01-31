const toggle_main_nav = () => {
  const toggle = document.querySelector('.main-nav-toggle');
  const main_nav = document.querySelector('.main-nav');

  if (toggle && main_nav) {
    toggle.addEventListener('click', (evt) => {
      evt.currentTarget.classList.toggle('main-nav-toggle--active');
      main_nav.classList.toggle('main-nav--active');
    });
  }
};

export default toggle_main_nav;
