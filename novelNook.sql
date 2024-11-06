-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2024 at 07:22 PM
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
-- Database: `novelNook`
--

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `BookID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `CoverImage` varchar(255) NOT NULL,
  `ISBN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`BookID`, `Title`, `Author`, `Genre`, `Description`, `CoverImage`, `ISBN`) VALUES
(1, 'Soul', 'Olivia Wilson', 'Contemporary Romance', 'A gripping tale of love and redemption.', 'CoverImgs/Book1.jpeg', '0012345BN'),
(2, 'Roman', 'Olivia Wilson', 'Mystery', 'Unravel the secrets of a hidden society in this thrilling mystery novel.', 'CoverImgs/Book2.jpg', '0023456BN'),
(3, 'The End of Nobility', 'Micheal Green Jr.', 'Historical Fiction', 'Journey through time with unforgettable characters in this captivating historical fiction.', 'CoverImgs/Book3.jpeg', '0034567BN'),
(4, 'The Beauty Within', 'Samantha Donald', 'Adventure', 'Embark on an epic journey to discover the lost city of legends.', 'CoverImgs/Book4.jpg', '0045678BN'),
(5, 'Don\'t Look Back', 'Isaac Nelson', 'Thriller', 'Explore the boundless possibilities of the universe in this mind-bending sci-fi adventure.', 'CoverImgs/Book5.png', '0056789BN'),
(6, 'Normal People', 'Sally Rooney', 'Young Adult', 'Uncover the chilling secrets hidden in the shadows in this heart-pounding thriller.', 'CoverImgs/Book6.jpg', '0067890BN'),
(7, 'Boy Friends', 'Micheal Pedersen', 'Fictional Romance', 'Discover a world of magic and destiny in this enchanting fantasy tale.', 'CoverImgs/Book7.jpg', '0078901BN'),
(8, 'The Killer Poison', 'Julie Martinez', 'Suspense', 'A gripping tale of betrayal and redemption that will keep you on the edge of your seat.', 'CoverImgs/Book8.jpg', '0089012BN'),
(9, 'The Art of the Book Jacket', 'Daniel Brown', 'Action', 'Join the fight for survival in a world torn apart by war and chaos.', 'CoverImgs/Book9.jpg', '0090123BN'),
(10, 'White Nights', 'Fyodor Dostoevsky', 'Drama', 'A poignant story of love, loss, and the power of memories that refuse to fade away.', 'CoverImgs/Book10.jpg', '0101234BN'),
(11, 'Crime and Punishment', 'Fyodor Dostoevsky', 'Thriller', 'Navigate the twists and turns of the murderes russian man, in this gripping legal thriller.', 'CoverImgs/Book11.jpeg', '0112345BN'),
(12, 'The Idiot', 'Fyodor Dostoevsky', 'Romantic Fantasy', 'Journey to a realm where love knows no bounds in this enchanting romantic fantasy.', 'CoverImgs/Book12.png', '0123456BN'),
(13, 'The First Man', 'Albert Camus', 'Young Adult', 'Embark on a magical adventure through the whispering woods in this captivating YA fantasy.', 'CoverImgs/Book13.png', '0134567BN'),
(14, 'The Stranger', 'Alber Camus', 'Thriller', 'Uncover the secrets of the past in this gripping historical mystery set in ancient Rome.', 'CoverImgs/Book14.png', '0145678BN'),
(15, 'The Picture of Dorian Gray', 'Oscar Wilde', 'Adventure Romance', 'Set sail on a journey of discovery and romance beyond the horizon.', 'CoverImgs/Book15.jpg', '0156789BN'),
(16, 'The Essential', 'Oscar Wilde', 'Fantasy Adventure', 'Embark on an epic quest to save the world from darkness in this thrilling fantasy adventure.', 'CoverImgs/Book16.jpg', '0167890BN'),
(17, 'Complete Tales', 'Oscar Wilde', 'Historical Fiction', 'Relive the tumultuous events of history through the eyes of those who lived it.', 'CoverImgs/Book17.jpeg', '0178901BN'),
(18, 'The Myth of Sisyphus', 'Albert Camus', 'Thriller', 'Embrace your destiny and embark on a journey of love and magic in this enchanting romance.', 'CoverImgs/Book19.jpg', '0190123BN'),
(21, 'LightFall', 'Anthea', '', 'Added by Testing', 'CoverImgs/addbook1.jpeg', '1249741'),
(25, 'The a', 'Johnathan Haidt', 'Sci-Fi', 'Adding a book to test', 'CoverImgs/addbook2.jpeg', '12345323'),
(30, 'dawn to earth', 'Bakc', 'giee', 'long stroy', 'CoverImgs/Book3.jpeg', '276452764572365427'),
(31, 'aab b', 'qe', 'qq', 'qqdesi', 'CoverImgs/Book3.jpeg', '2323');

