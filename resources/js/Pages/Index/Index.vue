<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DivBarbacoa from "@/Components/Index/DadesBarbacoa.vue";
import CreateBarbaqInput from "@/Components/CreateBarbaqInput/CreateBarbaqInput.vue";
import { useAuthStore } from "@/stores/auth";
import IndexRightAside from "@/Components/Asides/IndexRightAside.vue";

const authStore = useAuthStore();
authStore.updateUserData();

</script>

<template>

    <MainLayout title="Inici">
        <template #main-content>


            <CreateBarbaqInput />

            <DivBarbacoa class="mt-5"/>

           

        </template>
        <template #right-aside>
            <IndexRightAside />
        </template>
    </MainLayout>
</template>

<style scoped>

</style>