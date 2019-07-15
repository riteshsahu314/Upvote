<template>
    <div>
        <a href="#" @click.prevent="show = true" v-if="!show">
            <slot name="link"></slot>
        </a>

       <slot name="body" v-else></slot>
    </div>
</template>

<script>
    export default {
        name: "VueShow",

        data() {
            return {
                show: false
            };
        }
    }
</script>
