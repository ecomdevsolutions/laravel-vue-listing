
<template>
    <app-layout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Image List
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <FavoritesList :regedImages="regedImages" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import FavoritesList from './FavoritesList'

    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            FavoritesList
        },
        
        props: ['regedImages']
    })
</script>
