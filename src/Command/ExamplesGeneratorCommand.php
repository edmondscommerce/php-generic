<?php

namespace EdmondsCommerce\Generic\Command;

use EdmondsCommerce\Generic\Collections\GenericType;
use EdmondsCommerce\Generic\Example\User;
use EdmondsCommerce\Generic\Model\GenericCollection;
use EdmondsCommerce\Generic\Service\CollectionGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>=
 */
class ExamplesGeneratorCommand extends Command
{
    /**
    * @var \EdmondsCommerce\Generic\Service\CollectionGeneratorInterface
    */
    private $collectionGenerator;

    /**
     * @var string[]
     */
    private $primitiveType = ['bool', 'int', 'float', 'bool', 'array'];

    /**
     * @var string[]
     */
    private $complexType = [
        \Exception::class,
        User::class,
        '\\Not\\Existing\\ClassName'
    ];

    /**
     * @var string
     */
    private $namespace = 'EdmondsCommerce\\GenericCollection\\Example\\Collections';

    /**
     * @param \EdmondsCommerce\Generic\Service\CollectionGeneratorInterface $collectionGenerator
     */
    public function __construct(CollectionGeneratorInterface $collectionGenerator)
    {
        $this->collectionGenerator = $collectionGenerator;
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->setName('generate:examples')
            ->setDescription('Generate example generic collections.');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->primitiveType as $type) {
            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::ARRAY_TYPE, false);

            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::VECTOR_TYPE, false);
        }

        foreach ($this->complexType as $type) {
            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::ARRAY_TYPE, false);

            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::VECTOR_TYPE, false);
        }

        return 0;
    }
}
