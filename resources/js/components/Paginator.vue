<template>
    <ul class="pagination" v-if="shouldPaginate">
        <li class="page-item" v-show="prevUrl">
            <a class="page-link" href="#" aria-label="Previous" rel="previous" @click.prevent="page--">
                <span aria-hidden="true">&laquo; Previous</span>
            </a>
        </li>
        <li class="page-item" v-show="nextUrl">
            <a class="page-link" href="#" aria-label="Next" rel="next" @click.prevent="page++">
                <span aria-hidden="true">Next &raquo;</span>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "Paginator",

        props: ['data'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            }
        },

        computed: {
            shouldPaginate() {
                // paginate only if we have a prevUrl or nextUrl
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        watch: {
            // keep an eye on data prop
            // whenever it changes update data
            data() {
                this.page = this.data.current_page;
                this.prevUrl = this.data.prev_page_url;
                this.nextUrl = this.data.next_page_url;
            },

            // keep an eye on page property
            // whenever it changes
            // fire an event up the change
            page() {
                // fire pageChanged event
                this.$emit('pageChanged', this.page);

                // change page URL
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>

<style scoped>

</style>
