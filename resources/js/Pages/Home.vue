<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
const props = defineProps({
    vehicleCounts: Object,
    typeCounts: Object,
});

</script>

<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12 space-y-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid sm:grid-cols-1 lg:grid-cols-4 gap-4">
                <div class="bg-gray-100 dark:bg-indigo-950 dark:text-white p-6 overflow-hidden sm:rounded-lg col-span-3 space-y-4">
                    <h3 class="text-3xl font-serif">Streamline Solutions Vehicle Records System</h3>
                    <p>
                        A comprehensive and secure platform designed specifically for the Philippine National Police (PNP) in Malasiqui to efficiently manage, track, and monitor vehicle-related records.
                    </p>
                    <p>
                        This system provides a user-friendly and accessible interface to simplify the storage, retrieval, and management of critical vehicle data, aiding law enforcement in maintaining up-to-date and accurate records.
                    </p>

                </div>
                <div class="bg-gray-100 dark:bg-indigo-950 dark:text-white p-6 overflow-hidden sm:rounded-lg space-y-4">
                    <h3 class="text-lg font-serif">Benefits of Using the Vehicle Records System</h3>
                    <ul class="list-disc pl-5">
                        <li>Efficiency: Quickly access vehicle records, saving time and effort.</li>
                        <li>Accuracy: Keep vehicle information up-to-date with automated updates.</li>
                        <li>Security: Safeguard sensitive data with encryption and secure access.</li>
                        <li>Collaboration: Seamlessly share records and data across departments.</li>
                    </ul>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid sm:grid-cols-1 lg:grid-cols-4 gap-4">
                <div class="flex flex-col items-between justify-between bg-gray-100 dark:bg-indigo-950 dark:text-white rounded-lg p-4 h-40">
                    <h3 class="text-6xl font-serif">
                        Vehicle Stats
                    </h3>
                </div>
                <div v-for="vehicleCount in vehicleCounts" class="flex flex-col items-between justify-between bg-gray-100 dark:bg-indigo-950 dark:text-white rounded-lg p-4 h-40">
                    <h3 class="text-2xl font-serif">
                        {{ vehicleCount.label }}
                    </h3>
                    <p class="text-8xl text-end">{{ vehicleCount.count }}</p>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid sm:grid-cols-1 lg:grid-cols-4 gap-4">
                <div v-for="typeCount in typeCounts" class="flex flex-col items-between justify-between bg-gray-100 dark:bg-indigo-950 dark:text-white rounded-lg p-4 h-40">
                    <h3 class="text-2xl font-serif">
                        {{ typeCount.type }}
                    </h3>
                    <p class="text-8xl text-end">{{ typeCount.count }}</p>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
