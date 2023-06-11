-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 12:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ymbentertainement`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonne`
--

CREATE TABLE `abonne` (
  `ID_ABONNE` int(11) NOT NULL,
  `USERNAME_ABONNE` varchar(30) NOT NULL,
  `PASSWORD_ABONNE` varchar(32) NOT NULL,
  `EMAIL_ABONNE` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abonne`
--

INSERT INTO `abonne` (`ID_ABONNE`, `USERNAME_ABONNE`, `PASSWORD_ABONNE`, `EMAIL_ABONNE`) VALUES
(4, 'herewego', '10293847', 'basskar2049@gmail.com'),
(7, 'aziz', 'azizaziz', 'aziiiiiiiiz@gmail.com'),
(17, 'jfklsdjfklsdj', 'zzzzzzzz', 'dfjsdjfks@jjfhsuh'),
(18, 'azizo', '12345678', 'azizo@gmail.com'),
(19, 'yassibfdf', 'asdfasdf', 'dxfdhjhfdfsr@ygyuhji'),
(20, 'gjhgtddsddtd', '123456543', 'rdtrdtftf@dxerse'),
(21, 'skjsdkjskldj', '23452345', 'kjkjcjvhx@dhfsuidfh'),
(22, 'hfuighuihguid', 'asdfasdf', 'fuiwetuerhu@dhsdh'),
(23, 'jddgajhfj', 'vhvhvhvh', 'hjhdjsahjk@jdhjahf'),
(24, 'hellothere', 'cccccccc', 'dfjkdjfkj@jfhjhd'),
(25, 'iksi', 'iksi1234', 'iksi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `USERNAME_ADMIN` varchar(30) NOT NULL,
  `PASSWORD_ADMIN` varchar(32) NOT NULL,
  `CREATOR_ADMIN` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `USERNAME_ADMIN`, `PASSWORD_ADMIN`, `CREATOR_ADMIN`) VALUES
(1, 'ymbentertainementadmin', 'ymbentertainementadmin', 1),
(10, 'popo', 'iksi1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `ID_ARTCL` int(11) NOT NULL,
  `ID_CATEG` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `USERNAME_ADMIN` varchar(30) NOT NULL,
  `TITLE_ARTCL` varchar(100) NOT NULL,
  `DESCRIPTION_ARTCL` varchar(300) NOT NULL,
  `MAIN_IMG_ARTCL` varchar(200) NOT NULL,
  `CONTENT_ARTCL` varchar(15000) NOT NULL,
  `VISITS_ARTCL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`ID_ARTCL`, `ID_CATEG`, `ID_ADMIN`, `USERNAME_ADMIN`, `TITLE_ARTCL`, `DESCRIPTION_ARTCL`, `MAIN_IMG_ARTCL`, `CONTENT_ARTCL`, `VISITS_ARTCL`) VALUES
