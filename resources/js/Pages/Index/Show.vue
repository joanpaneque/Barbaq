<script setup>
    import MainLayout from "@/Layouts/MainLayout.vue";
    import CreateBarbaqInput from "@/Components/CreateBarbaqInput/CreateBarbaqInput.vue";
</script>

<template>
    <MainLayout title="Inici">
        <template #main-content>
            <CreateBarbaqInput />
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