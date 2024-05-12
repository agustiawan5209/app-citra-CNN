<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const Logo = ref('/images/logo/logo.svg')

</script>
<template>
    <img :src="Logo" class="object-contain" alt="logo" />
</template>
