<?php declare(strict_types=1);
/**
 * Generic Collection array<float>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use EdmondsCommerce\Generic\Collections\ArrayGeneric;

final class ArrayFloat extends ArrayGeneric
{
    /**
     * @param float ...$data
     */
    public function __construct(float ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return float
     */
    public function current(): float
    {
        return current($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return float
     */
    public function offsetGet($offset): float
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param float|mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        if (false === is_float($value)) {
            throw new \InvalidArgumentException(
                '$value is ' . $value . ' but must be of the type: float'
            );
        }
                null === $offset ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
    * @return float[]
    */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
    * @param float $item
    * @param mixed $key
    */
    public function add(float $item, $key = null): void
    {
        $this->offsetSet($key, $item);
    }
}
