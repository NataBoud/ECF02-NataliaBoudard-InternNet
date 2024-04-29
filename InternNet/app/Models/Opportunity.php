<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

/**
 * @method static find($id)
 * @method static orderBy(string $string, string $string1)
 * @method static findOrFail($id)
 * @method static where(string $string, int|string|null $id)
 */
class Opportunity extends Model
{
    use HasFactory;
    use Searchable;

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

    /**
     * @return array{id: int, title: mixed, typeContract: mixed}
     */
    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'typeContract' => $this->typeContract,
            'description' => $this->description,
        ];
    }

//    public static function create(array $opportunityData)
//    {
//        return parent::create($opportunityData);
//    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
