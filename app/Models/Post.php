<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Config\sluggable;

class Post extends Model
{
    use HasFactory;

    // use sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
