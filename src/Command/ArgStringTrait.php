<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Command;

use Symfony\Component\Console\Input\InputInterface;

trait ArgStringTrait
{
    private function getArgString(InputInterface $input, string $arg): string
    {
        $var = $input->getArgument($arg);
        if (null === $var) {
            throw new \InvalidArgumentException($arg . ' can not be null');
        } elseif (is_array($var)) {
            throw new \InvalidArgumentException(
                $arg . ' must be a string, but is currently ' . print_r($var, true)
            );
        }

        return $var;
    }
}
