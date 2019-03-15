<?php

namespace EdmondsCommerce\Generic\Repository;

use EdmondsCommerce\Generic\Model\GenericCollection;
use EdmondsCommerce\Generic\Model\Collections\VectorGenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class JsonGenericCollectionRepository implements GenericCollectionRepositoryInterface
{
    /**
     * @var string
     */
    private $jsonFile;

    /**
     * @param string $jsonFile
     */
    public function __construct(string $jsonFile)
    {
        $this->jsonFile = $jsonFile;
    }

    /**
     * Init file to save generated collections
     */
    private function init(): void
    {
        $dirname = dirname($this->jsonFile);
        if (!is_writable($dirname)) {
            throw new \ErrorException('Do not have persimios to write generated-collections.json');
        }

        file_put_contents($this->jsonFile, json_encode([]));
    }

    /**
     * @inheritDoc
     */
    public function save(GenericCollection $genericCollection): void
    {
        if (!file_exists($this->jsonFile)) {
            $this->init();
        }
        $genericCollestions = $this->findAll();
        foreach ($genericCollestions as $gc) {
            if ($gc->compare($genericCollection) === 0) {
                return;
            }
        }

        $genericCollestions->push($genericCollection);

        file_put_contents($this->jsonFile, json_encode($genericCollestions, JSON_PRETTY_PRINT));
    }

    /**
     * @inheritDoc
     */
    public function findAll(): VectorGenericCollection
    {
        if (!file_exists($this->jsonFile)) {
            $this->init();
        }
        $genericCollestions = new VectorGenericCollection();

        $jsonData = file_get_contents($this->jsonFile);
        $jsonArray = json_decode($jsonData, true) ?? [];

        foreach ($jsonArray as $genericCollestionArray) {
            $genericCollestion = new GenericCollection(
                $genericCollestionArray['type'],
                $genericCollestionArray['namespace'],
                $genericCollestionArray['class'],
                $genericCollestionArray['use']
            );
            $genericCollestions->push($genericCollestion);
        }

        return $genericCollestions;
    }
}
