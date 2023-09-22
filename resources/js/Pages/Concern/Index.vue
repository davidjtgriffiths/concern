<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Concern from '@/Components/Concern.vue';

defineProps(['concerns']);
 
const form = useForm({
    subject: '',
    message: '',
    recipient_email: '',
});
</script>
 
<template>
    <Head title="Concerns" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('concerns.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.subject"
                    placeholder="Subject"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.subject" class="mt-2" />

                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />

                <textarea
                    v-model="form.recipient_email"
                    placeholder="To"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.recipient_email" class="mt-2" />
                <PrimaryButton class="mt-4">Concern</PrimaryButton>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Concern
                    v-for="concern in concerns"
                    :key="concern.id"
                    :concern="concern"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>