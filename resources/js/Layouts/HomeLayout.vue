<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Hero from '@/Components/Header/Hero.vue';
import Layanan from '@/Components/Header/Layanan.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps, onMounted } from 'vue';
import axios from 'axios';


const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
const Year = new Date().getFullYear()
const Navigate = ref(false);
</script>

<template>

    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <a href="#" class="text-xl font-bold text-gray-800">Citra Tanaman Obat</a>
                </div>
                <nav>
                    <ul class="flex space-x-4">
                        <li><Link href="/" class="hover:underline">Beranda</Link></li>
                        <li><Link :href="route('galeri')" class="hover:underline">Dari Galeri</Link></li>
                        <li><Link :href="route('camera')" class="hover:underline">Kamera</Link></li>
                        <li class="flex flex-wrap justify-between gap-4">
                            <Link :href="route('login')"
                                class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray-700 border-primary hover:border-transparent hover:text-light hover:bg-primary mt-4 lg:mt-0 transition-all">
                            Masuk</Link>
                            <Link :href="route('register')"
                                class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray-700 border-primary hover:border-transparent hover:text-light hover:bg-primary mt-4 lg:mt-0 transition-all">
                            Daftar</Link>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </header>

    <main class="">
        <slot />
    </main>

    <footer class=" divide-y bg-white border-t shadow-2xl">
        <div class="py-6 text-sm text-center bg-gradient-to-tr from-primary to-green-400">Web-TOPSIS© {{ Year }}. All rights reserved.</div>
    </footer>

</template>

<style scoped>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.fade-left-enter-active {
    transition: all 0.3s ease-out;
}

.fade-left-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-left-enter-from {
    transform: translateX(-100%);
    opacity: 0;
}

.fade-left-leave-to {
    transform: translateX(100%);
    opacity: 0;
}
</style>
