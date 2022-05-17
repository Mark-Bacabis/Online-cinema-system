-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 05:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_ticket_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(11) NOT NULL,
  `username` varchar(16) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`) VALUES
('1', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking_tbl`
--

CREATE TABLE `booking_tbl` (
  `bookID` int(11) NOT NULL,
  `transactionID` varchar(55) NOT NULL,
  `dateBooked` date NOT NULL,
  `userID` varchar(11) NOT NULL,
  `userEmail` varchar(55) NOT NULL,
  `movieID` varchar(11) NOT NULL,
  `dateToday` date NOT NULL,
  `cinemaID` varchar(11) NOT NULL,
  `showID` varchar(11) NOT NULL,
  `ticketPrice` double(10,2) NOT NULL,
  `numberOfSeats` int(11) NOT NULL,
  `seatNumber` varchar(55) NOT NULL,
  `totalPrice` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_tbl`
--

INSERT INTO `booking_tbl` (`bookID`, `transactionID`, `dateBooked`, `userID`, `userEmail`, `movieID`, `dateToday`, `cinemaID`, `showID`, `ticketPrice`, `numberOfSeats`, `seatNumber`, `totalPrice`) VALUES
(58, 'NXT1ZE384FIR7', '2022-05-26', 'user-001', 'mark.melvin.bacabis@gmail.com', 'movie-02', '2022-05-17', 'c3', 'show-01', 550.00, 2, 'C3,C5', 1100.00),
(59, 'NXTXF6PWR2CQZ', '2022-05-26', 'user-001', 'mark.melvin.bacabis@gmail.com', 'movie-02', '2022-05-17', 'c5', 'show-01', 550.00, 2, 'C3,C5', 1100.00),
(60, 'NXT23OY1KUGIV', '2022-05-26', 'user-002', 'jessica.ombao.bulleque@gmail.com', 'movie-02', '2022-05-17', 'c5', 'show-01', 550.00, 1, 'E5', 550.00),
(61, 'NXTYACI671XPD', '2022-05-20', 'user-001', 'mark.melvin.bacabis@gmail.com', 'movie-01', '2022-05-17', 'c4', 'show-01', 620.00, 1, 'C5', 620.00),
(62, 'NXTD8KR4AWO6I', '2022-05-20', 'user-003', 'marlon.union.eballes@gmail.com', 'movie-01', '2022-05-17', 'c4', 'show-01', 620.00, 5, 'A3,D2,D6,D8,E7', 3100.00);

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

CREATE TABLE `cinema` (
  `cinemaID` varchar(11) NOT NULL,
  `cinemaName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`cinemaID`, `cinemaName`) VALUES
