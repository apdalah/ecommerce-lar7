<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = ['abbr', 'name', 'flag', 'direction', 'status'];

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
     * select column from languages tabel
     * 
     * @var string
     */
    public function scopeSelection($query)
    {
        return $query->select('id', 'abbr', 'name', 'direction', 'flag', 'status');
    }

    public function getStatus()
    {
        return $this->status == 1 ? 'مفعل' : 'معطل';
    }

}
