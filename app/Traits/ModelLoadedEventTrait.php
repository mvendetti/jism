<?php

namespace App\Traits;

trait ModelLoadedEventTrait
{
    /**
     * Register a loaded model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function loaded($callback)
    {
        static::registerModelEvent('loaded', $callback);
    }

    /**
     * Get the observable event names.
     *
     * @return array
     */
    public function getObservableEvents()
    {
        return array_merge(parent::getObservableEvents(), ['loaded']);
    }

    /**
     * Create a new model instance that is existing.
     *
     * @param  array  $attributes
     * @param  string|null  $connection
     * @return static
     */
    public function newFromBuilder($attributes = [], $connection = null)
    {
        $instance = parent::newFromBuilder($attributes);

        $instance->fireModelEvent('loaded', false);

        return $instance;
    }
}
