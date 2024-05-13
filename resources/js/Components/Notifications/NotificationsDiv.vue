<script setup>
import axios from "axios";
import { useAuthStore } from "@/stores/auth";
import { Link } from '@inertiajs/vue3';
const authStore = useAuthStore();

console.log(authStore.user);

function executeNotification(primary, notification) {
  axios[notification[primary ? 'primary_link_method' : 'secondary_link_method']]
    (notification[primary ? 'primary_link' : 'secondary_link']);
  axios.delete('/notifications/' + notification.id);
  authStore.updateUserData();
}


// make a function that returns this:
// {{ notification.created_at.split('T')[0].split('-')[2] }}/{{
//               notification.created_at.split('T')[0].split('-')[1] }}/{{
//               notification.created_at.split('T')[0].split('-')[0] }}
//             a les {{ notification.created_at.split('T')[1].split(':')[0] }}:{{
//               notification.created_at.split('T')[1].split(':')[1] }}

function formatDate(date) {
  return `${date.split('T')[0].split('-')[2]}/${date.split('T')[0].split('-')[1]}/${date.split('T')[0].split('-')[0]} a les ${date.split('T')[1].split(':')[0]}:${date.split('T')[1].split(':')[1]}`;
}
</script>

<template>
  <div class="flex flex-col items-center justify-center w-full space-y-2">
    <div v-if="authStore.user" class="flex bg-white rounded-[20px] p-4 w-full items-center align-middle justify-between"
      v-for="notification in authStore.user.notifications" :key="notification.id">

      <div class="flex justify-start items-center">
        <img src="/assets/img/adduser.png" alt="Imagen de usuario" class="p-2 " />
        <div class="flex flex-col justify-start items-start w-full">
          <Link :href="'/profile/' + notification.primary_link.slice(-1)">
            <p class="">
              {{ notification.message }}
            </p>
          </Link>
          <p class=" text-gray-400 text-xs">

            <!-- get the date and the hour by "2024-04-26T16:58:13.000000Z" and the format DD/MM/YY -->
            {{ notification.created_at.split('T')[0].split('-')[2] }}/{{
              notification.created_at.split('T')[0].split('-')[1] }}/{{
              notification.created_at.split('T')[0].split('-')[0] }}
            a les {{ notification.created_at.split('T')[1].split(':')[0] }}:{{
              notification.created_at.split('T')[1].split(':')[1] }}
          </p>
        </div>
      </div>
      <div class="flex space-x-2 justify-end">
        <button @click="executeNotification(true, notification)" type="submit"
          class="btn hover:bg-[#c84c00]  hover:text-white bg-[#FF6100] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6100] focus:ring-offset-white active:bg-[#FF6100] active:text-white px-4 py-2 rounded-[15px] transition ease-in-out duration-150">
          Acceptar
        </button>
        <button @click="executeNotification(false, notification)"
          class="btn hover:bg-[#909090]  hover:text-white bg-[#909090] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B3B3B3] focus:ring-offset-white active:bg-[#B3B3B3] active:text-white px-4 py-2 rounded-[15px] transition ease-in-out duration-150">
          Rebutjar
        </button>
      </div>

    </div>
    <!-- <div class="flex bg-white rounded-[20px] p-4 w-full items-center align-middle justify-between">
            <div class="flex justify-start items-center">
            <img src="/assets/img/adduser.png" alt="Marcos Boiga"
            class="p-2 " />
          <p class="p-1">Joan Boig ha sol·licitat ser amic teu</p>
        </div>
          <div class="flex space-x-2 justify-end">
            <button class="btn hover:bg-[#c84c00]  hover:text-white bg-[#FF6100] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6100] focus:ring-offset-white active:bg-[#FF6100] active:text-white px-4 py-2 rounded-[15px] transition ease-in-out duration-150">Acceptar</button>
            <button class="btn hover:bg-[#909090]  hover:text-white bg-[#909090] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B3B3B3] focus:ring-offset-white active:bg-[#B3B3B3] active:text-white px-4 py-2 rounded-[15px] transition ease-in-out duration-150">Rebutjar</button>
            </div>
        </div>
        <div class="flex bg-white rounded-[20px] p-4 w-full items-center align-middle justify-between">
            <div class="flex justify-start items-center">
            <img src="/assets/img/parrilla.png" alt="Marcos Boiga"
            class="p-2 " />
          <p class="p-1">Joan Boig ha sol·licitat unir-se a la Barbacoa dels cardats</p>
        </div>
          <div class="flex space-x-2 justify-end">
            <button class="btn hover:bg-[#c84c00]  hover:text-white bg-[#FF6100] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6100] focus:ring-offset-white active:bg-[#FF6100] active:text-white px-4 py-2 rounded-[15px] transition ease-in-out duration-150">Acceptar</button>
            <button class="btn hover:bg-[#909090]  hover:text-white bg-[#909090] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#909090] focus:ring-offset-white active:bg-[#909090] active:text-white px-4 py-2 rounded-[15px] transition ease-in-out duration-150">Rebutjar</button>
            </div>
        </div> -->
  </div>


</template>

<style scoped></style>