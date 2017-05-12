/**
 * Jism http
 */
module.exports = {
    landlord : {},

    get(url, mutation) {
        return axios.get(Jism.scopeUrl(url))
            .then((response) => {
                return Jism.Vue.$store.commit(mutation, { data: response.data });
            }, (errors) => {
                return false;
            });
    },

    destroy(url, mutation, id) {
        return axios.delete(Jism.scopeUrl(url))
            .then((response) => {
                return Jism.Vue.$store.commit(mutation, { id : id });
            }, (errors) => {
                return false;
            });
    },

    post(url, form, mutation) {
        return Jism.request('post', url, form, mutation);
    },

    patch(url, form, mutation) {
        return Jism.request('patch', url, form, mutation);
    },

    /**
     * Foo Bar Fish Taco
     */
    request(method, url, form, mutation) {
        return axios[method](Jism.scopeUrl(url), JSON.parse(JSON.stringify(form)))
            .then((response) => {
                form.finishProcessing(response);
                return Jism.Vue.$store.commit(mutation, { item: response.data });
            }, (errors) => {
                form.errors.set(errors.response.data);
                form.busy = false;
                return form;
            });
    },

    scopeUrl(url) {
        var p = Jism.Vue.$route.params;
        url = _.replace(url, ':pod_id', Jism.landlord.pod_id);
        return url;
    }
};
