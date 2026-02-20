-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2026 at 07:24 AM
-- Server version: 8.4.6-6
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhjandhara`
--
CREATE DATABASE IF NOT EXISTS `bhjandhara` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bhjandhara`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `isActive` tinyint NOT NULL DEFAULT '1',
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `image`, `isActive`, `created_on`) VALUES
(1, NULL, 'સાખીઓ', 'uploads/categoryimage/1755772644.png', 1, '2025-08-21'),
(2, NULL, 'પ્રાચીન - અર્વાચીન ભજનો', 'uploads/categoryimage/1755772674.png', 1, '2025-08-21'),
(3, NULL, 'ગરબા અને લોકગીતો', 'uploads/categoryimage/1755772709.png', 1, '2025-08-21'),
(4, NULL, 'ગઝલો', 'uploads/categoryimage/1755772729.png', 1, '2025-08-21'),
(5, NULL, 'દુહા, છંદ, છપાખરા', 'uploads/categoryimage/1755772751.png', 1, '2025-08-21'),
(6, NULL, 'માતાજીના ભેળિયા/ ચરજો', 'uploads/categoryimage/1755772773.png', 1, '2025-08-21'),
(7, NULL, 'પ્રભાતિયા', 'uploads/categoryimage/1755772794.png', 1, '2025-08-21'),
(8, NULL, 'રામગ્રી', 'uploads/categoryimage/1755772813.png', 1, '2025-08-21'),
(9, NULL, 'વિશેષ', 'uploads/categoryimage/1756206985_Popular-Music-icon-in-round-black-color-on-transparent-background-PNG.png', 1, '2025-08-21'),
(10, 1, 'ગુરુની સાખી', 'uploads/categoryimage/1755772950.png', 1, '2025-08-21'),
(11, 1, 'રામાપીર ની સાખી', 'uploads/categoryimage/1755772971.png', 1, '2025-08-21'),
(12, 1, 'માતાજી ની સાખી', 'uploads/categoryimage/1755772996.jpg', 1, '2025-08-21'),
(13, 1, 'ગમારની સાખી', 'uploads/categoryimage/1755773014.png', 1, '2025-08-21'),
(14, 1, 'દાસ ધિરાની સાખી', 'uploads/categoryimage/1755773033.png', 1, '2025-08-21'),
(15, 1, 'કબીર ની સાખી', 'uploads/categoryimage/1755773054.png', 1, '2025-08-21'),
(16, 1, 'તુલસીદાસ ની સાખી', 'uploads/categoryimage/1755773073.png', 1, '2025-08-21'),
(17, 1, 'સવારામ બાપાની સાખી', 'uploads/categoryimage/1755773108.png', 1, '2025-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `isActive` tinyint NOT NULL DEFAULT '1',
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `category_id`, `title`, `description`, `isActive`, `created_on`) VALUES
(1, 2, 'આ અવસર છે હરિ ભજવાનો', '<h1><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; આઅવસરછે</strong></h1>\r\n\r\n<h2><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;આ અવસર છે&nbsp;હરિ ભજવાનો&nbsp;કોડી&nbsp;ન બેસે&nbsp;દામ&nbsp;</em></h2>\r\n\r\n<h2><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ભજિ લેને નારાયણનું નામ&nbsp;</em></h2>\r\n\r\n<h2><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; કામક્રોધ&nbsp;મદ&nbsp;લોભ&nbsp;મોહ ને&nbsp;મુકિદે મન થી તમામ&nbsp;</em></h2>\r\n\r\n<h2><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;માત પિતા સુત બાંધવ દારા, કોઈ ન આવે કામ </em></h2>\r\n\r\n<h2><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ભજી લેને નારાયણનું નામ&nbsp;</em></h2>\r\n\r\n<h2><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; અંધ થઈને અથડામાં ભૂંડા, ઘટ ઘટમાં સુંદર શ્યામ&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;દાસ સતાર&quot; કહે કર જોડી, સૌ સંતોને સલામ </em></h2>\r\n\r\n<h2><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ભજી લેને નારાયણનું નામ</em></h2>\r\n', 0, '2025-08-22'),
(2, 2, 'આજ મારી મિજબાની છે', '<h2><strong><ins>આજ મારી મિજબાની છે રાજ</ins></strong></h2>\r\n\r\n<h3><samp>આજ મારી મિજબાની છે રાજ</samp></h3>\r\n\r\n<h3><samp>&nbsp;મારે ઘર આવોને મહારાજ</samp></h3>\r\n\r\n<p><samp>&nbsp;આજ મારી મિજબાની...</samp></p>\r\n\r\n<p><samp>ઊંચા રે બાજોઠ ધરાવું, અપને હાથ સે ગ્રાસ ભરાવું </samp></p>\r\n\r\n<p><samp>ઠંડા જલની ઝારી ભરી લાવું, રૂચી રૂચી પાવના મહારાજ </samp></p>\r\n\r\n<p><samp>&nbsp; &nbsp; &nbsp; આજ મારી મિજબાની...</samp></p>\r\n\r\n<p><samp>ધુ મેવા પકવાન મિઠાઈ, છત્રીસ ભાજી જુગત બનાઈ </samp></p>\r\n\r\n<p><samp>ઊભી ઊભી ચમ્મર ઢોળાવું, લાગો સોહામણા મહારાજ </samp></p>\r\n\r\n<p><samp>&nbsp; &nbsp; &nbsp; આજ મારી મિજબાની...</samp></p>\r\n\r\n<p><samp>ઊંચા રે બાજોઠ ધરાવું, અપને હાથ સે ગ્રાસ ભરાવું </samp></p>\r\n\r\n<p><samp>ઠંડા જલની ઝારી ભરી લાવું, રૂચી રૂચી પાવના મહારાજ </samp></p>\r\n\r\n<p><samp>&nbsp; &nbsp; &nbsp; આજ મારી મિજબાની...</samp></p>\r\n\r\n<p><samp>દોડા એલચી લવિંગ સોપારી, કાથા ચુના પાન બીચ ડારી&nbsp;</samp></p>\r\n\r\n<p><samp>અપને હાથ સે બીડા બનાવું, મુખ સે ચાવના મહારાજ</samp></p>\r\n\r\n<p><samp>&nbsp; &nbsp; &nbsp;આજ મારી મિજબાની...</samp></p>\r\n\r\n<p><samp>દોડા એલચી લવિંગ સોપારી, કાથા ચુના પાન બીચ ડારી&nbsp;</samp></p>\r\n\r\n<p><samp>અપને હાથ સે બીડા બનાવું, મુખ સે ચાવના મહારાજ</samp></p>\r\n\r\n<p><samp>&nbsp; &nbsp; &nbsp;આજ મારી મિજબાની...</samp></p>\r\n\r\n<p><samp>મોર મુકુટ પિતામ્બર સોહે, સુરનર મુનિવર સબ જન મોહે </samp></p>\r\n\r\n<p><samp>&quot;મિરાં&quot; કહે પ્રભુ ગિરિધર નાગર, પ્રેમ સે આના મહારાજ</samp></p>\r\n\r\n<p><samp>&nbsp; &nbsp; આજ મારી મિજબાની...</samp></p>\r\n', 1, '2025-08-22'),
(3, 2, 'આજ તો હમારે દ્વવાર', '<h2><ins><strong>આજ તો હમારે દ્વવાર ભોલેનાથ</strong></ins></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<pre>\r\nઆજ તો હમારે દ્વવાર ભોલેનાથ \r\nઆયે અંગ પે વિભૂતિ સોહે, ઓઢે હૈ મૃગછાલા\r\n ગલે સોહે મુન્ડમાલ, નાગ લીની છાયો\r\n       આજ તો હમારે...\r\nગકી સહેલી મીલ કે, પૂછન લગી ઉનસે બાત \r\nધન્ય ભાગ્ય તેરો ગૌરી, શંભુવર પાયો\r\n     આજ તો હમારે ...\r\nકહત ગુની &quot;તાનસેન&quot; સુનો બેજુ બાવરે મુઢે બૈલ ચઢનેવાલે,\r\n મેરે મનકો ભાયે   \r\n આજ તો હમારે...\r\n</pre>\r\n', 1, '2025-08-22'),
(4, 2, 'અબ ના બની તો ફિર કયા', '<h2><ins><strong>અબ ના બની તો ફિર કયા બનેગી</strong></ins></h2>\r\n\r\n<p>નરતન દેહ તુજે ફિર ના મિલેગી \\r\\nઅબ ના બની તો ફિર કયા બનેગી</p>\r\n\r\n<p>તેરી જવાની ભ્રમમેં ભૂલાની</p>\r\n\r\n<p>ગુરૂ પિતા માતકી બાત ન માની</p>\r\n\r\n<p>નૈયા કહો કૈસે પાર લગેગી</p>\r\n\r\n<p>&nbsp; &nbsp;અબ ના બની...</p>\r\n\r\n<p>હીરા સા જન્મ તુને વીરથા ગવાયો</p>\r\n\r\n<p>ન સતસંગ કીયો ન હરી ગુણ ગાયો</p>\r\n\r\n<p>જનની તેરી તુજે ફિર ના જનેગી</p>\r\n\r\n<p>&nbsp; &nbsp;અબ ના બની...</p>\r\n\r\n<p>&quot; સુરદાસ &quot; તેરી આ કાયા માટી</p>\r\n\r\n<p>ધરની પે ગીરત હૈ પતંગ જો કાટી</p>\r\n\r\n<p>માટીમેં માટી એક દીન મિલકે રહેગી</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp;અબ ના બની...</p>\r\n', 1, '2025-08-22'),
(5, 2, 'અબ સોંપ દિયા હૈ જીવન કા', '<h2><strong><ins>અબ સોંપ દિયા હૈ જીવન કા</ins></strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>અબ સોંપ દિયા હૈ જીવન કા, સબ ભાર તુમ્હારે હાથોંમે&nbsp;</p>\r\n\r\n<p>હૈ જીત&nbsp; તુમ્હારે હાથોંર્મ, અબ હાર તુમ્હારે હાથોંમેં</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; અબ સોંપ...</p>\r\n\r\n<p>મેરા નિશ્ચય હૈ એક યહી, એક બાર તુમ્હે મૈ પા જાઊં</p>\r\n\r\n<p>અર્પન કર દું દુનિયા ભરકા, સબ પ્યાર તુમ્હારે હાથોંમેં&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; અબ સોંપ...</p>\r\n\r\n<p>જો જગ મેં રહું તો એસે રહું, જયું જલમેં કમલકા ફૂલ રહે</p>\r\n\r\n<p>મેરે ગુનદોષ સમર્પન હો, કીરતાર તુમ્હારે હાર્થોમેં&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; અબ સોંપ...</p>\r\n\r\n<p>યદિ મનુષ્યકા મુજકો જન્મ મિલે, તેરે ચરણનોં કા પુજારી બનું</p>\r\n\r\n<p>ઇસ પૂજન કે એક એક રંગ કા, તાર તૂમહારે હાથમેં</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; અબ સોંપ...</p>\r\n\r\n<p>જબ જબ સંસાર કા કેદી બનું, નિષ્કામ ભાવ સે કર્મ કરું</p>\r\n\r\n<p>ફિર અંત સમયમેં પ્રાન તજું, સાકાર તુમ્હારે હાથોં મેં</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;અબ સોંપ...</p>\r\n\r\n<p>મુજમેં તુજમેં બસ ફરક યહી, મૈં નર હું, હૈ નારાયણ તુ</p>\r\n\r\n<p>મૈં હું સંસાર કે હાથમેં, સંસાર તુમ્હારે હાથોં મેં</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;અબ સોંપ...</p>\r\n', 1, '2025-08-22'),
(6, 2, 'અભ્યાસ જાગ્યા પછી', '<h2><ins><strong>અભ્યાસ જાગ્યા પછી</strong></ins></h2>\r\n\r\n<pre>\r\nઅભ્યાસ જાગ્યા પછી બહુ ભમવું નહી પાનબાઈ,  \r\nરહેવું ભેદવાદીની સાથ,કાયમ રહેવું તમારે એકાંતમાં, \r\nમાથે સદગુરુનો હાથ..\r\nતીર્થ વ્રત કરવા નહી પાનબાઈ, ન કરવા સદગુરુના કર્મ\r\nઆવી ખટપટ છોડી રે દેવીને, જયારે જણાય માયલો મર્મ.\r\n અભ્યાસ જાગ્યા પછી...\r\nહમિય જ્યારે જગત જણાયું, પ્રપંચથી રહેવું અતિ દુર,\r\nમોહને મમતા છોડી રે દેવા, હરિભાળવા ભરપુર..\r\n  અભ્યાસ જાગ્યા પછી...\r\nહમિય જ્યારે જગત જણાયું, પ્રપંચથી રહેવું અતિ દુર,\r\nમોહને મમતા છોડી રે દેવા, હરિભાળવા ભરપુર..\r\n     અભ્યાસ જાગ્યા પછી...\r\nમેળાને મંડપ કરવા નહી પાનબાઈ, એ છે અધુરીયાના કામ\r\nગંગાસતી રે એમ બોલીયા ને રે, જોવો હોય પરિપૂરણ રામ\r\n  અભ્યાસ જાગ્યા પછી ..\r\n</pre>\r\n', 1, '2025-08-22'),
(7, 2, 'એક લખું છું કહાણી કરુણ', '<h2><ins><strong>એક લખું છું કહાણી કરુણ</strong></ins></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>એક લખું છું કહાણી કરુણ, આંસુ આંખલડીમાં આણી..</p>\r\n\r\n<p>સુંદર તટની હતી સરિતા, જ્યાં વહેતા ખળખળ પાણી</p>\r\n\r\n<p>&nbsp; યુગલ વસે ખગની જોડી, સાસ સાસ્સી રાણી ..આંસુ</p>\r\n\r\n<p>&nbsp; &nbsp; પંખી બંનેને પ્રેમ ઘણેરો, વર્ણવી શકે ના વાણી,</p>\r\n\r\n<p>દેહ જુદા જેનું દિલ એક છે, જેમ વેલ તરુને વિંટાણી..આંસુ</p>\r\n\r\n<p>&nbsp; &nbsp;પલક એક જો જુદા પડે તો, પાંપણે ઝરતાં પાણી,</p>\r\n\r\n<p>પતિ વિયોગે જેમ ઝૂરે પતિવ્રતા નારી બને છે નિમાણી..આંસુ</p>\r\n\r\n<p>&nbsp; &nbsp; માદા હતી એણે ઇંડા મૂક્યાં, હૈયે અતિ હરખાણી,</p>\r\n\r\n<p>પંખી ઉડયો એના પોષણ કાજે, ઉરમાં શાંતિ આણી..આંસુ</p>\r\n\r\n<p>&nbsp; ચારો લઈ જ્યાં સારસ ચાલ્યો, ત્યાં મોતની નાલ મંડાણી,</p>\r\n\r\n<p>પારધીએ એક તીર માર્યું, ત્યાંતો ચીસકારી સંભળાણી&hellip; આંસુ</p>\r\n\r\n<p>કકડી ઊઠી ત્યારે કામિની, એના હૃદયની ગતિ રુંધાણી..આંસુ</p>\r\n\r\n<p>પિયુ પિયુ એવા કર્યા પોકારો, એની આતમ જ્યોત ઓલાણી</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;આંસુ આંખલડીમાં...</p>\r\n\r\n<p>કઠણ હૃદયની કેવી વિધાતા,</p>\r\n\r\n<p>આવું લખતાં એની કલમ ના કેમ અટકાણી</p>\r\n\r\n<p>&nbsp;&quot;કાન&quot; કહે ઓલ્યા ઇંડાનું શું થયું હશે,</p>\r\n\r\n<p>&nbsp; &nbsp;એની કથી શકું ના કહાણી.</p>\r\n\r\n<p>&nbsp; &nbsp; આંસુ&nbsp;આંખલડીમાં...</p>\r\n', 1, '2025-08-22'),
(8, 10, 'અબ ના બની તો ફિર કયા', '<h2><ins><strong>અબ ના બની તો ફિર કયા બનેગી</strong></ins></h2>\r\n\r\n<p>નરતન દેહ તુજે ફિર ના મિલેગી \\r\\nઅબ ના બની તો ફિર કયા બનેગી</p>\r\n\r\n<p>તેરી જવાની ભ્રમમેં ભૂલાની</p>\r\n\r\n<p>ગુરૂ પિતા માતકી બાત ન માની</p>\r\n\r\n<p>નૈયા કહો કૈસે પાર લગેગી</p>\r\n\r\n<p>&nbsp; &nbsp;અબ ના બની...</p>\r\n\r\n<p>હીરા સા જન્મ તુને વીરથા ગવાયો</p>\r\n\r\n<p>ન સતસંગ કીયો ન હરી ગુણ ગાયો</p>\r\n\r\n<p>જનની તેરી તુજે ફિર ના જનેગી</p>\r\n\r\n<p>&nbsp; &nbsp;અબ ના બની...</p>\r\n\r\n<p>&quot; સુરદાસ &quot; તેરી આ કાયા માટી</p>\r\n\r\n<p>ધરની પે ગીરત હૈ પતંગ જો કાટી</p>\r\n\r\n<p>માટીમેં માટી એક દીન મિલકે રહેગી</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp;અબ ના બની...</p>\r\n', 1, '2025-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `token_blacklist`
--

CREATE TABLE `token_blacklist` (
  `id` int NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `token_blacklist`
--

INSERT INTO `token_blacklist` (`id`, `token`, `expires_at`) VALUES
(1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA3ODk3MjUsImV4cCI6MTc2MDc5MzMyNSwiZGF0YSI6eyJpZCI6IjMiLCJuYW1lIjoicmF2aSBtYXdhciIsImVtYWlsIjoicnZpbWF3YXI5OUBnbWFpbC5jb21tIiwibW9iaWxlIjoiODE2MDM0ODg5NCIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.dy2QnM5ilPwlzVmyZtqLepd6sb6Lkji01G50DFJYi5Q', '2025-10-18 09:15:25'),
(2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA3OTA2NjcsImV4cCI6MTc2MDc5NDI2NywiZGF0YSI6eyJpZCI6IjMiLCJuYW1lIjoicmF2aSBtYXdhciIsImVtYWlsIjoicnZpbWF3YXI5OUBnbWFpbC5jb21tIiwibW9iaWxlIjoiODE2MDM0ODg5NCIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.dNMeDRJRT5n5zLkrEhf1qHkfgpWfin9yJrGqvRuewJA', '2025-10-18 09:31:07'),
(3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA3OTExMDIsImV4cCI6MTc2MDc5NDcwMiwiZGF0YSI6eyJpZCI6IjMiLCJuYW1lIjoicmF2aSBtYXdhciIsImVtYWlsIjoicnZpbWF3YXI5OUBnbWFpbC5jb21tIiwibW9iaWxlIjoiODE2MDM0ODg5NCIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.DHErzXWBocIfqoEKbxl3EYVoG5WruQo0-NyA-QBwhaI', '2025-10-18 09:38:22'),
(4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA3OTExOTksImV4cCI6MTc2MDc5NDc5OSwiZGF0YSI6eyJpZCI6IjE0IiwibmFtZSI6IlNhaGlsIG1haGVyaXlhIiwiZW1haWwiOiJzYWhpbG1haGVyaXlhM0BnbWFpbC5jb20iLCJtb2JpbGUiOiI4MTI4OTY2MTU3Iiwic3RvcmVfbmFtZSI6IiIsInJvbGUiOiIwIn19.iwWQzmNws960vjRKHLF-zwqLF7biU2_C7CbNxikuGSE', '2025-10-18 09:39:59'),
(5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA3OTEyNDQsImV4cCI6MTc2MDc5NDg0NCwiZGF0YSI6eyJpZCI6IjE0IiwibmFtZSI6IlNhaGlsIG1haGVyaXlhIiwiZW1haWwiOiJzYWhpbG1haGVyaXlhM0BnbWFpbC5jb20iLCJtb2JpbGUiOiI4MTI4OTY2MTU3Iiwic3RvcmVfbmFtZSI6IiIsInJvbGUiOiIwIn19.Xf9LPP2DHQgJBqPP9rXd5ZwVOQSUXTQ__zo7FFNW-Es', '2025-10-18 09:40:44'),
(6, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA3OTg1NDcsImV4cCI6MTc2MDgwMjE0NywiZGF0YSI6eyJpZCI6IjMiLCJuYW1lIjoicmF2aSBtYXdhciIsImVtYWlsIjoicnZpbWF3YXI5OUBnbWFpbC5jb21tIiwibW9iaWxlIjoiODE2MDM0ODg5NCIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.pyJa1RA54Z1Ts42LYKAr9OJBjdaNrQWivTC4RVublok', '2025-10-18 11:42:27'),
(7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA5MjkyMTIsImV4cCI6MTc2MDkzMjgxMiwiZGF0YSI6eyJpZCI6IjE3IiwibmFtZSI6IlByYXRlZWsiLCJlbWFpbCI6ImJoYWd3YXRpY2FycmVudGFsQGdtYWlsLmNvbSIsIm1vYmlsZSI6IjgwMDA3ODYwMDciLCJzdG9yZV9uYW1lIjoiIiwicm9sZSI6IjAifX0.HAo8SW1oRAjBbTlDsvmd8219pic4OlGRjvCzTcK6vNI', '2025-10-20 00:00:12'),
(8, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjA5NDY1NzgsImV4cCI6MTc2MDk1MDE3OCwiZGF0YSI6eyJpZCI6IjE0IiwibmFtZSI6IlNhaGlsIG1haGVyaXlhYSIsImVtYWlsIjoic2FoaWxtYWhlcml5YTNAZ21haWwuY29tIiwibW9iaWxlIjoiODEyODk2NjE1NyIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.QnqmgheEt0nPWENP85c0bdb9VrdrYtfHH3k7rX0A-I4', '2025-10-20 04:49:38'),
(9, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEyODQ3MDcsImV4cCI6MTc2MTI4ODMwNywiZGF0YSI6eyJpZCI6IjE0IiwibmFtZSI6IlNhaGlsIG1haGVyaXlhYSIsImVtYWlsIjoic2FoaWxtYWhlcml5YTNAZ21haWwuY29tIiwibW9iaWxlIjoiODEyODk2NjE1NyIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.yEB7NTkp91G-70s-vfj2h7uscIZXqt9PC9XRYZs500A', '2025-10-24 02:45:07'),
(10, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEyOTcyMDcsImV4cCI6MTc2MTMwMDgwNywiZGF0YSI6eyJpZCI6IjE5IiwibmFtZSI6InNhaGlsbGwiLCJlbWFpbCI6InNhaGlsMzNAZ21haWwuY29tIiwibW9iaWxlIjoiODEyODk2NjE1NyIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.VXZ28sx_vf1a01QwPcGWO22iXifwRhHluPGr1K0yqvg', '2025-10-24 06:13:27'),
(11, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEzMDEzNDIsImV4cCI6MTc2MTMwNDk0MiwiZGF0YSI6eyJpZCI6IjIxIiwibmFtZSI6IlBhbGxhdmkiLCJlbWFpbCI6InNhaGlsbWFoZXJpeWEzQGdtYWlsLmNvbSIsIm1vYmlsZSI6IjgxMjg5NjYxNjAiLCJzdG9yZV9uYW1lIjoiIiwicm9sZSI6IjAifX0.0KS7-impqzJmWGRt9Co1IKA8RAe9q3c0MI4J9-XQBCI', '2025-10-24 07:22:22'),
(12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEzMTQ2NTUsImV4cCI6MTc2MTMxODI1NSwiZGF0YSI6eyJpZCI6IjIzIiwibmFtZSI6IkhhamFrYSIsImVtYWlsIjoic2FoaWxtYWhlcml5YTNAZ21haWwuY29tIiwibW9iaWxlIjoiOTc5Nzk3OTc5NyIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.L-nQDObTULd-56p-wvmkRkwujjZB3Zba1GElDYJhPbU', '2025-10-24 11:04:15'),
(13, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEzMTc4NzUsImV4cCI6MTc2MTMyMTQ3NSwiZGF0YSI6eyJpZCI6IjI1IiwibmFtZSI6Ikpka2RrZCIsImVtYWlsIjoicnZpbWF3YXI5OUBnbWFpbC5jb20iLCJtb2JpbGUiOiI4MTYwMzQ4ODg4Iiwic3RvcmVfbmFtZSI6IiIsInJvbGUiOiIwIn19.raQoz3Ueb4tAWnsS66sVm3YtkXTD77GdYmOG7aw63jM', '2025-10-24 11:57:55'),
(14, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEzMTgwNjcsImV4cCI6MTc2MTMyMTY2NywiZGF0YSI6eyJpZCI6IjI1IiwibmFtZSI6Ikpka2RrZCIsImVtYWlsIjoicnZpbWF3YXI5OUBnbWFpbC5jb20iLCJtb2JpbGUiOiI4MTYwMzQ4ODg4Iiwic3RvcmVfbmFtZSI6IiIsInJvbGUiOiIwIn19.OA7OhK2EP7Z7irzucF-HF42OL8fVwaxzwSlN0pBXp74', '2025-10-24 12:01:07'),
(15, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEzMTczMzIsImV4cCI6MTc2MTMyMDkzMiwiZGF0YSI6eyJpZCI6IjI0IiwibmFtZSI6IlNoaWxwYSIsImVtYWlsIjoic2FoaWxtYWhlcml5YTNAZ21haWwuY29tIiwibW9iaWxlIjoiOTg5ODk4OTg5OCIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.wFlR3g5KKUhsUB6oj29mPRTXlyJdVATrZEZXu_ZMRG0', '2025-10-24 11:48:52'),
(16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEzNzczODEsImV4cCI6MTc2MTM4MDk4MSwiZGF0YSI6eyJpZCI6IjE2IiwibmFtZSI6IlByYXRlZWsgamFkYXYiLCJlbWFpbCI6ImJoYWd3YXRpY2FycmVudGFsQGdtYWlsLmNvbSIsIm1vYmlsZSI6Ijg4NjY3ODYwMDciLCJzdG9yZV9uYW1lIjoiIiwicm9sZSI6IjAifX0.U9uPT-vLnahENqsFqTyi50k7O-aPJECvGyI2LCGF9Q0', '2025-10-25 04:29:41'),
(17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjEzNzgwNTMsImV4cCI6MTc2MTM4MTY1MywiZGF0YSI6eyJpZCI6IjI3IiwibmFtZSI6IkRlbmlzaCBLdW1hciBDaG90YWxhbCBQYXRlbGl5YSIsImVtYWlsIjoicGF0ZWxpeWFkZW5pc2gwQGdtYWlsLmNvbSIsIm1vYmlsZSI6IjgzMjAyNTY5OTYiLCJzdG9yZV9uYW1lIjoiIiwicm9sZSI6IjAifX0.jBjr45eJO4uU_okcp4QFIydnoYcPuJ2Z08YHj8IUzSw', '2025-10-25 04:40:53'),
(18, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjE1Mzg5ODEsImV4cCI6MTc2MTU0MjU4MSwiZGF0YSI6eyJpZCI6IjE2IiwibmFtZSI6IlByYXRlZWsgamFkYXYiLCJlbWFpbCI6ImJoYWd3YXRpY2FycmVudGFsQGdtYWlsLmNvbSIsIm1vYmlsZSI6Ijg4NjY3ODYwMDciLCJzdG9yZV9uYW1lIjoiIiwicm9sZSI6IjAifX0.pmHKdRPVwrsNRgTLMFeAGX6Vo0eWe9q_y0mIapoplCI', '2025-10-27 01:23:01'),
(19, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2ZpdGNrZXQuY29tL2JoYWd3YXRpZW50ZXJwcmlzZS8iLCJpYXQiOjE3NjE5Mjg1MTgsImV4cCI6MTc5MzQ2NDUxOCwiZGF0YSI6eyJpZCI6IjM2IiwibmFtZSI6IkdBSkVORFJBIFBBVEVMIiwiZW1haWwiOiI4MTYwMzQ4ODk1IiwibW9iaWxlIjoiODEyODA0Mzc3NSIsInN0b3JlX25hbWUiOiIiLCJyb2xlIjoiMCJ9fQ.H83TtCMywOoAIRSlnMijbEN8zdj-Kf5FVxIztv4sGV4', '2026-10-31 12:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL COMMENT 'admin=1\r\nuser=0',
  `isActive` tinyint NOT NULL DEFAULT '1',
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `password`, `role`, `isActive`, `created_on`) VALUES
(1, '', '8160348894', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, '0000-00-00'),
(2, '', '8999478035', 'd40cd8b577dd00547ccfce0e55a882bb', 1, 1, '0000-00-00'),
(3, 'ravi', '8160348895', '', 0, 1, '2025-11-19'),
(4, 'ravi', '8160348897', '', 0, 1, '2025-11-20'),
(5, 'Sahil', '8128966157', '', 0, 1, '2025-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `song_id` int NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_favorites`
--

INSERT INTO `user_favorites` (`id`, `user_id`, `song_id`, `created_on`) VALUES
(1, 3, 5, '2025-11-19 07:35:55'),
(2, 3, 2, '2025-11-21 05:19:58'),
(3, 5, 4, '2025-11-21 05:22:33'),
(4, 5, 7, '2025-11-21 05:42:59'),
(5, 1, 8, '2025-12-04 01:26:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_blacklist`
--
ALTER TABLE `token_blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `token_blacklist`
--
ALTER TABLE `token_blacklist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
