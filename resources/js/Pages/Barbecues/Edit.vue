<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { defineProps, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useBarbecueStore } from "@/stores/barbecue";
import { useForm } from '@inertiajs/inertia-vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import FindFriendsRightAside from "@/Components/Asides/FindFriendsRightAside.vue";

const authStore = useAuthStore();
authStore.updateUserData();

const quillContent = ref();
const props = defineProps({
    barbecue: {
        type: Object,
        required: true
    },
    friends: {
        type: Object,
        required: true,
    },
});

const formQuill = ref({
    content: ''
});
let originalContent = '';   
const barbecueStore = useBarbecueStore();
barbecueStore.setBarbecue(props.barbecue);
console.log(barbecueStore.barbecue);

const barbecue = {
    id: props.barbecue.id,
    title: props.barbecue.title,
    content: props.barbecue.content,
    address: props.barbecue.address,
    date: props.barbecue.date,
};

const form = useForm({
    title: barbecue.title,
    content: barbecue.content,
    address: barbecue.address,
    date: barbecue.date,
    dateFormatted: ref('')
});

const submitForm = () => {
    if (form.date) {
        form.dateFormatted = formatDateToSend(form.date);
    }

    form.patch(route('barbecues.update', { id: barbecue.id }), form.data);
};

const formatDateToSend = (date) => {
    if (!date) {
        return '';
    }

    const formattedDate = new Date(date);

    const day = formattedDate.getDate().toString().padStart(2, '0');
    const month = (formattedDate.getMonth() + 1).toString().padStart(2, '0');
    const year = formattedDate.getFullYear();
    const hour = formattedDate.getHours().toString().padStart(2, '0');
    const minute = formattedDate.getMinutes().toString().padStart(2, '0');

    return `Dia ${day}/${month}/${year} a les ${hour}:${minute}h`;
};

const updateDate = (date) => {
    if (date) {
        form.dateFormatted = formatDateToSend(date);
        console.log("Fecha formateada:", form.dateFormatted);
    } else {
        form.dateFormatted = '';
    }
};

updateDate(barbecue.date);

const openModal = () => {
    modalOpened.value = true;
    modal.value.showModal();

    originalContent = form.content;
};
const closeModal = () => {
    const newContent = quillContent.value ? quillContent.value.getHTML().trim() : '';
    if (newContent === '') {
        form.content = originalContent;
    }

    modal.value.close();
};
const saveContent = () => {
    const newContent = quillContent.value ? quillContent.value.getHTML().trim() : '';
    if (newContent !== '') {
        form.content = newContent;
    }
    closeModal();
};
const modal = ref(null);
const modalOpened = ref(false);
</script>

<template>
    <MainLayout :title="barbecue.title">
        <template #main-content>
            <div class="form-barbecues flex justify-center">
                <div class=" barbecues-radius bg-white p-8 mx-auto md:mx-2 w-full max-w-screen-2xl md:max-w-3xl">
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div class="flex flex-col">
                            <div class="mb-6">
                                <InputLabel for="title" value="Titol" />
                                <TextInput id="title" type="text"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    v-model="form.title" required autofocus />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                            <div class="mb-6 relative">
                                <InputLabel for="content" value="Descripció" />
                                <div class="relative">
                                    <div class="border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <div id="content"
                                        class="editable-content mt-1 block px-3 py-2"
                                        v-html="form.content">
                                    </div>
                                    <button type="button" class="absolute top-1/2 right-3 -translate-y-1/2 ml-3"
                                        @click="openModal">
                                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="8.000000pt"
                                            height="8.000000pt" viewBox="0 0 512.000000 512.000000"
                                            preserveAspectRatio="xMidYMid meet">

                                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                                fill="#000000" stroke="none">
                                                <path d="M4100 5111 c-70 -23 -125 -70 -377 -323 l-273 -273 533 -533 532
            -532 277 277 c180 181 284 293 298 322 31 62 36 135 15 207 -16 58 -23 65
            -393 437 -259 259 -391 384 -420 399 -47 22 -151 33 -192 19z" />
                                                <path d="M1572 2637 l-1572 -1572 0 -533 0 -532 533 0 532 0 1575 1575 1575
            1575 -530 530 c-291 291 -532 530 -535 530 -3 0 -713 -708 -1578 -1573z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                                <dialog id="my_modal_1" class="modal" ref="modal">
                                    <div class="modal-box" @click.stop>
                                        <QuillEditor theme="snow" class="rounded-b-lg min-h-24" ref="quillContent"
                                            v-html="form.content" required />
                                        <div class="quill-container" ref="quillContainer"></div>
                                        <div class="modal-action">
                                            <button type="button" class="btn" @click.stop="closeModal">Close</button>
                                            <button type="button" class="btn" @click.stop="saveContent">Guardar</button>
                                        </div>
                                    </div>
                                </dialog>
                                <InputError class="mt-2" :message="form.errors.content" />
                            </div>

                            <div class="mb-6">
                                <InputLabel for="address" value="Adreça" />
                                <TextInput id="address" type="text"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    v-model="form.address" required />
                                <InputError class="mt-2" :message="form.errors.address" />
                            </div>
                            <div class="mb-6">
                                <InputLabel for="date" value="Data" />
                                <input id="date" type="datetime-local"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    v-model="form.date" required />
                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="btn hover:bg-[#c84c00] hover:text-white bg-[#FF6100] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6100] focus:ring-offset-white active:bg-[#FF6100] active:text-white px-4 py-2 rounded-md transition ease-in-out duration-150"
                                :disabled="form.processing">
                                Guardar
                            </button>

                            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Guardat.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
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

.form-barbecues {
    width: 100%;
    background: none;
}

.barbecues-radius {
    border-radius: 20px;
}
.editable-content{
    width: 100%;
}
</style>
