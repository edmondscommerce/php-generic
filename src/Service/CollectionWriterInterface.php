<?php

namespace d0niek\GenericCollection\Service;

use d0niek\GenericCollection\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionWriterInterface
{
    /**
     * Save generic collection to place pointed by namespace
     *
     * @param \d0niek\GenericCollection\Model\GenericCollection $genericCollection
     * @param string $renderedCollecion
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function write(GenericCollection $genericCollection, string $renderedCollecion): bool;
}
