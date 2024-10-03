<script setup>
import LoadingSpinner from './LoadingSpinner.vue';
import { dateTimeService } from '@/Service/dateTimeService';
import { useWeatherService } from '@/Service/weatherService';
import { onMounted, watch } from 'vue';

const props = defineProps({
    location: Object
});

const { weather, isLoading, fetchWeatherData } = useWeatherService();

const formatTime = (date) => {
  return dateTimeService.formatTime(date);
};

onMounted(() => {
    fetchWeatherData(props.location.name, props.location.lat, props.location.lon);
});

watch(props.location, (newLocation) => {
    if (newLocation.lat && newLocation.lon) {
        fetchWeatherData(props.location.name, props.location.lat, props.location.lon);
    }
}, { deep: true });
</script>

<template>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
        <div class="flex justify-between p-4 border-b border-gray-100 text-sm">
            <span class="text-gray-500">
                <slot name="title" />
            </span>
            <span>{{ formatTime(new Date) }}</span>
        </div>
        <div class="p-4">
            <LoadingSpinner :isLoading="isLoading" />
            
            <div v-if="!isLoading" class="flex flex-wrap">
                <div class="flex flex-col justify-between w-full md:w-7/12">
                    <div class="flex items-center w-full">
                        <img :src="'https://openweathermap.org/img/wn/' + weather.icon + '@2x.png'">
                        <span class="text-6xl font-bold">{{ weather.temp }}°</span>
                        <span class="text-xl font-bold text-gray-300 -ml-[19px] mt-7">C</span>
                    </div>
                    <div class="flex items-center w-full">
                        <span class="capitalize font-bold">{{ weather.description }}</span>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-5/12">
                    <div class="flex justify-between items-center w-full">
                        <span class="text-sm">Real Feel</span>
                        <span class="font-bold">{{ weather.feelsLike }} °C</span>
                    </div>
                    <div class="flex justify-between items-center w-full">
                        <span class="text-sm">Wind</span>
                        <span class="font-bold">{{ weather.windSpeed }} km/h</span>
                    </div>
                    <div v-if="weather.windGust" class="flex justify-between items-center w-full">
                        <span class="text-sm">Wind Gusts</span>
                        <span class="font-bold">{{ weather.windGust }} km/h</span>
                    </div>
                    <div class="flex justify-between items-center w-full">
                        <span class="text-sm">Humidity</span>
                        <span class="font-bold">{{ weather.humidity }} %</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>