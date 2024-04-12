-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 12, 2024 at 07:20 PM
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
-- Table structure for table `saved_site`
--

DROP TABLE IF EXISTS `saved_site`;
CREATE TABLE `saved_site` (
  `id` mediumint(9) NOT NULL,
  `site_category` mediumint(9) DEFAULT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved_site`
--

INSERT INTO `saved_site` (`id`, `site_category`, `url`, `title`) VALUES
(1, 3, 'https://xeno-canto.org/', 'xeno-canto - bird sounds');

-- --------------------------------------------------------

--
-- Table structure for table `site_category`
--

DROP TABLE IF EXISTS `site_category`;
CREATE TABLE `site_category` (
  `id` mediumint(9) NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `descriptor` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_category`
--

INSERT INTO `site_category` (`id`, `display_order`, `descriptor`) VALUES
(1, 1, 'Don\'t forget'),
(2, 2, 'Web development'),
(3, 3, 'Science and Technology\r\n'),
(4, NULL, 'Time wasters'),
(5, NULL, 'Tech thoughts'),
(6, NULL, 'Stuff'),
(7, NULL, 'Experiments');

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
(17, 2, 374, 'Framing is everything. In 1998, for a Wizard of Oz listing on TCM, writer Rick Polito wrote, “Transported to a surreal landscape, a young girl kills the first person she meets and then teams up with three strangers to kill again.” Watch out for people who frame things using emotionally manipulative language—theyre trying to control you, sell your something, or both.'),
(18, 2, 252, 'Knowledge isn’t power, because people don’t live in a factual world. People live in a narrative world—a world of stories and ideas. Most of the things that are most important to people are just stories. The ability to control narratives is power.'),
(19, 2, 340, 'Loving someone more than you love yourself is not love, it’s codependency. When you love someone more than you love yourself, you lose the ability to set boundaries. You prioritize the desires of others over your own needs, even if it damages you. You allow others to harm you, because what they want is more important than what you want.'),
(20, 2, 67, 'Holding into your ideas no matter what the facts say is not virtue.'),
(21, 6, 198, 'To be nobody but yourself in a world which is doing its best day and night to make you like everybody else means to fight the hardest battle which any human being can fight and never stop fighting.'),
(22, 2, 388, 'Poet e. e. cummings was right when he said “To be nobody but yourself in a world which is doing its best day and night to make you like everybody else means to fight the hardest battle which any human being can fight and never stop fighting.” Having said that, you don’t necessarily have to show up to every battle you’re invited to. Sometimes there are better uses for your time.'),
(23, 2, 133, 'It is deceptively easy to forget that other people are real. If you want others to respect you as a person, start by respecting them.'),
(24, 2, 230, 'Everyone you meet is better at something than you are. To have worth and value, it is not necessary to be the best, the greatest, the most outstanding. If you start from the idea that it is, you will always measure yourself short.'),
(25, 2, 42, 'When a thief kisses you, count your teeth.'),
(26, 2, 129, 'There is a difference between an argument and evidence. Learn it, understand it, and you will become much more difficult to fool.'),
(27, 2, 107, 'Moral “purity” feels good, but for ethics to live in the real world, they must start as harm reduction.'),
(28, 2, 250, 'Consent and outcome are two different things. If you agree to something you later find you didn’t like, your consent was not violated. If someone does something to you without your consent that you find you enjoyed, your consent was still violated.'),
(29, 2, 107, 'The beginning of evil is the absence of empathy. When you treat people as things, that’s where it starts.'),
(30, 2, 62, 'Education is not the solution if ignorance is not the problem.'),
(31, 2, 67, 'People vote their identity and their feelings, not their interests.'),
(32, 2, 125, 'We are predisposed to believe what we wish were true or what we’re afraid is true. Understanding what is true is hard work.'),
(33, 1, 58, 'Without deviation from the norm, progress is not possible.'),
(34, 1, 193, 'If you end up with a boring miserable life because you listened to your mom, your dad, your teacher, your priest, or some guy on television telling you how to do your shit, then you deserve it.'),
(35, 1, 119, 'Without music to decorate it, time is just a bunch of boring production deadlines or dates by which bills must be paid.'),
(36, 1, 341, 'The illusion of freedom will continue as long as it\'s profitable to continue the illusion. At the point where the illusion becomes too expensive to maintain, they will just take down the scenery, they will pull back the curtains, they will move the tables and chairs out of the way and you will see the brick wall at the back of the theater.'),
(37, 1, 64, 'There\'s a big difference between kneeling down and bending over.'),
(38, 1, 76, 'Government is the Entertainment division of the military-industrial complex.'),
(39, 7, 57, 'The way to get started is to quit talking and begin doing.'),
(40, 8, 663, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque ut massa varius bibendum. Quisque tincidunt turpis quis tincidunt consequat. Proin urna sem, condimentum eget accumsan vitae, rhoncus vitae diam. Donec sit amet magna ut sapien dapibus pretium quis ac leo. Nulla eu tellus eros. Integer lobortis erat ac justo scelerisque rhoncus. Maecenas sapien odio, ornare eget nisl porttitor, pretium tempor enim. Proin enim magna, ultricies eu mi eget, pellentesque maximus risus. Praesent euismod metus ut maximus egestas. Nam sed vestibulum tellus. Morbi id ipsum nec ligula aliquet auctor. In leo magna, efficitur a luctus eu, lobortis eget lorem.'),
(41, 8, 418, 'Nunc condimentum lectus quis imperdiet elementum. Nulla urna ligula, venenatis vel lobortis consequat, tempus sit amet massa. Phasellus semper felis ultrices diam euismod, nec scelerisque diam fringilla. Donec luctus augue in erat scelerisque dignissim. Fusce tincidunt mi maximus justo m bnm,./enim blandit ut. Sed pellentesque, dolor eget ornare gravida, libero erat pulvinar justo, nec suscipit erat ante quis urna.'),
(42, 8, 933, 'Sed leo nisi, dignissim sit amet velit non, consequat ullamcorper ante. Maecenas vel leo sit amet enim rhoncus fringilla. Quisque magna ex, laoreet sit amet orci vel, euismod consectetur metus. Proin blandit dui non interdum rutrum. Aenean egestas pretium porttitor. Quisque et posuere metus, a scelerisque ipsum. Vivamus consequat magna tempor libero blandit, eu lacinia mi ultrices. Morbi volutpat, sapien id volutpat porta, lorem diam faucibus orci, a condimentum libero ipsum gravida nisi. Integer id est quam. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla varius quis ex ut feugiat. Aliquam consequat, libero nec ornare egestas, lectus erat viverra mauris, in posuere orci sapien et augue. Sed egestas lorem vestibulum eros porttitor dapibus. Quisque eu lectus odio. Duis faucibus, neque in pharetra vulputate, turpis sapien scelerisque sem, in imperdiet nunc diam vulputate nulla.'),
(43, 9, 158, 'Your time is limited, so don\'t waste it living someone else\'s life. Don\'t be trapped by dogma – which is living with the results of other people\'s thinking.'),
(44, 10, 52, 'You must be the change you wish to see in the world.'),
(45, 11, 47, 'The only thing we have to fear is fear itself. '),
(46, 12, 110, 'Darkness cannot drive out darkness: only light can do that. Hate cannot drive out hate: only love can do that.'),
(47, 13, 81, 'Do not go where the path may lead, go instead where there is no path and leave a trail.'),
(48, 14, 34, 'Speak softly and carry a big stick'),
(49, 15, 30, 'All that glitters is not gold.'),
(50, 15, 68, 'All the world’s a stage, and all the men and women merely players.'),
(51, 16, 114, 'The best and most beautiful things in the world cannot be seen or even touched - they must be felt with the heart.'),
(52, 17, 44, 'Be yourself; everyone else is already taken.'),
(53, 18, 71, 'You will face many defeats in life, but never let yourself be defeated.'),
(54, 19, 69, 'Success usually comes to those who are too busy to be looking for it.'),
(55, 19, 78, 'Go confidently in the direction of your dreams! Live the life you\'ve imagined.'),
(56, 20, 89, 'There are only two hard things in Computer Science: cache invalidation and naming things.');

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
(5, 'Jean-Louis Gassée'),
(6, 'e.e. cummings'),
(7, 'Walt Disney'),
(8, 'sort of Cicero'),
(9, 'Steve Jobs'),
(10, 'Mahatma Gandhi'),
(11, 'Franklin D. Roosevelt'),
(12, 'Martin Luther King Jr.'),
(13, 'Ralph Waldo Emerson'),
(14, 'Theodore Roosevelt'),
(15, 'William Shakespeare'),
(16, 'Helen Keller'),
(17, 'Oscar Wilde'),
(18, 'Maya Angelou'),
(19, 'Henry David Thoreau'),
(20, 'Phil Karlton');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saved_site`
--
ALTER TABLE `saved_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_category`
--
ALTER TABLE `site_category`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `saved_site`
--
ALTER TABLE `saved_site`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_category`
--
ALTER TABLE `site_category`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `text_block`
--
ALTER TABLE `text_block`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `text_source`
--
ALTER TABLE `text_source`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
