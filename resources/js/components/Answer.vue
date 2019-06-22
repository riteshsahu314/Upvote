<template>
    <div class="row justify-content-center">
        <div class="col-1 d-flex flex-column justify-content-start align-items-center" style="font-size: 1.5rem;">
            <div>
                <form :action="`/answers/${id}/UpVote`" method="post">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <button class="btn btn-link"><i class="fas fa-caret-up fa-3x"></i></button>
                </form>
            </div>
            <div>
                <span>{{ answer.score }}</span>
            </div>
            <div>
                <form :action="`/answers/${id}/DownVote`" method="post">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <button class="btn btn-link"><i class="fas fa-caret-down fa-3x"></i></button>
                </form>
            </div>
        </div>

        <div class="col-11">
            <div :id="'answer-' + id" class="card mb-3">
                <div class="card-header" :class="isBest ? 'best' : ''">
                    <h5>
                        <a :href="'/' + answer.owner.name">
                            <img :src="answer.owner.avatar_path" alt="User Avatar"
                                 width="25" height="25" class="rounded-circle mr-1">
                            {{ answer.owner.name }}
                        </a>
                        answered {{ ago }}
                    </h5>
                </div>
                <div class="card-body">
                    <div v-if="editing">
                        <form @submit.prevent="update">
                            <div class="form-group">
                                <textarea v-model="body" class="form-control"></textarea>
                            </div>

                            <button class="btn btn-primary btn-sm">Update</button>
                            <button class="btn btn-link btn-sm" @click.prevent="cancel">Cancel</button>
                        </form>
                    </div>

                    <div v-else v-text="body"></div>
                </div>

                <div class="card-footer d-flex justify-content-between"
                     v-if="authorize('owns', answer) || authorize('owns', answer.question)">
                    <div v-if="authorize('owns', answer)">
                        <button class="btn btn-secondary btn-sm mr-2" @click="editing = true">Edit</button>
                        <button type="submit" class="btn btn-danger btn-sm" @click="destroy">Delete</button>
                    </div>
                    <button class="btn btn-primary btn-sm" @click="markBestAnswer" v-if="authorize('owns', answer.question) && !isBest">
                        Best Answer
                    </button>
                </div>

                <div v-if="comments.length">
                    <ul class="list-group" v-for="comment in comments">
                        <li class="list-group-item">
                            {{ comment.body }} - <a :href="'/' + comment.owner.name">{{ comment.owner.name }}</a>
                        </li>
                    </ul>

                    <form :action="'/answers/' + id + '/comments'" method="post" v-if="signedIn">
                        <!-- Form Input for Comment body-->
                        <div class="d-flex">
                            <input type="hidden" name="_token" :value="csrfToken">
                            <textarea class="form-control" style="min-height: 53px;" name="body" rows="1"
                                      placeholder="add a comment..."></textarea>

                            <button type="submit" class="btn btn-primary align-self-start m-2">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: "Answer",

        props: ['answer'],

        data() {
            return {
                id: this.answer.id,
                body: this.answer.body,
                editing: false,
                isBest: this.answer.isBest,
                comments: this.answer.comments
            }
        },

        created() {
            // listen for an event
            window.events.$on('bestAnswerSelected', id => {
                this.isBest = (id === this.id);
            });
        },

        computed: {
            ago() {
                return moment.utc(this.answer.created_at).fromNow() + '...';
            }
        },

        methods: {
            // delete the answer
            destroy() {
                axios.delete('/answers/' + this.id)
                    .then(() => {
                        // fire deletedAnswer event so that
                        // the answer is also removed from the DOM
                        this.$emit('deletedAnswer');
                    })
            },

            // update the answer
            update() {
                axios.patch('/answers/' + this.id, {body: this.body})
                    .then(() => {
                        flash('Answer successfully updated!');
                    })
                    .catch(error => {
                        flash(error.response.data.message, 'danger');

                        this.body = this.answer.body;
                    });

                this.editing = false;
            },

            // cancel the editing of answer
            cancel() {
                this.editing = false;

                this.body = this.answer.body;
            },

            // Mark the answer as Best
            markBestAnswer() {
                axios.post('/answers/' + this.id + '/best')
                    .then(() => {
                        flash('Answer is marked as Best.');

                        window.events.$emit('bestAnswerSelected', this.id);
                    });
            }
        }
    }
</script>

<style scoped>
    .best {
        background-color: #b0ffaf;
    }
</style>
