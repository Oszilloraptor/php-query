<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

## [0.1.2](https://github.com/RiktaD/php-query/compare/v0.1.1...v0.1.2) (2021-09-28)
---

## [0.1.1](https://github.com/RiktaD/php-query/compare/v0.1.0...v0.1.1) (2021-09-28)
---

## [0.1.0](https://github.com/RiktaD/php-query/compare/d65e1955ca44bc3bc25b650eedf02cbc19382263...v0.1.0) (2021-09-28)
### Features

#### General Logic
* Implement PathGetter ([67c257](https://github.com/RiktaD/php-query/commit/67c2578f00301ab6dd22e2f257bd784ed8b34e4f))
* Implement Query & QueryInterface ([6141d1](https://github.com/RiktaD/php-query/commit/6141d107e4b20b705394033dca572b7e3fe15e92))
* Implement QueryResult ([a4f6a7](https://github.com/RiktaD/php-query/commit/a4f6a77b11a0db97cc7ecb96f95f63b6e6a8ca3d))
* Implement Operations ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))

##### Implemented Filter Operations
* Implement Equals-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement Filter-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement GreaterThan-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement GreaterThanOrEqual-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement Identical-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement InArray-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsArray-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsEmpty-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsFalse-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsFalsy-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsInt-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsNull-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsNumeric-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsObject-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsScalar-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsString-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsTrue-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsTruthy-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsValidDirectory-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement IsValidFilePath-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement LessThan-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement LessThanOrEqual-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement LessThanOrEqualToOrGreaterThan-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement NotEqual-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement NotIdentical-Filter-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))

##### Implemented Juggling Operations
* Implement Limit-Juggling-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement Reverse-Juggling-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement Sort-Juggling-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement Unique-Juggling-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))

##### Implemented Replacement Operations
* Implement Map-Replacement-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement MapToKey-Replacement-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement MapToValue-Replacement-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement MultiMap-Replacement-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))

##### Implemented Modification Operations
* Implement Flip-Modification-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement Not-Modification-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))
* Implement OnPathValue-Modification-Operation ([1312a8](https://github.com/RiktaD/php-query/commit/1312a8e5338637dd6dde5820d4d2aa7ad6f83f44))

---
