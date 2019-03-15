<?php declare(strict_types=1);
/**
 * Generic Collection \Ds\Vector<array>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use Ds\Vector;
use EdmondsCommerce\Generic\Collections\VectorGeneric;

final class VectorArray extends VectorGeneric
{
    /**
     * @param array ...$data
     */
    public function __construct(array ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param array ...$values
     *
     * @return bool
     */
    public function contains(array ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return VectorArray
     */
    public function copy(): VectorArray
    {
        $data = $this->data->copy();
        return new VectorArray(...$data->toArray());
    }

    /**
     * @return array
     */
    public function current(): array
    {
        return $this->get($this->position);
    }

    /**
     * @param callable $callback
     *
     * @return VectorArray     */
    public function filter(callable $callback): VectorArray
    {
        return new self($this->data->filter($callback)->toArray());
    }

    /**
     * @param array $value
     *
     * @return int
     */
    public function find(array $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return array
     */
    public function first(): array
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return array
     */
    public function get(int $index): array
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param array ...$values
     */
    public function insert(int $index, array ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return array
     */
    public function last(): array
    {
        return $this->data->last();
    }

    /**
     * @param array ...$values
     *
     * @return VectorArray
     */
    public function merge(array ...$values): VectorArray
    {
        $data = $this->data->merge($values);
        return new VectorArray(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return VectorArray
     */
    public function map(callable $callback): VectorArray
    {
        $data = $this->data->map($callback);
        return new VectorArray(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return array
     */
    public function offsetGet($offset): array
    {
        return $this->data[$offset];
    }

    /**
     * @param int|null $offset
     * @param array|mixed $value
     */
    public function offsetSet($offset, $value): void
    {
                    if (false === is_array($value)) {
                throw new \InvalidArgumentException('$value must be of the type: array');
            }
                    is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return array
     */
    public function pop(): array
    {
        return $this->data->pop();
    }

    /**
     * @param array ...$values
     */
    public function push(array ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return array
     */
    public function remove(int $index): array
    {
        return $this->data->remove($index);
    }

    /**
     * @return VectorArray
     */
    public function reversed(): VectorArray
    {
        $data = $this->data->reversed();
        return new VectorArray(...$data->toArray());
    }

    /**
     * @param int $index
     * @param array $value
     */
    public function set(int $index, array $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return array
     */
    public function shift(): array
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return VectorArray
     */
    public function slice(int $index, ?int $length = null): VectorArray
    {
        $data = $this->data->slice($index, $length);
        return new VectorArray(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return VectorArray
     */
    public function sorted(?callable $comparator = null): VectorArray
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorArray(...$data->toArray());
    }

    /**
     * @param array ...$values
     */
    public function unshift(array ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
