<script setup>
import { defineProps, ref } from 'vue';
import { computed } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { useProfileStore } from "@/stores/profile";
const profileStore = useProfileStore();


const usersToShow = ref(5)
const showMoreUsers = () => {
    usersToShow.value = usersToShow.value === 10 ? 5 : usersToShow.value + 5
}
const buttonText = computed(() => usersToShow.value === 10 ? 'Mostrar menys' : 'Mostrar més')

const form = useForm({
    id: '',
});

const sendFriendRequest = (user_id) => {
    form.post(route('sendfriendrequest', user_id));
    profileStore.friendStatus = 'sent';
}
</script>

<template>

    <span class="text-xl text-gray-800 dark:text-white font-bold">Gent a prop teu</span>
    <div class="flex items-center  gap-2 bg-white p-1 rounded-xl mb-2 w-full mt-2 justify-between"
        v-for="(user, index) in $page.props.filteredUsers.slice(0, usersToShow)" :key="index">
        <div class="flex flex-row items-center gap-2">
            <Link :href="`/profile/${user.id}`">
            <img :src="user.image" alt="profile image" class="fit-content h-10 w-10 rounded-full object-cover">
            </Link>
            <Link :href="`/profile/${user.id}`">
            <div class="flex flex-row items-center gap-1 w-full">
                <p>{{ user.name }}</p>
                <p>{{ user.surnames }}</p>
            </div>
            </Link>
        </div>
        <div class="flex justify-end">
            <form class="flex items-center pr-1" @submit.prevent="sendFriendRequest(user.id)">
                <button title="Add New" class="group cursor-pointer outline-none hover:rotate-90 duration-300"
                    type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24"
                        class="stroke-orange-400 fill-none group-hover:fill-orange-800 group-active:stroke-orange-200 group-active:fill-orange-600 group-active:duration-0 duration-300">
                        <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                            stroke-width="1.5"></path>
                        <path d="M8 12H16" stroke-width="1.5"></path>
                        <path d="M12 16V8" stroke-width="1.5"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>



    <div class="people-nearby text-center">
        <button @click="showMoreUsers">
            <span class="text-gray-800 font-bold hover:text-orange-400 transition duration-300">{{ buttonText }}</span>
        </button>
    </div>
</template>

<style scoped></style>
