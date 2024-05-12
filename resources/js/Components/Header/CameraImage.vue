<script setup>
import Hero from '@/Components/Header/Hero.vue';
import Layanan from '@/Components/Header/Layanan.vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { WebCamUI } from 'vue-camera-lib';
import { ref } from 'vue';

const image = ref(null)
const BlobImage = ref(null)
function photoTaken(data) {
    console.log('image blob: ', data.blob)
    console.log('image data url', data.image_data_url)
    image.value = data.image_data_url;
    BlobImage.value = data.blob
};
</script>

<template>

    <main class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-gray-800">Ambil Gambar Tanaman Obat</h1>
        <p class="text-gray-600">Klasifikasi Jenis Tanaman Obat Kencur, Jahe, Lengkuas, Temulawak, Kunyit</p>
        <div class="mt-12">
            <WebCamUI :fullscreenState="false" @photoTaken="photoTaken" />
        </div>

        <div class="my-12" v-if="image != null && BlobImage != null">
            <img :src="image" />
        </div>
    </main>
</template>

<style></style>
