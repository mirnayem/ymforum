<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable =['title','slug','body','category_id' , 'user_id'];

    protected $with = ['replies'];



    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply')->latest();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function like()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function getPathAttribute()
    {
        return "question/$this->slug";
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function($question){
           $question->slug = Str::slug($question->title);
        });
    }

    
}
