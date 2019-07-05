<template>
    <div>
        <div v-for="(answer, index) in items" :key="answer.id" class="border-bottom">
            <answer :answer="answer" @deletedAnswer="remove(index)"></answer>
        </div>

        <paginator :data="pageData" @pageChanged="fetch"></paginator>

        <new-answer @createdAnswer="add"></new-answer>
    </div>
</template>

<script>
    import Answer from './Answer';
    import NewAnswer from './NewAnswer';
    import collection from '../mixins/Collection';

    export default {
        name: "Answers",

        components: {Answer, NewAnswer},

        mixins: [collection],

        data() {
            return {
                pageData: false
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            // fetch answers
            fetch(page = null) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },

            // refresh data
            refresh({data}) {
                this.pageData = data;

                this.items = this.pageData.data;

                // push the best answer to the top in list
                this.items.forEach(function (answer, index, answers) {
                    if (answer.isBest) {
                        answers.splice(index, 1);
                        answers.unshift(answer);
                    }
                });
            },

            url(page) {
                if (! page) {
                    // location.search will return everything after and including '?' in url
                    let query = location.search.match(/page=(\d+)/);    // query[1] contains the page number

                    // if the url contains a page number assign it to the page
                    // else assign a default value as 1
                    page = query ? query[1] : 1;
                }

                return `${location.pathname}/answers?page=${page}`;
            }
        }
    }
</script>
