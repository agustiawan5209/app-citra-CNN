<script setup>
import Hero from '@/Components/Header/Hero.vue';
import Layanan from '@/Components/Header/Layanan.vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>

    <main class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-gray-800">Ambil Gambar Tanaman Obat Dari Galeri </h1>
        <p class="text-gray-600">Klasifikasi Jenis Tanaman Obat Kencur, Jahe, Lengkuas, Temulawak, Kunyit</p>
        <div class="mt-12">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="mb-6">
                    <label for="file" class="block mb-2 text-sm text-gray-600">Pilih file atau seret file ke sini</label>
                    <input type="file" id="file" name="file"  class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Mulai Klasifikasi</button>
            </form>
        </div>
    </main>
</template>

<style>

</style>
