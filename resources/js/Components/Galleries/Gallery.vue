<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
    images: {
        type: Array,
        required: true
    }
})

const fullscreen = ref(false);
const currentImage = ref(0);


function nextImage() {
    currentImage.value = (currentImage.value + 1) % props.images.length;
}

function previousImage() {
    currentImage.value = (currentImage.value - 1 + props.images.length) % props.images.length;
}

function openModal(image) {
    currentImage.value = image;
    fullscreen.value = true;
}

</script>
<template>
    <div class="gallery-container">
        <div class="gallery-modal" v-show="fullscreen" @click="fullscreen = false">
            <div class="gallery-modal-carousel" @click.stop>
                <div class="gallery-modal-carousel-buttons">
                    <button @click="previousImage">
                        <img src="/assets/svg/arrow-small-right.svg" style="transform: rotate(180deg);">
                    </button>
                    <button @click="nextImage">
                        <img src="/assets/svg/arrow-small-right.svg">
                    </button>
                </div>
                <img :src="images[currentImage]" alt="Imatge de la galeria">
            </div>
            <div class="gallery-modal-images">
                <div class="gallery-modal-image" v-for="(image, index) in images" :key="index" :class="{ 'active': index === currentImage }" @click.stop="openModal(index)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
        </div>
        <div class="gallery-mosaic gallery-4" v-if="images.length >= 4">
            <div class="gallery-left"> 
                <div class="gallery-image" v-for="(image, index) in images.slice(0, 2)" :key="index" @click="openModal(index)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
            <div class="gallery-right"> 
                <div class="gallery-image" v-for="(image, index) in images.slice(2, 4)" :key="index" @click="openModal(index + 2)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
        </div>
        <div class="gallery-mosaic gallery-3" v-if="images.length === 3">
            <div class="gallery-left"> 
                <div class="gallery-image" v-for="(image, index) in images.slice(0, 2)" :key="index" @click="openModal(index)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
            <div class="gallery-right"> 
                <div class="gallery-image" v-for="(image, index) in images.slice(2, 3)" :key="index" @click="openModal(index + 2)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
        </div>
        <div class="gallery-mosaic gallery-2" v-if="images.length === 2">
            <div class="gallery-left"> 
                <div class="gallery-image" v-for="(image, index) in images.slice(0, 1)" :key="index" @click="openModal(index)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
            <div class="gallery-right"> 
                <div class="gallery-image" v-for="(image, index) in images.slice(1, 2)" :key="index" @click="openModal(index + 1)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
        </div>
        <div class="gallery-mosaic gallery-1" v-if="images.length === 1">
            <div class="gallery-left"> 
                <div class="gallery-image" v-for="(image, index) in images.slice(0, 1)" :key="index" @click="openModal(index)">
                    <img :src="image" alt="Imatge de la galeria">
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

    .gallery-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: #000000AA;
        z-index: 20000;
        display: grid;
        grid-template-rows: 80% auto;
        padding: 100px;
        gap: 10px;

    }

    .gallery-modal-carousel {
        height: 100%;
        width: 100%;
        position: relative;
    }

    .gallery-modal-carousel-buttons {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        gap: 10px;
        justify-content: space-between;
        width: 100%;
        padding-inline: 30px;
    }

    .gallery-modal-carousel-buttons button {
        color: #000;
        background: #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 2rem;
    }

    .gallery-modal-carousel img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .gallery-modal-images {
        height: 100%;
        width: 100%;
        display: flex;
        gap: 10px;
        overflow-x: auto;
        justify-content: center;
    }

    .gallery-modal-image {
        overflow: hidden;
        border-radius: 15px;
        border: 4px solid transparent;
        transition: border-color 0.1s;
    }

    .gallery-modal-image.active {
        border-color: #fff;
        transition: border-color 0.1s;
    }

    .gallery-container {
        cursor: pointer;
    }

    .gallery-mosaic {
        height: 300px;
        max-height: auto;
        display: flex;
        gap: 10px;
    }

    .gallery-left, .gallery-right {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .gallery-image {
        overflow: hidden;
        border-radius: 10px;
    }

    /* 4 or more */
    .gallery-4 .gallery-left .gallery-image:first-child {
        height: 60%;
    }

    .gallery-4 .gallery-left .gallery-image:last-child {
        height: 40%;
    }

    .gallery-4 .gallery-right .gallery-image:first-child {
        height: 40%;
    }

    .gallery-4 .gallery-right .gallery-image:last-child {
        height: 60%;
    }

    .gallery-3 .gallery-right .gallery-image:last-child {
        height: 60%;
    }

    /* 3 */
    .gallery-3 .gallery-left .gallery-image:first-child {
        height: 50%;
    }

    .gallery-3 .gallery-left .gallery-image:last-child {
        height: 50%;
    }

    .gallery-3 .gallery-right .gallery-image:first-child {
        height: 100%;
    }

    /* 2 */
    .gallery-2 .gallery-left .gallery-image:first-child {
        height: 100%;
    }

    .gallery-2 .gallery-right .gallery-image:first-child {
        height: 100%;
    }

    

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
 
</style>
