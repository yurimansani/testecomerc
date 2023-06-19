<script setup>
defineProps(['order']);

import DeleteOrderForm from '@/Pages/Orders/Partials/DeleteOrderForm.vue';
import { PencilIcon, DocumentTextIcon } from "@heroicons/vue/24/outline";
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';

const deleteOrderModal = ref(false);
const viewProductsModal = ref(false);

const openViewProductsModal = () => {
    viewProductsModal.value = true;
};

const closeViewProductsModal = () => {
    viewProductsModal.value = false;
}


const openDeleteOrderModal = () => {
    deleteOrderModal.value = true;
};
const closeDeleteOrderModal = () => {
    deleteOrderModal.value = true;
};
</script>
<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ order.id }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ order.amount }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ (order.status == 'open') ? 'Aberto' : 'Fechado' }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ order.client.name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
            <SecondaryButton @click="openViewProductsModal">
                <DocumentTextIcon class="h-6 w-6 text-gray-500" />&nbsp;Visualizar Produtos
            </SecondaryButton>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-sm font-medium inline-flex ">
            <Link v-if="order.status == 'open'" :href="route('orders.edit', { id: order.id })">
            <SecondaryButton @click="openDeleteModal">
                <PencilIcon class="h-6 w-6 text-gray-500" />
            </SecondaryButton>
            </Link> &nbsp;

            <a class="text-blue-500 hover:text-blue-700 mx-8" href="#">
                <DeleteOrderForm :orderId="order.id" class="max-w-xl " />
            </a>
        </td>
    </tr>

    <Modal :show="viewProductsModal" @close="closeViewProductsModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Produtos do pedido # {{ order.id }}
            </h2>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome do
                            Cliente</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="product in order.product">

                        <td class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ product.product.id }}</td>
                        <td class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ product.product.name }}</td>
                        <td class="px-6 py-3 text-left text-xs font-medium text-gray-500"> <img :src="product.product.photo"
                                width="100"></td>
                    </tr>
                </tbody>
            </table>


            <div class="py-3 px-4 text-right float-right">
                <div class="relative max-w-xs">
                    <SecondaryButton @click="closeViewProductsModal"> Cancelar </SecondaryButton>&nbsp;
                </div>
            </div>
        </div>
    </Modal>
</template>