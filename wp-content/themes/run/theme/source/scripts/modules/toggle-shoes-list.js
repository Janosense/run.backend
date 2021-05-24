const toggle_shoes_list = () => {
  const toggle = document.querySelector('.aside__sneakers-toggle');
  const shoes_list = document.querySelector('.sneakers--not-used');

  if (toggle && shoes_list) {
    toggle.addEventListener('click', () => {
      shoes_list.classList.toggle('sneakers--active');

      if (shoes_list.classList.contains('sneakers--active')) {
        toggle.textContent = 'Скрыть';
      } else {
        toggle.textContent = 'Неиспользуемые';
      }
    });
  }
}

export default  toggle_shoes_list;
