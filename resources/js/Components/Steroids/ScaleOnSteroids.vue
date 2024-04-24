<script setup>
    import { defineProps, defineEmits, ref } from 'vue';

    const props = defineProps({
        modelValue: {
            type: Number,
            required: true
        },
        scales: {
            type: Array,
            required: true,
        }
    });

    const emit = defineEmits(['update:modelValue']);

    const currentValue = ref(props.modelValue);

    const updateValue = (value) => {
        currentValue.value = value;

        const step = (100 - 10) / (props.scales.length - 1);

        const index = Math.round((value - 10) / step);

        emit('update:modelValue', index);
    };

</script>

<template>
    <div class="scales-on-steroids-container">
        <input type="range" min="10" max="100" :step="100 / (props.scales.length)"
        :value="currentValue"
        @input="updateValue($event.target.value)" :style="{
            width: `calc(100% + ${100 / (props.scales.length)}% - 17px)`,
        }">

        <div class="slider">
            <div class="scale-point" v-for="(scale, index) in props.scales" :key="scale.value" :style="{
                left: `${index * 100 / (props.scales.length - 1)}%`,
            }">
                <span>{{ scale.label }}</span>            
            </div>
        </div>
    </div>
</template>


<style scoped>
    .scales-on-steroids-container {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        margin-bottom: 30px;
        margin-top: 20px;
        cursor: pointer;
    }

    input {
        position: absolute;
        display: block;
    }

    /* Remove the default styling */
    input[type=range] {
        -webkit-appearance: none;
        margin: 18px 0;
        background: transparent;
        margin: 0;
        z-index: 1;
        cursor: pointer;
        height: 80px;
    }

    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 15px;
        height: 15px;
        cursor: pointer;
        border-radius: 50%;
        background: #000;
    }

    .slider {
        width: calc(100% - 15px);
        margin: 0 auto;
        position: relative;
        height: 1px;
        background: #000;
        pointer-events: none;
        /* remove drag */
        -webkit-user-drag: none;
    }

    .scale-point {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: transparent;
        border: 1px solid #000;
        background: #fff;
        position: absolute;
        top: -5px;
        transform: translateX(-50%);
        font-size: 0.8rem;
        pointer-events: none;
        -webkit-user-drag: none;
    }

    .scale-point span {
        position: absolute;
        transform: translateX(-50%);
        top: 13px;
        white-space: nowrap;
        font-size: 14px;
        pointer-events: none;
        user-select: none;
        -webkit-user-drag: none;
    }

    .scale-point:first-child span {
        left: 16px;
    }

    .scale-point:last-child span {
        margin-left: -12px;
        /* remove the nowrap */
        white-space: normal;
        line-height: 1.2;
        text-align: right;
    }
</style>
