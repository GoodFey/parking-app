import './bootstrap';
import {createApp} from 'vue';

import Autocomplete from "./components/AutocompleteComponent.vue";
import ModelDropdownComponent from "./components/ModelDropdownComponent.vue";
import CommonAutoCompleteComponent from "./components/GeneralAutoCompleteComponent.vue";
import DropzoneComponent from "./components/DropzoneComponent.vue";

import GeneralEditComponent from "./components/GeneralEditComponent.vue";


const app = createApp({});


app.component('auto-compete', Autocomplete)

app.component('model-dropdown', ModelDropdownComponent)
app.component('car-brand-auto-complete', CommonAutoCompleteComponent)
app.component('dropzone-component', DropzoneComponent)
app.component('general-edit-component', GeneralEditComponent)

app.mount('#app');

