<template>

    <div ref="dropzone" class="mt-3 btn d-block bg-dark p-5 text-center text-light">
        Upload
    </div>
    <!--    <input type="text" v-model="value" placeholder="Введите значение из Vue">-->
        <input type="hidden" ref="hiddenInput" :value="value" name="hiddenImageId">

</template>

<script>
import Dropzone from 'dropzone'


export default {
    name: "DropzoneComponent",
    data() {
        return {
            dropzone: null,
            image: null,
            value: '',
            currentImageId: ''
        }
    },

    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: "/api/image/store/",
            autoProcessQueue: true,
            addRemoveLinks: true,
            maxFiles: 1,
            success: (file, response) => {
                this.currentImageId = response['imageId']
                this.$refs.hiddenInput.value = response['imageId']
            },
            removedfile: (file) => {
                file.previewElement.remove()
                this.delete()
            }
        })
    },

    methods: {
        async delete() {
            await axios.delete(`api/image/delete/${this.currentImageId}`)
        }
    }
}
</script>


<style>

.dz-success-mark,
.dz-error-mark {
    display: none
}

</style>
