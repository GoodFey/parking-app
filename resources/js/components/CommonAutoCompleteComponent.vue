<template>
    <div>
        <search-autocomplete
            :isAsync="true"
            @select="setBrand"
        />
        <model-dropdown
            :selectedBrand="selectedBrand"
            @select="setModel"
        />
    </div>
</template>

<script>
import SearchAutocomplete from './AutocompleteComponent.vue';
import ModelDropdown from './ModelDropdownComponent.vue';

export default {
    components: { SearchAutocomplete, ModelDropdown },
    data() {
        return {
            selectedBrand: '',
            selectedModel: '',
        };
    },
    methods: {
        setBrand(brand) {
            this.selectedBrand = brand;
            this.selectedModel = ''; // Сбрасываем выбранную модель
        },
        setModel(model) {
            this.selectedModel = model;
            console.log(`Selected: ${this.selectedBrand} - ${this.selectedModel}`);
        },
    },
};
</script>
