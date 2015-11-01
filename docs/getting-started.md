# Введение

Данный пакет служит для регистрации с целью дальнейшего доступа к сервисам 
системы. Сервис регистрируется в хранилище под определенным именем, по которому 
он может быть доступен в будущем, на пример:

```php
use Bricks\ServiceLocator\Manager;

$manager = new Manager;
$manager->set('service', new Service);
...
$service = $manager->get('service');
```
