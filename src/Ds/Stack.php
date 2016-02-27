<?php
namespace Ds;

use Ds\Traits\CollectionTrait;
use UnderflowException;

final class Stack implements \IteratorAggregate, \ArrayAccess, Collection
{
    use CollectionTrait;

    /**
     * @var int
     *
     * The minimum capacity of a stack is 10
     */
    private $defaultCapacity = 10;

    /**
     * @var Vector
     */
    private $internal;

    /**
     * Creates an instance using the values of an array or Traversable object.
     *
     * @param array|\Traversable $values
     */
    public function __construct($values = null)
    {
        $this->internal = new Vector($values);
    }

    /**
     * Ensures that enough memory is allocated for a specified capacity. This
     * potentially reduces the number of reallocations as the size increases.
     *
     * @param int $capacity The number of values for which capacity should be
     *                      allocated. Capacity will stay the same if this value
     *                      is less than or equal to the current capacity.
     */
    public function allocate(int $capacity)
    {
        $this->internal->allocate($capacity);
    }

    /**
     * Returns the current capacity of the stack.
     *
     * @return int
     */
    public function capacity(): int
    {
        return $this->internal->capacity();
    }

    /**
     * Returns the value at the top of the stack without removing it.
     *
     * @return mixed
     *
     * @throws \UnderflowException if the stack is empty.
     */
    public function peek()
    {
        return $this->internal->last();
    }

    /**
     * Returns and removes the value at the top of the stack
     *
     * @return mixed
     *
     * @throws \UnderflowException if the stack is empty.
     */
    public function pop()
    {
        return $this->internal->pop();
    }

    /**
     * Pushes zero or more values onto the top of the stack.
     *
     * @param mixed ...$values
     */
    public function push(...$values)
    {
        $this->internal->push(...$values);
    }

    /**
     *
     */
    public function pushAll($values)
    {
        $this->internal->pushAll($values);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_reverse($this->internal->toArray());
    }

    /**
     *
     */
    public function getIterator()
    {
        while (!$this->isEmpty()) {
            yield $this->pop();
        }
    }

    /**
     *
     */
    public function __debugInfo()
    {
        return $this->toArray();
    }

    /**
     *
     */
    public function __toString()
    {
        return 'object(' . get_class($this) . ')';
    }

    /**
     *
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->push($value);
        } else {
            throw new \Error();
        }
    }

    /**
     *
     */
    public function offsetGet($offset)
    {
        throw new \Error();
    }

    /**
     *
     */
    public function offsetUnset($offset)
    {
        throw new \Error();
    }

    /**
     *
     */
    public function offsetExists($offset)
    {
        throw new \Error();
    }

    /**
     * Default Capacity
     *
     * @return int
     */
    private function defaultCapacity(): int
    {
        return $this->defaultCapacity;
    }
}