-- --------------------------------------------------------

--
-- Table structure for table `RecentlyAddedBookByUserID`
--

CREATE TABLE `RecentlyAddedBookByUserID` (
  `RecentlyAddedBookID` int(11) NOT NULL,
  `BookID` int(11) DEFAULT NULL,
  `AddedByUserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RecentlyAddedBookByUserID`
--

INSERT INTO `RecentlyAddedBookByUserID` (`RecentlyAddedBookID`, `BookID`, `AddedByUserID`) VALUES
(1, 21, 2),
(6, 30, 13),
(7, 31, 13);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Admin','Normal') NOT NULL DEFAULT 'Normal',
  `ProfileImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Email`, `Mobile`, `FirstName`, `LastName`, `Password`, `Role`, `ProfileImage`) VALUES
(1, 'an@gmial.com', '12345', 'test', 'testsun', '$2y$10$C4oETQ8NJHEmuYACH9hSn.1fNlcECwTI59W5GWMbH97A1pVQ/YO5q', 'Normal', 'IMG_0648.jpeg'),
(2, '', '1234', 'anthe', 'baldacchino', '$2y$10$tkFA3i8LzhXzK4HkYJiGdOt3ftVL0okLPPccEWViLfmMJDxIuOuF2', 'Normal', 'IMG_0648.jpeg'),
(3, 'test03@gmail.com', '12345', 'test2', 'test03surname', '$2y$10$1naBPnMeS.KCJVwl18UcVOCYCpCTUU07eD4IuAiM42sEASqwtQZI2', 'Normal', 'IMG_0648.jpeg'),
(4, 'anthe@gmail.com', '12', 'cwdcw', 'cwdcwc', '$2y$10$vnafj/VKsEJ3bgy3n1Ic9O3bdwlegLwe3q7DACsZWPzEUtIbfTnUa', 'Normal', 'addbook3.jpeg'),
(5, 'adminTest@gmail.com', '098', 'Anthea', 'baldacchino', '$2y$10$MgohUG07p55WPS9E7EoB2OhgaMMWyYhT6W7u3v4H9MxkzW5vDqUuu', 'Admin', 'uploads/image.png'),
(10, 'antheaffs@gmail.com', '1234', 'sascaa', 'acsaca', '$2y$10$88WrQm71adv..weyUFB0k.RabiU4Z5NegU86NkYCxbwomjpP7u7qC', 'Normal', 'image.png'),
(11, 'antheabaldacchino@gmail.com', '1234098', 'Anthea', 'Baldacchino', '$2y$10$pOJ1byWSHKl26Nm/RcCvEOM2tNfoEk5Go139tzxASyUuH4WCcF7Pe', 'Normal', 'profile2.png'),
(12, 'antheaBaldacchinoanthea@gmail.com', '123456789', 'anthea', 'baldacchino', '$2y$10$iwuRKhY.7a1k6DNEmKx.LOPe80ZsZ4Pu4DLQO9aTvpMVjbo.D6SPG', 'Admin', 'image.png'),
(13, 'test1@gmai.com', '123123', 'test2', 'ltest1', '$2y$10$BxJBYj2/VTaVCi0QrVOvmO8qjxGwRbxDEmICQB/7z/CIj0DHA73w6', 'Normal', 'uploads/image.png'),
(14, 'antheabalda@gmail.com', '1234512345', 'Anthea', 'Baldacchino', '$2y$10$DC/jWEJiBTNTV90v.dIbFOYfT5wkDTISoeetgnCPy.BjnO3/zr4uC', 'Admin', 'profile2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `RecentlyAddedBookByUserID`
--
ALTER TABLE `RecentlyAddedBookByUserID`
  ADD PRIMARY KEY (`RecentlyAddedBookID`),
  ADD KEY `BookID` (`BookID`),
  ADD KEY `AddedByUserID` (`AddedByUserID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Books`
--
ALTER TABLE `Books`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `RecentlyAddedBookByUserID`
--
ALTER TABLE `RecentlyAddedBookByUserID`
  MODIFY `RecentlyAddedBookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `RecentlyAddedBookByUserID`
--
ALTER TABLE `RecentlyAddedBookByUserID`
  ADD CONSTRAINT `recentlyaddedbookbyuserid_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `Books` (`BookID`),
  ADD CONSTRAINT `recentlyaddedbookbyuserid_ibfk_2` FOREIGN KEY (`AddedByUserID`) REFERENCES `Users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
