<?php

namespace App\Support\Eloquents;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::creating(function($model) {
            $model->setSlug();
        });

        static::updating(function($model) {
            $model->setSlug();
        });
    }

    public function setSlug($value = null)
    {
        if(is_null($value)) {
            $value = $this->getAttribute($this->slugAttribute);
        }

        $this->attributes['slug'] = $this->generateSlug($value);
    }

    private function generateSlug($value)
    {
        $slug = Str::slug($value) ?: slugify($value);

        $query = $this->where('slug', $slug);

        if($query->exists()) {
            $slug .= '-' . Str::random(5);
        }

        return $slug;
    }
}
