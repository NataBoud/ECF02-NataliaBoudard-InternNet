<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find($id)
 */
class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'typeContract', 'company', 'start', 'end', 'description', 'user_id'];

    public static function create(array $opportunityData)
    {
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
