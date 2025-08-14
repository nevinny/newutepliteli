# ************************************************************
# Sequel Ace SQL dump
# Версия 20080
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Хост: localhost (MySQL 9.1.0)
# База данных: admintdst_newutp
# Время формирования: 2025-08-08 13:48:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы brand
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brand`;

CREATE TABLE `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;

INSERT INTO `brand` (`id`, `slug`, `title`, `parent`, `ord`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`, `description`, `url`, `logo`)
VALUES
	(2,'rookwool','ROOKWOOL',98,0,NULL,NULL,NULL,'active','2025-07-24 17:53:44','2025-07-25 12:51:53','<div>Компания представлена тремя брендами:</div><div><br>РОКВУЛ – современные надежные тепло- и звукоизоляционные материалы из каменной ваты. Продукция применяется для утепления, звукоизоляции, огнезащиты и предназначена для всех видов зданий и сооружений, промышленного оборудования, трубопроводов и воздуховодов.<br><br></div><div><br>Рокфон – крупнейший бренд акустических решений – потолочных и стеновых панелей из каменной ваты. Продукция применяется для звукоизоляции и создания акустического комфорта внутри общественных объектов, офисов, промышленных предприятий, зданий здравоохранения и образования.<br><br></div><div><br>Гродан – инновационные и экологичные решения с использованием субстратов из каменной ваты для профессионального растениеводства, основанные на принципах Точного выращивания. Эти решения используются для выращивания овощей и цветов.</div>','https://rwl.ru/','rockwool-68837de9a9115529086909.png'),
	(3,'tehnonikol','Технониколь',98,0,NULL,NULL,NULL,'active','2025-07-24 17:54:13','2025-07-25 13:02:42','<div>Торговая Сеть ТЕХНОНИКОЛЬ (ТСТН) — крупнейшая торговая компания, управляющая сетью из 100+ собственных торговых отделений, расположенных в России, Беларуси и Казахстане. Сеть реализует как продукцию корпорации ТЕХНОНИКОЛЬ, неотъемлемой частью которой является, так и широкий ассортимент строительных и отделочных материалов для промышленного, гражданского и частного домостроения от известных производителей.<br><br></div><div>Компания основана в 1992-м году Сергеем Колесниковым и Игорем Рыбаковым.<br><br></div><div><br>Преимущества<br><br></div><ul><li>накопленный и проработанный за 30 лет опыт комплектации объектов разного уровня сложности, обеспечивающий гарантии и уверенность в высоком уровне профессионализма и ответственности в подходе к деятельности;</li><li>сбалансированный ассортимент от известных производителей и собственная торговая марка TSTN, в полной мере отвечающая потребностям клиентов компании;</li><li>сервисы по расчету, оплате, доставке и возврату товара, делающие сотрудничество с компанией взаимовыгодным и комфортным.</li></ul>','https://www.tstn.ru','tn-688380720aea9828848700.png'),
	(4,'bitex','Bitex',98,0,NULL,NULL,NULL,'disabled','2025-07-24 17:54:34','2025-07-25 13:02:59',NULL,NULL,'bitex-68838083f33d2299924076.png'),
	(5,'brane','Brane',98,0,NULL,NULL,NULL,'disabled','2025-07-24 17:54:53','2025-07-25 13:03:09',NULL,NULL,'brane-6883808d2a8b5268382487.png'),
	(6,'taleon','Taleon',98,0,NULL,NULL,NULL,'disabled','2025-07-24 17:55:06','2025-07-25 13:03:52',NULL,NULL,'ultralam-688380b827a3a903346896.png'),
	(7,'paroc','Paroc',98,0,NULL,NULL,NULL,'disabled','2025-07-24 17:55:18','2025-07-25 13:04:00',NULL,NULL,'paroc-688380c0a340a082201698.jpg'),
	(8,'baumit','Baumit',98,0,NULL,NULL,NULL,'disabled','2025-07-24 17:55:33','2025-07-25 13:04:08',NULL,NULL,'baumit-688380c89c3bd788547686.png'),
	(9,'penopleks','Пеноплекс',98,0,NULL,NULL,NULL,'active','2025-07-24 17:55:50','2025-07-25 13:04:17','<div>Компания «ПЕНОПЛЭКС» начала свою деятельность в 1998 году с запуска первой в России производственной линии по изготовлению теплоизоляционных материалов из экструзионного пенополистирола под торговой маркой ПЕНОПЛЭКС®. Сегодня в составе компании тринадцать заводов: десять расположены в российских городах и три завода за рубежом. Производственные площадки компании оснащены современными лабораториями, где тестируется каждая партия материалов.<br><br>В портфеле компании такие широко известные торговые марки как ПЕНОПЛЭКС® — теплоизоляционные материалы, PLASTFOIL® — гидроизоляционные материалы, СТАЙРОВИТ® — полистирол общего назначения, ПЛИНТЭКС® — декоративно-отделочные материалы из полистирола, а также гидроизоляционные материалы марки PLASTGUARD®, крепежные элементы PROPLUG® и широкий перечень прочих комплектующих для эффективных системных решений.</div>','https://www.penoplex.ru','penoplex-688380d1438fe071273458.png'),
	(10,'knauf','Knauf',98,0,NULL,NULL,NULL,'active','2025-07-24 17:56:07','2025-07-25 13:05:02','<div>КНАУФ — это мировой бренд в сфере строительства, внутренней отделки и дизайна с мощной научно-производственной базой в России. В сотрудничестве с нашими партнерами, обеспечивающими широкую дистрибуцию продукции КНАУФ, на протяжении трех десятилетий мы предлагаем корпоративному и частному заказчику передовые технологические решения в области сухого строительства и отделки помещений, тепло- и звукоизоляции, а также потолочные и стеновые модульные конструкции. Объединяя мировую экспертизу и локальное производство, мы делаем высокое качество доступным.<br><br></div><div>КНАУФ – пионер технологии сухого строительства и применения гипсовых строительных смесей, крупнейший в России производитель строительных отделочных материалов из гипса*. Обучение на базе Академии КНАУФ и индивидуальное консультирование на объектах являются неотъемлемой частью нашего бизнеса. Академия КНАУФ принадлежит к разработчикам стандартов профессий «Мастер каркасно-обшивных конструкции» и «Штукатур».<br><br></div><div>Строительные материалы, которые компания производит в России, закрывают все потребности наших клиентов в отделке помещений. Более того, в подмосковном Красногорске на базе первого российского предприятия КНАУФ создан один из лучших в отрасли научно-исследовательских центров, что позволяет нам адаптировать рецептуры и создавать продукты на уровне лучших мировых образцов.<br><br></div><div>На 20 собственных предприятиях в России мы производим продукцию высшего качества для местного рынка из местного сырья. Поддержание стабильно высокого качества продукции и экологическая ответственность стали приоритетами нашего бизнеса. Мы максимально ответственно относимся к процессам добычи гипса и его транспортировки, сводим к минимуму все виды потерь при производстве, используем самую совершенную технику и технологии. Минеральную вату мы производим по технологии ECOSE на основе натуральных компонентов без применения фенолформальдегидных и акриловых смол. В технологии ECOSE они заменены на растительное связующее. Мы первыми в России сертифицировали гипсовые строительные плиты по системе «Лесной эталон». Наша продукция экологична и безопасна.<br><br></div><blockquote><em>* По данным исследования «Рынок гипса и гипсовых строительных материалов России» (ЗАО «Промстройинформ», 2024 г.)</em></blockquote>','https://www.knauf.ru','knauf-688380fe434e8613761250.png');

/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы brand_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brand_list`;

CREATE TABLE `brand_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `brand_list` WRITE;
/*!40000 ALTER TABLE `brand_list` DISABLE KEYS */;

INSERT INTO `brand_list` (`id`, `slug`, `title`, `parent`, `ord`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`, `description`)
VALUES
	(2,'brands','Бренды',0,0,NULL,NULL,NULL,'active','2025-07-24 17:42:55','2025-07-24 17:42:55','<div>Наш интернет-магазин является официальным дилером представленных торговых марок. Это означает, что вся продукция действительно фирменная, никакого «серого импорта», на все товары распространяется гарантия производителя, цены в нашем магазине соответствуют, рекомендованным производителем.</div>');

/*!40000 ALTER TABLE `brand_list` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы cart
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `IDX_BA388B7A76ED395` (`user_id`),
  CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;

INSERT INTO `cart` (`id`, `user_id`, `created_at`, `updated_at`, `status`)
VALUES
	(6,3,'2025-08-06 21:17:57','2025-08-06 21:17:57','active');

/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы cart_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cart_item`;

CREATE TABLE `cart_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_F0FE25271AD5CDBF` (`cart_id`),
  KEY `IDX_F0FE25273B69A9AF` (`variant_id`),
  CONSTRAINT `FK_F0FE25271AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  CONSTRAINT `FK_F0FE25273B69A9AF` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `cart_item` WRITE;
/*!40000 ALTER TABLE `cart_item` DISABLE KEYS */;

INSERT INTO `cart_item` (`id`, `cart_id`, `variant_id`, `quantity`, `created_at`, `updated_at`)
VALUES
	(2,6,60,4,'2025-08-06 21:17:57','2025-08-06 21:17:57'),
	(3,6,61,1,'2025-08-07 10:39:01','2025-08-07 10:39:01');

/*!40000 ALTER TABLE `cart_item` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `slug`, `title`, `parent`, `ord`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`, `external_id`)
VALUES
	(9,'teploizolyaciya','Теплоизоляция',8,0,NULL,NULL,NULL,'active','2025-07-09 15:41:45','2025-07-09 15:41:45',NULL),
	(10,'gidroizolyaciya','Гидроизоляция',8,0,NULL,NULL,NULL,'active','2025-07-10 14:28:38','2025-07-10 14:28:38',NULL),
	(11,'zvukoizolyaciya','Звукоизоляция',8,0,NULL,NULL,NULL,'active','2025-07-10 14:29:33','2025-07-10 14:29:33','36a0121f-99de-11ea-81fd-001e671f818d'),
	(12,'paroizolyaciya','Пароизоляция',8,0,NULL,NULL,NULL,'active','2025-07-10 14:29:58','2025-07-10 14:29:58','b475ba7e-0257-11eb-9daf-001e671f818d'),
	(13,'vetro-vlagozashita','Ветро-влагозащита',8,0,NULL,NULL,NULL,'active','2025-07-10 14:30:22','2025-07-10 14:30:22','c535a9bc-990e-11ea-81fd-001e671f818d'),
	(14,'tehnicheskaya-izolyaciya','Техническая изоляция',8,0,NULL,NULL,NULL,'active','2025-07-10 14:30:42','2025-07-10 14:30:42','6b9f760d-f119-11eb-951b-001e671f818d'),
	(15,'uteplenie-fasadov','Утепление фасадов',8,0,NULL,NULL,NULL,'disabled','2025-07-10 14:31:04','2025-07-10 14:31:04',NULL),
	(16,'drevesno-struzhechnye-plity','Древесно-стружечные плиты',8,0,NULL,NULL,NULL,'active','2025-07-10 14:31:27','2025-07-10 14:31:27','f7d382a4-0254-11eb-9daf-001e671f818d'),
	(17,'krepyozh','Крепёж',8,0,NULL,NULL,NULL,'active','2025-07-10 14:31:44','2025-07-10 14:31:44',NULL),
	(18,'smesi-kraski-i-gruntovki','Смеси, краски и грунтовки',8,0,NULL,NULL,NULL,'active','2025-07-10 14:32:07','2025-07-10 14:32:07',NULL),
	(19,'peny-i-germetiki','Пены и герметики',8,0,NULL,NULL,NULL,'active','2025-07-10 14:32:30','2025-07-10 14:32:30',NULL),
	(20,'bazaltovyj-uteplitel','Базальтовый утеплитель',9,0,NULL,NULL,NULL,'active','2025-07-10 14:33:03','2025-07-10 14:33:03','6eef0d4c-8855-11ea-b94f-001e671f818d'),
	(21,'ekstruzionnyj-penopolistirol','Экструзионный пенополистирол',9,0,NULL,NULL,NULL,'active','2025-07-10 16:07:16','2025-07-10 16:07:16','1158cae5-8566-11ea-ab6b-001e671f818d'),
	(22,'mineralnaya-vata','Минеральная вата',9,0,NULL,NULL,NULL,'active','2025-07-10 16:07:38','2025-07-10 16:07:38','3412b4ad-0257-11eb-9daf-001e671f818d'),
	(23,'bitumnye-rulonnye-materialy','Битумные рулонные материалы',10,0,NULL,NULL,NULL,'active','2025-07-10 16:20:11','2025-07-10 16:20:11','374dd8f8-885a-11ea-b94f-001e671f818d'),
	(24,'cilindry','Цилиндры',14,0,NULL,NULL,NULL,'active','2025-07-10 16:20:56','2025-07-10 16:20:56',NULL),
	(25,'kraski','Краски',18,0,NULL,NULL,NULL,'active','2025-07-10 16:21:45','2025-07-10 16:21:45','1be4f441-0256-11eb-9daf-001e671f818d'),
	(26,'gruntovki','Грунтовки',18,0,NULL,NULL,NULL,'active','2025-07-10 16:22:17','2025-07-10 16:22:17','32ea9739-0254-11eb-9daf-001e671f818d'),
	(27,'shtukaturki','Штукатурки',18,0,NULL,NULL,NULL,'active','2025-07-10 16:22:39','2025-07-10 16:22:39','ed94059b-025c-11eb-9daf-001e671f818d'),
	(28,'klei','Клеи',18,0,NULL,NULL,NULL,'active','2025-07-10 16:23:03','2025-07-10 16:23:03','9dc6b6d2-0255-11eb-9daf-001e671f818d');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `addr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordinates` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;

INSERT INTO `contacts` (`id`, `addr`, `phone`, `email`, `work_hours`, `coordinates`, `slug`, `title`, `parent`, `ord`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`)
VALUES
	(21,'Москва, Новочерёмушкинская улица, 69Б','+7(495) 545-39-00','shop@utepliteli.org','Пн - Пт: 9.00 - 18.00<br>Сб - Вс: выходные','7ce02a5c97f6461158d06421a049419a65f1d309fae40176652ccb12f72f4a93','contacts','Контакты',0,0,NULL,NULL,NULL,'active','2025-07-23 17:15:59','2025-07-23 17:15:59');

/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы doctrine_migration_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `doctrine_migration_versions`;

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`)
VALUES
	('DoctrineMigrations\\Version20250702110816','2025-07-02 11:08:25',311),
	('DoctrineMigrations\\Version20250702111251','2025-07-02 11:13:11',21),
	('DoctrineMigrations\\Version20250707120713','2025-07-07 12:07:50',104),
	('DoctrineMigrations\\Version20250707122624','2025-07-07 12:26:30',28),
	('DoctrineMigrations\\Version20250707133937','2025-07-07 13:39:57',47),
	('DoctrineMigrations\\Version20250709090217','2025-07-09 09:02:22',29),
	('DoctrineMigrations\\Version20250710094907','2025-07-10 09:49:24',66),
	('DoctrineMigrations\\Version20250710103002','2025-07-10 10:30:11',45),
	('DoctrineMigrations\\Version20250719121004','2025-07-19 12:10:10',33),
	('DoctrineMigrations\\Version20250719164154','2025-07-19 16:42:13',59),
	('DoctrineMigrations\\Version20250719164318','2025-07-19 16:43:21',20),
	('DoctrineMigrations\\Version20250719170255','2025-07-19 17:02:58',19),
	('DoctrineMigrations\\Version20250719172031','2025-07-19 17:20:52',35),
	('DoctrineMigrations\\Version20250719173547','2025-07-19 17:36:33',20),
	('DoctrineMigrations\\Version20250719174154','2025-07-19 17:42:10',17),
	('DoctrineMigrations\\Version20250719175421','2025-07-19 17:54:41',45),
	('DoctrineMigrations\\Version20250719180042','2025-07-19 18:00:45',26),
	('DoctrineMigrations\\Version20250719202203','2025-07-19 20:24:07',28),
	('DoctrineMigrations\\Version20250720155812','2025-07-20 17:47:51',43),
	('DoctrineMigrations\\Version20250720174549','2025-07-20 17:49:42',5),
	('DoctrineMigrations\\Version20250720182504','2025-07-20 18:25:15',25),
	('DoctrineMigrations\\Version20250722162559','2025-07-22 16:26:06',28),
	('DoctrineMigrations\\Version20250723112750','2025-07-23 11:27:57',29),
	('DoctrineMigrations\\Version20250723113733','2025-07-23 11:37:37',40),
	('DoctrineMigrations\\Version20250723175524','2025-07-23 17:55:30',74),
	('DoctrineMigrations\\Version20250723180931','2025-07-23 18:11:29',52),
	('DoctrineMigrations\\Version20250723183758','2025-07-23 18:38:04',30),
	('DoctrineMigrations\\Version20250724165713','2025-07-24 16:57:18',21),
	('DoctrineMigrations\\Version20250724173045','2025-07-24 17:30:50',24),
	('DoctrineMigrations\\Version20250724183021','2025-07-24 18:30:27',31),
	('DoctrineMigrations\\Version20250724213202','2025-07-24 21:32:06',30),
	('DoctrineMigrations\\Version20250725141515','2025-07-25 14:15:21',26),
	('DoctrineMigrations\\Version20250729144354','2025-07-29 14:44:00',66),
	('DoctrineMigrations\\Version20250730194915','2025-07-30 19:49:20',63),
	('DoctrineMigrations\\Version20250731171624','2025-07-31 17:16:31',51),
	('DoctrineMigrations\\Version20250731171837','2025-07-31 17:18:42',19),
	('DoctrineMigrations\\Version20250801131444','2025-08-01 13:14:51',66),
	('DoctrineMigrations\\Version20250801132930','2025-08-01 13:29:41',32),
	('DoctrineMigrations\\Version20250803103434','2025-08-03 10:34:39',52),
	('DoctrineMigrations\\Version20250803175512','2025-08-03 17:55:35',74),
	('DoctrineMigrations\\Version20250803183708','2025-08-03 18:37:16',54),
	('DoctrineMigrations\\Version20250803185822','2025-08-03 18:58:29',59),
	('DoctrineMigrations\\Version20250804182634','2025-08-04 18:26:40',68),
	('DoctrineMigrations\\Version20250804182943','2025-08-04 18:29:49',73),
	('DoctrineMigrations\\Version20250807103513','2025-08-07 10:35:20',24);

/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы import_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `import_log`;

CREATE TABLE `import_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `done_count` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `import_log` WRITE;
/*!40000 ALTER TABLE `import_log` DISABLE KEYS */;

