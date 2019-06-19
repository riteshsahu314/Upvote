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
                form: {},
                editing: false
            };
        },

        created() {
            this.resetForm();
        },

        methods: {
            update() {
                axios.patch(`/questions/${this.question.id}`, this.form)
                    .then(() => {
                        this.editing = false;

                        this.title = this.form.title;
                        this.body = this.form.body;

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
                    body: this.body
                };

                this.editing = false;
            }
        }
    }
</script>
