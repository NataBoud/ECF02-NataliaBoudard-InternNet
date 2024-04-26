<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find($id)
 * @method static orderBy(string $string, string $string1)
 * @method static findOrFail($id)
 * @method static where(string $string, int|string|null $id)
 */
class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'typeContract',
        'start',
        'end',
        'email',
        'description',
        'company_id',
        'user_id'
    ];

    public static function create(array $opportunityData)
    {
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
