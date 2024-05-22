<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Chat from "@/Components/Barbecues/Chat.vue";
import NoAuthBBQ from "@/Components/Barbecues/NoAuthBBQ.vue";
import BarbacuesAside from "@/Components/Barbecues/BarbacuesAside.vue";
import { defineProps } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useBarbecueStore } from "@/stores/barbecue";
const authStore = useAuthStore();
authStore.updateUserData();

const props = defineProps({
    barbecue: {
        type: Object,
        required: true
    },
    friends: {
        type: Object,
        required: true,
    },
});

const barbecueStore = useBarbecueStore();
barbecueStore.setBarbecue(props.barbecue);

</script>

<template>
    <MainLayout :title="barbecue.title">
        <template #main-content>
            <Chat v-if="authStore.user && (props.barbecue.members.map(member => member.id).includes(authStore.user.id) || authStore.user.id === props.barbecue.user_id)" />
            <NoAuthBBQ v-else />
        </template>
        <template #right-aside>
            <div class="aside-menu">
                <BarbacuesAside :friends="friends" :barbecue="barbecue" />
            </div>
        </template>
    </MainLayout>
</template>

<style scoped>
.aside-menu {
    width: 100%;
    height: max-content;
    background: white;
    border-radius: 20px;
}
</style>