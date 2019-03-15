<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Service;

use EdmondsCommerce\Generic\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class CollectionRender implements CollectionRenderInterface
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * @param string $rootPath
     */
    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @inheritDoc
     */
    public function render(GenericCollection $genericCollection, string $collectionType): string
    {
        $template = $this->rootPath . '/template/' . $collectionType . 'Generic.php';
        if (!file_exists($template)) {
            throw new \InvalidArgumentException('Could not find template for ' . $collectionType);
        }

        ob_start();
        include($template);
        $result = "<?php declare(strict_types=1);\n" . ob_get_clean();

        return $result;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    protected function getTypeCheckStatement(string $type): string
    {
        switch ($type) {
            case 'bool':
                return 'is_bool($value)';
            case 'int':
            case 'float':
                return 'is_numeric($value)';
            case 'string':
                return 'is_string($value)';
            case 'array':
                return 'is_array($value)';
            default:
                return '$value instanceof ' . $type;
        }
    }
}
