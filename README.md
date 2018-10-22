[![Build Status](https://travis-ci.org/icehawk/session-forms-bridge.svg?branch=master)](https://travis-ci.org/icehawk/session-forms-bridge)
[![Coverage Status](https://coveralls.io/repos/github/icehawk/session-forms-bridge/badge.svg?branch=master)](https://coveralls.io/github/icehawk/session-forms-bridge?branch=master)
[![Latest Stable Version](https://poser.pugx.org/icehawk/session-forms-bridge/v/stable)](https://packagist.org/packages/icehawk/session-forms-bridge) 
[![Total Downloads](https://poser.pugx.org/icehawk/session-forms-bridge/downloads)](https://packagist.org/packages/icehawk/session-forms-bridge) 
[![Latest Unstable Version](https://poser.pugx.org/icehawk/session-forms-bridge/v/unstable)](https://packagist.org/packages/icehawk/session-forms-bridge) 
[![License](https://poser.pugx.org/icehawk/session-forms-bridge/license)](https://packagist.org/packages/icehawk/session-forms-bridge)
[![phpstan enabled](https://img.shields.io/badge/phpstan-enabled-green.svg)](https://github.com/phpstan/phpstan)

# ![IceHawk Framework](https://icehawk.github.io/images/Logo-Flying-Tail-White.png)

# IceHawk\SessionFormsBridge

A bridge implementation to combine the IceHawk components Session and Forms.

This package provides one class named `AbstractSession` that extends the original `AbstractSession` class from the
[IceHawk Session component](https://github.com/icehawk/session) to combine it with the 
[IceHawk Forms component](https://github.com/icehawk/forms).

This bridge package is intended to be used to 

- reduce the dependency definitions in the `composer.json`
- Add relevant methods to retrieve or unset `Form` instances

## Added methods

```php
public function getForm( IdentifiesForm $formId ) : Form
```

This method returns a new or existing `Form` instance from the session wrapper an guaranties that you always get the same instance for the same `$formId`.

```php
public function unsetForm( IdentifiesForm $formId )
```

This method removes an existing `Form` instance from the session data.

```php
public function unsetAllForms()
```

This method removes all existing `Form` instances from the session data.

## More documentation

Read more about the IceHawk components Session and Forms in our documentation at **[icehawk.github.io](https://icehawk.github.io)**.
