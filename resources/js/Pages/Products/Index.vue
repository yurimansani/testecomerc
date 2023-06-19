<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Product from '@/Components/Product.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Link } from '@inertiajs/vue3'

defineProps(['products','hasPages','nextPageUrl','lastPage','previousPageUrl','currentPage','nextCursor','previousCursor']);
const form = useForm({
    message: '',
});

</script>
{{ products }}
<template>
    <Head title="Produtos" />
 
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produtos</h2>
        </template>
        
        <div class="card">
            <div class=" mx-auto p-4 sm:p-6 lg:p-8 ">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            
                            <div class="border rounded-lg divide-y divide-gray-200">
                                <div class="py-3 px-4">
                                    <div class="relative max-w-xs">
                                        <!-- <label for="hs-table-with-pagination-search" class="sr-only">Search</label> -->
                                        <Link :href="route('products.create')">
                                            <PrimaryButton  >Novo Produto</PrimaryButton>
                                        </Link>
                                        <!-- <input type="text" name="hs-table-with-pagination-search" id="hs-table-with-pagination-search" class="p-3 pl-10 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Search for items"> -->
                                        <!-- <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none pl-4">
                                            <svg class="h-3.5 w-3.5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded-lg divide-y divide-gray-200">

                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome do Produto</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <Product
                                                v-for="product in products"
                                                :key="product.id"
                                                :product="product"
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