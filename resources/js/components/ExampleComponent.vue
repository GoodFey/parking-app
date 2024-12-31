<template>
    <div class="autocomplete">
        <input
            type="text"
            @input="onChange"
            v-model="search"
            @blur="onBlur"
            class="form-control"
            name="brand"
        />
        <ul
            id="autocomplete-results"
            v-show="isOpen"
            class="autocomplete-results"
        >
            <li
                class="loading"
                v-if="isLoading"
            >
                Loading results...
            </li>
            <li
                v-else
                v-for="(result, i) in results"
                :key="i"
                @click="setResult(result)"
                class="autocomplete-result"
                :class="{ 'is-active': i === arrowCounter }"
            >
                {{ result }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'SearchAutocomplete',
    props: {
        items: {
            type: Array,
            required: false,
            default: () => [],
        },
        isAsync: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    data() {
        return {
            isOpen: false,
            results: [],
            search: '',
            isLoading: false,
            arrowCounter: -1,
        };
    },
    watch: {
        items: function (value, oldValue) {
            if (value.length !== oldValue.length) {
                this.results = value;
                this.isLoading = false;
            }
        },
    },
    mounted() {
        document.addEventListener('click', this.handleClickOutside)
    },
    destroyed() {
        document.removeEventListener('click', this.handleClickOutside)
    },
    methods: {
        onBlur() {
            this.emitBrand();
        },
        setResult(result) {
            this.search = result;
            this.isOpen = false;
            this.$emit('select', result);
        },
        filterResults() {
            this.results = this.items.filter((item) => {
                return item.toLowerCase().indexOf(this.search.toLowerCase()) > -1;
            });
        },
        onChange() {
            this.$emit('input', this.search);

            console.log(this.search);

            if (this.isAsync) {
                this.isLoading = true;
                this.fetchResults(this.search)
            } else {
                this.filterResults();
                this.isOpen = true;
            }
        },
        handleClickOutside(event) {
            if (!this.$el.contains(event.target)) {
                this.isOpen = false;
                this.arrowCounter = -1;
            }
        },

        async fetchResults(query) {

            try {
                // Отправляем запрос к серверу
                const response = await fetch(`/api/cars-brands/${encodeURIComponent(query)}`);
                const data = await response.json();

                // Обновляем результаты
                this.results = data;
                console.log(this.results)
                this.isOpen = true;
            } catch (error) {
                console.error('Error fetching results:', error);
            } finally {
                this.isLoading = false;
            }
        },
        emitBrand() {
            this.$emit('select', this.search.trim())
        }

    },
};
</script>

<style>
.autocomplete {
    position: relative;
}

.autocomplete-results {
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
    height: 120px;
    overflow: auto;
}

.autocomplete-result {
    list-style: none;
    text-align: left;
    padding: 4px 2px;
    cursor: pointer;
}

.autocomplete-result.is-active,
.autocomplete-result:hover {
    background-color: #0d6efd;
    color: white;
}
</style>
