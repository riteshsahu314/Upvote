<script>
    import Answers from '../components/Answers.vue';
    import Favorite from '../components/Favorite.vue';

    export default {
        components: { Answers, Favorite },

        props: ['question'],

        data() {
            return {
                title: this.question.title,
                body: this.question.body,
                tags: this.question.tags,
                tagsIds: this.question.tags.map(tag => tag.id),
                form: {},
                editing: false
            };
        },

        created() {
            this.resetForm();
        },

        methods: {
            update() {
                axios.patch(`/questions/${this.question.slug}`, this.form)
                    .then(({data}) => {
                        // update title, body and tags of question
                        this.title = data.title;
                        this.body = data.body;
                        this.tags = data.tags;
                        this.tagsIds = this.tags.map(tag => tag.id);

                        // question is updated
                        // get out of editing
                        this.editing = false;

                        flash('Your question has been updated');
                    })
                    .catch(error => {
                        this.editing = false;

                        flash(error.response.data.message, 'danger');
                    });
            },

            resetForm() {
                this.form = {
                    title: this.title,
                    body: this.body,
                    tagsIds: this.tagsIds.slice()   // copy array instead of reference
                };

                this.editing = false;
            },

            // Add tag to form
            addTag(id) {
                this.form.tagsIds.push(parseInt(id));
            },

            // Remove tag from form
            removeTag(id) {
                let index = this.form.tagsIds.indexOf(parseInt(id));
                console.log(index);
                if (index >= 0) {
                    this.form.tagsIds.splice(index, 1);
                }
            }
        }
    }
</script>
