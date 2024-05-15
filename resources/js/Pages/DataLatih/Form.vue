<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps, watch, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    kelas: {
        type: Object,
        default: () => ({})
    }
})
const Form = useForm({
    gambar: '',
    kelas: '',
})

function submit() {
    Form.post(route('DataLatih.store'), {
        onError: (err) => {
            console.log(err)
        }
    });
}

const Image = ref(null)

const PhotoTake = (Event) => {
    const file = Event.target.files[0]
    Form.gambar = file;
    const reader = new FileReader()
    reader.onload = (e) => {
        Image.value = e.target.result
    }
    reader.readAsDataURL(file)
    console.log(file)
    console.log(Image)
}

</script>

<template>

    <Head title="DataLatih" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">
                <form @submit.prevent="submit()" novalidate="" action=""
                    class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Data Informasi DataLatih</p>
                        <p class="text-xs">-</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50 relative box-content">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full">
                                <label for="kelas" class="text-sm">Kelas</label>
                                <div class="w-full mx-auto z-10 -bottom-24">
                                    <select id="kelas" v-model="Form.kelas"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option v-for="item in kelas" :value="item.nama"> {{ item.nama }} </option>
                                    </select>
                                </div>

                                <InputError :message="Form.errors.kelas" />
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="file" class="block mb-2 text-sm text-gray-600">Pilih file atau seret file ke
                                    sini</label>
                                <input type="file" id="file" name="file" @input="PhotoTake($event)"
                                    class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="sol-span-full sm:col-span-3 ">
                                <img :src="Image" class="max-w-lg" />
                            </div>



                        </div>
                        <PrimaryButton type="submit" class="col-span-full mt-20 text-center z-[100]">Simpan
                        </PrimaryButton>
                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
