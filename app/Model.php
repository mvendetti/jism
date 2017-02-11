<?php

namespace App;


use Illuminate\Support\Arr;

use App\Traits\EnforceMacFormatTrait;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * The secondary key for the model.
     *
     * @var string
     */
    // protected $secondaryKey = 'foo';

    public function getKeyName()
    {
        if($this->isCalledByRelationFunction())
        {
            if(property_exists($this, 'secondaryKey'))
            {
                return $this->secondaryKey;
            }
        }

        return $this->primaryKey;
    }

    /**
     * Get the relationship name of the belongs to many.
     *
     * @return string|null
     */
    protected function isCalledByRelationFunction()
    {
        $methods = ['performJoin', 'touch', 'allRelatedIds'];

        $caller = Arr::first(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS), function ($trace) use ($methods) {
            return in_array($trace['function'], $methods)
                && (isset($trace['class']) && strpos($trace['class'], 'Eloquent\Relations') >= 0);
        });

        return ! is_null($caller) ? $caller['function'] : null;
    }
}
