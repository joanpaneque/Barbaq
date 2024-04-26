<script setup>
import axios from "axios";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();

function executeNotification(primary, notification) {
    axios[notification[primary ? 'primary_link_method' : 'secondary_link_method']]
    (notification[primary ? 'primary_link' : 'secondary_link']);
    axios.delete('/notifications/' + notification.id);
    authStore.updateUserData();
}


</script>

<template>
    
    <div class="flex flex-col items-center justify-center w-full space-y-2">
        <!-- <div class="flex bg-white rounded-[20px] p-4 w-full items-center align-middle">
            <img src="/assets/img/bocadillo.png" alt="Marcos Boiga"
            class="p-2 " />
          <p class="p-1">Marcos Boiga ha comentat a la teva publicació</p>
        </div>
        <div class="flex bg-white rounded-[20px] p-4 w-full items-center align-middle">
            <img src="/assets/img/bocadillo.png" alt="Marcos Boiga"
            class="p-2 " />
          <p class="p-1">Joan Boig ha comentat a la teva publicació</p>
        </div> -->
        <div v-if="authStore.user" class="flex bg-white rounded-[20px] p-4 w-full items-center align-middle justify-between" v-for="notification in authStore.user.notifications" :key="notification.id">
          
            <div class="flex justify-start items-center">
            <img src="/assets/img/adduser.png" alt="Marcos Boiga"
            class="p-2 " />
          <p class="p-1">
              {{ notification.message }}
          </p>
        </div>
          <div class="flex space-x-2 justify-end">
            <button
            @click="executeNotification(true, notification)"
            type="submit"
            class="btn hover:bg-[#c84c00]  hover:text-white bg-[#FF6100] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6100] focus:ring-offset-white active:bg-[#FF6100] active:text-white px-4 py-2 rounded-[15px] transition ease-in-out duration-150">
                Acceptar
            </button>
            <button
            @click="executeNotification(false, notification)"
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