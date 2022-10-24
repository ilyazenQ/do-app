<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import Hero from '@/Components/Main/Hero.vue';
import Featured from '@/Components/Main/Featured.vue';
import Posts from '@/Components/Main/Posts.vue';
import CardSlider from '@/Components/Main/SliderCards.vue';

export default {
    components: {
        Hero, Featured, Posts, CardSlider
    },
    layout: MainLayout

}
</script>

<template>

    <MainLayout>

        <Hero>

        </Hero>

        <Featured>

        </Featured>

        <Posts>

        </Posts>

        <CardSlider>

        </CardSlider>

    </MainLayout>

</template>
