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

        <div class="hidden md:flex mt-8 text-left gap-3 border-b items-center">
            <font-awesome-icon :icon="['fas', 'user']" class="text-white h-6 w-6 rounded-md object-cover lg:h-6 lg:w-6" />
            <h5 class=" text-xl font-semibold text-white capitalize lg:block">{{ $page.props.auth.user.name }}
            </h5>
        </div>

        <ul class="mt-8 space-y-1 tracking-wide text-sm">
            <li v-if="roleToCheck('Admin')">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" :icon="['fas', 'house-user']">

                    <span class="-mr-1 font-medium">Dashboard</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Admin')">
                <NavLink :href="route('DataLatih.index')" :active="route().current('DataLatih.index')" :icon="['fas', 'gear']">

                    <span class="-mr-1 font-medium">Data Latih</span>
                </NavLink>
            </li>

        </ul>
    </div>
</template>
