/**
 * Jism helper class. Used to set common properties on all forms.
 */
window.JismForm = function (data) {
    var form = this;

    $.extend(this, data);

    /**
     * Create the form error helper instance.
     */
    this.errors = new JismFormErrors();

    this.busy = false;
    this.successful = false;
    this.response = {};

    this.getOriginalData = function() {
        return data;
    }

    /**
     * Start processing the form.
     */
    this.startProcessing = function () {
        form.errors.forget();
        form.busy = true;
        form.successful = false;
        this.response = {}
    };

    /**
     * Finish processing the form.
     */
    this.finishProcessing = function (response) {
        form.busy = false;
        form.successful = true;
        this.response = response;
    };

    /**
     * Reset the errors and other state for the form.
     */
    this.resetStatus = function () {
        form.errors.forget();
        form.busy = false;
        form.successful = false;
        this.response = {};
    };


    /**
     * Set the errors on the form.
     */
    this.setErrors = function (errors) {
        form.busy = false;
        form.errors.set(errors);
        this.response = {};
    };
};
