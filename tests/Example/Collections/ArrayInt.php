<?php declare(strict_types=1);
/**
 * Generic Collection array<int>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use EdmondsCommerce\Generic\Collections\ArrayGeneric;

final class ArrayInt extends ArrayGeneric
{
    /**
     * @param int ...$data
     */
    public function __construct(int ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function current(): int
    {
        return current($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return int
     */
    public function offsetGet($offset): int
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param int|mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        if (false === is_int($value)) {
            throw new \InvalidArgumentException(
                '$value is ' . $value . ' but must be of the type: int'
            );
        }
                null === $offset ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
    * @return int[]
    */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
    * @param int $item
    * @param mixed $key
    */
    public function add(int $item, $key = null): void
    {
        $this->offsetSet($key, $item);
    }
}
