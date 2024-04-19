<script setup>

</script>

<template>
    <div class="auth-account-container">
        <div class="auth-account-image">
            <img src="/assets/img/person.jpg" alt="Icon" />
        </div>
        <div class="auth-account-naming-wrapper">
            <div class="auth-account-naming">
                <span class="auth-account-name">Joan</span>
                <span class="auth-account-surnames">Paneque Domingo</span>
            </div>
        </div>
        <div class="auth-account-settings">
            <div class="auth-account-settings-bubble">
                <img src="/assets/svg/settings.svg" alt="User settings" />
            </div>
        </div>
    </div>
</template>

<style scoped>

    .auth-account-container:hover {
        background: #f2f2f2;
        border-radius: 3000px;
        cursor: pointer;
    }

    .auth-account-container {
        display: grid;
        grid-template-columns: 50px auto 50px;
        height: fit-content;
        width: 270px;
        gap: 12px;
    }

    .auth-account-image {
        width: 100%;
        height: 100%;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .auth-account-image img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .auth-account-naming {
        display: grid;
        height: 60px;
        align-items: center;
    }

    .auth-account-naming span {
        display: block;
    }

    .auth-account-name {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: -5px;
    }

    .auth-account-surnames {
        font-size: 14px;
        margin-top: -20px;
    }

    .auth-account-naming-wrapper {
        display: flex;
        align-items: center;
    }
    
    .auth-account-settings {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .auth-account-settings-bubble {
        width: 40px;
        height: 40px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-account-settings-bubble img {
        width: 20px;
        height: 20px;
        transition: transform 0.3s;
    }

    .auth-account-settings:hover {
        cursor: pointer;
    }

    .auth-account-settings:hover .auth-account-settings-bubble {
        background: #ccc;
    }

    .auth-account-settings:hover .auth-account-settings-bubble img {
        transform: rotate(90deg);
        transition: transform 0.3s;
    }


</style>