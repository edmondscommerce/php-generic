<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Tests\Collections;

use EdmondsCommerce\Generic\Tests\Example\Collections\ArrayInt;
use EdmondsCommerce\Generic\Collections\ArrayGeneric;
use PHPUnit\Framework\TestCase;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
final class ArrayGenericTest extends TestCase
{
    public function testIsInstanceOfArrayGenericCollection(): void
    {
        self::assertInstanceOf(ArrayGeneric::class, new ArrayInt());
    }

    public function testCanBeCreatedWithOneValue(): void
    {
        $array = new ArrayInt(1);

        self::assertCount(1, $array);
    }

    public function testCanBeCreatedWithMultiValues(): void
    {
        $array = new ArrayInt(1, 2, 45);

        self::assertCount(3, $array);
    }

    public function testCanAccesToGenericArrayAsToNormalArray(): void
    {
        $array = new ArrayInt(3, 4);

        self::assertSame(4, $array[1]);
        self::assertSame(3, $array[0]);
    }

    public function testCanAddNewElement(): void
    {
        $array = new ArrayInt(4, 3);

        $array[] = 7;

        self::assertSame(7, $array[2]);
    }

    public function testCanAddNewElementWithKey(): void
    {
        $array = new ArrayInt(4, 3);

        $array[5]     = 34;
        $array['key'] = -4;

        self::assertSame(34, $array[5]);
        self::assertSame(-4, $array['key']);
    }

    public function testCannotAddNewElementWithNotNumberValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Value string is not instance of int');

        $array = new ArrayInt(4, 5);

        $array[] = 'string';
    }

    public function testCanCheckIfKeyExists(): void
    {
        $object = new ArrayInt(3, 5);

        self::assertFalse(isset($object[5]));
    }

    public function testCanCountElement(): void
    {
        $array = new ArrayInt(4, 3, -2);

        self::assertEquals(3, count($array));
    }

    public function testCanIterateInLoop(): void
    {
        $array = new ArrayInt(3, 5, 12);

        foreach ($array as $key => $value) {
            self::assertSame($array[$key], $value);
        }
    }

    public function testCanBeSerialize(): void
    {
        $array    = [1, 4, 5];
        $arrayInt = new ArrayInt(...$array);

        self::assertContains(serialize($array), serialize($arrayInt));
    }

    public function testCanBeTransformetToArray(): void
    {
        $array  = new ArrayInt(34, 1);
        $result = $array->toArray();
        self::assertNotEmpty($result);
    }
}
