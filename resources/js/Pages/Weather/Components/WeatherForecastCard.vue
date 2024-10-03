<script setup>
import LoadingSpinner from './LoadingSpinner.vue';
import { dateTimeService } from '@/Services/dateTimeService';
import { useWeatherService } from '@/Services/weatherService';
import { onMounted, watch } from 'vue';

const props = defineProps({
    location: Object,
    limit: Number,
    isSummary: Boolean
})

const { forecast, isLoading, fetchWeatherForecast } = useWeatherService();

const formatDate = (date) => {
  return dateTimeService.formatDate(date);
};
const formatTime = (date) => {
  return dateTimeService.formatTime(date);
};

onMounted(() => {
    fetchWeatherForecast(props.location.name, props.location.lat, props.location.lon, props.limit);
});

watch(props.location, (newLocation) => {
    if (newLocation.lat && newLocation.lon) {
        fetchWeatherForecast(props.location.name, props.location.lat, props.location.lon, props.limit);
    }
}, { deep: true });
</script>

<template>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 dark:text-white">
        <div class="flex justify-between p-4 border-b border-gray-100 text-xs">
            <slot name="header" />
        </div>
        <div class="p-4">
            <LoadingSpinner :isLoading="isLoading" />

            <div v-if="!isLoading" v-for="forecast in forecast"
                :key="forecast.dt"
                class="flex items-center py-4 first:pt-0 last:pb-0 border-b last:border-b-0 border-gray-100"
            >
                <div class="w-1/5 flex flex-col">
                    <span v-if="!isSummary" class="font-bold text-gray-400">{{ formatDate(forecast.dt_txt) }}</span>
                    <span class="font-bold">{{ formatTime(forecast.dt_txt) }}</span>
                </div>
                <div class="w-2/5 flex items-center justify-content gap-4">
                    <div>
                        <img class="h-14" :src="'https://openweathermap.org/img/wn/' + forecast.weather[0].icon + '@2x.png'">
                    </div>
                    <div>
                        <span class="text-3xl font-medium">{{ Math.round(forecast.main.temp_max) }}° </span>
                        <span class="font-light text-gray-400"> {{ Math.round(forecast.main.temp_min) }}°</span>
                    </div>
                </div>
                <div class="flex flex-col w-2/5">
                    <div class="flex justify-between items-center w-full">
                        <span class="capitalize">{{ forecast.weather[0].description }}</span>
                    </div>
                    <div v-if="!isSummary">
                        <div class="flex justify-between items-center w-full">
                            <span class="text-sm">Real Feel</span>
                            <span class="font-bold">{{ forecast.main.feels_like }} °C</span>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <span class="text-sm">Wind</span>
                            <span class="font-bold">{{ forecast.wind.speed }} km/h</span>
                        </div>
                        <div v-if="forecast.wind.gust" class="flex justify-between items-center w-full">
                            <span class="text-sm">Wind Gusts</span>
                            <span class="font-bold">{{ forecast.wind.gust }} km/h</span>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <span class="text-sm">Humidity</span>
                            <span class="font-bold">{{ forecast.main.humidity }} %</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>