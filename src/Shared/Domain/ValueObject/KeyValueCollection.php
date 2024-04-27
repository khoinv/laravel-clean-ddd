<?php

namespace Src\Shared\Domain\ValueObject;

use Exception;
use Src\Shared\Domain\Entity\HasKeyInterface;
use Src\Shared\Exception\ExceptionUtil;
use Throwable;

/**
 * @template T
 */
class KeyValueCollection
{
    /** @var HasKeyInterface[] */
    private array $_newItems = [];

    /**
     * TODO: using Traversable instead of array for more flexible.
     * @param T[] $_items
     */
    public function __construct(private array $_items = []) { }


    public function addItems(HasKeyInterface $item): static
    {
        if (is_null($item->getKey())) {
            $this->_newItems[] = $item;
        } else {
            $this->_items[$item->getKey()] = $item;
        }

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function updateItems(HasKeyInterface $item): static
    {
        ExceptionUtil::throw_if(is_null($item->getKey()), new Exception("cannot update item without id"));
        $this->_items[$item->getKey()] = $item;

        return $this;
    }


    /**
     * @throws Throwable
     */
    public function deleteItems(HasKeyInterface $item): static
    {
        ExceptionUtil::throw_if(is_null($item->getKey()), new Exception("cannot delete item without id"));
        unset($this->_items[$item->getKey()]);

        return $this;
    }

    /**
     * @return T[]
     */
    public function getItems(): array
    {
        return array_merge($this->_items, $this->_newItems);
    }

    /**
     * @param mixed $key
     * @return T
     * @throws Exception
     */
    public function findItem(mixed $key)
    {
        if (key_exists($key, $this->_items)) {
            return $this->_items[$key];
        }

        throw new Exception("Item not found");
    }
}
