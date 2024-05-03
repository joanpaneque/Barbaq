<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps({
    datetime: {
        type: String,
        required: true
    }
});

const currentDate = ref(new Date());

onMounted(() => {
    const interval = setInterval(() => {
        currentDate.value = new Date(); // Actualiza la fecha actual cada segundo
    }, 500);

    onUnmounted(() => {
        clearInterval(interval); // Limpia el intervalo cuando el componente se desmonte
    });
});

const formattedDate = computed(() => formatDate(props.datetime, currentDate.value));

function formatDate(datetime, current) {
    const today = current; // Usa la fecha actual reactivo
    const then = new Date(datetime);

    const catalanMonths = {
        '01': 'gen.',
        '02': 'feb.',
        '03': 'març',
        '04': 'abr.',
        '05': 'maig',
        '06': 'juny',
        '07': 'jul.',
        '08': 'ag.',
        '09': 'set.',
        '10': 'oct.',
        '11': 'nov.',
        '12': 'des.'
    };

    const differenceInMilliseconds = today - then;
    const differenceInSeconds = differenceInMilliseconds / 1000;
    const differenceInMinutes = differenceInSeconds / 60;
    const differenceInHours = differenceInMinutes / 60;
    const differenceInDays = differenceInHours / 24;
    const differenceInMonths = differenceInDays / 30;
    const differenceInYears = differenceInMonths / 12;

    if (differenceInMinutes < 1) {
        return `${Math.floor(differenceInSeconds)} segon${Math.floor(differenceInSeconds) != 1 ? 's' : ''}`;
    } else if (differenceInMinutes < 60) {
        return Math.floor(differenceInMinutes) + ' minut' + (Math.floor(differenceInMinutes) > 1 ? 's' : '');
    } else if (differenceInHours < 24) {
        return Math.floor(differenceInHours) + ' hores';
    } else if (differenceInDays < 3) {
        return Math.floor(differenceInDays) + (Math.floor(differenceInDays) > 1 ? ' dies' : ' dia');
    } else {
        return then.getDate() + ' ' + catalanMonths[('0' + (then.getMonth() + 1)).slice(-2)] + ' ' + then.getFullYear();
    }
}
</script>

<template>
    <span>{{ formattedDate }}</span>
</template>

<style scoped>

</style>
