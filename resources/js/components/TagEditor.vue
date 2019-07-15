<template>
    <div>
        <select name="tagsIds[]" id="tags" multiple></select>
    </div>
</template>

<style lang="scss">
    @import '~selectize/dist/css/selectize.css';

    .selectize-control.multi .selectize-input > div {
        background: #E1ECF4;
        color: #2176bd;
    }

    .selectize-control.multi .selectize-input > div.active {
        color: #1286e6;
        background-color: #b2cde0;
    }
</style>

<script>
    import Selectize from 'selectize';

    export default {
        name: "TagEditor",

        props: ['tags'],

        data() {
            return {
                settings: {
                    plugins: ['restore_on_backspace', 'remove_button'],
                    persist: false,
                    openOnFocus: false,
                    closeAfterSelect: true,
                    valueField: 'id',
                    labelField: 'name',
                    searchField: 'name',
                    placeholder: 'e.g. (php laravel javascript)',
                    loadThrottle: 300,
                    maxOptions: 6,
                    create(input) {     // ES6 syntax
                        return {
                            value: input,
                            text: input
                        }
                    },

                    render: {
                        // define how each option should be display in suggestions
                        option(tag, escape) {
                            let name = escape(tag.name);
                            let description = escape(tag.description.substr(0, 500));

                            return `
                                <div class="m-1 p-2 border border-primary">
                                    <div class="h6">${name}</div>
                                    <div class="text-muted">${description}...</div>
                                </div>
                            `;
                        }
                    },

                    // fetch tags
                    load(query, callback) {
                        if (!query.length) return callback();
                        axios.get(`/tags?q=${query}`)
                            .then(({data}) => {
                                callback(data);
                            })
                    }
                }
            };
        },

        mounted() {
            if (this.tags) {
                this.addInitialTags(this.tags);
            }

            // initialize the Selectize control
            let $select = $('#tags').selectize({
                onItemAdd: value => {
                    this.$emit('tag-added', value);
                },
                onItemRemove: value => {
                    this.$emit('tag-removed', value);
                },
                ...this.settings
            });

            let selectize = $select[0].selectize;

            window.temp = selectize;

        },

        methods: {
            // add any initial tags
            addInitialTags(tags) {
                this.settings.options = tags;
                this.settings.items = tags.map(tag => tag.id);
            }
        }
    }
</script>
