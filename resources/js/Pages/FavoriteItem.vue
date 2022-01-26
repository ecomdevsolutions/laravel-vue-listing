<template>
    <div class="items-center">
        <img class="h-10 w-10 rounded-full" v-bind:src="imageOne.thumbnailUrl" alt="">
        <div class="text-lg leading-7 font-semibold">{{ imageOne.title }}</div>
        <div class="text-lg leading-7 font-semibold">{{ imageOne.url }}</div>
        <template v-if="!imageOne.isRegState">
            <jet-button @click="addFavorite(imageOne, moreIndex)" class="add-favorite">
                Add to favorites
            </jet-button>
        </template>
        <template v-else>
            <jet-button @click="removeFavorite(imageOne.id, moreIndex)" class="remove-favorite">
                Remove from favorites
            </jet-button>
        </template>
    </div>
</template>

<style scoped>
    .add-favorite {
        background-color: #008CBA;
    }
    .remove-favorite {
        background-color: #f44336;
    }
</style>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'

    export default defineComponent({
        components: {
            JetButton
        },

        props: {
            imageOne: {
                default: {}
            },
            moreIndex: {
                default: 0
            },
            setState: {
                default: null
            }
        },

        methods: {
            addFavorite(image, index){
                axios.post('addfavorite', {
                    id: image.id,
                    title: image.title,
                    url: image.url,
                    thumbnailUrl: image.thumbnailUrl,
                })
                .then(({data}) => {
                    this.setState(index, true);
                })
                .catch(e => {
                    console.log('addfavorite failure!')
                })
            },

            removeFavorite(id, index){
                axios.post('removefavorite', {id: id})
                .then(({data}) => {
                    this.setState(index);
                })
                .catch(e => {
                    console.log('removefavorite failure!')
                })
            }
        },
    })
</script>
