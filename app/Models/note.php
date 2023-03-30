<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class note extends Model
{
    use HasFactory;
    protected $fillable = [
        'fillable'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'etudiant_id', 'cne');
    }
}
