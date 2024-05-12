<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar/Sidebar.vue';

const showingNavigationDropdown = ref(false);
const Page = usePage().props.auth;
const Roles = Page.role;
function roleToCheck(role) {
    if (Array.isArray(Roles)) {
        return Roles.includes(role)
    } else {
        return false;
    }
}

function ArrayToString() {
    if (Array.isArray(Roles)) {
        return Roles.reduce((a, b) => {

            return String(a + ',' + b).toString();
        })
    }
}

</script>


<template>
    <div class="aside-anime">

        <div class="hidden md:block mt-8 text-center">
            <ApplicationLogo class="m-auto h-10 w-10 rounded-md object-cover lg:h-12 lg:w-12" />
            <h5 class="mt-4 text-xl font-semibold text-gray-600 lg:block">{{ $page.props.auth.user.name }}
            </h5>
            <span class=" text-gray-400 lg:block">{{ ArrayToString() }}</span>
        </div>

        <ul class="mt-8 space-y-1 tracking-wide text-sm">
            <li v-if="roleToCheck('Admin')">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" :icon="['fas', 'home']">

                    <span class="-mr-1 font-medium">Dashboard</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Pengguna')">
                <NavLink :href="route('dashboard.pengguna')" :active="route().current('dashboard.pengguna')"
                    :icon="['fas', 'home']">

                    <span class="-mr-1 font-medium">Dashboard</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Admin')">
                <NavLink :href="route('Master.index')" :active="route().current('Master.index')"
                    :icon="['fas', 'users']">

                    <span class="-mr-1 font-medium">Master</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Admin')">
                <NavLink :href="route('Kriteria.index')"
                    :active="route().current('Kriteria.index') || route().current('Kriteria.create') || route().current('Kriteria.show') || route().current('Kriteria.edit')"
                    :icon="['fas', 'clipboard']">

                    <span class="-mr-1 font-medium">Kriteria Lahan Usaha</span>
                </NavLink>
            </li>
            <li>
                <NavLink :href="route('Alternatif.index')"
                    :active="route().current('Alternatif.index') || route().current('Alternatif.create') || route().current('Alternatif.show') || route().current('Alternatif.edit')"
                    :icon="['fas', 'circle-info']">

                    <span class="-mr-1 font-medium">Jenis Ikan</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Admin')">
                <NavLink :href="route('Topsis.index')"
                    :active="route().current('Topsis.index')"
                    :icon="['fas', 'circle-info']">

                    <span class="-mr-1 font-medium">Penilaian</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Pengguna')">
                <NavLink :href="route('Topsis.index.user')"
                    :active="route().current('Topsis.index.user')"
                    :icon="['fas', 'folder-open']">

                    <span class="-mr-1 font-medium">Hasil Rekomendasi</span>
                </NavLink>
            </li>


        </ul>
    </div>
    <div class="-mx-6 flex items-center justify-between border-t px-6 pt-4">
        <NavLink :href="route('logout')" method="post" as="button" :icon="['fas', 'right-from-bracket']">
            <span class="group-hover:text-gray-700 capitalize">Logout</span>
        </NavLink>
    </div>
</template>
