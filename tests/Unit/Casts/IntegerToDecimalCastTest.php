<?php

namespace Tests\Unit\Casts;

use Tests\TestCase;
use App\Casts\IntegerToDecimal;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class IntegerToDecimalCastTest extends TestCase
{
    /**
     * Fake model instance for testing.
     *
     * @var EloquentModel
     */
    protected $fake_model;

    /**
     * Initialize the environment for this test.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->fake_model = new class extends EloquentModel {
            protected $fillable = ['test', 'test_triple'];

            protected $casts = [
                'test' => IntegerToDecimal::class,
                'test_triple' => IntegerToDecimal::class . ':3',
            ];

            /**
             * Get the raw attribute value for testing purposes.
             *
             * @param  string $key The attribute key.
             *
             * @return mixed
             */
            public function getRawAttribute(string $key)
            {
                return $this->attributes[$key] ?? null;
            }
        };
    }

    /**
     * Test if the constructor throws an exception on invalid digits.
     *
     * @return void
     */
    public function test_constructor_throws_exception_on_invalid_input()
    {
        // Create a new anonymous model class.
        $model = new class extends EloquentModel {
            protected $fillable = ['test'];

            protected $casts = [
                'test' => IntegerToDecimal::class . ':0',
            ];
        };

        $this->expectException(\InvalidArgumentException::class);
        $model->test = 12.3;
    }

    /**
     * Ensure the attribute is set to an integer value.
     *
     * @return void
     */
    public function test_attribute_is_set_to_integer_value()
    {
        $m = new $this->fake_model(['test' => 17.51]);

        $this->assertSame(1751, $m->getRawAttribute('test'));
    }

    /**
     * Ensure the attribute is set to an integer value.
     *
     * @return void
     */
    public function test_attribute_is_retrieved_as_decimal()
    {
        $m = new $this->fake_model();
        $m->setRawAttributes(['test' => '1751']);

        $this->assertSame(17.51, $m->test);
    }

    /**
     * Make sure it can process string values as well.
     *
     * @return void
     */
    public function test_string_values_are_properly_casted()
    {
        $m = new $this->fake_model(['test' => '133.68']);

        $this->assertSame(13368, $m->getRawAttribute('test'));
        $this->assertSame(133.68, $m->test);
    }

    /**
     * Ensure we ignore decimal places beyond the second place.
     *
     * @return void
     */
    public function test_ignores_values_beyond_second_decimal_place()
    {
        $m = new $this->fake_model(['test' => 472.32423749]);

        $this->assertSame(47232, $m->getRawAttribute('test'));
        $this->assertSame(472.32, $m->test);
    }

    /**
     * Ensure we can process whole numbers too.
     *
     * @return void
     */
    public function test_handles_full_numbers()
    {
        $m = new $this->fake_model(['test' => 1700]);

        $this->assertSame(1700.0, $m->test);
    }

    /**
     * Ensure the caster can handle null values.
     *
     * @return void
     */
    public function test_casting_can_handle_null_values()
    {
        $m = new $this->fake_model(['test' => null]);
        $this->assertSame(0.0, $m->test);

        $m = new $this->fake_model(['test' => 0]);
        $this->assertSame(0.0, $m->test);

        $m->test = null;
        $this->assertSame(0, $m->getRawAttribute('test'));
    }

    /**
     * Ensure we can properly multiply values, including more digits.
     *
     * @return void
     */
    public function test_casting_more_digits_multiplies_the_value()
    {
        $m = new $this->fake_model(['test_triple' => 49.955]);

        $this->assertSame(49955, $m->getRawAttribute('test_triple'));
        $this->assertSame(49.955, $m->test_triple);

        $m->test_triple = $m->test_triple * 3;

        $this->assertSame(149865, $m->getRawAttribute('test_triple'));
        $this->assertSame(149.865, $m->test_triple);
    }
}
