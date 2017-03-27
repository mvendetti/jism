/**
 * Camera collection class.
 */
window.Cameras = function (data) {
    var myClass = this;
    // var importedData = {
    //     total : data.total ? data.total : 0,
    //     from : data.from ? data.from : 0,
    // };
    // $.extend(this, importedData);

    this.cameras = [];

    this.getAll = function() {
        axios.get('/api/group/1/status')
            .then((response) => {
                myClass.cameras = response.data;
            }, (error) => {
                console.log(error.response.data);
            });
    }
};
