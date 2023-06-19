<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Order from '@/Components/Order.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Link } from '@inertiajs/vue3'

defineProps(['orders','hasPages','nextPageUrl','lastPage','previousPageUrl','currentPage','nextCursor','previousCursor']);
const form = useForm({
    message: '',
});

</script>
<template>
    <Head title="Clientes" />
 
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pedidos</h2>
        </template>
        
        <div class="card">
            <div class=" mx-auto p-4 sm:p-6 lg:p-8 ">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            
                            <div class="border rounded-lg divide-y divide-gray-200">
                                <div class="py-3 px-4">
                                    <div class="relative max-w-xs">
                                        <Link :href="route('orders.create')">
                                            <PrimaryButton  >Novo Pedido</PrimaryButton>
                                        </Link>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded-lg divide-y divide-gray-200">

                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N° Pedido</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produtos</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <Order
                                                v-for="order in orders"
                                                :key="order.id"
                                                :order="order"
                                            />
                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-1 px-4" v-if="hasPages">
                                    <nav class="flex items-center space-x-2">
                                        <Link :href="previousPageUrl" v-if="currentPage !== 1">
                                            <span aria-hidden="true">«</span>
                                            <span class="sr-only">Previous</span>
                                        </Link>
                                        <Link :href="previousPageUrl" v-if="currentPage !== 1">
                                            <span class="text-gray-400 hover:text-blue-600 p-4 inline-flex items-center gap-2 font-medium rounded-md"  aria-current="page">{{previousCursor}}</span>
                                        </Link>
                                        <Link href="#">
                                            <span class="w-10 h-10 bg-blue-500 text-white p-4 inline-flex items-center text-sm font-medium rounded-full"  aria-current="page">{{currentPage}}</span>
                                        </Link>
                                        <Link :href="nextPageUrl" v-if="currentPage < lastPage">
                                            <span class="text-gray-400 hover:text-blue-600 p-4 inline-flex items-center gap-2 font-medium rounded-md"  aria-current="page">{{nextCursor}}</span>
                                        </Link>

                                        <Link :href="nextPageUrl" v-if="currentPage < lastPage">
                                            <span class="sr-only">Next</span>
                                        <span aria-hidden="true">»</span>
                                        </Link>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>