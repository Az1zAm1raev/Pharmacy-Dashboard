-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 10 2024 г., 18:42
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dfsms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tax_codes`
--

CREATE TABLE `tax_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tax_codes`
--

INSERT INTO `tax_codes` (`id`, `code`, `name`) VALUES
(1, '001', 'Октябрьский район'),
(2, '002', 'Ленинский район'),
(3, '003', 'Свердловский район'),
(4, '004', 'Первомайский район'),
(5, '005', 'Аламудунский район'),
(6, '007', 'Кеминский район'),
(7, '008', 'Ысык-Атинский район'),
(8, '009', 'Жайыльский район'),
(9, '010', 'Московский район'),
(10, '011', 'Панфиловский район'),
(11, '012', 'Сокулукский район'),
(12, '013', 'Чуйский район'),
(13, '014', 'Ыссык-Кульский район'),
(14, '015', 'Ак-Суйский район'),
(15, '016', 'Тонский район'),
(16, '017', 'Жети-Огузский район'),
(17, '018', 'Тюпский район'),
(18, '019', 'г. Каракол'),
(19, '020', 'г. Балыкчы'),
(20, '021', 'Алайский район'),
(21, '022', 'Чон-Алайский район'),
(22, '023', 'Араванский район'),
(23, '024', 'Баткенский район'),
(24, '025', 'Кара-Суйский район'),
(25, '026', 'Лейлекский район'),
(26, '027', 'Ноокатский район'),
(27, '028', 'Кара-Кулджинский район'),
(28, '029', 'Узгенский район'),
(29, '030', 'Кадамжайский район'),
(30, '031', 'г. Кызыл-Кия'),
(31, '032', 'г. Ош'),
(32, '033', 'г. Сулюкта'),
(33, '034', 'Ак-Талинский район'),
(34, '035', 'Ат-Башинский район'),
(35, '036', 'Кочкорский район'),
(36, '037', 'Жумгальский район'),
(37, '038', 'Нарынский район'),
(38, '039', 'Сузакский район'),
(39, '040', 'Ноокенский район'),
(40, '041', 'Ала-Букинский район'),
(41, '042', 'Токтогульский район'),
(42, '043', 'Аксыийский район'),
(43, '044', 'Тогуз-Тороуский район'),
(44, '045', 'Базар-Курганский район'),
(45, '047', 'Чаткалский район'),
(46, '048', 'г. Джалал-Абад'),
(47, '049', 'г. Таш-Кумыр'),
(48, '050', 'г. Майлы-Суу'),
(49, '051', 'г. Кура-Куль'),
(50, '053', 'Талаский район'),
(51, '054', 'Бакай-Атинский район'),
(52, '055', 'Кара-Бууринский район'),
(53, '056', 'Манагийский район'),
(54, '057', 'г. Талас'),
(55, '058', 'г. Чуй-Токмок'),
(56, '059', 'г. Нарын'),
(57, '060', 'г. Баткен'),
(58, '061', 'г. Бишкек'),
(59, '997', 'УКНН Юг (УННС по контролю за крупными налогоплательщиками по Южному региону)'),
(60, '998', 'СЭЗ Бишкек (Свободная экономическая зона Бишкек( Ленинский РУСП))'),
(61, '999', 'УКНН (УННС по контролю за крупными налогоплательщиками)');

-- --------------------------------------------------------

--
-- Структура таблицы `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(5) NOT NULL,
  `AdminName` varchar(45) DEFAULT NULL,
  `UserName` char(45) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UpdationDate`) VALUES
(1, 'Admin', 'admin', 1234567899, 'admin@test.com', '202cb962ac59075b964b07152d234b70', '2024-01-07 18:30:00', '2024-06-05 07:44:39');

-- --------------------------------------------------------

--
-- Структура таблицы `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL,
  `CategoryCode` varchar(50) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `CategoryCode`, `PostingDate`) VALUES
(1, 'drug1', 'MK01', '2024-01-10 16:27:43'),
(2, 'Обезболивающие', 'BT01', '2024-01-10 16:27:43'),
(3, 'Жаропонижающие', 'BD01', '2024-01-10 16:27:43'),
(4, 'Гормональные', 'PN01', '2024-01-10 16:27:43'),
(5, 'МРТ сканеры', 'SY01', '2024-01-10 16:27:43'),
(8, 'Рентген-аппараты', 'PN01', '2024-01-10 16:27:43');

-- --------------------------------------------------------

