<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Service;

use EdmondsCommerce\Generic\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionGeneratorInterface
{
    /**
     * Generate generic collection
     *
     * @param \EdmondsCommerce\Generic\Model\GenericCollection $genericCollection
     * @param string $collectionType
     * @param bool $saveCollection
     *
     * @throws \InvalidArgumentException
     */
    public function generate(
        GenericCollection $genericCollection,
        string $collectionType,
        bool $saveCollection
    ): void;

    /**
     * Regenerat collections from generated-collections.json file
     */
    public function regenerate(): void;
}
