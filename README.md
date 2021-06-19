# Simple Geo Base (Native php-sql)

База данных + зависимая выборка страна>регион>город по выпадающему списку

Проект сделан на native php (желательно>7.0) и Vanilla JS.
Сначало сделал на jquery, потом решил сделать полностью нативный каркас.
С дизайном не работал.
 
 ([РАБОЧИЙ ДЕМО](http://j962903f.beget.tech/geobase/)) 


 ## Окружение
 PHP >5.6 (желательно >7.0)
 
  ## Инициализация класса
  ```php
 $geoBase = new geoBase();
  ```
 
 ## Настойка базы данных
```php
 $geoBase->sql_host = "localhost";
 $geoBase->sql_user = "root";
 $geoBase->sql_pass = "pass";
 $geoBase->sql_database = "geoBase";
   ```
## Методы класса geoBase
Импорт [таблиц и данных](https://github.com/dhanadadas/simple-geo-base/blob/main/base.sql)

  ```php
$geoBase->createDB(); 
  ```

Получить города, пример (JSON)
  ```php
echo $geoBase->getCountry();
  ```

Получить регионы, пример (JSON)
  ```php
echo $geoBase->getRegion(2);// ID_Country:2
  ```

Получить регионы, пример (JSON)
  ```php
echo $geoBase->getCity(1);// ID_Region:1
  ```

### Структура базы данных
  ```sql
CREATE TABLE `country` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

CREATE TABLE `region` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `country_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  KEY `index_foreignkey_region_country` (`country_id`),
  CONSTRAINT `c_fk_region_country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

CREATE TABLE `city` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `region_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  KEY `index_foreignkey_city_region` (`region_id`),
  CONSTRAINT `c_fk_city_region_id` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
  ```

### Данные SQL
  ```sql

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Украина');

INSERT INTO `region` (`id`, `country_id`, `name`) VALUES
(1, 2, 'Киевская область'),
(2, 1, 'Амурская область'),
(3, 2, 'Донецкая область'),
(4, 1, 'Ленинградская область');

INSERT INTO `city` (`id`, `region_id`, `name`) VALUES
(1, 1, 'Киев'),
(2, 1, 'Житомир'),
(3, 1, 'Борисполь'),
(4, 3, 'Донецк'),
(5, 3, 'Мариуполь'),
(6, 3, 'Макеевка'),
(7, 2, 'Благовещенск'),
(8, 2, 'Белогорск'),
(9, 4, 'Санкт Петербург'),
(10, 4, 'Гатчина'),
(11, 2, 'Тында'),
(12, 4, 'Луга');
  ```

### Клон данного репозитория:
```git
git clone https://github.com/dhanadadas/simple-geo-base.git
```

### Отдельная задача: простая респонсивная верстка
[Респонсивная таблица](https://dhanadadas.github.io/simple-geo-base/adaptiveTable/)
([код](https://github.com/dhanadadas/simple-geo-base/tree/main/adaptiveTable))