--
-- Структура таблицы `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `CompanyName` varchar(150) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `INN` varchar(14) NOT NULL,
  `GNSСode` varchar(3) NOT NULL,
  `Requisites` int(20) NOT NULL,
  `Adres` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `CompanyName`, `PostingDate`, `INN`, `GNSСode`, `Requisites`, `Adres`) VALUES
(1, 'Биокад', '2024-01-10 03:30:51', '20805197100762', '005', 987644321, 'ул. Юнусалиева 87 '),
(2, 'Генериум', '2024-01-10 03:30:51', '20805197100766', '016', 1234567890, '299, 5Б Проспект Ч. Айтматова'),
(3, 'Армед', '2024-01-10 03:30:51', '80519710076604', '040', 1221223333, '7/6 ул. Аалы Токомбаева'),
(4, 'CAS Corporation', '2024-01-10 03:30:51', '80519710076604', '002', 2000092123, 'бизнес-центр Fort, 221 ул. Абдумомунова'),
(10, 'Вертекс', '2024-01-10 03:30:51', '80519710076604', '002', 929872224, '170/2 Фатьянова'),
(11, 'Эс Джи Биотех', '2024-01-10 03:30:51', '80519710076604', '015', 888921812, 'Бакаева 132'),
(12, 'Фармасинтез', '2024-01-10 03:30:51', '00519710076604', '019', 1299933332, 'Лермонтова 2'),
(13, 'Izen', '2024-06-07 15:34:06', '20001232239876', '019', 22000031, '312 просп. Ленина'),
(14, 'Форт', '2024-06-09 11:37:32', '29991232239876', '001', 122133213, '143 ул. Красная'),
(15, 'Фирма', '2024-06-09 11:56:35', '29991232223876', '005', 2147483647, '111 улица Токтоналиева');

-- --------------------------------------------------------

--
-- Структура таблицы `tblorders`
--

CREATE TABLE `tblorders` (
  `id` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `InvoiceNumber` int(11) DEFAULT NULL,
  `CustomerName` varchar(150) DEFAULT NULL,
  `CustomerContactNo` varchar(12) DEFAULT NULL,
  `PaymentMode` varchar(100) DEFAULT NULL,
  `InvoiceGenDate` timestamp NULL DEFAULT current_timestamp(),
  `CRequisites` int(20) NOT NULL,
  `CGNSCode` varchar(3) NOT NULL,
  `CAdres` varchar(255) NOT NULL,
  `CINN` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tblorders`
--

INSERT INTO `tblorders` (`id`, `ProductId`, `Quantity`, `InvoiceNumber`, `CustomerName`, `CustomerContactNo`, `PaymentMode`, `InvoiceGenDate`, `CRequisites`, `CGNSCode`, `CAdres`, `CINN`) VALUES
(116, 9, 1, 604541066, 'Азиз Амираев', '0708760011', 'Карта', '2024-06-09 17:23:15', 2147483647, '007', 'ул. Юнусалиева 87', '20932032923929'),
(117, 12, 1, 483783740, 'Азиз Амираев', '0709760011', 'Карта', '2024-06-10 11:04:30', 2147483647, '009', 'ул. Юнусалиева 87', '22300320032322'),
(118, 10, 1, 483783740, 'Азиз Амираев', '0709760011', 'Карта', '2024-06-10 11:04:30', 2147483647, '009', 'ул. Юнусалиева 87', '22300320032322');

-- --------------------------------------------------------

--
-- Структура таблицы `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductCost` decimal(10,2) DEFAULT NULL,
  `ProductPrice` decimal(10,2) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Quantity` int(11) NOT NULL,
  `Manufacture` varchar(255) DEFAULT NULL,
  `Application` varchar(255) DEFAULT NULL,
  `StorageConditions` varchar(255) NOT NULL,
  `Dosage` varchar(255) DEFAULT NULL,
  `Package` int(11) NOT NULL,
  `BestBefore` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `CategoryName`, `CompanyName`, `ProductName`, `ProductCost`, `ProductPrice`, `PostingDate`, `UpdationDate`, `Quantity`, `Manufacture`, `Application`, `StorageConditions`, `Dosage`, `Package`, `BestBefore`) VALUES
(9, 'drug1', 'Фармасинтез', 'drug1', '8.00', '10.00', '2024-06-09 17:23:15', '2024-06-09 17:23:15', 875, 'Германия', 'Внутреннее', '25°C', '50 мг на 8 часов', 100, '2027-06-30 18:00:00'),
(10, 'Гормональные', 'Фармасинтез', 'Утрожестан', '200.00', '250.00', '2024-06-10 11:04:30', '2024-06-10 11:04:30', 29, 'Япония', 'Внутревенное', '25°C', 'После еды', 10, '2033-06-05 18:00:00'),
(11, 'Обезболивающие', 'Генериум', 'Анальгин', '240.00', '300.00', '2024-06-10 07:50:48', '2024-06-10 07:50:48', 100, 'Россия', 'Внутренее', '20°C', '300 мг на 4 часов', 10, '2027-06-30 18:00:00'),
(12, 'Жаропонижающие', 'Армед', 'Ибупрофен', '79.20', '99.00', '2024-06-10 11:04:30', '2024-06-10 11:04:30', 999, 'Казахстан', 'Внутренее', '20°C', '300 мг на 4 часов', 10, '2028-10-09 18:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tax_codes`
--
ALTER TABLE `tax_codes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CategoryName` (`CategoryName`);

--
-- Индексы таблицы `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CompanyName` (`CompanyName`);

--
-- Индексы таблицы `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`ProductId`);

--
-- Индексы таблицы `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compname` (`CompanyName`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tax_codes`
--
ALTER TABLE `tax_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT для таблицы `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tblorders`
--
ALTER TABLE `tblorders`
  ADD CONSTRAINT `pid` FOREIGN KEY (`ProductId`) REFERENCES `tblproducts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
