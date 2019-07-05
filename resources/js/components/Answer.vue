<template>
    <div class="row justify-content-center py-4">
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
            <a href="#" @click="markBestAnswer" v-if="authorize('owns', answer.question)">
                <i class="fas fa-check best-answer-icon" :class="isBest ? 'text-success' : ''"></i>
            </a>
        </div>

        <div class="col-11">
            <div :id="'answer-' + id" class="mb-3">
                <div v-if="editing">
                    <form @submit.prevent="update">
                        <div class="form-group">
                            <wysiwyg v-model="body"></wysiwyg>
                        </div>

                        <button class="btn btn-primary btn-sm">Update</button>
                        <button class="btn btn-link btn-sm" @click.prevent="cancel">Cancel</button>
                    </form>
                </div>

                <div v-else>
                    <div v-html="body"></div>

                    <div class="mt-4 mb-2 d-flex justify-content-between">
                        <div v-if="authorize('owns', answer) || authorize('owns', answer.question)">
                            <div v-if="authorize('owns', answer)">
                                <a href="#" class="btn btn-link btn-sm px-0 mr-2" @click.prevent="editing = true">
                                    Edit
                                </a>

                                <a href="#" class="btn btn-link btn-sm px-0" @click.prevent="destroy">
                                    Delete
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="small text-secondary text-left ml-1">Answered {{ ago }}</div>
                            <div class="user-box">
                                <a :href="'/users/' + answer.owner.name">
                                    <img class="user-avatar" :src="answer.owner.avatar_path" alt="User Avatar"
                                         width="25" height="25">
                                    <span class="user-name">{{ answer.owner.name }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div v-if="comments.length">
                        <ul class="comments">
                            <li v-for="comment in comments" class="comment" :id="`comment-${comment.id}`">
                                {{ comment.body }} - <a :href="'/users/' + comment.owner.name">{{ comment.owner.name }}</a>
                            </li>
                        </ul>
                    </div>
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

<style scoped lang="scss">
    .best-answer-icon {
        color: #a0a0a0;

        &:hover {
            color: #28a745;
        }
    }
</style>
