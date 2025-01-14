<template>

    <div class="row mt-3">



        <div class="col-6 border rounded-3">
            <h3>Добавить автомобиль</h3>
            <div>
                <GeneralAutoCompleteComponent
                    ref="generalAutoComplete"
                    @getBrand="setBrand"
                    @getModel="setModel"
                ></GeneralAutoCompleteComponent>

                <DropzoneComponent ref="dropzone" @image-uploaded="getImageId"></DropzoneComponent>

                <div class="mb-3">
                    <label for="colorCarInput" class="form-label">Цвет автомобиля</label>
                    <input type="text" class="form-control" id="colorCarInput"
                           v-model="color_of_carcass">
                    <div v-if="error.color_of_carcass" class="text-danger mt-1">{{ error.color_of_carcass[0] }}</div>
                </div>
                <div class="mb-3">
                    <label for="gosNumberInput" class="form-label">Государственный номер</label>
                    <imask-input
                        v-model="gos_number"
                        :mask="'a000aa00'"
                        :definitions="{
                            'a': /[АВЕКМНОРСТУХABEKMHOPCTYX]/
                        }"
                        :lazy="true"
                        :prepare="prepareInput"
                        class="form-control"
                        id="gosNumberInput"
                        name="gos_number"
                    />
                    <div v-if="error.gos_number" class="text-danger mt-1">{{ error.gos_number[0] }}</div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="car_is_on_parking" value="1"
                               name="is_on_parking_now"
                               v-model="isOnParking">
                        <label class="form-check-label" for="car_is_on_parking">Машина на парковке</label>
                    </div>
                </div>

            </div>
        </div>
        <div class="col align-self-end">
            <div>
                <button @click.prevent="storeCar" class="btn btn-primary mb-3">Добавить машину</button>
            </div>
        </div>


    </div>

</template>

<script>
import {IMaskComponent} from 'vue-imask';
import axios from "axios";
import DropzoneComponent from "@/components/DropzoneComponent.vue";
import GeneralAutoCompleteComponent from "@/components/GeneralAutoCompleteComponent.vue";

export default {
    name: 'CarAddingComponent',
    props: {
      currentClientId: {
          type: Number,
          required: true
      }
    },
    components: {
        GeneralAutoCompleteComponent,
        DropzoneComponent,
        'imask-input': IMaskComponent,
    },
    mounted() {
        this.isOnParking = this.is_on_parking_now === 1;
        this.$refs.generalAutoComplete.$refs.brandAutoComplete.setValue(this.brand)
        this.$refs.generalAutoComplete.$refs.modelAutoComplete.setValue(this.model)
    },
    data() {
        return {
            error: {},
            currentImageId: null,
            isOnParking: false,
            model: '',
            brand: '',
            color_of_carcass: '',
            gos_number: '',
        }
    },
    methods: {
        async storeCar() {
            try {
                await axios.post(`api/create/car/${this.currentClientId}`, {
                    'brand': this.brand,
                    'model': this.model,
                    'color_of_carcass': this.color_of_carcass,
                    'gos_number': this.gos_number,
                    'is_on_parking_now': this.isOnParking,
                    'hiddenImageId': this.currentImageId
                })
                window.location.reload();
            } catch (error) {
                console.error(error)
                this.error = error.response.data.errors;
            }
        },

        getImageId(imageId) {
            this.currentImageId = imageId
        },

        prepareInput(str) {
            return str.toUpperCase();
        },
        setBrand(brand) {
            this.brand = brand
        },
        setModel(model) {
            this.model = model
        }
    }
}

</script>
