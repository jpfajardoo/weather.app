<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WeatherCard from '../Components/WeatherCard.vue';
import WeatherForecastCard from '../Components/WeatherForecastCard.vue';
import { dateTimeService } from '@/Services/dateTimeService';

const formatTime = (date) => {
  return dateTimeService.formatTime(date);
};
</script>

<template>
    <Head title="Today's Weather" />

    <AuthenticatedLayout>
        <template v-slot="{ location }">
            <div class="flex flex-col md:flex-row mx-auto max-w-7xl sm:px-6 lg:px-8 gap-4 pt-4">
                <div class="flex flex-col w-full md:w-1/2 gap-2">
                    <div class="w-full">
                        <WeatherCard :location="location">
                            <template #header>
                                <span class="uppercase text-gray-400">Current Weather</span>
                                <span class="font-bold">{{ formatTime(new Date) }}</span>
                            </template>
                        </WeatherCard>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full">
                        <WeatherForecastCard :location="location" :limit="4" :isSummary="true">
                            <template #header>
                                <span class="uppercase text-gray-500">12-Hour Weather Forecast</span>    
                            </template>
                        </WeatherForecastCard>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>