INSERT INTO `import_log` (`id`, `type`, `file_path`, `done_count`, `created_at`, `updated_at`)
VALUES
	(2,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-01 13:39:07','2025-08-01 13:39:07'),
	(3,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-01 13:39:24','2025-08-01 13:39:24'),
	(4,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-01 13:39:42','2025-08-01 13:39:42'),
	(5,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 10:48:28','2025-08-03 10:48:28'),
	(6,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 12:09:25','2025-08-03 12:09:25'),
	(9,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 12:40:50','2025-08-03 12:40:50'),
	(10,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 12:58:15','2025-08-03 12:58:15'),
	(11,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 13:27:41','2025-08-03 13:27:41'),
	(12,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 13:39:39','2025-08-03 13:39:39'),
	(13,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 19:21:27','2025-08-03 19:21:27'),
	(14,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 19:26:20','2025-08-03 19:26:20'),
	(15,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 19:44:07','2025-08-03 19:44:07'),
	(16,'Product','/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/webdata/import0_1.xml',214,'2025-08-03 19:52:00','2025-08-03 19:52:00');

/*!40000 ALTER TABLE `import_log` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы main
# ------------------------------------------------------------

DROP TABLE IF EXISTS `main`;

CREATE TABLE `main` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord` int DEFAULT NULL,
  `is_node` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `entity_id` int NOT NULL,
  `entity_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `path_unique_idx` (`full_path`),
  KEY `IDX_BF28CD64727ACA70` (`parent_id`),
  KEY `IDX_BF28CD645681BEB0` (`entity_type_id`),
  CONSTRAINT `FK_BF28CD645681BEB0` FOREIGN KEY (`entity_type_id`) REFERENCES `section_type` (`id`),
  CONSTRAINT `FK_BF28CD64727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `main` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=384 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `main` WRITE;
/*!40000 ALTER TABLE `main` DISABLE KEYS */;

INSERT INTO `main` (`id`, `title`, `parent_id`, `slug`, `full_path`, `template`, `ord`, `is_node`, `created_at`, `updated_at`, `status`, `entity_id`, `entity_type_id`)
VALUES
	(1,'О компании',NULL,'about','/about','section/text',0,1,'2025-07-08 11:13:20','2025-07-08 11:13:20','active',1,1),
	(2,'Информация',NULL,'info','/info','section/text',0,1,'2025-07-08 11:14:09','2025-07-08 11:14:09','active',2,1),
	(3,'Помощь',NULL,'help','/help','section/text',0,1,'2025-07-08 11:14:31','2025-07-08 11:14:31','active',3,1),
	(4,'Новости',1,'news','/about/news','news/list',0,1,'2025-07-08 11:18:16','2025-07-08 11:18:16','active',4,2),
	(5,'Условия оплаты',2,'payment','/info/payment','section/text',0,0,'2025-07-08 11:21:05','2025-07-08 11:21:05','active',5,1),
	(6,'Условия доставки',2,'delivery','/info/delivery','section/text',0,0,'2025-07-08 11:32:14','2025-07-08 11:32:14','active',6,1),
	(7,'Гарантия на товар',2,'warranty','/info/warranty','section/text',0,0,'2025-07-08 11:37:23','2025-07-08 11:37:23','active',7,1),
	(8,'Каталог',NULL,'catalog','/catalog',NULL,0,1,'2025-07-09 15:38:52','2025-07-09 15:38:52','active',8,7),
	(9,'Теплоизоляция',8,'teploizolyaciya','/catalog/teploizolyaciya','catalog/category',0,1,'2025-07-09 15:41:45','2025-07-09 15:41:45','active',9,8),
	(10,'Гидроизоляция',8,'gidroizolyaciya','/catalog/gidroizolyaciya','catalog/category',0,1,'2025-07-10 14:28:38','2025-07-10 14:28:38','active',10,8),
	(11,'Звукоизоляция',8,'zvukoizolyaciya','/catalog/zvukoizolyaciya','catalog/category',0,1,'2025-07-10 14:29:33','2025-07-10 14:29:33','active',11,8),
	(12,'Пароизоляция',8,'paroizolyaciya','/catalog/paroizolyaciya','catalog/category',0,1,'2025-07-10 14:29:58','2025-07-10 14:29:58','active',12,8),
	(13,'Ветро-влагозащита',8,'vetro-vlagozashita','/catalog/vetro-vlagozashita','catalog/category',0,1,'2025-07-10 14:30:22','2025-07-10 14:30:22','active',13,8),
	(14,'Техническая изоляция',8,'tehnicheskaya-izolyaciya','/catalog/tehnicheskaya-izolyaciya','catalog/category',0,1,'2025-07-10 14:30:42','2025-07-10 14:30:42','active',14,8),
	(15,'Утепление фасадов',8,'uteplenie-fasadov','/catalog/uteplenie-fasadov','catalog/category',0,1,'2025-07-10 14:31:04','2025-07-10 14:31:04','disabled',15,8),
	(16,'Древесно-стружечные плиты',8,'drevesno-struzhechnye-plity','/catalog/drevesno-struzhechnye-plity','catalog/category',0,1,'2025-07-10 14:31:27','2025-07-10 14:31:27','active',16,8),
	(17,'Крепёж',8,'krepyozh','/catalog/krepyozh','catalog/category',0,1,'2025-07-10 14:31:44','2025-07-10 14:31:44','disabled',17,8),
	(18,'Смеси, краски и грунтовки',8,'smesi-kraski-i-gruntovki','/catalog/smesi-kraski-i-gruntovki','catalog/category',0,1,'2025-07-10 14:32:07','2025-07-10 14:32:07','active',18,8),
	(19,'Пены и герметики',8,'peny-i-germetiki','/catalog/peny-i-germetiki','catalog/category',0,1,'2025-07-10 14:32:30','2025-07-10 14:32:30','disabled',19,8),
	(20,'Базальтовый утеплитель',9,'bazaltovyj-uteplitel','/catalog/teploizolyaciya/bazaltovyj-uteplitel','catalog/category',0,1,'2025-07-10 14:33:03','2025-07-10 14:33:03','active',20,8),
	(21,'Экструзионный пенополистирол',9,'ekstruzionnyj-penopolistirol','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol','catalog/category',0,1,'2025-07-10 16:07:16','2025-07-10 16:07:16','active',21,8),
	(22,'Минеральная вата',9,'mineralnaya-vata','/catalog/teploizolyaciya/mineralnaya-vata','catalog/category',0,1,'2025-07-10 16:07:38','2025-07-10 16:07:38','active',22,8),
	(23,'Битумные рулонные материалы',10,'bitumnye-rulonnye-materialy','/catalog/gidroizolyaciya/bitumnye-rulonnye-materialy','catalog/category',0,1,'2025-07-10 16:20:11','2025-07-10 16:20:11','active',23,8),
	(24,'Цилиндры',14,'cilindry','/catalog/tehnicheskaya-izolyaciya/cilindry','catalog/category',0,1,'2025-07-10 16:20:56','2025-07-10 16:20:56','disabled',24,8),
	(25,'Краски',18,'kraski','/catalog/smesi-kraski-i-gruntovki/kraski','catalog/category',0,1,'2025-07-10 16:21:45','2025-07-10 16:21:45','active',25,8),
	(26,'Грунтовки',18,'gruntovki','/catalog/smesi-kraski-i-gruntovki/gruntovki','catalog/category',0,1,'2025-07-10 16:22:17','2025-07-10 16:22:17','active',26,8),
	(27,'Штукатурки',18,'shtukaturki','/catalog/smesi-kraski-i-gruntovki/shtukaturki','catalog/category',0,1,'2025-07-10 16:22:39','2025-07-10 16:22:39','active',27,8),
	(28,'Клеи',18,'klei','/catalog/smesi-kraski-i-gruntovki/klei','catalog/category',0,1,'2025-07-10 16:23:03','2025-07-10 16:23:03','active',28,8),
	(95,'тесту',4,'testu','/about/news/testu','news/item',NULL,0,'2025-07-23 17:09:44','2025-07-23 17:09:44','active',3,10),
	(96,'Контакты',NULL,'contacts','/contacts','contacts/list.html.twig',0,1,'2025-07-23 17:15:59','2025-07-23 17:15:59','active',21,5),
	(97,'Москва',110,'moscow','/contacts/stores/moscow','store/item.html.twig',0,1,'2025-07-23 18:22:39','2025-07-23 18:22:39','active',1,13),
	(98,'Бренды',2,'brands','/info/brands','brands/list',0,1,'2025-07-24 17:42:55','2025-07-24 17:42:55','active',2,14),
	(99,'ROOKWOOL',98,'rookwool','/info/brands/rookwool','brands/item',0,0,'2025-07-24 17:53:44','2025-07-24 17:53:44','active',2,15),
	(100,'Технониколь',98,'tehnonikol','/info/brands/tehnonikol','brands/item',0,0,'2025-07-24 17:54:13','2025-07-24 17:54:13','active',3,15),
	(101,'Bitex',98,'bitex','/info/brands/bitex','brands/item',0,0,'2025-07-24 17:54:34','2025-07-24 17:54:34','active',4,15),
	(102,'Brane',98,'brane','/info/brands/brane','brands/item',0,0,'2025-07-24 17:54:53','2025-07-24 17:54:53','active',5,15),
	(103,'Taleon',98,'taleon','/info/brands/taleon','brands/item',0,0,'2025-07-24 17:55:06','2025-07-24 17:55:06','active',6,15),
	(104,'Paroc',98,'paroc','/info/brands/paroc','brands/item',0,0,'2025-07-24 17:55:18','2025-07-24 17:55:18','active',7,15),
	(105,'Baumit',98,'baumit','/info/brands/baumit','brands/item',0,0,'2025-07-24 17:55:33','2025-07-24 17:55:33','active',8,15),
	(106,'Пеноплекс',98,'penopleks','/info/brands/penopleks','brands/item',0,0,'2025-07-24 17:55:50','2025-07-24 17:55:50','active',9,15),
	(107,'Knauf',98,'knauf','/info/brands/knauf','brands/item',0,0,'2025-07-24 17:56:07','2025-07-24 17:56:07','active',10,15),
	(108,'Санкт-Петербург',110,'sankt-peterburg','/contacts/stores/sankt-peterburg','store/item.html.twig',0,1,'2025-07-25 14:02:20','2025-07-25 14:02:20','active',2,13),
	(109,'Политика конфидинциальности',2,'privacy','/info/privacy',NULL,0,0,'2025-07-25 14:07:12','2025-07-25 14:07:12','active',51,1),
	(110,'Магазины',96,'stores','/contacts/stores','store/list',0,1,'2025-07-25 14:17:16','2025-07-25 14:17:16','active',1,16),
	(111,'ТДСТ Изоляция ЮГ',110,'rostov-na-donu','/contacts/stores/rostov-na-donu','store/item.html.twig',0,1,'2025-07-28 14:06:50','2025-07-28 14:06:50','active',3,13),
	(112,'ТДСТ Изоляция Тверь',110,'tver','/contacts/stores/tver','store/item.html.twig',0,1,'2025-07-28 14:07:38','2025-07-28 14:07:38','active',4,13),
	(113,'ТДСТ Изоляция Краснодар',110,'krasnodar','/contacts/stores/krasnodar','store/item.html.twig',0,1,'2025-07-28 14:10:33','2025-07-28 14:10:33','active',5,13),
	(114,'Регистрация',NULL,'registration','/registration',NULL,0,0,'2025-07-29 14:04:47','2025-07-29 14:04:47','active',52,1),
	(293,'Утеплитель Роквул (Rockwool) Кавити Баттс',20,'Uteplitel-Rokvul-Rockwool-Kaviti-Batts','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Kaviti-Batts',NULL,NULL,0,'2025-08-03 19:49:11','2025-08-03 19:49:11','active',1,18),
	(295,'Утеплитель Роквул (Rockwool) РУФ БАТТС B ОПТИМА',20,'Uteplitel-Rokvul-Rockwool-RUF-BATTS-B-OPTIMA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-RUF-BATTS-B-OPTIMA',NULL,NULL,0,'2025-08-03 19:49:26','2025-08-03 19:49:26','active',2,18),
	(296,'Утеплитель Роквул (Rockwool) РУФ БАТТС В ЭКСТРА',20,'Uteplitel-Rokvul-Rockwool-RUF-BATTS-V-EKSTRA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-RUF-BATTS-V-EKSTRA',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',3,18),
	(297,'Утеплитель Роквул (Rockwool) РУФ БАТТС Н ОПТИМА',20,'Uteplitel-Rokvul-Rockwool-RUF-BATTS-N-OPTIMA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-RUF-BATTS-N-OPTIMA',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',4,18),
	(298,'Утеплитель Роквул (Rockwool) РУФ БАТТС Н ЭКСТРА',20,'Uteplitel-Rokvul-Rockwool-RUF-BATTS-N-EKSTRA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-RUF-BATTS-N-EKSTRA',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',5,18),
	(299,'Утеплитель Роквул (Rockwool) Сауна Баттс',20,'Uteplitel-Rokvul-Rockwool-Sauna-Batts','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Sauna-Batts',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',6,18),
	(300,'Утеплитель Роквул (Rockwool) Фасад Баттс Д ЭКСТРА',20,'Uteplitel-Rokvul-Rockwool-Fasad-Batts-D-EKSTRA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Fasad-Batts-D-EKSTRA',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',7,18),
	(301,'Утеплитель Роквул (Rockwool) Фасад Баттс ОПТИМА',20,'Uteplitel-Rokvul-Rockwool-Fasad-Batts-OPTIMA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Fasad-Batts-OPTIMA',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',8,18),
	(302,'Утеплитель Роквул (Rockwool) Фасад Баттс ЭКСТРА',20,'Uteplitel-Rokvul-Rockwool-Fasad-Batts-EKSTRA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Fasad-Batts-EKSTRA',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',9,18),
	(303,'Утеплитель Роквул (Rockwool) Флор Баттс',20,'Uteplitel-Rokvul-Rockwool-Flor-Batts','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Flor-Batts',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',10,18),
	(304,'Утеплитель Роквул (Rockwool) Эконом',20,'Uteplitel-Rokvul-Rockwool-Ekonom','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Ekonom',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',11,18),
	(305,'Утеплитель ТехноНиколь Роклайт',20,'Uteplitel-TehnoNikol-Roklajt','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-TehnoNikol-Roklajt',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',12,18),
	(306,'Утеплитель ТехноНИКОЛЬ Техноблок Стандарт',20,'Uteplitel-TehnoNIKOL-Tehnoblok-Standart','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-TehnoNIKOL-Tehnoblok-Standart',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',13,18),
	(307,'PAROC eXtra',20,'PAROC-eXtra','/catalog/teploizolyaciya/bazaltovyj-uteplitel/PAROC-eXtra',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',14,18),
	(308,'PAROC eXtra Light',20,'PAROC-eXtra-Light','/catalog/teploizolyaciya/bazaltovyj-uteplitel/PAROC-eXtra-Light',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',15,18),
	(309,'Стеклоизол',23,'Stekloizol','/catalog/gidroizolyaciya/bitumnye-rulonnye-materialy/Stekloizol',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',16,18),
	(310,'Мембрана Brane A (ветрозащита)',13,'Membrana-Brane-A-vetrozasita','/catalog/vetro-vlagozashita/Membrana-Brane-A-vetrozasita',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',17,18),
	(311,'Мембрана ROCKWOOL ДЛЯ КРОВЕЛЬ',13,'Membrana-ROCKWOOL-DLA-KROVEL','/catalog/vetro-vlagozashita/Membrana-ROCKWOOL-DLA-KROVEL',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',18,18),
	(312,'Мембрана ROCKWOOL ДЛЯ СТЕН',13,'Membrana-ROCKWOOL-DLA-STEN','/catalog/vetro-vlagozashita/Membrana-ROCKWOOL-DLA-STEN',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',19,18),
	(313,'Грунтовка Bitex Betonkontakt (Бетоноконтакт)',26,'Gruntovka-Bitex-Betonkontakt-Betonokontakt','/catalog/smesi-kraski-i-gruntovki/gruntovki/Gruntovka-Bitex-Betonkontakt-Betonokontakt',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',20,18),
	(314,'Грунтовка Bitex Quarzgrund (Кварцгрунт)',26,'Gruntovka-Bitex-Quarzgrund-Kvarcgrunt','/catalog/smesi-kraski-i-gruntovki/gruntovki/Gruntovka-Bitex-Quarzgrund-Kvarcgrunt',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',21,18),
	(315,'Грунтовка глубокого проникновения Bitex Tiefgrund LF',26,'Gruntovka-glubokogo-proniknovenia-Bitex-Tiefgrund-LF','/catalog/smesi-kraski-i-gruntovki/gruntovki/Gruntovka-glubokogo-proniknovenia-Bitex-Tiefgrund-LF',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',22,18),
	(316,'Грунтовка глубокого проникновения Bitex Tiefgrund SPRINT',26,'Gruntovka-glubokogo-proniknovenia-Bitex-Tiefgrund-SPRINT','/catalog/smesi-kraski-i-gruntovki/gruntovki/Gruntovka-glubokogo-proniknovenia-Bitex-Tiefgrund-SPRINT',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',23,18),
	(317,'Плита OSB-3 (ОСБ) Талион',16,'Plita-OSB-3-OSB-Talion','/catalog/drevesno-struzhechnye-plity/Plita-OSB-3-OSB-Talion',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',24,18),
	(318,'АкустиKNAUF',11,'AkustiKNAUF','/catalog/zvukoizolyaciya/AkustiKNAUF',NULL,NULL,0,'2025-08-03 19:51:58','2025-08-03 19:51:58','active',25,18),
	(319,'Роквул (Rockwool) АКУСТИК БАТТС',11,'Rokvul-Rockwool-AKUSTIK-BATTS','/catalog/zvukoizolyaciya/Rokvul-Rockwool-AKUSTIK-BATTS',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',26,18),
	(320,'ТехноНИКОЛЬ Техноакустик',11,'TehnoNIKOL-Tehnoakustik','/catalog/zvukoizolyaciya/TehnoNIKOL-Tehnoakustik',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',27,18),
	(321,'Клей для приклеивания плит утеплителя Bitex Fassadenkleber KL 500',28,'Klej-dla-prikleivania-plit-uteplitela-Bitex-Fassadenkleber-KL-500','/catalog/smesi-kraski-i-gruntovki/klei/Klej-dla-prikleivania-plit-uteplitela-Bitex-Fassadenkleber-KL-500',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',28,18),
	(322,'Клей для систем утепления Bitex Fassadenkleber KLAR 1000',28,'Klej-dla-sistem-uteplenia-Bitex-Fassadenkleber-KLAR-1000','/catalog/smesi-kraski-i-gruntovki/klei/Klej-dla-sistem-uteplenia-Bitex-Fassadenkleber-KLAR-1000',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',29,18),
	(323,'Краска фасадная акриловая Bitex Acryl Fassadenfarbe',25,'Kraska-fasadnaa-akrilovaa-Bitex-Acryl-Fassadenfarbe','/catalog/smesi-kraski-i-gruntovki/kraski/Kraska-fasadnaa-akrilovaa-Bitex-Acryl-Fassadenfarbe',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',30,18),
	(324,'Краска фасадная Силоксановая Bitex Siloxan Fassadenfarbe',25,'Kraska-fasadnaa-Siloksanovaa-Bitex-Siloxan-Fassadenfarbe','/catalog/smesi-kraski-i-gruntovki/kraski/Kraska-fasadnaa-Siloksanovaa-Bitex-Siloxan-Fassadenfarbe',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',31,18),
	(325,'Матовая краска для внутренних работ Bitex Wandfarbe Sprint',25,'Matovaa-kraska-dla-vnutrennih-rabot-Bitex-Wandfarbe-Sprint','/catalog/smesi-kraski-i-gruntovki/kraski/Matovaa-kraska-dla-vnutrennih-rabot-Bitex-Wandfarbe-Sprint',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',32,18),
	(326,'Супербелая матовая краска для внутренних работ Bitex Superwandfarbe',25,'Superbelaa-matovaa-kraska-dla-vnutrennih-rabot-Bitex-Superwandfarbe','/catalog/smesi-kraski-i-gruntovki/kraski/Superbelaa-matovaa-kraska-dla-vnutrennih-rabot-Bitex-Superwandfarbe',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',33,18),
	(327,'Универсальная краска для внутренних работ Bitex Wandfarbe',25,'Universal-naa-kraska-dla-vnutrennih-rabot-Bitex-Wandfarbe','/catalog/smesi-kraski-i-gruntovki/kraski/Universal-naa-kraska-dla-vnutrennih-rabot-Bitex-Wandfarbe',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',34,18),
	(328,'ТеплоKNAUF Ecoroll',22,'TeploKNAUF-Ecoroll','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-Ecoroll',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',35,18),
	(329,'ТеплоKNAUF NORD',22,'TeploKNAUF-NORD','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-NORD',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',36,18),
	(330,'ТеплоKNAUF Для КОТТЕДЖА',22,'TeploKNAUF-Dla-KOTTEDZA','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-Dla-KOTTEDZA',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',37,18),
	(331,'ТеплоKNAUF Для КРОВЛИ',22,'TeploKNAUF-Dla-KROVLI','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-Dla-KROVLI',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',38,18),
	(332,'ТеплоKNAUF Для ПЕРЕКРЫТИЙ',22,'TeploKNAUF-Dla-PEREKRYTIJ','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-Dla-PEREKRYTIJ',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',39,18),
	(333,'ТеплоKNAUF NORD TS032',22,'TeploKNAUF-NORD-TS032','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-NORD-TS032',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',40,18),
	(334,'GreenTerm TR041',22,'GreenTerm-TR041','/catalog/teploizolyaciya/mineralnaya-vata/GreenTerm-TR041',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',41,18),
	(335,'Цилиндр навивной RW100',14,'Cilindr-navivnoj-RW100','/catalog/tehnicheskaya-izolyaciya/Cilindr-navivnoj-RW100',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',42,18),
	(336,'Цилиндр навивной RW100 к/ф',14,'Cilindr-navivnoj-RW100-k-f','/catalog/tehnicheskaya-izolyaciya/Cilindr-navivnoj-RW100-k-f',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',43,18),
	(337,'Утеплитель Роквул (Rockwool) Венти Баттс',20,'Uteplitel-Rokvul-Rockwool-Venti-Batts','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Venti-Batts',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',44,18),
	(338,'Утеплитель Роквул (Rockwool) Лайт Баттс ЭКСТРА',20,'Uteplitel-Rokvul-Rockwool-Lajt-Batts-EKSTRA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Lajt-Batts-EKSTRA',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',45,18),
	(339,'Утеплитель Роквул (Rockwool) Каркас Баттс',20,'Uteplitel-Rokvul-Rockwool-Karkas-Batts','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Karkas-Batts',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',46,18),
	(340,'Мембрана Brane В (пароизоляция)',12,'Membrana-Brane-V-paroizolacia','/catalog/paroizolyaciya/Membrana-Brane-V-paroizolacia',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',47,18),
	(341,'Пароизоляция ROCKWOOL ДЛЯ КРОВЕЛЬ, СТЕН, ПОТОЛКА',12,'Paroizolacia-ROCKWOOL-DLA-KROVEL-STEN-POTOLKA','/catalog/paroizolyaciya/Paroizolacia-ROCKWOOL-DLA-KROVEL-STEN-POTOLKA',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',48,18),
	(342,'Акриловая штукатурка Bitex Acryl Kratzputz (БАРАШЕК)',27,'Akrilovaa-stukaturka-Bitex-Acryl-Kratzputz-BARASEK','/catalog/smesi-kraski-i-gruntovki/shtukaturki/Akrilovaa-stukaturka-Bitex-Acryl-Kratzputz-BARASEK',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',49,18),
	(343,'Акриловая штукатурка Bitex Acryl Reibeputz (КОРОЕД)',27,'Akrilovaa-stukaturka-Bitex-Acryl-Reibeputz-KOROED','/catalog/smesi-kraski-i-gruntovki/shtukaturki/Akrilovaa-stukaturka-Bitex-Acryl-Reibeputz-KOROED',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',50,18),
	(344,'Минеральная штукатурка Bitex MineralischerPUTZ Kratzputz (БАРАШЕК)',27,'Mineral-naa-stukaturka-Bitex-MineralischerPUTZ-Kratzputz-BARASEK','/catalog/smesi-kraski-i-gruntovki/shtukaturki/Mineral-naa-stukaturka-Bitex-MineralischerPUTZ-Kratzputz-BARASEK',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',51,18),
	(345,'Минеральная штукатурка Bitex MineralischerPUTZ Reibeputz (КОРОЕД)',27,'Mineral-naa-stukaturka-Bitex-MineralischerPUTZ-Reibeputz-KOROED','/catalog/smesi-kraski-i-gruntovki/shtukaturki/Mineral-naa-stukaturka-Bitex-MineralischerPUTZ-Reibeputz-KOROED',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',52,18),
	(346,'Силоксановая штукатурка Bitex Acryl Reibeputz (КОРОЕД)',27,'Siloksanovaa-stukaturka-Bitex-Acryl-Reibeputz-KOROED','/catalog/smesi-kraski-i-gruntovki/shtukaturki/Siloksanovaa-stukaturka-Bitex-Acryl-Reibeputz-KOROED',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',53,18),
	(347,'Силоксановая штукатурка Bitex Siloxan Kratzputz (БАРАШЕК)',27,'Siloksanovaa-stukaturka-Bitex-Siloxan-Kratzputz-BARASEK','/catalog/smesi-kraski-i-gruntovki/shtukaturki/Siloksanovaa-stukaturka-Bitex-Siloxan-Kratzputz-BARASEK',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',54,18),
	(348,'Утеплитель Роквул (Rockwool) Рокфасад',20,'Uteplitel-Rokvul-Rockwool-Rokfasad','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Rokfasad',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',55,18),
	(349,'Экструзионный пенополистирол ТехноНиколь XPS CARBON PROF',21,'Ekstruzionnyj-penopolistirol-TehnoNikol-XPS-CARBON-PROF','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol/Ekstruzionnyj-penopolistirol-TehnoNikol-XPS-CARBON-PROF',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',56,18),
	(350,'Экструзионный пенополистирол ТехноНиколь XPS CARBON ECO',21,'Ekstruzionnyj-penopolistirol-TehnoNikol-XPS-CARBON-ECO','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol/Ekstruzionnyj-penopolistirol-TehnoNikol-XPS-CARBON-ECO',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',57,18),
	(351,'Экструзионный пенополистирол ПЕНОПЛЭКС ОСНОВА',21,'Ekstruzionnyj-penopolistirol-PENOPLEKS-OSNOVA','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol/Ekstruzionnyj-penopolistirol-PENOPLEKS-OSNOVA',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',58,18),
	(352,'Утеплитель Роквул (Rockwool) Венти Баттс Оптима',20,'Uteplitel-Rokvul-Rockwool-Venti-Batts-Optima','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Venti-Batts-Optima',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',59,18),
	(353,'ТеплоKNAUF КРОВЛЯ, СТЕНА, ПОЛ',22,'TeploKNAUF-KROVLA-STENA-POL','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-KROVLA-STENA-POL',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',61,18),
	(354,'ТеплоKNAUF ТИСМА',22,'TeploKNAUF-TISMA','/catalog/teploizolyaciya/mineralnaya-vata/TeploKNAUF-TISMA',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',62,18),
	(355,'Тисма А - паропроницаемая ветро-влагозащитная мембрана',12,'Tisma-A-paropronicaemaa-vetro-vlagozasitnaa-membrana','/catalog/paroizolyaciya/Tisma-A-paropronicaemaa-vetro-vlagozasitnaa-membrana',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',63,18),
	(356,'Тисма В - пароизоляционная пленка',12,'Tisma-V-paroizolacionnaa-plenka','/catalog/paroizolyaciya/Tisma-V-paroizolacionnaa-plenka',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',64,18),
	(357,'Утеплитель Роквул (Rockwool) Лайт Баттс ОПТИМА',20,'Uteplitel-Rokvul-Rockwool-Lajt-Batts-OPTIMA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Lajt-Batts-OPTIMA',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',65,18),
	(358,'Мембрана профилированная PLANTER Standard 2x20м',13,'Membrana-profilirovannaa-PLANTER-Standard-2x20m','/catalog/vetro-vlagozashita/Membrana-profilirovannaa-PLANTER-Standard-2x20m',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',66,18),
	(359,'Универсальная плита Smart',20,'Universal-naa-plita-Smart','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Universal-naa-plita-Smart',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',67,18),
	(360,'Теплоизоляционное изделие. Стеновая плита WAS 35',20,'Teploizolacionnoe-izdelie-Stenovaa-plita-WAS-35','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Teploizolacionnoe-izdelie-Stenovaa-plita-WAS-35',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',68,18),
	(361,'Теплоизоляционное изделие. Универсальная плита Smart 50 600x1200 BP/24 16 XL',20,'Teploizolacionnoe-izdelie-Universal-naa-plita-Smart-50-600x1200-BP-24-16-XL','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Teploizolacionnoe-izdelie-Universal-naa-plita-Smart-50-600x1200-BP-24-16-XL',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',69,18),
	(362,'ТехноНиколь Пароизоляция B - 1,6*43,75 м',12,'TehnoNikol-Paroizolacia-B-1-6-43-75-m','/catalog/paroizolyaciya/TehnoNikol-Paroizolacia-B-1-6-43-75-m',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',70,18),
	(363,'Пароизоляция ДАЧА В',12,'Paroizolacia-DACA-V','/catalog/paroizolyaciya/Paroizolacia-DACA-V',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',71,18),
	(364,'Утеплитель Роквул (Rockwool) Фасад Баттс Д ОПТИМА',20,'Uteplitel-Rokvul-Rockwool-Fasad-Batts-D-OPTIMA','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Fasad-Batts-D-OPTIMA',NULL,NULL,0,'2025-08-03 19:51:59','2025-08-03 19:51:59','active',72,18),
	(365,'Теплоизоляционное изделие. Универсальная плита Smart 100 600x1200 BP/24 8 XL',20,'Teploizolacionnoe-izdelie-Universal-naa-plita-Smart-100-600x1200-BP-24-8-XL','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Teploizolacionnoe-izdelie-Universal-naa-plita-Smart-100-600x1200-BP-24-8-XL',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',73,18),
	(366,'Пароизоляция ДАЧА А',12,'Paroizolacia-DACA-A','/catalog/paroizolyaciya/Paroizolacia-DACA-A',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',74,18),
	(367,'Ветро-влагозащитная пленка ISOBOX А, 105762',12,'Vetro-vlagozasitnaa-plenka-ISOBOX-A-105762','/catalog/paroizolyaciya/Vetro-vlagozasitnaa-plenka-ISOBOX-A-105762',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',75,18),
	(368,'Пароизоляция ДАЧА D',12,'Paroizolacia-DACA-D','/catalog/paroizolyaciya/Paroizolacia-DACA-D',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',76,18),
	(369,'KNAUF NORD 033',22,'KNAUF-NORD-033','/catalog/teploizolyaciya/mineralnaya-vata/KNAUF-NORD-033',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',77,18),
	(370,'Утеплитель Роквул (Rockwool) АКУСТИК БАТТС',11,'Uteplitel-Rokvul-Rockwool-AKUSTIK-BATTS','/catalog/zvukoizolyaciya/Uteplitel-Rokvul-Rockwool-AKUSTIK-BATTS',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',78,18),
	(371,'ПЛИТА ТЕХНОПЛЕКС ФУНДАМЕНТ 250 1180х580х50-L ( 0,27376м3/уп )',21,'PLITA-TEHNOPLEKS-FUNDAMENT-250-1180h580h50-L-0-27376m3-up','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol/PLITA-TEHNOPLEKS-FUNDAMENT-250-1180h580h50-L-0-27376m3-up',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',79,18),
	(372,'Пароизоляционная пленка ISOBOX В',12,'Paroizolacionnaa-plenka-ISOBOX-V','/catalog/paroizolyaciya/Paroizolacionnaa-plenka-ISOBOX-V',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',80,18),
	(373,'Пароизоляция ДАЧА В 60м',22,'Paroizolacia-DACA-V-60m','/catalog/teploizolyaciya/mineralnaya-vata/Paroizolacia-DACA-V-60m',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',81,18),
	(374,'ТЕХНОНИКОЛЬ XPS ТЕХНОПЛЕКС',21,'TEHNONIKOL-XPS-TEHNOPLEKS','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol/TEHNONIKOL-XPS-TEHNOPLEKS',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',82,18),
	(375,'Мембрана диффузионная ДАЧА АМ',13,'Membrana-diffuzionnaa-DACA-AM','/catalog/vetro-vlagozashita/Membrana-diffuzionnaa-DACA-AM',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',83,18),
	(376,'Cтруктурная декоративная краска Bitex  Putzeffektfarbe Sprint',25,'Ctrukturnaa-dekorativnaa-kraska-Bitex-Putzeffektfarbe-Sprint','/catalog/smesi-kraski-i-gruntovki/kraski/Ctrukturnaa-dekorativnaa-kraska-Bitex-Putzeffektfarbe-Sprint',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',84,18),
	(377,'Cтруктурная декоративная краска Bitex  Putzeffektfarbe Aussen',25,'Ctrukturnaa-dekorativnaa-kraska-Bitex-Putzeffektfarbe-Aussen','/catalog/smesi-kraski-i-gruntovki/kraski/Ctrukturnaa-dekorativnaa-kraska-Bitex-Putzeffektfarbe-Aussen',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',85,18),
	(378,'Экструзионный пенополистирол ТЕХНОПЛЕКС',21,'Ekstruzionnyj-penopolistirol-TEHNOPLEKS','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol/Ekstruzionnyj-penopolistirol-TEHNOPLEKS',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',86,18),
	(379,'PAROC eXtra Plus',20,'PAROC-eXtra-Plus','/catalog/teploizolyaciya/bazaltovyj-uteplitel/PAROC-eXtra-Plus',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',87,18),
	(380,'Утеплитель Роквул (Rockwool) Лайт Баттс',20,'Uteplitel-Rokvul-Rockwool-Lajt-Batts','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Lajt-Batts',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',88,18),
	(381,'Утеплитель Роквул (Rockwool) Лайт Баттс СКАНДИК',20,'Uteplitel-Rokvul-Rockwool-Lajt-Batts-SKANDIK','/catalog/teploizolyaciya/bazaltovyj-uteplitel/Uteplitel-Rokvul-Rockwool-Lajt-Batts-SKANDIK',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',89,18),
	(382,'Бикрост',23,'Bikrost','/catalog/gidroizolyaciya/bitumnye-rulonnye-materialy/Bikrost',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',90,18),
	(383,'Утеплитель Роквул (Rockwool) АКУСТИК БАТТС ПРО',11,'Uteplitel-Rokvul-Rockwool-AKUSTIK-BATTS-PRO','/catalog/zvukoizolyaciya/Uteplitel-Rokvul-Rockwool-AKUSTIK-BATTS-PRO',NULL,NULL,0,'2025-08-03 19:52:00','2025-08-03 19:52:00','active',91,18);

/*!40000 ALTER TABLE `main` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы messenger_messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messenger_messages`;

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`)
VALUES
	(1,'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:178:\\\"http://newutepliteli.dev.local/verify/email?expires=1753801697&id=3&signature=cNCG3ECUCUa-nDyn9eLgOiHrIDalrJQBhHfqY0FOyjQ&token=HT0ZluQd5OefR1zAq%2BiwyQsMWreqsuyXYZwc8g%2BKFxM%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"admin@utepliteli.org\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:6:\\\"Mailer\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:17:\\\"nevinny@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}','[]','default','2025-07-29 14:08:17','2025-07-29 14:08:17',NULL);

/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_preview` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1DD39950989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `parent`, `title`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `image`, `image_preview`, `datetime`, `created_at`, `updated_at`)
VALUES
	(3,4,'тесту','testu',NULL,NULL,NULL,NULL,'active',NULL,NULL,'2025-07-23 19:59:00','2025-07-23 17:09:44','2025-07-23 17:09:44');

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` double DEFAULT NULL,
  `review_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D34A04AD9F75D7B0` (`external_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `external_id`, `description`, `slug`, `title`, `parent`, `ord`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`, `rating`, `review_count`)
VALUES
	(1,'6e1f27e0-03c2-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-Kaviti-Batts','Утеплитель Роквул (Rockwool) Кавити Баттс',20,0,NULL,NULL,NULL,'active','2025-08-03 19:49:11','2025-08-03 19:49:11',NULL,0),
	(2,'1d5c8d8b-03c4-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-RUF-BATTS-B-OPTIMA','Утеплитель Роквул (Rockwool) РУФ БАТТС B ОПТИМА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:49:26','2025-08-03 19:49:26',NULL,0),
	(3,'89064115-03d0-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-RUF-BATTS-V-EKSTRA','Утеплитель Роквул (Rockwool) РУФ БАТТС В ЭКСТРА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(4,'0e1f186d-03d1-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-RUF-BATTS-N-OPTIMA','Утеплитель Роквул (Rockwool) РУФ БАТТС Н ОПТИМА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(5,'dc67d9cc-047e-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-RUF-BATTS-N-EKSTRA','Утеплитель Роквул (Rockwool) РУФ БАТТС Н ЭКСТРА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(6,'2ac89a42-0480-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-Sauna-Batts','Утеплитель Роквул (Rockwool) Сауна Баттс',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(7,'625025fb-0482-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-Fasad-Batts-D-EKSTRA','Утеплитель Роквул (Rockwool) Фасад Баттс Д ЭКСТРА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(8,'9eb8713a-0482-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-Fasad-Batts-OPTIMA','Утеплитель Роквул (Rockwool) Фасад Баттс ОПТИМА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(9,'e9423111-0482-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-Fasad-Batts-EKSTRA','Утеплитель Роквул (Rockwool) Фасад Баттс ЭКСТРА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(10,'71faf910-0483-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-Flor-Batts','Утеплитель Роквул (Rockwool) Флор Баттс',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(11,'4cbed8f7-0484-11eb-88e9-001e671f818d','','Uteplitel-Rokvul-Rockwool-Ekonom','Утеплитель Роквул (Rockwool) Эконом',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(12,'5c4c737e-0488-11eb-88e9-001e671f818d','','Uteplitel-TehnoNikol-Roklajt','Утеплитель ТехноНиколь Роклайт',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(13,'bae1df47-0488-11eb-88e9-001e671f818d','','Uteplitel-TehnoNIKOL-Tehnoblok-Standart','Утеплитель ТехноНИКОЛЬ Техноблок Стандарт',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(14,'280390fa-0489-11eb-88e9-001e671f818d','','PAROC-eXtra','PAROC eXtra',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(15,'64afe4b2-048a-11eb-88e9-001e671f818d','','PAROC-eXtra-Light','PAROC eXtra Light',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(16,'0c83f4ed-0490-11eb-88e9-001e671f818d','','Stekloizol','Стеклоизол',23,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(17,'409e3fe6-0491-11eb-88e9-001e671f818d','','Membrana-Brane-A-vetrozasita','Мембрана Brane A (ветрозащита)',13,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(18,'d6a80a0e-0491-11eb-88e9-001e671f818d','','Membrana-ROCKWOOL-DLA-KROVEL','Мембрана ROCKWOOL ДЛЯ КРОВЕЛЬ',13,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(19,'3e9c9599-0492-11eb-88e9-001e671f818d','','Membrana-ROCKWOOL-DLA-STEN','Мембрана ROCKWOOL ДЛЯ СТЕН',13,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(20,'bc73783b-04a8-11eb-88e9-001e671f818d','','Gruntovka-Bitex-Betonkontakt-Betonokontakt','Грунтовка Bitex Betonkontakt (Бетоноконтакт)',26,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(21,'05927f34-04a9-11eb-88e9-001e671f818d','','Gruntovka-Bitex-Quarzgrund-Kvarcgrunt','Грунтовка Bitex Quarzgrund (Кварцгрунт)',26,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(22,'341463e7-04a9-11eb-88e9-001e671f818d','','Gruntovka-glubokogo-proniknovenia-Bitex-Tiefgrund-LF','Грунтовка глубокого проникновения Bitex Tiefgrund LF',26,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(23,'94dd0ba3-04a9-11eb-88e9-001e671f818d','','Gruntovka-glubokogo-proniknovenia-Bitex-Tiefgrund-SPRINT','Грунтовка глубокого проникновения Bitex Tiefgrund SPRINT',26,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(24,'c8f5cff3-04aa-11eb-88e9-001e671f818d','','Plita-OSB-3-OSB-Talion','Плита OSB-3 (ОСБ) Талион',16,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(25,'2200f7b3-06de-11eb-88e9-001e671f818d','','AkustiKNAUF','АкустиKNAUF',11,0,NULL,NULL,NULL,'active','2025-08-03 19:51:58','2025-08-03 19:51:58',NULL,0),
	(26,'9e174f95-06de-11eb-88e9-001e671f818d','','Rokvul-Rockwool-AKUSTIK-BATTS','Роквул (Rockwool) АКУСТИК БАТТС',11,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(27,'3e2241d9-06e0-11eb-88e9-001e671f818d','','TehnoNIKOL-Tehnoakustik','ТехноНИКОЛЬ Техноакустик',11,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(28,'4c201222-0702-11eb-88e9-001e671f818d','','Klej-dla-prikleivania-plit-uteplitela-Bitex-Fassadenkleber-KL-500','Клей для приклеивания плит утеплителя Bitex Fassadenkleber KL 500',28,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(29,'47c769f5-0705-11eb-88e9-001e671f818d','','Klej-dla-sistem-uteplenia-Bitex-Fassadenkleber-KLAR-1000','Клей для систем утепления Bitex Fassadenkleber KLAR 1000',28,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(30,'16bdd9b9-0707-11eb-88e9-001e671f818d','','Kraska-fasadnaa-akrilovaa-Bitex-Acryl-Fassadenfarbe','Краска фасадная акриловая Bitex Acryl Fassadenfarbe',25,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(31,'03be0374-070c-11eb-88e9-001e671f818d','','Kraska-fasadnaa-Siloksanovaa-Bitex-Siloxan-Fassadenfarbe','Краска фасадная Силоксановая Bitex Siloxan Fassadenfarbe',25,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(32,'e4af4645-0711-11eb-88e9-001e671f818d','','Matovaa-kraska-dla-vnutrennih-rabot-Bitex-Wandfarbe-Sprint','Матовая краска для внутренних работ Bitex Wandfarbe Sprint',25,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(33,'7549d73f-0712-11eb-88e9-001e671f818d','','Superbelaa-matovaa-kraska-dla-vnutrennih-rabot-Bitex-Superwandfarbe','Супербелая матовая краска для внутренних работ Bitex Superwandfarbe',25,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(34,'d632ffc3-0712-11eb-88e9-001e671f818d','','Universal-naa-kraska-dla-vnutrennih-rabot-Bitex-Wandfarbe','Универсальная краска для внутренних работ Bitex Wandfarbe',25,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(35,'2f29fe92-0715-11eb-88e9-001e671f818d','','TeploKNAUF-Ecoroll','ТеплоKNAUF Ecoroll',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(36,'e2385710-0715-11eb-88e9-001e671f818d','','TeploKNAUF-NORD','ТеплоKNAUF NORD',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(37,'27a4cf7c-0716-11eb-88e9-001e671f818d','','TeploKNAUF-Dla-KOTTEDZA','ТеплоKNAUF Для КОТТЕДЖА',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(38,'84341db4-0718-11eb-88e9-001e671f818d','','TeploKNAUF-Dla-KROVLI','ТеплоKNAUF Для КРОВЛИ',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(39,'b070b80a-071a-11eb-88e9-001e671f818d','','TeploKNAUF-Dla-PEREKRYTIJ','ТеплоKNAUF Для ПЕРЕКРЫТИЙ',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(40,'0949e1bb-bd58-11eb-8a6a-001e671f818d','','TeploKNAUF-NORD-TS032','ТеплоKNAUF NORD TS032',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(41,'161ad630-bd59-11eb-8a6a-001e671f818d','','GreenTerm-TR041','GreenTerm TR041',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(42,'5aba2ba0-f12f-11eb-951b-001e671f818d','','Cilindr-navivnoj-RW100','Цилиндр навивной RW100',14,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(43,'9fbed14e-f369-11eb-951b-001e671f818d','','Cilindr-navivnoj-RW100-k-f','Цилиндр навивной RW100 к/ф',14,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(44,'eb139f6a-a4c2-11ea-957e-001e671f818d','','Uteplitel-Rokvul-Rockwool-Venti-Batts','Утеплитель Роквул (Rockwool) Венти Баттс',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(45,'a58f6e75-a582-11ea-957e-001e671f818d','','Uteplitel-Rokvul-Rockwool-Lajt-Batts-EKSTRA','Утеплитель Роквул (Rockwool) Лайт Баттс ЭКСТРА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(46,'5bb76225-1ce9-11eb-9697-001e671f818d','','Uteplitel-Rokvul-Rockwool-Karkas-Batts','Утеплитель Роквул (Rockwool) Каркас Баттс',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(47,'1d924fb2-07c5-11eb-96cf-001e671f818d','','Membrana-Brane-V-paroizolacia','Мембрана Brane В (пароизоляция)',12,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(48,'959d8449-07c8-11eb-96cf-001e671f818d','','Paroizolacia-ROCKWOOL-DLA-KROVEL-STEN-POTOLKA','Пароизоляция ROCKWOOL ДЛЯ КРОВЕЛЬ, СТЕН, ПОТОЛКА',12,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(49,'06d4585a-07c9-11eb-96cf-001e671f818d','','Akrilovaa-stukaturka-Bitex-Acryl-Kratzputz-BARASEK','Акриловая штукатурка Bitex Acryl Kratzputz (БАРАШЕК)',27,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(50,'9614d282-07c9-11eb-96cf-001e671f818d','','Akrilovaa-stukaturka-Bitex-Acryl-Reibeputz-KOROED','Акриловая штукатурка Bitex Acryl Reibeputz (КОРОЕД)',27,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(51,'d96cdc58-07d0-11eb-96cf-001e671f818d','','Mineral-naa-stukaturka-Bitex-MineralischerPUTZ-Kratzputz-BARASEK','Минеральная штукатурка Bitex MineralischerPUTZ Kratzputz (БАРАШЕК)',27,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(52,'afb6e3d5-07d7-11eb-96cf-001e671f818d','','Mineral-naa-stukaturka-Bitex-MineralischerPUTZ-Reibeputz-KOROED','Минеральная штукатурка Bitex MineralischerPUTZ Reibeputz (КОРОЕД)',27,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(53,'eb15d181-07d7-11eb-96cf-001e671f818d','','Siloksanovaa-stukaturka-Bitex-Acryl-Reibeputz-KOROED','Силоксановая штукатурка Bitex Acryl Reibeputz (КОРОЕД)',27,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(54,'350aa22a-07d8-11eb-96cf-001e671f818d','','Siloksanovaa-stukaturka-Bitex-Siloxan-Kratzputz-BARASEK','Силоксановая штукатурка Bitex Siloxan Kratzputz (БАРАШЕК)',27,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(55,'349f0b5f-c106-11ea-99d0-001e671f818d','','Uteplitel-Rokvul-Rockwool-Rokfasad','Утеплитель Роквул (Rockwool) Рокфасад',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(56,'d1926c0c-0875-11eb-9cec-001e671f818d','','Ekstruzionnyj-penopolistirol-TehnoNikol-XPS-CARBON-PROF','Экструзионный пенополистирол ТехноНиколь XPS CARBON PROF',21,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(57,'5f86d959-0876-11eb-9cec-001e671f818d','','Ekstruzionnyj-penopolistirol-TehnoNikol-XPS-CARBON-ECO','Экструзионный пенополистирол ТехноНиколь XPS CARBON ECO',21,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(58,'6e7cb1a6-0877-11eb-9cec-001e671f818d','','Ekstruzionnyj-penopolistirol-PENOPLEKS-OSNOVA','Экструзионный пенополистирол ПЕНОПЛЭКС ОСНОВА',21,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(59,'5ef3fc75-2741-11ec-9d42-b03af61ad78a','','Uteplitel-Rokvul-Rockwool-Venti-Batts-Optima','Утеплитель Роквул (Rockwool) Венти Баттс Оптима',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(60,'7072fade-4fba-11ed-9d80-b03af61ad78a','','Membrana-ROCKWOOL-DLA-STEN','Мембрана ROCKWOOL ДЛЯ СТЕН',13,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(61,'a0a1179b-723d-11ed-9d84-b03af61ad78a','','TeploKNAUF-KROVLA-STENA-POL','ТеплоKNAUF КРОВЛЯ, СТЕНА, ПОЛ',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(62,'e05bc712-7246-11ed-9d84-b03af61ad78a','','TeploKNAUF-TISMA','ТеплоKNAUF ТИСМА',22,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(63,'035f1230-74a1-11ed-9d85-b03af61ad78a','','Tisma-A-paropronicaemaa-vetro-vlagozasitnaa-membrana','Тисма А - паропроницаемая ветро-влагозащитная мембрана',12,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(64,'0002ca75-74a9-11ed-9d85-b03af61ad78a','','Tisma-V-paroizolacionnaa-plenka','Тисма В - пароизоляционная пленка',12,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(65,'255d3d3c-9007-11ed-9d87-b03af61ad78a','','Uteplitel-Rokvul-Rockwool-Lajt-Batts-OPTIMA','Утеплитель Роквул (Rockwool) Лайт Баттс ОПТИМА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(66,'abdc9387-e5c0-11ed-9d99-b03af61ad78a','','Membrana-profilirovannaa-PLANTER-Standard-2x20m','Мембрана профилированная PLANTER Standard 2x20м',13,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(67,'0cb9fd31-eb2f-11ed-9d99-b03af61ad78a','','Universal-naa-plita-Smart','Универсальная плита Smart',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(68,'08045fc8-0539-11ee-9d9a-b03af61ad78a','','Teploizolacionnoe-izdelie-Stenovaa-plita-WAS-35','Теплоизоляционное изделие. Стеновая плита WAS 35',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(69,'1f0a8e02-10dd-11ee-9d9a-b03af61ad78a','','Teploizolacionnoe-izdelie-Universal-naa-plita-Smart-50-600x1200-BP-24-16-XL','Теплоизоляционное изделие. Универсальная плита Smart 50 600x1200 BP/24 16 XL',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(70,'5b2388ec-1a3b-11ee-9d9a-b03af61ad78a','','TehnoNikol-Paroizolacia-B-1-6-43-75-m','ТехноНиколь Пароизоляция B - 1,6*43,75 м',12,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(71,'74555400-2475-11ee-9d9a-b03af61ad78a','','Paroizolacia-DACA-V','Пароизоляция ДАЧА В',12,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(72,'d34c933e-2d3f-11ee-9d9b-b03af61ad78a','','Uteplitel-Rokvul-Rockwool-Fasad-Batts-D-OPTIMA','Утеплитель Роквул (Rockwool) Фасад Баттс Д ОПТИМА',20,0,NULL,NULL,NULL,'active','2025-08-03 19:51:59','2025-08-03 19:51:59',NULL,0),
	(73,'c8f92655-cbfa-11ee-9da0-b03af61ad78a','','Teploizolacionnoe-izdelie-Universal-naa-plita-Smart-100-600x1200-BP-24-8-XL','Теплоизоляционное изделие. Универсальная плита Smart 100 600x1200 BP/24 8 XL',20,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(74,'1ad7bfa1-8b97-11ef-9da6-b03af61ad78a','','Paroizolacia-DACA-A','Пароизоляция ДАЧА А',12,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(75,'f506c7f4-8d2b-11ef-9da6-b03af61ad78a','','Vetro-vlagozasitnaa-plenka-ISOBOX-A-105762','Ветро-влагозащитная пленка ISOBOX А, 105762',12,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(76,'5437bb2c-91d2-11ef-9da6-b03af61ad78a','','Paroizolacia-DACA-D','Пароизоляция ДАЧА D',12,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(77,'fb1794e9-b20d-11ef-9dab-b03af61ad78a','','KNAUF-NORD-033','KNAUF NORD 033',22,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(78,'63c00786-b3ac-11ef-9dab-b03af61ad78a','','Uteplitel-Rokvul-Rockwool-AKUSTIK-BATTS','Утеплитель Роквул (Rockwool) АКУСТИК БАТТС',11,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(79,'861d7a71-e2c5-11ef-9db4-b03af61ad78a','','PLITA-TEHNOPLEKS-FUNDAMENT-250-1180h580h50-L-0-27376m3-up','ПЛИТА ТЕХНОПЛЕКС ФУНДАМЕНТ 250 1180х580х50-L ( 0,27376м3/уп )',21,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(80,'94b70697-062a-11f0-9dba-b03af61ad78a','','Paroizolacionnaa-plenka-ISOBOX-V','Пароизоляционная пленка ISOBOX В',12,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(81,'5546bbd1-0efe-11f0-9dbc-b03af61ad78a','','Paroizolacia-DACA-V-60m','Пароизоляция ДАЧА В 60м',22,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(82,'6226b4ef-608e-11f0-9dc4-b03af61ad78a','','TEHNONIKOL-XPS-TEHNOPLEKS','ТЕХНОНИКОЛЬ XPS ТЕХНОПЛЕКС',21,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(83,'c0342f22-63a2-11f0-9dc4-b03af61ad78a','','Membrana-diffuzionnaa-DACA-AM','Мембрана диффузионная ДАЧА АМ',13,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(84,'cd85c8f3-19cb-11eb-a17a-001e671f818d','','Ctrukturnaa-dekorativnaa-kraska-Bitex-Putzeffektfarbe-Sprint','Cтруктурная декоративная краска Bitex  Putzeffektfarbe Sprint',25,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(85,'579c2a40-19cc-11eb-a17a-001e671f818d','','Ctrukturnaa-dekorativnaa-kraska-Bitex-Putzeffektfarbe-Aussen','Cтруктурная декоративная краска Bitex  Putzeffektfarbe Aussen',25,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(86,'883eb5bb-856f-11ea-ab6b-001e671f818d','','Ekstruzionnyj-penopolistirol-TEHNOPLEKS','Экструзионный пенополистирол ТЕХНОПЛЕКС',21,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(87,'6653def3-5f15-11eb-b93b-001e671f818d','','PAROC-eXtra-Plus','PAROC eXtra Plus',20,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(88,'66b3d1f8-8856-11ea-b94f-001e671f818d','','Uteplitel-Rokvul-Rockwool-Lajt-Batts','Утеплитель Роквул (Rockwool) Лайт Баттс',20,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(89,'de816d36-8857-11ea-b94f-001e671f818d','','Uteplitel-Rokvul-Rockwool-Lajt-Batts-SKANDIK','Утеплитель Роквул (Rockwool) Лайт Баттс СКАНДИК',20,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(90,'ce824c8c-8865-11ea-b94f-001e671f818d','','Bikrost','Бикрост',23,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0),
	(91,'590f3f82-5b00-11eb-be60-001e671f818d','','Uteplitel-Rokvul-Rockwool-AKUSTIK-BATTS-PRO','Утеплитель Роквул (Rockwool) АКУСТИК БАТТС ПРО',11,0,NULL,NULL,NULL,'active','2025-08-03 19:52:00','2025-08-03 19:52:00',NULL,0);

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы product_params
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_params`;

CREATE TABLE `product_params` (
  `id` int NOT NULL AUTO_INCREMENT,
  `variant_id` int NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_variants_unique_idx` (`variant_id`,`external_id`),
  KEY `IDX_EDB24F573B69A9AF` (`variant_id`),
  CONSTRAINT `FK_EDB24F573B69A9AF` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=689 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `product_params` WRITE;
/*!40000 ALTER TABLE `product_params` DISABLE KEYS */;

INSERT INTO `product_params` (`id`, `variant_id`, `external_id`, `title`, `val`, `created_at`, `updated_at`, `status`)
VALUES
	(1,1,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:49:11','2025-08-03 19:49:11','active'),
	(2,1,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:49:11','2025-08-03 19:49:11','active'),
	(3,1,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:49:11','2025-08-03 19:49:11','active'),
	(4,1,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','5 шт','2025-08-03 19:49:11','2025-08-03 19:49:11','active'),
	(5,2,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(6,2,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(7,2,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(8,2,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 шт','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(9,3,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(10,3,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(11,3,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(12,3,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(13,4,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','40 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(14,4,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(15,4,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(16,4,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(17,5,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(18,5,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(19,5,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(20,5,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(21,6,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','70 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(22,6,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(23,6,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(24,6,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(25,7,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 40 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(26,7,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(27,7,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(28,7,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(29,8,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(30,8,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(31,8,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(32,8,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(33,9,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','80','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(34,9,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(35,9,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(36,9,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(37,10,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(38,10,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(39,10,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(40,10,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','3 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(41,11,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','120','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(42,11,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(43,11,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(44,12,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','150 мм ','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(45,12,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(46,12,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(47,13,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(48,13,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(49,13,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(50,13,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(51,14,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(52,14,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(53,14,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(54,14,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','3 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(55,15,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','140 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(56,15,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(57,15,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(58,16,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','140 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(59,16,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(60,16,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(61,17,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','140 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(62,17,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(63,17,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(64,18,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','150 мм ','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(65,18,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(66,18,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(67,19,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','160','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(68,19,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(69,19,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(70,19,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(71,20,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(72,20,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(73,20,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(74,20,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(75,21,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(76,21,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(77,21,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(78,21,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(79,22,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(80,22,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(81,22,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(82,22,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(83,23,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(84,23,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(85,23,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(86,23,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','3 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(87,24,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 30 мм ','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(88,24,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(89,24,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(90,24,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(91,25,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(92,25,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(93,25,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(94,25,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(95,26,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','150 мм ','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(96,26,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(97,26,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(98,26,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(99,27,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(100,27,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(101,27,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(102,27,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','5 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(103,28,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(104,28,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(105,28,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(106,28,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(107,29,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(108,29,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(109,29,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(110,29,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(111,30,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(112,30,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(113,30,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(114,31,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 25 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(115,31,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(116,31,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(117,32,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(118,32,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(119,32,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(120,33,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(121,33,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(122,33,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(123,33,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(124,34,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(125,34,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(126,34,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(127,34,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(128,35,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(129,35,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(130,35,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(131,35,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(132,36,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(133,36,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(134,36,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(135,36,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(136,37,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(137,37,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(138,37,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(139,37,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(140,38,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(141,38,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(142,38,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(143,38,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(144,39,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(145,39,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(146,39,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(147,39,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(148,40,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(149,40,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(150,40,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(151,40,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(152,41,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(153,41,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(154,41,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(155,41,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(156,42,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(157,42,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(158,42,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(159,42,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(160,43,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(161,43,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(162,43,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(163,43,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(164,44,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(165,44,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(166,44,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(167,44,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(168,45,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(169,45,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(170,45,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(171,45,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(172,46,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(173,46,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(174,46,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(175,46,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(176,47,'94daf23d-885b-11ea-b94f-001e671f818d','Тип','ТПП','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(177,47,'5891bb67-885d-11ea-b94f-001e671f818d','Материал основы','Стеклоткань','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(178,47,'c9f74146-885d-11ea-b94f-001e671f818d','Материал покрытия верхней стороны','Плёнка','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(179,47,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','10м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(180,47,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 2,5мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(181,48,'94daf23d-885b-11ea-b94f-001e671f818d','Тип','ТПП','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(182,48,'5891bb67-885d-11ea-b94f-001e671f818d','Материал основы','Стеклоткань','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(183,48,'c9f74146-885d-11ea-b94f-001e671f818d','Материал покрытия верхней стороны','Плёнка','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(184,48,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','10м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(185,48,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','3мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(186,49,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(187,49,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','18,75 м','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(188,49,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(189,50,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(190,50,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','43,75 м','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(191,50,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(192,51,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(193,51,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','18,75 м','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(194,51,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(195,52,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(196,52,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','43,75 м','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(197,52,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(198,53,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(199,53,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','18,75 м','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(200,53,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(201,54,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(202,54,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','43,75 м','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(203,54,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(204,55,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','15 кг','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(205,56,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','15 кг','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(206,57,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 л','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(207,58,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','200 л','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(208,59,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 л','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(209,60,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','12 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(210,60,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1250 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(211,60,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','2500 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(212,61,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 18 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(213,61,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1250 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(214,61,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','2500 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(215,62,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','8 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(216,62,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1250 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(217,62,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','2500 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(218,63,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','9 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(219,63,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1250 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(220,63,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','2500 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(221,64,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(222,64,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(223,64,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(224,64,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(225,65,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(226,65,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(227,65,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(228,65,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(229,66,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','27 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(230,66,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(231,66,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(232,66,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','920 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(233,67,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(234,67,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','5 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(235,67,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(236,67,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(237,68,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(238,68,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(239,68,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(240,68,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(241,69,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','75 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(242,69,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(243,69,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(244,69,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(245,70,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(246,70,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(247,70,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(248,70,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(249,71,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(250,71,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(251,71,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(252,71,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(253,72,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(254,72,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(255,72,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(256,72,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(257,73,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(258,73,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(259,73,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(260,73,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(261,74,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(262,75,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(263,76,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','20 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(264,77,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','20 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(265,78,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','14 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(266,79,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','21 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(267,80,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','3 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(268,81,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','7 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(269,82,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','14 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(270,83,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','21 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(271,84,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','3 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(272,85,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','7 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(273,86,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','14 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(274,87,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(275,87,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(276,87,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(277,87,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(278,88,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(279,88,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(280,88,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(281,88,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(282,89,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(283,89,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(284,89,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(285,89,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(286,90,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(287,90,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(288,90,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(289,90,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(290,91,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(291,91,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(292,91,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(293,91,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(294,92,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(295,92,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(296,92,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(297,92,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(298,93,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','150 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(299,93,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','5500 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(300,93,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1220 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(301,93,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','1 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(302,94,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(303,94,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','6148 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(304,94,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1220 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(305,94,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(306,95,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(307,95,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','6148 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(308,95,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1220 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(309,95,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(310,96,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(311,96,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','7380 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(312,96,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1220 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(313,96,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','1 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(314,97,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(315,97,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','7380 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(316,97,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1220 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(317,97,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(318,98,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(319,98,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(320,98,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(321,98,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(322,99,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(323,99,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1220','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(324,99,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','6970','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(325,99,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','40','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(326,100,'106df5a6-f11b-11eb-951b-001e671f818d','Диаметр','108 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(327,100,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 30 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(328,100,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(329,100,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','5 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(330,101,'106df5a6-f11b-11eb-951b-001e671f818d','Диаметр','159 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(331,101,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 25 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(332,101,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(333,101,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(334,102,'106df5a6-f11b-11eb-951b-001e671f818d','Диаметр','273 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(335,102,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 25 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(336,102,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(337,102,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(338,103,'106df5a6-f11b-11eb-951b-001e671f818d','Диаметр','32 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(339,103,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 40 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(340,103,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(341,103,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(342,104,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(343,104,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(344,104,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(345,104,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(346,105,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(347,105,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(348,105,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(349,105,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(350,106,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(351,106,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(352,106,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(353,106,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(354,107,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(355,107,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(356,107,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(357,107,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(358,108,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(359,108,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(360,108,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(361,108,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(362,109,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(363,109,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(364,109,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(365,109,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(366,110,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(367,110,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(368,111,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(369,111,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(370,112,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(371,112,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(372,113,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(373,113,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','1600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(374,114,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','1,5 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(375,114,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(376,115,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','2,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(377,115,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(378,116,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','1,5 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(379,116,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(380,117,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','2,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(381,117,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(382,118,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','2,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(383,118,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(384,119,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','3,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(385,119,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(386,120,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','2,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(387,120,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(388,121,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','3,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(389,121,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(390,122,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','1,5 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(391,122,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(392,123,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','2,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(393,123,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(394,124,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','1,5 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(395,124,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(396,125,'132c9887-025d-11eb-9daf-001e671f818d','Зерно','2,0 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(397,125,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','25 кг','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(398,126,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(399,126,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(400,126,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(401,126,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(402,127,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(403,127,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(404,127,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(405,127,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(406,128,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(407,128,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(408,128,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(409,128,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(410,129,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 40 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(411,129,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(412,129,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(413,129,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(414,130,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(415,130,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(416,130,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(417,130,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(418,131,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(419,131,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(420,131,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(421,131,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(422,132,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 30 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(423,132,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(424,132,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(425,132,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','13 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(426,133,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(427,133,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(428,133,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(429,133,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(430,134,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 20 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(431,134,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(432,134,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(433,134,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(434,135,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(435,135,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','585 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(436,135,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1185 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(437,135,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(438,136,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 20 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(439,136,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','585 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(440,136,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1185 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(441,136,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(442,137,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 30 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(443,137,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','585 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(444,137,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1185 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(445,137,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','13 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(446,138,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 40 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(447,138,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','585 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(448,138,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1185 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(449,138,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(450,139,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(451,139,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','585 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(452,139,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1185 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(453,139,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(454,140,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 20 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(455,140,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','620 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(456,140,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1190 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(457,140,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(458,141,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(459,141,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(460,141,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(461,141,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(462,142,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 30 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(463,142,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(464,142,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(465,143,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(466,143,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(467,143,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(468,143,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(469,144,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(470,145,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(471,146,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(472,146,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(473,146,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(474,146,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(475,147,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(476,147,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1230 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(477,147,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','610 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(478,147,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','15 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(479,148,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(480,148,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(481,148,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','8300','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(482,148,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(483,149,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(484,149,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1300','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(485,149,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(486,149,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(487,150,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','60 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(488,151,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','60 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(489,152,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(490,152,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(491,152,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(492,152,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','20ПАЧ/ПАЛ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(493,153,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(494,153,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(495,153,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(496,153,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','20ПАЧ/ПАЛ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(497,154,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','40м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(498,154,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','20 м','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(499,154,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','2 м','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(500,155,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(501,155,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(502,155,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(503,156,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(504,156,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(505,156,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(506,157,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(507,157,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(508,157,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(509,157,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','24','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(510,158,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(511,158,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(512,158,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(513,158,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(514,159,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(515,159,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(516,159,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(517,159,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(518,160,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(519,161,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(520,162,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','60 м²','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(521,163,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 30 мм ','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(522,163,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(523,163,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(524,163,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(525,164,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(526,164,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(527,164,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(528,164,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','2 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(529,165,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','150 мм ','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(530,165,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(531,165,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(532,166,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(533,166,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(534,166,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(535,166,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','5 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(536,167,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(537,167,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(538,167,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(539,167,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(540,168,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(541,168,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(542,168,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(543,168,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','16 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(544,169,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(545,170,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','60 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(546,171,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(547,172,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(548,173,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','60 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(549,174,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(550,175,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(551,175,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1250','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(552,175,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(553,175,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(554,176,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(555,176,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1250','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(556,176,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(557,177,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(558,177,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(559,177,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(560,177,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(561,178,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','27 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(562,178,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(563,178,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(564,178,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(565,179,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(566,179,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(567,179,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(568,179,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(569,180,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','75 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(570,180,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(571,180,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(572,180,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(573,181,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(574,181,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(575,181,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(576,182,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(577,182,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(578,182,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(579,182,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(580,183,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','70 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(581,185,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(582,185,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(583,185,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(584,185,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(585,186,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(586,186,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(587,186,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(588,186,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(589,187,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','30 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(590,188,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','60 м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(591,189,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','15 кг','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(592,190,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','15 кг','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(593,191,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(594,191,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(595,191,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(596,191,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(597,192,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 30 мм ','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(598,192,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(599,192,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(600,192,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','13 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(601,193,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 40 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(602,193,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(603,193,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(604,193,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(605,194,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(606,194,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(607,194,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(608,194,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(609,195,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(610,195,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','580 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(611,195,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1180 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(612,195,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(613,196,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина',' 20 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(614,196,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(615,196,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(616,196,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(617,197,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(618,197,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(619,197,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(620,197,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(621,198,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','150 мм ','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(622,198,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(623,198,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(624,198,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(625,199,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(626,199,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(627,199,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(628,199,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(629,200,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(630,200,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(631,200,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(632,200,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','5 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(633,201,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(634,201,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(635,201,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(636,201,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','10 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(637,202,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(638,202,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(639,202,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(640,202,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(641,203,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','150 мм ','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(642,203,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1200 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(643,203,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(644,203,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','5 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(645,204,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(646,204,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','800 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(647,204,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(648,204,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(649,205,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(650,205,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','800 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(651,205,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(652,205,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(653,206,'94daf23d-885b-11ea-b94f-001e671f818d','Тип','ТКП','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(654,206,'5891bb67-885d-11ea-b94f-001e671f818d','Материал основы','Стеклоткань','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(655,206,'c9f74146-885d-11ea-b94f-001e671f818d','Материал покрытия верхней стороны','Сланец','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(656,206,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','10м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(657,207,'94daf23d-885b-11ea-b94f-001e671f818d','Тип','ТПП','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(658,207,'5891bb67-885d-11ea-b94f-001e671f818d','Материал основы','Стеклоткань','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(659,207,'c9f74146-885d-11ea-b94f-001e671f818d','Материал покрытия верхней стороны','Плёнка','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(660,207,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','15м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(661,208,'94daf23d-885b-11ea-b94f-001e671f818d','Тип','ХКП','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(662,208,'5891bb67-885d-11ea-b94f-001e671f818d','Материал основы','Стеклохолст','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(663,208,'c9f74146-885d-11ea-b94f-001e671f818d','Материал покрытия верхней стороны','Сланец','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(664,208,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','10м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(665,209,'94daf23d-885b-11ea-b94f-001e671f818d','Тип','ХПП','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(666,209,'5891bb67-885d-11ea-b94f-001e671f818d','Материал основы','Стеклохолст','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(667,209,'c9f74146-885d-11ea-b94f-001e671f818d','Материал покрытия верхней стороны','Плёнка','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(668,209,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','15м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(669,210,'94daf23d-885b-11ea-b94f-001e671f818d','Тип','ЭПП','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(670,210,'5891bb67-885d-11ea-b94f-001e671f818d','Материал основы','Полиэфир','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(671,210,'c9f74146-885d-11ea-b94f-001e671f818d','Материал покрытия верхней стороны','Плёнка','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(672,210,'c3e76665-8861-11ea-b94f-001e671f818d','Площадь покрытия, м²','15м²','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(673,211,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','100 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(674,211,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','4 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(675,211,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(676,211,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(677,212,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','27 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(678,212,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','12 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(679,212,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(680,212,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(681,213,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','50 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(682,213,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','8 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(683,213,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(684,213,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(685,214,'284e5b42-8566-11ea-ab6b-001e671f818d','Толщина','75 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(686,214,'1f68a117-8857-11ea-b94f-001e671f818d','Количество в упаковке','6 шт','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(687,214,'b9d23e37-8566-11ea-ab6b-001e671f818d','Ширина','600 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(688,214,'e1f77903-8566-11ea-ab6b-001e671f818d','Длина','1000 мм','2025-08-03 19:52:00','2025-08-03 19:52:00','active');

/*!40000 ALTER TABLE `product_params` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы product_variant
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_variant`;

CREATE TABLE `product_variant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_unique_idx` (`product_id`,`external_id`),
  KEY `IDX_209AA41D4584665A` (`product_id`),
  CONSTRAINT `FK_209AA41D4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `product_variant` WRITE;
/*!40000 ALTER TABLE `product_variant` DISABLE KEYS */;

INSERT INTO `product_variant` (`id`, `product_id`, `external_id`, `sku`, `price`, `created_at`, `updated_at`, `status`)
VALUES
	(1,1,'eee1389f-03c3-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:49:11','2025-08-03 19:49:11','active'),
	(2,1,'b433ea4d-03c3-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(3,2,'70c3cc10-0ee7-11eb-b4e8-001e671f818d',NULL,NULL,'2025-08-03 19:49:26','2025-08-03 19:49:26','active'),
	(4,2,'6e2f6e89-9021-11ee-9d9f-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(5,2,'430d63c3-03c4-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(6,2,'12e6ea72-9023-11ee-9d9f-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(7,3,'ac258d5c-03d0-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(8,3,'b4b43ab2-03d0-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(9,3,'f0e353b5-cf73-11eb-8a33-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(10,4,'8d44cccf-03e0-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(11,4,'840b8b3e-a0f6-11ef-9da8-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(12,4,'61b0863e-0419-11ec-9d38-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(13,4,'64f59b36-03e0-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(14,5,'ff6bfc8d-047e-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(15,5,'0c678ee0-d55a-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(16,5,'1e417a33-d55a-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(17,5,'701e5878-d55a-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(18,5,'0d253aab-be9e-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(19,5,'2db49b7e-cf74-11eb-8a33-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(20,5,'801f5fc2-0eea-11eb-b4e8-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(21,6,'ce95b74a-4396-11eb-b5c9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(22,6,'98a7ab4b-0480-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(23,7,'80658c11-0482-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(24,8,'00f7920f-f04a-11eb-92a9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(25,8,'cdd62307-0482-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(26,8,'bfe8665d-d7b5-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(27,8,'bbc4a0cd-0482-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(28,9,'4d36821e-0483-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(29,9,'3d6f4699-0483-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(30,10,'00d55cea-0484-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(31,10,'b0293de5-0483-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(32,10,'e6062d6c-0483-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(33,11,'00e0dc3d-0488-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(34,11,'a7a511a2-0484-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(35,12,'9fc5772e-4399-11eb-b5c9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(36,12,'8534b303-0488-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(37,12,'52efbcd4-ba9a-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(38,12,'76c4a817-0488-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(39,13,'ec54fb84-0488-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(40,13,'f860598b-0488-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(41,13,'dd769cc7-0488-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(42,13,'cb49f108-0488-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(43,14,'89918767-0489-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(44,14,'7525b8ac-0489-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(45,15,'13a9b9ce-06e7-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(46,15,'0a190201-06e7-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(47,16,'567dcebb-0490-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(48,16,'8447d26c-0490-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(49,17,'9459cd43-0491-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(50,17,'aa5605dc-0491-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(51,18,'a8941102-4039-11eb-99d1-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(52,18,'094070b5-0492-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(53,19,'02256310-403a-11eb-99d1-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(54,19,'e8885ca4-0493-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(55,20,'dbc55a92-04a8-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(56,21,'15d8b095-04a9-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(57,22,'54e34ee2-04a9-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(58,22,'68efe53a-04a9-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(59,23,'b7b0a7cc-04a9-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(60,24,'4e389c18-06dd-11eb-88e9-001e671f818d',NULL,1600,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(61,24,'b9e9389c-d67f-11ec-9d67-b03af61ad78a',NULL,1800,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(62,24,'583b4d5a-4398-11eb-b5c9-001e671f818d',NULL,1700,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(63,24,'38fdba84-06dd-11eb-88e9-001e671f818d',NULL,1500,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(64,25,'0fc86ca5-06e9-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:58','2025-08-03 19:51:58','active'),
	(65,25,'63f860aa-06de-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(66,25,'ffd90f1a-06e8-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(67,26,'5f255575-403b-11eb-99d1-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(68,26,'6bc5b094-06df-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(69,26,'a9eacd84-06df-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(70,27,'ca38a1c2-06f1-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(71,27,'b5a72207-06f1-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(72,27,'8cb0ff9c-06f1-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(73,27,'a1d63602-06f1-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(74,28,'2d4486d5-0705-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(75,29,'666f000d-0705-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(76,30,'44fb3a5e-0707-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(77,31,'0e6d27c0-070c-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(78,32,'398ac6cb-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(79,32,'4b92abf2-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(80,32,'08838d54-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(81,32,'2536c62a-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(82,33,'a8a7b3ab-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(83,33,'a8a7b3ac-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(84,33,'9b4b3fa5-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(85,33,'a292e93f-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(86,34,'dfdb1075-0712-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(87,35,'6fdcfbf2-0715-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(88,35,'5d52ec92-0715-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(89,36,'0b6ce2f5-0716-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(90,36,'f8c957c7-0715-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(91,37,'928e83d7-0717-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(92,37,'831bf940-0717-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(93,38,'f7c2c6d7-0719-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(94,38,'c25c20e2-0718-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(95,38,'3e351e15-bc8e-11eb-8a6a-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(96,39,'29e16ca7-9dcd-11eb-b84f-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(97,39,'cb302fdd-071a-11eb-88e9-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(98,40,'8802659e-bd58-11eb-8a6a-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(99,41,'748560cb-bd59-11eb-8a6a-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(100,42,'8f52d698-f12f-11eb-951b-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(101,42,'cae77368-f36e-11eb-951b-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(102,42,'97846063-f36f-11eb-951b-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(103,43,'238be9eb-f36a-11eb-951b-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(104,44,'28543fa8-a4c5-11ea-957e-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(105,44,'ca0071b4-a4c4-11ea-957e-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(106,45,'a223cc7b-c105-11ea-99d0-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(107,45,'94ee6908-c105-11ea-99d0-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(108,46,'8ae6c774-1ce9-11eb-9697-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(109,46,'7aa7e92e-1ce9-11eb-9697-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(110,47,'244237c0-07c8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(111,47,'2d0cb674-07c8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(112,48,'ae2fdac4-07c8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(113,48,'b7ba77f8-07c8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(114,49,'391b6980-07c9-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(115,49,'4a099d28-07c9-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(116,50,'b2e1f69f-07d0-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(117,50,'ba05c402-07d0-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(118,51,'81504fb7-07d7-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(119,51,'9383b250-07d7-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(120,52,'be59bf55-07d7-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(121,52,'c6175df7-07d7-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(122,53,'14d8479a-07d8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(123,53,'1e5920a9-07d8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(124,54,'41b3a20f-07d8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(125,54,'47f68207-07d8-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(126,55,'e3be67af-c106-11ea-99d0-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(127,55,'7eaede7e-c106-11ea-99d0-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(128,56,'f8e5fbe6-0875-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(129,56,'3b75a811-c233-11ed-9d99-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(130,56,'eb3af18a-0875-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(131,57,'dba34bd1-0876-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(132,57,'b4d45739-0876-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(133,57,'c8c500b7-0876-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(134,57,'a2ae1432-0876-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(135,58,'1bfdb787-8094-11ef-9da6-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(136,58,'bd76384f-0877-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(137,58,'0b35fb7e-0879-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(138,58,'3500af10-0879-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(139,58,'4ae874fd-0879-11eb-9cec-001e671f818d',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(140,58,'984297ad-5d80-11ec-9d4c-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(141,59,'5ef3fc79-2741-11ec-9d42-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(142,59,'91523458-ae94-11ed-9d99-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(143,59,'5ef3fc78-2741-11ec-9d42-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(144,60,'a28514ce-4fba-11ed-9d80-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(145,60,'8ea01b36-4fba-11ed-9d80-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(146,61,'527434fc-7246-11ed-9d84-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(147,61,'1909e222-723e-11ed-9d84-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(148,62,'7051a122-7247-11ed-9d84-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(149,62,'185b37d9-7247-11ed-9d84-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(150,63,'ca2985b6-74a1-11ed-9d85-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(151,64,'e16574fb-7558-11ed-9d85-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(152,65,'255d3d42-9007-11ed-9d87-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(153,65,'255d3d41-9007-11ed-9d87-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(154,66,'80d84f84-e5c1-11ed-9d99-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(155,67,'60839479-eb2f-11ed-9d99-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(156,68,'418c0d65-0539-11ee-9d9a-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(157,68,'c048ab66-350e-11ee-9d9b-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(158,69,'700ec0ab-cbfa-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(159,69,'b996d4c6-10dd-11ee-9d9a-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(160,70,'87c2b298-1a3b-11ee-9d9a-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(161,71,'a9ff7db2-2475-11ee-9d9a-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(162,71,'b0bd2309-2475-11ee-9d9a-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(163,72,'d34c9343-2d3f-11ee-9d9b-b03af61ad78a',NULL,NULL,'2025-08-03 19:51:59','2025-08-03 19:51:59','active'),
	(164,72,'d34c9342-2d3f-11ee-9d9b-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(165,72,'ef8aeea2-2d3f-11ee-9d9b-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(166,72,'d34c9341-2d3f-11ee-9d9b-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(167,73,'c8f92c05-cbfa-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(168,73,'c8f92f90-cbfa-11ee-9da0-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(169,74,'f095870c-639e-11f0-9dc4-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(170,74,'5ca952fa-8b97-11ef-9da6-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(171,75,'13b68cbe-8d2c-11ef-9da6-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(172,76,'5d284de2-63a4-11f0-9dc4-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(173,76,'ece3d3c4-91d4-11ef-9da6-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(174,76,'85e68569-91d2-11ef-9da6-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(175,77,'7bb8aef2-b20e-11ef-9dab-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(176,77,'54ec9d13-b20e-11ef-9dab-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(177,78,'63c007d6-b3ac-11ef-9dab-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(178,78,'63c0079d-b3ac-11ef-9dab-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(179,78,'63c007c2-b3ac-11ef-9dab-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(180,78,'63c007d5-b3ac-11ef-9dab-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(181,79,'c7932b31-e2c5-11ef-9db4-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(182,79,'6e72ea76-eabf-11ef-9db5-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(183,80,'c6c0907b-062a-11f0-9dba-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(184,81,'5546bbd1-0efe-11f0-9dbc-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(185,82,'18407de1-608f-11f0-9dc4-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(186,82,'aa75b63f-608f-11f0-9dc4-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(187,83,'c0342f23-63a2-11f0-9dc4-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(188,83,'c0342f24-63a2-11f0-9dc4-b03af61ad78a',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(189,84,'f13bd92f-19cb-11eb-a17a-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(190,85,'612fa135-19cc-11eb-a17a-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(191,86,'47958449-857a-11ea-ab6b-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(192,86,'19913af8-07e1-11eb-96cf-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(193,86,'9f6856ed-857a-11ea-ab6b-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(194,86,'6edda248-857a-11ea-ab6b-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(195,86,'cb786228-6a08-11eb-8ad2-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(196,86,'1627fa41-857d-11ea-ab6b-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(197,87,'9804535f-5f15-11eb-b93b-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(198,87,'b747dd76-5f15-11eb-b93b-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(199,87,'8b02d1c4-5f15-11eb-b93b-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(200,88,'81cb9b53-a57d-11ea-957e-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(201,88,'7036c4fb-a57d-11ea-957e-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(202,89,'46f27d95-8858-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(203,89,'1ae9c9c8-a581-11ea-957e-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(204,89,'8276ce1d-8858-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(205,89,'a1f1209b-8858-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(206,90,'957c1e56-8866-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(207,90,'839d1e89-8866-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(208,90,'6d9ca020-8866-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(209,90,'590553f1-8866-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(210,90,'2782ce2c-8866-11ea-b94f-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(211,91,'131c50a9-5b01-11eb-be60-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(212,91,'b18d48c8-5b00-11eb-be60-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(213,91,'d0beaa55-5b00-11eb-be60-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active'),
	(214,91,'f3527d71-5b00-11eb-be60-001e671f818d',NULL,NULL,'2025-08-03 19:52:00','2025-08-03 19:52:00','active');

/*!40000 ALTER TABLE `product_variant` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы reset_password_request
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reset_password_request`;

CREATE TABLE `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Дамп таблицы section
# ------------------------------------------------------------

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `type_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `is_node` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2D737AEF989D9B62` (`slug`),
  KEY `IDX_2D737AEF727ACA70` (`parent_id`),
  KEY `IDX_2D737AEFC54C8C93` (`type_id`),
  CONSTRAINT `FK_2D737AEF727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `section` (`id`),
  CONSTRAINT `FK_2D737AEFC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `section_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;

INSERT INTO `section` (`id`, `parent_id`, `type_id`, `title`, `description`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `full_path`, `created_at`, `updated_at`, `template`, `ord`, `is_node`)
VALUES
	(1,NULL,1,'О компании','<p>C 1999 года наша компания работает в области поставок теплоизоляционных материалов и является членом Национального объединения производителей строительных материалов, изделий и конструкций (НОПСМ). Так же мы являемся официальным дистрибьютором ведущих производителей строительной и технической изоляции и сопутствующей продукции (крепежи, пароизоляционные и гидроизоляционные мембраны, материалы для фасадных работ и пр.). Представляемая нами продукция имеет все необходимые сертификаты и отвечает самым высоким современным стандартам.&nbsp;<br><br></p><p><br>&nbsp;Наши стандарты:<br>&nbsp;<br>&nbsp;Быть нацеленным на постоянное удовлетворение потребностей наших заказчиков;<br>&nbsp;Совершенствовать и рационализировать нашу работу;<br>&nbsp;Заботиться о людях, работающих в нашей компании;<br>&nbsp;Работать как одна команда;<br>&nbsp;Наши цели и задачи:<br>&nbsp;<br>&nbsp;Предоставлять нашим заказчикам изоляционные услуги и изоляционные материалы высокого качества<br>&nbsp;Укреплять доверие к нашей компании у всех кто работает с нами<br>&nbsp;Развивать изоляционный бизнес проявляя постоянную заботу о наших сотрудниках, акционерах, о нашей пользе обществу<br>&nbsp;Мы стараемся поддерживать доброе имя нашей компании, постоянно заботясь о клиентах и сотрудниках, делая всё, чтобы предлагать вам продукцию и сервис высокого уровня.&nbsp;</p>','about',NULL,NULL,NULL,'active','/about','2025-07-08 11:13:20','2025-07-08 11:13:20','section/text',0,1),
	(2,NULL,1,'Информация','<p>Интернет магазин <a href=\"https://utepliteli.org/\"><strong>\"Теплый Дом\"</strong></a> предлагает тепло-гидро-паро-ветро-звукоизоляцию, а так же сопутствующие товары в четырёх регионах РФ: г. Москва, г. Санкт-Петербург, г. Краснодар и Тверская область. Пожалуйста, выберете в шапке сайта Ваш регион, чтобы видеть актуальные цены и наличие товара, а так же контакты и условия доставки. Стоимость доставки указана приблизительная, т.к. для расчёта конечной стоимости необходимо провести индивидуальный расчёт в зависимости от объёма материала в заказе и пункта доставки.</p><p><br>Для точного расчёта стоимости заказа и по другим вопросам вы можете обратиться к менеджеру, для этого:<br>1. Выберете в \"шапке\" сайта Ваш регион<br>2. Перейдите на страницу <a href=\"https://utepliteli.org/contacts/\"><strong>\"Контакты\"</strong></a> <br>3. Используйте указанные на странице <a href=\"https://utepliteli.org/contacts/\"><strong>\"Контакты\"</strong></a> номер телефона или адрес электронной почты<br>4. По общим вопросам Вы так же можете написать в один из двух онлайн-чатов, расположенных внизу каждой страницы или воспользоваться активной ссылкой <a href=\"https://api.whatsapp.com/send?phone=+79778989651&amp;text=&amp;source=&amp;data=&amp;app_absent=\"><strong>WatsApp</strong></a> или <strong>Viber</strong> внизу каждой страницы</p>','info',NULL,NULL,NULL,'active','/info','2025-07-08 11:14:09','2025-07-08 11:14:09','section/text',0,1),
	(3,NULL,1,'Помощь','<h2>Как с нами связаться</h2><p>&nbsp;1. Выберете ваш регион в \"шапке\" сайта, если он не определился автоматически. В шапке сайта вы можете видеть номер телефона, актуальный для вашего региона.&nbsp; &nbsp; &nbsp; <br>&nbsp;2. Рядом с указанным номером телефона вы можете заказать обратный звонок. <br>&nbsp;3. Перейдите на страницу <a href=\"https://utepliteli.org/contacts/\"><strong>\"Контакты\"</strong></a><strong> </strong>и воспользуйтесь указанными номерами телефонов или адресом электронной почты.<br>&nbsp;4. Вы можете воспользоваться одним из двух онлайн-чатов, расположенных внизу каждой страницы<br>&nbsp;5. Так же вы можете воспользоваться активными ссылками <a href=\"https://api.whatsapp.com/send?phone=+79778989651&amp;text=&amp;source=&amp;data=&amp;app_absent=\"><strong>WatsApp</strong></a> или <strong>Viber</strong> внизу каждой страницы<br>&nbsp;<br>&nbsp;<br><br></p><h2>Как оформить заказ</h2><p>&nbsp;Оформить заказ на нашем сайте легко. Выберете ваш регион в \"шапке\" сайта, если он не определился автоматически. Добавьте товары в корзину, а затем перейдите на страницу Корзина, проверьте правильность заказанных позиций и нажмите кнопку «Оформить заказ» или «Быстрый заказ». Ожидайте подтверждения заказа, менеджер обязательно свяжется с Вами.&nbsp;</p><h3>Быстрый заказ</h3><p>&nbsp;Функция «Быстрый заказ» позволяет покупателю не проходить всю процедуру оформления заказа самостоятельно. Вы заполняете форму, и через короткое время вам перезвонит менеджер магазина. Он уточнит все условия заказа, ответит на вопросы, касающиеся качества товара, его особенностей. А также подскажет о вариантах оплаты и доставки.&nbsp;</p><p>&nbsp;По результатам звонка, пользователь либо, получив уточнения, самостоятельно оформляет заказ, укомплектовав его необходимыми позициями, либо соглашается на оформление в том виде, в котором есть сейчас. Получает подтверждение на почту или на мобильный телефон и ждёт доставки.&nbsp;</p><h3>Оформление заказа в стандартном режиме</h3><p>&nbsp;Если вы уверены в выборе, то можете самостоятельно оформить заказ, заполнив по этапам всю форму.&nbsp;</p><p>&nbsp;Заполнение адреса</p><p>&nbsp;Выберите из списка название вашего региона и населённого пункта. Если вы не нашли свой населённый пункт в списке, выберите значение «Другое местоположение» и впишите название своего населённого пункта в графу «Город». Введите правильный индекс.&nbsp;</p><p>&nbsp;Доставка</p><p>&nbsp;В зависимости от места жительства вам предложат варианты доставки. Выберите любой удобный способ. Подробнее об условиях доставки читайте в разделе «<a href=\"/help/delivery/\">Доставка</a>».&nbsp; <strong>ОБРАТИТЕ ВНИМАНИЕ</strong>, стоимость доставки указана приблизительная, т.к. для расчёта конечной стоимости необходимо провести индивидуальный расчёт в зависимости от объёма материала в заказе и пункта доставки.&nbsp;</p><p>&nbsp;Оплата</p><p>&nbsp;Выберите оптимальный способ оплаты. Подробнее о всех вариантах читайте в разделе «<a href=\"/help/payment/\">Оплата</a>»&nbsp;</p><p>&nbsp;Покупатель</p><p>&nbsp;Введите данные о себе: ФИО, адрес доставки, номер телефона. В поле «Комментарии к заказу» введите сведения, которые могут пригодиться курьеру, например: подъезды в доме считаются справа налево.&nbsp;</p><p>&nbsp;Оформление заказа</p><p>&nbsp;Проверьте правильность ввода информации: позиции заказа, выбор местоположения, данные о покупателе. Нажмите кнопку «Оформить заказ».&nbsp;</p><p>&nbsp;Наш сервис запоминает данные о пользователе, информацию о заказе и в следующий раз предложит вам повторить к вводу данные предыдущего заказа. Если условия вам не подходят, выбирайте другие варианты.&nbsp;</p>','help',NULL,NULL,NULL,'active','/help','2025-07-08 11:14:31','2025-07-08 11:14:31','section/text',0,1),
	(4,1,2,'Новости',NULL,'news',NULL,NULL,NULL,'active','/about/news','2025-07-08 11:18:16','2025-07-08 11:18:16','news/list',0,1),
	(5,2,1,'Условия оплаты','<p>Вы можете выбрать один из трёх вариантов оплаты:</p>\n<h3>Оплата наличными</h3>\n<p>\n	При выборе варианта оплаты наличными, вы дожидаетесь приезда курьера и передаёте ему сумму за товар в рублях. Курьер предоставляет товар, который можно осмотреть на предмет повреждений, соответствие указанным условиям. Покупатель подписывает товаросопроводительные документы, вносит денежные средства и получает чек.\n</p>\n<p>\n	Также оплата наличными доступна при самовывозе из магазина, оплаты по почте или использовании постамата.\n</p>\n<h3>Безналичный расчёт</h3>\n<p>\n	При оформлении заказа в корзине вы можете выбрать вариант безналичной оплаты. Мы принимаем карты Visa и Master Card. Чтобы оплатить покупку, вас перенаправит на сервер системы ASSIST, где вы должны ввести номер карты, срок действия, имя держателя.\n</p>\n<p>\n	Вам могут отказать от авторизации в случае:\n</p>\n<ul>\n	<li>\n	если ваш банк не поддерживает технологию 3D-Secure; </li>\n	<li>\n	на карте недостаточно средств для покупки; </li>\n	<li>\n	банк не поддерживает услугу платежей в интернете; </li>\n	<li>\n	истекло время ожидания ввода данных; </li>\n	<li>\n	в данных была допущена ошибка. </li>\n</ul>\n<p>\n	В этом случае вы можете повторить авторизацию через 20 минут, воспользоваться другой картой или обратиться в свой банк для решения вопроса.\n</p>\n<p>\n	Безналичным расчётом можно воспользоваться при курьерской доставке, использовании постамата или самовывоза из магазина.\n</p>\n<h3>Электронные системы</h3>\n<p>\n	Для оплаты вы можете воспользоваться одной из электронных платёжных систем:\n</p>\n<ul>\n	<li>Сбербанк Онлайн; </li>\n	<li>\n	Оплата через банкомат; </li>\n</ul>','payment',NULL,NULL,NULL,'active','/info/payment','2025-07-08 11:21:05','2025-07-08 11:21:05','section/text',0,0),
	(6,2,1,'Условия доставки','<h2>Возможные варианты доставки и оплаты строительных материалов.</h2>\n	 &nbsp;&nbsp; &nbsp;1. Вы можете забрать подготовленный для Вас заказ <em><strong>самовывозом</strong></em> со склада.<br>\n	 &nbsp;&nbsp; &nbsp;2. Мы можем осуществить доставку Вашего заказа по указанному Вами адресу. Постарайтесь продумать полный список необходимых Вам <a href=\"/\">строительных материалов</a>. Вы можете также задать вопросы по возможной комплектации для выполнения определенных строительных работ нашему менеджеру, он всегда будет рад Вам помочь. Это может <em><strong>сэкономить Ваше время</strong></em> и деньги, т.к. не нужно будет делать дополнительных заказов и тратить дополнительное время.&nbsp;<br>\n <br>\n	 Оплату Вашего заказа можно произвести заранее или при получении товара.<br>\n <br>\n <strong>Стоимость доставки по г. Мо</strong><strong>скве в пределах МКАД до МОЖД указана в таблице</strong>:<br>\n <br>\n\n		<table border=\"1\">\n		<tbody>\n			<tr>\n				<td>Вид транспорта</td>\n				<td>Мин. Время заказа (ч)</td>\n				<td>Стоимость</td>\n			</tr>\n			<tr>\n				<td>Грузовик 8м<sup>3</sup> (\"Газель\")</td>\n				<td>5(1+4)</td>\n				<td>5400</td>\n			</tr>\n			<tr>\n				<td>Грузовик 20м<sup>3</sup> (\"Бычок\")</td>\n				<td>7(1+6)</td>\n				<td>6200</td>\n			</tr>\n			<tr>\n				<td>Грузовик 40м<sup>3</sup></td>\n				<td>7(1+6)</td>\n				<td>7900</td>\n			</tr>\n			<tr>\n				<td>Грузовик 60м<sup>3</sup></td>\n				<td>8(1+7)</td>\n				<td>9800</td>\n			</tr>\n		</tbody>\n	</table>\n\n <br>\n <br>\n	 Доставка за МКАД и регионы рассчитывается индивидуально.<br>\n <br>\n	 Вашему вниманию предлагаются высококачественные строительные материалы мелким и крупным оптом, по наиболее выгодным ценам. Данная информация предназначается для строительных фирм, организаций, ведущих промышленное, жилищное и коттеджное строительство, а также для частных застройщиков. <br>\n <br>\n	 Осуществляется поставка строительных материалов от ведущих производителей, вся продукция подробно представлена с описаниями и техническими характеристиками на страницах каталога. Необходимая информация, касающаяся габаритов того или иного товара, возможностей использования, цены за метр (тонну, килограмм, пакет и т.д.), полностью удовлетворит самого требовательного покупателя, привыкшего внимательно относиться к покупке строительных материалов для рабочего объекта. <br>\n <br>\n	 Заказывая <a href=\"/Information/Help\"><strong>строительные материалы оптом</strong></a> в данной компании, каждый клиент может воспользоваться возможностью подробно узнать о каждом из наименований, выставленных на продажу, позвонив менеджерам компании и проконсультировавшись по любому из вопросов. Квалифицированные специалисты детально расскажут о преимуществах любого из представленных в ассортименте компании товара, ответят на вопросы о стоимости, доставке, возможности скидок, погрузке-разгрузке, наличии на складе и количественном выражении запасов. <br>\n <br>\n	 Компания является участником строительного рынка в Москве, будучи нацеленной на постоянное развитие бизнеса и занимая высокие позиции. Миссия заключается в предоставлении клиентам максимально возможного ассортимента товаров для осуществления строительных работ, от возведения фундамента до отделки. Наличие широкого ассортимента строительных товаров, сосредоточенных на одной территории, удобно для заказчиков – ища <strong>магазины стройматериалов в Москве</strong>, можно убедиться в том, что не каждая компания является универсальным поставщиком и предлагает максимально полный список необходимой продукции. <br>\n <br>\n	 Вниманию клиентов предлагается <strong>поставка стройматериало</strong>в по Москве&nbsp;области&nbsp;и регионы. Преимуществами являются значительный опыт в поставке строительных материалов, команда опытных сотрудников, наличие гибкого подхода к нуждам клиента, оптимальное соотношение качества продукции и цены на нее. Основными критериями работы в данном коллективе считаются: творческий подход, результативность и профессионализм, что в полной мере применимо к услугам. Приоритетами являются профессиональные консультации, предоставляемые сотрудниками с самого начала обращения к услугам фирмы, а также грамотное формирование ценовой политики и внимательность к нуждам потребителей. <br>\n <br>\n	 Постоянные клиенты могут рассчитывать на систему скидок, приобретая <strong>стройматериалы оптом</strong>. Подробнее об этом можно узнать у специалистов, позвонив по указанным телефонам. Компания предоставляет все возможности для установления долгосрочного партнерства и ценит как новых заказчиков, так и постоянных клиентов. Заказывая полную или частичную комплектацию объектов отделочными и строительными материалами, в этом можно легко убедиться.<br>\n <br>\n	<div style=\"text-align: center;\">\n		 Существует также возможность забрать материалы самовывозом, если необходимые материалы имеются в достаточном количестве на складе.\n	</div>','delivery',NULL,NULL,NULL,'active','/info/delivery','2025-07-08 11:32:14','2025-07-08 11:32:14','section/text',0,0),
	(7,2,1,'Гарантия на товар','<p>Гарантийный период – это срок, во время которого клиент, обнаружив недостаток товара имеет право потребовать от продавца или изготовителя принять меры по устранению дефекта. Продавец должен устранить недостатки, если не будет доказано, что они возникли вследствие нарушений покупателем правил эксплуатации.\n</p>\n<h3>С какого момента начинается гарантия?</h3>\n<ul>\n	<li>\n\n		с момента передачи товара потребителю, если в договоре нет уточнения;\n\n </li>\n	<li>\n\n		если нет возможности установить день покупки, то гарантия идёт с момента изготовления;\n	\n </li>\n	<li>\n\n		на сезонные товары гарантия идёт с момента начала сезона;\n\n </li>\n	<li>\n\n		при заказе товара из интернет-магазина гарантия начинается со дня доставки.\n\n </li>\n</ul>\n<p>\n	Обслуживание по гарантии включает в себя:\n</p>\n<ul>\n	<li>\n\n		устранение недостатков товара в сертифицированных сервисных центрах;\n	\n </li>\n	<li>\n\n		обмен на аналогичный товар без доплаты;\n	\n </li>\n	<li>\n\n		обмен на похожий товар с доплатой;\n\n </li>\n	<li>\n\n		возврат товара и перечисление денежных средств на счёт покупателя.\n\n </li>\n</ul>\n<h3>Правила обмена и возврата товара:</h3>\n<h4>Обмен и возврат продукции надлежащего качества</h4>\n<p>\n	Продавец гарантирует, что покупатель в течение 7 дней с момента приобретения товара может отказаться от товара надлежащего качества, если:\n</p>\n<ul>\n	<li>\n\n		товар не поступал в эксплуатацию и имеет товарный вид, находится в упаковке со всеми ярлыками, а также есть документы на приобретение товара;\n\n </li>\n	<li>\n\n		товар не входит в перечень продуктов надлежащего качества, не подлежащих возврату и обмену.\n\n </li>\n</ul>\n<p>\n	Покупатель имеет право обменять товар надлежащего качество на другое торговое предложение этого товара или другой товар, идентичный по стоимости или на иной товар с доплатой или возвратом разницы в цене.\n</p>\n<h4>Обмен и возврат продукции ненадлежащего качества</h4>\n<p>\n	Если покупатель обнаружил недостатки товара после его приобретения, то он может потребовать замену у продавца. Замена должна быть произведена в течение 7 дней со дня предъявления требования. В случае, если будет назначена экспертиза на соответствие товара указанным нормам, то обмен должен быть произведён в течение 20 дней.\n</p>\n<p>\n	Технически сложные товары ненадлежащего качества заменяются товарами той же марки или на аналогичный товар другой марки с перерасчётом стоимости. Возврат производится путем аннулирования договора купли-продажи и возврата суммы в размере стоимости товара.\n</p>\n<h3>Возврат денежных средств</h3>\n<p>\n	Срок возврата денежных средств зависит от вида оплаты, который изначально выбрал покупатель.\n</p>\n<p>\n	При наличном расчете возврат денежных средств осуществляется на кассе не позднее через через 10 дней после предъявления покупателем требования о возврате.\n</p>\n<p>\n	Зачисление стоимости товара на карту клиента, если был использован безналичный расчёт, происходит сразу после получения требования от покупателя.\n</p>\n<p>\n	При использовании электронных платёжных систем, возврат осуществляется на электронный счёт в течение 10 календарных дней.','warranty',NULL,NULL,NULL,'active','/info/warranty','2025-07-08 11:37:23','2025-07-08 11:37:23','section/text',0,0),
	(8,NULL,7,'Каталог','<p>qwe</p>','catalog',NULL,NULL,NULL,'active','/','2025-07-09 15:38:52','2025-07-09 15:38:52',NULL,0,1),
	(9,8,8,'Теплоизоляция',NULL,'teploizolyaciya',NULL,NULL,NULL,'active','/catalog/teploizolyaciya','2025-07-09 15:41:45','2025-07-09 15:41:45','catalog/category',0,1),
	(10,8,8,'Гидроизоляция',NULL,'gidroizolyaciya',NULL,NULL,NULL,'active','/catalog/gidroizolyaciya','2025-07-10 14:28:38','2025-07-10 14:28:38','catalog/category',0,1),
	(11,8,8,'Звукоизоляция',NULL,'zvukoizolyaciya',NULL,NULL,NULL,'active','/catalog/zvukoizolyaciya','2025-07-10 14:29:33','2025-07-10 14:29:33','catalog/category',0,1),
	(12,8,8,'Пароизоляция',NULL,'paroizolyaciya',NULL,NULL,NULL,'active','/catalog/paroizolyaciya','2025-07-10 14:29:58','2025-07-10 14:29:58','catalog/category',0,1),
	(13,8,8,'Ветро-влагозащита',NULL,'vetro-vlagozashita',NULL,NULL,NULL,'active','/catalog/vetro-vlagozashita','2025-07-10 14:30:22','2025-07-10 14:30:22','catalog/category',0,1),
	(14,8,8,'Техническая изоляция',NULL,'tehnicheskaya-izolyaciya',NULL,NULL,NULL,'active','/catalog/tehnicheskaya-izolyaciya','2025-07-10 14:30:42','2025-07-10 14:30:42','catalog/category',0,1),
	(15,8,8,'Утепление фасадов',NULL,'uteplenie-fasadov',NULL,NULL,NULL,'active','/catalog/uteplenie-fasadov','2025-07-10 14:31:04','2025-07-10 14:31:04','catalog/category',0,1),
	(16,8,8,'Древесно-стружечные плиты',NULL,'drevesno-struzhechnye-plity',NULL,NULL,NULL,'active','/catalog/drevesno-struzhechnye-plity','2025-07-10 14:31:27','2025-07-10 14:31:27','catalog/category',0,1),
	(17,8,8,'Крепёж',NULL,'krepyozh',NULL,NULL,NULL,'active','/catalog/krepyozh','2025-07-10 14:31:44','2025-07-10 14:31:44','catalog/category',0,1),
	(18,8,8,'Смеси, краски и грунтовки',NULL,'smesi-kraski-i-gruntovki',NULL,NULL,NULL,'active','/catalog/smesi-kraski-i-gruntovki','2025-07-10 14:32:07','2025-07-10 14:32:07','catalog/category',0,1),
	(19,8,8,'Пены и герметики',NULL,'peny-i-germetiki',NULL,NULL,NULL,'active','/catalog/peny-i-germetiki','2025-07-10 14:32:30','2025-07-10 14:32:30','catalog/category',0,1),
	(20,9,8,'Базальтовый утеплитель',NULL,'bazaltovyj-uteplitel',NULL,NULL,NULL,'active','/catalog/teploizolyaciya/bazaltovyj-uteplitel','2025-07-10 14:33:03','2025-07-10 14:33:03','catalog/category',0,1),
	(21,9,8,'Экструзионный пенополистирол',NULL,'ekstruzionnyj-penopolistirol',NULL,NULL,NULL,'active','/catalog/teploizolyaciya/ekstruzionnyj-penopolistirol','2025-07-10 16:07:16','2025-07-10 16:07:16','catalog/category',0,1),
	(22,9,8,'Минеральная вата',NULL,'mineralnaya-vata',NULL,NULL,NULL,'active','/catalog/teploizolyaciya/mineralnaya-vata','2025-07-10 16:07:38','2025-07-10 16:07:38','catalog/category',0,1),
	(23,10,8,'Битумные рулонные материалы',NULL,'bitumnye-rulonnye-materialy',NULL,NULL,NULL,'active','/catalog/gidroizolyaciya/bitumnye-rulonnye-materialy','2025-07-10 16:20:11','2025-07-10 16:20:11','catalog/category',0,1),
	(24,14,8,'Цилиндры',NULL,'cilindry',NULL,NULL,NULL,'active','/catalog/tehnicheskaya-izolyaciya/cilindry','2025-07-10 16:20:56','2025-07-10 16:20:56','catalog/category',0,1),
	(25,18,8,'Краски',NULL,'kraski',NULL,NULL,NULL,'active','/catalog/smesi-kraski-i-gruntovki/kraski','2025-07-10 16:21:45','2025-07-10 16:21:45','catalog/category',0,1),
	(26,18,8,'Грунтовки',NULL,'gruntovki',NULL,NULL,NULL,'active','/catalog/smesi-kraski-i-gruntovki/gruntovki','2025-07-10 16:22:17','2025-07-10 16:22:17','catalog/category',0,1),
	(27,18,8,'Штукатурки',NULL,'shtukaturki',NULL,NULL,NULL,'active','/catalog/smesi-kraski-i-gruntovki/shtukaturki','2025-07-10 16:22:39','2025-07-10 16:22:39','catalog/category',0,1),
	(28,18,8,'Клеи',NULL,'klei',NULL,NULL,NULL,'active','/catalog/smesi-kraski-i-gruntovki/klei','2025-07-10 16:23:03','2025-07-10 16:23:03','catalog/category',0,1),
	(51,2,1,'Политика конфидинциальности','<h2>1. Общие положения</h2>\n<p>\n    Настоящая Политика конфиденциальности (далее — «Политика») определяет порядок обработки и защиты персональных данных Пользователей сайта utepliteli.org (далее — «Сайт»).\n</p>\n<p>\n    Использование Сайта означает согласие Пользователя с настоящей Политикой и условиями обработки его персональных данных.\n</p>\n\n<h2>2. Персональные данные</h2>\n<p>\n    Под персональными данными понимается любая информация, относящаяся к прямо или косвенно определённому или определяемому физическому лицу (Пользователю), включая:\n</p>\n<ul>\n    <li>адрес электронной почты,</li>\n    <li>IP-адрес,</li>\n    <li>данные, передаваемые браузером, cookie,</li>\n    <li>иные сведения, добровольно переданные Пользователем при использовании Сайта.</li>\n</ul>\n\n<h2>3. Цели сбора данных</h2>\n<p>\n    Сбор и обработка персональных данных осуществляется исключительно для следующих целей:\n</p>\n<ul>\n    <li>Обеспечение корректной работы Сайта и его функциональности;</li>\n    <li>Обратная связь с Пользователем;</li>\n    <li>Анализ поведения Пользователей для улучшения сервиса (с использованием обезличенных данных);</li>\n    <li>Выполнение требований законодательства РФ.</li>\n</ul>\n\n<h2>4. Обработка и защита данных</h2>\n<p>\n    Обработка персональных данных осуществляется с соблюдением принципов и правил, предусмотренных Федеральным законом РФ № 152-ФЗ «О персональных данных».\n</p>\n<p>\n    Все данные хранятся в защищённых системах, доступ к которым имеют только уполномоченные лица. Передача данных третьим лицам без согласия Пользователя не производится, за исключением случаев, предусмотренных законодательством.\n</p>\n\n<h2>5. Использование файлов cookie</h2>\n<p>\n    Сайт может использовать cookie-файлы и аналогичные технологии для персонализации контента, хранения пользовательских предпочтений и сбора статистики.\n</p>\n<p>\n    Пользователь может отключить cookie в настройках своего браузера. Это может повлиять на корректность работы некоторых функций Сайта.\n</p>\n\n<h2>6. Права пользователя</h2>\n<p>\n    Пользователь имеет право:\n</p>\n<ul>\n    <li>Получать информацию о своих персональных данных;</li>\n    <li>Требовать их уточнения, блокировки или удаления в случае, если они являются устаревшими, неточными или обрабатываются с нарушением закона;</li>\n    <li>Отозвать согласие на обработку персональных данных.</li>\n</ul>\n<p>\n    Для реализации этих прав необходимо направить запрос на адрес, указанный ниже.\n</p>\n\n<h2>7. Изменение политики</h2>\n<p>\n    Администрация Сайта вправе вносить изменения в настоящую Политику. Новая редакция вступает в силу с момента её публикации на Сайте.\n</p>\n\n<h2>8. Контакты</h2>\n<p>По вопросам, связанным с обработкой персональных данных, вы можете обратиться:</p>\n\n<p>Email: shop@utepliteli.org</p>','privacy',NULL,NULL,NULL,'active','/','2025-07-25 14:07:12','2025-07-25 14:07:12',NULL,0,1),
	(52,NULL,1,'Регистрация',NULL,'registration',NULL,NULL,NULL,'active','/','2025-07-29 14:04:47','2025-07-29 14:04:47',NULL,0,1);

/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы section_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `section_link`;

CREATE TABLE `section_link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_type_id` int NOT NULL,
  `child_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B31275FAB704F8D5` (`parent_type_id`),
  KEY `IDX_B31275FAA7F8C488` (`child_type_id`),
  CONSTRAINT `FK_B31275FAA7F8C488` FOREIGN KEY (`child_type_id`) REFERENCES `section_type` (`id`),
  CONSTRAINT `FK_B31275FAB704F8D5` FOREIGN KEY (`parent_type_id`) REFERENCES `section_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `section_link` WRITE;
/*!40000 ALTER TABLE `section_link` DISABLE KEYS */;

INSERT INTO `section_link` (`id`, `parent_type_id`, `child_type_id`)
VALUES
	(1,7,8),
	(2,5,13),
	(3,8,8),
	(4,2,10),
	(5,14,15),
	(6,1,14),
	(7,1,1),
	(8,5,16),
	(9,16,13);

/*!40000 ALTER TABLE `section_link` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы section_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `section_type`;

CREATE TABLE `section_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_node` tinyint(1) NOT NULL DEFAULT '1',
  `entity_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crud_controller_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `section_type` WRITE;
/*!40000 ALTER TABLE `section_type` DISABLE KEYS */;

INSERT INTO `section_type` (`id`, `code`, `name`, `template`, `description`, `is_node`, `entity_class`, `crud_controller_class`, `controller_class`)
VALUES
	(1,'section','Текстовая','section/text.html.twig',NULL,0,'App\\Entity\\Section','App\\Controller\\Admin\\SectionCrudController','App\\Controller\\SectionController::index'),
	(2,'news_list','Список новостей','section/news_list.html.twig',NULL,1,'App\\Entity\\News','App\\Controller\\Admin\\NewsCrudController','App\\Controller\\NewsController::index'),
	(3,'reviews','Отзывы','section/reviews.html.twig',NULL,1,NULL,NULL,NULL),
	(4,'price','Цены','section/price.html.twig',NULL,1,NULL,NULL,NULL),
	(5,'contacts','Контакты','contacts/list.html.twig',NULL,1,'App\\Entity\\Contacts','App\\Controller\\Admin\\ContactsCrudController','App\\Controller\\ContactsController::index'),
	(6,'home','Главная','section/home.html.twig',NULL,1,NULL,NULL,NULL),
	(7,'catalog','Каталог','catalog/root.html.twig',NULL,1,NULL,NULL,'App\\Controller\\CatalogController::index'),
	(8,'category','Категория','catalog/category.html.twig',NULL,1,'App\\Entity\\Category','App\\Controller\\Admin\\CategoryCrudController','App\\Controller\\CategoryController::index'),
	(10,'news','Новость','news/item.html.twig',NULL,0,'App\\Entity\\News','App\\Controller\\Admin\\NewsCrudController','App\\Controller\\NewsController::show'),
	(13,'store','Магазин','store/item.html.twig',NULL,1,'App\\Entity\\Store','App\\Controller\\Admin\\StoreCrudController','App\\Controller\\StoreController::index'),
	(14,'brandlist','Список брендов','brands/list',NULL,1,'App\\Entity\\BrandList','App\\Controller\\Admin\\BrandCrudController','App\\Controller\\BrandController::index'),
	(15,'brand','Бренд','brands/item',NULL,0,'App\\Entity\\Brand','App\\Controller\\Admin\\BrandCrudController','App\\Controller\\BrandController::show'),
	(16,'storelist','Список магазинов','store/list',NULL,1,'App\\Entity\\StoreList','App\\Controller\\Admin\\StoreListCrudController','App\\Controller\\ContactsController::list'),
	(17,'register','Регистрация','registration/register',NULL,1,'App\\Entity\\User','App\\Controller\\Admin\\SectionCrudController','App\\Controller\\RegistrationController::register'),
	(18,'product','Товар','product/item',NULL,1,'App\\Entity\\Product','App\\Controller\\Admin\\ProductCrudController','App\\Controller\\ProductController::index'),
	(19,'productparams','Product Params','catalog/product-params',NULL,1,NULL,NULL,NULL);

/*!40000 ALTER TABLE `section_type` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы store
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent` int DEFAULT NULL,
  `addr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordinates` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;

INSERT INTO `store` (`id`, `title`, `slug`, `ord`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`, `parent`, `addr`, `phone`, `email`, `work_hours`, `coordinates`)
VALUES
	(1,'Москва','moscow',0,NULL,NULL,NULL,'active','2025-07-23 18:22:39','2025-07-23 18:22:39',110,'г. Москва, ул. Новочеремушкинская 69Б','+7(495) 545-39-00','shop@utepliteli.org','Пн - Пт: 9.00 - 18.00<br>Сб - Вс: выходные','7ce02a5c97f6461158d06421a049419a65f1d309fae40176652ccb12f72f4a93'),
	(2,'ТДСТ Изоляция Северо-Запад','sankt-peterburg',0,NULL,NULL,NULL,'active','2025-07-25 14:02:20','2025-07-25 14:02:20',110,'г. Санкт-Петербург, вн. тер. г. муниципальный округ Лиговка-Ямская, пр-кт Лиговский, д. 56, литера Г, помещ. 21Н, офис 403','+7 (812) 927-42-21',NULL,'Пн - Пт: 9.00 - 18.00<br>Сб - Вс: выходные','aeed5bd2ae16a86a90077f45924cab924aef5aa8bd03cdbb9250a5e12ef21b50'),
	(3,'ТДСТ Изоляция ЮГ','rostov-na-donu',0,NULL,NULL,NULL,'active','2025-07-28 14:06:50','2025-07-28 14:06:50',110,'г. Ростов-на-Дону, ул. Вавилова, 62Г,  (офис 6,9,10, этаж 3)','+7 (863) 206-13-27<br>+7 (863) 206-17-35<br>+7 (863) 294-41-38',NULL,'Пн - Пт: 9.00 - 18.00<br>Сб - Вс: выходные','b7e2474345de58a2bf2e2208e7d1babe9ac7e8b8be18ce5db6fad8f718fea885'),
	(4,'ТДСТ Изоляция Тверь','tver',0,NULL,NULL,NULL,'active','2025-07-28 14:07:38','2025-07-28 14:07:38',110,'Тверская область, Конаковский район, д. Заполок, 100','+7 (910) 647-56-50',NULL,'Пн - Пт: 9.00 - 18.00<br>Сб - Вс: выходные','913c01b2568fd8cd310af045e0b7ed9c92ca47a88bdb8935c1aae343a9be8f42'),
	(5,'ТДСТ Изоляция Краснодар','krasnodar',0,NULL,NULL,NULL,'active','2025-07-28 14:10:33','2025-07-28 14:10:33',110,'Краснодар, Улица Тополиная 29','+7 (861) 201-92-98',NULL,'Пн - Пт: 9.00 - 18.00<br>Сб - Вс: выходные','7e5d81902aa287b5f78371c98d39d89a07ae0b52b81b4a33592a1459a8c95fcd');

/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы store_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_list`;

CREATE TABLE `store_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `ord` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `store_list` WRITE;
/*!40000 ALTER TABLE `store_list` DISABLE KEYS */;

INSERT INTO `store_list` (`id`, `slug`, `title`, `parent`, `ord`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'stores','Магазины',96,0,NULL,NULL,NULL,'active','2025-07-25 14:17:16','2025-07-25 14:17:16');

/*!40000 ALTER TABLE `store_list` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `first_name`, `last_name`, `phone`, `address`)
VALUES
	(3,'nevinny@gmail.com','[]','$2y$13$UG8eHwZVQt.LLlV.Q4vhseF9QEZtnlYEzuvbRQjWrKqZxnsoCWsUi',0,'1','крекин','79265565231','ул. Деловая д. 18');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
