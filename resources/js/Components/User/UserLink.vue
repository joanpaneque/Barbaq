<script setup>
    import { defineProps } from 'vue';
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        userId: {
            type: Number,
            required: true,
            default: 0
        },
        name: {
            type: String,
            required: true
        }
    });

</script>

<template>
    <Link :href="route('profile.show', props.userId)">
        <span>{{ props.name }}</span>
    </Link>
</template>

<style scoped>
    span:hover {
        text-decoration: underline;
    }
</style>