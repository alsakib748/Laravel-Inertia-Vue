<script setup>

const images = [

    { id: 1, label: 'Test 1', url: 'http://localhost:8000' },
    { id: 2, label: 'Test 2', url: 'http://localhost:8000' },
    { id: 3, label: 'Test 3', url: 'http://localhost:8000' },

];

</script>

<template>

    <header class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">My Images</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <div v-for="image in images" :key="image.id" class="bg-white overflow-hidden shadow rounded-lg">
                    <img :src="image.url" alt="Image" class="w-full h-48 object-contain">
                    <div class="px-4 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ image.name }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ image.label }}</p>

                    </div>
                </div>
            </div>

        </div>
    </main>

</template>

<style scoped></style>
