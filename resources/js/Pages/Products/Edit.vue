<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import EditProductformationForm from './Partials/EditProductformationForm.vue';

defineProps(['product']);
</script>

<template>
    <Head title="Edição de Produto" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edição de Produto</h2>
        </template>

        <div class="py-12">
            <div class="">
                <EditProductformationForm :product="product" />
                <!-- {{ 'product' }}
                {{ product }} -->

            </div>
        </div>
    </AuthenticatedLayout>
</template>
