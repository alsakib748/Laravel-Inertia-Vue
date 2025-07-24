<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage, Link, Head } from "@inertiajs/vue3";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    students: {
        type: Object,
        required: true,
    }
});

// console.log(usePage().props.students);

</script>

<template>

    <Head title="Student List" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Student List
            </h2>
        </template>

        <div class="bg-gray-100 py-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 py-2 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Students
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the Students.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- <div class="px-4 py-2  flex items-center gap-x-2 bg-slate-200 rounded border-slate-400 relative">
                <div class="absolute px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <div class="">
                    <input type="text" name=""
                        class="text-end rounded bg-slate-50 border-slate-400 hover:bg-slate-600 px-3"
                        style="text-align:end;" id="" placeholder="Search students data">
                </div>
            </div> -->

                <div class="flex items-center content-between">

                    <div class="px-4 py-2">
                        <label class="input">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                                    stroke="currentColor">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </g>
                            </svg>
                            <input type="search" class="grow" placeholder="Search" />
                            <kbd class="kbd kbd-sm">⌘</kbd>
                            <kbd class="kbd kbd-sm">K</kbd>
                        </label>
                    </div>

                    <div class="sm:mt-0 sm:ml-16 sm:flex-none">
                        <Link as="link" :href="route('students.create')" class="btn btn-primary">Add Student</Link>
                    </div>

                </div>

                <div class="overflow-x-auto px-4 py-2">
                    <!-- <table class="min-w-full rounded-lg shadow-md bg-white">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-600 to-blue-400">
                            <th
                                class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-black rounded-tl-lg">
                                Song</th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-black">Artist
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-black rounded-tr-lg">
                                Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white hover:bg-blue-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                            <td class="px-6 py-4 whitespace-nowrap">Malcolm Lockyer</td>
                            <td class="px-6 py-4 whitespace-nowrap">1961</td>
                        </tr>
                        <tr class="bg-gray-50 hover:bg-blue-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">Witchy Woman</td>
                            <td class="px-6 py-4 whitespace-nowrap">The Eagles</td>
                            <td class="px-6 py-4 whitespace-nowrap">1972</td>
                        </tr>
                        <tr class="bg-white hover:bg-blue-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">Shining Star</td>
                            <td class="px-6 py-4 whitespace-nowrap">Earth, Wind, and Fire</td>
                            <td class="px-6 py-4 whitespace-nowrap">1975</td>
                        </tr>
                    </tbody>
                </table> -->
                    <table class="table table-zebra w-full text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="student in students.data" :key="student.id">
                                <td>{{ student.id }}</td>
                                <td>{{ student.name }}</td>
                                <td>{{ student.email }}</td>
                                <td>{{ student.class?.name }}</td>
                                <td>{{ student.section?.name }}</td>
                                <td>{{ student.created_at }}</td>
                                <td>
                                    <Link :href="route('students.edit', student.id)"
                                        class="btn btn-sm btn-soft btn-primary mr-1">
                                    Edit</Link>
                                    <button class="btn btn-sm btn-soft btn-secondary">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br />

                <Pagination :data="students" />

                <br />

            </div>
        </div>

    </AuthenticatedLayout>
</template>
