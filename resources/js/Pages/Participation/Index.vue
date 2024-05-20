<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { useAuthStore } from "@/stores/auth";
import { ref, onMounted } from 'vue';
import MainLayout from "@/Layouts/MainLayout.vue";
import UserLink from "@/Components/User/UserLink.vue";
import Timestamp from "@/Components/Time/Timestamp.vue";
import FindFriendsRightAside from "@/Components/Asides/FindFriendsRightAside.vue";
import axios from 'axios';


const authStore = useAuthStore();
authStore.updateUserData();

const allBarbecues = ref([]);
const futureBarbecues = ref([]);
const pastBarbecues = ref([]);


onMounted(() => {
    axios.get('/api/my-barbecues')
        .then(response => {
            allBarbecues.value = response.data.sort((a, b) => {
                return new Date(b.created_at) - new Date(a.created_at);
            });
            
            for (const barbecue of allBarbecues.value) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                const [day, month, year, hourMinute] = barbecue.date.split(/[/ :h]/);
                const barbecueDate = new Date(`${year}-${month}-${day}T${hourMinute}:00`);

                if (barbecueDate >= today) {
                    futureBarbecues.value.push(barbecue);
                } else {
                    pastBarbecues.value.push(barbecue);
                }
            }
        });
});

const disableLinks = (event) => {
    const links = event.currentTarget.querySelectorAll('a');
    links.forEach(link => {
        link.style.pointerEvents = 'none';
    });
}

const enableLinks = (event) => {
    const links = event.currentTarget.querySelectorAll('a');
    links.forEach(link => {
        link.style.pointerEvents = 'auto';
    });
}

</script>

<template>
    <Head title="Barbacoes en que participes" />

    <MainLayout title="Barbacoes en que participes">
        <template #main-content>

            <section>
                <h1>
                    Actius
                </h1>

                <div class="grid grid-cols-2 gap-5">
                    <div v-for="barbecue in futureBarbecues" :key="barbecue.id" class="barbecue-container">
                        <div class="barbecue-header">
                            <div class="barbecue-left-section">
                                <div class="barbecue-profile-image">
                                    <Link :href="route('profile.show', barbecue.user.id)">
                                        <img :src="barbecue.user.image" alt="Profile image">
                                    </Link>
                                </div>

                                <div class="barbecue-left-texts">
                                    <UserLink :userId="barbecue.user.id" :name="barbecue.user.name + ' ' + barbecue.user.surnames" class="text-[18px]"/>

                                    <div class="barbecue-address">
                                        <img src="/assets/svg/marker.svg" alt="Location" />
                                        <span>{{ barbecue.address }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="barbecue-right-section">
                                <Timestamp :datetime="barbecue.created_at" class="barbecue-creation text-sm" />
                            </div>

                        </div>

                        <div class="barbecue-content-wrapper">
                            <div class="flex">
                                <Link
                                    :href="'/barbecues/' + barbecue.id"
                                    class="barbecue-title hover:text-orange-500 transition-colors"
                                >
                                    {{ barbecue.title }}
                                </Link>
                            </div>
                            
                            <span class="barbecue-date">{{ barbecue.date }}</span>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="my-5">
                <h1>
                    Finalitzats
                </h1>

                <div class="grid grid-cols-2 gap-5">
                    <div v-for="barbecue in pastBarbecues" :key="barbecue.id">
                        <div class="barbecue-container past-barbecues" @mouseover="disableLinks" @mouseleave="enableLinks">
                            <div class="barbecue-header">
                                <div class="barbecue-left-section">
                                    <div class="barbecue-profile-image">
                                        <Link :href="route('profile.show', barbecue.user.id)">
                                            <img :src="barbecue.user.image" alt="Profile image">
                                        </Link>
                                    </div>
                                    <div class="barbecue-left-texts">
                                        <UserLink :userId="barbecue.user.id" :name="barbecue.user.name + ' ' + barbecue.user.surnames" />
                                        <div class="barbecue-address">
                                            <img src="/assets/svg/marker.svg" alt="Location" />
                                            <span>{{ barbecue.address }}</span>
                                        </div>
                                    </div>
                                </div>
                                <Timestamp :datetime="barbecue.created_at" class="barbecue-creation" />
                            </div>

                            <div class="barbecue-content-wrapper">
                                <div class="flex">
                                    <Link
                                        :href="'/barbecues/' + barbecue.id"
                                        class="barbecue-title hover:text-orange-500 transition-colors"
                                    >
                                        {{ barbecue.title }}
                                    </Link>
                                </div>
                                
                                <span class="barbecue-date">{{ barbecue.date }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </template>

        <template #right-aside>
            <div class="aside-menu">
                <FindFriendsRightAside />
            </div>
        </template>

    </MainLayout>
</template>

<style scoped>
h1 {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 32px;
    font-weight: 700;
    color: #333;
    text-decoration: underline;
}

.barbecue-container {
    display: flex;
    width: 100%;
    max-width: 100%;
    height: 100%;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    padding: 12px 20px 19px 20px;
    flex-direction: column;
    gap: 10px;
}

.barbecue-container.past-barbecues {
    opacity: 0.5;
    transition: all 0.3s ease;
}

.barbecue-container.past-barbecues:hover {
    background: red;
    cursor: not-allowed;
}

.barbecue-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.barbecue-left-section {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    gap: 10px;
}

.barbecue-profile-image {
    display: flex;
    align-items: center;
    height: 100%;
}

.barbecue-profile-image img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.barbecue-left-texts {
    display: flex;
    flex-direction: column;
}

.barbecue-address {
    display: flex;
    align-items: center;
    gap: 3px;
    filter: opacity(0.6);
    font-size: 14px;
}

.barbecue-address img {
    width: 13px;
    height: 13px;
    transform: translateY(-2px);
}

.barbecue-right-section {
    text-align: right;
}

.barbecue-creation {
    height: 100%;
    display: flex;
    align-items: center;
    color: #888;
}

.barbecue-title {
    font-size: 20px;
}

.barbecue-date {
    display: block;
    font-size: 12px;
    color: #888888;
}

.aside-menu {
    width: 100%;
    background: white;
    border-radius: 20px;
    padding: 26px 30px;
}

</style>