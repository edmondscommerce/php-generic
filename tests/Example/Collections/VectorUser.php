<?php declare(strict_types=1);
/**
 * Generic Collection \Ds\Vector<User>
 */

namespace EdmondsCommerce\Generic\Tests\Example\Collections;

use Ds\Vector;
use EdmondsCommerce\Generic\Collections\VectorGeneric;
use EdmondsCommerce\Generic\Tests\Example\User;

final class VectorUser extends VectorGeneric
{
    /**
     * @param User ...$data
     */
    public function __construct(User ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param User ...$values
     *
     * @return bool
     */
    public function contains(User ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return VectorUser
     */
    public function copy(): VectorUser
    {
        $data = $this->data->copy();
        return new VectorUser(...$data->toArray());
    }

    /**
     * @return User
     */
    public function current(): User
    {
        return $this->get($this->position);
    }

    /**
     * @param callable $callback
     *
     * @return VectorUser     */
    public function filter(callable $callback): VectorUser
    {
        return new self($this->data->filter($callback)->toArray());
    }

    /**
     * @param User $value
     *
     * @return int
     */
    public function find(User $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return User
     */
    public function first(): User
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return User
     */
    public function get(int $index): User
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param User ...$values
     */
    public function insert(int $index, User ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return User
     */
    public function last(): User
    {
        return $this->data->last();
    }

    /**
     * @param User ...$values
     *
     * @return VectorUser
     */
    public function merge(User ...$values): VectorUser
    {
        $data = $this->data->merge($values);
        return new VectorUser(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return VectorUser
     */
    public function map(callable $callback): VectorUser
    {
        $data = $this->data->map($callback);
        return new VectorUser(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return User
     */
    public function offsetGet($offset): User
    {
        return $this->data[$offset];
    }

    /**
     * @param int|null $offset
     * @param User|mixed $value
     */
    public function offsetSet($offset, $value): void
    {
                    if (false === ($value instanceof User)) {
                throw new \InvalidArgumentException('$value must be instance of User');
            }
                    is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return User
     */
    public function pop(): User
    {
        return $this->data->pop();
    }

    /**
     * @param User ...$values
     */
    public function push(User ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return User
     */
    public function remove(int $index): User
    {
        return $this->data->remove($index);
    }

    /**
     * @return VectorUser
     */
    public function reversed(): VectorUser
    {
        $data = $this->data->reversed();
        return new VectorUser(...$data->toArray());
    }

    /**
     * @param int $index
     * @param User $value
     */
    public function set(int $index, User $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return User
     */
    public function shift(): User
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return VectorUser
     */
    public function slice(int $index, ?int $length = null): VectorUser
    {
        $data = $this->data->slice($index, $length);
        return new VectorUser(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return VectorUser
     */
    public function sorted(?callable $comparator = null): VectorUser
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorUser(...$data->toArray());
    }

    /**
     * @param User ...$values
     */
    public function unshift(User ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
