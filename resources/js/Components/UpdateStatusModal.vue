<script setup>
import { defineProps, defineEmits } from 'vue';

defineProps({
    isOpen: Boolean,
    vehicle: Object
});

const emit = defineEmits(['close', 'action']);

const closeModal = () => {
    emit('close');
};

const emitAction = (status) => {
    emit('action', status);
};
</script>

<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Update Vehicle Status</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">
                Update status for <strong>{{ vehicle?.type }}</strong> (ID: {{ vehicle?.id }})
            </p>

            <div class="mt-4 flex justify-between space-x-2">
                <button @click="emitAction('suspended')" class="w-full px-4 py-2 bg-red-500 text-white rounded-md">Suspend</button>
                <button @click="emitAction('released')" class="w-full px-4 py-2 bg-green-500 text-white rounded-md">Release</button>
            </div>

            <button @click="closeModal" class="mt-4 w-full py-2 bg-gray-500 text-white rounded-md">Close</button>
        </div>
    </div>
</template>