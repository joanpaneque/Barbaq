import { defineStore } from 'pinia';

export const useProfileStore = defineStore('profile', {
    state: () => ({
        user: null
    }),
    actions: {
        setUser(profile) {
            this.user = profile;
        }        
    },
    getters: {

    },
});