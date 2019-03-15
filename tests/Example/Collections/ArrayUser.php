<?php declare(strict_types=1);
/**
 * Generic Collection array<User>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use EdmondsCommerce\Generic\Collections\ArrayGeneric;
use EdmondsCommerce\Generic\Tests\Example\User;

final class ArrayUser extends ArrayGeneric
{
    /**
     * @param User ...$data
     */
    public function __construct(User ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return User
     */
    public function current(): User
    {
        return current($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return User
     */
    public function offsetGet($offset): User
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param User|mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        if (false === ($value instanceof User)) {
            throw new \InvalidArgumentException('$value must be instance of User');
        }
            null === $offset ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
    * @return User[]
    */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
    * @param User $item
    * @param mixed $key
    */
    public function add(User $item, $key=null): void
    {
        $this->offsetSet($key, $item);
    }
}
