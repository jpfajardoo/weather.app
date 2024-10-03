<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WeatherForecastCard from '../Components/WeatherForecastCard.vue';
</script>

<template>
    <Head title="5 Day Forecast" />

    <AuthenticatedLayout v-slot="{ location }">
        <div class="flex flex-col md:flex-row mx-auto max-w-7xl sm:px-6 lg:px-8 gap-4 pt-4">
            <div class="w-full md:w-7/12">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <WeatherForecastCard :location="location" :limit="40" :isSummary="false">
                        <template #header>
                            <span class="uppercase text-gray-500">5-Day / 3-Hour Weather Forecast</span>    
                        </template>
                    </WeatherForecastCard>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>