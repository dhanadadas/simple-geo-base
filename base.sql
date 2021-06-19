CREATE TABLE `country` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

CREATE TABLE `region` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `country_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

CREATE TABLE  `city` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `region_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Украина');

INSERT INTO `region` (`id`, `country_id`, `name`) VALUES
(1, 1, 'Киевская область'),
(2, 1, 'Амурская область');

INSERT INTO `city` (`id`, `region_id`, `name`) VALUES
(1, 1, 'Киев'),
(2, 2, 'Благовещенск');