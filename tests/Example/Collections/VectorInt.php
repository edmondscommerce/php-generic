<?php declare(strict_types=1);
/**
 * Generic Collection \Ds\Vector<int>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use Ds\Vector;
use EdmondsCommerce\Generic\Collections\VectorGeneric;
/**
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
final class VectorInt extends VectorGeneric
{
    /**
     * @param int ...$data
     */
    public function __construct(int ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param int ...$values
     *
     * @return bool
     */
    public function contains(int ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return VectorInt
     */
    public function copy(): VectorInt
    {
        $data = $this->data->copy();
        return new VectorInt(...$data->toArray());
    }

    /**
     * @return int
     */
    public function current(): int
    {
        return $this->get($this->position);
    }

    /**
     * @param callable $callback
     *
     * @return VectorInt     */
    public function filter(callable $callback): VectorInt
    {
        return new self(...$this->data->filter($callback)->toArray());
    }

    /**
     * @param int $value
     *
     * @return int
     */
    public function find(int $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return int
     */
    public function first(): int
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return int
     */
    public function get(int $index): int
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param int ...$values
     */
    public function insert(int $index, int ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return int
     */
    public function last(): int
    {
        return $this->data->last();
    }

    /**
     * @param int ...$values
     *
     * @return VectorInt
     */
    public function merge(int ...$values): VectorInt
    {
        $data = $this->data->merge($values);
        return new VectorInt(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return VectorInt
     */
    public function map(callable $callback): VectorInt
    {
        $data = $this->data->map($callback);
        return new VectorInt(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return int
     */
    public function offsetGet($offset): int
    {
        return $this->data[$offset];
    }

    /**
     * @param int|null $offset
     * @param int|mixed $value
     */
    public function offsetSet($offset, $value): void
    {
                    if (false === is_int($value)) {
                throw new \InvalidArgumentException(
                    '$value is ' . $value.' but must be of the type: int'
                );
            }
                    is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return int
     */
    public function pop(): int
    {
        return $this->data->pop();
    }

    /**
     * @param int ...$values
     */
    public function push(int ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return int
     */
    public function remove(int $index): int
    {
        return $this->data->remove($index);
    }

    /**
     * @return VectorInt
     */
    public function reversed(): VectorInt
    {
        $data = $this->data->reversed();
        return new VectorInt(...$data->toArray());
    }

    /**
     * @param int $index
     * @param int $value
     */
    public function set(int $index, int $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return int
     */
    public function shift(): int
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return VectorInt
     */
    public function slice(int $index, ?int $length = null): VectorInt
    {
        $data = $this->data->slice($index, $length);
        return new VectorInt(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return VectorInt
     */
    public function sorted(?callable $comparator = null): VectorInt
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorInt(...$data->toArray());
    }

    /**
     * @param int ...$values
     */
    public function unshift(int ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
