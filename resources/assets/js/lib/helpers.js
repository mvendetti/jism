/**
 * Jism helpers
 */
module.exports = {
    massMergeModels(models, newModels) {
        var data = _.cloneDeep(models);
        data = _.filter(data, function(elem) {
            return !_.find(newModels, { id: elem.id });
        });
        data = data.concat(newModels);
        return data;
    },
    removeModel(models, id) {
        return _.filter(models, function(elem) {
            return elem.id != id; // !_.find(newModels, { id: elem.id });
        });
    }
};
