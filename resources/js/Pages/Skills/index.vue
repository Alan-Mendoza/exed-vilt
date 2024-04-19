<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import JetPrimaryButton from '@/Components/PrimaryButton.vue';

    import Skill from '@/Personal-Components/Skill.vue'; // Componente personalizado
    // import { ref } from 'vue'

    defineProps({
        skills: Object,
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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table v-if="skills.length > 0" class="w-full">
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
                                    <!-- <Skill :background="skill.color">
                                        {{ skill.color }}
                                    </Skill> -->
                                </p>
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
