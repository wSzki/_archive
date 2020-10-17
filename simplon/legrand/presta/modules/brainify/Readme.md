# Brainify Prestashop plugin

## Releasing a new version

To release a new version, you have to update version number in `config.xml` and `classes\config.php`.

`config.xml`:

```xml
<?xml version="1.0" encoding="UTF-8" ?>
<module>
    <!-- ... -->
    <version><![CDATA[3.0.1]]></version>
    <!-- ... -->
</module>
```

`classes\config.php`:

```php
class Brainify_Config {

    const BRAINIFY_PLUGIN_VERSION = "3.0.1";
    ...
}
```

`brainify.php`:

```php
class Brainify extends Module
{
    ...
    $this->version = '3.0.1';
    ...
}
```

After that, you can merge to master and use Bamboo to deploy the new version.

Configuration keys and values (i.e. api endpoints) are stored in file `classes\config.php`.

```php
    const BRAINIFY_API_URL = "http://devapi.brainify.it";
    const BRAINIFY_API_USERS = "/users/beta";
    const BRAINIFY_API_SITES = "/sites2/beta";
    const BRAINIFY_API_AUTH = "/auth/beta";
```
