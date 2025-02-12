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
    form.post(route('admin.vehicle.store'), {
        onSuccess: () => {
            form.reset();
            alert('Vehicle Added!');
        },
        onError: (e) => {
            alert('Failed to add vehicle');
        }
    });
};

const activeTab = ref('owner');
</script>

<template>
    <AppLayout title="Impound Form">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Impound Form
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex border-b mb-4">
                        <button class="px-4 py-2 flex-1 text-center" :class="activeTab === 'owner' ? 'border-b-2 border-blue-500' : ''" @click="activeTab = 'owner'">Owner Details</button>
                        <button class="px-4 py-2 flex-1 text-center" :class="activeTab === 'vehicle' ? 'border-b-2 border-blue-500' : ''" @click="activeTab = 'vehicle'">Vehicle Details</button>
                    </div>
                    <form @submit.prevent="submit">
                        <div v-if="activeTab === 'owner'">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Owner Details</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <InputLabel for="owner_first_name" value="First Name" />
                                        <TextInput id="owner_first_name" class="w-full" v-model="form.owner_first_name" required />
                                        <InputError :message="form.errors.owner_first_name" />
                                    </div>
                                    <div>
                                        <InputLabel for="owner_middle_name" value="Middle Name" />
                                        <TextInput id="owner_middle_name" class="w-full" v-model="form.owner_middle_name" />
                                        <InputError :message="form.errors.owner_middle_name" />
                                    </div>
                                    <div>
                                        <InputLabel for="owner_last_name" value="Last Name" />
                                        <TextInput id="owner_last_name" class="w-full" v-model="form.owner_last_name" required />
                                        <InputError :message="form.errors.owner_last_name" />
                                    </div>
                                    <div>
                                        <InputLabel for="owner_nick_name" value="Nickname" />
                                        <TextInput id="owner_nick_name" class="w-full" v-model="form.owner_nick_name" />
                                        <InputError :message="form.errors.owner_nick_name" />
                                    </div>
                                    <div>
                                        <InputLabel for="owner_age" value="Age" />
                                        <TextInput id="owner_age" type="number" class="w-full" v-model="form.owner_age" required />
                                        <InputError :message="form.errors.owner_age" />
                                    </div>
                                    <div>
                                        <InputLabel for="owner_sex" value="Sex" />
                                        <SelectInput id="owner_sex" class="w-full" v-model="form.owner_sex" :options="['Male', 'Female']" required />
                                        <InputError :message="form.errors.owner_sex" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="activeTab === 'vehicle'">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Vehicle Details</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <InputLabel for="type" value="Vehicle Type" />
                                        <SelectInput id="type" class="w-full" v-model="form.type" :options="['Car', 'Motorcycle', 'Truck', 'Van', 'Bus']" required />
                                        <InputError :message="form.errors.type" />
                                    </div>
                                    <div>
                                        <InputLabel for="color" value="Color" />
                                        <TextInput id="color" class="w-full" v-model="form.color" required />
                                        <InputError :message="form.errors.color" />
                                    </div>
                                    <div>
                                        <InputLabel for="plate_number" value="Plate Number" />
                                        <TextInput id="plate_number" class="w-full" v-model="form.plate_number" required />
                                        <InputError :message="form.errors.plate_number" />
                                    </div>
                                    <div>
                                        <InputLabel for="chasis_number" value="Chasis Number" />
                                        <TextInput id="chasis_number" class="w-full" v-model="form.chasis_number" required />
                                        <InputError :message="form.errors.chasis_number" />
                                    </div>
                                    <div>
                                        <InputLabel for="impound_reason" value="Impound Reason" />
                                        <TextInput id="impound_reason" class="w-full" v-model="form.impound_reason" required />
                                        <InputError :message="form.errors.impound_reason" />
                                    </div>
                                    <div>
                                        <InputLabel for="impound_date" value="Impound Date" />
                                        <TextInput id="impound_date" type="date" class="w-full" v-model="form.impound_date" required />
                                        <InputError :message="form.errors.impound_date" />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="image" value="Vehicle Image" />
                                        <input id="image" type="file" @change="event => form.image = event.target.files[0]" class="mt-1 block w-full" />
                                        <InputError :message="form.errors.image" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <PrimaryButton type="submit">Submit</PrimaryButton>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
