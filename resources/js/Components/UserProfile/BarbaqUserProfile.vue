<script setup>
import CreateBarbaqInput from "@/Components/CreateBarbaqInput/CreateBarbaqInput.vue";
import PrivateUserProfile from "@/Components/PrivateUserProfile/PrivateUserProfile.vue";

import Barbecue from "@/Components/Index/Barbecue.vue";
import { useProfileStore } from "@/stores/profile";
import { useAuthStore } from "@/stores/auth";
const profileStore = useProfileStore();
const authStore = useAuthStore();
</script>

<template>

    <div class="barbaq-user-template">
        <div class="left mt-5">

            <div v-if="authStore.user && profileStore.user">
                
                <PrivateUserProfile
                    v-if="authStore.user.id != profileStore.user.id 
                    && profileStore.user.public == 0 
                    && profileStore.friendStatus != 'friend'" 
                />

                <div
                    v-if="authStore.user.id != profileStore.user.id 
                    && profileStore.user.public == 1"
                >
                    <div v-for="barbecue in profileStore.user.barbecues">
                        <Barbecue :barbecue="barbecue" class="mb-5"/>
                    </div>
                </div>
            </div>

            <div v-if="authStore.user && profileStore.user">
                <div v-if="authStore.user.id == profileStore.user.id">
                    <CreateBarbaqInput class="" />
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