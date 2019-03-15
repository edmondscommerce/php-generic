<?php declare(strict_types=1);

namespace EdmondsCommerce\Generic\Tests\Collections;

use EdmondsCommerce\Generic\Tests\Example\Collections\VectorInt;
use EdmondsCommerce\Generic\Collections\VectorGeneric;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
final class VectorGenericTest extends TestCase
{
    public function testIsInstanceOfArrayGenericCollection(): void
    {
        self::assertInstanceOf(VectorGeneric::class, new VectorInt());
    }

    public function testCanBeCreatedWithOneValue(): void
    {
        $vector = new VectorInt(1);

        self::assertSame(1, $vector->count());
    }

    public function testCanBeCreatedWithMultiValues(): void
    {
        $vector = new VectorInt(1, 2, 45);

        self::assertSame(3, $vector->count());
    }

    public function testCanAccessToGenericVectorAsToNormalArray(): void
    {
        $vector = new VectorInt(3, 4);

        self::assertSame(4, $vector[1]);
        self::assertSame(3, $vector[0]);
    }

    public function testAllocatesEnoughMemoryForRequiredCapacity(): void
    {
        $vector = new VectorInt();

        $vector->allocate(30);

        self::assertSame(30, $vector->capacity());
    }

    public function testUpdatesAllValuesByApplyingCallbackFunctionToEachValue(): void
    {
        $array  = [2, 4, 5];
        $vector = new VectorInt(...$array);

        $vector->apply(function (int $value): int {
            return $value * 2;
        });

        foreach ($array as $key => $value) {
            self::assertSame($value * 2, $vector[$key]);
        }
    }

    public function testRemovesAllValues(): void
    {
        $vector = new VectorInt(3, 5, 7);

        $countBeforeClear = $vector->count();
        $vector->clear();

        self::assertGreaterThan($vector->count(), $countBeforeClear);
        self::assertSame(0, $vector->count());
    }

    public function testDeterminesIfVectorContainsGivenValues(): void
    {
        $vector = new VectorInt(3, 2, 56);

        self::assertTrue($vector->contains(2, 3));
        self::assertFalse($vector->contains(-4));
    }

    public function testReturnShallowCopyOfVector(): void
    {
        $vector = new VectorInt(4, 3, 2);

        $vectorCopy = $vector->copy();

        self::assertInstanceOf(get_class($vector), $vector);
        self::assertSame($vector->count(), $vectorCopy->count());

        $vectorCopy->push(12);

        self::assertNotSame($vector->count(), $vectorCopy->count());
    }

    public function testReturnsNumberOfValuesInCollection(): void
    {
        $vector = new VectorInt(3, 4, 12);

        self::assertSame(3, $vector->count());
        self::assertSame(count($vector), $vector->count());
    }

    public function testCreatesNewVectorUsingCallableToDetermineWhichValuesToInclude(): void
    {
        $vector = new VectorInt(2, 3, 4, 5, 6);

        $filterVector = $vector->filter(function (int $value): bool {
            return $value % 2 === 0;
        });

        self::assertInstanceOf(get_class($vector), $filterVector);
        self::assertFalse($filterVector->contains(3, 5));
        self::assertTrue($filterVector->contains(2, 4, 6));
    }

    public function testAttemptsToFindValuesIndex(): void
    {
        $vector = new VectorInt(5, 3, 67);

        self::assertSame(1, $vector->find(3));
        self::assertSame(-1, $vector->find(1));
    }

    public function testReturnsFirstValueInVector(): void
    {
        $vector = new VectorInt(3, 2, 1);

        self::assertSame(3, $vector->first());
    }

    public function testReturnsValueAtGivenIndex(): void
    {
        $vector = new VectorInt(3, 45, -3);

        self::assertSame(-3, $vector->get(2));
        self::assertSame($vector[2], $vector->get(2));
    }

