<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import EditOrderForm from './Partials/EditOrderForm.vue';

defineProps(['orderData', 'allClients', 'allProducts']);

</script>

<template>
    <Head title="Cadastro de Pedido" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edição de Pedido</h2>
        </template>

        <div class="py-12">
            <div class="">
                <EditOrderForm :orderData="orderData" :allClients="allClients" :allProducts="allProducts" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
