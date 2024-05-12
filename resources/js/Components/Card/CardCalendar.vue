<script setup>
import { ref, watch, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { Calendar, DatePicker, Popover } from 'v-calendar';
import 'v-calendar/style.css';
import axios from 'axios';

const Loaded = ref(false)
const AttributeData = ref([{
    key: 'today',
    highlight: {
        color: 'purple',
        fillMode: 'solid',
        contentClass: 'italic',
    },
    dates: new Date(),
},])

onMounted(() => {
    // dates.value = new Date();

})
</script>


<template>
    <div class="w-full h-full box-content" >
        <DatePicker   :attributes="AttributeData" expanded :locale="{ id: 'id', firstDayOfWeek: 2, masks: { weekdays: 'WWWW' } }"/>
    </div>
</template>
