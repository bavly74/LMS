<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $guarded = [];

    // children (subcategories)
    public function subCategories()
    {
        return $this->hasMany(CourseCategory::class, 'parent_id');
    }

    // parent
    public function parent()
    {
        return $this->belongsTo(CourseCategory::class, 'parent_id');
    }

    public static function getSubCategories($id)
    {
        return static::where('parent_id', $id)->get();
    }
}
