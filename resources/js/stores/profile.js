import { defineStore } from 'pinia';

export const useProfileStore = defineStore('profile', {
    state: () => ({
        user: null,
        friendStatus: null,
    }),
    actions: {
        setUser(profile) {
            this.user = profile;
        },
        setStatus(status) {
            this.friendStatus = status;
        }
    },
    getters: {

    },
});