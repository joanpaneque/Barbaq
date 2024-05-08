<script setup>
import { useProfileStore } from "@/stores/profile";
import { Link } from '@inertiajs/vue3';
const profileStore = useProfileStore();

</script>

<template>
    <div class="relative">
        <div class="skeleton bg-gray-50 w-full mt-5 privatprofile  select-none blur-sm opacity-50">
            <div class="barbecue-container ">
                <div class="barbecue-header">
                    <div class="barbecue-left-section">
                        <div class="barbecue-profile-image">

                            <img :src="profileStore.user.image" alt="Profile image">

                        </div>
                        <div class="barbecue-left-texts">
                            <h1>sdgsdg</h1>
                            <div class="barbecue-address">
                                <img src="/assets/svg/marker.svg" alt="Location" />
                                <span>Figueres</span>
                            </div>
                        </div>
                    </div>
                    <div class="barbecue-date">
                        20 hores
                    </div>
                </div>
                <div class="barbecue-content-wrapper">
                    <span class="barbecue-title">Barbacoa en Figueres</span>
                    <div class="barbecue-content">
                        <p class="mb-3">Estem buscant gent per fer una barbacoa a Figueres, si t'agrada la carn i el bon
                            ambient, no dubtis en apuntar-te! No se que posar aqui, lorem ipsum bla bla bla, hola i bon
                            dia!
                        </p>
                        <div class="flex gap-3">
                            <img src="/assets/img/bbq1.jpg" class="object-cover w-full h-64 rounded-md opacity-75" alt="">
                            <img src="/assets/img/barbaquiu2.jpg" class="object-cover w-full h-64 rounded-md opacity-75" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center  bg-transparent ">
                <img src="/assets/img/lockprivate.png" class="h-32 ml-auto mr-auto " alt="Descripción de la imagen">
                <p class="text-3xl text-black font-black ">Perfil privat</p>
                <p class="font-black text-black ">Tens que ser el seu amic per veure les seves barbacoes</p>
            </div>
        </div>
    </div>



</template>

<style scoped>
.barbecue-comment-send {
    background: #FF6100;
    color: #fff;
    margin-left: auto;
    padding: 5px 10px;
    border-radius: 10px;
    width: fit-content;
    border: 1px solid transparent;

}


.barbecue-comment-send:disabled {
    border: 1px solid #ddd;

    background: none;
}



.barbecue-comment-input-itself-answer-content-text {
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.barbecue-comment-input textarea {
    resize: none;
    padding-inline: 10px;
    padding-top: 5px;
    width: 100%;
}

.barbecue-comment-input textarea:focus-visible {
    outline: none;
}

.barbecue-comment-input-itself {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}

.barbecue-comment-input-itself-answer {

    border-bottom: 1px solid #ddd;
    padding: 5px;
    display: flex;
    align-items: center;
    height: 30px;
    gap: 5px;
}

.barbecue-comment-input-itself-answer-cross {
    cursor: pointer;
    height: 100%;
    display: flex;
    align-items: center;
    border-radius: 5px;
}

.barbecue-comment-input-itself-answer-cross img {
    height: 60%;
    width: 20px;
}

.barbecue-comment-input-itself-answer-content {
    cursor: pointer;
    height: 100%;
    display: flex;
    align-items: center;
    border-radius: 5px;
    gap: 5px;
    font-size: 14px;
    padding: 5px;
    filter: opacity(0.6);
}

.barbecue-comment-input-itself-answer-content:hover {

    cursor: pointer;
}


.barbecue-comment-input-itself-answer-content img {
    width: 15px;
    height: 15px;
}

.barbecue-comment-input {
    border-radius: 10px;
    display: grid;
    grid-template-columns: 50px auto;
    gap: 10px;
}

.barbecue-comment-input-wrapper {
    padding: 10px;
    display: grid;
    gap: 5px;
}

.barbecue-container {
    width: 100%;
    height: fit-content;

    border-radius: 20px;
    overflow: hidden;
    padding: 12px 20px 19px 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.barbecue-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.barbecue-left-section {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    gap: 10px;
}

.barbecue-date {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    color: #888;
}

.barbecue-profile-image {
    display: flex;
    align-items: center;
    height: 100%;
}

.barbecue-profile-image img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.barbecue-comment-profile-image {
    display: flex;
    height: 100%;
}

.barbecue-comment-profile-image img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.barbecue-left-texts {
    display: flex;
    flex-direction: column;
}

.barbecue-address img {
    width: 13px;
    height: 13px;
    transform: translateY(-2px);
}

.barbecue-address {
    display: flex;
    align-items: center;
    gap: 3px;
    filter: opacity(0.6);
    font-size: 14px;
}

.barbecue-title {
    font-size: 24px;
}

.barbecue-content {
    font-size: 16px;
    line-height: 1.5;
    margin-top: 5px;
}

.barbecue-footer {
    border-radius: 10px;
    padding-inline: 20px;
    display: grid;
    gap: 10px;
}
</style>
