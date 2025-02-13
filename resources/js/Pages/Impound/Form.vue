<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    type: '',
    color: '',
    plate_number: '',
    chasis_number: '',
    impound_reason: '',
    impound_date: '',
    image: null,
    owner_first_name: '',
    owner_middle_name: '',
    owner_last_name: '',
    owner_nick_name: '',
    owner_age: '',
    owner_sex: ''
});

const submit = () => {
    form.post(route('admin.vehicles.store'), {
        onSuccess: () => {
            form.reset();
            alert('Vehicle Added!');
            activeTab.value = 'owner';
        },
        onError: () => {
            alert('Failed to add vehicle');
        }
    });
};

const activeTab = ref('owner');
</script>

<template>
    <AppLayout title="Impound Form">
        <template #header>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Impound Form</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto px-6">
                <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg p-8">
                    <div class="flex border-b mb-6">
                        <button class="w-1/2 py-3 text-center font-medium text-lg transition-all"
                            :class="activeTab === 'owner' ? 'border-b-4 border-blue-500 text-blue-600' : 'text-gray-500'"
                            @click="activeTab = 'owner'">
                            Owner Details
                        </button>
                        <button class="w-1/2 py-3 text-center font-medium text-lg transition-all"
                            :class="activeTab === 'vehicle' ? 'border-b-4 border-blue-500 text-blue-600' : 'text-gray-500'"
                            @click="activeTab = 'vehicle'">
                            Vehicle Details
                        </button>
                    </div>

                    <form @submit.prevent="submit">
                        <div v-if="activeTab === 'owner'">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div v-for="field in ['owner_first_name', 'owner_middle_name', 'owner_last_name', 'owner_nick_name', 'owner_age', 'owner_sex']" :key="field">
                                    <InputLabel :for="field" :value="field.replace('_', ' ').toUpperCase()" />
                                    <TextInput v-if="field !== 'owner_sex' && field !== 'owner_age'" :id="field" v-model="form[field]" class="w-full" required />
                                    <TextInput v-else-if="field === 'owner_age'" :id="field" v-model="form[field]" class="w-full" type="number" required />
                                    <SelectInput v-else :id="field" v-model="form[field]" :options="['Male', 'Female']" class="w-full" required />
                                    <InputError :message="form.errors[field]" />
                                </div>
                            </div>
                        </div>

                        <div v-if="activeTab === 'vehicle'">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div v-for="field in ['type', 'color', 'plate_number', 'chasis_number', 'impound_date']" :key="field">
                                    <InputLabel :for="field" :value="field.replace('_', ' ').toUpperCase()" />
                                    <TextInput v-if="field !== 'type'" :id="field" v-model="form[field]" class="w-full" required />
                                    <SelectInput v-else :id="field" v-model="form[field]" :options="['Car', 'Motorcycle', 'Truck', 'Van', 'Bus']" class="w-full" required />
                                    <InputError :message="form.errors[field]" />
                                </div>
                                <div class="col-span-2">
                                    <InputLabel for="image" value="Vehicle Image" />
                                    <input id="image" type="file" @change="event => form.image = event.target.files[0]" class="mt-1 block w-full" />
                                    <InputError :message="form.errors.image" />
                                </div>
                                <div class="col-span-2">
                                    <InputLabel for="impound_reason" value="Impound Reason" />
                                    <textarea id="impound_reason" v-model="form.impound_reason" class="w-full p-2 border rounded-md" rows="4" required></textarea>
                                    <InputError :message="form.errors.impound_reason" />
                                </div>
                            </div>
                            <div class="mt-6 text-right">
                                <PrimaryButton type="submit">Submit</PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>