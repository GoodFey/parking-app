<template>
    <div class="col-6 border rounded-3">
        <h3>Клиент</h3>
        <div>
            <div class="mb-3">
                <label for="fioInput" class="form-label">ФИО</label>
                <input type="text" class="form-control" id="fioInput" name="fio"
                       placeholder="Обязательное поле" v-model="client.fio"/>
                <div v-if="error.fio" class="text-danger mt-1">{{ error.fio[0] }}</div>
            </div>
            <div class="mb-3">
                <label for="phoneNumInput" class="form-label">Номер телефона</label>
                <imask-input
                    v-model="client.phone_number"
                    :mask="'+{7} (000) 000-00-00'"
                    class="form-control"
                    id="phoneNumInput"
                    placeholder="+7 (___) ___-__-__"
                />
                <div v-if="error.phone_number" class="text-danger mt-1">{{ error.phone_number[0] }}</div>
            </div>
            <div class="mb-3">
                <label for="addressInput" class="form-label">Адрес</label>
                <input v-model="client.address" type="text" class="form-control" id="addressInput"/>
                <div v-if="error.address" class="text-danger mt-1">{{ error.address[0] }}</div>
            </div>
            <div class="mb-3">
                <label for="genderInput" class="form-label">Пол</label>
                <select v-model="client.gender" class="form-select" id="genderInput">
                    <option value="1">Мужчина</option>
                    <option value="0">Женщина</option>
                </select>
                <div v-if="error.gender" class="text-danger mt-1">{{ error.gender[0] }}</div>
            </div>
        </div>
    </div>
    <div class="col align-self-end">
        <div>
            <button @click.prevent="updateClient" class="btn btn-primary mb-3">Сохранить изменения</button>
        </div>
        <div>
            <button @click.prevent="deleteClient" class="btn btn-danger mb-3">Удалить клиента</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { IMaskComponent } from 'vue-imask';

export default {
    name: 'ClientEditComponent',
    props: {
        'clientData': {
            type: Object,
            required: true
        }
    },
    components: {
        'imask-input': IMaskComponent,
    },
    data() {
        return {
            client: {...this.clientData},
            error: {}
        }
    },
    methods: {
        async updateClient() {
            try {
                await axios.patch(`api/clients/edit/${this.client.id}`, {
                    'fio': this.client.fio,
                    'gender': this.client.gender,
                    'phone_number': this.client.phone_number,
                    'address': this.client.address,
                })
                window.location.reload();
            } catch (error) {
                console.error(error)
                this.error = error.response.data.errors;
            }
        },

        async deleteClient() {
            try {
                await axios.delete(`api/clients/delete/${this.client.id}`)
                window.location.href = '/';
            } catch (error) {
                console.error(error)
            }
        }
    },
    mounted() {

    }
}
</script>
