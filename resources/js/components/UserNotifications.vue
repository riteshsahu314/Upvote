<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a href="#" class="nav-link" data-toggle="dropdown">
            <i class="fas fa-bell"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a v-for="notification in notifications"
               v-text="notification.data.message"
               class="dropdown-item"
               :href="notification.data.link"
               @click="markAsRead(notification)"
            >
            </a>
        </div>

    </li>
</template>

<script>
    export default {
        name: "UserNotifications",

        data() {
            return {
                notifications: false
            };
        },

        created() {
            axios.get(`/${window.App.user.name}/notifications`)
                .then(response => {
                    this.notifications = response.data;
                });
        },

        methods: {
            markAsRead(notification) {
                axios.delete(`/${window.App.user.name}/notifications/${notification.id}`);
            }
        }
    }
</script>

<style scoped>

</style>
