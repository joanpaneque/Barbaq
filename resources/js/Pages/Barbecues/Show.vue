<script setup>
    import MainLayout from "@/Layouts/MainLayout.vue";
    import Chat from "@/Components/Barbecues/Chat.vue"; 
    import BarbacuesAside from "@/Components/Barbecues/BarbacuesAside.vue";
    import { defineProps } from "vue";
    import { useAuthStore } from "@/stores/auth";
    import { useBarbecueStore } from "@/stores/barbecue";

    const props = defineProps({
        barbecue: {
            type: Object,
            required: true
        }
    });

    const authStore = useAuthStore();
    const barbecueStore = useBarbecueStore();
    authStore.updateUserData();
    barbecueStore.setBarbecue(props.barbecue);

    console.log(barbecueStore.barbecue);

</script>

<template>
    <MainLayout :title="barbecue.title">
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