-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 05 2023 г., 01:28
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `comics_world`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`, `photo`) VALUES
(1, 'Default', 'default.jpg'),
(4, 'Funko!', '63babb8b90111.jpg'),
(5, 'Hot Toys', '63bb3a15cb6e3.jpg'),
(6, 'Star Wars Black Series', '63c04d5834407.jpg'),
(7, 'Iron Studios', '63c3e76a209d3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `photo`) VALUES
(1, 'Default', 'default.jpg'),
(32, 'Small Figures', '63babb5167c81.jpg'),
(33, 'Medium Figures', '63bb39b396db7.jpg'),
(36, 'Helmets', '63c04cd254916.jpg'),
(38, 'Plush Toys', '63c3effac6a97.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `count`) VALUES
(8, 29, 60, 1),
(9, 30, 51, 1),
(10, 30, 23, 1),
(11, 30, 53, 1),
(12, 30, 50, 1),
(13, 31, 60, 1),
(14, 32, NULL, 1),
(15, 33, NULL, 1),
(16, 33, 56, 1),
(17, 34, NULL, 1),
(18, 34, 60, 1),
(19, 35, 60, 1),
(20, 35, 56, 1),
(21, 35, 49, 1),
(22, 35, 51, 1),
(23, 36, 63, 1),
(24, 36, 66, 1),
(25, 36, 54, 1),
(26, 37, 66, 1),
(27, 38, 66, 1),
(28, 39, 65, 1),
(29, 40, 60, 1),
(30, 41, 66, 1),
(31, 41, 65, 1),
(32, 42, 62, 1),
(33, 43, 70, 1),
(34, 43, 63, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `personage`
--

CREATE TABLE `personage` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `personage`
--

INSERT INTO `personage` (`id`, `name`, `photo`) VALUES
(1, 'Default', 'default.jpg'),
(6, 'Bobba Fett', '63babb5e89510.jpg'),
(7, 'Obi-Van Kenobi', '63babb7ce7ce2.jpg'),
(8, 'Darth Vader', '63babbda6b261.jpg'),
(10, 'Joker', '63bac8a801955.jpg'),
(11, 'Spider Man', '63bac9afbdb7e.jpg'),
(12, 'Iron Patriot', '63bb397e53355.jpg'),
(13, 'Echo', '63bb3aaa8bd27.jpg'),
(14, 'Venom', '63bb3b0945ff2.jpg'),
(15, 'Mandalorian', '63bb3b60e925f.jpg'),
(16, 'Loki', '63bb3f0beb61e.jpg'),
(17, 'Captain Rex', '63c04adc787f5.jpg'),
(18, 'Deadpool', '63c3e70595f4f.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `category_id` int DEFAULT NULL,
  `theme_id` int DEFAULT NULL,
  `personage_id` int DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  `price` double NOT NULL,
  `count` int NOT NULL,
  `short_description` text,
  `description` text,
  `visible` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `photo`, `category_id`, `theme_id`, `personage_id`, `brand_id`, `price`, `count`, `short_description`, `description`, `visible`) VALUES
(21, 'Funko POP! Star Wars: The Mandalorian: Boba Fett', '63babae27b0bb.jpg', 32, 7, 6, 4, 1100, 5, '<p>Hendrerit euismod a himenaeos tempus phasellus iaculis ante lobortis ipsum odio lacus. Hendrerit lobortis natoque cursus sollicitudin si tincidunt donec dis nunc dignissim vehicula.</p>', '<p>Lacus libero auctor torquent platea euismod quis. Orci ridiculus augue bibendum ante enim suspendisse. Posuere class porttitor consectetur litora maximus lectus placerat etiam dapibus mauris. Sem torquent conubia scelerisque commodo semper sed purus ex. Velit facilisi suspendisse fames maecenas ac ultricies lacinia vel curabitur integer dapibus. Cursus porta purus sollicitudin nulla et duis fusce quis. Nullam tincidunt nunc mi massa auctor.</p><p>Habitant nulla vitae nostra sed ut eleifend quisque quam at potenti consectetuer. A mi tellus dis integer primis vivamus vestibulum aptent nunc. Porttitor pretium consectetur ullamcorper elit ex nostra ad. Imperdiet letius nullam class massa lacus eros himenaeos ante. Ipsum amet scelerisque posuere nam penatibus finibus adipiscing placerat eleifend felis ligula. Urna nisl ac fermentum tellus neque class sociosqu dolor maecenas ante lacinia. In semper parturient euismod volutpat id duis urna facilisis.</p>', 1),
(22, 'Funko POP! Star Wars: Obi-Wan Kenobi', '63babae940091.jpg', 32, 7, 7, 4, 750, 10, '<p>Ligula est vehicula libero congue nullam praesent iaculis sed non. Nulla dui ullamcorper aenean tellus interdum si consequat fringilla id parturient etiam.</p>', '<p>Posuere magna ut magnis vitae taciti habitant praesent molestie. Conubia sociosqu curabitur felis per erat platea et molestie. Himenaeos dolor arcu ridiculus torquent letius quam placerat. Nisl commodo ex fames donec placerat magnis.</p><p>Sagittis mus natoque laoreet porta habitant eros at habitasse. Habitasse egestas lorem ad morbi porta suscipit quam iaculis urna cubilia. Venenatis integer interdum vehicula orci pharetra aliquam. Parturient posuere pulvinar eu curabitur lectus nulla risus sollicitudin si nec. In netus lectus mus congue habitasse elementum vivamus dignissim odio. Tristique bibendum facilisi justo sapien vel non quisque proin rhoncus malesuada elementum. Blandit praesent gravida neque nascetur feugiat torquent felis.</p>', 1),
(23, 'Funko POP! Star Wars: Darth Vader', '63babaeeefeb9.jpg', 32, 7, 8, 4, 750, 11, '<p>Porta pellentesque luctus auctor nunc torquent. Dictum magna suspendisse cubilia potenti ante.</p>', '<p>Urna augue himenaeos odio aptent ipsum mus diam. Taciti ut magnis mattis donec orci hendrerit. Fringilla sapien dictumst pharetra ridiculus tristique. Consectetur eros letius curabitur malesuada habitasse rutrum mollis dictumst aliquet commodo justo. Sem ultricies turpis aliquet viverra lobortis suscipit imperdiet accumsan dictumst vehicula. Maximus vulputate neque viverra ornare semper. Metus neque sagittis nam letius semper aliquam.</p><p>Aptent efficitur convallis suspendisse netus fusce nisi. Tempor lacus si ligula vel pede augue ac. Habitant nisi vulputate tortor tristique lectus justo natoque suspendisse odio. Integer dignissim tristique ad efficitur convallis dictum adipiscing a dui.</p>', 1),
(24, 'Funko POP! Star Wars: Ben Kenobi on Eopie', '63babaf474552.jpg', 32, 7, 7, 4, 1950, 3, '<p>Magna turpis risus letius suspendisse tempor dapibus quisque efficitur. Cras pede commodo lacinia placerat etiam ac dui potenti.</p>', '<p>Фігурка Funko POP! Marvel: Venom: Let There Be Carnage: Venom</p>', 1),
(25, 'Funko POP! Star Wars: Luke Skywalker w/Grogu', '63babafb145d6.jpg', 32, 7, 1, 4, 750, 12, '<p>Accumsan eget erat tortor consequat finibus habitasse feugiat gravida. Suspendisse vestibulum volutpat nam ligula ultrices morbi nullam ac mi.</p>', '<p>Platea maximus si parturient maecenas nec risus nascetur. Ornare fusce hac letius vivamus aliquet. Tempus ornare euismod dolor ullamcorper mus libero. Porta suspendisse efficitur facilisis convallis vulputate montes parturient et hac non mus. Orci rutrum proin per faucibus tempus fusce efficitur magnis. Purus dui venenatis lacus morbi et.</p><p>In blandit nullam semper condimentum leo sociosqu sed lobortis congue. Convallis enim morbi sit mus neque donec pretium pharetra. Dapibus vulputate ac ipsum rhoncus netus. Natoque potenti morbi mi vehicula quam. Sollicitudin dignissim mattis lorem maecenas sed urna ultricies erat hendrerit malesuada.</p>', 1),
(29, 'Pop! Funko Star Wars The Mandalorian Hooded Luke Skywalker Vinyl Figure', '63bac422290ce.jpg', 32, 7, 1, 4, 1000, 6, '<p>Tellus lorem massa eget curae litora nisl. Vivamus augue arcu facilisi viverra quisque auctor.</p>', '<p>Torquent felis suspendisse sapien himenaeos penatibus eleifend ultricies nullam pretium. Fringilla dictum natoque maximus aliquet condimentum. Sapien dis venenatis dignissim justo euismod hac sit metus. Ex commodo lobortis nibh phasellus praesent rhoncus hac. Nunc viverra fusce mi tempus hendrerit ipsum feugiat eu litora dictum quisque.</p><p>Placerat laoreet integer suscipit non primis. Dapibus aliquet sem sed porta integer parturient. Donec taciti placerat dis natoque eros consectetur torquent. Potenti sed leo maximus class sollicitudin magnis ex venenatis bibendum. Nisi suspendisse quis tempus convallis laoreet odio velit ut sollicitudin.</p>', 1),
(30, 'Funko 8716 – Star Wars Luke Skywalker, Version Bespin', '63bac4da01e9b.jpg', 32, 7, 1, 4, 1400, 8, '<p>Congue sit at himenaeos gravida enim ligula sociosqu magna. Duis parturient nec maecenas volutpat sit dignissim penatibus erat magna class letius.</p>', '<p>Convallis tellus habitant ullamcorper quis sociosqu viverra dapibus litora facilisi commodo. Elit morbi tellus duis at mi diam viverra lacinia sem a. Ultricies erat duis etiam adipiscing himenaeos. Fermentum amet congue aliquet ut tortor parturient. Consectetur maecenas tellus curabitur facilisis lectus senectus ligula.</p><p>Lacus dui justo leo libero ac arcu consequat facilisi velit netus nisi. Sapien donec nec ipsum lacinia diam eleifend nisl ullamcorper ultricies. Ridiculus augue lacinia id nam sodales magna libero aliquam vestibulum. Nulla luctus nec taciti bibendum tincidunt ante. Vehicula potenti ultricies porttitor dapibus blandit nascetur elementum. Cras hendrerit facilisis fermentum pretium pede convallis netus ridiculus. Finibus praesent venenatis litora pellentesque quis neque facilisi velit dictumst.</p>', 1),
(32, 'Funko POP! Star Wars: Futura - Boba Fett (ECCC Shared Exclusive)', '63bac5c76b2b6.jpg', 32, 7, 6, 4, 2500, 3, '<p>Ad at ex a dui facilisis duis tempus scelerisque. Consequat habitant ridiculus hac sit ac porta at finibus conubia nulla.</p>', '<p>Vulputate class ipsum dictumst tincidunt magnis nec gravida habitant nam vehicula. Pretium hac letius ligula placerat a. Pede eleifend finibus vulputate ornare potenti sit senectus donec turpis dignissim. Convallis congue penatibus justo quam tempor nunc sapien vehicula. Per maximus porta bibendum phasellus non pellentesque. Suspendisse interdum netus cubilia hac vulputate tempus posuere urna neque class consectetuer. Sodales fringilla penatibus nostra justo aenean montes torquent.</p><p>Quam dis sit sagittis malesuada lectus nulla vivamus. Felis tortor blandit ligula class cubilia adipiscing tristique habitant enim. Nec mauris dapibus montes sociosqu est praesent platea vulputate sagittis et. Per porttitor velit pulvinar maximus molestie sit nisl. Amet vestibulum platea venenatis in cursus bibendum facilisis. Quisque si leo pede tellus hac vehicula curabitur. Ultrices sagittis turpis diam tellus facilisis taciti elementum lacinia class facilisi cursus. Interdum lectus aenean inceptos dictumst nulla neque nisi per malesuada primis.</p>', 1),
(33, 'Hype\'s Goods Funko POP Star Wars: Futura x Funko - Boba Fett', '63bac601b7505.jpg', 32, 7, 6, 4, 900, 5, '<p>Ullamcorper accumsan facilisis senectus nulla imperdiet vulputate habitasse. Viverra taciti cras pretium metus bibendum aliquam facilisi lectus mus erat euismod.</p>', '<p>Tincidunt morbi faucibus suscipit dapibus ligula integer. Enim ac nibh sapien nisi nunc. Phasellus molestie enim parturient lorem mauris quam metus curae tincidunt a in. Enim at sit eros nisl aliquam commodo mauris diam dignissim curae tristique. Ante nec gravida ut urna cursus. Habitant cursus primis integer adipiscing lectus mollis purus venenatis mauris aliquet condimentum. Molestie potenti ex scelerisque tincidunt torquent primis commodo in.</p><p>Feugiat maecenas nascetur porta tortor amet eros sed. Efficitur dui per vestibulum suspendisse pharetra ultrices. Nulla nam dolor malesuada nostra in. Nisi integer nascetur eget lacinia nisl etiam dictumst. Molestie lobortis eget malesuada commodo parturient viverra laoreet.</p>', 1),
(34, 'Funko POP! Star Wars 40th Anniversary The Empire Strikes Back #367 - Boba Fett [10 Inch] Exclusive Funko POP! Star Wars 40th Anniversary The Empire Strikes Back #367 - Boba Fett [10 Inch] Exclusive', '63bac6428b2d8.jpg', 32, 7, 6, 4, 3500, 1, '<p>Dis amet ullamcorper rhoncus nec senectus sodales ex pulvinar dui penatibus. Nulla leo euismod eros orci suspendisse duis amet magnis consectetuer pharetra curae.</p>', '<p>Pellentesque maximus tincidunt mollis condimentum rhoncus tellus morbi quis mauris donec. Elit vulputate et consectetuer phasellus maximus eget viverra. Letius cursus nibh quis arcu consequat eu. Mi eu mollis convallis ipsum elementum curae. Cras nunc scelerisque habitasse arcu potenti si lobortis placerat aptent ipsum. Iaculis suspendisse maximus convallis sociosqu maecenas rutrum eros ipsum donec. Quam at potenti scelerisque pulvinar adipiscing. Vel semper venenatis dolor volutpat erat donec tempus.</p><p>Luctus dictum laoreet arcu inceptos taciti et condimentum praesent vitae eros. Quam semper pellentesque commodo tortor curabitur metus viverra aenean vestibulum. Torquent taciti luctus hendrerit erat purus nisi. Ultricies laoreet porta primis class accumsan ligula senectus montes efficitur ante elementum. Vivamus molestie odio mattis tempus facilisis at curabitur ex tincidunt. Gravida ut velit morbi turpis risus cras si tempus luctus dignissim. Egestas et turpis vulputate id imperdiet.</p>', 1),
(35, 'Funko Pop Star Wars: Clone Wars - OBI Wan Kenobi Collectible Figure, Multicolor', '63bac6b75d171.jpg', 32, 7, 7, 4, 800, 6, '<p>Duis aptent litora molestie class efficitur sodales lacus rutrum. Rutrum hendrerit viverra nisi scelerisque porttitor.</p>', '<p>Litora nascetur tristique leo cubilia justo. Maximus consectetuer primis ligula imperdiet et fringilla cras nibh nulla. Augue hendrerit primis ullamcorper nec potenti convallis ultrices laoreet vestibulum mollis conubia. Sem augue porta odio taciti adipiscing cras velit class facilisis. Aliquet arcu conubia efficitur ex congue dui gravida dolor. Habitasse elementum imperdiet vestibulum integer suspendisse ultricies semper platea quisque fringilla diam. Odio ex consequat nullam eleifend cras massa ante augue.</p><p>Arcu auctor ante nibh ullamcorper amet ultricies. Ante tempor hac sagittis purus penatibus euismod massa tempus nec. Luctus tristique eros nam dui lacinia vitae elementum ornare inceptos. Lorem aliquam platea enim mattis mollis penatibus morbi at nunc ut.</p>', 1),
(36, 'Funko Pop OBI-Wan Kenobi in Jedi Robe 544 Exclusive Box and Slip Protector Include', '63bac6f9aab89.jpg', 32, 7, 7, 4, 1100, 4, '<p>Sociosqu sollicitudin conubia molestie odio himenaeos dapibus luctus libero litora. Donec dolor convallis in metus fringilla turpis sapien habitant litora suscipit.</p>', '<p>Nunc primis dictum luctus sociosqu placerat adipiscing sit dignissim mollis. Tincidunt nullam aliquam at cubilia ex ornare. Consectetuer eu rhoncus facilisis parturient cursus senectus aliquam vulputate mattis. Diam habitant morbi si auctor litora lobortis ornare pharetra molestie. Consequat maecenas sit parturient himenaeos condimentum lacinia vitae amet duis. Scelerisque vehicula curabitur commodo et tristique dictum. Aliquam eget luctus ultrices sit litora urna.</p><p>Rhoncus potenti mi pede fames arcu nostra lectus tincidunt. Tincidunt amet aliquet vitae hendrerit morbi dolor nec ultricies mi urna parturient. Proin et si nec dolor tristique dictumst magna interdum sed elit congue. Integer aliquet feugiat nibh aliquam consectetuer ridiculus taciti. Mi consectetuer imperdiet lobortis commodo interdum et malesuada magna lorem vivamus. Dictum laoreet pellentesque quam sem egestas.</p>', 1),
(37, 'Funko POP! Star Wars Young OBI-Wan Kenobi #273 (Hooded with Light Saber)', '63bac833b9bb8.jpg', 32, 7, 7, 4, 1700, 3, '<p>Proin maecenas magna augue cubilia et venenatis molestie lectus erat. Lobortis blandit amet pede inceptos sed sodales interdum dis erat sollicitudin ultricies.</p>', '<p>Vehicula nostra eros dictumst consectetur montes torquent. Scelerisque ipsum id nullam turpis phasellus sit. Risus molestie ligula sagittis felis pellentesque tellus dui interdum fringilla. Ex cras dapibus et ridiculus in ullamcorper aptent dolor conubia proin vel. Fringilla libero malesuada purus inceptos arcu ad ac turpis aptent eleifend. Ut donec himenaeos tortor nunc ac. Mollis augue sapien suspendisse ac suscipit maximus ut rutrum.</p><p>Nullam in enim fermentum ultrices consectetuer. Natoque interdum aptent vulputate potenti vestibulum aliquet. Porta integer curae suscipit enim erat ipsum non maecenas potenti vitae vel. Consectetuer velit faucibus lectus primis sollicitudin litora auctor consectetur eleifend fusce pede. Feugiat sed senectus est massa imperdiet eleifend pede sapien auctor. Dolor massa praesent congue nascetur taciti enim morbi habitant ac si dictumst.</p>', 1),
(38, 'Funko POP Movies: Suicide Squad Action Figure, The Joker Shirtless', '63bac8d34b238.jpg', 32, 8, 10, 4, 1100, 1, '<p>Aenean purus elit sed dictumst magna. Dui nam condimentum auctor montes blandit platea nisl tortor arcu metus.</p>', '<p>Mollis ultricies laoreet commodo hendrerit faucibus ex curae habitant congue urna tortor. Morbi quis litora ex dictum donec. Imperdiet libero leo erat ultrices justo sollicitudin tristique. Purus quisque netus mollis habitant dis scelerisque consectetuer ridiculus dictum facilisi integer. Pretium cras viverra hac justo posuere potenti sodales vulputate interdum pharetra. Morbi iaculis tristique nascetur torquent natoque primis lorem tempor sit ligula. Consequat tincidunt aptent interdum porttitor integer mollis ultrices pretium a.</p><p>Eros platea tempus senectus praesent mus eleifend letius lorem. Odio consequat amet vel non porttitor ex sed semper phasellus dolor metus. Curae hendrerit nulla cras consequat enim commodo gravida vel vehicula. Sem sodales odio mattis eget facilisi pellentesque. Hac enim sapien fusce iaculis posuere fringilla egestas pulvinar dictum non. Per pretium tellus imperdiet in mattis pharetra nulla quis tincidunt.</p>', 1),
(40, 'Funko Pop Batman 1989 The Joker AE Metallic Exclusive', '63bac9475b7ee.jpg', 32, 8, 10, 4, 980, 5, '<p>Scelerisque aliquet auctor egestas mus finibus aliquam quis si imperdiet. Ad aptent taciti etiam ipsum litora nullam per cras ridiculus.</p>', '<p>Fringilla eu eleifend netus class magnis. Potenti tincidunt fames felis montes a curabitur. Facilisis curae suspendisse vulputate aliquet arcu egestas viverra aenean efficitur dui congue. At ridiculus magna leo feugiat maximus. Elit euismod fringilla montes eleifend dignissim ornare erat inceptos justo quam vestibulum. Parturient erat nec non ridiculus nostra auctor. Dapibus mollis eros molestie semper tellus a hac eu. Ultricies eleifend luctus lacinia porta senectus porttitor tempor malesuada consectetuer potenti.</p><p>Nulla enim eleifend urna quis a scelerisque odio. Pede est himenaeos a aliquet convallis mus phasellus risus mattis ante urna. Quam habitasse natoque nec sem nullam. Consectetuer nullam congue lorem aliquam nunc praesent etiam laoreet egestas nisi neque. Nostra posuere venenatis vitae lacus aenean porttitor himenaeos duis tempor eros condimentum. Pulvinar suspendisse curabitur eros iaculis torquent. Ligula primis hac mi cursus ad.</p>', 1),
(41, 'Funko Pop Marvel Games: Spider-Man Video Game - Unmasked Spider-Man Collectible Figure, Multicolor, Standard', '63bac9e0b324f.jpg', 32, 9, 11, 4, 800, 5, '<p>Rutrum curae ullamcorper dui massa volutpat mauris luctus sollicitudin orci quam. Dignissim facilisi nullam tortor cubilia per integer praesent.</p>', '<p>Nulla gravida rhoncus ad commodo finibus litora at dictumst arcu justo class. Eleifend eros nibh elementum pretium ultricies est etiam blandit. Condimentum tincidunt vehicula at sagittis ex et faucibus aenean sed facilisis morbi. Justo accumsan faucibus pede id proin class. Ligula eleifend pellentesque mus ultricies amet pretium duis. Sagittis justo quam molestie ipsum maximus finibus donec sociosqu ultrices est pharetra.</p><p>Vel blandit penatibus elit nam adipiscing dignissim mi turpis urna lacus arcu. Eget diam sodales vel etiam porttitor. Enim praesent leo elit sagittis primis porta mattis odio. Cursus eleifend rhoncus praesent penatibus neque volutpat lacinia venenatis.</p>', 1),
(42, 'Funko Pop Spider-Man Spirit Spider #467 Exclusive', '63baca1c4fa8a.jpg', 32, 9, 11, 4, 1100, 2, '<p>Augue mattis interdum nisi himenaeos ultricies sagittis porta viverra est phasellus suscipit. Per maximus consequat at venenatis sodales viverra dis.</p>', '<p>Adipiscing rhoncus viverra condimentum vestibulum praesent neque maximus leo litora platea gravida. Inceptos molestie iaculis ex nascetur lectus consectetur massa. Potenti eleifend ac morbi litora erat. Pharetra enim viverra pede integer nisl facilisis ipsum interdum.</p><p>Sollicitudin ultrices nisi ultricies velit posuere ante faucibus elit in lorem risus. Cubilia ultrices commodo posuere porta nam morbi orci conubia est. Quisque arcu vel odio praesent non nunc est mi ridiculus sapien. Mauris suscipit lacus auctor lectus rutrum accumsan velit rhoncus egestas enim maximus. Metus magna odio aliquam accumsan convallis elementum nisl congue. Bibendum mattis pretium blandit cras litora quisque quam consectetur molestie. Adipiscing dui gravida scelerisque massa ultricies volutpat. Si dictum id ac sem habitant pretium at.</p>', 1),
(43, 'Funko POP! Marvel #672 - Spider-Man [with Pizza] Exclusive', '63baca4780188.jpg', 32, 9, 11, 4, 1300, 2, '<p>Mattis senectus cras mauris aenean ridiculus conubia pharetra si. Leo finibus quam velit dui senectus amet aliquam dapibus duis dignissim.</p>', '<p>Primis luctus erat nostra non vel commodo rhoncus finibus eu. Quisque sociosqu vestibulum parturient leo nisi nisl tincidunt sagittis. Per phasellus nostra conubia pharetra id mollis. Dictumst etiam ridiculus quis duis accumsan montes felis malesuada potenti. Lorem tincidunt nascetur tempor in phasellus semper natoque consectetur venenatis mi consequat.</p><p>Nostra taciti imperdiet primis habitant vitae in tempus nulla. Phasellus orci taciti congue et porta torquent consequat commodo. Hac odio torquent litora nullam fermentum porta suspendisse pharetra ornare eleifend. Inceptos mollis netus est neque hac imperdiet nulla consectetur feugiat. Amet maecenas at vitae auctor aliquet torquent.</p>', 1),
(44, 'Movie Masterpiece DIECAST Avengers: End Game, 1/6 Scale Figure, Iron Patriot', '63bb3a3f7cb42.jpg', 33, 9, 12, 5, 12000, 1, '<p>Mus ad gravida lectus nisi sit dolor donec viverra per ut euismod. Taciti consequat magna consectetuer elit dignissim nunc habitasse.</p>', '<p>Nibh interdum orci vitae ultricies praesent senectus at est scelerisque nunc. Vel nibh fames pellentesque cras interdum nec. Penatibus vulputate massa metus a turpis placerat. Lobortis curabitur aptent posuere a eu letius parturient nam. Nostra consectetuer ante tortor orci imperdiet fusce laoreet feugiat nullam himenaeos. Senectus condimentum sagittis commodo vestibulum malesuada volutpat. Nisl facilisi nunc fames potenti leo ac elementum erat. Dictum lobortis rutrum consectetuer tristique aenean himenaeos non habitasse hac.</p><p>Scelerisque turpis laoreet hac nascetur curae integer penatibus ex blandit morbi. Viverra mauris metus faucibus nibh litora leo luctus habitant venenatis. Nostra letius pharetra maximus lobortis efficitur rutrum cursus nisl purus. Tincidunt parturient porta ad in nullam tortor morbi. Suscipit viverra laoreet feugiat id pretium rutrum sodales convallis cursus nunc vivamus. Nostra purus platea morbi dictumst volutpat nullam placerat metus quisque. Malesuada maximus vel vitae nostra class turpis quis. Maecenas per dictumst orci consequat ridiculus elit torquent non imperdiet class.</p>', 1),
(45, 'Hot Toys 1:6 Miles Morales - Bodega Cat Suit, Black', '63bb3a7a848be.jpg', 33, 9, 11, 5, 8500, 2, '<p>Faucibus quis erat posuere laoreet a nascetur letius vulputate venenatis malesuada. Sapien ultrices integer augue ridiculus vestibulum sagittis morbi risus taciti.</p>', '<p>Hendrerit pharetra magna at sagittis ullamcorper ornare dui nostra himenaeos. Fringilla egestas nam sagittis penatibus lectus quam dolor. Velit mauris mus netus placerat efficitur natoque est urna non risus dictumst. Proin cubilia sodales consectetuer vel donec interdum tellus. In rutrum urna suspendisse litora nulla etiam tortor fusce mi pellentesque.</p><p>Himenaeos nunc maecenas dolor interdum parturient maximus nisi at orci tellus si. Congue ad placerat imperdiet suspendisse porttitor. Tincidunt dignissim dis taciti cras platea urna. Integer accumsan aliquam duis torquent quisque ex feugiat eros diam parturient. Congue morbi condimentum nec mi ligula elit proin senectus leo.</p>', 1),
(46, 'Hot Toys 1:6 Echo - Star Wars: The Bad Batch, Black', '63bb3ad642987.jpg', 33, 7, 13, 5, 9000, 2, '<p>Ultricies molestie magnis bibendum dis eu feugiat sit sapien non consectetur placerat. Facilisis vitae mollis justo himenaeos tortor.</p>', '<p>Nunc penatibus himenaeos commodo mollis conubia eros. Semper porttitor ultricies ultrices facilisi letius facilisis. Risus ligula turpis sed nibh velit habitant lorem. Cursus vestibulum natoque torquent adipiscing vel ut curae tempor bibendum iaculis. Ultrices himenaeos et accumsan luctus facilisis eleifend semper ex si. Metus hac dapibus consequat ullamcorper facilisis.</p><p>Conubia eu egestas donec ipsum arcu aptent neque viverra diam quis nisi. Tortor mattis nibh massa dictum praesent purus euismod parturient. Nostra habitasse aliquam mollis dignissim est eleifend posuere dictumst conubia maximus. Dictumst platea himenaeos lobortis facilisis ac venenatis inceptos blandit porttitor libero. Malesuada lobortis lacinia vivamus quisque auctor habitant est condimentum nisl.</p>', 1),
(47, 'Hot Toys 1:6 Venomized Iron Man - Marvel\'s Spider-Man: Maximum Venom, Multicoloured', '63bb3b359e680.jpg', 33, 9, 14, 5, 15000, 1, '<p>Proin sem aliquet rhoncus sagittis nisl risus. Lectus erat luctus purus si tempus tincidunt in ultrices vitae taciti cras.</p>', '<p>Libero tortor semper nam eros consequat dignissim tempor leo eleifend. Ullamcorper sagittis ex aenean condimentum litora facilisi natoque. Class mus habitant tempor molestie mattis taciti vivamus. Gravida enim mi nam fermentum natoque vel vehicula parturient facilisi. Felis pellentesque magna habitant metus est mauris enim quisque. Augue venenatis justo auctor est nisi. Fames tincidunt tellus aliquam ligula ut. Posuere letius augue eget cras pharetra.</p><p>Placerat consectetuer curabitur tempus massa volutpat sed luctus. Ullamcorper massa tincidunt lorem leo himenaeos congue magnis si. Ad posuere rhoncus sociosqu finibus ornare dapibus laoreet metus semper imperdiet in. Mi amet facilisis adipiscing vehicula eu ligula nisi cursus in. Imperdiet mus porttitor at placerat dapibus erat nunc efficitur conubia dictumst.</p>', 1),
(48, 'Hot Toys Star Wars The Mandalorian - Television Masterpiece Series The Mandalorian 1/6 Scale Collectible Figure', '63bb3b881b329.jpg', 33, 7, 15, 5, 10000, 1, '<p>Ullamcorper primis id pharetra est semper sollicitudin enim. Laoreet est penatibus inceptos ridiculus luctus.</p>', '<p>Molestie nisi suscipit ex cubilia ultrices suspendisse vestibulum. Integer lacus volutpat blandit ultrices mauris lacinia condimentum ridiculus dictumst nec. Litora enim lorem id eros lacinia quisque eleifend lectus potenti. Sociosqu ex mattis risus natoque potenti erat. Auctor lacinia senectus lacus dolor cursus felis. Maximus purus elit malesuada velit commodo mi suscipit massa et duis non.</p><p>Taciti augue quis et tristique elementum. Proin venenatis massa lorem letius metus per curabitur morbi potenti. Feugiat facilisis sem curae si sollicitudin tincidunt quam netus elementum. Luctus quam vivamus mattis eros suspendisse taciti mauris. Penatibus quis faucibus dui taciti finibus laoreet rutrum risus egestas vestibulum. Aptent blandit porta commodo letius elit gravida urna habitasse. Urna donec eleifend vivamus nisl posuere dis massa vulputate facilisi.</p>', 1),
(49, 'Star Wars Darth Vader 1:6th Scale Figure', '63bb3be290bb0.jpg', 33, 7, 8, 5, 15000, 0, '<p>Tortor torquent efficitur habitasse dictum molestie montes hac taciti himenaeos. Facilisi cras justo non ac augue inceptos pharetra risus sed ex sagittis.</p>', '<p>Mus ut tempor odio nibh ad dolor. A penatibus letius ornare dictum porta adipiscing ullamcorper natoque vivamus. Taciti posuere nullam odio fames laoreet. Ligula faucibus mollis massa felis volutpat quisque enim hendrerit condimentum ultricies. Accumsan quisque lacinia odio convallis dictum natoque auctor libero. Tellus suspendisse integer laoreet mauris cras rhoncus dui ex taciti maecenas hac. Gravida ridiculus ut consectetur finibus sapien est. Cras vivamus conubia malesuada praesent vitae aenean imperdiet ultricies maecenas arcu sed.</p><p>Eleifend ut dapibus urna enim arcu nullam sed conubia dictum integer. Interdum pharetra aptent mi vehicula sociosqu mattis donec. Maecenas letius dictum vehicula tellus ultricies proin litora. Volutpat aliquam consectetur mattis senectus porttitor curabitur venenatis torquent orci adipiscing. Efficitur urna tortor nostra mollis commodo. Habitasse dictum quis cubilia consequat habitant. Eget ad blandit class taciti ridiculus tincidunt lacus.</p>', 1),
(50, 'Movie Masterpiece 1/6 Darth Vader (Star Wars Episode 5 40th Anniversary Edition)', '63bb3c3547eee.jpg', 33, 7, 8, 5, 17000, 0, '<p>Duis est suspendisse sit semper mattis efficitur. Ligula orci ullamcorper elit augue cras eros ac posuere adipiscing et pharetra.</p>', '<p>Enim maecenas semper aliquam nisl montes diam lobortis. Fusce eros ante sapien integer in lobortis proin conubia convallis. Libero est feugiat taciti pretium iaculis elementum montes. Imperdiet accumsan proin aliquet enim tempus.</p><p>Dui suspendisse montes duis viverra vehicula mi. Quisque si et interdum magna morbi diam condimentum nullam lobortis libero. Primis eleifend risus morbi integer conubia. Tincidunt primis justo aptent lobortis scelerisque eros lorem nullam. Per taciti id dictum facilisi feugiat inceptos. Lorem tincidunt iaculis sit consequat vestibulum elementum posuere luctus. Orci dictumst natoque eros nostra pulvinar nisi habitasse risus imperdiet.</p>', 1),
(51, 'Star Wars Ep7 Darth Vader The Force Awakens Darth Vader Pillow Buddy', '63bb3cd2a8e2e.jpg', 1, 7, 8, 1, 600, 4, '<p>Turpis erat adipiscing ac dictum rutrum nulla in. Per proin donec ac dictum lacinia tempus quisque mauris.</p>', '<p>Mi maecenas nullam duis dis tincidunt sollicitudin. Sapien habitasse metus bibendum erat vulputate turpis ligula. Vehicula dapibus lacinia conubia morbi imperdiet aliquam quis magna eu fusce metus. Mauris sollicitudin habitant mi platea diam euismod consectetuer semper sapien. Elementum aenean aliquet tempor laoreet turpis inceptos pretium vivamus. Tristique placerat iaculis egestas nec vivamus senectus dignissim odio scelerisque ut.</p><p>Magna nec torquent purus eu enim diam elementum maecenas est dignissim velit. Potenti consectetuer tempor tempus letius ipsum dolor primis facilisis tellus montes felis. Vulputate cras nulla eleifend morbi dolor. Mollis dictum natoque class ex lorem.</p>', 1),
(52, 'Hot Toys 1/6 DX Dark Knight Movie Masterpiece Joker', '63bb3d3e47dd0.jpg', 33, 8, 10, 5, 19000, 1, '<p>Eget nibh montes libero tempor platea senectus penatibus velit lobortis cubilia suscipit. At curae pulvinar netus potenti sed mollis nascetur ornare.</p>', '<p>Rhoncus dolor auctor interdum semper lacus. Eros vivamus urna sed mi curabitur bibendum. Ultricies volutpat orci massa vestibulum dapibus nascetur facilisis libero elit eleifend. Fringilla tempor bibendum maecenas justo diam proin interdum massa taciti inceptos fusce. Adipiscing aenean leo nascetur eros at. Fringilla porttitor fermentum amet ante faucibus aliquam eu mi. Orci dictum suscipit ornare ultrices quis. Viverra odio convallis potenti nunc massa ex.</p><p>Pulvinar elit neque molestie praesent risus ante. Habitant inceptos primis nec luctus dictumst platea ullamcorper pulvinar amet risus suscipit. Augue lobortis vitae lacinia sagittis auctor sociosqu congue cras vivamus. Letius egestas tristique per penatibus scelerisque adipiscing montes aenean porttitor. Quis tempor justo ipsum rhoncus cursus urna quisque consectetuer imperdiet. Justo ultricies duis at sagittis sodales congue egestas non metus facilisis praesent.</p>', 1),
(53, 'Batman: The Dark Knight - 1/6 Scale Movie Masterpiece Joker', '63bb3d6420a6f.jpg', 33, 8, 10, 5, 18000, 0, '<p>Fames sapien ullamcorper litora habitasse eu. Fermentum velit senectus pellentesque duis aptent.</p>', '<p>Viverra dictum enim leo pede dapibus habitant dolor accumsan arcu. Imperdiet eu consectetuer aptent amet sem massa magnis pellentesque etiam. Ut mi mauris nullam finibus semper facilisi himenaeos maecenas dis mattis arcu. Primis porttitor vehicula neque eget orci metus. Mus eget platea auctor curae himenaeos ante.</p><p>Consectetuer fermentum conubia gravida pulvinar euismod mauris. Molestie porttitor congue blandit egestas ex erat cubilia sapien tristique himenaeos sociosqu. Interdum bibendum leo euismod dictum consectetuer sem facilisi odio sodales at praesent. Torquent lacinia ultrices pharetra vivamus maecenas mauris finibus facilisi laoreet nostra.</p>', 1),
(54, 'Hot Toys Star Wars The Mandalorian Boba Fett TMS033 1/6 Scale Figure', '63bb3dcb144e1.jpg', 33, 7, 6, 5, 8900, 2, '<p>Ut lacinia vel elementum congue fringilla adipiscing. Ullamcorper class elementum cras mattis montes molestie.</p>', '<p>Aenean sem maximus viverra consectetur tortor eget. Venenatis letius dictumst nam phasellus eros aliquam fringilla vehicula accumsan auctor cubilia. Aliquam pellentesque felis ultrices erat tempus. Dignissim rhoncus quisque integer libero porttitor at ridiculus tincidunt dis habitasse. Arcu himenaeos dui vitae congue feugiat fermentum blandit finibus gravida.</p><p>Posuere at nisl ullamcorper nunc ultrices ex facilisi condimentum. Sed primis penatibus montes lobortis efficitur quam pellentesque. Nam placerat aliquet nisl donec posuere auctor sollicitudin etiam cursus. Aliquet commodo curae ante efficitur augue sem aenean. Convallis bibendum laoreet per mattis integer consectetur. Facilisis habitant proin consectetuer laoreet sagittis vehicula taciti quis facilisi.</p>', 1),
(56, 'Sideshow Star Wars Mythos Collection Boba Fett 1/6 Scale 12', '63bb3e1692fcb.jpg', 33, 7, 6, 5, 9700, 2, '<p>Semper taciti elementum quis nulla elit a scelerisque consectetur vivamus. Non massa sit mollis accumsan congue curae nisl donec.</p>', '<p>Diam fusce platea vitae sit commodo consequat posuere. Interdum dui nibh dictumst faucibus vitae. Dapibus hac fringilla sapien vitae consectetuer mollis. Habitasse hendrerit eros et nisl fringilla commodo malesuada rhoncus sodales lorem scelerisque. Maecenas consequat laoreet convallis ultricies lorem ante.</p><p>Nullam si tristique senectus at nulla. Volutpat neque hac placerat malesuada metus. Dis letius maximus fringilla molestie est semper magnis vivamus lacus. Bibendum tellus primis facilisis fusce porttitor vestibulum consectetuer. Proin ipsum cursus justo rutrum nam faucibus viverra lacus bibendum consectetur vulputate.</p>', 1),
(57, 'Star Wars Original Trilogy Collection Boba Fett 12\" Action Figure', '63bb3e410b5f7.jpg', 33, 7, 6, 5, 4000, 2, '<p>Quisque habitant sit metus nunc inceptos morbi letius sapien porta. Adipiscing iaculis vel volutpat platea porta magnis odio amet consectetur neque egestas.</p>', '<p>Lorem vulputate tempor nostra tempus phasellus mauris adipiscing feugiat est. Scelerisque phasellus aliquet eros bibendum parturient senectus ligula rutrum. Placerat ligula natoque ipsum efficitur finibus habitasse mus lacus est consectetur laoreet. Imperdiet vulputate nec libero quisque litora neque ultrices platea primis felis massa. Nibh enim dui dis dignissim adipiscing letius. Mauris at pede sollicitudin porttitor habitant dui dis. Suscipit consequat eros urna imperdiet etiam. Ligula quis mi lacus torquent est senectus curae per.</p><p>Arcu neque primis aptent condimentum eget dis pellentesque nisl imperdiet phasellus. Felis blandit conubia ultricies ex est egestas feugiat magna. Nunc pede sed duis lobortis blandit litora. Nisl si faucibus auctor vivamus amet est massa. Erat pretium suscipit dolor maecenas dis nascetur viverra mattis consectetuer. Ipsum egestas risus primis nec enim dapibus tortor aptent mauris torquent donec. Dui risus at venenatis rutrum urna porta mus hendrerit.</p>', 1),
(60, 'Hot Toys Marvel Thor: Ragnarok Loki Tom Hiddleston 1/6 Scale 12', '63bb3fcb2ebda.jpg', 33, 9, 16, 5, 12000, 2, '', '', 1),
(62, 'Captain Rex Helmet Clone Trooper Phase 2 Helmet from Clone Wars Series from Star Wars Cosplay Helmet Commander Helmet Star Wars Helmet', '63c04d8d6d9f8.jpg', 36, 7, 17, 6, 13000, 1, '<p>Aenean mauris nisi arcu pellentesque sit congue nullam libero auctor augue ex. Lobortis est class ipsum duis dapibus commodo suspendisse tristique enim finibus eu.</p>', '<p>Litora nec massa vel curabitur duis integer ex accumsan. Venenatis eget diam himenaeos ridiculus lacinia bibendum porttitor laoreet tincidunt lacus gravida. Dis maecenas consequat felis at morbi vel tincidunt conubia per rhoncus dignissim. Nunc eget natoque purus ante tellus posuere odio tempor iaculis litora mus. Amet ipsum semper id mus penatibus malesuada urna quis. Nibh nascetur feugiat quis dolor eu maximus. Dui cubilia interdum curabitur dolor aptent eleifend per ut mi. Ipsum per litora leo augue fames posuere faucibus neque.</p><p>Volutpat dignissim non condimentum aptent nulla sit at ligula. Dapibus lorem sapien placerat lobortis pretium dui tempor odio tristique tempus sit. Dictum at leo phasellus quis massa netus dapibus gravida. Sollicitudin mattis viverra dapibus senectus euismod ligula finibus velit facilisi. Sem tincidunt conubia imperdiet augue leo. Lectus purus rhoncus dolor mattis tempor conubia ex mus torquent per facilisi.</p>', 1),
(63, 'Star Wars The Black Series Darth Vader Premium Electronic Helmet, Star War: OBI-Wan Kenobi Roleplay Collectible Toys for Kids Ages 14', '63c04e1d6c6a9.jpg', 36, 7, 17, 6, 7000, 1, '<p>Bibendum commodo suspendisse hac quis lorem conubia maecenas vestibulum. Diam maecenas nec laoreet taciti habitasse aliquam ac nunc tellus hendrerit elit.</p>', '<p>Enim et orci nisl nec risus molestie eleifend sit. Torquent facilisi nullam platea consectetur at non. Vestibulum aenean malesuada amet mauris ridiculus ornare porta leo elit maximus. Eget efficitur dis blandit facilisi ad est inceptos. Quis etiam a auctor nascetur ullamcorper consequat.</p><p>Elementum ipsum euismod ac id malesuada blandit urna ullamcorper rhoncus congue. Fames ipsum scelerisque erat quisque lorem ligula eget neque per senectus odio. Vivamus sodales rutrum odio curabitur natoque netus suspendisse. Ante tellus integer maecenas si eros vitae gravida bibendum senectus. Vivamus eleifend viverra laoreet tempus semper vestibulum. Curabitur morbi eget nulla lorem sagittis porta magna tortor euismod adipiscing arcu.</p>', 1),
(64, 'Star Wars The Black Series Boba Fett Premium Electronic Helmet, The Empire Strikes Back Full-Scale Roleplay Collectible', '63c04e6aebbef.jpg', 36, 7, 6, 6, 9000, 2, '<p>Luctus convallis sodales molestie finibus senectus massa. Volutpat nec etiam iaculis mauris augue sagittis ligula dignissim senectus lectus.</p>', '<p>Dolor nascetur amet sapien justo enim class convallis nulla potenti lobortis. Aliquet penatibus eget pede fringilla suscipit lorem erat habitasse pulvinar. Hac fusce ad curabitur porta consectetur laoreet egestas pharetra. Metus amet maximus habitant tempus vestibulum porta phasellus. Maecenas nisi imperdiet tortor suscipit platea quam nec arcu.</p><p>Egestas aenean semper habitasse tempor adipiscing ac urna eget fermentum fringilla. Egestas sollicitudin torquent ornare maecenas facilisi aliquet non leo. Suspendisse leo cras litora arcu rhoncus vivamus nunc porttitor orci suscipit quis. Lectus laoreet placerat et mauris torquent auctor donec euismod rhoncus nisi venenatis. Diam aenean duis vel nostra elementum tellus est massa. Leo natoque dignissim quis fusce curabitur euismod. Enim conubia tortor mus dapibus fermentum. Pulvinar ultrices dui senectus quam conubia aenean dignissim.</p>', 1),
(65, 'Star Wars The Black Series The Mandalorian Premium Electronic Helmet Roleplay Collectible, Toys for Kids Ages 14 and Up', '63c04ebb61703.jpg', 36, 7, 15, 6, 6000, 0, '<p>Adipiscing erat purus nostra bibendum volutpat velit fusce mauris. Placerat inceptos potenti proin litora accumsan.</p>', '<p>Est parturient magnis vestibulum consequat maximus torquent vulputate. Hac vel dictumst semper aptent non himenaeos netus turpis nulla. Leo eget phasellus lectus massa aliquam convallis sit porta quis dignissim. Convallis aenean massa dignissim efficitur elementum molestie curae maecenas erat facilisis mattis.</p><p>Si platea nascetur conubia torquent placerat vivamus. Ad ridiculus phasellus enim tempus purus auctor morbi maecenas. Si nullam penatibus senectus consectetur tellus dictumst suspendisse. Orci interdum etiam duis vulputate consequat. Curae tempus semper dignissim nec congue quis ultricies. Laoreet felis augue conubia pulvinar egestas parturient hac mi finibus eu. Id condimentum habitant gravida aliquam vehicula dignissim commodo. Orci mattis ex placerat duis senectus proin montes torquent dignissim scelerisque condimentum.</p>', 1),
(66, 'Star Wars The Mandalorian Season 2 Limited Edition EFX Helmet Replica', '63c04f232cddf.jpg', 36, 7, 15, 6, 18000, 0, '<p>Lobortis mauris nec imperdiet est dis dictumst primis porta platea duis fames. Metus blandit euismod proin curabitur cubilia nostra gravida.</p>', '<p>Rhoncus ultrices volutpat odio cubilia auctor. Molestie venenatis lobortis platea ut maecenas dictum iaculis gravida facilisi elit. Netus curabitur pretium maximus viverra letius malesuada primis arcu sem. Commodo sit non consectetur per donec vivamus. Congue curabitur mattis urna viverra massa curae facilisi phasellus penatibus inceptos. Orci bibendum consectetur velit duis hendrerit fringilla eu.</p><p>Vehicula nostra lorem nec pellentesque aenean ultricies. Maximus rhoncus magnis efficitur sapien condimentum parturient. Per natoque posuere sollicitudin auctor habitasse interdum semper. Urna non sem ac tempus justo enim magna nullam quis. Molestie dictumst iaculis nulla dignissim senectus adipiscing laoreet.</p>', 1),
(67, 'Statue The Joker Deluxe - Batman 66 - Bds Art Scale 1/10 - Iron Studios', '63c3e7c92b23d.jpg', 1, 8, 10, 7, 4500, 3, '<p>Nascetur id nulla interdum vel fringilla vulputate potenti. Dictum duis sit odio lorem finibus dolor dignissim amet volutpat est sagittis.</p>', '<p>Facilisi tempor ipsum orci est lacus vitae pharetra praesent placerat nunc arcu. Penatibus habitant est praesent parturient eget. Odio imperdiet fusce accumsan sed tempus in. Nam molestie netus ac fusce ad convallis enim eu dignissim posuere. Pede sed quisque ipsum natoque leo pulvinar turpis neque aliquam ornare aptent. Nec diam pellentesque curabitur dapibus posuere velit urna orci fames. Semper ligula rhoncus vitae fringilla dictumst placerat.</p><p>Morbi risus lobortis finibus adipiscing curae ac pede viverra praesent lacus. Curabitur duis turpis amet morbi ligula efficitur platea proin. In urna habitasse laoreet accumsan ipsum id semper rhoncus metus. Etiam sem sollicitudin ornare pede cras rhoncus non accumsan.</p>', 1),
(68, 'Statue Deadpool Deluxe - X-Men - Bds Art Scale 1/10 - Iron Studios', '63c3e7f56f385.jpg', 1, 9, 18, 7, 7000, 2, '<p>Turpis finibus habitant placerat et leo. Pretium vulputate inceptos tincidunt vitae per habitant ligula sagittis natoque lobortis.</p>', '<p>Mollis si lectus amet primis dolor convallis tempor sociosqu sodales pharetra tempus. Taciti non duis phasellus finibus et. Fames aliquam elementum sollicitudin iaculis montes dictum phasellus felis placerat primis. Nisl pulvinar convallis rhoncus a ac ultrices ligula. Justo venenatis inceptos etiam dolor scelerisque nisl cras. Venenatis cursus justo posuere ridiculus porta. Letius erat magna proin duis suscipit.</p><p>Molestie pharetra augue tellus rhoncus sed semper parturient tristique eu fames congue. Commodo si magnis ac curae porta nullam scelerisque. Metus luctus suscipit commodo feugiat nostra risus integer duis. Egestas praesent nam ultricies inceptos rutrum maecenas a sapien vivamus. Aenean nulla magna auctor ornare nec pede gravida maecenas magnis. Primis aliquam pellentesque nulla scelerisque rhoncus purus pulvinar libero sagittis blandit suscipit. Donec potenti turpis odio tincidunt sit justo sagittis feugiat lobortis rhoncus.</p>', 1),
(69, 'Statue Night-Monkey - Spider-Man: Far From Home - Bds Art Scale 1/10 - Iron Studios', '63c3e88d75e13.jpg', 1, 9, 11, 7, 8000, 3, '<p>In dictumst imperdiet duis non sem tellus habitant semper cras. Quisque duis tristique proin augue pede ex facilisis litora senectus.</p>', '<p>Hac neque ut rutrum pulvinar luctus malesuada nulla adipiscing integer dignissim. Facilisi vitae vivamus justo curae ad erat. Metus magnis inceptos interdum nam dictum vitae gravida sodales faucibus. Nostra cras magnis donec dis enim a ornare ac porta hendrerit. Finibus per netus aliquam dictum eu nullam. Ultrices blandit amet per parturient suspendisse non magna eget. Pulvinar elit litora pede suspendisse in luctus. Pede sed faucibus efficitur consectetuer pulvinar cubilia aliquet vestibulum phasellus diam ultricies.</p><p>Hac nulla volutpat ultricies nostra dignissim eget. Consectetuer aliquet erat tellus posuere quam amet consequat parturient. Volutpat dictumst cras dolor ultrices adipiscing lacinia risus libero. Sagittis ipsum imperdiet semper tempus magnis ad platea viverra. Rutrum dictumst dapibus aliquam pede mus tempus neque nisi odio.</p>', 1),
(70, 'Spider-Man Homecoming Battle Diorama Series Statue 1/10 Spider-Man 26 cm Iron', '63c3e8bb972e8.jpg', 1, 9, 11, 7, 12000, 0, '<p>Orci tempor curabitur condimentum nec aptent conubia bibendum consectetuer pede ullamcorper. Dolor litora turpis vulputate egestas lorem leo.</p>', '<p>Id porttitor praesent egestas ut curabitur lacinia a commodo convallis aliquam. Ex nascetur per etiam interdum et lectus eu congue tellus eros accumsan. Quam sed netus tincidunt ex vehicula parturient. Leo justo neque diam ipsum aenean.</p><p>Mollis vitae egestas in elit ad odio consectetuer tristique amet litora consequat. Dui habitant praesent magnis imperdiet volutpat lobortis lacinia sapien ullamcorper maximus iaculis. Ultricies potenti faucibus consequat tempus letius vitae mus. Tristique accumsan laoreet interdum placerat class curae viverra montes mattis. A orci ultrices posuere himenaeos rutrum accumsan maximus donec. Vivamus feugiat inceptos tincidunt facilisis taciti nunc dui luctus ridiculus ante. Pulvinar eleifend arcu ultricies dapibus sem.</p>', 1),
(71, 'Kotobukiya Star Wars: A New Hope: Darth Vader The Ultimate Evil ARTFX Artist Series Statue,Multicolor', '63c3e9634ec18.jpg', 1, 7, 8, 7, 4700, 2, '<p>Iaculis penatibus condimentum eleifend consectetur etiam tortor eu est fermentum. Eros congue vulputate hendrerit litora suscipit.</p>', '<p>At felis imperdiet faucibus efficitur habitant vehicula. Phasellus luctus commodo risus cursus eget fermentum scelerisque congue. Fusce magnis egestas donec duis sodales. Tortor cursus ligula nisi donec penatibus letius lectus class pharetra quam facilisi. Conubia dolor hendrerit ullamcorper sodales enim praesent eleifend nunc duis accumsan. Sed fames per feugiat cursus efficitur amet torquent potenti dignissim id finibus. Aliquet sagittis semper facilisi aenean ridiculus laoreet nunc finibus.</p><p>Natoque torquent in pretium arcu laoreet nibh si scelerisque. Massa mattis magna lobortis volutpat convallis conubia cubilia sodales. Dictumst quam facilisis parturient feugiat adipiscing platea ridiculus. Sociosqu maximus dignissim class fusce lacinia aliquet nostra ridiculus facilisis. Lacus torquent ultricies est porttitor commodo dis justo taciti viverra imperdiet. Adipiscing morbi tempor senectus nam potenti.</p>', 1),
(72, 'Star Wars ARTFX PVC Statue 1/7 Darth Vader Industrial Empire 31 cm', '63c3e9961569b.jpg', 33, 7, 1, 5, 60, 1, '<p>Placerat tincidunt ligula lobortis blandit nostra tempus consectetuer. Augue nullam fringilla mattis sapien blandit massa.</p>', '<p>Integer ipsum commodo netus risus blandit scelerisque quis dapibus aliquet neque. Dui potenti lectus torquent mi dolor odio vulputate massa inceptos. Hendrerit facilisi augue dis pulvinar ad euismod dolor primis est ligula himenaeos. Dictumst elementum felis quam faucibus congue potenti. Iaculis nulla sodales rhoncus erat sagittis eros commodo. Dapibus nisl massa mattis elit est accumsan diam si. Suspendisse per viverra purus nam etiam fermentum dui interdum mus. Montes suscipit praesent morbi taciti phasellus letius.</p><p>Class nostra sem eu mauris morbi suspendisse cursus. Vitae phasellus neque taciti molestie libero ante. Eu semper dolor non nam metus nullam turpis pellentesque tellus sit. Phasellus ex nostra cursus proin himenaeos congue tincidunt convallis ante. Pulvinar senectus letius mattis nulla volutpat nascetur platea risus maecenas purus aenean. Class porttitor adipiscing montes porta facilisi lorem pede dignissim imperdiet tellus velit. Nisl inceptos tortor mi ex lacinia est.</p>', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `theme`
--

CREATE TABLE `theme` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `theme`
--

INSERT INTO `theme` (`id`, `name`, `photo`) VALUES
(1, 'Default', 'default.jpg'),
(7, 'Star Wars', '63babb666e08c.jpg'),
(8, 'DC', '63babb3269e8e.jpg'),
(9, 'Marvel', '63bac9a1c10b7.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `access_level` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `firstname`, `lastname`, `access_level`) VALUES
(7, 'andreylion.zt@gmail.com', '202cb962ac59075b964b07152d234b70', 'Andrii', 'Sakhno', 10),
(8, 'afanas@gmail.com', '202cb962ac59075b964b07152d234b70', 'Afanas', 'Afanasich', 1),
(9, 'newuser@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Andrii', 'User', 1),
(10, 'ivan@gmail.com', '15de21c670ae7c3f6f3f1f37029303c9', 'Ivan', 'Ivanov', 1),
(11, 'user1@gmail.com', '202cb962ac59075b964b07152d234b70', 'Ivanov', 'Ivan', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_order`
--

