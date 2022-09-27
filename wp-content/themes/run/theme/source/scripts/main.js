import device from 'current-device';
import init_sticky_main_nav from './modules/init-sticky-main-nav';
import toggle_main_nav from './modules/toggle-main-nav';
import init_glightbox from "./modules/init-glightbox";
import toggle_shoes_list from "./modules/toggle-shoes-list";

init_sticky_main_nav();
toggle_main_nav();
init_glightbox();
toggle_shoes_list();

fetch('https://teamfeed.feedingamerica.org/api/1.3/participants/10072?_=1664203236941')
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    console.log(data);
  });
