<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import { onMounted } from 'vue'

const props = defineProps({
    product: {
        type: Object,
    },
});


const form = useForm({
    name: props.product.name,
    price: props.product.price,
    photo: null,
});


</script>

<template>
    <form @submit.prevent="form.post(route('products.update', { product: product.id }),)" enctype="multipart/form-data"
        class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Dados do Produto</h2>

                    </header>

                    <div class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Produto" />

                            <TextInput id="name" type="text" placeholder="Digite aqui..." class="mt-1 block w-full"
                                v-model="form.name" required autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="price" value="Preço" />

                            <TextInput id="price" step="0.01" type="number" placeholder="Digite aqui..."
                                class="mt-1 block w-full" v-model="form.price" required />

                            <InputError class="mt-2" :message="form.errors.price" />
                        </div>
                        <div>
                            <InputLabel for="photo" value="Foto do Produto" />

                            <img v-if="product.photo && form.photo == null" width="200" :src="product.photo">
                            <TextInput @input="form.photo = $event.target.files[0]" accept="image/*" id="photo" type="file"
                                class="mt-1 block w-full block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 " />

                            <InputError class="mt-2" :message="form.errors.photo" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                            <Link :href="route('products.index')">
                            <DangerButton>Cancelar</DangerButton>
                            </Link>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0"
                                class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                            </Transition>
                        </div>
                        <!-- <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div> -->
                    </div>
                </section>
            </div>


        </div>



    </form>
</template>
