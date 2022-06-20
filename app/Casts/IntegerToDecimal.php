<?php

namespace App\Casts;

use InvalidArgumentException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class IntegerToDecimal implements CastsAttributes
{
    /**
     * The number of digits.
     *
     * @var integer
     */
    protected $digits;

    /**
     * Instantiate the cast class.
     *
     * @param integer $digits
     */
    public function __construct(int $digits = 2)
    {
        if ($digits < 1) {
            throw new InvalidArgumentException('Digit value should be greater than 0.');
        }

        $this->digits = $digits;
    }

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return $value !== null
            ? round($value / (10 ** $this->digits), $this->digits)
            : null;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return (int) ($value * (10 ** $this->digits));
    }
}
