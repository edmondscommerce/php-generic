<?php declare(strict_types=1);
/**
 * Generic Collection \Ds\Vector<float>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use Ds\Vector;
use EdmondsCommerce\Generic\Collections\VectorGeneric;
/**
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
final class VectorFloat extends VectorGeneric
{
    /**
     * @param float ...$data
     */
    public function __construct(float ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param float ...$values
     *
     * @return bool
     */
    public function contains(float ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return VectorFloat
     */
    public function copy(): VectorFloat
    {
        $data = $this->data->copy();
        return new VectorFloat(...$data->toArray());
    }

    /**
     * @return float
     */
    public function current(): float
    {
        return $this->get($this->position);
    }

    /**
     * @param callable $callback
     *
     * @return VectorFloat     */
    public function filter(callable $callback): VectorFloat
    {
        return new self(...$this->data->filter($callback)->toArray());
    }

    /**
     * @param float $value
     *
     * @return int
     */
    public function find(float $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return float
     */
    public function first(): float
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return float
     */
    public function get(int $index): float
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param float ...$values
     */
    public function insert(int $index, float ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return float
     */
    public function last(): float
    {
        return $this->data->last();
    }

    /**
     * @param float ...$values
     *
     * @return VectorFloat
     */
    public function merge(float ...$values): VectorFloat
    {
        $data = $this->data->merge($values);
        return new VectorFloat(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return VectorFloat
     */
    public function map(callable $callback): VectorFloat
    {
        $data = $this->data->map($callback);
        return new VectorFloat(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return float
     */
    public function offsetGet($offset): float
    {
        return $this->data[$offset];
    }

    /**
     * @param int|null $offset
     * @param float|mixed $value
     */
    public function offsetSet($offset, $value): void
    {
                    if (false === is_float($value)) {
                throw new \InvalidArgumentException(
                    '$value is ' . $value.' but must be of the type: float'
                );
            }
                    is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return float
     */
    public function pop(): float
    {
        return $this->data->pop();
    }

    /**
     * @param float ...$values
     */
    public function push(float ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return float
     */
    public function remove(int $index): float
    {
        return $this->data->remove($index);
    }

    /**
     * @return VectorFloat
     */
    public function reversed(): VectorFloat
    {
        $data = $this->data->reversed();
        return new VectorFloat(...$data->toArray());
    }

    /**
     * @param int $index
     * @param float $value
     */
    public function set(int $index, float $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return float
     */
    public function shift(): float
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return VectorFloat
     */
    public function slice(int $index, ?int $length = null): VectorFloat
    {
        $data = $this->data->slice($index, $length);
        return new VectorFloat(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return VectorFloat
     */
    public function sorted(?callable $comparator = null): VectorFloat
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorFloat(...$data->toArray());
    }

    /**
     * @param float ...$values
     */
    public function unshift(float ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
