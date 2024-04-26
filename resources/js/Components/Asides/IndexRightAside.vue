<script setup>
    import { ref } from 'vue';
    import SearchOnSteroids from '@/Components/Steroids/SearchOnSteroids.vue';
    import ScaleOnSteroids from '@/Components/Steroids/ScaleOnSteroids.vue';
    import SelectOnSteroids from '@/Components/Steroids/SelectOnSteroids.vue';
    import FilterOnSteroids from '@/Components/Steroids/FilterOnSteroids.vue';
    import MapOnSteroids from '@/Components/Steroids/MapOnSteroids.vue';

    const scales = [
        { value: 10, label: '10 km' },
        { value: 50, label: '50 km' },
        { value: 100, label: '100 km' },
        { value: Infinity, label: 'Sense límit' }
    ]

    const timeOptions = {
        forever: 'Des de sempre',
        week: 'Fa 1 setmana',
        month: 'Fa 1 mes',
        semester: 'Fa 6 mesos',
    }

    const orderOptions = {
        newest: 'Més recents',
        oldest: 'Més antic'
    }

    const filters = {
        'vegetarian': 'Vegetarià',
        'vegan': 'Vegà',
        'gluten-free': 'Sense gluten',
        'lactose-free': 'Sense lactosa'
    }

    const scaleValue = ref(0);
    const searchValue = ref('');
    const timeOption = ref('forever');
    const orderOption = ref('newest');
    const selectedFilters = ref([]);

    const mapCenter = ref([42.2736, 2.9646]);


</script>

<template>
    <div class="index-right-aside-container">
        <div class="filter">
            <h3>Cercar barbacoes</h3>
            <SearchOnSteroids v-model="searchValue" />
        </div>
        <div class="filter">
            <div class="filters">
                <h3>Distància</h3>
                <MapOnSteroids
                    :radius="scales[scaleValue].value"
                    :offsetX="-550"
                    :offsetY="0"
                    v-model="mapCenter"
                />
            </div>
            <ScaleOnSteroids :scales="scales" v-model="scaleValue" />
        </div>
        <div class="filter">
            <h3>Data de publicació</h3>
            <SelectOnSteroids
                v-model="timeOption"
                :options="timeOptions"
            />
        </div>
        <div class="filter">
            <h3>Ordenar</h3>
            <SelectOnSteroids
                v-model="orderOption"
                :options="orderOptions"
            />
        </div>
        <div class="filter">
            <div class="filters">
                <h3>Filtres</h3>
                <span class="reset-filters" @click="selectedFilters = []">Elimina tots</span>
            </div>
            <FilterOnSteroids
                v-model="selectedFilters"
                :filters="filters"
            />
        </div>
    </div>
</template>

<style scoped>
    .index-right-aside-container {
        background: #fff;
        width: 100%;
        border-radius: 20px;
        padding: 20px 30px;
        display: grid;
        gap: 20px;
    }

    h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .filters {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .filters span {
        color: #FF6100;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .reset-filters:hover {
        text-decoration: underline;
    }
</style>