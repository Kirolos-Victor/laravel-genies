<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'name',
        'description',
        'status',
    ];
    public $timestamps = true;

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class);
    }
}
