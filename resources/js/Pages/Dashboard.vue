<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import { ref, onMounted, watch } from 'vue';
import { GeocoderAutocomplete } from '@geoapify/geocoder-autocomplete';
import LoadingSpinner from './Weather/Components/LoadingSpinner.vue';

const isLoading = ref(false);
const current = ref({
    temp: '',
    feels_like: '',
    description: '',
    icon: ''
});
const forecast = ref([]);
const location = ref({
    name: 'Rizal Park, Philippines',
    lat: 14.5756660307,
    lon: 120.972679443
});

const formatDate = (dateString) => {
    const options = { weekday: 'short', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true };
    const date = new Date(dateString);
    return date.toLocaleString('en-US', options).replace(',', '');
};

const fetchData = async () => {
    isLoading.value = true;
    try {
        const currentWeatherResponse = await fetch(`/api/weather?time=weather&lat=${location.value.lat}&lon=${location.value.lon}`);
        const currentData = await currentWeatherResponse.json();
        current.value.temp = Math.round(currentData.main.temp);
        current.value.feels_like = Math.round(currentData.main.feels_like);
        current.value.description = currentData.weather[0].description;
        current.value.icon = currentData.weather[0].icon;

        const forecastWeatherResponse = await fetch(`/api/weather?time=forecast&lat=${location.value.lat}&lon=${location.value.lon}`);
        const forecastData = await forecastWeatherResponse.json();
        const currentDateTime = new Date();
        forecast.value = forecastData.list.filter(item => new Date(item.dt_txt) >= currentDateTime).slice(0, 3);
console.log(forecast);
        isLoading.value = false;
    } catch (error) {
        console.log('error', error);
    }
};

watch(location, (newLocation) => {
    if (newLocation.lat && newLocation.lon) {
        fetchData();
    }
}, { deep: true });

onMounted(() => {
    fetchData();
  
    const autocomplete = new GeocoderAutocomplete(
        document.getElementById("autocomplete"),
        'e97a4cc6688c4805802a1e5cf90c0076',
        {}
    );

    autocomplete.on('select', (locationData) => {
        console.log('location', locationData);

        location.value.name = locationData.properties.formatted;
        location.value.lat = locationData.properties.lat;
        location.value.lon = locationData.properties.lon;
    });
});
</script>

<template>
    <Head title="Today" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Weather Today
            </h2>
        </template> -->

        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8 h-12 my-10">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <div id="autocomplete" class="autocomplete-container"></div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row mx-auto max-w-7xl sm:px-6 lg:px-8 gap-2">
            <div class="w-full md:w-1/2">
                <div class="p-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <LoadingSpinner :isLoading="isLoading" />
                    <div v-if="!isLoading" class="mb-2">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="m7.539 14.841.003.003.002.002a.755.755 0 0 0 .912 0l.002-.002.003-.003.012-.009a5.57 5.57 0 0 0 .19-.153 15.588 15.588 0 0 0 2.046-2.082c1.101-1.362 2.291-3.342 2.291-5.597A5 5 0 0 0 3 7c0 2.255 1.19 4.235 2.292 5.597a15.591 15.591 0 0 0 2.046 2.082 8.916 8.916 0 0 0 .189.153l.012.01ZM8 8.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">{{ location.name }}</span>
                        </div>
                        <div class="flex gap-1">
                            <span>{{ formatDate(new Date) }}</span>
                        </div>
                    </div>
                    <div v-if="!isLoading" class="flex justify-between items-center text-md w-full overflow-hidden">
                        <div class="flex items-center gap-2">
                            <img :src="'https://openweathermap.org/img/wn/' + current.icon + '@2x.png'">
                            <span class="text-7xl font-bold">{{ current.temp }}°</span>
                            <span class="text-2xl font-bold text-gray-300 -ml-[29px] mt-8">C</span>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="capitalize font-bold">{{ current.description }}</span>
                            <span class="text-sm">Feels Like {{ current.feels_like }}°C</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="p-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <LoadingSpinner :isLoading="isLoading" />
                    <div v-if="!isLoading" v-for="fcst in forecast"
                        :key="fcst.dt"
                        class="flex items-center"
                    >
                        <div class="w-1/4 text-left">
                            <span>{{ formatDate(fcst.dt_txt) }}</span>
                        </div>
                        <div class="w-3/6 flex items-center text-left">
                            <div>
                                <img :src="'https://openweathermap.org/img/wn/' + fcst.weather[0].icon + '@2x.png'" class="icon-img-small">
                            </div>
                            <div class="ml-4">
                                <span class="capitalize">{{ fcst.weather[0].description }}</span>
                            </div>
                        </div>
                        <div class="w-1/4 text-right">
                            <span class="text-md font-medium">{{ Math.round(fcst.main.temp_max) }}°C </span>
                            <span class="font-light">/ {{ Math.round(fcst.main.temp_min) }}°C</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
