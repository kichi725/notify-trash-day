import './bootstrap';
// ↓https://blog.capilano-fw.com/?p=10747#_vuedistvueesm-bundler
import { createApp } from 'vue/dist/vue.esm-bundler';
// import { createApp } from 'vue';
import HelloVue from './components/HelloVue.vue';
import ButtonVue from './components/ButtonVue.vue';

const app = createApp({
    data() {
        return {
            buttonText: 'ボタンです',
        }
    },
    components: {
        'hello-vue': HelloVue,
        'button-vue': ButtonVue,
    }
});
console.log(app.version);
// app.component('hello-vue', HelloVue);
// app.component('button-vue', ButtonVue);
app.mount('#vue-app');
