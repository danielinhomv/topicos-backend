<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import PrimaryButton from '../../Components/PrimaryButton.vue'
import { Link, useForm } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia'
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue'
defineProps({
    juegos: {
        type: Object,
        required: true
    }
});
const abiertoCreate = ref(false);

const form = useForm({
    nombre: null,
    nro_participantes: null,
    monto: null,
    moneda: null
})

const eliminar = id => {
    if (confirm('¿Está seguro de eliminar?')) {
        Inertia.delete(route('permisos.destroy', id))
    }
}
const entrar = (id) => {
    Inertia.get(route('juegos.home', { id: id }));
}

const abrirModalCreate = () => {
    abiertoCreate.value = true;
}

const cerrarModal = () => {
    abiertoCreate.value = false;
    form.name = null;
}
const submitFormCreate = () => {
    form.post(route('juegos.create'));
    cerrarModal();
}
</script>

<template>
    <AppLayout title="juegos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                juegos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-5 flex justify-end">
                        <PrimaryButton @click="abrirModalCreate()">
                            Crear
                        </PrimaryButton>
                    </div>

                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        <li v-for="juego in juegos" class="bg-gray-200 p-8 rounded-lg shadow-md">
                            <h2 class="text-lg font-semibold mb-2">{{ juego.nombre }}</h2>
                            <p class="text-green-600 mb-4">
                                {{ juego.estado }}
                            </p>
                            <p class="text-gray-600 mb-4">Rol: {{ juego.rol }}</p>
                            <p class="text-gray-600 mb-4">Jugadores : {{ juego.nro_participantes_actual }}</p>
                            <div class="flex justify-between items-center">
                                <PrimaryButton
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded"
                                    @click="entrar(juego.id)">
                                    Entrar
                                </PrimaryButton>
                                <div class="w-4"></div> <!-- Espacio entre los botones -->
                                <DangerButton
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                                    Eliminar
                                </DangerButton>
                            </div>
                        </li>
                        <!-- Repite este patrón para más elementos -->
                    </ul>

                    <DialogModal :show="abiertoCreate" :maxWidth="'sm'">

                        <template #title>
                            Crear Juego
                        </template>

                        <template #content>
                            <div>
                                <InputLabel for="nombre" value="nombre" />
                                <TextInput id="nombre" v-model="form.nombre" type="text" autocomplete="nombre"
                                    class="mt1 block w-ful" />
                            </div>
                            <div>
                                <InputLabel for="limite de participantes" value="limite de participantes" />
                                <TextInput id="nro_participantes" v-model="form.nro_participantes" type="number" min="2"
                                    class="mt1 block w-ful" />
                            </div>
                            <div>
                                <InputLabel for="monto" value="monto" />
                                <TextInput id="monto" v-model="form.monto" type="number" autocomplete="monto" min="1"
                                    class="mt1 block w-ful" />
                            </div>
                            <div>
                                <InputLabel for="moneda" value="moneda" />
                                <TextInput id="moneda" v-model="form.moneda" type="text" autocomplete="moneda"
                                    class="mt1 block w-ful" />
                            </div>
                        </template>

                        <template #footer>
                            <DangerButton @click="cerrarModal()" class="mr-1">
                                Cancelar
                            </DangerButton>
                            <PrimaryButton @click="submitFormCreate()" class="ml-1">
                                Confirmar
                            </PrimaryButton>
                        </template>
                    </DialogModal>
                </div>
            </div>
        </div>
    </AppLayout>
</template>