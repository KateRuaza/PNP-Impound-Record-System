<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import VehicleCard from '@/Components/VehicleCard.vue';

defineProps({
    vehicles: {
        type: Array,
        required: true,
    }
});
</script>

<template>
    <AppLayout title="Impound Record">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Impound Record
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <VehicleCard v-for="(vehicle, index) in vehicles" :key="index" :vehicle="vehicle"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
