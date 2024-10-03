<script setup>
import LoadingSpinner from './LoadingSpinner.vue';
import { dateTimeService } from '@/Service/dateTimeService';
import { useWeatherService } from '@/Service/weatherService';
import { onMounted, watch } from 'vue';

const props = defineProps({
    location: Object,
    limit: Number
})

const { forecast, isLoading, fetchWeatherForecast } = useWeatherService();

const formatDateTime = (date) => {
  return dateTimeService.formatDateTime(date, { month: 'short', day: '2-digit', year: 'numeric' });
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
    <div class="flex justify-between p-4 border-b border-gray-100 text-sm">
        <span class="text-gray-500">
            <slot name="title" />
        </span>
    </div>
    <div class="p-4">
        <LoadingSpinner :isLoading="isLoading" />

        <div v-if="!isLoading" v-for="forecast in forecast"
            :key="forecast.dt"
            class="flex items-center"
        >
            <div class="w-1/4 text-left">
                <span>{{ formatDateTime(forecast.dt_txt) }}</span>
            </div>
            <div class="w-3/6 flex items-center text-left">
                <div>
                    <img :src="'https://openweathermap.org/img/wn/' + forecast.weather[0].icon + '@2x.png'" class="icon-img-small">
                </div>
                <div class="ml-4">
                    <span class="capitalize">{{ forecast.weather[0].description }}</span>
                </div>
            </div>
            <div class="w-1/4 text-right">
                <span class="text-md font-medium">{{ Math.round(forecast.main.temp_max) }}°C </span>
                <span class="font-light">/ {{ Math.round(forecast.main.temp_min) }}°C</span>
            </div>
        </div>
    </div>
</template>