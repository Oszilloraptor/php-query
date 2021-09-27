<?php

declare(strict_types=1);

namespace Rikta\PhpQuery\Examples;

use Rikta\PhpQuery\Examples\_Data\BookDataRepository;
use Rikta\PhpQuery\QueryInterface;
use Rikta\PhpQuery\Tests\_TestHelper\BookQueryExample;

/**
 * Returns all books that don't have a link associated with them.
 */
class UniqueAuthors implements BookQueryExample
{
    public function executeQuery(QueryInterface $query, BookDataRepository $data): array
    {
        return $query
            ->onPathValue('.author')->mapToValue()
            ->unique()
            ->getResultsFor($data)
            ->getItems()
        ;
    }

    public function expectedResult(): array
    {
        return [
            'Chinua Achebe',
            'Hans Christian Andersen',
            'Dante Alighieri',
            'Unknown',
            'Jane Austen',
            'Honor\\u00e9 de Balzac',
            'Samuel Beckett',
            'Giovanni Boccaccio',
            'Jorge Luis Borges',
            'Emily Bront\\u00eb',
            'Albert Camus',
            'Paul Celan',
            'Louis-Ferdinand C\\u00e9line',
            'Miguel de Cervantes',
            'Geoffrey Chaucer',
            'Anton Chekhov',
            'Joseph Conrad',
            'Charles Dickens',
            'Denis Diderot',
            'Alfred D\\u00f6blin',
            'Fyodor Dostoevsky',
            'George Eliot',
            'Ralph Ellison',
            'Euripides',
            'William Faulkner',
            'Gustave Flaubert',
            'Federico Garc\\u00eda Lorca',
            'Gabriel Garc\\u00eda M\\u00e1rquez',
            'Johann Wolfgang von Goethe',
            'Nikolai Gogol',
            'G\\u00fcnter Grass',
            'Jo\\u00e3o Guimar\\u00e3es Rosa',
            'Knut Hamsun',
            'Ernest Hemingway',
            'Homer',
            'Henrik Ibsen',
            'James Joyce',
            'Franz Kafka',
            'K\\u0101lid\\u0101sa',
            'Yasunari Kawabata',
            'Nikos Kazantzakis',
            'D. H. Lawrence',
            'Halld\\u00f3r Laxness',
            'Giacomo Leopardi',
            'Doris Lessing',
            'Astrid Lindgren',
            'Lu Xun',
            'Naguib Mahfouz',
            'Thomas Mann',
            'Herman Melville',
            'Michel de Montaigne',
            'Elsa Morante',
            'Toni Morrison',
            'Murasaki Shikibu',
            'Robert Musil',
            'Vladimir Nabokov',
            'George Orwell',
            'Ovid',
            'Fernando Pessoa',
            'Edgar Allan Poe',
            'Marcel Proust',
            'Fran\\u00e7ois Rabelais',
            'Juan Rulfo',
            'Rumi',
            'Salman Rushdie',
            'Saadi',
            'Tayeb Salih',
            'Jos\\u00e9 Saramago',
            'William Shakespeare',
            'Sophocles',
            'Stendhal',
            'Laurence Sterne',
            'Italo Svevo',
            'Jonathan Swift',
            'Leo Tolstoy',
            'Mark Twain',
            'Valmiki',
            'Virgil',
            'Vyasa',
            'Walt Whitman',
            'Virginia Woolf',
            'Marguerite Yourcenar',
        ];
    }
}