('c1', 'Cinema 1'),
('c2', 'Cinema 2'),
('c3', 'Cinema 3'),
('c4', 'Cinema 4'),
('c5', 'Cinema 5');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieID` varchar(11) NOT NULL,
  `Title` varchar(55) NOT NULL,
  `Genre` varchar(55) NOT NULL,
  `Year` year(4) NOT NULL,
  `Duration` varchar(20) NOT NULL,
  `Rating` varchar(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Director` varchar(255) NOT NULL,
  `Cast` varchar(255) NOT NULL,
  `Poster` varchar(55) NOT NULL,
  `Banner` varchar(55) NOT NULL,
  `Trailer` varchar(55) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieID`, `Title`, `Genre`, `Year`, `Duration`, `Rating`, `Description`, `Director`, `Cast`, `Poster`, `Banner`, `Trailer`, `Price`, `isAvailable`) VALUES
('movie-01', 'Uncharted', ' Adventure/Action', 2022, '1hr 56m', 'PG-13', 'Treasure hunter Victor \'Sully\' Sullivan recruits street-smart Nathan Drake to help him recover a 500-year-old lost fortune amassed by explorer Ferdinand Magellan. What starts out as a heist soon becomes a globe-trotting, white-knuckle race to reach the pr', 'Ruben Fleischer', 'Tom Holland, Sophia Taylor Ali, Mark Wahlberg', 'poster-6282c51f20257.jpg', 'banner-6282c51f2025b.jpg', 'https://www.youtube.com/embed/eHp3MbsCbMg', '570.00', 1),
('movie-010', 'Spiral', ' Horror/Thriller', 2021, '1h 33m', '5.2', 'Working in the shadow of his father, Detective Ezekiel Banks and his rookie partner take charge of an investigation into grisly murders that are eerily reminiscent of the city\'s gruesome past. Unwittingly entrapped in a deepening mystery, Zeke find', 'Darren Lynn Bousman', 'Chris Rock, Marisol Nichols, Max Minghella', 'poster-628310ed08a49.jpg', 'banner-628310ed08a4d.jpg', 'https://www.youtube.com/embed/gzy6ORqE9IY', '560.00', 1),
('movie-011', 'Bubble', 'Anime/Animation', 2022, ' 1h 40m', '6.5', 'Gravity-defying bubbles rain down, cutting off Tokyo from the rest of the world. The city skyline becomes a playground for young people competing in parkour team battles. Hibiki plummets into the sea but is saved by a girl with mysterious powers.', 'TetsurÅ Araki', 'Jun Shison, Alice Hirose, Yuki Kaji', 'poster-6283119f22d18.jpg', 'banner-6283119f22d1b.jpeg', 'https://www.youtube.com/embed/8pbWblLkHHk', '450.00', 1),
('movie-012', 'Spider-Man: No Way Home', 'Action/Adventure', 2021, '2h 28m', '8.4', 'With Spider-Man\'s identity now revealed, our friendly neighborhood web-slinger is unmasked and no longer able to separate his normal life as Peter Parker from the high stakes of being a superhero. When Peter asks for help from Doctor Strange, the stakes b', 'Jon Watts', 'Tom Holland, Tobey Maguire, Zendaya', 'poster-62831239ec6b4.jpg', 'banner-62831239ec6b8.jpg', 'https://www.youtube.com/embed/JfVOs4VSpmA', '650.00', 1),
('movie-013', 'Avengers: Endgame', 'Action/Sci-fi', 2019, '3h 2m', '8.4', 'Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their', 'Anthony Russo, Joe Russo', 'Robert Downey Jr., Chris Evans, Scarlett Johansson', 'poster-628312d41311c.jpg', 'banner-628312d413120.jpg', 'https://www.youtube.com/embed/TcMBFSGVi1c', '500.00', 0),
('movie-014', 'Spider-Man: Into the Spider-Verse', ' Family/Action ', 2018, '1h 56m', '8.4', 'Bitten by a radioactive spider in the subway, Brooklyn teenager Miles Morales suddenly develops mysterious powers that transform him into the one and only Spider-Man. When he meets Peter Parker, he soon realizes that there are many others who share his sp', 'Peter Ramsey, Bob Persichetti, Rodney Rothman', 'Jake Johnson, Shameik Moore, Hailee Steinfeld', 'poster-6283138831f9b.jpg', 'banner-6283138831f9f.jpg', 'https://www.youtube.com/embed/g4Hbz2jLxvQ', '450.00', 0),
('movie-02', 'Umma', 'Horror/Thriller', 2022, '1h 23m', 'PG-13', 'A woman\'s quiet life on an American farm takes a terrifying turn when the remains of her estranged mother arrive from Korea.', 'Iris Shim', 'Sandra Oh, Fivel Stewart', 'poster-6282c69278488.jpg', 'banner-6282c6927848d.jpg', 'https://www.youtube.com/embed/QQdXvvtu-iI', '500.00', 1),
('movie-03', 'Senior Year', 'Comedy', 2022, '1h 51m', 'R', 'A high-school cheerleader falls into a coma before her prom. Twenty years later, she awakens and wants to return to high school to reclaim her status and become prom queen.', 'Alex Hardcastle', 'Rebel Wilson, Angourie Rice, Joshua Colley', 'poster-6282c7e715796.jpg', 'banner-6282c7e71579b.jpg', 'https://www.youtube.com/embed/cKt4BzXkZT8', '480.00', 0),
('movie-04', 'Doctor Strange in the Multiverse of Madness', 'Adventure/Action', 2022, '2h 6m', '7.4', 'Dr Stephen Strange casts a forbidden spell that opens a portal to the multiverse. However, a threat emerges that may be too big for his team to handle.', ' Sam Raimi', 'Elizabeth Olsen, Xochitl Gomez, Benedict Cumberbatch', 'poster-62830bff472c9.jpg', 'banner-62830bff472ce.jpg', 'https://www.youtube.com/embed/aWzlQ2N6qqg', '650.00', 1),
('movie-05', 'Morbius', 'Action/Adventure', 2022, '1h 48m', '5.1', 'Dangerously ill with a rare blood disorder and determined to save others from the same fate, Dr. Morbius attempts a desperate gamble. While at first it seems to be a radical success, a darkness inside of him is soon unleashed.', 'Daniel Espinosa', 'Jared Leto, Michael Keaton, Matt Smith', 'poster-62830d0fc4ba3.jpg', 'banner-62830d0fc4ba8.jpg', 'https://www.youtube.com/embed/oZ6iiRrz1SY', '450.00', 1),
('movie-06', 'The Batman', 'Action/Adventure', 2022, '2h 56m', '8', 'Batman ventures into Gotham City\'s underworld when a sadistic killer leaves behind a trail of cryptic clues. As the evidence begins to lead closer to home and the scale of the perpetrator\'s plans become clear, he must forge new relationships, unmask the c', 'Matt Reeves', 'Robert Pattinson, ZoÃ« Kravitz, Paul Dano', 'poster-62830daf37a7e.jpeg', 'banner-62830daf37a81.jpg', 'https://www.youtube.com/embed/mqqft2x_Aa4', '540.00', 1),
('movie-07', 'Kimi', 'Thriller/Crime', 2022, '1h 29m', '6.3', 'A tech worker with agoraphobia discovers recorded evidence of a violent crime, but is met with resistance when she tries to report it. Seeking justice, she must do the thing she fears the most: she must leave her apartment.', 'Steven Soderbergh', 'ZoÃ« Kravitz, Erika Christensen, Rita Wilson', 'poster-62830e91ceeb5.jpg', 'banner-62830e91ceeb9.jpg', 'https://www.youtube.com/embed/67S8ru4K4x4', '540.00', 1),
('movie-08', 'Shang-Chi and the Legend of the Ten Rings', 'Action/Fantasy', 2021, '2h 12m', '7.4', 'Martial-arts master Shang-Chi confronts the past he thought he left behind when he\'s drawn into the web of the mysterious Ten Rings organization.', 'Destin Daniel Cretton', 'Simu Liu, Awkwafina, Michelle Yeoh', 'poster-62830fa900324.jpg', 'banner-62830fa900327.jpg', 'https://www.youtube.com/embed/8YjFbMbfXaQ', '590.00', 1),
('movie-09', 'Raya and the Last Dragon', 'Animation', 2021, ' 1h 54m', '7.3', 'Long ago, in the fantasy world of Kumandra, humans and dragons lived together in harmony. However, when sinister monsters known as the Druun threatened the land, the dragons sacrificed themselves to save humanity. Now, 500 years later, those same monsters', 'Carlos LÃ³pez Estrada, Don Hall', 'Awkwafina, Kelly Marie Tran, Sandra Oh', 'poster-6283107ba8793.jpg', 'banner-6283107ba8796.jpg', 'https://www.youtube.com/embed/1VIZ89FEjYI', '500.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie_available_date`
--

