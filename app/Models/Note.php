<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static where(string $string, string $string1, $id)
 */
class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'input_update'
    ];
}
