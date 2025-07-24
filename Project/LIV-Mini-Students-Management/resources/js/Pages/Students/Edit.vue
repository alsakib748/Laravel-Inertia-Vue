<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { usePage, Head, useForm, Link } from '@inertiajs/vue3';
import { watch, ref, onMounted } from 'vue';

defineProps({
    classes: {
        type: Object,
        required: true,
    },
    student: {
        type: Object,
        required: true,
    }
    // sections: {
    //     type: Object,
    //     required: true,
    // }
});

let sections = ref({});
let student = usePage().props.student.data;

const form = useForm({
    name: student.name,
    email: student.email,
    class_id: student.class?.id ?? '', // class.id means class from resource and id means id
    section_id: student.section?.id ?? '',
});

watch(
    () => form.class_id,
    (newValue) => {
        // console.log(newValue);
        getSections(newValue);
    });

onMounted(() => {
    getSections(form.class_id);
});

const getSections = (classId) => {
    axios.get('/api/sections?class_id=' + classId)
        .then((response) => {
            // console.log(response.data);
            sections.value = response.data;
        });
};

const updateStudent = () => {

    // form.post(route('students.store'), {
    //     onSuccess: () => {
    //         form.reset();
    //     }
    // });

    form.put(route('students.update', student.id));

};

</script>

<template>

    <Head title="Update Student" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Update Student
            </h2>
        </template>

        <section class="p-6">

            <div class="bg-white p-4 rounded-md w-96 mx-auto">

                <form @submit.prevent="updateStudent" action="" class="">

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
                        <Link :href="route('students.index')" class="btn btn-warning mr-2">Cancel</Link>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </section>
    </AuthenticatedLayout>
</template>
