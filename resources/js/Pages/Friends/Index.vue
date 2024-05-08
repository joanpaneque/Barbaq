<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useAuthStore } from "@/stores/auth";
import { Head, Link, useForm } from '@inertiajs/vue3';
import FindFriendsRightAside from "@/Components/Asides/FindFriendsRightAside.vue";

const authStore = useAuthStore();
authStore.updateUserData();

const props = defineProps({
    friends: {
        type: Object,
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

const form = useForm({
    id: '',
}); 

const deletefriend = (id) => {
    form.delete(route('friends.destroy', id));
};


</script>

<template>
    <MainLayout title="Amics">
        <template #main-content>
            <div class="form-control">
                <div class="relative text-gray-600 w-full">
                    <input type="search" name="serch" placeholder="Cercar amics..."
                        class="bg-white h-10 px-5 input-search pr-10 rounded-full text-sm focus:outline-none w-full"
                        id="search-input" />
                    <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                            xml:space="preserve" width="512px" height="512px">
                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-friends">
                <div v-for="friend in friends" :key="friend.id"
                    class="friend-card w-40 bg-white border border-gray-200 rounded-[20px] dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-2 pt-3">
                    </div>
                    <div class="flex flex-col items-center pb-5">
                        <Link :href="'/profile/' + friend.id">
                        <div class="flex flex-col items-center user-icon">
                            <img class="UserImage w-24 h-24 mb-3 rounded-full" :src="friend.image" alt="User Image" />
                            <h5 class=" text-sm font-medium text-gray-900 dark:text-white">
                                {{ friend.name }} {{ friend.surnames }}
                            </h5>
                        </div>
                        </Link>
                        <div class="socials flex items-center justify-center mt-3 space-x-3">
                            <div class="message">
                                <button class="hover:bg-[#FF6100] rounded-full p-2 border-gray-200 transition duration-100 border-2 hover:border-[#FF6100] 
                                font-medium text-gray-800 text-sm">
                                    Enviar missatge
                                </button>
                            </div>
                            <div class="delete">
                                <form @submit.prevent="deletefriend(friend.id)">
                                <div class="tooltip" data-tip="Eliminar amic">
                                    <button class="hover:bg-[#FF6100] rounded-full p-2 border-gray-200 transition duration-100 border-2 hover:border-[#FF6100] 
                                font-medium text-gray-800 text-sm">
                                        <img src="/assets/svg/user-check.svg" alt="Eliminar" class="w-4 h-4" />
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Mostrar més
                </button>
            </div>
        </template>
        <template #right-aside>
            <div class="aside-menu">
                <FindFriendsRightAside />
            </div>
        </template>
    </MainLayout>
</template>
<style scoped>
.aside-menu {
    width: 100%;

    background: white;
    border-radius: 20px;
    padding: 26px 30px;
}

.input-search {
    caret-color: #cc4e00;
}

.grid-friends {
    grid-template-columns: repeat(auto-fit, minmax(11rem, 1fr));
    gap: 15px;
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

.user-icon {
    transition: all 0.1s;
}

.user-icon:hover {
    cursor: pointer;

    h5 {
        color: #FF6100;
    }
}
</style>
