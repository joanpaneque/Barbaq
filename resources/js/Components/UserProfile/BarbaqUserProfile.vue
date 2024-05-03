<script setup>
import CreateBarbaqInput from "@/Components/CreateBarbaqInput/CreateBarbaqInput.vue";
import Barbecue from "../Index/Barbecue.vue";
import { useProfileStore } from "@/stores/profile";
import { useAuthStore } from "@/stores/auth";
const profileStore = useProfileStore();
const authStore = useAuthStore();
</script>

<template>
    <div class="barbaq-user-template">
        <div class="left">

            <div v-if="authStore.user && profileStore.user">
                <div v-if="authStore.user.id == profileStore.user.id">
                    <CreateBarbaqInput class="mt-5" />
                </div>
            </div>

            <Barbecue />
            
        </div>
        <div class="rigth mt-5">

        </div>
    </div>
</template>

<style scoped>
.barbaq-user-template {
    display: grid;
    grid-template-columns: auto 320px;
    gap: 20px;
}

.left {
    display: grid;
    gap: 20px;
}

.rigth {
    background-color: red;
}
</style>