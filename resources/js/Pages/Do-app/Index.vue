<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head , Link } from '@inertiajs/inertia-vue3';
import Posts from "@/Components/Posts.vue";


defineProps([
    'canLogin',
    'canRegister',
    'posts',
    ]
)

const form = useForm({
    message: '',
});
</script>

<template>

    <Head title="Index" />

    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

        <template v-else>
            <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

            <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
        </template>
    </div>

        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('post.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Chirp</PrimaryButton>
            </form>
        </div>

    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        <Posts
            v-for="post in posts.data"
            :key="post.id"
            :post="post"
        />
    </div>





</template>
