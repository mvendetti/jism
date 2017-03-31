/**
 * Camera collection class.
 */
window.Pods = function (data) {
    var myClass = this;

    this.pods = [];

    this.getAll = function() {
        axios.get('/api/pod')
            .then((response) => {
                myClass.pods = response.data;
            }, (error) => {
                console.log(error.response.data);
            });
    }
};
