<script setup>
import { Head } from '@inertiajs/vue3';
import { useAuthStore } from "@/stores/auth";
import { ref, onMounted } from 'vue';
import EmojiPicker from 'vue3-emoji-picker';
import "vue3-emoji-picker/css";
import MainLayout from "@/Layouts/MainLayout.vue";

const messageInput = ref('');
const showEmojiPicker = ref(false);
const chatBox = ref(null);

const togglePicker = () => {
    showEmojiPicker.value = !showEmojiPicker.value;
}
const onSelectEmoji = (emoji) => {
    console.log(emoji);
    messageInput.value += emoji.i;
}
onMounted(() => {
    chatBox.value.scrollTop = chatBox.value.scrollHeight;
});

// close the emoji picker when clicking outside of it
window.addEventListener('click', (e) => {
    if (showEmojiPicker.value && !e.target.closest('.emoji-picker') && !e.target.closest('.input-message')) {
        showEmojiPicker.value = false;
    }
});


// drag the emoji picker, only the div with the class emoji-picker
let isDragging = false;
let initialX = 0;
let initialY = 0;
let xOffset = 0;
let yOffset = 0;

const dragStart = (e) => {
    if (e.target.closest('.emoji-picker')) {
        isDragging = true;
        if (e.type === "touchstart") {
            initialX = e.touches[0].clientX - xOffset;
            initialY = e.touches[0].clientY - yOffset;
        } else {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
        }
    }
}

const dragEnd = () => {
    isDragging = false;
}

const drag = (e) => {
    if (isDragging) {
        e.preventDefault();
        if (e.type === "touchmove") {
            xOffset = e.touches[0].clientX - initialX;
            yOffset = e.touches[0].clientY - initialY;
        } else {
            xOffset = e.clientX - initialX;
            yOffset = e.clientY - initialY;
        }

        const picker = document.querySelector('.emoji-picker');
        setTranslate(xOffset, yOffset, picker);
    }
}

const setTranslate = (xPos, yPos, el) => {
    el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
}

window.addEventListener('mousemove', drag);
window.addEventListener('mouseup', dragEnd);

window.addEventListener('touchmove', drag);
window.addEventListener('touchend', dragEnd);
const authStore = useAuthStore();
authStore.updateUserData();

