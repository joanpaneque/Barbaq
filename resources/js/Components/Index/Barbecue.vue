<script setup>

import { ref, defineProps } from 'vue';
import UserLink from "@/Components/User/UserLink.vue"
import { Link } from '@inertiajs/vue3';
import Timestamp from "@/Components/Time/Timestamp.vue";
import Gallery from '@/Components/Galleries/Gallery.vue';
import CommentSystem from "@/Components/Comments/CommentSystem.vue"
import { useAuthStore } from '@/stores/auth';
import axios from 'axios';

const auth = useAuthStore();

const props = defineProps({
    barbecue: {
        type: Object,
        required: true
    }
});

</script>

<template>
   
    <div class="barbecue-container" v-if="barbecue">
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
            <div class="barbecue-date">
                <Timestamp :datetime="barbecue.created_at" />
            </div>
        </div>
        <div class="barbecue-content-wrapper">
            <Link :href="'/barbecues/' + barbecue.id " class="barbecue-title">{{ barbecue.title }}</Link>
            <div class="barbecue-content" v-html="barbecue.content"></div>
        </div>
        <div class="barbecue-gallery" v-if="barbecue.images">
            <Gallery :images="barbecue.images.map(image => image.path)" />
        </div>
        <CommentSystem :root="barbecue.comments" :barbecueId="barbecue.id" />
    </div>
</template>

<style scoped>
.barbecue-container {
    width: 100%;
    height: fit-content;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    padding: 12px 20px 19px 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
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

.barbecue-date {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    color: #888;
}

.barbecue-profile-image {
    display: flex;
    align-items: center;
    height: 100%;
}

.barbecue-profile-image img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.barbecue-left-texts {
    display: flex;
    flex-direction: column;
}

.barbecue-address img {
    width: 13px;
    height: 13px;
    transform: translateY(-2px);
}

.barbecue-address {
    display: flex;
    align-items: center;
    gap: 3px;
    filter: opacity(0.6);
    font-size: 14px;
}

.barbecue-title {
    font-size: 24px;
}

.barbecue-content {
    font-size: 16px;
    line-height: 1.5;
    margin-top: 5px;
}

.barbecue-footer {
    border-radius: 10px;
    padding-inline: 20px;
    display: grid;
    gap: 10px;
}
</style>

<style>
h1 {
    font-size: 18px;
    font-weight: bold;
}
</style>