<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';


defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: null,
    email: null,
    birthDate: null,
    address: null,
    complement: null,
    neighborhood: null,
    zipcode: null,
});
</script>

<template>
    <form @submit.prevent="form.post(route('clients.store'))"  class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Informações básicas</h2>

                    </header>

                    <div class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Nome" />

                            <TextInput id="name" type="text" placeholder="Digite aqui..." class="mt-1 block w-full"
                                v-model="form.name" required autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput id="email" type="email" placeholder="Digite aqui..." class="mt-1 block w-full"
                                v-model="form.email" required autocomplete="username" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div>
                            <InputLabel for="birthDate" value="Data de Nascimento" />

                            <TextInput id="birthDate" type="date" class="mt-1 block w-full" v-model="form.birthDate" required />

                            <InputError class="mt-2" :message="form.errors.birthDate" />
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


        <div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Endereço</h2>

                    </header>

                    <div class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="address" value="Endereço" />

                            <TextInput id="address" type="text" placeholder="Digite aqui..." class="mt-1 block w-full"
                                v-model="form.address" required />

                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>

                        <div>
                            <InputLabel for="complement" value="Complemento" />

                            <TextInput id="complement" type="text" placeholder="Digite aqui..." class="mt-1 block w-full"
                                v-model="form.complement" required />

                            <InputError class="mt-2" :message="form.errors.complement" />
                        </div>
                        <div>
                            <InputLabel for="neighborhood" value="Bairro" />

                            <TextInput id="neighborhood" type="text" placeholder="Digite aqui..." class="mt-1 block w-full"
                                v-model="form.neighborhood" required />

                            <InputError class="mt-2" :message="form.errors.neighborhood" />
                        </div>
                        <div>
                            <InputLabel for="zipcode" value="Bairro" />

                            <TextInput id="zipcode" type="text" placeholder="Digite aqui..." class="mt-1 block w-full"
                                v-model="form.zipcode" required />

                            <InputError class="mt-2" :message="form.errors.zipcode" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                            <Link :href="route('clients.index')">
                                <DangerButton >Cancelar</DangerButton>
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
    </form>
</template>
