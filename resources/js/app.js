import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Autocomplete from "./components/AutocompleteComponent.vue";
import ModelDropdownComponent from "./components/ModelDropdownComponent.vue";
import CommonAutoCompleteComponent from "./components/CommonAutoCompleteComponent.vue";


app.component('auto-compete', Autocomplete)
app.component('example-component', ExampleComponent);
app.component('model-dropdown', ModelDropdownComponent)
app.component('car-brand-auto-complete', CommonAutoCompleteComponent)


app.mount('#app');
