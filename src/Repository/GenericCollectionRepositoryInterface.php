<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Repository;

use EdmondsCommerce\Generic\Model\GenericCollection;
use EdmondsCommerce\Generic\Model\Collections\VectorGenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface GenericCollectionRepositoryInterface
{
    /**
     * Save generic collection
     *
     * @param \EdmondsCommerce\Generic\Model\GenericCollection $genericCollection
     */
    public function save(GenericCollection $genericCollection): void;

    /**
     * Find all generic collections
     *
     * @return \EdmondsCommerce\Generic\Model\Collections\VectorGenericCollection
     */
    public function findAll(): VectorGenericCollection;
}
