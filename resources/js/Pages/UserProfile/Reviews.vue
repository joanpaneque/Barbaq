<script setup>
import ProfileLayout from "@/Layouts/ProfileLayout.vue";
import BarbaqUserProfile from "@/Components/UserProfile/BarbaqUserProfile.vue";
import { defineProps } from "vue";
import { useProfileStore } from "@/stores/profile";
import { useAuthStore } from "@/stores/auth";
import MainLayout from "@/Layouts/MainLayout.vue";

const authStore = useAuthStore();
authStore.updateUserData();

const profileStore = useProfileStore();

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    friendStatus: {
        type: String,
        required: false
    }
});

profileStore.setUser(props.user);
profileStore.setStatus(props.friendStatus);
</script>

<template>
    <MainLayout title="Valoracions">
        <template #main-content>
            <div class="container mx-auto px-4 md:px-12">
                {{ profileStore.user }}
                <div class="flex flex-wrap -mx-1 lg:-mx-4">
                    <div class="my-1 w-full md:w-auto  lg:px-4 lg:w-auto bg-white rounded-[10px]">
                        <div class="title flex items-center justify-left p-4 gap-2">
                            <img src="/assets/img/emma.jpg" alt="Emma"
                                class="w-12 h-12 rounded-full fit-content object-cover">
                            <p class="font-bold ">
                                Emma Cardosa
                            </p>
                        </div>
                        <div class="rating pl-4">
                            <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                            <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                            <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                            <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                        </div>

                        <p class="p-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec purus
                            ultricies, ultricies nunc nec, tincidunt nunc. Nullam nec purus ultricies,
                            ultricies nunc nec, tincidunt nunc.
                        </p>
                    </div>
                </div>
            </div>
        </template>
    </MainLayout>
</template>

<style scoped></style>