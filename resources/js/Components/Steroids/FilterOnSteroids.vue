<script setup>
    const props = defineProps({
        modelValue: {
            type: String,
            required: true,
        },
        filters: {
            type: Object,
            required: true,
        }
    });

    // modelValues in an array of strings that represent the selected filters

    const emit = defineEmits(['update:modelValue']);

    const updateValue = (value) => {
        emit('update:modelValue', value);
    };

    function handleFilterClick(key) {
        if (props.modelValue.includes(key)) {
            const index = props.modelValue.indexOf(key);
            props.modelValue.splice(index, 1);
        } else {
            props.modelValue.push(key);
        }
        updateValue(props.modelValue);
    }

</script>

<template>
    <div class="filter-on-steroids-container">
        <div v-for="(filter, key) in props.filters" :key="key" class="filter-on-steroids" @click="handleFilterClick(key)">
            <input type="checkbox" :id="key" :value="key" v-model="props.modelValue" @change="updateValue($event.target.value)">
            <div class="filter-on-steroids-checkbox" :style="{
                background: props.modelValue.includes(key) ? '#ff6100' : '#fff',
                border: props.modelValue.includes(key) ? '1px solid #ff6100' : '1px solid #ccc',
            }">
                <img class="filter-on-steroids-check" v-if="props.modelValue.includes(key)" src="/assets/svg/check.svg" alt="Check icon">
            </div>
            <label :for="key">{{ filter }}</label>
        </div>
    </div>
</template>

<style scoped>
    .filter-on-steroids-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        user-select: none;
    }

    .filter-on-steroids {
        display: flex;
        gap: 5px;
        background: #f5f5f5;
        border: 1px solid #f5f5f5;
        border-radius: 20px;
        padding: 5px 10px;
        align-items: center;
        transition: border 0.1s;
    }

    input[type="checkbox"] {
        display: none;
    }

    input[type="checkbox"] + label {
        cursor: pointer;
        border-radius: 20px;
    }

    .filter-on-steroids-checkbox {
        width: 15px;
        height: 15px;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .filter-on-steroids-check {
        filter: invert(1);
        width: 7px;
        user-select: none;
    }

    .filter-on-steroids:hover {
        cursor: pointer;
        border: 1px solid #ff6100;
        transition: border 0.05s;
    }

    label {
        pointer-events: none;
    }
 
</style>