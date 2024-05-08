<script setup>
import L from 'leaflet';
globalThis.L = L;
import { LMap, LTileLayer, LMarker, LCircle } from '@vue-leaflet/vue-leaflet';
import { LMarkerClusterGroup } from 'vue-leaflet-markercluster';
import 'leaflet/dist/leaflet.css';
import 'vue-leaflet-markercluster/dist/style.css';
import { icon } from 'leaflet';
import { ref, defineProps, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: Object,
        required: true
    },
    radius: {
        type: Number,
    },
    offsetX: {
        type: Number,
        default: 0
    },
    offsetY: {
        type: Number,
        default: 0
    },
    text: {
        type: String,
    },
    allowChangeLocation: {
        type: Boolean,
        default: false
    },
    markers: {
        type: Array,
        default: []
    }
});


const coordinates = ref(props.modelValue);

const opener = ref(null);
const openerRect = ref(null);

const map = ref(null);

const emit = defineEmits(['update:modelValue', 'input']);

const tileLayerImage = ref('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png');
const tileLayer = ref('smooth');


const trackCoordinates = (value) => {
    coordinates.value = [value.lat, value.lng];
    console.log(coordinates.value);
};

const updateCoordinates = () => {
    changingLocation.value = false;
    emit('update:modelValue', coordinates.value);
    emit('input', coordinates.value);
};

const toggleFullScreen = () => {
    fullscreen.value = !fullscreen.value;

    const timeClicked = new Date().getTime();
    const resizingAnimationDuration = 1000;

    animateResize();
    function animateResize() {
        const currentTime = new Date().getTime();
        window.dispatchEvent(new Event('resize'));
        if (currentTime - timeClicked > resizingAnimationDuration) {
            return;
        }
        requestAnimationFrame(animateResize);
    }
};


const isOpen = ref(false);
const changingLocation = ref(false);
const fullscreen = ref(false);


const customIcon = icon({
    iconUrl: "/assets/img/default/marker.png",
    iconSize: [50, 50],
    iconAnchor: [25, 50],
});

const bbqIcon = icon({
    iconUrl: "/assets/img/default/barbecue_point.png",
    iconSize: [10, 10],
    iconAnchor: [5, 5],
});

const calculateZoom = computed(() => {
    if (props.radius == 10) {
        return 10;
    } else if (props.radius == 50) {
        return 8;
    } else if (props.radius == 100) {
        return 7;
    } else {
        return 10;
    }
});

function toggleMapLayer() {
    if (tileLayer.value === 'satellite') {
        tileLayer.value = 'smooth';
        tileLayerImage.value = 'https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png';
    } else {
        tileLayer.value = 'satellite';
        tileLayerImage.value = 'https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}.png';
    }
}


const handleClickOutside = (event) => {

};

onMounted(() => {
    openerRect.value = opener.value.getBoundingClientRect();
    window.addEventListener('resize', () => {
        openerRect.value = opener.value?.getBoundingClientRect();
    });
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});

function toggleChangingLocation() {
    changingLocation.value = !changingLocation.value;
}
</script>

