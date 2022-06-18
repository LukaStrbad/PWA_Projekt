-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 08:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--
CREATE DATABASE IF NOT EXISTS `projekt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projekt`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'berlin-sport'),
(2, 'kultur und show');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `article_subtitle` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `subtitle`, `title`, `content`, `article_subtitle`, `img`, `category_id`, `hidden`, `creation_date`) VALUES
(1, 'Abschied aus Berlin', 'Klinsmann Junior (22) verl├Ąsst Hertha - aber wohin geht er?', 'Jonathan Klinsmann (22) nimmt Abschied von Berlin! Bei seinem letzten Saisonspiel in der Regionalliga (0:2 gegen Lok. Leipzig) sa├č ein Beobachter der Glasgow Rangers auf der Trib├╝ne. Es gibt auch Anfragen aus der Schweiz und ├ľsterreich.\r\n\r\nKlinsi Junior muss entscheiden: Bleibt er Nummer 2 bei einem Erstligisten oder wird er Nummer 1 bei einem Zweitligisten?\r\nJonathan Klinsmann absolvierte ein Spiel in der Europa League f├╝r Hertha, spielt derzeit f├╝r die U23\r\nJonathan Klinsmann sucht eine neue Herausforderung (Foto: City-Press GbR) Foto: City-Press\r\n\r\nDer 1,93 Meter lange Jonathan: ÔÇ×Ich habe in den zwei Jahren viel gelernt, will jetzt die n├Ąchste Stufe erreichen. Das war leider bei Hertha nicht m├Âglich.ÔÇť Zu einem Bundesliga-Einsatz schaffte er es nicht. In Herthas zweitem Team (4. Liga) hatte er einen Stammplatz.\r\nÔÇ×Jonathan wird seinen Weg gehenÔÇť\r\n\r\nVater J├╝rgen Klinsmann: ÔÇ×Hertha hat ihm diese Chance gegeben. Daf├╝r bin ich dankbar. Ich habe in diesen zwei Jahren noch einmal gemerkt, dass ich Mitglied vom richtigen Verein bin ÔÇô und mein Vater war Fan vom richtigen Verein.ÔÇť\r\n\r\nSeit 2004 ist Ex-Bundestrainer Klinsmann Hertha-Mitglied. F├╝r den Klub hatte schon sein aus Brandenburg stammender Vater Siegfried (ÔÇá71) geschw├Ąrmt.\r\nProminenter Besuch auf der Trib├╝ne: J├╝rgen Klinsmann mit Sohn Jonathan beim Spiel gegen den Halleschen FC (Foto: City-Press GbR)\r\nJ├╝rgen Klinsmann mit Sohn Jonathan beim Hertha-Spiel gegen den Halleschen FC (Foto: City-Press GbR)\r\n\r\nKlinsi senior ├╝ber Klinsi junior: ÔÇ×Es ist immer schwierig als Vater zu urteilen. Aber Jonathan wird seinen Weg machen.ÔÇť', 'Der Sohn von J├╝rgen Klinsmann (53) und amerikanische U23-Torwart verl├Ąsst Hertha zum Saisonende. Aber wohin f├╝hrt sein Weg? ', 'img1.jpg', 1, 0, '2022-06-02 15:46:09'),
(2, 'Vorm Saisonfinale', 'Paderborn-Coach Baumgart verr├Ąt STartelf f├╝r Dresden-Spiel', 'Seine Ostwestfalen gehen das Saison-Finale bei Dynamo Dresden am Sonntag (15.30 Uhr/Sky) betont optimistisch an. ÔÇ×Wir wollen diesen zweiten Platz verteidigenÔÇť, sagte Trainer Steffen Baumgart am Freitag und verriet zur ├ťberraschung aller sogar seine Formation. ÔÇ×Wir werden mit derselben Startelf beginnen wie gegen HamburgÔÇť, k├╝ndigte Baumgart an.\r\n\r\nGegen den Bundesliga-Absteiger hatten die Ostwestfalen am Sonntag im erstmals praktizierten 4-2-3-1-System mit 4:1 gewonnen.\r\nSteffen Baumgart emotional wie man ihn kennt (Foto: picture alliance/dpa) Foto: frg\r\n\r\nZum Spiel in Dresden wird Paderborn zum erst zweiten Mal in dieser Saison fliegen. Zun├Ąchst war eine Anreise mit dem Bus oder Zug geplant, doch angesichts einer m├Âglichen Relegation dachte Baumgart um.\r\n\r\nÔÇ×Es kann n├Ąchste Woche ja weitergehenÔÇť, sagte Baumgart: ÔÇ×Deshalb fliegen wir am Sonntag um 20 Uhr zur├╝ck. Dann k├Ânnen wir am Montag um 10 Uhr trainieren.ÔÇť\r\nPaderborn, Deutschland 21. Oktober 2018:2.Liga - 18/19 - SC Paderborn vs. Union Berlin Trainer Steffen Baumgart (SC Paderborn) und Trainer Urs Fischer (1. FC Union Berlin) begl├╝ckw├╝nschen sich nach dem Spiel. Aktion . Einzelbild . Gestik / Geste / gestikuliert / Feature / Symbol / Symbolfoto / charakteristisch / Detail // DFL regulations prohibit any use of photographs as image sequences and/or quasi-video. // | Verwendung weltweit (Foto: picture alliance / Fotostand)\r\nSteffen Baumgart (SC Paderborn) und Unions Trainer Urs Fischer nach dem Hinspiel (0:0) in Paderborn. Da hatten wohl beide nicht damit gerechnet, dass sie sich am Saisonende um die Pl├Ątze zwei und drei streiten w├╝rden (Foto: picture alliance / Fotostand)\r\n\r\nDer Tabellendritte spielt in der Relegation am 23. und 27. Mai gegen den VfB Stuttgart als 16. der Bundesliga. Union Berlin liegt vor dem letzten Zweitliga-Spieltag nur einen Punkt hinter Paderborn.', 'Das ├ťberraschungs-Team aus Paderborn will sich den Bundesliga-Aufstieg nicht mehr nehmen lassen. Steffen Baumgart, Trainer des Tabellenzweiten, geht selbstbewusst in das Spiel in Dresden. ', 'img2.png', 1, 0, '2022-06-02 15:46:09'),
(3, 'Vor Playoffs gegen Ulm', 'Alba-Coach: Deutsche d├╝rfen Platz nicht wegen Passes bekommen', 'ÔÇ×Die deutschen Spieler d├╝rfen ihren Platz im Team nicht wegen ihres Passes bekommen, sondern weil sie besser sind. Langfristig werden und m├╝ssen die Barrieren fallenÔÇť, sagte der 72 Jahre alte Spanier der ÔÇ×S├╝ddeutschen ZeitungÔÇť. ÔÇ×Warum soll ein Deutscher, ein Spanier nicht mit einem Amerikaner, einem Russen oder einem Serben mithalten k├Ânnen?ÔÇť\r\n\r\nBis zum Ende der Bundesliga-Saison 2019/20 m├╝ssen bei einem Team auf dem Spielberichtsbogen von zw├Âlf Profis mindestens sechs Deutsche stehen.\r\nTrainer Aito gibt Jonas Mattiseck einige Tipps im Spiel (Foto: picture alliance / Andreas Gora)\r\nTrainer Aito gibt Jonas Mattiseck einige Tipps im Spiel (Foto: picture alliance / Andreas Gora)\r\n\r\nAito gilt selbst als F├Ârderer des deutschen Nachwuchs, setzt beim Hauptstadtclub auch unerfahrene Talente ein.\r\n\r\nÔÇ×Es gibt sicher Trainer, die in dieser Hinsicht nicht ganz so risikofreudig sindÔÇť, sagte der Coach. ÔÇ×Aber wenn ein Spieler jung ist, Qualit├Ąt hat und gut arbeitet, wird er gebracht.ÔÇť\r\nTrainer Aito hat auch einen Spieler wie Tim Schneider an die Bundesliga-Mannschaft herangef├╝hrt (Foto: picture alliance / nordphoto)\r\n\r\nAito ist seit 2017 Trainer bei Alba, f├╝hrte den Club bislang national und international in vier Finals, wartet aber noch auf den ersten Titel mit Berlin. Ob er seinen auslaufenden Vertrag verl├Ąngert, lie├č er weiter offen. ÔÇ×Wir werden sehen, wie ich mich am Ende der Saison physisch f├╝hleÔÇť, sagte er. ÔÇ×Aber ich bin weder um meine noch um Albas Zukunft besorgt. Was passieren muss, wird passieren.ÔÇť', 'Albas Trainer Aito Garcia Reneses hat Zweifel an der Zukunft der Deutschen-Quote in der Basketball-Bundesliga ge├Ąu├čert. F├╝r ihn steht die Leistung im Vordergrund, nicht der Geburtstort.', 'img3.jpg', 1, 0, '2022-06-02 15:46:09'),
(4, 'Sie hasst es, shoppen zu gehen', 'In Sachen Mode hat bei Sandra Maischberger ihr Mann die hosen an!', 'Sandra Maischberger kam mit ihrer Freundin Bettina Rust (51) in deren Radiosendung ÔÇ×H├Ârbar RustÔÇť in Plauderlaune, was ihren Ehemann Jan Kerhart (59) angeht. Neben ihrer Stylistin sorgt n├Ąmlich er f├╝r Maischbergers Aussehen, weil sie es absolut hasst, einkaufen zu gehen!\n\nÔÇ×Der kauft Kleider f├╝r mich, wenn er unterwegs ist. Das Erstaunliche dabei ist: Die passen immer und sehen gut ausÔÇť, so Maischberger. Fr├╝her war er sogar f├╝r ihre Frisur zust├Ąndig. ÔÇ×Er ist ja Kameramann, hat fotografiert und gemalt, er hat mir fr├╝her auch die Haare geschnitten. Er sagte: ÔÇ×Die Technik kann ich nicht, aber ich wei├č, wie es am Ende sch├Ân aussieht.ÔÇť\nUnd er kocht auch noch gutÔÇŽ\n\nOffenbar ein super Typ, wie Bettina Rust feststellt. Maischberger, die von sich selber sagt, sie habe keinen guten Geschmack, was Mode angeht: ÔÇ×Ja, ganz toll. Deswegen ├╝berlasse ich ihm einfach alles, was ├äu├čerlich ist, und die zweite H├Ąlfte der ├äu├čerlichkeit macht die Stylistin, die mir f├╝r die Sendung Sachen kauft.ÔÇť\nDie Berliner Stylistin und Designerin Miyabi Kawai (45, ÔÇ×SchrankalarmÔÇť) ├╝ber Maischbergers Look: LINKS - Leider der einzige FehlgriffÔÇŽweder Farben noch Schnitt tun was f├╝r Frau Maischberger. Das wilde Muster wirkt unmodern und auch viel zu unruhig f├╝r ihren eher klassischen Typ.ÔÇť RECHTS - ÔÇ×Alles richtig gemacht. Seri├Âs und dennoch weiblich wird Frau Maischbergers Silhouette hier wunderbar betont, das kleine Muster bringt Pepp rein, ohne abzulenken.ÔÇť\nDie Berliner Stylistin und Designerin Miyabi Kawai (45, ÔÇ×SchrankalarmÔÇť) ├╝ber Maischbergers Look: LINKS ÔÇô Leider der einzige FehlgriffÔÇŽweder Farben noch Schnitt tun was f├╝r Frau Maischberger. Das wilde Muster wirkt unmodern und auch viel zu unruhig f├╝r ihren eher klassischen Typ.ÔÇť RECHTS ÔÇô ÔÇ×Alles richtig gemacht. Seri├Âs und dennoch weiblich wird Frau Maischbergers Silhouette hier wunderbar betont, das kleine Muster bringt Pepp rein, ohne abzulenken.ÔÇť (Foto: Getty Images)\n\nGerade haben sie Silberhochzeit gefeiert, wie Maischberger erz├Ąhlt. Wie sie sich bei ihm f├╝r das modische Engagement revanchiert? ÔÇ×Ich kann das nicht kompensieren. Ich gebe ihm Sachen zu lesen, die ich gut finde. Daf├╝r gibt er mir wieder Musik.ÔÇť Und: ÔÇ×Er kocht ├╝brigens auch gut. Ich koche nach Rezept, wie Malen nach Zahlen, und er kocht intuitiv. Das hei├čt, er erfindet Gerichte. Ich finde es fantastisch.ÔÇť', 'Die Moderatorin ist froh, dass ihr Ehemann guten Geschmack hat (denn den habe sie auf jeden Fall nicht). Der Kameramann war fr├╝her auch f├╝r ihre Frisur zust├Ąndig.', 'img4.webp', 2, 0, '2022-06-02 15:46:09'),
(5, 'Fans schauen in die R├Âhre', 'ARD vershiebt Film ├╝ber Harald Juhnke', 'Eigentlich sollte der ┬şgro├če TV-Film ÔÇ×Der EntertainerÔÇť ┬ş(Arbeitstitel) am 10. Juni zum 90. Geburtstag von Harald Juhnke (ÔÇá75) in der ARD laufen. ÔÇ»Doch jetzt steht fest: Der Juhnke-Film musste auf Ende 2020 verschoben werden! Nach B.Z.-Informationen soll die Finanzierung noch nicht stehen!\r\n\r\nAuf B.Z-Anfrage sagte Juhnkes langj├Ąhriger Manager Peter Wolf (61): ÔÇ×Susanne Juhnke und ich sind nat├╝rlich sehr traurig dar├╝ber, dass der Film ├╝ber Harald Juhnke nicht an seinem 90. Geburtstag im Fernsehen laufen wird. Wir stehen den Produzenten Oliver Berben beratend zur Seite.ÔÇť\r\n\r\nBereits 2017 hatte sich Oliver Berben (47, ÔÇ×Das AdlonÔÇť) die Filmrechte an dem Stoff ├╝ber Harald Juhnkes Leben gesichert. Zust├Ąndig f├╝r den Film ├╝ber den ber├╝hmten Berliner ist ├╝brigens der Rundfunk Berlin-Brandenburg (rbb).\r\nSeine Witwe Susanne Juhnke und Peter Wolf unterst├╝tzen das Filmprojekt der ARD\r\nSeine Witwe Susanne Juhnke und Peter Wolf unterst├╝tzen das Filmprojekt der ARD (Foto: picture alliance / Eva Oertwig/S) Foto: Eva Oertwig/SCHROEWIG .\r\n\r\nAuf B.Z.-Anfrage sagt Martina Z├Âllner, rbb-Programmbereichsleiterin ÔÇ×Doku und FiktionÔÇť: ÔÇ×Es gab vielleicht ein Missverst├Ąndnis: Den Film an Juhnkes 90. Geburtstag auszustrahlen war nie geplant, es war immer klar, dass das nicht zu schaffen sein w├╝rde. Ansonsten kommen wir gut voran, aber es ist immer noch zu fr├╝h, um ins Detail zu gehen. Als Ausstrahlungszeit f├╝r den Film ist Ende 2020 geplant.ÔÇť\r\n\r\nOb der rbb das Filmprojekt ├╝ber Juhnkes Leben in den 80er-und 90er Jahren wirklich alleine stemmen kann, bleibt unklar. Juhnke-Manager Peter Wolf verr├Ąt nur so viel: ÔÇ×Das Projekt ist in guter Entwicklung, am Drehbuch wird noch gearbeitet, der Produzent ist in Verhandlungen mit m├Âglichen Kooperationspartnern ÔÇô alles ganz normal bei einem Projekt dieser Dimension.ÔÇť\r\n\r\nDie ARD plane aber sehr viel zu Juhnkes Geburtstag, so Wolf. ÔÇ×Insgesamt werden im deutschen und ├Âsterreichischen Fernsehen ├╝ber 120 Sendungen sein Lebenswerk w├╝rdigen. Es wird ein richtiges Harald-Juhnke-Festival! Dar├╝ber h├Ątte er sich sehr gefreut.ÔÇť', 'Eigentlich sollte ÔÇ×Der EntertainerÔÇť am 90. Geburtstag Harald Juhnkes (10. Juni) im Fernsehen ausgestrahlt werden. Doch daraus wird nichts, wie B.Z. erfuhr. Grund: Die Finanzierung steht noch nicht. ', 'img5.jpg', 2, 0, '2022-06-02 15:46:09'),
(6, 'TV-Star Mariella Ahrens', '\"Mene TÂcheter sollen wie ich ', 'Vor Kurzem feierte Mariella Ahrens ihren 50. Geburtstag. Seit Anfang des Jahres zeigt sich die Schauspielerin (ÔÇ×Ein Fall von LiebeÔÇť) sehr vertraut mit dem 22 Jahre j├╝ngeren Sky-Moderator Riccardo Basile (27). Aber nicht nur die Liebe scheint sie jung zu halten, auch ihre beiden T├Âchter Isabella (20) und Lucia (12)!\r\n\r\nSind ihre T├Âchter der wahre Jungbrunnen? Mariella Ahrens zur B.Z.: ÔÇ×Die halten mich auf jeden Fall auf Trab. Meine gro├če Tochter Isabella wohnt noch bei mir. Sie ist im Februar 20 geworden. Und Lucia ist jetzt 12. Wir haben eine tolle M├Ądchen-WG. Klar, es gibt auch mal Zickereien zu Hause. Wenn wir uns das Bad teilen m├╝ssen und wir alle gleichzeitig los wollen. Das Sch├Âne ist, dass wir nicht so weit auseinander sind mit allem, was wir m├Âgen. Es macht schon Spa├č.ÔÇť\r\nGehen auch zusammen aus: Mariella Ahrens mit Tochter Isabella beim ÔÇ×New Body AwardÔÇť\r\nGehen auch zusammen aus: Mariella Ahrens mit Tochter Isabella beim ÔÇ×New Body AwardÔÇť (Foto: picture alliance / Eva Oertwig/S) Foto: Eva Oertwig/SCHROEWIG .\r\n\r\nStrenge f├Ąllt der jung gebliebenen Mutter zweier M├Ądchen nicht leicht. Ist Mariella eine strenge Mutter oder eher eine Freundin? ÔÇ×Ich glaube, ich bin eine Mischung aus beidem. Klar meckere ich meine T├Âchter auch mal an. Aber weil ich so ein kleiner verr├╝ckter Vogel bin, habe ich leider f├╝r vieles Verst├Ąndnis. Ich schimpfe dann trotzdem, obwohl ich es verstehe. Da muss ich mich schon zusammenrei├čen, weil es sonst einrei├čt,ÔÇť erkl├Ąrt Ahrens ihren Erziehungs-Stil.\r\n\r\nIhre ├Ąlteste Tochter Isabella m├Âchte ├╝brigens keine Schauspielerin werden. Mariella zur B.Z.: ÔÇ×Isabella studiert jetzt BWL. Es ist f├╝r mich auch wichtig, dass meine beiden T├Âchter eine gewisse Bodenst├Ąndigkeit behalten. Dazu habe ich sie erzogen. Auch wenn sie mein aufregendes Leben mitbekommen, wir tolle Reisen machen oder eingeladen werden, sollen sie auf dem Boden bleiben. Weil sie, genau wie ich, selbstst├Ąndig und unabh├Ąngig durchs Leben gehen sollen. Das ist wichtig.ÔÇť', 'Mariella Ahrens spricht in der B.Z. ber die MĄdchen-WG mit ihren beiden Tchtern ', 'img6.jpg', 2, 0, '2022-06-02 15:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `password`, `access_level`) VALUES
(1, '', '', 'admin', '$2y$10$aZP.kZCBO9MKweTivN6pme8bc/0UUlXu40ouFVZzYmeqK7GIW71GS', 0),
(3, 'Luka', 'Strbad', 'luka', '$2y$10$2MoxHPJGsrvrqV8A6Hbgl.WUARU9oJFDyGC5VRLSt8vt34pL5ACom', 1),
(5, 'Default', 'User', 'PasswordIs12345678', '$2y$10$1b9LVsIi4pePPjTedirlQus63TwAQz9zrmluP1e1r3QlT6OwzA2ka', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
