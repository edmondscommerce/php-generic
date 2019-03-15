<?php declare(strict_types=1);
/**
 * Generic Collection array<\Exception>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use EdmondsCommerce\Generic\Collections\ArrayGeneric;

final class ArrayException extends ArrayGeneric
{
    /**
     * @param \Exception ...$data
     */
    public function __construct(\Exception ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return \Exception
     */
    public function current(): \Exception
    {
        return current($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return \Exception
     */
    public function offsetGet($offset): \Exception
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param \Exception|mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        if (false === ($value instanceof \Exception)) {
            throw new \InvalidArgumentException(
                '$value is ' . get_class($value) . ' but must be instance of \Exception'
            );
        }
            null === $offset ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
    * @return \Exception[]
    */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
    * @param \Exception $item
    * @param mixed $key
    */
    public function add(\Exception $item, $key = null): void
    {
        $this->offsetSet($key, $item);
    }
}
