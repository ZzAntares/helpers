This library contains a set of helpers functions that I've used in some
projects.

# Installation

Recommended installation is using Composer, if you do not have Composer please
install it first.

In the root of your project execute the following:

```
$ composer require zzantares/helpers
```

Or add this to your `composer.json` file:

```
{
    "require": {
        "zzantares/helpers": "dev-master"
    }
}
```

Then perform the installation:

```
$ composer install
```


# Usage

```
require_once 'vendor/autoload.php';

$result = number_to_letter(1200);

var_dump($result);
```

The above code produces the following output:

```
string 'Doce mil pesos 12/100 M.N.' (length=26)
```

Other helper functions will be listed here.
