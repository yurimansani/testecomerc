<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

defineProps({
    orderId: {
        type: String,
    },
});

import { TrashIcon } from "@heroicons/vue/24/outline";

const confirmingOrderDeletion = ref(false);

const form = useForm({
    orderId: null,
});

const confirmProductDeletion = () => {
    confirmingOrderDeletion.value = true;

};

const deleteProduct = (orderId) => {
    console.log(orderId);
    form.orderId = orderId;
    form.delete(route('orders.destroy', { order: orderId }), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingOrderDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <DangerButton @click="confirmProductDeletion">
            <TrashIcon class="h-6 w-6 " />
        </DangerButton>

        <Modal :show="confirmingOrderDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Você tem certeza que quer deletar esse Pedido?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Uma vez que um Pedido é deletado todos os dados de vendas relacionado a esse Pedido também é deletado.
                </p>


                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                    <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteProduct(orderId)">
                        Apagar Pedido
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
