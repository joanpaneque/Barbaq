<script setup>
import { defineProps } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import AuthAccount from '@/Components/Auth/AuthAccount.vue';
import MainLeftAside from '@/Components/Asides/MainLeftAside.vue';

const props = defineProps({
    title: {
        type: String,
        required: false
    },
  friends: {
    type: Array,
    required: true
  }
});

</script>

<template>
    <div class="main-layout-container">
        <div class="main-layout-header">
            <div class="main-layout-application-logo">
                <ApplicationLogo />
            </div>
            <div class="main-layout-title">{{ title ?? 'Barbeq' }}</div>
            <div class="main-layout-profile">
                <AuthAccount />
            </div>
        </div>
        <div class="main-layout-content">
            <div class="main-layout-left-aside">
                <MainLeftAside />
            </div>
            <div class="main-layout-right-wrapper">
                <div class="main-layout-main-content">
                    <slot name="main-content"></slot>
                </div>
                <div class="main-layout-right-aside">
                    <slot name="right-aside"></slot>
                </div>
            </div>

        </div>



    </div>
</template>

<style scoped>

.main-layout-left-aside {
    margin-top: 20px;
}

.main-layout-content {
    padding-top: 90px;
    display: grid;
    grid-template-columns: 270px auto;
    padding-left: 12vw;
    gap: 20px;
    height: 100%;
    overflow: hidden;
}

.main-layout-right-aside {
    width: 350px;
    float: right;
    position: fixed;
    top: 110px;
    right: 12vw;
}

.main-layout-main-content {
    height: calc(100vh - 90px);
    width: 100%;
    padding-right: calc(12vw + 350px + 4px);
    padding-bottom: 200px;
    scrollbar-gutter: stable;
    padding-top: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.main-layout-right-wrapper {
    width: 100%;
    height: 100%;
}

/* Header */
.main-layout-header {
    padding-inline: 12%;
    grid-template-columns: 270px auto 350px;
    display: grid;
    grid-template-rows: 100%;
    height: 90px;
    background: #fff;
    position: fixed;
    width: 100%;
    z-index: 100;
}

.main-layout-application-logo {
    display: flex;
    align-items: center;
}

.main-layout-container {
    height: 100vh;
    background: #E9E9E9;
}

.main-layout-title {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
}
.main-layout-profile {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>