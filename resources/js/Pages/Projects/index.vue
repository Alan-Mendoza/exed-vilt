<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import JetPrimaryButton from '@/Components/PrimaryButton.vue';

    import { defineAsyncComponent, reactive } from 'vue'; // Funcion Async Component para cargar los iconos de Heroicons
    import * as HeroiconsSolid from '@heroicons/vue/24/solid'; // Importar todos los iconos de Heroicons

    const myMethod = (projects, index) => {
    const iconName = projects[index].icon_name;
    const IconComponent = HeroiconsSolid[`${iconName}Icon`];
    return defineAsyncComponent(() => Promise.resolve(IconComponent));
};

    defineProps({
        projects: Object,
    });
</script>

<template>
    <AppLayout title="Skills">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table v-if="projects.length > 0" class="w-full">
                    <thead class="border-b-2 border-gray-300 text-indigo-600">
                        <tr>
                            <th class="px-6 py-3">
                                Title
                            </th>
                            <th class="px-6 py-3">
                                Description
                            </th>
                            <th class="px-6 py-3">
                                Color
                            </th>
                            <th class="px-6 py-3">
                                Icon
                            </th>
                            <th class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="(project, index) in projects" :key="project.id">
                        <tr class="text-sm text-indigo-900 border-b border-gray-400">
                            <td class="px-6 py-4">
                                {{ project.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ project.description }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="flex items-center">
                                    <div class="mr-5 p-4 rounded h-10 w-5" :class="project.color"></div>
                                    {{ project.color }}
                                </p>
                            </td>
                            <td class="px-6 py-4" :class="project.color">
                                <component :is="myMethod(projects, index)"></component>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <jet-primary-button class="border border-indigo-500 text-indigo-500 bg-indigo-400 hover:bg-indigo-300 mr-2">
                                    Edit
                                </jet-primary-button>
                                <jet-primary-button class="border border-red-500 text-red-800 bg-red-400 hover:bg-red-300 ml-2">
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
