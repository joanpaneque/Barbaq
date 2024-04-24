<script setup>
import { useAuthStore } from "@/stores/auth";
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useProfileStore } from "@/stores/profile";

const profileStore = useProfileStore();
const authStore = useAuthStore();
</script>

<template>


    <div v-if="profileStore.user">
        <div class="w-full bg-cover bg-no-repeat bg-center rounded-t-[20px]" style="height: 150px; background: rgb(131,58,180);
        background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);">
        </div>
        <div class="bg-white rounded-b-[20px]">

            <div class="p-4">
                <div class="relative flex w-full">
                    <div class="flex flex-1 pl-4">
                        <div style="margin-top: -6rem;">
                            <div style="height:9rem; width:9rem;" class="md rounded-full relative avatar">
                                <img style="height:9rem; width:9rem;"
                                    class="md rounded-full relative border-4 border-white bg-white"
                                    :src="profileStore.user.image" alt="avatar">
                                <div class="absolute"></div>
                            </div>
                        </div>
                        <div class="flex flex-col text-left">
                            <h1 class="text-2xl font-bold text-gray-800">{{ profileStore.user.name }} {{
                                profileStore.user.surnames }}</h1>
                            <div class="flex items-center content-center">

                                <img src="/assets/svg/marcador.svg" alt="Marcador" class="w-3 mr-1">
                                <p class="text-sm ">L'Estartit</p>

                            </div>
                        </div>

                        <div class="flex flex-col text-right ml-auto">


                            <div v-if="authStore.user && profileStore.user">
                                <Link :href="route('profile.edit', { profile: profileStore.user.id })"
                                    v-if="authStore.user.id == profileStore.user.id">
                                <button
                                    class="px-4 py-2 border flex gap-2 border-slate-200 dark:border-slate-700 rounded-lg text-slate-700 dark:text-slate-200 hover:border-slate-400 dark:hover:border-slate-500 hover:text-slate-900 dark:hover:text-slate-300 hover:shadow transition duration-150">
                                    <img class="" src="/assets/svg/editprofile.svg" loading="lazy" alt="google logo">
                                    <span class="font-medium">Editar</span>
                                </button>


                                </Link>
                                <div v-else>
                                    <div class="flex items-center justify-center dark:bg-gray-800 gap-2">
                                        <Link
                                            class="px-4 py-2 border flex gap-2 border-slate-200 dark:border-slate-700 rounded-lg text-slate-700 dark:text-slate-200 hover:border-slate-400 dark:hover:border-slate-500 hover:text-slate-900 dark:hover:text-slate-300 hover:shadow transition duration-150 bg-gray-100">
                                        <img class="" src="/assets/svg/sendmessage.svg" loading="lazy" alt="google logo">
                                        <span class="text-black font-bold">Enviar missatge</span>
                                        </Link>

                                        <Link
                                            class="px-4 py-2 border flex gap-2 border-slate-200 dark:border-slate-700 rounded-lg text-slate-700 dark:text-slate-200 hover:border-slate-400 dark:hover:border-slate-500 hover:text-slate-900 dark:hover:text-slate-300 hover:shadow transition duration-150 bg-green-600">
                                        <img class="" src="/assets/svg/addfriend.svg" loading="lazy" alt="google logo">
                                        <span class="text-white font-bold">Enviar solicitut d'amistat</span>
                                        </Link>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped></style>