let user = window.App.user;

module.exports = {
    owns(model, prop = 'user_id') {
        if (this.isAdmin()) return true;

        return model[prop] === user.id;
    },

    isAdmin() {
        return user.isAdmin;
    }
};
