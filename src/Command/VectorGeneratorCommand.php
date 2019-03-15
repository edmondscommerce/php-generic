<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Command;

use EdmondsCommerce\Generic\Collections\GenericType;
use EdmondsCommerce\Generic\Model\GenericCollection;
use EdmondsCommerce\Generic\Service\CollectionGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class VectorGeneratorCommand extends Command
{
    use ArgStringTrait;
    /**
     * @var \EdmondsCommerce\Generic\Service\CollectionGeneratorInterface
     */
    private $collectionGenerator;

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
        $this->setName('generate:vector')
             ->setDescription('Generate generic vector - \Ds\Vector<type>()')
             ->addArgument(
                 'type',
                 InputArgument::REQUIRED,
                 "Type of generic vector. It can by bool, int, float, string, array \n" .
                 "or full class namespace (remember to use \\\\ to separate names)."
             )
             ->addArgument(
                 'namespace',
                 InputArgument::REQUIRED,
                 "Namespace of new generic vector."
             )
             ->addOption(
                 'save',
                 's',
                 InputOption::VALUE_OPTIONAL,
                 'Save generated vector to generated-collections.json file.',
                 false
             );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type              = ltrim($this->getArgString($input, 'type'), '\\');
        $namespace         = $this->getArgString($input, 'namespace');
        $genericCollection = new GenericCollection($type, $namespace);
        $save              = $input->getOption('save');

        if (!in_array($save, [true, false, 'true', 'false'], true)) {
            throw new \InvalidArgumentException('Possible values for save option are true or false');
        }
        if (!is_bool($save)) {
            $save = $save === 'false' ? false : true;
        }

        $this->collectionGenerator->generate($genericCollection, GenericType::VECTOR_TYPE, $save);

        return 0;
    }
}
