-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 26, 2024 at 08:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `random_text_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `text_block`
--

DROP TABLE IF EXISTS `text_block`;
CREATE TABLE `text_block` (
  `id` mediumint(9) NOT NULL,
  `text_source` mediumint(9) DEFAULT NULL,
  `char_count` int(11) DEFAULT NULL,
  `text_block` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `text_block`
--

INSERT INTO `text_block` (`id`, `text_source`, `char_count`, `text_block`) VALUES
(1, 1, 166, 'Information is not knowledge.\nKnowledge is not wisdom.\nWisdom is not truth.\nTruth is not beauty.\nBeauty is not love.\nLove is not music.\nMusic is THE BEST.'),
(2, 2, 68, 'Changing your ideas in the face of new information is not weakness.'),
(3, 2, 76, 'You cannot expect to have what you want if you do not ask for what you want.'),
(4, 2, 79, 'Times when communication is most difficult is exactly when it’s most important.'),
(5, 2, 21, 'Life rewards courage.'),
(6, 2, 47, 'Don’t speak FOR someone you aren’t speaking TO.'),
(7, 2, 223, 'There are two ways to win admiration and kudos from others: create something new, or attack other people. They both work, but the first is harder. Be the person who does the first, and beware the person who does the second.'),
(8, 2, 198, 'Watchdog yourself. The moment you start thinking of yourself as a “good person,” you lose sight of the fact we are all capable of error, and you stop asking yourself if you’re doing the right thing.'),
(9, 2, 17, 'Trust but verify.'),
(10, 2, 170, 'There are people who will do well by you, and people who will harm you. Assuming everyone is in the first group will hurt you. So will assuming everyone is in the second.'),
(11, 5, 83, 'Just as there are no atheists in foxholes, there are no libertarians in a bank run.'),
(12, 2, 71, 'Knowing and enforcing your boundaries will save you a ton of heartache.'),
(13, 2, 200, 'Boundaries are not control. Boundaries are about access to you: your person, your intimacy, your possessions. “Don’t talk to me that way” is a boundary. “Don’t talk to that person” is not.'),
(14, 2, 213, 'It’s easy to profess values and ethics when they cost you nothing. The real measure of your beliefs is what you do when they cost you something. Proclaiming your virtues when there are no stakes is not virtuous.'),
(15, 2, 83, 'Be yourself is good advice, despite all the people who tell you it’s good advice.'),
(16, 2, 96, 'Nobody is entitled to your time, attention, or intimacy. Beware anyone who feels as if they are.'),
(17, 2, 374, 'Framing is everything. In 1998, for a Wizard of Oz listing on TCM, writer Rick Polito wrote, “Transported to a surreal landscape, a young girl kills the first person she meets and then teams up with three strangers to kill again.” Watch out for people who frame things using emotionally manipulative language—theyre trying to control you, sell your something, or both.');

-- --------------------------------------------------------

--
-- Table structure for table `text_source`
--

DROP TABLE IF EXISTS `text_source`;
CREATE TABLE `text_source` (
  `id` mediumint(9) NOT NULL,
  `descriptor` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `text_source`
--

INSERT INTO `text_source` (`id`, `descriptor`) VALUES
(1, 'Frank Zappa'),
(2, 'Franklin Veaux\'s Mom'),
(3, 'Unknown'),
(4, 'Anonymous'),
(5, 'Jean-Louis Gassée');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `text_block`
--
ALTER TABLE `text_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text_source`
--
ALTER TABLE `text_source`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `text_block`
--
ALTER TABLE `text_block`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `text_source`
--
ALTER TABLE `text_source`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
