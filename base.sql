CREATE TABLE IF NOT EXISTS `country` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

CREATE TABLE IF NOT EXISTS `region` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `country_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  KEY `index_foreignkey_region_country` (`country_id`),
  CONSTRAINT `c_fk_region_country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

CREATE TABLE IF NOT EXISTS `city` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `region_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  KEY `index_foreignkey_city_region` (`region_id`),
  CONSTRAINT `c_fk_city_region_id` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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