<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        title: {
            type: String,
            required: false
        }
    });

</script>

<template>
    <div class="main-layout-container">
        <div class="main-layout-header">
            <div class="bg-yellow-200">LOGO</div>
            <div class="bg-green-200">{{ title ?? 'Barbeq' }}</div>
            <div class="bg-blue-200">LOGIN</div>
        </div>
        <div class="main-layout-content">
            <div class="main-layout-left-aside">
                <div class="left-aside">

                </div>
            </div>
            <div class="main-layout-content-wrapper">
                <slot name="main-content"></slot>
            </div>
            <div class="main-layout-right-aside">
                <slot name="right-aside"></slot>
            </div>
        </div>

    </div>
</template>

<style scoped>

    .main-layout-header,
    .main-layout-content {
        padding-inline: 12%;
        grid-template-columns: 270px auto 350px;
    }

    .main-layout-header {
        display: grid;
        height: 90px;
        background: red;
    }

    .main-layout-content {
        display: grid;
        gap: 20px;
        padding-top: 20px;
    }

    .left-aside {
        width: 100%;
        background: white;
        height: 400px;
        border-radius: 20px;
    }
</style>