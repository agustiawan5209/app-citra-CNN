<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, defineProps, inject, watch } from 'vue';
// import FlashMessage from '@/Components/FlashMessage.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
const swal = inject('$swal')

const props = defineProps({
    tanaman: {
        type: Object,
        default: () => ({})
    },
})

const page = usePage()


const search = ref(null);
const ModalShow = ref(false);
const Form = useForm({
    slug: null,
    nama: '',
})
function showModal() {
    Form.reset()
    ModalShow.value = true;
}

function submit() {
    Form.post(route('Tanaman.store'), {
        onError: err => console.log(err),
        onSuccess: () => {
            if (page.props.message !== null) {
                swal({
                    icon: "success",
                    title: 'Berhasil',
                    text: page.props.message,
                    showConfirmButton: true,
                    timer: 2000
                }).then(() => {
                    page.props.message = null;
                });
            }
            ModalShow.value = false;
            Form.reset();
        }
    })
}
// Delete Modal
const VarDeleteModal = ref(false);
const DeleteForm = useForm({
    slug: null,
    title: null,
})

function showDeleteModal(item) {

    DeleteForm.slug = item.id;
    DeleteForm.title = item.nama ?? item.name;
    VarDeleteModal.value = true;
}

function deleteItem() {
    DeleteForm.delete(route('Tanaman.destroy'), {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => {
            VarDeleteModal.value = false;
            DeleteForm.reset('slug');
            swal({
                icon: "success",
                title: 'Berhasil',
                text: page.props.message,
                showConfirmButton: true,
                timer: 2000
            });
        }
    })
}
// End Delete Modal

// Edit Modal

const VarEditModal = ref(false);
const EditForm = useForm({
    slug: null,
    nama: null,
})

function showEditModal(item) {

    EditForm.slug = item.id;
    EditForm.nama = item.nama ?? item.name;
    VarEditModal.value = true;
}

function submitEdit() {
    EditForm.put(route('Tanaman.update'), {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => {
            VarEditModal.value = false;
            EditForm.reset('slug');
            swal({
                icon: "success",
                title: 'Berhasil',
                text: page.props.message,
                showConfirmButton: true,
                timer: 2000
            });
        }
    })
}

