<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Tests\Query;

use Generator;
use PHPUnit\Framework\TestCase;
use Rikta\PhpQuery\Examples\_Data\BookDataRepository;
use Rikta\PhpQuery\Examples\AuthorsOfAllBooksWithoutLink;
use Rikta\PhpQuery\Examples\BooksInAnotherLanguageThanGermanOrEnglishOrFrench;
use Rikta\PhpQuery\Examples\EarliestBookOfEachLanguage;
use Rikta\PhpQuery\Examples\ThreeBiggestEnglishBooksAndTheirAuthorsAfter1900AndAlphabeticallySorted;
use Rikta\PhpQuery\Examples\UniqueAuthors;
use Rikta\PhpQuery\Query;
use Rikta\PhpQuery\Tests\_TestHelper\BookQueryExample;

/**
 * @internal
 *
 * @medium
 */
final class FunctionalTest extends TestCase
{
    public function BookQueryExampleProvider(): Generator
    {
        $examples = [
            BooksInAnotherLanguageThanGermanOrEnglishOrFrench::class,
            UniqueAuthors::class,
            AuthorsOfAllBooksWithoutLink::class,
            ThreeBiggestEnglishBooksAndTheirAuthorsAfter1900AndAlphabeticallySorted::class,
            EarliestBookOfEachLanguage::class,
        ];
        foreach ($examples as $example) {
            yield $example => [$example];
        }
    }

    /**
     * @dataProvider BookQueryExampleProvider
     * @test
     *
     * @param class-string<BookQueryExample> $exampleClass
     */
    public function bookQueryExamples(string $exampleClass): void
    {
        $data = new BookDataRepository();
        /** @var BookQueryExample $example */
        $example = new $exampleClass();
        $results = $example->executeQuery(new Query(), $data);
        self::assertSame($example->expectedResult(), $results);
    }
}
