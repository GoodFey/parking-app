<template>
    <div>
        <search-autocomplete
            :isAsync="true"
            @select="setBrand"
            ref="brandAutoComplete"
        />
        <model-dropdown
            :selectedBrand="selectedBrand"
            @select="setModel"
            ref="modelAutoComplete"
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
            this.$emit('getBrand', brand)
        },
        setModel(model) {
            this.selectedModel = model;
            console.log(`Selected: ${this.selectedBrand} - ${this.selectedModel}`);
            this.$emit('getModel', model)
        },
    },
    mounted() {

    }
};
</script>
