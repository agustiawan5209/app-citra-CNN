<script setup>
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <!-- component -->
    <section>
        <div class="bg-secondary text-white py-4">
            <div class="container mx-auto flex flex-col md:flex-row items-center my-4 md:my-10">
                <div class="flex flex-col w-full lg:w-1/3 justify-center items-start p-8">
                    <h1 class="text-3xl md:text-5xl p-2 text-yellow-300 tracking-loose">Citra</h1>
                    <h2 class="text-3xl md:text-5xl leading-relaxed md:leading-snug mb-2">Conventional Neural
                        Network
                    </h2>
                    <p class="text-sm md:text-base text-gray-50 mb-4">
                        Tanaman obat merupakan sumber daya alam yang penting untuk pengobatan dan kesehatan. Di
                        Indonesia, terdapat banyak sekali jenis tanaman obat yang memiliki beragam manfaat kesehatan.
                        Namun, identifikasi jenis tanaman obat seringkali menjadi kendala bagi masyarakat karena
                        membutuhkan pengetahuan botani yang mendalam.
                        <br>
                        Convolutional Neural Network (CNN) adalah salah satu metode deep learning yang efektif untuk
                        pengenalan citra. CNN telah banyak digunakan untuk berbagai aplikasi pengenalan citra, termasuk
                        pengenalan jenis tanaman obat.
                    </p>
                    <Link :href="route('register')"
                        class="bg-transparent hover:bg-yellow-300 text-yellow-300 hover:text-black rounded shadow hover:shadow-lg py-2 px-4 border border-yellow-300 hover:border-transparent">
                    Mulai Daftar</Link>
                </div>
                <div class="p-8 mt-12 mb-6 md:mb-0 md:mt-0 ml-0 md:ml-12 lg:w-2/3  justify-center">
                    <div class="h-48 flex flex-wrap content-center">
                        <div>
                            <img class="inline-block mt-28  xl:block"
                                src="https://user-images.githubusercontent.com/54521023/116969935-c13d5b00-acd4-11eb-82b1-5ad2ff10fb76.png">
                        </div>
                        <div>
                            <img class="inline-block mt-24 md:mt-0 p-8 md:p-0"
                                src="https://user-images.githubusercontent.com/54521023/116969931-bedb0100-acd4-11eb-99a9-ff5e0ee9f31f.png">
                        </div>
                        <div>
                            <img class="inline-block mt-28  lg:block"
                                src="https://user-images.githubusercontent.com/54521023/116969939-c1d5f180-acd4-11eb-8ad4-9ab9143bdb50.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
