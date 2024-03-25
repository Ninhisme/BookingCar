<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function newsCategory()
    {
        return $this->belongsTo('App\Models\NewsCategory', 'id_news_category','id');
    }
}