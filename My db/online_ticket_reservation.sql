-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 09:16 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

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

-- --------------------------------------------------------

--
-- Table structure for table `booking_tbl`
--

CREATE TABLE `booking_tbl` (
  `bookID` int(11) NOT NULL,
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

INSERT INTO `booking_tbl` (`bookID`, `dateBooked`, `userID`, `userEmail`, `movieID`, `dateToday`, `cinemaID`, `showID`, `ticketPrice`, `numberOfSeats`, `seatNumber`, `totalPrice`) VALUES
(10, '2021-06-22', 'user-001', 'mark.melvin.bacabis@gmail.com', 'movie-02', '2021-07-02', 'c2', 'show-01', 450.00, 3, 'B3,B4,B5', 1350.00),
(11, '2021-06-24', 'user-001', 'mark.melvin.bacabis@gmail.com', 'movie-01', '2021-07-02', 'c5', 'show-02', 480.00, 5, 'B2,B3,B4,B5,B6', 2400.00);

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
  `Poster` varchar(55) NOT NULL,
  `Banner` varchar(55) NOT NULL,
  `Trailer` varchar(55) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `isAvailable` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieID`, `Title`, `Genre`, `Year`, `Duration`, `Rating`, `Description`, `Poster`, `Banner`, `Trailer`, `Price`, `isAvailable`) VALUES
('movie-01', 'Raya and the Last Dragon', 'Action, Adventure, Animation', 2021, '1h 57m', 'PG', 'Raya and the Last Dragon is a movie about Raya and Sisu, the last dragon of Kumandra, and their quest of finding all the pieces of a magical gem to restore the land to its previous, peaceful form.', 'raya-poster.jpg', 'raya-banner.jpeg', 'https://www.youtube.com/embed/1VIZ89FEjYI', '450.00', 'True'),
('movie-02', 'Outside the Wire', 'Sci-Fi, Action', 2021, '1h 55m', 'R', '2021 American science fiction action film directed by Mikael Håfström. It stars Anthony Mackie (who also produced) as an android officer who works with a drone pilot (Damson Idris) to stop a global catastrophe. Emily Beecham, Michael Kelly, and Pilou Asba', 'outside-the-war-poster.jpg', 'outside-the-war-banner.jpg', 'https://www.youtube.com/embed/u8ZsUivELbs', '400.00', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `movie_available_date`
--

CREATE TABLE `movie_available_date` (
  `mvdID` varchar(11) NOT NULL,
  `movieID` varchar(11) NOT NULL,
  `availableDate` date NOT NULL,
  `cinemaID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_available_date`
--

INSERT INTO `movie_available_date` (`mvdID`, `movieID`, `availableDate`, `cinemaID`) VALUES
('mvd-001', 'movie-01', '2021-06-22', 'c1'),
('mvd-002', 'movie-01', '2021-06-24', 'c5'),
('mvd-003', 'movie-02', '2021-06-22', 'c2'),
('mvd-004', 'movie-02', '2021-06-22', 'c3'),
('mvd-005', 'movie-02', '2021-06-22', 'c4');

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
('user-001', 'movie-02', '2021-06-22', 'c2', 'show-01', 'B3'),
('user-001', 'movie-02', '2021-06-22', 'c2', 'show-01', 'B4'),
('user-001', 'movie-02', '2021-06-22', 'c2', 'show-01', 'B5'),
('user-001', 'movie-01', '2021-06-24', 'c5', 'show-02', 'B2'),
('user-001', 'movie-01', '2021-06-24', 'c5', 'show-02', 'B3'),
('user-001', 'movie-01', '2021-06-24', 'c5', 'show-02', 'B4'),
('user-001', 'movie-01', '2021-06-24', 'c5', 'show-02', 'B5'),
('user-001', 'movie-01', '2021-06-24', 'c5', 'show-02', 'B6');

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
  `contactNumber` varchar(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(16) NOT NULL,
  `profile` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `contactNumber`, `email`, `password`, `profile`) VALUES
('user-001', 'Mark Melvin', 'Bacabis', '09123456789', 'mark.melvin.bacabis@gmail.com', 'markmelvin', 'Bacabis.jpg'),
('user-002', 'Jessica', 'Bulleque', '09987654321', 'jessica.ombao.bulleque@gmail.com', 'iscabacs', 'default.jpg'),
('user-003', 'Hillary', 'Estrada', '09123123123', 'laryang.estrada@gmail.com', 'laryangpanget', 'default.jpg');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
