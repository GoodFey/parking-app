import './bootstrap';
import { createApp } from 'vue';



const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Autocomplete from "./components/AutocompleteComponent.vue";

app.component('auto-compete', Autocomplete)
app.component('example-component', ExampleComponent);


app.mount('#app');
