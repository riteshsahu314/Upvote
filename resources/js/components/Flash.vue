<template>
    <div class="alert alert-flash"
         :class="'alert-' + level"
         role="alert"
         v-show="show"
         v-text="body"
    >
    </div>
</template>

<script>
    export default {
        name: "Flash",

        props: ['data'],

        data() {
            return {
                body: '',
                level: 'success',
                show: false
            };
        },

        created() {
            // if we have data flash the message
            if (this.data) {
                this.flash(this.data);
            }

            // when 'flash' event occurs call flash() method on this vue component
            window.events.$on('flash', data => {
                this.flash(data);
            });
        },

        methods: {
            flash(data) {
                this.body = data.message;
                if (data.type) {
                    this.level = data.type;
                }

                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style scoped>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
