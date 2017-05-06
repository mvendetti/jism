/**
 * Jism form error collection class.
 */
window.JismFormErrors = function () {
    this.errors = {};
    this.unread = {};

    /**
     * Determine if the collection has any errors.
     */
    this.hasErrors = function () {
        return ! _.isEmpty(this.errors);
    };

    /**
     * Determine if the collection has any errors.
     */
    this.hasUnreadErrors = function () {
        return ! _.isEmpty(this.unread);
    };

    /**
     * Determine if the collection has errors for a given field.
     */
    this.has = function (field) {
        if(_.endsWith(field, '.*')) {
            var f = _.trimEnd(field, '*'),
                k =_.filter(_.keys(this.errors), (elem) => { return _.startsWith(elem, f); });
            return _.size(k) > 0;
        }
        return _.indexOf(_.keys(this.errors), field) > -1;
    };


    /**
     * Get all of the raw errors for the collection.
     */
    this.all = function () {
        return this.errors;
    };


    /**
     * Get all of the errors for the collection in a flat array.
     */
    this.flatten = function () {
        return _.flatten(_.toArray(this.errors));
    };

    /**
     * Get all of the errors for the collection in a flat array.
     */
    this.flattenUnread = function () {
        return _.flatten(_.toArray(this.unread));
    };

    /**
     * Get the first error message for a given field.
     */
    this.get = function (field) {
        if(_.endsWith(field, '.*')) {
            var that = this,
                f = _.trimEnd(field, '*'),
                k = _.filter(_.keys(this.errors), (elem) => { return _.startsWith(elem, f); }),
                r = {};
                _.each(k, (elem) => { r[elem] = that.get(elem); });
                return r;
        }

        this.markErrorRead(field);
        if (this.has(field)) {
            return this.errors[field][0];
        }
    };

    this.markErrorRead = function (field) {
        var that = this;
        _.forEach(this.unread, function(value, key) {
            if(field == key) {
                _.unset(that.unread, key);
            }
        });
    };

    /**
     * Set the raw errors for the collection.
     */
    this.set = function (errors) {
        if (typeof errors === 'object') {
            this.errors = errors;
        } else {
            this.errors = {'form': ['Something went wrong. Please try again or contact customer support.']};
        }
        this.unread = _.clone(this.errors);
    };


    /**
     * Remove errors from the collection.
     */
    this.forget = function (field) {
        if (typeof field === 'undefined') {
            this.errors = {};
        } else {
            Vue.delete(this.errors, field);
        }
    };
};