CREATE TABLE `movie_available_date` (
  `mvdID` int(11) NOT NULL,
  `movieID` varchar(11) NOT NULL,
  `availableDate` date NOT NULL,
  `cinemaID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_available_date`
--

INSERT INTO `movie_available_date` (`mvdID`, `movieID`, `availableDate`, `cinemaID`) VALUES
(25, 'movie-01', '2022-05-20', 'c2'),
(26, 'movie-01', '2022-05-20', 'c4'),
(29, 'movie-02', '2022-05-26', 'c1'),
(30, 'movie-02', '2022-05-26', 'c3'),
(31, 'movie-02', '2022-05-26', 'c5'),
(32, 'movie-03', '2022-07-20', 'c1'),
(33, 'movie-03', '2022-07-20', 'c2'),
(34, 'movie-03', '2022-07-20', 'c4'),
(35, 'movie-04', '2022-05-18', 'c2'),
(36, 'movie-04', '2022-05-18', 'c5'),
(37, 'movie-05', '2022-05-19', 'c1'),
(38, 'movie-05', '2022-05-19', 'c5'),
(39, 'movie-06', '2022-05-19', 'c1'),
(40, 'movie-06', '2022-05-19', 'c3'),
(41, 'movie-06', '2022-05-19', 'c5'),
(42, 'movie-07', '2022-05-20', 'c1'),
(43, 'movie-07', '2022-05-20', 'c2'),
(44, 'movie-07', '2022-05-20', 'c3'),
(45, 'movie-08', '2022-05-20', 'c1'),
(46, 'movie-08', '2022-05-20', 'c3'),
(47, 'movie-08', '2022-05-20', 'c4'),
(48, 'movie-09', '2022-05-23', 'c1'),
(49, 'movie-09', '2022-05-23', 'c2'),
(50, 'movie-09', '2022-05-23', 'c3'),
(51, 'movie-010', '2022-05-24', 'c1'),
(52, 'movie-010', '2022-05-24', 'c2'),
(53, 'movie-010', '2022-05-24', 'c3'),
(54, 'movie-010', '2022-05-24', 'c4'),
(55, 'movie-011', '2022-05-25', 'c1'),
(56, 'movie-011', '2022-05-25', 'c2'),
(57, 'movie-011', '2022-05-25', 'c3'),
(58, 'movie-012', '2022-05-26', 'c1'),
(59, 'movie-012', '2022-05-26', 'c3'),
(60, 'movie-012', '2022-05-26', 'c5'),
(61, 'movie-013', '2022-07-18', 'c2'),
(62, 'movie-013', '2022-07-18', 'c3'),
(63, 'movie-013', '2022-07-18', 'c4'),
(64, 'movie-014', '2022-07-20', 'c1'),
(65, 'movie-014', '2022-07-20', 'c3'),
(66, 'movie-014', '2022-07-20', 'c4');

-- --------------------------------------------------------

--
-- Table structure for table `seat_tbl`
--

CREATE TABLE `seat_tbl` (
  `userID` varchar(11) NOT NULL,
  `movieID` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `cinemaID` varchar(11) NOT NULL,
  `showID` varchar(11) NOT NULL,
  `seatNumber` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat_tbl`
--

INSERT INTO `seat_tbl` (`userID`, `movieID`, `date`, `cinemaID`, `showID`, `seatNumber`) VALUES
('user-001', 'movie-02', '2022-05-26', 'c3', 'show-01', 'C3'),
('user-001', 'movie-02', '2022-05-26', 'c3', 'show-01', 'C5'),
('user-001', 'movie-02', '2022-05-26', 'c5', 'show-01', 'C3'),
('user-001', 'movie-02', '2022-05-26', 'c5', 'show-01', 'C5'),
('user-002', 'movie-02', '2022-05-26', 'c5', 'show-01', 'E5'),
('user-001', 'movie-01', '2022-05-20', 'c4', 'show-01', 'C5'),
('user-003', 'movie-01', '2022-05-20', 'c4', 'show-01', 'A3'),
('user-003', 'movie-01', '2022-05-20', 'c4', 'show-01', 'D2'),
('user-003', 'movie-01', '2022-05-20', 'c4', 'show-01', 'D6'),
('user-003', 'movie-01', '2022-05-20', 'c4', 'show-01', 'D8'),
('user-003', 'movie-01', '2022-05-20', 'c4', 'show-01', 'E7');

-- --------------------------------------------------------

--
-- Table structure for table `show_time`
--

CREATE TABLE `show_time` (
  `showID` varchar(11) NOT NULL,
  `showName` varchar(55) NOT NULL,
  `showStart` time NOT NULL,
  `showEnd` time NOT NULL,
  `showPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `show_time`
--

INSERT INTO `show_time` (`showID`, `showName`, `showStart`, `showEnd`, `showPrice`) VALUES
('show-01', 'First Show', '08:00:00', '11:00:00', '50.00'),
('show-02', 'Noon', '13:00:00', '16:00:00', '30.00'),
('show-03', 'Evening', '17:00:00', '20:00:00', '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` varchar(11) NOT NULL,
  `firstName` varchar(55) NOT NULL,
  `lastName` varchar(55) NOT NULL,
  `Gender` varchar(11) NOT NULL,
  `Birthday` varchar(255) NOT NULL,
  `contactNumber` varchar(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(16) NOT NULL,
  `profile` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `Gender`, `Birthday`, `contactNumber`, `email`, `password`, `profile`) VALUES
('user-001', 'Mark Melvin', 'Bacabis', 'Male', '1999-12-08', '09123456789', 'mark.melvin.bacabis@gmail.com', 'markmelvin', 'profile -6282e9eba0dec.jpg'),
('user-002', 'Jessica', 'Bulleque', 'Female', '2001-06-08', '09123456789', 'jessica.ombao.bulleque@gmail.com', 'jessicaganda', 'default.jpg'),
('user-003', 'Marlon', 'Eballes', 'Male', '2001-01-01', '09972760119', 'marlon.union.eballes@gmail.com', 'helzonal  123', 'profile -6282fd3b2bed3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedbacks`
--

CREATE TABLE `user_feedbacks` (
  `id` int(11) NOT NULL,
  `userID` varchar(11) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_feedbacks`
--

INSERT INTO `user_feedbacks` (`id`, `userID`, `feedback`) VALUES
(4, 'user-001', 'The user\'s usability of this website is very great!!'),
(7, 'user-002', 'This is great site!!!'),
(8, 'user-003', 'hehe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`cinemaID`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieID`);

--
-- Indexes for table `movie_available_date`
--
ALTER TABLE `movie_available_date`
  ADD PRIMARY KEY (`mvdID`);

--
-- Indexes for table `show_time`
--
ALTER TABLE `show_time`
  ADD PRIMARY KEY (`showID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_feedbacks`
--
ALTER TABLE `user_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `movie_available_date`
--
ALTER TABLE `movie_available_date`
  MODIFY `mvdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `user_feedbacks`
--
ALTER TABLE `user_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
