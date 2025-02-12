<script setup>
defineProps({
	vehicle: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
	    <div>
	        <img :src="'/files/' + vehicle.image" :alt="'Vehicle ' + vehicle.id" class="w-full object-cover rounded-md" style="height: 200px;">

	    </div>
	    <div class="mt-4 text-gray-800 dark:text-gray-200 space-y-2">
	        <p class="text-lg font-semibold">{{ vehicle.type }}</p>
	        <div class="flex justify-between text-sm">
	            <span>Color:</span> <span>{{ vehicle.color }}</span>
	        </div>
	        <div class="flex justify-between text-sm">
	            <span>Plate:</span> <span>{{ vehicle.plate_number }}</span>
	        </div>
	        <div class="flex justify-between text-sm">
	            <span>Chassis:</span> <span>{{ vehicle.chasis_number }}</span>
	        </div>
	        <div class="flex justify-between text-sm">
	            <span>Impound Date:</span> <span>{{ vehicle.impound_date }}</span>
	        </div>
	        <div class="flex justify-between text-sm">
	            <span>Status:</span>
	            <span
	                class="px-2 py-1 text-xs font-semibold rounded-md"
	                :class="vehicle.status === 'suspended' ? 'bg-red-500 dark:bg-red-500 text-white' : 'bg-green-500 dark:bg-green-500 text-white'"
	            >
	                {{ vehicle.status }}
	            </span>
	        </div>

	    </div>
	</div>
</template>