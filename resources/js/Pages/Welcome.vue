<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <header class="bg-gray-800 pt-16 h-screen px-72">
        <div class="h-2/3 flex flex-wrap content-between border-gray-600 pb-36">
            <p class="border-b-2 font-bold border-gray-400 pb-3 text-2xl text-gray-300 uppercase">Hey! This is Alan. I'm a Software Engineer and I would like to work with you.</p>
        </div>
    </header>

    <section class="bg-gray-600 text-gray-200 px-72 py-10 h-screen">
        <h2 class="text-6xl font-bold">Skill</h2>
    </section>
    <section class="bg-gray-300 text-gray-800 px-72 py-10 h-screen">
        <h2 class="text-6xl font-bold">Projects</h2>
    </section>

    <footer class="flex justify-between py-10 px-72 bg-gray-800 text-gray-300 test-xl">
        <p>&copy; Alan Mendoza. All rights reserved.</p>
        <div class="flex justify-evenly items-center">
            GitHub
            Facebook
            StackOverflow
        </div>
    </footer>
</template>
