<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['concern']);
const editing = ref(false);
const status = ref();
const datas = 
[
    {    
        name:'option1',
        id:1   
    },
    {    
        name:'option2',
        id:2
    },
    {    
        name:'option3',
        id:3
    },
]

</script>

<template>
    <Link :href="'/case/' + concern.id"><div class="flex justify-between items-center"></div>
        <div class="p-6 flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
        <div class="flex-1"> 
            <div>
                <span class="text-gray-800">{{ concern }}</span>
                <!-- <small class="ml-2 text-sm text-gray-600">{{ new Date(concern.created_at).toLocaleString() }}</small> -->
                <!-- <small v-if="concern.created_at !== concern.updated_at" class="text-sm text-gray-600"> &middot; edited</small> -->
            </div>
            
        </div>
            <p class="mt-4 text-lg text-gray-900">{{ concern.message }}</p>
            <p class="mt-4 text-lg text-gray-900">{{ concern.public_status.name }}</p>
            <p class="mt-4 text-lg text-gray-900">{{ status }}</p>
        </div>

        <div class="form-group">
            <label>Select State:</label>
            <select class='form-control' v-model='status'>
                <option value='0' >Select State</option>
                <option v-for='data in datas' :value='data.id'>{{ data.name }}</option>
            </select>
        </div>
    </Link >
</template>