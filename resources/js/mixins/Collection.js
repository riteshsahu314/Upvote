export default {
    data() {
        return {
            items: []
        }
    },

    methods: {
        // add an item into collection
        add(item) {
            this.items.push(item);
        },

        // remove an item from collection
        remove(index) {
            this.items.splice(index, 1);    // splice 1 item from the index
        }
    }
}
