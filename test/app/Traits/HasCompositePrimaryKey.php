<?php

namespace App\Traits; // *** Adjust this to match your model namespace! ***

use Illuminate\Database\Eloquent\Builder;

trait HasCompositePrimaryKey
{
    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->getKeyName() as $key) {
            // UPDATE: Added isset() per devflow's comment.
            if (isset($this->$key))
                $query->where($key, '=', $this->$key);
            else
                throw new Exception(__METHOD__ . 'Missing part of the primary key: ' . $key);
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
    
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }
    
        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }
    
        return $this->getAttribute($keyName);
    }

    // UPDATE: From jessedp. See his edit, below.
    /**
     * Execute a query for a single record by ID.
     *
     * @param  array  $ids Array of keys, like [column => value].
     * @param  array  $columns
     * @return mixed|static
     */
    protected static function find($id, $columns = ['*'])
    {
        $me = new self;
        $query = $me->newQuery();
        $i = 0;

        foreach ($me->getKeyName() as $key) {
            $query->where($key, '=', $id[$i]);
            $i++;
        }

        return $query->first($columns);
    }
}