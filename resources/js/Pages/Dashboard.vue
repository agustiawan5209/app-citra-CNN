<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import HeaderStats from '@/Components/Header/HeaderStats.vue';
import { defineProps } from "vue";

const props = defineProps({
    pengguna: Number,
    balita: Number,

});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-4 relative box-content">
            <div class="max-w-7xl mx-auto sm:px-6">
                <HeaderStats :pengguna="0" :balita="0" />

            </div>
        </div>
    </AuthenticatedLayout>
</template>