CREATE TABLE `user_order` (
  `id` int NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `post_number` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'in processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_order`
--

INSERT INTO `user_order` (`id`, `date`, `user_id`, `name`, `phone`, `city`, `post_number`, `total_price`, `status`) VALUES
(29, '2023-01-11 21:15:50', 7, 'Андрей Сахно', '+380933464748', 'Житомир', 'rtsertdsfxgfd', 12000, 'approved'),
(30, '2023-01-11 21:26:30', 8, 'Afanas Afanasich', '+11111111111', '111', '11', 36350, 'approved'),
(31, '2023-01-11 21:56:24', 7, 'Andrii Sakhno', '11111111111', '1324324', '32432', 12000, 'approved'),
(32, '2023-01-11 22:16:49', 7, 'Андрей Сахно', '+380933464748', 'Житомир', '65564', 44800, 'approved'),
(33, '2023-01-11 22:25:30', 7, 'Андрей Сахно', '+380933464748', 'Житомир', '234234', 54500, 'approved'),
(34, '2023-01-11 22:35:24', 7, 'Андрей Сахно', '+380933464748', 'Житомир', 'ytgfchjgf', 21600, 'approved'),
(35, '2023-01-12 20:45:41', 7, 'Андрей Сахно', '+380933464748', 'Житомир', '123', 37300, 'approved'),
(36, '2023-01-13 19:06:39', 7, 'Andrii Sakhno', '0936898020', 'Zhytomyr', '123', 33900, 'approved'),
(37, '2023-01-14 15:20:02', 7, 'Andrii Sakhno', '+11111111111', 'Zhytomyr', '123', 18000, 'approved'),
(38, '2023-01-14 15:24:03', 7, 'Andrii Sakhno', '+11111111111', 'Zhytomyr', '123', 18000, 'approved'),
(39, '2023-01-14 15:31:13', 7, 'Andrii Sakhno', '+11111111111', 'Zhytomyr', '1213', 6000, 'approved'),
(40, '2023-01-14 15:41:47', 8, 'Андрей Сахно', '+380933464748', '11', '21333', 12000, 'approved'),
(41, '2023-01-14 23:42:09', 9, 'Andrii User', '+380931111111', 'Kiev', '12', 24000, 'approved'),
(42, '2023-01-15 15:33:55', 10, 'Ivan Ivanov', '+380922464748', 'Kiev', '12', 13000, 'approved'),
(43, '2023-01-16 11:45:45', 11, 'Ivanov Ivan', '+38093464748', 'Kiev', '14', 19000, 'approved');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `personage`
--
ALTER TABLE `personage`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`theme_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `character_id` (`personage_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Индексы таблицы `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `personage`
--
ALTER TABLE `personage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`personage_id`) REFERENCES `personage` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
