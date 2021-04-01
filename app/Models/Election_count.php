<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election_count extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'election_count';

    protected $fillable = [
        'user_id',
        'created_at',
        'updated_at',
        'subject_id',
        'choice',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
}
