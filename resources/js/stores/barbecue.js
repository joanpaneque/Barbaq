import { defineStore } from 'pinia';
import axios from 'axios';

export const useBarbecueStore = defineStore('barbecue', {
  state: () => ({
    preInsertedBarbecues: [],
    barbecues: [],
    filters: {},
    limitPackets: 10,
    barbecue: null,
    basket: {
      basket_product: [],
    },
    products: [],
  }),
  actions: {
    setBarbecue(barbecue) {
      this.barbecue = barbecue;
      this.basket = { ...barbecue.basket }; 
    },
    fetchBarbecues(filters = this.filters) {
      this.filters = filters;
      axios.get('/api/barbecues', {
        params: {
          ...filters,
          limit: this.limitPackets,
        },
      }).then(response => {
        this.barbecues = response.data;
        this.preInsertedBarbecues = [];
      });
    },
    insertBarbacue(data, user) {
      this.preInsertedBarbecues.push({ ...data, user, created_at: new Date(), comments: [] });
    },
    fetchNext() {
      const offset = this.barbecues.length + this.preInsertedBarbecues.length;
      axios.get('/api/barbecues', {
        params: {
          ...this.filters,
          offset,
          limit: this.limitPackets,
        },
      }).then(response => {
        this.barbecues.push(...response.data);
      });
    },
    setBasketProduct(productId, quantity) {
      const product = this.basket.basket_product.find(item => item.product.id === productId);
      if (product) {
        product.quantity = quantity;
      } else {
        this.basket.basket_product.push({ product: { id: productId }, quantity });
      }
      this.basket = { ...this.basket }; 
    },
    removeBasketProduct(productId) {
      this.basket.basket_product = this.basket.basket_product.filter(item => item.product.id !== productId);
      this.basket = { ...this.basket }; 
    },
  },
});
