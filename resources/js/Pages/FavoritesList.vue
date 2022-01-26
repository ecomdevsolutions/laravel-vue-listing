<template>
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 img-group">            
            <FavoriteItem v-for="moreIndex in moreEstates" :key="moreIndex" class="p-6"
                :imageOne="images[moreIndex]" 
                :moreIndex="moreIndex"
                :setState="setState"
            />
        </div>
        <jet-button v-if="moreEstates < images.length-1" @click="loadMore" class="load-more">
            Load More
        </jet-button>
    </div>
</template>

<style scoped>
    .img-group .p-6 {
        border: 1px solid;
        margin: 10px;
    }
    .load-more {
        text-align: center;
        display: block;
        margin: 10px auto 20px auto;
    }
</style>


<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import FavoriteItem from './FavoriteItem.vue'

    export default defineComponent({
        components: {
            JetButton,
            FavoriteItem
        },
        
        props: {
            regedImages: {
                default: {}
            }
        },

        data() {
            return {
                images: [],
                moreEstates: 0
            }
        },

        mounted() {
            console.log(this.regedImages);
            axios.get('https://jsonplaceholder.typicode.com/photos')
            .then(({data}) => {
                console.log(data);
                for(let i = 0; i < data.length; i++) {
                    let isRegState = false;
                    for(let regedImg of this.regedImages) {
                        if(data[i].id == regedImg.artid) {
                            isRegState = true;
                        }
                    }
                    data[i].isRegState = isRegState;
                }
                this.images = data;
                this.moreEstates = 10;
            })
            .catch(e => {
                console.log('Network Error!')
            });
        },

        methods: {
            loadMore(){
                if(this.moreEstates + 10 > this.images.length) {
                    this.moreEstates = this.images.length - 1;
                } else {
                    this.moreEstates += 10;
                }
            },
            setState(index, state = false){
                console.log(index);
                this.images[index].isRegState = state;
            }
        }

    })
</script>
