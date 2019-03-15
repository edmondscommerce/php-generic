/**
 * Generic Collection array<<?= $genericCollection->getType() ?>>
 */

namespace <?= $genericCollection->getNamespace() ?>;

use EdmondsCommerce\Generic\Collections\ArrayGeneric;
<?= $genericCollection->getUse() !== '' ? 'use ' . $genericCollection->getUse() . ";\n" : '' ?>

final class <?= $genericCollection->getClass() ?> extends ArrayGeneric
{
    /**
     * @param <?= $genericCollection->getType() ?> ...$data
     */
    public function __construct(<?= $genericCollection->getType() ?> ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function current(): <?= $genericCollection->getType(), "\n" ?>
    {
        return current($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function offsetGet($offset): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param <?= $genericCollection->getType() ?>|mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
<?php switch($genericCollection->getType()){
    case 'int':
    case 'string':
    case 'float':
    case 'bool':
    case 'array':
        ?>
        if (false === is_<?= $genericCollection->getType()?>($value)) {
            throw new \InvalidArgumentException('$value must be of the type: <?= $genericCollection->getType() ?>');
        }
        <?php
        break;

    default:
        ?>
        if (false === ($value instanceof <?= $genericCollection->getType() ?>)) {
            throw new \InvalidArgumentException('$value must be instance of <?= $genericCollection->getType() ?>');
        }
    <?php
}
?>
        null === $offset ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
    * @return <?= $genericCollection->getType() ?>[]
    */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
    * @param <?= $genericCollection->getType() ?> $item
    * @param mixed $key
    */
    public function add(<?= $genericCollection->getType() ?> $item, $key=null): void
    {
        $this->offsetSet($key, $item);
    }
}
