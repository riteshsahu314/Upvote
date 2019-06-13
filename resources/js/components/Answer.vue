<template>
    <div class="card mb-3">
        <div class="card-header">
            <h5>{{ answer.owner.name }} answered {{ ago }}</h5>
        </div>
        <div class="card-body">
            <p>
                {{ answer.body }}
            </p>
        </div>

        <div class="card-footer">
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
                id: this.answer.id
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
            }
        }
    }
</script>
