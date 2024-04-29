import { defineStore } from 'pinia';

export const useBarbecueStore = defineStore('barbecue', {
    state: () => ({
        barbecue: null,
    }),
    actions: {
        setBarbecue(barbecue) {
            this.barbecue = barbecue;
        }
    },
    getters: {

    },

});