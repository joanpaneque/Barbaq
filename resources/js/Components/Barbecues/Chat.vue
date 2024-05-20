<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import ChatBubble from '@/Components/Chat/ChatBubble.vue';
import { useBarbecueStore } from '@/stores/barbecue';
import { useAuthStore } from '@/stores/auth';
import { onUnmounted } from 'vue';

const chatInput = ref(null);

const barbecueStore = useBarbecueStore();
const authStore = useAuthStore();

const chatContent = ref(null);

function scrollToBottom() {
    setTimeout(() => {
        chatContent.value.scrollTop = chatContent.value.scrollHeight;
    }, 1);
}

onMounted(() => {
    scrollToBottom();
})

const sendMessage = () => {
    axios.post(`/api/chat/${barbecueStore.barbecue.id}`, {
        message: chatInput.value.value
    })
    .then((response) => {
        console.log(response.data);
        scrollToBottom();
    })
}

Echo.private(`chat.${barbecueStore.barbecue.id}`)
    .listen('.message', (res) => {
        barbecueStore.barbecue.messages.push(res.data);
        scrollToBottom();
        chatInput.value.value = '';
    });

onUnmounted(() => {
    Echo.leave(`chat.${barbecueStore.barbecue.id}`);
})

</script>

<template>
    <div class="chat-container">
        <div class="chat-content" ref="chatContent">
            <ChatBubble
                v-for="(message, index) in barbecueStore?.barbecue?.messages"
                :mine="message.user_id === authStore.user.id"
                :message="message"
                :previousUserId="barbecueStore?.barbecue?.messages[index - 1]?.user_id"
            >
            </ChatBubble>
        </div>
        <div class="chat-input">
            <input type="text" placeholder="Escriu un missatge..." @keydown.enter="sendMessage" ref="chatInput" />
            <div class="chat-send" @click="sendMessage">
                <img src="/assets/svg/paper-plane-top.svg" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.chat-content {
    max-height: 100%;
    overflow: hidden;
    display: grid;
    gap: 17px;
    grid-auto-rows: min-content;
    overflow-y: auto;
    background-image: url('/assets/img/barbecue-chat-background.png');
    background-size: cover;
    background-size: 50%;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    padding: 20px;
}

.chat-content::-webkit-scrollbar {
    background: #ddd;
    width: 10px;
}

.chat-content::-webkit-scrollbar-thumb {
    background: #b4b4b4;
    border-radius: 10px;
}

.chat-send {
    width: 50px;
    height: 50px;
    padding: 13px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    background: rgba(255, 74, 0)
}

.chat-send img {
    transform: translateX(2px);
    filter: invert(1);
}

.chat-send:hover img {
    animation: sendHover 0.3s;
}

@keyframes sendHover {
    0% {
        transform: translateX(2px);
    }

    50% {
        transform: translateX(7px) scaleY(0.7);
    }

    100% {
        transform: translateX(2px);
    }
}

.chat-container {
    background: #fff;
    height: calc(100vh - 130px);
    width: 100%;
    border-radius: 20px;
    border-top-right-radius: 0;
    overflow: hidden;
    display: grid;
    grid-template-rows: 1fr 75px;
}


.chat-input {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    gap: 10px;
}

.chat-input input {
    height: 100%;
    width: 100%;
    padding-inline: 20px;
    border: 1px solid #ddd;
    border-radius: 1000px;
}

.chat-input input:focus-within {
    outline: none;
    border-color: #ff4a00;
}
</style>