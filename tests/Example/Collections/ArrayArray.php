<?php declare(strict_types=1);
/**
 * Generic Collection array<array>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use EdmondsCommerce\Generic\Collections\ArrayGeneric;

final class ArrayArray extends ArrayGeneric
{
    /**
     * @param array ...$data
     */
    public function __construct(array ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function current(): array
    {
        return current($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return array
     */
    public function offsetGet($offset): array
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param array|mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        if (false === is_array($value)) {
            throw new \InvalidArgumentException('$value must be of the type: array');
        }
                null === $offset ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
    * @return array[]
    */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
    * @param array $item
    * @param mixed $key
    */
    public function add(array $item, $key=null): void
    {
        $this->offsetSet($key, $item);
    }
}
