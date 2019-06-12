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
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: "Answer",

        props: ['answer'],

        data() {
            return {

            }
        },

        computed: {
            ago() {
                return moment(this.answer.created_at).fromNow() + '...';
            }
        }
    }
</script>
