<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Examples;

use Rikta\PhpQuery\Examples\_Data\BookDataRepository;
use Rikta\PhpQuery\QueryInterface;
use Rikta\PhpQuery\Tests\_TestHelper\BookQueryExample;

class EarliestBookOfEachLanguage implements BookQueryExample
{
    public function executeQuery(QueryInterface $query, BookDataRepository $data): array
    {
        return $query
            ->onPathValue('.year')->sort()
            ->onPathValue('.language')->unique()
            ->onPathValue('.language')->mapToKey()
            ->getResultsFor($data)
            ->toArray()
        ;
    }

    public function expectedResult(): array
    {
        return [
            'Akkadian' => [
                'author' => 'Unknown',
                'country' => 'Sumer and Akkadian Empire',
                'language' => 'Akkadian',
                'link' => 'https://en.wikipedia.org/wiki/Epic_of_Gilgamesh',
                'pages' => 160,
                'title' => 'The Epic Of Gilgamesh',
                'year' => -1700,
            ],
            'Greek' => [
                'author' => 'Homer',
                'country' => 'Greece',
                'language' => 'Greek',
                'link' => 'https://en.wikipedia.org/wiki/Odyssey',
                'pages' => 374,
                'title' => 'Odyssey',
                'year' => -800,
            ],
            'Sanskrit' => [
                'author' => 'Vyasa',
                'country' => 'India',
                'language' => 'Sanskrit',
                'link' => 'https://en.wikipedia.org/wiki/Mahabharata',
                'pages' => 276,
                'title' => 'Mahabharata',
                'year' => -700,
            ],
            'Hebrew' => [
                'author' => 'Unknown',
                'country' => 'Achaemenid Empire',
                'language' => 'Hebrew',
                'link' => 'https://en.wikipedia.org/wiki/Book_of_Job',
                'pages' => 176,
                'title' => 'The Book Of Job',
                'year' => -600,
            ],
            'Classical Latin' => [
                'author' => 'Virgil',
                'country' => 'Roman Empire',
                'language' => 'Classical Latin',
                'link' => 'https://en.wikipedia.org/wiki/Aeneid',
                'pages' => 442,
                'title' => 'The Aeneid',
                'year' => -23,
            ],
            'Japanese' => [
                'author' => 'Murasaki Shikibu',
                'country' => 'Japan',
                'language' => 'Japanese',
                'link' => 'https://en.wikipedia.org/wiki/The_Tale_of_Genji',
                'pages' => 1360,
                'title' => 'The Tale of Genji',
                'year' => 1006,
            ],
            'Arabic' => [
                'author' => 'Unknown',
                'country' => 'India/Iran/Iraq/Egypt/Tajikistan',
                'language' => 'Arabic',
                'link' => 'https://en.wikipedia.org/wiki/One_Thousand_and_One_Nights',
                'pages' => 288,
                'title' => 'One Thousand and One Nights',
                'year' => 1200,
            ],
            'Persian' => [
                'author' => 'Rumi',
                'country' => 'Sultanate of Rum',
                'language' => 'Persian',
                'link' => 'https://en.wikipedia.org/wiki/Masnavi',
                'pages' => 438,
                'title' => 'The Masnavi',
                'year' => 1236,
            ],
            'Italian' => [
                'author' => 'Dante Alighieri',
                'country' => 'Italy',
                'language' => 'Italian',
                'link' => 'https://en.wikipedia.org/wiki/Divine_Comedy',
                'pages' => 928,
                'title' => 'The Divine Comedy',
                'year' => 1315,
            ],
            'Old Norse' => [
                'author' => 'Unknown',
                'country' => 'Iceland',
                'language' => 'Old Norse',
                'link' => 'https://en.wikipedia.org/wiki/Nj%C3%A1ls_saga',
                'pages' => 384,
                'title' => 'Nj\\u00e1l\'s Saga',
                'year' => 1350,
            ],
            'English' => [
                'author' => 'Geoffrey Chaucer',
                'country' => 'England',
                'language' => 'English',
                'link' => 'https://en.wikipedia.org/wiki/The_Canterbury_Tales',
                'pages' => 544,
                'title' => 'The Canterbury Tales',
                'year' => 1450,
            ],
            'French' => [
                'author' => 'Fran\\u00e7ois Rabelais',
                'country' => 'France',
                'language' => 'French',
                'link' => 'https://en.wikipedia.org/wiki/Gargantua_and_Pantagruel',
                'pages' => 623,
                'title' => 'Gargantua and Pantagruel',
                'year' => 1533,
            ],
            'Spanish' => [
                'author' => 'Miguel de Cervantes',
                'country' => 'Spain',
                'language' => 'Spanish',
                'link' => 'https://en.wikipedia.org/wiki/Don_Quixote',
                'pages' => 1056,
                'title' => 'Don Quijote De La Mancha',
                'year' => 1610,
            ],
            'German' => [
                'author' => 'Johann Wolfgang von Goethe',
                'country' => 'Saxe-Weimar',
                'language' => 'German',
                'link' => 'https://en.wikipedia.org/wiki/Goethe%27s_Faust',
                'pages' => 158,
                'title' => 'Faust',
                'year' => 1832,
            ],
            'Danish' => [
                'author' => 'Hans Christian Andersen',
                'country' => 'Denmark',
                'language' => 'Danish',
                'link' => 'https://en.wikipedia.org/wiki/Fairy_Tales_Told_for_Children._First_Collection.',
                'pages' => 784,
                'title' => 'Fairy tales',
                'year' => 1836,
            ],
            'Russian' => [
                'author' => 'Nikolai Gogol',
                'country' => 'Russia',
                'language' => 'Russian',
                'link' => 'https://en.wikipedia.org/wiki/Dead_Souls',
                'pages' => 432,
                'title' => 'Dead Souls',
                'year' => 1842,
            ],
            'Norwegian' => [
                'author' => 'Henrik Ibsen',
                'country' => 'Norway',
                'language' => 'Norwegian',
                'link' => 'https://en.wikipedia.org/wiki/A_Doll%27s_House',
                'pages' => 68,
                'title' => 'A Doll\'s House',
                'year' => 1879,
            ],
            'Chinese' => [
                'author' => 'Lu Xun',
                'country' => 'China',
                'language' => 'Chinese',
                'link' => 'https://en.wikipedia.org/wiki/A_Madman%27s_Diary',
                'pages' => 389,
                'title' => 'Diary of a Madman',
                'year' => 1918,
            ],
            'Portuguese' => [
                'author' => 'Fernando Pessoa',
                'country' => 'Portugal',
                'language' => 'Portuguese',
                'link' => 'https://en.wikipedia.org/wiki/The_Book_of_Disquiet',
                'pages' => 272,
                'title' => 'The Book of Disquiet',
                'year' => 1928,
            ],
            'Icelandic' => [
                'author' => 'Halld\\u00f3r Laxness',
                'country' => 'Iceland',
                'language' => 'Icelandic',
                'link' => 'https://en.wikipedia.org/wiki/Independent_People',
                'pages' => 470,
                'title' => 'Independent People',
                'year' => 1934,
            ],
            'Swedish' => [
                'author' => 'Astrid Lindgren',
                'country' => 'Sweden',
                'language' => 'Swedish',
                'link' => 'https://en.wikipedia.org/wiki/Pippi_Longstocking',
                'pages' => 160,
                'title' => 'Pippi Longstocking',
                'year' => 1945,
            ],
            'French, English' => [
                'author' => 'Samuel Beckett',
                'country' => 'Republic of Ireland',
                'language' => 'French, English',
                'link' => 'https://en.wikipedia.org/wiki/Molloy_(novel)',
                'pages' => 256,
                'title' => 'Molloy, Malone Dies, The Unnamable, the trilogy',
                'year' => 1952,
            ],
        ];
    }
}
