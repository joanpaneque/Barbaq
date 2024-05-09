<script setup>
    import { defineProps, defineEmits, ref, onMounted, onUnmounted } from 'vue';

    const props = defineProps({
        modelValue: {
            type: String,
            required: true,
        },
        options: {
            type: Object,
            required: true,
        }
    });


    function randomCharacterHash(length) {
        let result = 's';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    const hash = randomCharacterHash(5);


    const emit = defineEmits(['update:modelValue', 'input']);

    const updateValue = (value) => {
        emit('update:modelValue', value);
        emit('input', value);
    };

    const isOpen = ref(false);

    const handleOptionSelect = (index) => {
        updateValue(index);
        isOpen.value = false;
    };

    const handleOpen = () => {
        isOpen.value = !isOpen.value;
    };

    const handleClickOutside = (event) => {
        if (!event.target.closest(`.select-on-steroids-container.${hash}`)) {
            isOpen.value = false;
        }
    };

    onMounted(() => {
        document.addEventListener('click', handleClickOutside);
    });

    onUnmounted(() => {
        document.removeEventListener('click', handleClickOutside);
    });
</script>

<template>
    <div :class="`select-on-steroids-container ${hash}`"
        :style="{ zIndex: isOpen ? 1 : 0 }">
        <div class="select-on-steroids-input" @click="handleOpen">
            <span>{{ props.options[props.modelValue] }}</span>
            <img src="/assets/svg/arrow.svg" alt="Icon" :style="{ transform: isOpen ? 'rotate(180deg)' : 'rotate(0deg)' }">
        </div>
        <div class="select-on-steroids-dropdown" v-show="isOpen">
            <div class="select-on-steroids-option" v-for="(option, index) in props.options" :key="index" @click="handleOptionSelect(index)">
                <span>{{ option }}</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .select-on-steroids-container {
        position: relative;
        width: 100%;
        user-select: none;
    }

    .select-on-steroids-input {
        padding: 10px 20px;
        border-radius: 10px;
        background: #eee;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .select-on-steroids-input:hover {
        cursor: pointer;
    }

    .select-on-steroids-input img {
        height: 20px;
    }

    .select-on-steroids-dropdown {
        position: absolute;
        background: #f6f6f6;
        width: 100%;
        border-radius: 10px;
        margin-top: 10px;
        overflow: hidden;
    }

    .select-on-steroids-option {
        padding: 10px 20px;
    }

    .select-on-steroids-option:hover {
        background: #e9e9e9;
        cursor: pointer;
    }

    @media (max-width: 1200px) {
        /* the select options will be displayed on the top of the input */
        .select-on-steroids-dropdown {
            bottom: 55px;
        }

    }
</style>