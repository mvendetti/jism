/**
 * Jism helpers
 */
module.exports = {
    massMergeModels(o, n, idColumn) {
        // var data = models; //_.cloneDeep(models);
        if(typeof idColumn === 'undefined') {
            idColumn = 'id';
        }

        var oldIds = _.values(_.mapValues(o, idColumn)),
            newIds = _.values(_.mapValues(n, idColumn)),
            changedIds = _.intersection(oldIds, newIds),
            removedIds = _.difference(oldIds, newIds),
            addedIds = _.difference(newIds, oldIds);

        // Add any new elements that did not exist in the old data
        var newElems = _.filter(n, (elem) => {
            return _.findIndex(addedIds, (o) => { return o == elem[idColumn] }) >= 0;
        })

        if(_.size(newElems) > 0) {
            o = _.concat(o, newElems);
        }

        // Remove any elements that are not in the new data
        _.each(removedIds, (elem) => {
            _.each(o, (oe, idx) => {
                if(oe[idColumn] == elem) {
                    _.unset(o, idx);
                }
            });
            o = _.pickBy(o, _.identity);
        });

        _.each(changedIds, (cid) => {
            var ne = _.find(n, (elem) => {
                return elem[idColumn] == cid;
            })
            _.each(o, (oe, idx) => {
                if(oe[idColumn] == cid) {

                    if(typeof o[idx].ssid !== 'undefined')
                    {
                        o[idx].ssid = ne.ssid;
                    }

                }
            });

        });

        return o;
    },
    removeModel(models, id) {
        return _.filter(models, function(elem) {
            return elem.id != id; // !_.find(newModels, { id: elem.id });
        });
    }
};
