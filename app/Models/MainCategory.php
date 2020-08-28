<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'main_categories';

    protected $fillable = ['translation_lang', 'translation_of', 'name', 'tags', 'image', 'active'];

    /**
     * select query in case it is active
     * 
     * @var string
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * select query in case it is active
     * 
     * @var string
     */
    public function scopeWithDefaultLang($query, $default_lang)
    {
        return $query->where('translation_lang', $default_lang);
    }

    /**
     * select column from languages tabel
     * 
     * @var string
     */
    public function scopeSelection($query)
    {
        return $query->select('id', 'translation_lang', 'name', 'tags', 'image', 'status');
    }

    /**
     * get status as litters not as 0, 1
     */
    public function getStatus()
    {
        return $this->status == 1 ? 'مفعل' : 'معطل';
    }

    public function getImageAttribute($value)
    {
        if($value)
        {
            return asset('assets/Images/' . $value);
        }
    }

}
