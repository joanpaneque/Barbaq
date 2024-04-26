<script setup>
import { ref, defineProps, defineEmits } from 'vue';

// Define las propiedades y los eventos emitidos por el componente
const props = defineProps({
    modelValue: String
});

const emits = defineEmits(['update:modelValue']);

const inputValue = ref(props.modelValue);

const onInput = (event) => {
    inputValue.value = event.target.value;
    emits('update:modelValue', inputValue.value);
};
</script>

<template>
    <div class="search-on-steroids-container">
        <input 
            type="text" 
            placeholder="Cerca paraules clau..."
            :value="inputValue"
            @input="onInput"
        />
        <button>
            <img src="/assets/svg/search.svg" alt="Icon" />
        </button>
    </div>
</template>

<style scoped>
    .search-on-steroids-container {
        position: relative;
        height: 45px;
    }

    .search-on-steroids-container input {
        width: 100%;
        border: 1px solid #adadad;
        height: 100%;
        padding-left: 20px;
        border-radius: 9999px;
    }

    .search-on-steroids-container input:focus-visible {
        outline: none;
    }

    button {
        position: absolute;
        right: 17px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        opacity: 0.3;
        transition: 0.2s;
    }

    button img {
        width: 20px;
    }

    .search-on-steroids-container input:focus {
        border-color: #000;
    }

    .search-on-steroids-container input:focus + button {
        opacity: 1;
        transition: 0.2s;
    }
</style>