<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Issue from '@/Components/Issue.vue';
import JournalEntry from '@/Components/JournalEntry.vue';

const props = defineProps(['concern']);

const form = useForm({
    subject: '',
    id: props.concern.id,
});

</script>

<template>
    <Head title="Case" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

            <form @submit.prevent="form.post(route('journal-entry.store'), { onSuccess: () => form.reset() })">

                <textarea
                    v-model="form.subject"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.subject" class="mt-2" />

                <PrimaryButton class="mt-4">Concern</PrimaryButton>

            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Issue
                    :key="concern.id"
                    :concern="concern"
                />
            </div>
            <!-- xx{{ concern[0].journal_entry }}xx -->
            <div v-for="x in concern.journal_entry">
xxx{{ x }}xxx
            </div>
            <!-- <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <JournalEntry
                    v-for="entry in concern.journalEntries"
                    :key="entry.id"
                    :entry="entry"
                />
            </div> -->
            <JournalEntry
                    v-for="entry in concern.journal_entry"
                    :key="entry.id"
                    :entry="entry"
                />
        </div>
    </AuthenticatedLayout>
</template>