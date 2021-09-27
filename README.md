# PhpQuery

Fluently Query a repository or array for data.

## Installation 

`composer require rikta/query`

## Usage

### Example 

The `examples`-directory contains several examples
(those are part of a testsuite and therefore guaranteed to work)

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

**Examples:**

- only show keys from provided array
- only show value which is bigger than two

#### Replacement

Replaces the keys/values, e.g. with a value from a path or with the result of a callable

**Examples:**

- replace the returned values with $value['something'][0]
- replace the keys in the result with each valued $value['id']

#### Juggling

Modifies the arrays order and bounds, but not the values themselves (Except maybe discarding them)

**Examples:**

- sort in ascending order of value
- sort in descending order of keys
- limit to 20 results

#### Modification

Modifies another Operation

**Examples:**

- inverting a filter (keep what would have been thrown away and vice versa)
- comparing a subvalue instead of a value

## Why the name?

The initial name was just "Query", but during development I ended up with Namespaces like
`Rikta\Query\Query\Query`, so I renamed the project to mitigate this redundancy a bit.

I'm open for any suggestions on a better name ;)
