import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import Icon from './Icons/Icon.vue'

createInertiaApp({
  resolve: name => {
    if(name.includes('/'))
    {

      let path = name.split('/');

      if(path.length == 2) return import(`./Pages/${path[0]}/${path[1]}.vue`);
      if(path.length == 3) return import(`./Pages/${path[0]}/${path[1]}/${path[2]}.vue`);

    } else {
      return import(`./Pages/${name}.vue`);
    }
  },
  
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin) 
      .component("Link", Link)
      .component("Icon", Icon)
      .mixin ({methods: { route }})
      .mount(el)
  },

  progress: {
    delay: 250, 
    color: '#000', 
    spinner: false, 
  },
}); 