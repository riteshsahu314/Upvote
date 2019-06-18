<template>
    <div class="card mb-3">
        <div class="card-header">
            <h5><a :href="'/' + answer.owner.name">{{ answer.owner.name }}</a> answered {{ ago }}</h5>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <textarea v-model="body" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary btn-sm">Update</button>
                    <button class="btn btn-link btn-sm" @click="cancel">Cancel</button>
                </form>
            </div>

            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer" v-if="authorize('owns', answer)">
            <button class="btn btn-secondary btn-sm mr-2" @click="editing = true">Edit</button>
            <button type="submit" class="btn btn-danger btn-sm" @click="destroy">Delete</button>
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
                editing: false
            }
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
                axios.patch('/answers/' + this.id, { body: this.body })
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
            }
        }
    }
</script>
