<template>

    <div class="row mt-3">

        <template v-if="car.image_id != null">
            <div class=" col align-self-center border rounded-3 p-3">
                <img :src="car.preview_url" alt="">
                <div class="d-flex justify-content-center mt-3">
                    <button @click.prevent="deleteImage" class="btn btn-danger mb-3 center">Удалить картинку</button>
                </div>
            </div>
        </template>

        <template v-if="isShowDropzone">
            <div class=" col align-self-center border rounded-3">
                <DropzoneComponent ref="dropzone" @image-uploaded="getImageId"></DropzoneComponent>
            </div>
        </template>

        <div class="col-6 border rounded-3">
            <h3>Автомобиль</h3>
            <div>

                <GeneralAutoCompleteComponent
                    ref="generalAutoComplete"
                    @getBrand="setBrand"
                    @getModel="setModel"
                ></GeneralAutoCompleteComponent>

                <div class="mb-3">
                    <label for="colorCarInput" class="form-label">Цвет автомобиля</label>
                    <input type="text" class="form-control" id="colorCarInput"
                           v-model="car.color_of_carcass">
                    <div v-if="error.color_of_carcass" class="text-danger mt-1">{{ error.color_of_carcass[0] }}</div>
                </div>
                <div class="mb-3">
                    <label for="gosNumberInput" class="form-label">Государственный номер</label>
                    <imask-input
                        v-model="car.gos_number"
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

            <div v-if="!this.isShowDropzone && this.car.image_id == null">
                <button @click.prevent="showDropzone" class="btn btn-info mb-3">Добавить картинку</button>
            </div>
            <div>
                <button @click.prevent="updateCar" class="btn btn-primary mb-3">Сохранить изменения</button>
            </div>
            <div>
                <button @click.prevent="deleteCar" class="btn btn-danger mb-3">Удалить машину</button>
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
    name: 'CarEditComponent',
    props: {
        'carData': {
            type: Object,
            required: true
        }
    },
    components: {
        GeneralAutoCompleteComponent,
        DropzoneComponent,
        'imask-input': IMaskComponent,
    },
    mounted() {
        this.isOnParking = this.car.is_on_parking_now === 1;
        this.$refs.generalAutoComplete.$refs.brandAutoComplete.setValue(this.car.brand)
        this.$refs.generalAutoComplete.$refs.modelAutoComplete.setValue(this.car.model)
    },
    data() {
        return {
            car: {...this.carData},
            error: {},
            isShowDropzone: false,
            currentImageId: null,
            isOnParking: false,
        }
    },
    methods: {
        async updateCar() {
            try {
                await axios.patch(`api/update/car/${this.car.car_id}`, {
                    'brand': this.car.brand,
                    'model': this.car.model,
                    'color_of_carcass': this.car.color_of_carcass,
                    'gos_number': this.car.gos_number,
                    'is_on_parking_now': this.isOnParking,
                    'hiddenImageId': this.currentImageId
                })
                window.location.reload();
            } catch (error) {
                console.error(error)
                this.error = error.response.data.errors;
            }
        },
        async deleteCar() {
            try {
                await axios.delete(`api/delete/car/${this.car.car_id}`)
                window.location.href = '/';
            } catch (error) {
                console.error(error)
            }
        },
        showDropzone() {
            this.isShowDropzone = true;
        },
        getImageId(imageId) {
            this.currentImageId = imageId
        },
        async deleteImage() {
            try {
                await axios.delete(`api/image/delete/${this.car.image_id}`)
                window.location.reload();
            } catch (error) {
                console.error(error)
            }
        },
        prepareInput(str) {
            return str.toUpperCase();
        },
        setBrand(brand) {
            this.car.brand = brand
        },
        setModel(model) {
            this.car.model = model
        }
    }
}

</script>
