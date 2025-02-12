<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';

defineProps({
    title: String,
});

const logout = () => {
    router.post(route('logout'));
};

const links = ref([
    { label: 'Home', route: 'home' },
    { label: 'Add New Vehicle', route: 'admin.vehicles.create' },
    { label: 'Impound Record', route: 'admin.vehicles.index' },
]);
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <div id="overlay" v-if="overlay" @click="showingSidebar = !showingSidebar; overlay = !overlay"></div>
            <aside id="sidebar" :class="`fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform sm:translate-x-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 ${!showingSidebar ? '-translate-x-full' : ''}`" aria-label="Sidebar">
                <div class="h-full pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <NavLink v-for="(link, index) in links" :key="index" class="w-full" :href="route(link.route)" :active="route().current(link.route)">
                                {{ link.label }}
                            </NavLink>
                        </li>
                    </ul>
                </div>
            </aside>

            <div class="sm:ml-64">
                <!-- Page Content -->
                <main class="min-h-screen">
                    <!-- Page Heading -->
                    <header v-if="$slots.header" class="bg-white dark:bg-gray-900 shadow flex items-center justify-between">
                        <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                            <slot name="header" />
                        </div>
                        <div class="me-2">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                    </button>

                                    <span v-else class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ $page.props.auth.user.name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <DropdownLink :href="route('profile.show')">
                                        Profile
                                    </DropdownLink>

                                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                        API Tokens
                                    </DropdownLink>

                                    <div class="border-t border-gray-200" />

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <DropdownLink as="button">
                                            Log Out
                                        </DropdownLink>
                                    </form>
                                </template>
                            </Dropdown>
                        </div>
                    </header>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showingSidebar: false,
                overlay: false,
            }
        }
    }
</script>