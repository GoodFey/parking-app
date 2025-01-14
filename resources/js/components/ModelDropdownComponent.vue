<template>
    <div class="autocomplete mb-3">
        <label for="modelCarInput" class="form-label mt-3">Модель автомобиля</label>
        <input
            type="text"
            v-model="search"
            class="form-control"
            name="model"
            placeholder="Введите модель"
            @input="onInput"
            @focus="onFocus"
            @blur="onBlur"
        />
        <ul
            id="autocomplete-results"
            v-show="isOpen && filteredModels.length"
            class="autocomplete-results"
        >
            <li
                v-for="(model, i) in filteredModels"
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
            required: true, // Теперь поле обязательно, так как оно критично для фильтрации
        },
    },
    data() {
        return {
            models: [], // Полный список моделей для бренда
            search: '',
            isOpen: false,
        };
    },
    computed: {
        filteredModels() {
            // Фильтруем модели в зависимости от введённого текста
            console.log('Filtering models with search:', this.search);
            return this.models.filter((model) =>
                model.toLowerCase().includes(this.search.toLowerCase())
            );
        },
    },
    watch: {
        selectedBrand: {
            immediate: true,
            handler(newBrand) {
                console.log('selectedBrand changed:', newBrand);
                if (newBrand) {
                    this.loadModels(newBrand);
                } else {
                    this.models = [];
                }
            },
        },
    },
    methods: {
        async loadModels(brand) {
            console.log('Loading models for brand:', brand);
            try {
                const response = await fetch(
                    `/api/cars-models/${encodeURIComponent(brand)}`
                );
                const data = await response.json();
                console.log('Models loaded:', data);
                this.models = data;
            } catch (error) {
                console.error('Error fetching models:', error);
            }
        },
        onInput() {
            console.log('Input event triggered with value:', this.search);
            this.isOpen = true; // Открываем список при вводе текста
        },
        onFocus() {
            console.log('Input field focused');
            this.isOpen = true;
        },
        onBlur() {
            console.log('Input field blurred');
            this.$emit('select', this.search); // Эмитим выбранную модель
            // Закрываем список с небольшой задержкой, чтобы успел сработать @click
            setTimeout(() => {
                this.isOpen = false;
                console.log('Dropdown closed after blur');
            }, 200);


        },
        setModel(model) {
            console.log('Model selected:', model);
            this.search = model; // Устанавливаем выбранную модель в поле
            this.isOpen = false; // Закрываем список
            this.$emit('select', model); // Эмитим выбранную модель
        },
        setValue(value) {
            this.search = value
        }
    },
};
</script>

<style scoped>
.autocomplete-results {
    list-style: none;
    margin: 0;
    padding: 0;
    border: 1px solid #ccc;
    background: #fff;
    position: absolute;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
}

.autocomplete-result {
    padding: 8px 12px;
    cursor: pointer;
}

.autocomplete-result:hover {
    background: #f0f0f0;
}
</style>
