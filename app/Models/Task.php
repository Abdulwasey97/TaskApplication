<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status'];
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
