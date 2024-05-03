import { defineStore } from 'pinia';
import axios from 'axios';

export const useBarbecueStore = defineStore('barbecue', {
    state: () => ({
        preInsertedBarbecues: [],
        barbecues: [],
        filters: {},
        limitPackets: 10,
        barbecue: null,
    }),
    actions: {
        setBarbecue(barbecue) {
            this.barbecue = barbecue;
        },
        fetchBarbecues(filters) {
            this.filters = filters;

            axios.get('/api/barbecues', {
                params: {
                    ...filters,
                    limit: this.limitPackets
                }
            })
            .then(response => {
                this.barbecues = response.data;
                this.preInsertedBarbecues = [];
            });
        },
        insertBarbacue(data, user) {
            this.preInsertedBarbecues.push({...data, user, created_at: new Date()});
        },
        fetchNext() {
            const offset = this.barbecues.length + this.preInsertedBarbecues.length;
            axios.get('/api/barbecues', {
                params: {
                    ...this.filters,
                    offset,
                    limit: this.limitPackets
                }
            })
            .then(response => {
                this.barbecues.push(...response.data);
            });
        }
    },
    getters: {

    },
});