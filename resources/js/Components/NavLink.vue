<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    icon:{
        type: Array,
        required: true,
    },
});

const classes = computed(() =>
    props.active
        ? 'relative flex text-lg trackingg-widest items-center space-x-4 rounded-xl bg-gradient-to-r from-primary to-green-400 px-4 py-3 text-white'
        : 'group flex text-lg trackingg-widest items-center space-x-4 rounded-md px-4 py-3 text-white'
);
const classesIcon = computed(() =>
    props.active ? 'text-white group-hover:text-secondary' : 'text-white group-hover:text-green-500'
);
</script>

<template>
    <Link :href="href" :class="classes" class="group">
        <font-awesome-icon :icon="icon" :class="classesIcon" class="transition-all trac"/>
        <slot />
    </Link>
</template>
