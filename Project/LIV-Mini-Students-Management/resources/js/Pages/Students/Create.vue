<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { watch, ref } from 'vue';

defineProps({
    classes: {
        type: Object,
        required: true,
    },
    // sections: {
    //     type: Object,
    //     required: true,
    // }
});

const form = useForm({
    name: "",
    email: "",
    class_id: "",
    section_id: "",
});

let sections = ref({});

watch(
    () => form.class_id,
    (newValue) => {
        // console.log(newValue);
        getSections(newValue);
    });

const getSections = (classId) => {
    axios.get('/api/sections?class_id=' + classId)
        .then((response) => {
            // console.log(response.data);
            sections.value = response.data;
        });
};

const createStudent = () => {

    // form.post(route('students.store'), {
    //     onSuccess: () => {
    //         form.reset();
    //     }
    // });

    form.post(route('students.store'));

};

</script>

<template>

    <Head title="Create Student" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Student
            </h2>
        </template>

        <section class="p-6">

            <div class="bg-white p-4 rounded-md w-96 mx-auto">

                <form @submit.prevent="createStudent" action="" class="">

                    <!-- {{ form.errors }} -->

                    <div class="py-2">
                        <label class="block mb-1" for="">Name</label>
                        <input v-model="form.name" type="text" placeholder="Name" name="name"
                            class="input input-primary"
                            :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.name }" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                    <div class="py-2">
                        <label class="block mb-1" for="">Email</label>
                        <input v-model="form.email" type="email" placeholder="Email" name="email"
                            class="input input-primary"
                            :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.email }" />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>
                    <div class="py-2">
                        <label class="block mb-1" for="">Class</label>
                        <input v-model="form.class_id" type="text" class="input" placeholder="Select a Class"
                            list="classes" name="class"
                            :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.class_id }" />
                        <datalist id="classes">
                            <option v-for="item in classes.data" :key="item.id" :value="item.id">
                                {{ item.name }}
                            </option>
                        </datalist>
                        <InputError :message="form.errors.class_id" class="mt-2" />
                    </div>
                    <div class="py-2">
                        <label class="block mb-1" for="">Section</label>
                        <input v-model="form.section_id" type="text" class="input" placeholder="Select a Section"
                            list="sections" name="section"
                            :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.section_id }" />
                        <datalist id="sections">
                            <option v-for="section in sections.data" :key="section.id" :value="section.id">
                                {{ section.name }}
                            </option>
                        </datalist>
                        <InputError :message="form.errors.section_id" class="mt-2" />
                    </div>
                    <div class="py-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </section>
    </AuthenticatedLayout>
</template>
