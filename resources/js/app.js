import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import Icons from './Pages/Components/ScalableVectorGraphics/Icons.vue'

createInertiaApp({
  resolve: name => {
    if(name.includes('/'))
    {

      let split = name.split('/');
      let subdir = split[0];
      let file = split[1];
      
      return import(`./Pages/${subdir}/${file}.vue`);

    } else {
      return import(`./Pages/${name}.vue`);
    }
  },
  
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin) 
      .component("Link", Link)
      .component("Icons", Icons)
      .mixin ({methods: { route }})
      .mount(el)
  },

  progress: {
    delay: 0, 
    color: '#000', 
    spinner: false, 
  },
}); 