<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (!empty($model->slug)) return;

            $model->slug = (string) Str::uuid();
        });

        static::created(function ($model) {
            $slug = Str::slug($model->name).'-'.base_convert($model->id, 10, 36);

            $model->slug = $slug;
            $model->saveQuietly();
        });
    }
}
