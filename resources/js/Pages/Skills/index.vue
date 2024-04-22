<script setup>
    import { Head, Link, router, useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import JetPrimaryButton from '@/Components/PrimaryButton.vue';

    // vaidaciones
    import JetInputError from '@/Components/InputError.vue';

    import JetModal from '@/Components/Modal.vue';
    import JetTextInput from '@/Components/TextInput.vue';

    import { ref } from 'vue'; // Modal

    // Modal
    const acting = ref(false); // Estado para controlar si el modal de contacto está abierto o cerrado

    const form = useForm({
        name: '',
        color: '',
    });

// const submit = (method, action) => {
//     form.submit(method, action, {
//         onSuccess: () => {
//             form.reset('name', 'color');
//             acting.value = false;
//             method.value = false;
//             action.value = false;
//         }
//     });
// };

// Variable para distinguir entre crear y editar
let mode = 'create';

// Habilidad seleccionada para editar
let selectedSkill = null;

// Función para manejar la sumisión del formulario
const submit = () => {
    if (mode === 'create') {
        form.submit('post', route('skills.store'), {
            onSuccess: () => {
                form.reset('name', 'color');
                acting.value = false;
            }
        });
    } else if (mode === 'edit') {
        if (!selectedSkill) return; // Asegurarse de que haya una habilidad seleccionada

        form.submit('put', route('skills.update', [selectedSkill.id]), {
            onSuccess: () => {
                form.reset('name', 'color');
                acting.value = false;
                mode = 'create'; // Restablecer el modo a 'create' después de la edición
                selectedSkill = null; // Restablecer la habilidad seleccionada
            }
        });
    }
};

    defineProps({
        skills: Object,
        colors: Object,
    });
</script>

<template>
    <AppLayout title="Skills">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Skills
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
                <jet-primary-button
                    class="p-3 border-2 border-blue-500 text-blue-500 bg-blue-100 hover:bg-blue-200 font-bold rounded-xl"
                    @click="acting = true; mode = 'create'">
                    Add New +
                </jet-primary-button>
                <!-- Modal de Crear Skill -->
                <jet-modal :show="acting" @close="acting = false">
                    <div class="bg-gray-50 shadow-2xl p-8">
                        <!-- Aca se detectara el else sin no mando pues se mostrara el formulario -->
                        <!-- Aquí puedes colocar el contenido del modal de contacto -->
                        <h2 class="text-gray-600 text-2xl font-extrabold text-center">Let me know some details</h2>
                        <form class="flex flex-col items-center p-16" @submit.prevent="submit">
                            <jet-text-input class="px-5 py-3 w-96 border border-gray-600 rounded" type="text"
                                name="name" placeholder="Skill Name" v-model="form.name"></jet-text-input>
                            <jet-input-error :message="form.errors.name" />

                            <select class="w-96 border-gray-600 rounded mt-5" v-model="form.color">
                                <option value="">Select color</option>
                                <option v-for="color in colors" :key="color.id" :value="color">{{ color }}</option>
                            </select>
                            <jet-input-error :message="form.errors.color" />

                            <jet-primary-button
                                class="px-5 py-3 mt-5 w-96 bg-purple-400 justify-center rounded-xl text-sm"
                                :disabled="form.processing">
                                <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span>
                                <span v-show="!form.processing">Submit</span>
                            </jet-primary-button>
                        </form>
                    </div>
                </jet-modal>
                <table v-if="skills.length > 0" class="w-full text-left">
                    <thead class="border-b-2 border-gray-300 text-indigo-600">
                        <tr>
                            <th class="px-6 py-3">
                                Name
                            </th>
                            <th class="px-6 py-3">
                                Color
                            </th>
                            <th class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="skill in skills" :key="skill.id">
                        <tr class="text-sm text-indigo-900 border-b border-gray-400">
                            <td class="px-6 py-4">
                                {{ skill.name }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="flex items-center">
                                <div class="mr-5 p-4 rounded h-10 w-5" :class="skill.color"></div>
                                {{ skill.color }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <jet-primary-button
                                    class="border border-indigo-500 text-indigo-500 bg-indigo-400 hover:bg-indigo-300 mr-2"
                                    @click="acting = true; mode = 'edit'; selectedSkill = skill; form.name = skill.name; form.color = skill.color;">
                                    Edit
                                </jet-primary-button>
                                <jet-primary-button
                                    class="border border-red-500 text-red-800 bg-red-400 hover:bg-red-300 ml-2">
                                    Delete
                                </jet-primary-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="bg-red-100 border border-red-400 p-3 rounded-lg text-red-800">
                    There are no skills yet. Let's create one :)
                </div>
            </div>
        </div>
    </AppLayout>
</template>