<template>
    <div class="map-on-steroids-container">
        <span ref="opener" @click="isOpen = !isOpen" class="map-on-steroids-opener">{{ props.text ?? (isOpen ? 'Ocultar mapa' : 'Mostrar mapa') }}</span>
        <div :scroller="scrollY" class="map-on-steroids-map-wrapper" v-if="isOpen" :class="{ 'fullscreen': fullscreen }" :style="{
            top: `${openerRect.y}px`,
            left: `${openerRect.x}px`,
            transform: `translate(${props.offsetX}px, ${props.offsetY}px)`
        }">
            <div class="map-on-steroids-map">
                <div v-if="changingLocation" class="map-on-steroids-options">
                    <span @click="toggleChangingLocation">Cancel·lar</span>
                    <span @click="updateCoordinates"><img src="/assets/svg/check.svg" alt="Icon" /></span>
                    <span @click="toggleFullScreen">
                        <img src="/assets/svg/expand.svg" alt="Expand icon" />
                    </span>
                </div>
                <div v-else class="map-on-steroids-options">
                    <span v-if="props.allowChangeLocation" @click="changingLocation = true">Canviar ubicació</span>
                    <span @click="toggleFullScreen">
                        <img src="/assets/svg/expand.svg" alt="Expand icon" />
                    </span>
                </div>

                <div v-if="changingLocation">
                    <div class="map-on-steroids-horizontal-line"></div>
                    <div class="map-on-steroids-vertical-line"></div>
                </div>

                <div v-if="fullscreen" class="map-on-steroids-layers">
                    <div class="map-on-steroids-layer"
                        @click="toggleMapLayer"
                    >
                        <img
                        :src="tileLayer === 'smooth' ? '/assets/img/default/map_satellite.png' : '/assets/img/default/map_smooth.png'"
                        alt="Smooth map">
                    </div>
                </div>
                <l-map ref="map" @update:center="trackCoordinates" :use-global-leaflet="false" :min-zoom="1"
                    :max-zoom="18" :zoom="calculateZoom" :center="props.modelValue">
                    <l-tile-layer :url="tileLayerImage"
                        layer-type="base" name="OpenStreetMap">
                    </l-tile-layer>
                    <l-marker v-for="marker in props.markers" :key="marker.id" :lat-lng="[marker.latitude, marker.longitude]" :icon="bbqIcon"></l-marker>
                    <l-marker :lat-lng="props.modelValue" :icon="customIcon"></l-marker>
                    <l-circle :lat-lng="props.modelValue" :radius="props.radius ? props.radius * 1000 : 0" :color="'#FF6100'" />
                </l-map>
            </div>
        </div>
    </div>
</template>

<style>

.map-on-steroids-layer {
    background: #fff;
    padding: 5px;
    border-radius: 20px;
    box-shadow: 0 0 10px 0 #00000088;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    width: 200px;
}

.map-on-steroids-layer img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;
}

.map-on-steroids-layers {
    position: absolute;
    z-index: 999;
    right: 20px;
    bottom: 20px;
}

.map-on-steroids-horizontal-line {
    position: absolute;
    width: calc(100% - 20px);
    height: 1px;
    background: #FF6100;
    top: 50%;
    left: 0;
    transform: translate(10px, -50%);
    z-index: 998;
}

.map-on-steroids-vertical-line {
    position: absolute;
    width: 1px;
    height: calc(100% - 20px);
    background: #FF6100;
    left: 50%;
    top: 0;
    transform: translate(-50%, 10px);
    z-index: 998;
}

.map-on-steroids-options {
    position: absolute;
    z-index: 999;
    right: 10px;
    top: 10px;
    display: flex;
    gap: 10px;
}

.map-on-steroids-options span {
    background: #fff;
    padding: 5px 10px;
    height: 35px;
    border-radius: 20px;
    box-shadow: 0 0 10px 0 #00000088;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}

.map-on-steroids-options span img {
    width: 15px;
    height: 15px;
}

.map-on-steroids-recenter {
    position: absolute;
    z-index: 99999;
}

.leaflet-interactive {
    cursor: grab !important;

}

.map-on-steroids-map-wrapper {
    width: 300px;
    height: 300px;
    position: fixed;
    background: #fff;
    z-index: 9999;
    border: 10px solid white;
    border-radius: 35px;
    box-shadow: 0 0 10px 0 #00000088;
    transition: 0.5s;
    overflow: hidden;
}

.map-on-steroids-map-wrapper.fullscreen {
    width: 90vw;
    height: calc(90vh - 90px);
    transition: 0.5s;
    top: calc(50% + 45px) !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
}

.map-on-steroids-map {
    width: 100%;
    height: 100%;
    border-radius: 25px;
    overflow: hidden;
}

.map-on-steroids-opener {
    color: #FF6100;
    font-size: 0.9rem;
}

.map-on-steroids-opener:hover {
    cursor: pointer;
    text-decoration: underline;
}


.leaflet-bottom.leaflet-right {
    display: none;
}

.leaflet-touch .leaflet-bar a {
    width: 35px;
    height: 35px;
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: none;
    box-shadow: none;
    border-radius: 20px !important;
    box-shadow: 0 0 5px 0 #000;
}

.leaflet-control-zoom.leaflet-bar.leaflet-control {
    border: none;
    display: flex;
    flex-direction: column;
    gap: 7px;
}
</style>