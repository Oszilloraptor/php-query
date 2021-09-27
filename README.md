# PhpQuery

Fluently Query a repository or array for items that match certain criteria and arrange
the results in a particular order.

Like a low-budget php version of SQL where budget wasn't even enough for a database
and we have to be happy with an in-session-memory.

Contrary to the proper db-based libraries this one works on anything that can be represented
inside a key-value store or array.

Just wrap a collection of something (Arrays, Files in a Directory, a decoded CSV-File)
into a [rikta/repository](https://packagist.org/packages/rikta/repository) and 
fire a query on it.

You could also store the query on a variable and then call it for different repositories, or use it as a configurable getter.

_(For your convenience you can also pass an array; it will be converted into an ArrayRepository automatically)_

## Installation 

`composer require rikta/php-query`

No config, no dependency-injection, nothing. Plug&Play!

## Usage

1. Create a new query object, e.g. `$query = new Query();`
2. Add some operations, e.g. `$query->not()->isNull()->sort()->limit(10)`
3. Get your result-object, e.g. `$result = $query->getResults()`
4. Get your items from the result, e.g. `return $result->toArray()` (with keys) or `return $result->getItems()` (without keys)

### Example 

The `examples`-directory contains several examples
(those are part of a testsuite and therefore guaranteed to work)

One of the rather verbose ones, 
it uses a list of 100 popular classical books as input and finds the three biggest english books after 1900 mapped
to their authors

```php
$query = (new \Rikta\PhpQuery\Query())
    ->onPathValue('.year')->greaterThanOrEqual(1900) // only books after 1900
    ->onPathValue('.language')->identical('English') // only books in english
    ->onPathValue('.pages')->sort(static fn ($a, $b) => $b <=> $a) // sort by pages, in descending order
    ->limit(3) // limit the results to three
    ->onPathValue('.title')->mapToKey() // set the key to $value['title']
    ->onPathValue('.author')->mapToValue() // set the value to $value['author']
    ->sort();
    
$results = $query
    ->getResultsFor(new \Rikta\PhpQuery\Examples\_Data\BookDataRepository())
    ->toArray();

\PHPUnit\Framework\assertEquals([
            'The Golden Notebook' => 'Doris Lessing',
            'Tales' => 'Edgar Allan Poe',
            'Invisible Man' => 'Ralph Ellison',
        ], $results);
```

## Operations

Operations are invokable objects (= callables with a state, you could say)
that
- get all the data they need at construction time, maybe even other operations
- get an array of items at invocation
- do something with the passed $items
- return it for the next operation to modify

Operations are divided into multiple categories.
Every operation will retain the initial keys in its return
(unless specifically instructed otherwise).

### QueryOperation Categories:

#### Filter

Filters the keys/values, e.g. against an array of a callable

Check [_FilterOperationMethodsInterface](src/Operation/Filter/_FilterOperationMethodsInterface.php) for an up-to-date
overview of all implemented filter-methods

**Examples:**

- only show keys from provided array
- only show value which is bigger than two

#### Juggling

Modifies the arrays order and bounds, but not the values themselves (Except maybe discarding them)


Check [_JugglingOperationMethodsInterface](src/Operation/Juggling/_JugglingOperationMethodsInterface.php) for an up-to-date
overview of all implemented filter-methods

**Examples:**

- sort in ascending order of value
- sort in descending order of keys
- limit to 20 results

#### Modification

Modifies another Operation

Check [_ModificationOperationMethodsInterface](src/Operation/Modification/_ModificationOperationMethodsInterface.php) for an up-to-date
overview of all implemented filter-methods

**Examples:**

- inverting a filter (keep what would have been thrown away and vice versa)
- comparing a subvalue instead of a value

#### Replacement

Replaces the keys/values, e.g. with a value from a path or with the result of a callable

Check [_ReplacementOperationMethodsInterface](src/Operation/Replacement/_ReplacementOperationMethodsInterface.php) for an up-to-date
overview of all implemented filter-methods

**Examples:**

- replace the returned values with $value['something'][0]
- replace the keys in the result with each valued $value['id']

## Why the name?

The initial name was just "Query", but during development I ended up with Namespaces like
`Rikta\Query\Query\Query`, so I renamed the project to mitigate this redundancy a bit.

I'm open for any suggestions on a better name ;)
