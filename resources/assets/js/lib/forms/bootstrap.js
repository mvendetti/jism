/**
 * Load the form helpers
 */
require('./form');
require('./errors');

/**
 * Add additional HTTP / form helpers to the Jism object.
 */
$.extend(Jism, require('./http'));
