<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WeatherCard from '../Components/WeatherCard.vue';
import WeatherForecastCard from '../Components/WeatherForecastCard.vue';
</script>

<template>
    <Head title="Today's Weather" />

    <AuthenticatedLayout>
        <template v-slot="{ location }">
            <div class="flex flex-col md:flex-row mx-auto max-w-7xl sm:px-6 lg:px-8 gap-4 pt-4">
                <div class="flex flex-col w-full md:w-1/2 gap-2">
                    <div class="w-full">
                        <WeatherCard :location="location">
                            <template #title>Current Weather</template>
                        </WeatherCard>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <WeatherForecastCard :location="location" :limit="4">
                            <template #title>Forecast for the next 12 hours</template>
                        </WeatherForecastCard>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>