<?php

namespace App\Models;

use App\Enum\BlogPostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    // Scopes
    public function scopeActive($query): void{
        $query->whereStatus(BlogPostStatus::PUBLISHED);
    }


    function category(){
        return $this->belongsTo(Category::class);
    }

    function tags(){
        return $this->belongsToMany(Tag::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    function getFeaturedImageUrlAttribute(): string{
        return str($this->featured_image)->isUrl() ? $this->featured_image : asset('storage/'.$this->featured_image);
    }
}
