<script setup>
import { defineProps } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

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
            <div class="main-layout-application-logo">
                <ApplicationLogo />
            </div>
            <div class="main-layout-title">{{ title ?? 'Barbeq' }}</div>
            <div class="main-layout-profile">
                <div class="profile-image">
                    <img src="/assets/img/person.jpg" alt="Icon" />
                </div>
                <div class="profile-naming-wrapper">
                    <div class="profile-naming">
                        <span class="profile-name">Joan</span>
                        <span class="profile-surnames">Paneque Domingo</span>
                    </div>
                </div>
                <div class="profile-settings-icon">
                    <img src="/assets/svg/settings.svg" alt="Settings" />
                </div>
            </div>
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
    grid-template-rows: 100%;
    height: 90px;
    background: #fff;
    position: fixed;
    width: 100%;
}

.main-layout-content {
    --gap: 20px;
    padding-top: calc(90px + var(--gap));
    display: grid;
    height: 100vh;
    gap: var(--gap);
}

.main-layout-title {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
}

.main-layout-profile {
    display: grid;
    height: 100%;
    grid-template-columns: 70px auto auto;
    gap: 10px;
}

.profile-image {
    width: fit-content;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-image img {
    position: relative;
    height: 60px;
    width: 60px;
    object-fit: cover;
    border-radius: 50%;
}

.profile-naming-wrapper {
    display: grid;
    align-items: center;
    height: 100%;
}

.profile-settings-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-settings-icon img {
    height: 30px;
    width: 30px;
    transition: 0.5s;

}

.profile-settings-icon img:hover {
    cursor: pointer;
    transform: rotate(180deg);
    transition: 0.3s;
}

.profile-naming {
    height: 60px;
    display: grid;
}

.profile-name {
    font-size: 24px;
    font-weight: bold;
}

.profile-surnames {
    margin-top: -10px;
}

.left-aside {
    width: 100%;
    background: white;
    height: 400px;
    border-radius: 20px;
}
</style>