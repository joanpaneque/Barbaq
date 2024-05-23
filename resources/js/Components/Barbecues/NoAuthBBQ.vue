<script setup>
import { useAuthStore } from "@/stores/auth";
import { useBarbecueStore } from "@/stores/barbecue";
import { ref } from "vue";
import axios from "axios";

const authStore = useAuthStore();
const barbecueStore = useBarbecueStore();

const solicitutenviada = ref(false);

const sendrequest = () => {

    console.log('send join request', barbecueStore.barbecue.id);
    axios.post('/sendbarbecuejoinrequest/' + barbecueStore.barbecue.id);
    authStore.updateUserData();
    solicitutenviada.value = true;
}

</script>

<template>

    <div class="noauthdiv bg-white h-full w-full justify-center  p-5">
        <div class="mt-20 ">

            <p class="text-center font-extrabold text-3xl text-red-600">No estàs inscrit en aquesta barbacoa!</p>
            <img src="/assets/img/giphy.gif" alt="" class="gifburguer">
        </div>


        <div class="w-full h-20 noauthchatdiv justify-center  content-center flex mt-5">
            <div class="h-14 w-14  ml-5 mt-auto mb-auto svgicondiv">
                <svg width="50px" height="auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M7 9H17M7 13H17M21 20L17.6757 18.3378C17.4237 18.2118 17.2977 18.1488 17.1656 18.1044C17.0484 18.065 16.9277 18.0365 16.8052 18.0193C16.6672 18 16.5263 18 16.2446 18H6.2C5.07989 18 4.51984 18 4.09202 17.782C3.71569 17.5903 3.40973 17.2843 3.21799 16.908C3 16.4802 3 15.9201 3 14.8V7.2C3 6.07989 3 5.51984 3.21799 5.09202C3.40973 4.71569 3.71569 4.40973 4.09202 4.21799C4.51984 4 5.0799 4 6.2 4H17.8C18.9201 4 19.4802 4 19.908 4.21799C20.2843 4.40973 20.5903 4.71569 20.782 5.09202C21 5.51984 21 6.0799 21 7.2V20Z"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>

            <p class="mt-auto mb-auto ml-2 font-bold">Per poder utilitzar el xat d'aquesta barbacoa, necessites entrar
                al grup.</p>
        </div>

        <div class="w-full h-20 noauthchatdiv justify-center content-center flex mt-8 ">

            

            <div
                v-if="barbecueStore.barbecue.friendships.map((e => e.user_id)).includes(authStore.user.id) || solicitutenviada">
                <div class="requestsended">
                    Solicitud enviada
                </div>
            </div>

            <button v-else class="cssbuttons-io-button" @click="sendrequest">
                Enviar solicitud
                <div class="icon">
                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                            fill="currentColor"></path>
                    </svg>
                </div>
            </button>


        </div>

        <div>


        </div>
    </div>

</template>

<style scoped>
.noauthdiv {
    border-radius: 20px;
}

.noauthchatdiv {
    border-radius: 10px;
}

.svgicondiv {
    border-radius: 10px;
}

.gifburguer {
    height: 300px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
}


.requestsended {
    background: #129700;
    color: white;
    font-family: inherit;
    padding: 1.35em;

    font-size: 17px;
    font-weight: 500;
    border-radius: 0.9em;
    border: none;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    box-shadow: inset 0 0 1.6em -0.6em #129700;
    overflow: hidden;
    position: relative;
    height: 2.8em;

    cursor: pointer;
    text-align: center;
}

.cssbuttons-io-button {
    background: #cc4e00;
    color: white;
    font-family: inherit;
    padding: 0.35em;
    padding-left: 1.2em;
    font-size: 17px;
    font-weight: 500;
    border-radius: 0.9em;
    border: none;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    box-shadow: inset 0 0 1.6em -0.6em #ff2600;
    overflow: hidden;
    position: relative;
    height: 2.8em;
    padding-right: 3.3em;
    cursor: pointer;
}

.cssbuttons-io-button .icon {
    background: white;
    margin-left: 1em;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 2.2em;
    width: 2.2em;
    border-radius: 0.7em;
    box-shadow: 0.1em 0.1em 0.6em 0.2em #ff2600;
    right: 0.3em;
    transition: all 0.3s;
}

.cssbuttons-io-button:hover .icon {
    width: calc(100% - 0.6em);
}

.cssbuttons-io-button .icon svg {
    width: 1.1em;
    transition: transform 0.3s;
    color: #cc4e00;
}

.cssbuttons-io-button:hover .icon svg {
    transform: translateX(0.1em);
}

.cssbuttons-io-button:active .icon {
    transform: scale(0.95);
}
</style>