    public function testCallToNotexistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);

        $vector = new VectorInt(3);

        $vector[2];
    }

    public function testInsertValuesAtGivenIndex(): void
    {
        $vector = new VectorInt();

        $vector->insert(0, 23);
        $vector->insert(1, 2);
        $vector->insert(0, 45, 32);

        self::assertCount(4, $vector);
        self::assertSame(32, $vector[1]);
    }

    public function testInsertToNotExistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);

        $vector = new VectorInt(2, 3);

        $vector->insert(5, 34);
    }

    public function testFilterCanTotallyEmpty(): void
    {
        $vector = new VectorInt(1, 2, 3);
        $actual = $vector->filter(function () {
            return false;
        });
        self::assertSame([], $actual->toArray());
    }

    public function testVectorIsEmpty(): void
    {
        $vector = new VectorInt();

        self::assertTrue($vector->isEmpty());
    }

    public function testVectorIsNotEmpty(): void
    {
        $vector = new VectorInt(1, 2);

        self::assertFalse($vector->isEmpty());
    }

    public function testJoinsAllValuesTogetherAsString(): void
    {
        $vector = new VectorInt(3, 4, 7);

        self::assertSame('3,4,7', $vector->join(','));
        self::assertSame('347', $vector->join());
    }

    public function testReturnsLastValue(): void
    {
        $vector = new VectorInt(2, 4, 6);

        self::assertSame(6, $vector->last());
    }

    public function testReturnsResultOfApplyingCallbackToEachValue(): void
    {
        $vector = new VectorInt(1, 2, 3);

        $vectorMap = $vector->map(function (int $value): int {
            return $value + 2;
        });

        self::assertInstanceOf(get_class($vector), $vectorMap);
        foreach ($vectorMap as $key => $value) {
            self::assertSame($value, $vector[$key] + 2);
        }
    }

    public function testReturnsResultOfAddingAllGivenValuesToVector(): void
    {
        $vector = new VectorInt(1, 3, 5);

        $vectorMerge = $vector->merge(2, 4);

        self::assertInstanceOf(get_class($vector), $vectorMerge);
        self::assertSame(4, $vectorMerge->last());
    }

    public function testRemovesAndReturnsLastValue(): void
    {
        $vector = new VectorInt(45, 2, 37);

        $value = $vector->pop();

        self::assertSame(2, $vector->last());
        self::assertSame(37, $value);
    }

    public function testRemoveLastElementFromEmptyVector(): void
    {
        $this->expectException(\UnderflowException::class);

        $vector = new VectorInt();

        $vector->pop();
    }

    public function testAddsValuesToEndOfVector(): void
    {
        $vector = new VectorInt(23, 2);

        $vector->push(3);
        $vector->push(1, 56);

        self::assertSame(56, $vector->last());

        $vector[] = 3;

        self::assertSame(3, $vector->last());
        self::assertCount(6, $vector);
    }

    public function testReducesVectorToSingleValueUsingCallbackFunction(): void
    {
        $vector = new VectorInt(1, 2, 3);

        $value = $vector->reduce(function (int $carry, int $value): int {
            return $carry * $value;
        },
            5);

        self::assertSame(30, $value);
    }

    public function testRemovesAndReturnsValueByIndex(): void
    {
        $vector = new VectorInt(3, 4, 5);

        $value = $vector->remove(1);

        self::assertCount(2, $vector);
        self::assertSame(4, $value);
    }

    public function testRemoveElementByNotExistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);

        $vector = new VectorInt(45, 23);

        $vector->remove(5);
    }

    public function testReversesVectorInPlace(): void
    {
        $vector = new VectorInt(1, 2, 3);

        $vector->reverse();

        self::assertSame(1, $vector->last());
    }

    public function testReturnsReversedCopy(): void
    {
        $vector = new VectorInt(23, 56, 95);

        $reversedVector = $vector->reversed();

        self::assertInstanceOf(get_class($vector), $reversedVector);
        self::assertSame($vector->first(), $reversedVector->last());
    }

    public function testRotatesVectorByGivenNumberOfRotation(): void
    {
        $vector = new VectorInt(23, 34, 45);

        $vector->rotate(2);

        self::assertSame(34, $vector->last());
        self::assertSame(45, $vector->first());
    }

    public function testUpdatesValueAtGivenIndex(): void
    {
        $vector = new VectorInt(12, 23, 34);

        $vector->set(2, 43);

        self::assertSame(43, $vector[2]);

        $vector[1] = 0;

        self::assertSame(0, $vector[1]);
    }

    public function testUpdateValueAtNotExistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);
        $vector = new VectorInt(12, 23, 34);

        $vector->set(5, 43);
    }

    public function testRemovesAndReturnsFirstValue(): void
    {
        $vector = new VectorInt(34, 543, 2);

        $value = $vector->shift();

        self::assertSame(34, $value);
        self::assertCount(2, $vector);
    }

    public function testRemoveFirstElementFromEmptyVector(): void
    {
        $this->expectException(\UnderflowException::class);

        $vector = new VectorInt();

        $vector->shift();
    }

    public function testReturnsSubvectorOfGivenRange(): void
    {
        $vector = new VectorInt(1, 2, 3, 4, 5, 6);

        $sliceVector = $vector->slice(2, 3);

        self::assertInstanceOf(get_class($vector), $sliceVector);
        self::assertCount(3, $sliceVector);
        self::assertSame($sliceVector->last(), $vector[4]);
    }

    public function testSortsVectorInPlace(): void
    {
        $vector = new VectorInt(34, 26, 58, 4);

        $vector->sort();

        self::assertSame(4, $vector->first());
        self::assertSame(58, $vector->last());
    }

    public function testReturnsSortedCopy(): void
    {
        $vector = new VectorInt(34, 26, 58, 4);

        $sortedVector = $vector->sorted(function (int $a, int $b): int {
            return $b <=> $a;
        });

        self::assertSame(58, $sortedVector->first());
    }

    public function testReturnsSumOfAllValuesInVector(): void
    {
        $vector = new VectorInt(45, 5, 12);

        self::assertSame(62, $vector->sum());
    }

    public function testAddsValuesToFrontOfVector(): void
    {
        $vector = new VectorInt(1, 2);

        $vector->unshift(4, 6);

        self::assertCount(4, $vector);
        self::assertSame(4, $vector->first());
    }
}
