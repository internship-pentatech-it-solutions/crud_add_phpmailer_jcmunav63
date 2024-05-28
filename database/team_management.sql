-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 21:36:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `team_management`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`id`, `teams_id`, `firstname`, `lastname`, `position`, `department`, `about`, `image_url`) VALUES
(1, 1, 'Linus', 'Torvalds', 'Chief of Software Engineering', 'Software engineering', 'Linus Benedict Torvalds (born 28 December 1969) is a Finnish-American software engineer who is the creator and lead developer of the Linux kernel. He also created the distributed version control system Git.', 'uploads/torvaldslinus.PNG'),
(2, 1, 'Bill', 'Gates', 'Honorific President', 'Presidency', 'William Henry Gates III (born October 28, 1955) is an American businessman, investor, philanthropist, and writer best known for co-founding the software giant Microsoft, along with his childhood friend Paul Allen. During his career at Microsoft, Gates held the positions of chairman, chief executive officer (CEO), president, and chief software architect, while also being its largest individual shareholder until May 2014. He was a pioneer of the microcomputer revolution of the 1970s and 1980s.\r\nAt 17, Gates formed a venture with Allen called Traf-O-Data to make traffic counters based on the Intel 8008 processor. In 1972, he served as a congressional page in the House of Representatives. He was a national merit scholar when he graduated from Lakeside School in 1973. He scored 1590 out of 1600 on the Scholastic Aptitude Tests (SAT) and enrolled at Harvard College in the autumn of 1973. He did not stay at Harvard long enough to choose a concentration, but took mathematics (including Math 55) and graduate level computer science courses. While at Harvard, he met fellow student and future Microsoft CEO Steve Ballmer. Gates left Harvard after two years while Ballmer stayed and graduated magna cum laude. Years later, Ballmer succeeded Gates as Microsoft\'s CEO and maintained that position from 2000 until his resignation in 2014.[\r\n', 'uploads/gatesbill.PNG'),
(3, 2, 'Paul', 'Mc Cartney', 'Music Director', 'Art & Design', 'Sir James Paul McCartney CH MBE (born 18 June 1942) is an English singer, songwriter and musician who gained worldwide fame with the Beatles, for whom he played bass guitar and shared primary songwriting and lead vocal duties with John Lennon. One of the most successful composers and performers of all time, McCartney is known for his melodic approach to bass-playing, versatile and wide tenor vocal range, and musical eclecticism, exploring genres ranging from pre–rock and roll pop to classical, ballads, and electronica. His songwriting partnership with Lennon is the most successful in modern music history.[', 'uploads/mccartneypaul.PNG'),
(4, 2, 'Guido', 'Van Rossum', 'Software Engineer - Python Language', 'Software Engineering', 'Guido van Rossum (born 31 January 1956) is a Dutch programmer best known as the creator of the Python programming language, for which he was the \"benevolent dictator for life\" (BDFL) until he stepped down from the position on 12 July 2018. He remained a member of the Python Steering Council through 2019, and withdrew from nominations for the 2020 election.', 'uploads/vanrossumguido.PNG'),
(5, 3, 'Sergey', 'Brin', 'Lead Engineer', 'Software Engineering', 'Sergey Mikhailovich Brin (born August 21, 1973) is an American businessman best known for co-founding Google with Larry Page. Brin was the president of Google\'s parent company, Alphabet Inc., until stepping down from the role on December 3, 2019. He and Page remain at Alphabet as co-founders, controlling shareholders, and board members. As of March 2024, Brin is the 10th-richest person in the world, with an estimated net worth of $119 billion, according to the Bloomberg Billionaires Index and Forbes.', 'uploads/brinsergey.PNG'),
(6, 3, 'Katherine', 'Johnson', 'Honorific lead engineer', 'Software Engineer', 'Creola Katherine Johnson (August 26, 1918 – February 24, 2020) was an American mathematician whose calculations of orbital mechanics as a NASA employee were critical to the success of the first and subsequent U.S. crewed spaceflights. During her 33-year career at NASA and its predecessor, she earned a reputation for mastering complex manual calculations and helped pioneer the use of computers to perform the tasks. The space agency noted her \"historical role as one of the first African-American women to work as a NASA scientist\".', 'uploads/johnsonkatherine.PNG'),
(7, 3, 'Carol', 'Shaw', 'Game Developer', 'Game Development', 'Carol Shaw (born 1955) is one of the first female game designers and programmers in the video game industry.[citation needed] She is best known for creating the Atari 2600 vertically scrolling shooter game River Raid (1982) for Activision. She worked for Atari, Inc. from 1978 to 1980, where she designed multiple games including 3-D Tic-Tac-Toe (1978) and Video Checkers (1980), both for the Atari VCS before it was renamed to the 2600. She left game development in 1984 and retired in 1990.', 'uploads/shawcarol.PNG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`) VALUES
(1, 'Team 1', 'Description Team 1 - Planning Team'),
(2, 'Team 2', 'Team 2 description. Project management.'),
(3, 'Team 3', 'Description of Team 3 - HR & RecruitmentTeam');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `phonenumber`) VALUES
(3, 'andrew', 'Andrew Smith', 'andrew@gmail.com', '$2y$10$oxWS21.EdTxiy..GdEYP0eRs.GS78RdVjSrlO/aQ2J1IlI2RL1FAG', '28282827363'),
(4, 'tom', 'Tom Lane', 'tom@gmail.com', '$2y$10$U8iT9KXQ.wWO3trnYs9vp.YBKyFtcIXdXjKMr27xCOFr4w04sMzv6', '575848393'),
(5, 'paul', 'Paul Bunyon', 'paul@gmail.com', '$2y$10$MUTANrEISzV64tuXYJZsDuw5fqlQ.tFPsU4UFumsajumakAFh7NSm', '151515167671'),
(6, 'stella', 'Stella Thomas', 'stella@gmail.com', '$2y$10$FH2B46H0bWPTp4wQqRF5VuHwQ8CJmsvU7T5NSeyHUfr65yoqCd/iW', '2726383939'),
(7, 'john', 'Johnatan Wick', 'john@gmail.com', '$2y$10$4zFfBBpP7Mzol.Icnl9n..9VjvvQqR9XdQeJqWeDbIxW0q9sWPok.', '3737376662');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`teams_id`);

--
-- Indices de la tabla `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`teams_id`) REFERENCES `teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
