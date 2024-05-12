<script setup>
import Hero from '@/Components/Header/Hero.vue';
import Layanan from '@/Components/Header/Layanan.vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { WebCamUI } from 'vue-camera-lib';

function photoTaken(data) {
    console.log('image blob: ', data.blob)
    console.log('image data url', data.image_data_url)
};
</script>

<template>

    <main class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-gray-800">Ambil Gambar Tanaman Obat</h1>
        <p class="text-gray-600">Klasifikasi Jenis Tanaman Obat Kencur, Jahe, Lengkuas, Temulawak, Kunyit</p>
        <div class="mt-12">
            <WebCamUI :fullscreenState="false" @photoTaken="photoTaken" />
        </div>
    </main>
</template>

<style></style>
