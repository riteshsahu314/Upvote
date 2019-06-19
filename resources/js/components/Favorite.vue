<template>
    <div v-if="signedIn" class="d-flex flex-column align-items-center">
        <button @click="toggle">
            <i class="fas fa-star" v-if="active"></i>
            <i class="far fa-star" v-else></i>
        </button>

        <span>{{ count }}</span>
    </div>
</template>

<script>
    export default {
        name: "Favorite",

        props: ['question'],

        data() {
            return {
                active: this.question.isFavorited,
                count: this.question.favoritesCount
            };
        },

        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },

            create() {
                axios.post(location.pathname + '/favorites')
                    .then(() => {
                        this.active = true;

                        this.count++;
                    });
            },

            destroy() {
                axios.delete(location.pathname + '/favorites')
                    .then(() => {
                        this.active = false;

                        this.count--;
                    });
            }
        }
    }
</script>
