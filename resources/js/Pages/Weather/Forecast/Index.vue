<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WeatherCard from '../Components/WeatherCard.vue';
import WeatherForecastCard from '../Components/WeatherForecastCard.vue';
</script>

<template>
    <Head title="5 Day Forecast" />

    <AuthenticatedLayout v-slot="{ location }">
        <div class="flex flex-col md:flex-row mx-auto max-w-7xl sm:px-6 lg:px-8 gap-4 pt-4">
            <!-- <div class="w-full md:w-1/2">
                <WeatherCard :location="location">
                    <template #title>Current Weather</template>
                </WeatherCard>
            </div> -->
            <div class="w-full">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <WeatherForecastCard :location="location" :limit="40">
                        <template #title>5 day / 3 hour forecast</template>
                    </WeatherForecastCard>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>