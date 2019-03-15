<?php declare(strict_types=1);
/**
 * Generic Collection \Ds\Vector<\Exception>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use Ds\Vector;
use EdmondsCommerce\Generic\Collections\VectorGeneric;
/**
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
final class VectorException extends VectorGeneric
{
    /**
     * @param \Exception ...$data
     */
    public function __construct(\Exception ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param \Exception ...$values
     *
     * @return bool
     */
    public function contains(\Exception ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return VectorException
     */
    public function copy(): VectorException
    {
        $data = $this->data->copy();
        return new VectorException(...$data->toArray());
    }

    /**
     * @return \Exception
     */
    public function current(): \Exception
    {
        return $this->get($this->position);
    }

    /**
     * @param callable $callback
     *
     * @return VectorException     */
    public function filter(callable $callback): VectorException
    {
        return new self(...$this->data->filter($callback)->toArray());
    }

    /**
     * @param \Exception $value
     *
     * @return int
     */
    public function find(\Exception $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return \Exception
     */
    public function first(): \Exception
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return \Exception
     */
    public function get(int $index): \Exception
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param \Exception ...$values
     */
    public function insert(int $index, \Exception ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return \Exception
     */
    public function last(): \Exception
    {
        return $this->data->last();
    }

    /**
     * @param \Exception ...$values
     *
     * @return VectorException
     */
    public function merge(\Exception ...$values): VectorException
    {
        $data = $this->data->merge($values);
        return new VectorException(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return VectorException
     */
    public function map(callable $callback): VectorException
    {
        $data = $this->data->map($callback);
        return new VectorException(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return \Exception
     */
    public function offsetGet($offset): \Exception
    {
        return $this->data[$offset];
    }

    /**
     * @param int|null $offset
     * @param \Exception|mixed $value
     */
    public function offsetSet($offset, $value): void
    {
                    if (false === ($value instanceof \Exception)) {
                throw new \InvalidArgumentException(
                    '$value is ' . get_class($value) . ' but must be instance of \Exception'
                );
            }
                    is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return \Exception
     */
    public function pop(): \Exception
    {
        return $this->data->pop();
    }

    /**
     * @param \Exception ...$values
     */
    public function push(\Exception ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return \Exception
     */
    public function remove(int $index): \Exception
    {
        return $this->data->remove($index);
    }

    /**
     * @return VectorException
     */
    public function reversed(): VectorException
    {
        $data = $this->data->reversed();
        return new VectorException(...$data->toArray());
    }

    /**
     * @param int $index
     * @param \Exception $value
     */
    public function set(int $index, \Exception $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return \Exception
     */
    public function shift(): \Exception
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return VectorException
     */
    public function slice(int $index, ?int $length = null): VectorException
    {
        $data = $this->data->slice($index, $length);
        return new VectorException(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return VectorException
     */
    public function sorted(?callable $comparator = null): VectorException
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorException(...$data->toArray());
    }

    /**
     * @param \Exception ...$values
     */
    public function unshift(\Exception ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
