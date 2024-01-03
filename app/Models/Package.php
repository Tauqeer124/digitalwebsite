<?php

namespace App\Models;

use App\Models\Tree;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'number_of_courses',
        'commission_percentage',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trees()
    {
        return $this->hasMany(Tree::class);
    }
}
