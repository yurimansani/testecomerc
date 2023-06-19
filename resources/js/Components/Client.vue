<script setup>
defineProps(['client']);

import DeleteClientForm from '@/Pages/Clients/Partials/DeleteClientForm.vue';
import { PencilIcon } from "@heroicons/vue/24/outline";
import SecondaryButton from '@/Components/SecondaryButton.vue';

import { Link } from '@inertiajs/vue3';

</script>
 
<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ client.name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ client.email }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ client.birthDate }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ client.address }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ client.complement }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ client.neighborhood }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ client.zipcode }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium inline-flex">
            <Link :href="route('clients.edit', { id: client.id })">
            <SecondaryButton @click="confirmProductDeletion">
                <PencilIcon class="h-6 w-6 text-gray-500" />
            </SecondaryButton>
            </Link> &nbsp;

            <a class="text-blue-500 hover:text-blue-700 mx-8" href="#">
                <DeleteClientForm :clientId="client.id" class="max-w-xl" />
            </a>
        </td>
    </tr>
</template>