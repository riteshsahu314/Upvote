<template>
    <div>
        <div v-if="signedIn">
            <h3 class="font-weight-normal pt-3 mb-3">Your Answer</h3>

            <!--  Form Input -->
            <div class="form-group">
                <wysiwyg name="body" v-model="body"  placeholder="Write your answer here."></wysiwyg>
            </div>
            
            <button type="submit" class="btn btn-primary" @click="addAnswer">Post</button>
        </div>

        <p class="text-center mt-3" v-else>
            Please <a href="/login">sign in</a> to post answer.
        </p>
    </div>
</template>

<script>
    export default {
        name: "NewAnswer.vue",

        data() {
            return {
                body: ''
            }
        },

        methods: {
            addAnswer() {
                axios.post(location.pathname + '/answers', {body: this.body})
                    .catch(error => {
                        flash(error.response.data.message, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';

                        this.$emit('createdAnswer', data);
                    });
            }
        }
    }
</script>
