# Фабрики

Если для получения сервиса необходимо его предварительно сконфигурировать, в 
хранилище можно зарегистрировать фабрику с помощью метода _factory_. Метод в 
качестве первого параметра принимает имя сервиса, под которым он будет 
зарегистрирован в хранилище, а в качестве второго - фабрику. При запросе сервиса 
зарегистрированного в виде фабрики, вызывается эта фабрика, которая должно 
подготовить и вернуть сервис. Фабрике в качестве первого параметра будет 
передано само хранилище. Фабрикой может быть:

- Анонимная функция
- Строка, содержащая имя глобальной функции
- Строка содержащая имя метода

В последнем случае необхомо так же передать третий параметр, определяющий 
контекст вызова метода. Этим параметром может быть:

- Объект
- Имя класса, который будет инстанциирован перед вызовом

Пример регистрации фабрики:

```php
use Bricks\ServiceLocator\Manager;

$manager = new Manager;
$manager->factory('service', function(Manager $manager){
  $service = new Service;
  // Конфигурация сервиса.
  return $service;
});
```

Важно отметить, что при каждом обращении к сервису, который конфигурируется с 
помощью фабрики, будет вызываться эта фабрика. Это означает что каждый раз будет 
либо повторно конфигурироваться сервис, либо создаваться новый сервис (если 
инстанциация сервиса выполняется в фабрике). Если необходимо зарегистрировать 
фабрику, которая должна единожды подготовить сервис, а затем использовать его же 
для всех последующих вызовов, следует передать в качестве четвертого параметра 
метода _factory_ значение true:

```php
use Bricks\ServiceLocator\Manager;

$manager = new Manager;
$count = 0;
$manager->factory('service', function(Manager $manager){
  global $count;
  $count++;
  return $count;
}, null, true);
echo $manager->get('service'); // 1
echo $manager->get('service'); // 1
```
