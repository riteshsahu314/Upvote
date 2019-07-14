<template>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link" @click="loadNotifications" data-toggle="dropdown">
            <i class="fas fa-bell notification-icon"></i>
        </a>

        <div id="notifications" class="dropdown-menu dropdown-menu-right shadow border" aria-labelledby="navbarDropdown">
            <div v-if="notifications.length">
                <a v-for="(notification, index) in notifications"
                   v-text="notification.data.message"
                   class="dropdown-item"
                   :href="notification.data.link"
                   @click="markAsRead(index, notification)"
                >
                </a>
            </div>

            <div v-else class="d-flex justify-content-center">
                <div v-if="notifications === false" class="spinner-border spinner-border-sm text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>

                <div v-else>
                    <span>No Notifications</span>
                </div>
            </div>
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

        methods: {
            loadNotifications() {
                if (! this.notifications) {
                    axios.get(`/${window.App.user.name}/notifications`)
                        .then(response => {
                            this.notifications = response.data;
                        });
                }
            },

            markAsRead(index, notification) {
                console.log(index, notification);
                axios.delete(`/${window.App.user.name}/notifications/${notification.id}`)
                    .then(() => {
                        this.notifications.splice(index, 1);
                    });
            }
        }
    }
</script>

<style scoped>
     .notification-icon {
         color: white;
         padding: 0.3rem;
         font-size: 1.3rem;
     }

    #notifications {
        width: 430px;
    }
</style>
