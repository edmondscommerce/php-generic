<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Service;

use EdmondsCommerce\Generic\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionWriterInterface
{
    /**
     * Save generic collection to place pointed by namespace
     *
     * @param \EdmondsCommerce\Generic\Model\GenericCollection $genericCollection
     * @param string $renderedCollecion
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function write(GenericCollection $genericCollection, string $renderedCollecion): bool;
}
