<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-xl p-8">
            <h2 class="text-2xl font-semibold text-center text-gray-900 dark:text-gray-100">Forgot Password</h2>
            <p class="text-sm text-center text-gray-600 dark:text-gray-400 mb-6">Enter your email to receive a reset link</p>

            <div v-if="form.status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ form.status }}
            </div>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" type="email" required autofocus
                        class="mt-2 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <PrimaryButton class="w-full py-2 mt-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50"
                    :disabled="form.processing">
                    Send Password Reset Link
                </PrimaryButton>
            </form>
        </div>
    </div>
</template>
