<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Chat from "@/Components/Barbecues/Chat.vue";
import BarbacuesAside from "@/Components/Barbecues/BarbacuesAside.vue";
import { defineProps } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useBarbecueStore } from "@/stores/barbecue";
import { useForm } from '@inertiajs/inertia-vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import htmlButtonHasType from "eslint-plugin-vue/lib/rules/html-button-has-type";
const authStore = useAuthStore();
authStore.updateUserData();

const props = defineProps({
    barbecue: {
        type: Object,
        required: true
    }
});
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
});

const submitForm = () => {
    form.patch(route('barbecues.update', { id: barbecue.id }));
};
</script>

<template>
    <MainLayout :title="barbecue.title">
        <template #main-content>
            <div class="form-barbecues flex justify-center items-center h-screen">
                <div class="bg-white rounded-lg p-8 w-full md:max-w-xl">
                    <form @submit.prevent="submitForm" class="mt-6 space-y-6">
                        <div class="flex flex-col">
                            <div class="mb-6">
                                <InputLabel for="title" value="Titol" />
                                <TextInput id="title" type="text"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    v-model="form.title" required autofocus />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                            <div class="mb-6">
                                <InputLabel for="content" value="Descripció" />
                                <textarea id="content" contenteditable
                                    class="editable-content mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                 v-model="form.content" required></textarea>
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
                <BarbacuesAside />
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
}
.form-barbecues{
    margin-top: -87px;
}
</style>
