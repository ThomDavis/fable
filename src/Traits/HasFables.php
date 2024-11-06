<?php

namespace ThomDavis\Fable\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use ThomDavis\Fable\Models\Fable;

trait HasFables
{
    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::created(function ($model) {
            $exists = in_array(HasFables::class, class_uses_recursive($model));
            if ($exists) {
                $model->track($model, 'Created');
            }
        });

        static::updated(function ($model) {
            $exists = in_array(HasFables::class, class_uses_recursive($model));
            if ($exists) {
                $model->track($model, 'Updated');
            }
        });
    }


    /**
     * @return string[]
     */
    public function getIgnoreList(): array
    {
        return ['updated_at', 'created_at', 'id', 'uuid'];
    }


    /**
     * @param Model $model
     * @param string $action
     * @return void
     */
    protected function track(Model $model, $action = 'Created'): void
    {
        // Allow for overriding of table if it's not the model table
        $table = $model->getTable();
        // Allow for overriding of id if it's not the model id
        $id = $model->id;

        $original_data = [];
        foreach ($this->getDirty() as $field => $value) {
            $original_data[$field] = $this->getOriginal($field);
        }
        $unset_list = $this->getIgnoreList();
        $dirty = $model->getDirty();

        $new_value_collection = collect($dirty);
        $new_value_collection->forget($unset_list);

        $old_value_collection = collect($original_data);
        $old_value_collection->forget($unset_list);

        $this->fables()->create([
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'action' => $action,
            'old_value' => $action === 'Created' ? [] : $old_value_collection,
            'new_value' => $new_value_collection->all(),
        ]);
    }

    public function latestChange(): Collection
    {
        if (!$this->lastFable) {
            return collect();

        }

        $output = collect();

        $this->lastFable->old_value->each(function ($value, $key) use ($output) {
            $output->push([
                $key. '-old' => $value,
                $key. '-new' => $this->lastFable->new_value[$key],
            ]);
        });

        return $output;

    }

    public function lastFable(): MorphOne
    {
        return $this->fables()->latest()->one();
    }


    public function rollbackFable(array|string $columns = null): void
    {

        if ($columns) {
            $this->update($this->lastFable->old_value->only($columns)->toArray());
            return;
        }
        $this->update($this->lastFable->old_value->toArray());
    }


    /**
     * @return MorphMany
     */
    public function fables(): MorphMany
    {
        return $this->morphMany(
            Fable::class,
            'fable'
        );
    }
}
