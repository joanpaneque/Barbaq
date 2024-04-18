<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const googleLogin = () => {
    window.location.href = '/auth/google';
};
</script>

<template>

        <Head title="Log in" />

        <!-- <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form> -->

        
        <div class="center">
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="form">
                <div class="flex-column">
                    <label>Email</label>
                </div>
                <div class="inputForm">
                    <img src="/assets/img/arrova.png" alt="Arrova" class="w-5">
                    <input
                        id="email"
                        type="email"
                        class="input" 
                        placeholder="Escriu el teu Email" 
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <div class="flex-column">
                    <label>Contrasenya</label>
                </div>
                <div class="inputForm">
                    <img src="/assets/img/lock.png" alt="Lock" class="w-5">
                    <input 
                        id="password"
                        type="password"
                        class="input"
                        placeholder="Escriu la teva Contrasenya"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <div class="flex-row">
                    <div>
                        <input type="radio" v-model="form.remember">
                        <label>Recorda'm</label>
                    </div>
                    <!-- <span class="span">Has oblidat la contrasenya?</span> -->
                </div>

                <button class="button-submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Iniciar Sessió</button>
                
                <p class="p">
                    No tens compte? <Link :href="route('register')" class="span">Registra't</Link>
                </p>

                <p class="p line">O amb</p>

                <div class="flex-row">
                    <button 
                        class="btn google"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="googleLogin"
                    >
                        <img src="/assets/svg/google_icon.svg" alt="Google" class="w-8">
                        Google
                    </button>
                </div>
            </form>
        </div>

</template>

<style>
body {
    background-color: #E4E4E4;
}

.center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    background-color: #ffffff;
    padding: 30px;
    width: 450px;
    border-radius: 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

::placeholder {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.form button {
    align-self: flex-end;
}

.flex-column>label {
    color: #151717;
    font-weight: 600;
}

.inputForm {
    border: 1.5px solid #ecedec;
    border-radius: 10px;
    height: 50px;
    display: flex;
    align-items: center;
    padding-left: 10px;
    transition: 0.2s ease-in-out;
}

.input {
    border-radius: 10px;
    border: none;
    width: 100%;
    height: 100%;
}

.input:focus {
    outline: none;
    --tw-ring-shadow: none !important;
}

.inputForm:focus-within {
    border: 1.5px solid #2d79f3;
}

.flex-row {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 10px;
    justify-content: space-between;
}

.flex-row > div > label {
    font-size: 14px;
    color: black;
    font-weight: 400;
    padding-left: 10px;
}

.span {
    font-size: 14px;
    margin-left: 5px;
    color: #2d79f3;
    font-weight: 500;
    cursor: pointer;
}

.button-submit {
    margin: 20px 0 10px 0;
    background-color: #151717;
    border: none;
    color: white;
    font-size: 15px;
    font-weight: 500;
    border-radius: 10px;
    height: 50px;
    width: 100%;
    cursor: pointer;
}

.p {
    text-align: center;
    color: black;
    font-size: 14px;
    margin: 5px 0;
}

.btn {
    margin-top: 10px;
    width: 100%;
    height: 50px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 500;
    gap: 10px;
    border: 1px solid #ededef;
    background-color: white;
    cursor: pointer;
    transition: 0.2s ease-in-out;
}

.btn:hover {
    border: 1px solid #2d79f3;
    ;
}
</style>