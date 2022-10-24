<script setup>
import { ref } from 'vue';
import Header from '@/Components/Main/Header.vue';
import Footer from '@/Components/Main/Footer.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>

    <div class="bg-white dark:bg-gray-900">



<Header>

</Header>

    <main class="space-y-40 mb-40">

        <slot>

        </slot>

    </main>

    <Footer>

    </Footer>
    </div>

</template>
