<script setup>
    import MainLayout from "@/Layouts/MainLayout.vue";
    import Chat from "@/Components/Barbecues/Chat.vue"; 
    import BarbacuesAside from "@/Components/Barbecues/BarbacuesAside.vue";
</script>

<template>
    <MainLayout title="Inici">
        <template #main-content>
            <Chat />
        </template>
        <template #right-aside>
            <div class="aside-menu">
                <BarbacuesAside />
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