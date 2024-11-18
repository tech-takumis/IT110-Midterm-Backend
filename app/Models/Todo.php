<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id','completed'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
