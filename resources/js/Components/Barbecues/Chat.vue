<script setup>
import { ref, onMounted } from 'vue';
import EmojiPicker from 'vue3-emoji-picker';
import "vue3-emoji-picker/css";

const messageInput = ref('');
const showEmojiPicker = ref(false);

const chatBox = ref(null);

const togglePicker = () => {
    showEmojiPicker.value = !showEmojiPicker.value;
}

const onSelectEmoji = (emoji) => {
    messageInput.value += emoji;
}

onMounted(() => {
    chatBox.value.scrollTop = chatBox.value.scrollHeight;
});

import { defineExpose } from 'vue';
defineExpose({ messageInput, showEmojiPicker, togglePicker, onSelectEmoji });
</script>

<template>
    <div class="chat-wrapper">
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
                                Xavi Vallejo</p>
                        </div>
                        <div class="text flex flex-row space-x-2">
                            <div class="chat_avatar ">
                                <img src="assets/svg/avatar.svg" alt="avatar" class="avatar">
                            </div>

                            <div class="chat_text bg-[#C4C4C4] p-2 flex rounded-lg space-x-2 flex flex-col">
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
                                Dani Prados</p>
                        </div>
                        <div class="text flex flex-row space-x-2">
                            <div class="chat_avatar ">
                                <img src="assets/svg/avatar.svg" alt="avatar" class="avatar">
                            </div>

                            <div class="chat_text bg-[#C4C4C4] p-2 flex rounded-lg space-x-2 flex flex-col">
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
                                Roman</p>
                        </div>
                        <div class="text flex flex-row space-x-2">


                            <div class="chat_text bg-[#C4C4C4] p-2 flex rounded-lg space-x-2 flex flex-col ml-12">
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
                                <img src="assets/svg/avatar.svg" alt="avatar" class="avatar">
                            </div>

                            <div class="chat_text bg-[#C4C4C4] p-2 flex rounded-lg space-x-2 flex flex-col">
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
                                Marcos Boiga</p>
                        </div>
                        <div class="text flex flex-row space-x-2">
                            <div class="chat_avatar ">
                                <img src="assets/svg/avatar.svg" alt="avatar" class="avatar">
                            </div>

                            <div class="chat_text bg-[#C4C4C4] p-2 flex rounded-lg space-x-2 flex flex-col">
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
                            Joan Paneque</p>
                    </div>
                    <div class="text flex flex-row space-x-2">
                        <div class="chat_avatar ">
                            <img src="assets/svg/avatar.svg" alt="avatar" class="avatar">
                        </div>

                        <div class="chat_text bg-[#C4C4C4] p-2 flex rounded-lg space-x-2 flex flex-col">
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
                            Tu </p>
                    </div>
                    <div class="text flex flex-row space-x-2 justify-end">
                        <div class="chat_text_me bg-[#C4C4C4] p-2 flex rounded-lg space-x-2 flex flex-col">
                            <p class="text-sm">
                                Sí, jo també tinc moltes ganes!
                            </p>
                            <span class="text-xs text-[#7C7C7C] m-0 flex items-center justify-end">12:33</span>
                        </div>
                        <div class="chat_avatar ">
                            <img src="assets/svg/avatar.svg" alt="avatar" class="avatar">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="chat_text bg-[#C4C4C4] p-3 flex rounded-lg space-x-2 input-message">
            <input v-model="messageInput" type="text" placeholder="Envia un missatge a Barbacoa dels cardats..."
                class="flex-1 bg-[#D9D9D9] rounded-lg p-2 outline-none placeholder-font-light">

            <button @click="togglePicker">
                <img src="assets/svg/emoji.svg" alt="emoji"
                    class="w-6 h-6 hover:scale-110 transition duration-300 ease-in-out">
            </button>
            <div class="absolute bottom-14 right-5">
                <EmojiPicker v-if="showEmojiPicker" :native="true" @select="onSelectEmoji" class="emoji-picker" />
            </div>
        </div>
    </div>

</template>

<style scoped>
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
    max-width: 500px;
    z-index: 999;
}
</style>