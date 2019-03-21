<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Tests\Service;

use Composer\Autoload\ClassLoader;
use EdmondsCommerce\Generic\Collections\GenericType;
use EdmondsCommerce\Generic\Model\GenericCollection;
use EdmondsCommerce\Generic\Repository\JsonGenericCollectionRepository;
use EdmondsCommerce\Generic\Service\CollectionGenerator;
use EdmondsCommerce\Generic\Service\CollectionRender;
use EdmondsCommerce\Generic\Service\CollectionWriter;
use EdmondsCommerce\Generic\Tests\Example\User;
use PHPUnit\Framework\TestCase;

class CollectionGeneratorTest extends TestCase
{
    /**
     * @var string
     */
    private $namespace = 'EdmondsCommerce\\Generic\\Tests\\Example\\Collections';

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
    ];


    private function getClassLoader(): ClassLoader
    {
        $loader = require __DIR__ . '/../../vendor/autoload.php';

        return $loader;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->collectionGenerator = new CollectionGenerator(
            new CollectionRender(__DIR__ . '/../../'),
            new CollectionWriter($this->getClassLoader()),
            new JsonGenericCollectionRepository(__DIR__ . '/../Example/generated.json')
        );
    }

    /**
     * @test
     */
    public function itCanGenerateCollections(): void
    {
        chdir(__DIR__ . '/../Example/Collections/');
        array_map('unlink', glob('*.php'));
        foreach ($this->primitiveType as $type) {
            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::VECTOR_TYPE, false);
        }

        foreach ($this->complexType as $type) {
            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::VECTOR_TYPE, false);
        }
        $expected = [
            'VectorArray.php',
            'VectorBool.php',
            'VectorException.php',
            'VectorFloat.php',
            'VectorInt.php',
            'VectorUser.php',
        ];
        $actual   = glob('*.php');
        self::assertSame($expected, $actual);
    }
}
