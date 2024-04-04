<script setup>
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '../../Layouts/AppLayout.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import PrimaryButton from '../../Components/PrimaryButton.vue';
defineProps({
    juego: {
        type: Object,
        required: true
    }
});
const redirectInvitaciones = (id) => {
Inertia.get(route('invitaciones.index',{juego_id : id}))
}
</script>
<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{juego.nombre}}
            </h2>
        </template>
        <div>
            <ul class="flex">

                <li class="flex-1 mr-2">
                    <ResponsiveNavLink class="text-center block border border-blue-300 rounded py-2 px-4 bg-blue-300 " @click="redirectInvitaciones(juego.id)" :active="route().current('invitaciones.index')">
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
    </AppLayout>
</template>