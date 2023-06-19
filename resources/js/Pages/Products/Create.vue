<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ProductformationForm from './Partials/ProductformationForm.vue';
</script>

<template>
    <Head title="Cadastro de Produto" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastro de Produto</h2>
        </template>

        <div class="py-12">
            <div class="">
                <ProductformationForm />


            </div>
        </div>
    </AuthenticatedLayout>
</template>
