<script setup>
import { useAuthStore } from "@/stores/auth";
import NotificationsDiv from "@/Components/Notifications/NotificationsDiv.vue";
import ProfileLayout from "@/Layouts/ProfileLayout.vue";


const authStore = useAuthStore();
authStore.updateUserData();

</script>

<template>
    <ProfileLayout title="Notificacions" >
        <template #main-content >
            <NotificationsDiv />
        </template>
    </ProfileLayout>
</template>

<style scoped></style>