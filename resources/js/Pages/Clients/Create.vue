<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ClientInformationForm from './Partials/ClientInformationForm.vue';

</script>

<template>
    <Head title="Cadastro de Cliente" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastro de Cliente</h2>
        </template>

        <div class="py-12">
            <div class="">
                <ClientInformationForm/>

               
            </div>
        </div>
    </AuthenticatedLayout>
</template>
