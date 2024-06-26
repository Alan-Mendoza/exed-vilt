<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';

import JetApplicationMark from '@/Components/ApplicationMark.vue';
import JetPrimaryButton from '@/Components/PrimaryButton.vue';

import JetModal from '@/Components/Modal.vue';
import JetTextInput from '@/Components/TextInput.vue';

import Section from '@/Personal-Components/Section.vue'; // Componente personalizado
import Skill from '@/Personal-Components/Skill.vue'; // Componente personalizado
import Project from '@/Personal-Components/Project.vue'; // Componente personalizado

// import { BeakerIcon } from '@heroicons/vue/24/solid';

import * as HeroiconsSolid from '@heroicons/vue/24/solid'; // Importar todos los iconos de Heroicons
import { defineAsyncComponent, reactive } from 'vue'; // Funcion Async Component para cargar los iconos de Heroicons
import { ref } from 'vue'; // Modal

// vaidaciones
import JetInputError from '@/Components/InputError.vue';

const myMethod = (projects, index) => {
    const iconName = projects[index].icon_name;
    const IconComponent = HeroiconsSolid[`${iconName}Icon`];
    return defineAsyncComponent(() => Promise.resolve(IconComponent));
};

// Modal
const contacting = ref(false); // Estado para controlar si el modal de contacto está abierto o cerrado

// Formulario
// const form = reactive({
//     email: '',
//     message: '',
// });
// function submit() {
//   router.post('contact', form)
// }

const form = useForm({
    email: '',
    message: '',
});

const submit = () => {
    form.post(route('contact'));
};

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    skills: Object,
    projects: Object,
});

</script>

<template>
    <Head title="Welcome"/>

    <div class="grid grid-cols-2 text-right py-10 px-72 bg-gray-800 text-gray-300">
        <div>
            <jet-application-mark class="h-12 w-auto"></jet-application-mark>
        </div>
        <div v-if="canLogin">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm underline">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-base underline">
                    Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="text-base underline place-self-end ml-4">
                    Register
                </Link>
            </template>
        </div>
    </div>

    <Section class="bg-gray-800 pt-16 h-screen">
        <div class="h-2/3 flex flex-wrap content-between border-gray-600 pb-36">
            <p class="border-b-2 font-bold border-gray-400 pb-3 text-2xl text-gray-300 uppercase">Hey! This is Alan. I'm a Software Engineer and I would like to work with you.</p>
            <div class="flex items-end border-b-2 border-gray-500 pb-2 mr-8">
                <p class="font-bold mr-5 text-gray-500 text-xl">Want to know more?</p>
                <jet-primary-button class="bg-green-400 rounded font-bold text-sm text-gray-800 hover:bg-green-500" @click="contacting = true">
                    {{ $page.props.flash && $page.props.flash.contacted ? 'Thanks' : "Let's Chat" }}
                </jet-primary-button>
            </div>
        </div>
        <div class="animate-pulse mb-3 text-gray-300 text-center text-9xl">
            <a href="#skills">&#8675;</a>
        </div>
    </Section>

    <Section id="skills" class="bg-gray-300 text-gray-800 h-screen">
        <h2 class="text-6xl font-bold">Skill</h2>
        <div class="grid grid-cols-2">
            <div v-for="skill in skills" :key="skill.id">
                <Skill :background="skill.color">
                    {{ skill.name }}
                </Skill>
            </div>
        </div>
        <div class="flex justify-center mt-10">
            <jet-primary-button class="bg-indigo-800 rounded font-bold text-sm text-gray-200 hover:bg-indigo-700" @click="contacting = true">
                {{ $page.props.flash && $page.props.flash.contacted ? 'Thanks' : "Get in touch" }}
            </jet-primary-button>
        </div>
    </Section>

    <Section class="bg-gray-600 text-gray-200 h-screen">
        <h2 class="text-6xl font-bold">Projects</h2>
        <div v-for="(project, index) in projects" :key="project.id">
            <Project :title="project.title" :description="project.description" :color="project.color">
                <!-- <component :is="myMethod(index)"></component> -->
                <component :is="myMethod(projects, index)"></component>
                <!-- <BeakerIcon></BeakerIcon> -->
            </Project>
        </div>
        <div class="flex justify-center mt-10">
            <jet-primary-button class="bg-purple-500 rounded font-bold text-sm text-gray-800 hover:bg-purple-400" @click="contacting = true">
                {{ $page.props.flash && $page.props.flash.contacted ? 'Thanks' : "Know more" }}
            </jet-primary-button>
        </div>
    </Section>

    <Section class="flex justify-between bg-gray-800 text-gray-300 test-xl">
        <p>&copy; Alan Mendoza. All rights reserved.</p>
        <div class="flex justify-evenly items-center">
            <Link class="border-b pb-1 px-2 hover:text-gray-50" href="#" target="_blank">
                GitHub
            </Link>
            <Link class="border-b pb-1 px-2 hover:text-gray-50" href="#" target="_blank">
                Facebook
            </Link>
            <Link class="border-b pb-1 px-2 hover:text-gray-50" href="#" target="_blank">
                StackOverflow
            </Link>
        </div>
    </Section>

    <!-- Modal de contacto -->
    <jet-modal :show="contacting" @close="contacting = false">
        <div v-if="$page.props.flash && $page.props.flash.contacted" class="bg-green-400 shadow-2xl p-8 text-center font-bold"> <!-- Este div se mostrara cuando el usuario haya mandado el email en sesion -->
            <p class="text-8xl m-5">👍🏻</p>
            <p class="text-5xl font-bold m-2">Thanks!</p>
            <p class="text-2xl m-2">I'll get back to you soon.</p>
        </div>
        <div class="bg-gray-50 shadow-2xl p-8" v-else> <!-- Aca se detectara el else sin no mando pues se mostrara el formulario -->
            <!-- Aquí puedes colocar el contenido del modal de contacto -->
            <h2 class="text-gray-600 text-2xl font-extrabold text-center">Let me know some details</h2>
            <form class="flex flex-col items-center p-16" @submit.prevent="submit">
                <jet-text-input class="px-5 py-3 w-96 border border-gray-600 rounded" type="email" name="email" placeholder="Your email" v-model="form.email"></jet-text-input>
                <jet-input-error :message="form.errors.email" />
                <textarea class="px-5 py-3 w-96 border border-gray-600 rounded mt-5" name="message" placeholder="The details :)" v-model="form.message"></textarea>
                <jet-input-error :message="form.errors.message" />
                <jet-primary-button class="px-5 py-3 mt-5 w-96 bg-purple-400 justify-center rounded-xl text-sm" :disabled="form.processing">
                    <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span>
                    <span v-show="!form.processing">Get in touch</span>
                </jet-primary-button>
            </form>
        </div>
    </jet-modal>

</template>
