<?php

namespace EdmondsCommerce\Generic\Service;

use EdmondsCommerce\Generic\Collections\GenericType;
use EdmondsCommerce\Generic\Model\GenericCollection;
use EdmondsCommerce\Generic\Repository\GenericCollectionRepositoryInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class CollectionGenerator implements CollectionGeneratorInterface
{
    /**
     * @var string[]
     */
    private const PRIMITIVE_TYPE = ['bool', 'int', 'float', 'string', 'array'];

    /**
     * @var string[]
     */
    private const GENERIC_TYPE = [GenericType::ARRAY_TYPE, GenericType::VECTOR_TYPE];

    /**
     * @var \EdmondsCommerce\Generic\Service\CollectionRenderInterface
     */
    private $collectionRender;

    /**
     * @var \EdmondsCommerce\Generic\Service\CollectionWriterInterface
     */
    private $collectionWriter;

    /**
     * @var \EdmondsCommerce\Generic\Repository\GenericCollectionRepositoryInterface $genericCollectionRepository
     */
    private $genericCollectionRepository;

    /**
     * @param \EdmondsCommerce\Generic\Service\CollectionRenderInterface               $collectionRender
     * @param \EdmondsCommerce\Generic\Service\CollectionWriterInterface               $collectionWriter
     * @param \EdmondsCommerce\Generic\Repository\GenericCollectionRepositoryInterface $genericCollectionRepository
     */
    public function __construct(
        CollectionRenderInterface $collectionRender,
        CollectionWriterInterface $collectionWriter,
        GenericCollectionRepositoryInterface $genericCollectionRepository
    ) {
        $this->collectionRender            = $collectionRender;
        $this->collectionWriter            = $collectionWriter;
        $this->genericCollectionRepository = $genericCollectionRepository;
    }

    /**
     * @inheritDoc
     */
    public function regenerate(): void
    {
        $genericCollestions = $this->genericCollectionRepository->findAll();
        foreach ($genericCollestions as $genericCollestion) {
            $collectionType = str_replace(ucfirst($genericCollestion->getType()), '', $genericCollestion->getClass());
            $this->generate($genericCollestion, $collectionType, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function generate(
        GenericCollection $genericCollection,
        string $collectionType,
        bool $saveCollection
    ): void {
        if (!in_array($collectionType, self::GENERIC_TYPE)) {
            throw new \InvalidArgumentException('Unknown generic colletion type "' . $collectionType . '"');
        }

        if (!in_array($genericCollection->getType(), self::PRIMITIVE_TYPE) && $genericCollection->getClass() === '') {
            $this->updateGenericCollectionType($genericCollection);
        }

        $class = $collectionType . ucfirst(str_replace('\\', '', $genericCollection->getType()));
        $genericCollection->setClass($class);

        $this->generateCollection($genericCollection, $collectionType);

        if ($saveCollection === true) {
            $this->genericCollectionRepository->save($genericCollection);
            echo "File generated-collections.json updated.\n";
        }
    }

    /**
     * @param \EdmondsCommerce\Generic\Model\GenericCollection $genericCollection
     */
    private function updateGenericCollectionType(GenericCollection $genericCollection): void
    {
        if (false === (
                class_exists('\\' . $genericCollection->getType())
                ||
                interface_exists('\\' . $genericCollection->getType())
            )
        ) {
            echo 'Warning! Class "', $genericCollection->getType(), '" does not exists.', "\n";
        }

        $namespaceArray = explode('\\', $genericCollection->getType());
        if (!isset($namespaceArray[1])) {
            $genericCollection->setType('\\' . $genericCollection->getType());

            return;
        }

        $genericCollection->setUse($genericCollection->getType());
        $genericCollection->setType(end($namespaceArray));
    }

    /**
     * @param \EdmondsCommerce\Generic\Model\GenericCollection $genericCollection
     * @param string                                  $collectionType
     *
     * @throws \ErrorException
     */
    private function generateCollection(GenericCollection $genericCollection, string $collectionType): void
    {
        $renderedCollecion = $this->collectionRender->render($genericCollection, $collectionType);
        $saveResult        = $this->collectionWriter->write($genericCollection, $renderedCollecion);

        if ($saveResult === true) {
            echo 'New generic collection ', $collectionType, '<', $genericCollection->getType(), "> saved.\n";

            return;
        }

        throw new \ErrorException('Something went wrong during saving collection!');
    }
}
