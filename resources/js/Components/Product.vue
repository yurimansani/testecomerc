<script setup>
import DeleteProductForm from '@/Pages/Products/Partials/DeleteProductForm.vue';
import { PencilIcon } from "@heroicons/vue/24/outline";
import SecondaryButton from '@/Components/SecondaryButton.vue';

import { Link } from '@inertiajs/vue3';


defineProps(['product']);
</script>

<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ product.name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ product.price }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><img class=" w-24" :src="product.photo" alt=""></td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-sm font-medium inline-flex">
            <Link :href="route('products.edit', { id: product.id })">
            <SecondaryButton @click="confirmProductDeletion">
                <PencilIcon class="h-6 w-6 text-gray-500" />
            </SecondaryButton>
            </Link> &nbsp;
            <a class="text-blue-500 hover:text-blue-700  mx-8" href="#">
                <DeleteProductForm :productId="product.id" class="max-w-xl" />
            </a>
        </td>
    </tr>
</template>