function closeEditModal(){
    EditForm.reset();
    VarEditModal.value = false;
}
// End Edit Modal
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Tanaman Obat" />
        <template #header>
            <h2 class="font-semibold leading-tight">Jenis Tanaman Obat</h2>

        </template>
        <!-- Modal tambah -->
        <Modal :show="ModalShow" maxWidth="lg">
            <div class="w-full px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border">

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="nama" value="Nama Jenis Tanaman Obat" />

                        <TextInput id="nama" type="text" class="mt-1 block w-full" v-model="Form.nama" required
                            autofocus autocomplete="nama" />

                        <InputError class="mt-2" :message="Form.errors.nama" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': Form.processing }"
                            :disabled="Form.processing">
                            Simpan
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </Modal>

        <!-- Modal Edit -->
        <Modal :show="VarEditModal" maxWidth="lg">
            <div class="w-full px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border">

                <form @submit.prevent="submitEdit">
                    <div>
                        <InputLabel for="nama" value="Nama Jenis Tanaman Obat" />

                        <TextInput id="nama" type="text" class="mt-1 block w-full" v-model="EditForm.nama" required
                            autofocus autocomplete="nama" />

                        <InputError class="mt-2" :message="EditForm.errors.nama" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button class="inline-flex items-center px-4 py-2 bg-gradient-to-tr from-red-500 to-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button" @click="closeEditModal" >
                            Batalkan
                        </button>

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': EditForm.processing }"
                            :disabled="EditForm.processing">
                            Simpan
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </Modal>

        <!-- Delete Modal -->
        <Modal :show="VarDeleteModal">
            <div class="flex flex-col max-w-full gap-2 p-6 rounded-md shadow-md bg-gray-50 text-gray-800">
                <h2 class="flex items-center gap-2 text-xl font-semibold leading-tight tracking-wide">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-6 h-6 fill-current shrink-0 text-green-600">
                        <path
                            d="M451.671,348.569,408,267.945V184c0-83.813-68.187-152-152-152S104,100.187,104,184v83.945L60.329,348.568A24,24,0,0,0,81.432,384h86.944c-.241,2.636-.376,5.3-.376,8a88,88,0,0,0,176,0c0-2.7-.135-5.364-.376-8h86.944a24,24,0,0,0,21.1-35.431ZM312,392a56,56,0,1,1-111.418-8H311.418A55.85,55.85,0,0,1,312,392ZM94.863,352,136,276.055V184a120,120,0,0,1,240,0v92.055L417.137,352Z">
                        </path>
                        <rect width="32" height="136" x="240" y="112"></rect>
                        <rect width="32" height="32" x="240" y="280"></rect>
                    </svg>
                    <span>Apakah anda yakin ingin menghapus {{ DeleteForm.title }}</span>
                </h2>
                <!-- <p class="flex-1 text-gray-600">Mauris et lorem at elit tristique dignissim et ullamcorper elit. In sed feugiat mi. Etiam ut lacinia dui.</p> -->
                <div class="flex flex-col justify-end gap-3 mt-6 sm:flex-row">
                    <button class="px-6 py-2 rounded-sm" @click="VarDeleteModal = false">Tidak</button>
                    <button class="px-6 py-2 rounded-sm shadow-sm bg-green-600 text-gray-50"
                        @click="deleteItem()">Ya</button>
                </div>
            </div>
        </Modal>
        <div class="py-12">
            <div class="bg-white overflow-hidden sm:rounded-lg border">
                <div class="border border-gray-300 rounded-lg ">

                    <div class="relative">
                        <div
                            class="flex flex-col justify-start items-start p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">

                            <div class="w-full">
                                <PrimaryButton @click="showModal()" type="button">Tambah</PrimaryButton>

                            </div>

                        </div>
                    </div>
                    <div class="overflow-x-auto mt-3">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs  uppercase border-b text-gray-900 bg-secondary rounded-t-xl">
                                <tr>
                                    <th scope="col"
                                        class="px-2 py-1 md:px-6 md:py-3 text-nowrap text-start text-xs font-medium text-white uppercase">
                                        No.
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-1 md:px-6 md:py-3 text-nowrap text-start text-xs font-medium text-white uppercase">
                                        Jenis Tanaman Obat</th>
                                    <th scope="col"
                                        class="px-2 py-1 md:px-6 md:py-3 text-nowrap text-start text-xs font-medium text-white uppercase">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="tanaman.data.length > 0">
                                <tr v-for="(item, index) in tanaman.data" :key="item.id" :index="index"
                                    class="border border-secondary hover:bg-gray-200">
                                    <td class="w-4 px-4 py-3 text-center text-gray-700">
                                        {{ (tanaman.current_page - 1) * tanaman.per_page + index + 1 }}

                                    </td>
                                    <td
                                        class="px-4 py-2 border border-secondary text-center font-medium whitespace-nowrap text-gray-600">
                                        {{ item.nama }}
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-4">
                                            <button type="button" @click="showDeleteModal(item)">
                                                <font-awesome-icon class="text-red-500 hover:text-red-700"
                                                    :icon="['fas', 'trash-can']" />
                                            </button>
                                            <button type="button" @click="showEditModal(item)">
                                                <font-awesome-icon class="text-green-500 hover:text-green-700"
                                                    :icon="['fas', 'pen']" />
                                            </button>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="10" class="text-center font-semibold py-4">
                                        Maaf Data Kosong
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                        aria-label="Table navigation">
                        <div class="flex flex-wrap">
                            <template v-for="(link, key) in tanaman.links">
                                <div v-if="link.url === null" :key="key"
                                    class="mb-1 mr-1 px-4 py-3  text-gray-400 text-sm leading-4 border rounded"
                                    v-html="link.label" />
                                <Link v-else :key="`link-${key}`"
                                    class="mb-1 mr-1 px-4 py-3 focus:text-primary text-sm leading-4 active:border-primary hover:bg-red-200 border focus:border-primary rounded"
                                    :class="{ 'bg-white border-secondary text-black': link.active }" preserve-state
                                    preserve-scroll :data="{ search }" :href="link.url"
                                    v-html="link.label" />
                            </template>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
