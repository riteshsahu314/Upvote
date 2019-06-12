<template>
    <div>
        <div v-for="answer in answers">
            <answer :answer="answer"></answer>
        </div>
    </div>
</template>

<script>
    import Answer from './Answer.vue';

    export default {
        name: "Answers",

        components: { Answer },

        props: ['answers'],

        data() {
            return {

            }
        }
    }
</script>
