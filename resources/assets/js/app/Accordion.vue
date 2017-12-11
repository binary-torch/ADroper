<template>
    <div class="card accordion margin-top-20">
        <div class="content" @click="toggle">
            <img :src="image">
            <div>
                <h3 class="title">
                    <slot name="title"></slot>
                </h3>
                <p class="grey-text-color">
                    <slot name="description"></slot>
                </p>
            </div>
            <i class="material-icons grey-text-color" v-if="hidden">add</i>
            <i class="material-icons grey-text-color" v-if="! hidden">remove</i>
        </div>
        <div class="card-body" :class="{'hidden' : hidden}">
            <slot name="content"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['image'],
        data(){
            return {
                hidden: true
            }
        },
        methods: {
            toggle(){
                this.hidden = ! this.hidden;
            }
        }
    }
</script>