<script setup>
    import ProfileLayout from "@/Layouts/ProfileLayout.vue";
    import BarbaqUserProfile from "@/Components/UserProfile/BarbaqUserProfile.vue";
    import { defineProps } from "vue";
    import { useProfileStore } from "@/stores/profile";
    import { useAuthStore } from "@/stores/auth";

    const authStore = useAuthStore();
    authStore.updateUserData();

    const profileStore = useProfileStore();

    const props = defineProps({
        user: {
            type: Object,
            required: true
        }
    });

    profileStore.setUser(props.user);

</script>

<template>
    <ProfileLayout title="Inici" :user="user">
        <template #main-content >
            <BarbaqUserProfile />
        </template>
    </ProfileLayout>
</template>

<style scoped>
    .aside-menu {
        width: 100%;
        height: 400px;
        background: white;
        border-radius: 20px;
    }

    .banner-profile{
        padding-bottom: 20px;
    }
    
</style>