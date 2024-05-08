<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link href="/">
        <img class="application-logo-with-text" src="/assets/img/barbaq-logo.png" alt="Barbeq" />
        <img class="application-logo-without-text" src="/assets/img/barbaq-logo-small.png" alt="Barbeq" />
    </Link>
</template>

<style scoped>
    img {
        width: 200px;
        margin: 0 auto;
        object-fit: cover;
        display: block;
    }

    .application-logo-without-text {
        display: none;
    }

    @media (max-width: 768px) {
        .application-logo-with-text {
            display: none;
        }

        .application-logo-without-text {
            display: block;
            width: 100px;

        }
    }

</style>
