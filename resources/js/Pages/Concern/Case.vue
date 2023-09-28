<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Issue from '@/Components/Issue.vue';
import JournalEntry from '@/Components/Issue.vue';

defineProps(['concern']);

</script>

<template>
    <Head title="Case" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Issue
                    :key="concern.id"
                    :concern="concern"
                />
            </div>
            <!-- <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <JournalEntry
                    v-for="entry in concern.journalEntries"
                    :key="entry.id"
                    :entry="entry"
                />
            </div> -->
        </div>
    </AuthenticatedLayout>
</template>