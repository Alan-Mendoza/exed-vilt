<script setup>
import { Head, Link } from '@inertiajs/vue3';
import JetApplicationMark from '@/Components/ApplicationMark.vue';
import Section from '@/Personal-Components/Section.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
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
        </div>
    </Section>

    <Section class="bg-gray-600 text-gray-200 h-screen">
        <h2 class="text-6xl font-bold">Skill</h2>
    </Section>
    <Section class="bg-gray-300 text-gray-800 h-screen">
        <h2 class="text-6xl font-bold">Projects</h2>
    </Section>

    <Section class="flex justify-between bg-gray-800 text-gray-300 test-xl">
        <p>&copy; Alan Mendoza. All rights reserved.</p>
        <div class="flex justify-evenly items-center">
            GitHub
            Facebook
            StackOverflow
        </div>
    </Section>
</template>
