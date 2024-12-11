<template>

    <div class="autocomplete">
        <label for="brandCarInput" class="form-label mt-3">Модель автомобиля</label>
        <input
            type="text"
            v-model="search"
            class="form-control"
            name="model"

            @focus="loadModels"
        />
        <ul
            id="autocomplete-results"
            v-show="isOpen"
            class="autocomplete-results"
        >
            <li
                v-for="(model, i) in models"
                :key="i"
                @click="setModel(model)"
                class="autocomplete-result"
            >
                {{ model }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'ModelDropdown',
    props: {
        selectedBrand: {
            type: String,
            required: false,
        },
    },
    data() {
        return {
            models: [],
            search: '',
            isOpen: false,
        };
    },
    methods: {
        async loadModels() {
            if (!this.selectedBrand) return;

            try {
                const response = await fetch(
                    `/api/cars-models/${encodeURIComponent(this.selectedBrand)}`
                );

                console.log(response)
                const data = await response.json();
                this.models = data;
                this.isOpen = true;
            } catch (error) {
                console.error('Error fetching models:', error);
            }
        },
        setModel(model) {
            this.search = model;
            this.isOpen = false;
            this.$emit('select', model); // Эмитим событие выбора модели
        },
    },
};
</script>


<style scoped>

</style>
