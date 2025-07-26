<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage, Link, Head, useForm, router } from "@inertiajs/vue3";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import { ref, computed, watch } from 'vue';

defineProps({
    students: {
        type: Object,
        required: true,
    },
    updatedPageNumber: {
        type: Function,
        return: true,
    }
});

let search = ref(usePage().props.search), pageNumber = ref(1);

let studentsUrl = computed(() => {
    let url = new URL(route("students.index"));
    url.searchParams.append('page', pageNumber.value);

    if (search.value) {
        url.searchParams.append("search", search.value);
    }

    return url;
});

const updatedPageNumber = (link) => {
    pageNumber.value = link.url.split("=")[1];
};

watch(() => studentsUrl.value, (updatedStudentsUrl) => {
    // console.log(newValue);
    router.visit(updatedStudentsUrl, {
        preserveScroll: true,
        preserveState: true,
        replace: true,
    });
});

// console.log(usePage().props.students);

watch(() => search.value, (value) => {
    if (value) {
        pageNumber.value = 1;
    }
    // console.log(newValue);
    // router.visit(updatedStudentsUrl, {
    //     preserveScroll: true,
    //     preserveState: true,
    //     replace: true,
    // });
});

const deleteForm = useForm({});

const deleteStudent = (studentId) => {
    if (confirm('Are you sure you want to delete this student?')) {
        deleteForm.delete(route('students.destroy', studentId));
    }
}

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

                <!-- {{ search }} -->

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
                            <input v-model="search" type="search" class="grow" placeholder="Search" />
                            <kbd class="kbd kbd-sm">⌘</kbd>
                            <kbd class="kbd kbd-sm">K</kbd>
                        </label>
                    </div>

                    <div class="sm:mt-0 sm:ml-16 sm:flex-none">
                        <Link as="link" :href="route('students.create')" class="btn btn-primary">Add Student</Link>
                    </div>

                </div>

                <div class="overflow-x-auto px-4 py-2">
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
                                    <button @click="deleteStudent(student.id)"
                                        class="btn btn-sm btn-soft btn-secondary">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br />

                <Pagination :data="students" :updatedPageNumber="updatedPageNumber" />

                <br />

            </div>
        </div>

    </AuthenticatedLayout>
</template>
