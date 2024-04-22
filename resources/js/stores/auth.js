import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null
    }),
    actions: {
        updateUserData() {
            axios.get('/api/user').then(response => {
                if (Object.keys(response.data).length === 0) {
                    this.user = null;
                    return;
                }
                this.user = response.data;
            });
        }
    },
    getters: {

    },
});