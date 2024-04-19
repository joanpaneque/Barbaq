<script setup>
import { ref, onMounted } from 'vue';

const isOpen = ref(false);

const toggleDropdown = () => {
    if (!isOpen.value) {
        isOpen.value = true;
    }
};
</script>

<template>
    <div class="dropdown" :class="{ open: isOpen }" @click="toggleDropdown">

        <div class="flex">
            <form action="" class="w-full">
                <input class="w-full" type="text" placeholder="Nova barbacoa...">
            </form>
            <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M20.1498 7.93997L8.27978 19.81C7.21978 20.88 4.04977 21.3699 3.32977 20.6599C2.60977 19.9499 3.11978 16.78 4.17978 15.71L16.0498 3.84C16.5979 3.31801 17.3283 3.03097 18.0851 3.04019C18.842 3.04942 19.5652 3.35418 20.1004 3.88938C20.6356 4.42457 20.9403 5.14781 20.9496 5.90463C20.9588 6.66146 20.6718 7.39189 20.1498 7.93997V7.93997Z"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>
        </div>

        <div class="content" :style="{ height: isOpen ? 'auto' : '0' }">
            <h1>sdfsd</h1>
            <h1>sdfsd</h1>
            <h1>sdfsd</h1>
            <h1>sdfsd</h1>
            <h1>sdfsd</h1>
            
        </div>
    </div>
</template>

<style scoped>
.dropdown {
    position: relative;
    width: 100%;
    background-color: white;
    border-radius: 20px;
    padding: 20px;
    cursor: pointer;
}

.content {
    overflow: hidden;
    transition: height 0.3s ease;
}
</style>
