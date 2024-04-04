<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import DangerButton from '@/Components/DangerButton.vue';

import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
defineProps({
    juego: {
        type: Object,
        required: true
    }
});
let correos = [];
let telefonos = [];
const email = ref('');
const telefono = ref('');
const abiertoCreate = ref(false);

const add = () => {
    if (email != '' && telefono != '') {
        correos.push(email.value);
        telefonos.push(telefono.value);
    }
    cerrarModal();
}
const abrirModalCreate = () => {
    abiertoCreate.value = true;
}

const cerrarModal = () => {
    abiertoCreate.value = false;
    clear();
}
const clear = () => {
    email.value= '';
    telefono.value= '';
}
const send = (id,correos)=>{
    Inertia.get(route('invitaciones.realizarInvitaciones',{juego_id : id,correos:correos}))
}

</script>
<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ juego.nombre }}
            </h2>
        </template>
        <div>
            <ul class="flex">
                <li class="flex-1 mr-2">
                    <ResponsiveNavLink class="text-center block border border-blue-300 rounded py-2 px-4 bg-blue-300 "
                        :active="route().current('invitaciones.index')">
                        Invita a tus amigos
                    </ResponsiveNavLink>

                </li>
                <li class="flex-1 mr-2">
                    <ResponsiveNavLink class="text-center block border border-blue-300 rounded py-2 px-4 bg-blue-300 ">
                        Partidas
                    </ResponsiveNavLink>
                </li>
            </ul>
        </div>

        <body class="antialiased bg-slate-200 text-slate-700 mx-2">
            <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
                <div class="flex flex-row justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-medium">Guest List</h1>
                    </div>
                    <div class="inline-flex space-x-2 items-center">
                        <a @click="abrirModalCreate()"
                            class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center hover:bg-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="text-sm hidden md:block">New</span>
                        </a>
                        <a @click="send(juego.id,correos)"
                            class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center text-indigo-200 hover:text-white bg-indigo-600 hover:bg-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium hidden md:block">Send</span>
                        </a>
                    </div>
                </div>
                <div id="tasks" class="my-5">

                    <div v-for="(correo, index) in correos" :key="index" id="task"
                        class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4  border-l-transparent bg-gradient-to-r from-transparent to-transparent hover:from-slate-100 transition ease-linear duration-150">
                        <div class="inline-flex items-center space-x-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                            </div>
                            <div>
                                <p>{{correo}}</p>
                                <p>{{ telefonos[index]}}</p>
                            </div>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-4 h-4 text-slate-500 hover:text-slate-700 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        <DialogModal :show="abiertoCreate" :maxWidth="'sm'">
            <template #title>
                Crear invitacion
            </template>

            <template #content>
                <div>
                    <InputLabel for="email">Email:</InputLabel>
                    <TextInput id="email" v-model="email" type="email" autocomplete="email" class="w-full" />
                </div>
                <div>
                    <InputLabel for="telefono">Teléfono:</InputLabel>
                    <TextInput id="telefono" v-model="telefono" type="text" class=" w-full" />
                </div>

            </template>

            <template #footer>
                <DangerButton @click="cerrarModal()" class="mr-1">
                    Cancelar
                </DangerButton>
                <PrimaryButton @click="add()" class="ml-1">
                    Confirmar
                </PrimaryButton>
            </template>
        </DialogModal>

    </AppLayout>
</template>