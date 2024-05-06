<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useAuthStore } from "@/stores/auth";
import { Head, Link } from '@inertiajs/vue3';
const authStore = useAuthStore();
authStore.updateUserData();

const props = defineProps({
    friends: {
        type: Array,
        required: true,
    },
});

function searchFriends(searchTerm) {
    const friendCards = document.querySelectorAll('.friend-card');

    friendCards.forEach(card => {
        const friendName = card.querySelector('.font-medium').textContent.toLowerCase();
        const startsWithSearchTerm = friendName.toLowerCase().startsWith(searchTerm.toLowerCase());
        card.style.display = startsWithSearchTerm ? 'block' : 'none';
    });
}

function handleSearchInput() {
    const searchInput = document.getElementById('search-input');
    const searchTerm = searchInput.value.trim();
    searchFriends(searchTerm);
}

document.addEventListener('input', event => {
    if (event.target && event.target.id === 'search-input') {
        handleSearchInput();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    handleSearchInput();
});
</script>

<template>
    <MainLayout title="Inici">
        <template #main-content>
            <div class="form-control">
                <input id="search-input" type="text" placeholder="Buscar amics..."
                    class="input rounded-2xl input-bordered w-24 md:w-auto" />
            </div>
            <div class="grid grid-friends">
                <div v-for="friend in friends" :key="friend.id"
                    class="friend-card w-40 bg-white border border-gray-200 rounded-2xl dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-2 pt-3">
                    </div>
                    <div class="flex flex-col items-center pb-5">
                        <Link :href="'/profile/' + friend.id">
                        <div class="flex flex-col items-center">
                            <img class="UserImage w-32 h-32 mb-3 rounded-full shadow-lg" :src="friend.image"
                                alt="User Image" />
                            <h5 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ friend.name }}</h5>
                        </div>
                        </Link>
                        <div class="flex items-center">
                            <button
                                class="enviar inline-flex items-center bg-gray-800 hover:bg-gray-900 px-2 py-1 text-sm font-medium text-center text-white rounded-xl">Enviar
                                missatge</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-4">
                <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >
                    Mostrar més
                </button>
            </div>
        </template>
        <template #right-aside>
            <div class="aside-menu">
                <span class="text-2xl text-gray-800 dark:text-white font-bold">Gent a prop teu</span>
                <div v-for="friend in friends" :key="friend.id"
                    class="flex aside-friend">
                    <img class="ImageUser w-12 h-12 rounded-full shadow-lg" :src="friend.image" alt="User Image" />
                    <div class="flex">
                        <span class="user text-base text-gray-800 dark:text-white p-2.5">{{ friend.name }} {{
                            friend.surnames }}</span>
                    </div>
                    <div class="plus flex items-center">
                        <button class="w-8 h-8 rounded-full border-transparent hover:bg-gray-300">
                            <img src="assets/img/plus.png">
                        </button>
                    </div>
                </div>
                <div class="people-nearby text-center">
                    <button>
                        <span class="text-lg text-gray-800 dark:text-white font-bold">Mostrar més</span>
                    </button>
                </div>
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
    padding: 26px 30px;
}

.grid-friends {
    grid-template-columns: repeat(auto-fit, minmax(9rem, 1fr));
    gap: 20px;
    padding: 15px 0px;
}

.friend-card {
    width: 100%;
}

.aside-friend {
    align-items: center;
    padding: 5px 0px;
}

.UserImage {
    object-fit: cover;
}

.ImageUser {
    object-fit: cover;
}
.plus {
    margin-left: auto;
}
</style>
