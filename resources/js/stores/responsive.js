import { defineStore } from 'pinia';
import axios from 'axios';

export const useResponsiveStore = defineStore('responsive', {
    state: () => ({
        screenWidth
    }),
    actions: {

    },
    getters: {

    },
});

window.addEventListener('resize', () => {
    useResponsiveStore.screenWidth = window.innerWidth;
});