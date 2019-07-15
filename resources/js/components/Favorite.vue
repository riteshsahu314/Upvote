<template>
    <div v-if="signedIn" class="favorite">
        <a href="#" @click="toggle">
            <i class="fas fa-star favorite__icon" v-if="active"></i>
            <i class="far fa-star favorite__icon" v-else></i>
        </a>

        <span class="text-secondary">{{ count }}</span>
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

<style scoped lang="scss">
    .favorite {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 1rem;

        &__icon {
            color: #f99f51;
        }
    }
</style>