(24, 2, 1, 'ymbentertainementadmin', 'Call of Duty 2023 is Proof It’s Time to End A Series-Long Tradition', 'niceeee', '../img/gaming/6474ec524e490_call_of_duty_23.jpg', 'The Call of Duty franchise has enjoyed annual releases since 2004, with the IP outputting nearly two decades of consistent content. It is no secret that Call of Duty owes a lot of its success to this consistency, with the series sitting at the top of the competitive first-person shooter genre. Despite this, 2023 sparked rumors of an end to this tradition. For a long time, it was widely reported that 2023 would see no Call of Duty release. This was consistent with the scale behind 2022\'s Modern Warfare 2, which made many think the title would be given an unusual two-year stint as the most recent mainline release.\r\nThese rumors then shifted into 2023 seeing a smaller-scale release for CoD, with many stating the year would see a campaign expansion for Modern Warfare 2. However, the most sizable and reputable reports behind 2023\'s CoD have blown these theories out of the water. Now, some believe that 2023 will see the launch of Modern Warfare 3, a full premium release spearheaded by Sledgehammer Games. Given the importance behind this trilogy-capping title and its quick turnaround, many are of the opinion that annual CoD releases are no longer sustainable.\r\nGiven the oddly shifting discourse behind 2023\'s CoD rumors, the time of annual releases for the IP may be coming to an end. The recent reboot of the Modern Warfare series has been a huge success for Activision, with the popular BR Warzone launching alongside this. These MW titles have arguably brought Call of Duty its most large-scale recent success, yet the 2023 rumors indicate a rushed finale for the series.\r\nThere were three years between 2019\'s Modern Warfare and its series successor, which crucially gave fans time to exhaust the first\'s content and grow eager for a sequel. The community reportedly will not get this opportunity for Modern Warfare 2, given that MW3\'s rumored release could come only one year later.\r\nThe heavy involvement of Sledgehammer Games is also a worrying factor for 2023\'s CoD, if it is to be Modern Warfare 3. The MW franchise is synonymous with Infinity Ward, which spearheaded the first two reboot installments, and handing off the finale to another studio is a confusing move. The conflicting reports about the release almost half-way into the year do not bode well for the title, causing further fan-led concern.', 12),
(25, 3, 1, 'ymbentertainementadmin', 'John Wick 5: Lionsgate Boss Confirms Early Development', 'John Wick: Chapter 4 catapulted into theaters earlier this year, leaving the action franchise on some unique footing. While the fate of the titular antihero has been speculated about a lot, it sounds like the journey definitely isn\'t over...', '../img/movies/6474eda3afea3_john_wick_4.jpg', 'John Wick: Chapter 4 catapulted into theaters earlier this year, leaving the action franchise on some unique footing. While the fate of the titular antihero has been speculated about a lot, it sounds like the journey definitely isn\'t over. During Lionsgate\'s Q4 2023 earnings call, Motion Picture Group chairman Joe Drake confirmed that a fifth John Wick film remains in early development.\r\n\"We\'re now moving across that franchise, not just in the AAA video game space, but looking at what the regular cadence of spin-offs, television really growing that universe so that there is a steady cadence of a franchise that there\'s clear appetite by the audience,\" Drake explained. \"What is official is that, as you know, Ballerina is the first spinoff that comes out next year. We\'re in development on three others, including [John Wick 5] and including television series, The Continental, will be airing soon. And so, we\'re building out the world and when that five movie comes, will be organic -- will be organically grown out of how we\'re starting to tell those stories. But you can rely on a regular cadence of John Wick.\"\r\nOne of the next extensions of the John Wick franchise will be Ballerina, a spinoff film following the titular retired ballerina assassin (played by Ana de Armas) pulled back in by the murder of her family. Based on the lore established around Anjelica Houston\'s The Director in the third John Wick film, the project will be directed by Len Wiseman, and will also see the return of Keanu Reeves as John Wick and Ian McShane as Winston.\r\nThe screenplay for Ballerina is written by Shay Hatten, and the film is produced by Basil Iwanyk, Erica Lee, and Chad Stahelski. Brady Fujikawa and Chelsea Kujawa are overseeing the project for Lionsgate. \r\n\"Having him [Ballerina director Len Wiseman] on board and approaching some of the action design from a slightly different perspective, meaning the set pieces, the character involvement, how and what he wants to do during the action sequences, makes it kind of fresh,\" Stahelski told THR in a previous interview. \"So, we\'re not just copying ourselves over and over again with gun-fu or something like that. And because the character is different, we\'re going to get a different take on things. But as far as the level, the competence or the style of action? Yes. I plan to be there to assist whenever I can. And our 87eleven stunt team will be very actively involved in helping Len in all his action needs.\"\r\nHow do you feel about John Wick 5 being in early development? Share your thoughts with us in the comments below!', 6),
(26, 5, 1, 'ymbentertainementadmin', 'TRAVIS REVEALS SECRET WEAPON THAT MAKES ', 'Travis Scott has opened up about what fans can expect when it comes to the sound of his upcoming album Utopia, and its production...', '../img/music/6474ee8fdae25_travis-scott-utopia.jpg', 'La Flame recently sat down with PIN-UP magazine where they dug deeper into the usually elusive rapper’s state-of-mind and design principles using a unique A-Z perspective.\r\nPart of that process included his go-to beatmaking machines like the MPC which he used to helm the sound of Utopia. “I made most of my new album on an MPC,” he said. I got new ones; I got some old ones. My favorite is the 2000XL. It produces a very distinctive sound that makes it feel alive.”\r\nScott also hit on his definition of Utopia and how it’s not all about living the perfect and most lavish life. “Utopia is something that people feel is so far-fetched and out of reach, some perfect state of mind. But you create it yourself,” he explained.\r\n“There are people who achieve utopia every day. They may not be the richest people with the dopest cribs, but it’s a utopia wherever they are, and that’s the most you can have.”\r\nScott went on: “With every album I live in these worlds in my mind — I’m trying to show people experiences where utopian things can exist, and you can enjoy yourself and have a good time. They can create energy that spews out magical things — new cures, new buildings, new avenues for people to move forward. People need to see that utopia is real.”', 19),
(27, 3, 1, 'ymbentertainementadmin', 'Christopher Nolan Confirms ‘Oppenheimer’ Is His Longest Movie and ‘Kissing Three Hours’: ‘Slightly L', 'Christopher Nolan has finally weighed in on the “Oppenheimer” runtime, confirming to Total Film magazine that it is his longest movie to date...', '../img/movies/6474fd8e412f3_oppenheimer-trailer.jpg', 'Christopher Nolan has finally weighed in on the “Oppenheimer” runtime, confirming to Total Film magazine that it is his longest movie to date. The director’s confirmation means “Oppenheimer” at least runs longer than 2 hours and 49 minutes. That was the runtime on “Interstellar,” the director’s longest movie until “Oppenheimer.” Previous reports pegged the “Oppenheimer” runtime at three hours, which Nolan said is almost true.\r\n“It’s slightly longer than the longest we’ve done,” Nolan said. “It’s kissing three hours.”\r\n“Oppenheimer” stars Nolan’s frequent collaborator Cillian Murphy as theoretical physicist and “father of the atomic bomb” J. Robert Oppenheimer. The film tracks Oppenheimer as he launches the Manhattan Project and oversees the creation of the atom bomb.\r\n“I think of any character I’ve dealt with, Oppenheimer is by far the most ambiguous and paradoxical,” Nolan told Total Film magazine. “Which, given that I’ve made three Batman films, is saying a lot.”\r\n\r\n“The script was so emotional, and it reads like a thriller,” added Emily Blunt, who stars as biologist and Oppenheimer’s wife Katherine. “It’s almost like he’s Trojan-Horsed a biopic into a thriller. It’s really pulse-racing, the whole thing. I was just completely arrested by the story, the portrait of this man, and, I guess, the trauma of a brain like that.”\r\n\r\nJoining Murphy and Blunt in the cast are Matt Damon as Manhattan Project director Gen. Leslie Groves Jr. and Robert Downey Jr. as Lewis Strauss, a founding commissioner of the U.S. Atomic Energy Commission. Florence Pugh, Benny Safdie, Michael Angarano, Josh Hartnett, Rami Malek and more also star.\r\n“You realize this is a huge responsibility. He was complicated and contradictory and so iconic,” Murphy has previously said of taking on the character. “But you know you’re with one of the great directors of all time. I felt confident going into it with Chris. He’s had a profound impact on my life, creatively and professionally. He’s offered me very interesting roles and I’ve found all of them really challenging. And I just love being on his sets.”\r\n“Oppenheimer” opens in theaters July 21 from Universal Pictures.', 6),
(29, 4, 0, '', 'HBO and the Weeknd’s ‘The Idol’ Releases Final Trailer After Controversial Cannes Debut', 'HBO has released the official trailer for its explicit Sam Levinson-directed series “The Idol,” which is set to premiere on June 4.', '../img/tv_shows/647698d549edc_theweekend.png', '“The Idol” premiered at this year’s Cannes Film Festival, making it the first television show to officially debut at the festival. The series stars Lily-Rose Depp as rising pop star Jocelyn and Abel “The Weeknd” Tesfaye as Tedros, a powerful, sex-obsessed cult leader. \r\nAfter calling off her latest tour, Jocelyn is on a mission to reignite her career, with big dreams of becoming the biggest star in the industry. After she meets Tedros, Jocelyn is swiftly drawn into his world, where he promises to expand her career to new heights — at any cost.\r\nTesfaye and Depp’s new series was met with controversy ahead of its release when allegations of on-set turmoil broke earlier this year. Original director Amy Seimetz exited the show in April 2022, with several episodes already shot, due to a change in creative direction. Reports at the time alleged that Tesfaye felt the series was leaning too much into a “female perspective,” though the pop star has denied such claims. The series received less than favorable reviews out of Cannes, with Variety‘s Peter Debruge writing that the show “plays like a sordid male fantasy.”\r\nAside from Depp and Tesfaye, the cast includes Troye Sivan, Dan Levy, Da’Vine Joy Randolph, Eli Roth, Hari Nef, Jane Adams, Jennie Ruby Jane, Mike Dean, Moses Sumney, Rachel Sennott, Ramsey, Suzanna Son and Hank Azaria.\r\nTesfaye serves as a co-creator on the series alongside Levinson and Reza Fahim. \r\nWatch the official trailer for “The Idol” below. ', 0),
(30, 1, 0, 'herewego', 'Demon Slayer Season 3 Flashback Unlocks the Mist Hashira\'s Darkest Moment', 'Demon Slayer Season 3 has been diving into the Mist Hashira Muichiro Tokito\'s past with the latest episodes of the anime, but the flashback from the newest episode of Demon Slayer', '../img/anime/64769ab0bafb9_demon_slayer.jpg', 'Demon Slayer Season 3 has been diving into the Mist Hashira Muichiro Tokito\'s past with the latest episodes of the anime, but the flashback from the newest episode of Demon Slayer: Swordsmith Village Arc unlocked the darkest moment tucked away in Muichiro\'s past that he himself forgot all about! While the majority of Demon Slayer Season 3 thus far has been focusing on how Tanjiro Kamado and the others are dealing with Hantengu\'s wild powers, the latest episode of the Demon Slayer anime has brought Muichiro back to the center stage as he tries to deal with Gyokko\'s odd abilities too. \r\nDemon Slayer: Swordsmith Village Arc left Muichiro at quite the distressing stage as while he was able to break free from Gyokko\'s prison thanks to Kotetsu\'s help, it was still quite the huge mountain to climb for the rest of the fight ahead. Making matters even more eye opening is the fact that the formerly amnesiac Muichiro was able to make a major breakthrough and reach a new stage of power thanks to remembering a particularly distressing moment from his past: the death of his brother. \r\nDemon Slayer Season 3 Episode 8 sees Muichiro looking back into his past as it\'s explained that he\'s been struggling to remember, and it\'s why he\'s been so distant from everyone else. After losing both their mother and father within a single day, Muichiro and his twin brother Yuichiro were left to fend for themselves. Muichiro was kind while Yuichiro was cold, but things changed when a demon attacked the two of them. Yuichiro was maimed in the process, but Muichiro unleashed such a massive rage that he pinned down the demon with brutal attacks until daybreak. \r\nYuichiro lost his life in the attack, but it was here that Muichiro learned that Yuichiro was only harsh to him because it was the only way he really knew how to care for his brother. But in remembering this rage, and remembering what got him to this point as a Hashira, Muichiro was able to unlock a Demon Slayer Mark of his own as he now readies to take on Gyokko in full as Demon Slayer Season 3 enters its final slate of episodes. ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `ID_CATEG` int(11) NOT NULL,
  `NAME_CATEG` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID_CATEG`, `NAME_CATEG`) VALUES
(1, 'anime'),
(2, 'gaming'),
(3, 'movies'),
(4, 'tv_shows'),
(5, 'music');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID_COMMENT` int(11) NOT NULL,
  `ID_ABONNE` int(11) NOT NULL,
  `USERNAME_ABONNE` varchar(30) NOT NULL,
  `ID_ARTCL` int(11) NOT NULL,
  `CONTENT_COMMENT` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID_COMMENT`, `ID_ABONNE`, `USERNAME_ABONNE`, `ID_ARTCL`, `CONTENT_COMMENT`) VALUES
(3, 4, 'herewego', 27, 'i cant wait to see this movieee'),
(4, 25, 'iksi', 26, 'travis nasdi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`ID_ABONNE`,`USERNAME_ABONNE`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`,`USERNAME_ADMIN`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ID_ARTCL`),
  ADD KEY `FK_APPARTIENT` (`ID_CATEG`),
  ADD KEY `FK_MANIPULATE` (`ID_ADMIN`,`USERNAME_ADMIN`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID_CATEG`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID_COMMENT`),
  ADD KEY `FK_CAN_CREATE` (`ID_ABONNE`,`USERNAME_ABONNE`),
  ADD KEY `FK_CONTIENT` (`ID_ARTCL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonne`
--
ALTER TABLE `abonne`
  MODIFY `ID_ABONNE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `ID_ARTCL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID_COMMENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_APPARTIENT` FOREIGN KEY (`ID_CATEG`) REFERENCES `categorie` (`ID_CATEG`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_CAN_CREATE` FOREIGN KEY (`ID_ABONNE`,`USERNAME_ABONNE`) REFERENCES `abonne` (`ID_ABONNE`, `USERNAME_ABONNE`),
  ADD CONSTRAINT `FK_CONTIENT` FOREIGN KEY (`ID_ARTCL`) REFERENCES `article` (`ID_ARTCL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