const props = defineProps({
    friends: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <Head title="Missatges" />

    <MainLayout title="Missatges">
        <template #main-content>
            
            <div class="chat-wrapper container">
                <div class="chat" ref="chatBox">
                    <div class="chat_date flex items-center justify-center w-full">
                        <p class="text-black text-xs m-0 border-b-2 border-black pb-2 w-full text-center mb-4">
                            Avui a les 12:32
                        </p>
                    </div>
                    <div class="chat_messages flex flex-col">
                        <div class="chat_messages">
                            <div class="chat_message flex space-x-2 my-2 mr-10 flex-col">
                                <div class="name flex ml-14">
                                    <p class="text-sm m-0 font-bold">
                                        Xavi Vallejo
                                    </p>
                                </div>
                                <div class="text flex flex-row space-x-2">
                                    <div class="chat_avatar ">
                                        <img src="/assets/img/user.png" alt="avatar" class="avatar">
                                    </div>

                                    <div class="chat_text bg-[#ececec] p-2 rounded-lg space-x-2 flex flex-col">
                                        <p class="text-sm">
                                            Hola a tots, com anem?
                                        </p>
                                        <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:32</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat_messages">
                            <div class="chat_message flex space-x-2 my-2 mr-10 flex-col">
                                <div class="name flex ml-14">
                                    <p class="text-sm m-0 font-bold">
                                        Dani Prados
                                    </p>
                                </div>
                                <div class="text flex flex-row space-x-2">
                                    <div class="chat_avatar ">
                                        <img src="/assets/img/user.png" alt="avatar" class="avatar">
                                    </div>

                                    <div class="chat_text bg-[#ececec] p-2 rounded-lg space-x-2 flex flex-col">
                                        <p class="text-sm">
                                            Hola, que tal?
                                        </p>
                                        <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:32</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat_messages">
                            <div class="chat_message flex space-x-2 my-2 mr-10 flex-col">
                                <div class="name flex ml-14">
                                    <p class="text-sm m-0 font-bold">
                                        Roman
                                    </p>
                                </div>
                                <div class="text flex flex-row space-x-2">


                                    <div class="chat_text bg-[#ececec] p-2 rounded-lg space-x-2 flex flex-col ml-12">
                                        <p class="text-sm">
                                            Qui te ganes de fer una barbacoa aquest cap de setmana?
                                        </p>
                                        <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:32</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chat_message flex space-x-2 my-2 mr-10 flex-col">
                                <div class="name flex ml-14">

                                </div>
                                <div class="text flex flex-row space-x-2">
                                    <div class="chat_avatar ">
                                        <img src="/assets/img/user.png" alt="avatar" class="avatar">
                                    </div>

                                    <div class="chat_text bg-[#ececec] p-2 rounded-lg space-x-2 flex flex-col">
                                        <p class="text-sm">
                                            Jo la veritat que si, m'encantaria!
                                        </p>
                                        <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:32</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat_messages">
                            <div class="chat_message flex space-x-2 my-2 mr-10 flex-col">
                                <div class="name flex ml-14">
                                    <p class="text-sm m-0 font-bold">
                                        Marcos Boiga
                                    </p>
                                </div>
                                <div class="text flex flex-row space-x-2">
                                    <div class="chat_avatar ">
                                        <img src="/assets/img/user.png" alt="avatar" class="avatar">
                                    </div>

                                    <div class="chat_text bg-[#ececec] p-2 rounded-lg space-x-2 flex flex-col">
                                        <p class="text-sm">
                                            Quepasa tios, com anem?
                                        </p>
                                        <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:32</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat_message flex space-x-2 my-2 mr-10 flex-col">
                            <div class="name flex ml-14">
                                <p class="text-sm m-0 font-bold">
                                    Joan Paneque
                                </p>
                            </div>
                            <div class="text flex flex-row space-x-2">
                                <div class="chat_avatar ">
                                    <img src="/assets/img/user.png" alt="avatar" class="avatar">
                                </div>

                                <div class="chat_text bg-[#ececec] p-2 rounded-lg space-x-2 flex flex-col">
                                    <p class="text-sm">
                                        Quines ganes de fer una barbacoa aquest cap de setmana!
                                    </p>
                                    <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:32</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chat_messages_me">
                        <div class="chat_message flex space-x-2 my-2 ml-10 flex-col">
                            <div class="name flex mr-14 justify-end">
                                <p class="text-sm m-0 font-bold">
                                    Tu
                                </p>
                            </div>
                            <div class="text flex flex-row space-x-2 justify-end">
                                <div class="chat_text_me bg-[#ececec] p-2 rounded-lg space-x-2 flex flex-col">
                                    <p class="text-sm">
                                        Sí, jo també tinc moltes ganes!
                                    </p>
                                    <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:33</span>
                                </div>
                                <div class="chat_avatar ">
                                    <img src="/assets/img/user.png" alt="avatar" class="avatar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chat_text bg-[#ececec] p-3 flex rounded-lg space-x-2 input-message">
                    <input v-model="messageInput" type="text" placeholder="Envia un missatge a Barbacoa dels cardats..."
                        class="flex-1 bg-[#D9D9D9] rounded-lg p-2 outline-none placeholder-font-light">

                    <button @click="togglePicker">
                        <img src="assets/svg/emoji.svg" alt="emoji"
                            class="w-6 h-6 hover:scale-110 transition duration-300 ease-in-out">
                    </button>
                </div>

                <div class="emoji-picker" v-if="showEmojiPicker" @mousedown="dragStart">
                    <EmojiPicker :native="true" @select="onSelectEmoji" />
                </div>
            </div>

        </template>

        <template #right-aside>
            <div class="container">
                <div v-for="friend in friends" :key="friends.id" class="item">
                    <img 
                        :src="friend.image ? friend.image : '/assets/img/user.png'" 
                        alt="Icon" 
                        class="w-12 h-12 object-cover rounded-full" 
                    />
                    <span>{{ friend.name }}</span>
                    <span class="counter">3</span>
                </div>
            </div>
        </template>
    </MainLayout>
</template>

<style scoped>
.container {
    display: grid;
    gap: 5px;
    height: fit-content;
    padding: 5px 5px;
    border-radius: 20px;
    background: #fff;
}

.chat-wrapper {
    height: 100%;
    display: grid;
    grid-template-rows: auto 60px;
}

.chat {
    --gap: 0px;
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    overflow-y: auto;
}

.chat_avatar {
    min-width: 40px;
    height: 40px;
    background-color: #C4C4C4;
    border-radius: 50%;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.input-message {
    display: flex;
    width: 100%;
  
    z-index: 999;
}

.emoji-picker {
    position: absolute;
    bottom: 25px;
    right:280px;
    z-index: 999;

}

.item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
}

.item:hover {
    background: #f2f2f2;
    border-radius: 15px;
    cursor: pointer;
}

.counter {
    background: #b5b5b5;
    color: #fff;
    border-radius: 9999px;
    padding: 0 7px;
    height: fit-content;
    display: flex;
    align-items: center;
    width: fit-content;
    margin-left: auto;
}
</style>