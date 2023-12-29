<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price'
        'number_of_courses',
        'comission_percentage',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
