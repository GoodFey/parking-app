<template>

    <ClientEditComponent :client-data="client"
    ></ClientEditComponent>

    <template v-for="car in cars">
        <CarEditComponent :car-data="car"></CarEditComponent>
    </template>

    <CarAddingComponent :currentClientId="client.id"></CarAddingComponent>


</template>
<script>
import ClientEditComponent from "@/components/ClientEditComponent.vue";
import CarEditComponent from "@/components/CarEditComponent.vue";
import CarAddingComponent from "@/components/CarAddingComponent.vue";

export default {
    props: {
        client: {
            type: Object,
            required: true
        },
        cars: {
            type: Object,
            required: true
        },
    },
    components: {
        CarAddingComponent,
        ClientEditComponent,
        CarEditComponent

    },
    mounted() {

    }

}
</script>
