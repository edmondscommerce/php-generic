<?php declare(strict_types=1);
/**
 * Generic Collection array<bool>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use EdmondsCommerce\Generic\Collections\ArrayGeneric;

final class ArrayBool extends ArrayGeneric
{
    /**
     * @param bool ...$data
     */
    public function __construct(bool ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function current(): bool
    {
        return current($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetGet($offset): bool
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param bool|mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        if (false === is_bool($value)) {
            throw new \InvalidArgumentException('$value must be of the type: bool');
        }
                null === $offset ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
    * @return bool[]
    */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
    * @param bool $item
    * @param mixed $key
    */
    public function add(bool $item, $key=null): void
    {
        $this->offsetSet($key, $item);
    }
}
