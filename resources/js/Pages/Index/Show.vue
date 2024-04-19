<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DivBarbacoa from "@/Components/Index/DadesBarbacoa.vue";
</script>

<template>
    <MainLayout title="Inici">
        <template #main-content>
            <DivBarbacoa />
        </template>
        <template #right-aside>
            <div class="aside-menu">
                
            </div>
        </template>
    </MainLayout>
</template>

<style scoped>
    .aside-menu {
        width: 100%;
        height: 400px;
        background: white;
        border-radius: 20px;
    }
</style>