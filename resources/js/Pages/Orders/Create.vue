<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CreateOrderForm from './Partials/CreateOrderForm.vue';

defineProps(['products', 'clients']);

</script>

<template>
    <Head title="Cadastro de Pedido" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastro de Pedido</h2>
        </template>

        <div class="py-12">
            <div class="">
                <CreateOrderForm :products="products" :clients="clients" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
