import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

createInertiaApp({
  resolve: name => import(`./Pages/${name}.vue`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
}); 

let navOptions = {
  root: document.querySelector("section__hero"),
  rootMargin: '100px',
  threshold: 0.5
}

  const bodyObserver = new IntersectionObserver(function (entries, bodyObserver) {
    entries.forEach((entry) => {
    
    });
  }, navOptions);

  bodyObserver.observe(document.querySelector("body"));
