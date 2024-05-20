<script setup>
import { ref, defineProps } from 'vue';
import { useAuthStore } from '@/stores/auth';
import UserLink from "@/Components/User/UserLink.vue"

const authStore = useAuthStore();

const props = defineProps({
    message: {
        type: Object,
        required: true
    },
    previousUserId: {
        type: Number,
        default: null
    }
})


const whatsappNameColors = [
    "#06cf9c",
    "#007bfc",
    "#53bdeb",
    "#a5b337",
    "#e542a3",
    "#c4532d",
    "#25d366",
    "#5e47de",
    "#917cff",
    "#1fa855",
    "#c89631"
];

function getColorBasedOnName(name) {
    const sum = name.split('').reduce((acc, char) => acc + char.charCodeAt(0), 0);
    return whatsappNameColors[sum % whatsappNameColors.length];
}

function convertToHHMM(isoString) {
    const timePart = isoString.split('T')[1].split('Z')[0];
    const [hours, minutes] = timePart.split(':').map(Number);

    const formattedHours = String(hours).padStart(2, '0');
    const formattedMinutes = String(minutes).padStart(2, '0');

    return `${formattedHours}:${formattedMinutes}`;
}

</script>

<template>
    <div class="chat-bubble-container" :class="{ mine: props.message.user_id === authStore.user.id, concurrent: props.message.user_id === previousUserId }">
        <div class="chat-bubble-profile">
            <img :src="props.message.user.image" />
        </div>
        <div class="chat-bubble-wrapper">
            <div class="chat-bubble-arrow"></div>
            <div class="chat-bubble-content">
                <div class="chat-bubble-header">
                    <div class="chat-bubble-user" :style="{ color: getColorBasedOnName(props.message.user.name) }">
                        <!-- {{ props.message.user.name }} -->
                        <UserLink :userId="props.message.user.id" :name="props.message.user.name" />
                    </div>
                    <div class="chat-bubble-dropdown">
                        <img src="/assets/svg/arrow.svg" />
                    </div>
                </div>

                <div class="chat-bubble-body">
                    {{ props.message.message }}
                </div>
                <div class="chat-bubble-footer">
                    <span>{{ convertToHHMM(props.message.created_at) }}</span>
                    <img src="/assets/svg/check.svg" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.chat-bubble-container {
    display: flex;
    gap: 5px;
}

.chat-bubble-content {
    color: black;
    width: fit-content;
    max-width: 300px;
    background: #fff;
    position: relative;
    padding: 10px 10px;
    border-radius: 7.5px;
    border-top-left-radius: 0;
    /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
    border-bottom: 1px solid #ddd;

}

.chat-bubble-container.mine {
    margin-left: auto;
}

.chat-bubble-container.mine .chat-bubble-content {
    background: #ddfdd3;
    /* box-shadow: 0 0 5px rgba(255, 255, 255, 0.1); */

}

.chat-bubble-profile {
    width: 35px;
    height: 35px;
}

.chat-bubble-profile img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.chat-bubble-user {
    font-weight: bold;
}

.chat-bubble-wrapper {
    display: flex;
    height: fit-content;
}

.chat-bubble-arrow {
    width: 10px;
    height: 10px;
    background: #fff;
    z-index: 20;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
    clip-path: polygon(0 0, 100% 0, 0 100%);
    transform: scaleX(-1);
}

.chat-bubble-container.mine .chat-bubble-arrow {
    background: #ddfdd3;
}

.chat-bubble-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-bubble-dropdown {
    width: 20px;
    height: 20px;
    opacity: 0;
    transform: translateX(10px);
    transition: all 0.1s;
    background: #fff;
    border-radius: 50%;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    z-index: 20;
}

.chat-bubble-container.mine .chat-bubble-dropdown {
    background: #ddfdd3;
}

.chat-bubble-container:hover .chat-bubble-dropdown {
    opacity: 1;
    transform: translateX(0);
    transition: all 0.1s;
    cursor: pointer;
}

.chat-bubble-container.concurrent .chat-bubble-profile {
    visibility: hidden;
}

.chat-bubble-container.concurrent .chat-bubble-arrow {
    visibility: hidden;
}

.chat-bubble-container.concurrent .chat-bubble-content {
    border-top-left-radius: 10px;
}

.chat-bubble-container.concurrent {
    margin-top: -15px;
}

.chat-bubble-container.concurrent .chat-bubble-user {
    visibility: hidden;
}

.chat-bubble-container.concurrent .chat-bubble-body {
    margin-top: -24px;
}

.chat-bubble-footer {
    position: absolute;
    bottom: 6px;
    right: 10px;
    color: #667781;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.chat-bubble-body {
    position: relative;
    width: fit-content;
    padding-right: 55px;
    word-break: break-word;
}

.chat-bubble-container.mine .chat-bubble-user {
    visibility: hidden;
}


.chat-bubble-container.mine .chat-bubble-body {
    margin-top: -24px;
}

.chat-bubble-container.mine .chat-bubble-profile {
    display: none;
}

/* if mine, change the arrow position */
.chat-bubble-container.mine .chat-bubble-arrow {
    transform: scaleX(1);
}

.chat-bubble-container.mine .chat-bubble-content {
    order: -1;
    border-top-right-radius: 0;
    border-top-left-radius: 7.5px;
}

.chat-bubble-footer img {
    width: 10px;
    height: 10px;
    display: none;
}

.chat-bubble-container.mine .chat-bubble-footer img {
    display: block;
    opacity: 0.7;
}
</style>