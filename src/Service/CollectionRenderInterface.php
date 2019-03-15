<?php

namespace EdmondsCommerce\Generic\Service;

use EdmondsCommerce\Generic\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionRenderInterface
{
    /**
     * Render generic collection
     *
     * @param \EdmondsCommerce\Generic\Model\GenericCollection $genericCollection
     * @param string $collectionType
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function render(GenericCollection $genericCollection, string $collectionType): string;
}
