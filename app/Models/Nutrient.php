<?php

namespace App\Models;

use App\Casts\IntegerToDecimal;
use App\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nutrient extends Model
{
    use HasFactory, UsesUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'unit',
        'value'
    ];

    /**
     * The attributes that should be type casted.
     *
     * @var array
     */
    protected $casts = [
        'value' => IntegerToDecimal::class,
    ];

    /**
     * Relationship Declarations
     */

    /**
     * Get the food that this nutrient record belongs to.
     *
     * @return BelongsTo
     */
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
