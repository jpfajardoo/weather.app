<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-orange-400 dark:border-orange-600 text-start text-base font-medium text-white dark:text-orange-300 dark:bg-orange-900/50 focus:outline-none focus:text-orange-800 dark:focus:text-orange-200 focus:bg-orange-100 dark:focus:bg-orange-900 focus:border-orange-700 dark:focus:border-orange-300 transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white dark:text-white hover:text-orange-800 dark:hover:text-orange-200 hover:bg-orange-50 dark:hover:bg-orange-700 hover:border-orange-300 dark:hover:border-orange-600 focus:outline-none focus:text-orange-800 dark:focus:text-orange-200 focus:bg-orange-50 dark:focus:bg-orange-700 focus:border-orange-300 dark:focus:border-orange-600 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
