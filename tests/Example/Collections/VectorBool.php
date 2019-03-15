<?php declare(strict_types=1);
/**
 * Generic Collection \Ds\Vector<bool>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use Ds\Vector;
use EdmondsCommerce\Generic\Collections\VectorGeneric;

final class VectorBool extends VectorGeneric
{
    /**
     * @param bool ...$data
     */
    public function __construct(bool ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param bool ...$values
     *
     * @return bool
     */
    public function contains(bool ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return VectorBool
     */
    public function copy(): VectorBool
    {
        $data = $this->data->copy();
        return new VectorBool(...$data->toArray());
    }

    /**
     * @return bool
     */
    public function current(): bool
    {
        return $this->get($this->position);
    }

    /**
     * @param callable $callback
     *
     * @return VectorBool     */
    public function filter(callable $callback): VectorBool
    {
        return new self(...$this->data->filter($callback)->toArray());
    }

    /**
     * @param bool $value
     *
     * @return int
     */
    public function find(bool $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return bool
     */
    public function first(): bool
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return bool
     */
    public function get(int $index): bool
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param bool ...$values
     */
    public function insert(int $index, bool ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return bool
     */
    public function last(): bool
    {
        return $this->data->last();
    }

    /**
     * @param bool ...$values
     *
     * @return VectorBool
     */
    public function merge(bool ...$values): VectorBool
    {
        $data = $this->data->merge($values);
        return new VectorBool(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return VectorBool
     */
    public function map(callable $callback): VectorBool
    {
        $data = $this->data->map($callback);
        return new VectorBool(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return bool
     */
    public function offsetGet($offset): bool
    {
        return $this->data[$offset];
    }

    /**
     * @param int|null $offset
     * @param bool|mixed $value
     */
    public function offsetSet($offset, $value): void
    {
                    if (false === is_bool($value)) {
                throw new \InvalidArgumentException(
                    '$value is ' . $value.' but must be of the type: bool'
                );
            }
                    is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return bool
     */
    public function pop(): bool
    {
        return $this->data->pop();
    }

    /**
     * @param bool ...$values
     */
    public function push(bool ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return bool
     */
    public function remove(int $index): bool
    {
        return $this->data->remove($index);
    }

    /**
     * @return VectorBool
     */
    public function reversed(): VectorBool
    {
        $data = $this->data->reversed();
        return new VectorBool(...$data->toArray());
    }

    /**
     * @param int $index
     * @param bool $value
     */
    public function set(int $index, bool $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return bool
     */
    public function shift(): bool
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return VectorBool
     */
    public function slice(int $index, ?int $length = null): VectorBool
    {
        $data = $this->data->slice($index, $length);
        return new VectorBool(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return VectorBool
     */
    public function sorted(?callable $comparator = null): VectorBool
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorBool(...$data->toArray());
    }

    /**
     * @param bool ...$values
     */
    public function unshift(bool ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
