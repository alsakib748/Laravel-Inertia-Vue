<script setup>


import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

// For retrieve data
defineProps({
    posts: Array
});

// OR
// defineProps(['gretting']);

const form = useForm({
    title: '',
    body: '',
});

// Client Side Validation
// form.setError('body', 'Body is requires'); // For Single Input
form.setError({
    title: 'Title field is required',
    body: 'Body field is required',
});

const createPost = () => {

    // Send Request
    // form.get or form.post or form.put or form.patch or form.delete as per neccessary
    form.post(route('posts'), {
        // Preserving page scrolling
        preserveScroll: true,
        onSuccess: () => {
            // form.title = '';
            // form.body = '';
            // or
            form.reset();
        }
    });

};

</script>


<template>

    <Head title="Posts">

        <meta name="description" content="Post Index" />

    </Head>

    <AuthenticatedLayout>

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Posts
            </h2>
        </template>

        <div class="py-4 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg border border-500-gray my-3 p-4">
                <form @submit.prevent="createPost" action="" method="">
                    <!-- debug -->
                    <!-- {{ form }} -->
                    <!-- Another way to catch error. This is global validation -->
                    {{ $page.props.errors.title }}
                    {{ $page.props.errors.body }}
                    <div class="my-3">
                        <label for="" class="">Title</label>
                        <!-- N: It's Use to remove erros  @focus="form.clearErrors()" N: Use this for all errors remove when type input  -->
                        <input v-model="form.title" @focus="form.clearErrors('title')" type="text" name="title"
                            id="title"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            style="width: 100%;">
                        <div v-if="form.errors.title" class="text-sm text-red-400">
                            <!-- {{ form.errors.title }} -->
                            {{ $page.props.errors.title }}
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="" class="">Body</label>
                        <textarea v-model="form.body" @focus="form.clearErrors('body')" name="body" id="body" rows="4"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            style="width: 100%;"></textarea>
                        <div v-if="form.errors.body" class="text-sm text-red-400">
                            <!-- {{ form.errors.body }} -->
                            {{ $page.props.errors.body }}
                        </div>
                    </div>
                    <div class="my-3">
                        <button type="submit"
                            class="bg-gray-700 px-4 py-2 rounded-md font-medium text-white hover:bg-indigo-500 hover:ring-indigo-600">Post</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="py-4">
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
                            Author: {{ post.user.name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
