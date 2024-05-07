<script setup>
import { Link } from '@inertiajs/vue3';
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
const props = defineProps({
    friends: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="main-left-aside-container">
        <Link href="/">
            <div class="item" :class="{ active: route().current() === 'index' }">
                <img src="/assets/svg/home.svg" alt="Icon" />
                <span>Inici</span>
                <span class="counter"></span>
            </div>
        </Link>


        <Link :href="route('friends.index')">
            <div class="item active">
                <img src="/assets/svg/following.svg" alt="Icon" />
                <span>Amics</span>
                <span class="counter">{{ authStore.user?.friends?.length }}</span>
            </div>
        </Link>

        <Link :href="route('messages.index')">
            <div class="item">
                <img src="/assets/svg/envelope.svg" alt="Icon" />
                <span>Missatges</span>
                <span class="counter">12</span>
            </div>
        </Link>
        
        <Link :href="route('notifications.index')">
            <div class="item">
                <img src="/assets/svg/bell.svg" alt="Icon" />
                <span>Notificacions</span>
                <div v-if="authStore.user">
                    <span
                        v-if="authStore.user.notifications.length > 0"
                    class="counter">{{ authStore.user.notifications.length  }}</span>
                </div>
            </div>
        </Link>
    </div>
</template>

<style scoped>
    .main-left-aside-container {
        background: #fff;
        height: 400px;
        width: 100%;
        border-radius: 20px;
        display: grid;
        height: fit-content;
        padding: 5px 5px;
        gap: 5px;
    }

    .counter {
        background: #cc4e00;
        filter: brightness(1.23);
        color: #fff;
        border-radius: 9999px;
        padding: 0 7px;
        height: fit-content;
        display: flex;
        align-items: center;
        width: fit-content;
        margin-left: auto;
    }

    .item.active .counter {
        background: #cc4e00;
        filter: brightness(1.23);
    }

    .item {
        display: grid;
        gap: 10px;
        grid-template-columns: 20px auto 60px;
        align-items: center;
        padding: 10px 20px;
        border-radius: 15px;
    }

    .item img {
        width: 20px;
        height: 20px;
    }

    .item:not(.active) img {
        filter: opacity(0.6);
    }

    .item:not(.active) span:not(.counter) {
        filter: opacity(0.6);
    }

    .item:hover {
        background: #f2f2f2;
        border-radius: 15px;
        cursor: pointer;
    }

    .item.active {
        background: #f2f2f2;
    }
</style>