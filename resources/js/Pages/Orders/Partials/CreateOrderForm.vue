<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

import { PlusIcon, TrashIcon, CheckIcon } from "@heroicons/vue/24/outline";
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    products: {
        type: Array,
    },
    clients: {
        type: Array,
    },
});

const form = useForm({
    amount: 0,
    products: [],
    client: null,
    status: ''
});

const addProductModal = ref(false);
const addClientModal = ref(false);
const productToview = ref([]);
const nameClientSelected = ref('');

const openProductModal = () => {
    addProductModal.value = true;
};

const openClientModal = () => {
    addClientModal.value = true;
};

const closeProductModal = () => {
    addProductModal.value = false;
};
const closeClientModal = () => {
    addClientModal.value = false;
};

const selectClient = (client) => {
    closeClientModal();
    form.client = client;
    nameClientSelected.value = client.name;
};
const addProduct = (product) => {
    closeProductModal();
    form.products.push({ id: product.id });
    productToview.value.push(product);
    let amount = parseFloat(product.price) + parseFloat(form.amount);

    form.amount = amount.toFixed(2);
};
const removeProduct = (product) => {
    let removed = false;
    let teste = productToview.value.map((element) => {
        if ((element.id == product.id) && !removed) {
            removed = true;
            return null;
        }
        return element;
    });

    let products = teste.filter((ele) => {
        console.log(ele);
        if (ele == null) {
            return false;
        }
        return true;
    });
    let amount = parseFloat(form.amount) - parseFloat(product.price);
    form.amount = amount.toFixed(2);
    productToview.value = products;

    if (productToview.value.length == 0) {
        form.amount = 0;
    }
    let productsToSave = [];
    products.forEach(element => {
        productsToSave.push({ id: element.id });
    });
    form.products = productsToSave;


};

</script>

<template>
    <form @submit.prevent="form.post(route('orders.store'))" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Produtos</h2>

                    </header>

                    <div class="mt-6 space-y-6">
                        <div class="overflow-hidden">

                            <div class="py-3 px-4 text-right float-right">
                                <div class="relative max-w-xs">
                                    <PrimaryButton v-on:click="openProductModal" type="button">Adicionar produto
                                    </PrimaryButton>
                                </div>
                            </div>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome do
                                            Produto</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr v-if="productToview.length == 0">
                                        <td colspan="4"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 text-center">
                                            Nenhum produto selecionado.</td>
                                    </tr>
                                    <tr v-for="product in productToview" :product="product">

                                        <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 ">{{ product.name
                                        }}</td>
                                        <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 ">{{
                                            product.price.toFixed(2) }}</td>
                                        <td class="w-4 p-4"> <img :src="product.photo" width="100"></td>
                                        <td class="px-6 py-3 text-center text-xs font-medium text-gray-500 ">
                                            <DangerButton type="button" @click="removeProduct(product)">

                                                <TrashIcon class="h-6 w-6 " />
                                            </DangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Modal :show="addClientModal" @close="closeClientModal">
                                <div class="p-6">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        Selecione o Cliente.
                                    </h2>

                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    #</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Nome do Cliente</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <tr v-for="client in clients">
                                                <td class="w-4 p-4">
                                                    <PrimaryButton v-on:click="selectClient(client)" type="button">
                                                        <CheckIcon class="h-6 w-6 font-medium" />
                                                    </PrimaryButton>
                                                </td>
                                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{
                                                    client.name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <div class="py-3 px-4 text-right float-right">
                                        <div class="relative max-w-xs">
                                            <SecondaryButton @click="closeProductModal"> Cancelar </SecondaryButton>&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </Modal>

                            <Modal :show="addProductModal" @close="closeProductModal">
                                <div class="p-6">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        Selecione o produto.
                                    </h2>

                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    #</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Nome do Produto</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                                    Preço</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Foto</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <tr v-for="product in products">
                                                <td class="w-4 p-4">
                                                    <PrimaryButton v-on:click="addProduct(product)" type="button">
                                                        <PlusIcon class="h-6 w-6 font-medium" />
                                                    </PrimaryButton>
                                                </td>
                                                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{
                                                    product.name }}</td>
                                                <td class="px-6 py-3 text-right text-xs font-medium text-gray-500">R$ {{
                                                    product.price.toFixed(2) }}</td>
                                                <td class="w-4 p-4"> <img :src="product.photo" width="100"></td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <div class="py-3 px-4 text-right float-right">
                                        <div class="relative max-w-xs">
                                            <SecondaryButton @click="closeProductModal"> Cancelar </SecondaryButton>&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </Modal>
                        </div>
                    </div>
                </section>
            </div>


        </div>


        <div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <section>
                    <!-- <header>
                        <h2 class="text-lg font-medium text-gray-900">Endereço</h2>

                    </header> -->

                    <div class="mt-6 space-y-6">
                        <div>
                            <div class="py-3 px-4 text-right float-right">
                                <div class="relative max-w-xs">
                                    <PrimaryButton v-on:click="openClientModal" type="button">Selecionar o cliente
                                    </PrimaryButton>
                                </div>
                            </div>
                            <InputLabel for="client" value="Cliente" />

                            <TextInput id="client" type="text" class="mt-1 block w-full" placeholder="Selecione o cliente"
                                v-model="nameClientSelected" disabled />

                            <InputError class="mt-2" :message="form.errors.client" />
                        </div>

                        <div>
                            <InputLabel for="status" value="Status" />
                            <select name="status" v-model="form.status" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Selecione</option>
                                <option value="open">Aberto</option>
                                <option value="closed">Fechado</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>

                    <div>
                        <InputLabel for="amount" value="Total" />

                        <TextInput id="amount" type="text" class="mt-1 block w-full" v-model="form.amount" disabled />

                        <InputError class="mt-2" :message="form.errors.amount" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                        <Link :href="route('orders.index')">
                        <DangerButton>Cancelar</DangerButton>
                        </Link>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0"
                            class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                        </Transition>
                    </div>
                </div>
            </section>
        </div>


    </div>
</form></template>
