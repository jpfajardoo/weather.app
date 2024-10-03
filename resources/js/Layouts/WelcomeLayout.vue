<script setup>
import { ref, onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { GeocoderAutocomplete } from '@geoapify/geocoder-autocomplete';
import InputAddress from '@/Pages/Weather/Components/InputAddress.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const showingNavigationDropdown = ref(false);

const location = ref({
    name: 'Rizal Park, Philippines',
    lat: 14.5756660307,
    lon: 120.972679443
});

onMounted(() => {
    const geoapifyKey = usePage().props.geoapifyKey;
    const autocomplete = new GeocoderAutocomplete(
        document.getElementById("autocomplete"),
        geoapifyKey,
        {}
    );

    autocomplete.on('select', (locationData) => {
        location.value.name = locationData.properties.formatted;
        location.value.lat = locationData.properties.lat;
        location.value.lon = locationData.properties.lon;
    });
});
</script>

<template>
    <div>
        <div class="min-h-screen bg-slate-100 dark:bg-slate-900">
            <nav
                class="border-b border-gray-100 bg-zinc-900 bg dark:border-gray-700 dark:bg-zinc-800"
            >
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex w-1/5 sm:w-1/3">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-orange-500 dark:text-orange-500"
                                    />
                                </Link>
                            </div>

                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-1 sm:flex"
                            >
                                <Link :href="route('dashboard')" class="inline-flex items-center px-1 pt-1 text-xl font-medium leading-5 text-white dark:text-white transition duration-150 ease-in-out">
                                    Weather.app
                                </Link>
                            </div>
                        </div>

                        <div class="flex w-3/5 sm:w-1/3">
                            <InputAddress />
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center w-1/5 sm:w-1/3 justify-end">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-gray py-2 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out hover:text-gray-200 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                            >
                                                <svg
                                                    class="h-6 w-6"
                                                    stroke="currentColor"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        :class="{
                                                            hidden: showingNavigationDropdown,
                                                            'inline-flex':
                                                                !showingNavigationDropdown,
                                                        }"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 6h16M4 12h16M4 18h16"
                                                    />
                                                    <path
                                                        :class="{
                                                            hidden: !showingNavigationDropdown,
                                                            'inline-flex':
                                                                showingNavigationDropdown,
                                                        }"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div v-if="$page.props.auth.user">
                                            <DropdownLink
                                                :href="route('profile.edit')"
                                            >
                                                Profile
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('logout')"
                                                method="post"
                                                as="button"
                                            >
                                                Log Out
                                            </DropdownLink>
                                        </div>

                                        <div v-else>
                                            <DropdownLink
                                                :href="route('login')"
                                            >
                                                Log in
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('register')"
                                            >
                                                Sign up
                                            </DropdownLink>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex w-1/5 sm:w-1/3 justify-end items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:text-gray-400 dark:focus:text-gray-400"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            href="/"
                            :active="true"
                        >
                            Today
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                            :href="route('weatherForecastDay.index')"
                            :active="route().current('weatherForecastDay.index')"
                        >
                            5 Day
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"
                    >
                        <div v-if="$page.props.auth.user" class="px-4">
                            <div
                                class="text-base font-medium text-white dark:text-white"
                            >
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div v-if="$page.props.auth.user" class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>

                        <div v-else class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('login')">
                                Log in
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('register')"
                                method="post"
                                as="button"
                            >
                                Register
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <div
                class="hidden md:block border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800"
            >
                <!-- Secondary Navigation Menu -->
                <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-8 justify-between">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:flex"
                            >
                                <NavLink
                                    href="/"
                                    :active="true"
                                >
                                    Today
                                </NavLink>

                                <NavLink
                                    :href="route('weatherForecastDay.index')"
                                    :active="route().current('weatherForecastDay.index')"
                                >
                                    5 Day
                                </NavLink>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="m7.539 14.841.003.003.002.002a.755.755 0 0 0 .912 0l.002-.002.003-.003.012-.009a5.57 5.57 0 0 0 .19-.153 15.588 15.588 0 0 0 2.046-2.082c1.101-1.362 2.291-3.342 2.291-5.597A5 5 0 0 0 3 7c0 2.255 1.19 4.235 2.292 5.597a15.591 15.591 0 0 0 2.046 2.082 8.916 8.916 0 0 0 .189.153l.012.01ZM8 8.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">{{ location.name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page Heading -->
            <header
                class="bg-white shadow dark:bg-gray-800"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-5xl px-4 py-3 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="mx-auto max-w-5xl">
                <slot :location="location" />
            </main>
        </div>
    </div>
</template>
