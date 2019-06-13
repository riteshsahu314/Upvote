<template>
    <div>
        <div v-if="signedIn">
            <!--  Form Input -->
            <div class="form-group">
                <textarea class="form-control"
                          name="body"
                          rows="5"
                          placeholder="Have something to say ?"
                          v-model="body"
                >
                </textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" @click="addAnswer">Post</button>
        </div>

        <p class="text-center" v-else>
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
