<script setup>
import { ref } from 'vue';
import { createApp } from 'vue'
import { QuillEditor } from '@vueup/vue-quill'
import { useAuthStore } from "@/stores/auth";
import { useBarbecueStore } from '@/stores/barbecue';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';

const authStore = useAuthStore();
const barbecueStore = useBarbecueStore();


const app = createApp()
app.component('QuillEditor', QuillEditor)

const isOpen = ref(false);
const quillContent = ref(null);

const barbecueForm = useForm({
    title: '',
    content: '',
    latitude: '123',
    longitude: '123',
    address: '123',
});

const toggleDropdown = () => {
    if (!isOpen.value) {
        isOpen.value = true;
    }
};

const submitBarbecueForm = () => {
    barbecueForm.content = quillContent.value.getHTML();

    const mensajeTelegram = `👤 <b>${authStore.user.name} ${authStore.user.surnames}</b> ha creado la barbacoa 🔥 "${barbecueForm.title}"\n ✏️ Creat per: <a href="https://barbaq.es/profile/${authStore.user.id}">Perfil</a>`;
    const textoCodificado = encodeURIComponent(mensajeTelegram);
    const urlTelegram = `https://api.telegram.org/bot7062247411:AAFn72YwZboq4fSt3YmOuAcLsMtX-l76fHk/sendMessage?chat_id=@bbqtest&text=${textoCodificado}&parse_mode=html`;

    axios.post(urlTelegram)
        .then(() => {
            console.log('Mensaje enviado a Telegram');
        })
        .catch((error) => {
            console.error('Error al enviar el mensaje a Telegram:', error);
        });



    const mensajeDiscord = `Holaa 1`;
    const payloadDiscord = {
        content: mensajeDiscord
    };

    const webhookURL = 'https://discord.com/api/webhooks/1234888722391109712/MFQE_6mVi1ROVCTQgJmGuV5nKojCIXggHOmwptwqi9f55io7FLYb5hRrRVg8y3L8Si3Y';

    axios.post(webhookURL, payloadDiscord, {
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(() => {
            console.log('Mensaje enviado a Discord');
        })
        .catch((error) => {
            console.error('Error al enviar el mensaje a Discord:', error);
        });



    axios.post("/barbecues", barbecueForm)
        .then(() => {
            barbecueStore.insertBarbacue(barbecueForm, authStore.user);
            barbecueForm.reset();
            quillContent.value.setHTML('');
            isOpen.value = false;
        });
};

</script>

<template>

    <form @submit.prevent="submitBarbecueForm" class="dropdown " :class="{ open: isOpen }" @click="toggleDropdown"
        v-if="authStore.user">
        <div class="flex">
            <img :src="authStore.user.image" alt="Foto de perfil" class="mr-2 h-16 w-16 rounded-full imgprofile">
            <div class="w-full mt-auto mb-auto ">
                <div class="input-container">
                    <input type="text" placeholder="Crear nova barbacoa..." v-model="barbecueForm.title" aria-label="Títol de la barbacoa">
                </div>
            </div>
            <img src="/assets/svg/edit.svg" alt="Imatge de editar" class="">
        </div>

        <div class="content " :style="{ height: isOpen ? 'auto' : '0' }">

            <section class="mt-3 ">

                <QuillEditor theme="snow" class="rounded-b-lg min-h-24" ref="quillContent"></QuillEditor>

            </section>

            <div class="flex">
                <button class=""><img src="/assets/svg/addphoto.svg" alt="Imatge de editar" class=""></button>
                <button class=""><img src="/assets/svg/addlocation.svg" alt="Imatge de editar" class=""></button>

                <button type="submit" value="Publicar" class="boton-elegante ml-auto mt-2">Publicar</button>
            </div>
        </div>
    </form>
</template>

<style scoped>
.dropdown {
    position: relative;
    width: 100%;
    background-color: white;
    border-radius: 20px;
    padding: 10px 20px;
    cursor: pointer;
}

.content {
    overflow: hidden;
    transition: max-height 0.9s ease-out;
    max-height: 0;
    width: 100%;
}

.dropdown.open .content {
    max-height: none;

}

::placeholder {
    color: #a8a8a8;
}

.boton-elegante {
    padding: 5px 20px;
    width: 250px;
    border: 2px solid #2c2c2c;
    background-color: #1a1a1a;
    color: #ffffff;
    font-size: 1.2rem;
    cursor: pointer;
    border-radius: 20px;
    transition: all 0.4s ease;
    outline: none;
    position: relative;
    overflow: hidden;
    font-weight: bold;
}

.boton-elegante::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle,
            rgba(255, 255, 255, 0.25) 0%,
            rgba(255, 255, 255, 0) 70%);
    transform: scale(0);
    transition: transform 1.5s ease;
}

.boton-elegante:hover::after {
    transform: scale(4);
}

.boton-elegante:hover {
    border-color: #666666;
    background: #292929;
}



.input-container {
    position: relative;

}

.input-container input {
    width: 100%;
    font-size: 26px;
    border: none;
    border-bottom: 2px solid transparent;

    outline: none;
}

.input-container input:focus {
    border-bottom-color: gray;
    /* Color de la línea cuando el input está enfocado */
}

.imgprofile {
    object-fit: cover;
}
</style>
