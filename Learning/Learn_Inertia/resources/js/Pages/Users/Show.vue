<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    posts: Object,
});

const showPosts = () => {
    router.get(route('user.show', props.user), {}, {
        only: ['posts'],
    });
};

</script>


<template>

    <Head :title="user.name" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ user.name }}
            </h2>
        </template>

        <div class="py-4">

            <!-- {{ $page.props.greeting }} {{ $page.props.auth.user.name }} -->

            <!-- {{ user }}
            {{ posts }} -->

            <div class="">
                <div class="text-center">
                    <button @click="showPosts"
                        class="text-sm text-gray-100 text-center bg-orange-500 hover:bg-orange-400 rounded-md p-2">
                        Show Posts
                    </button>
                </div>
            </div>

            <!-- {{ posts }} -->
            <div v-for="post in posts" :key="post.id" class="">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg border border-500-gray my-3 p-2">
                        <h3 class="p-3">
                            <b class="">{{ post.title }}</b>
                        </h3>
                        <div class="p-2 text-gray-900">
                            {{ post.body }}
                        </div>
                        <p class="text-right">
                            <!-- Author: {{ post.user.name }} -->
                            <!-- <a :href="route('user.show', post.user)" class="">
                                {{ post.user.name }}
                            </a> -->
                            <Link :href="route('user.show', post.user)" class="">
                            {{ post.user.name }}
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
