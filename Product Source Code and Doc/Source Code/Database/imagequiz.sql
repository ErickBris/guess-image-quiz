-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2015 at 07:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imagequiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `ique_bank`
--

CREATE TABLE IF NOT EXISTS `ique_bank` (
  `Que_ID` int(11) NOT NULL AUTO_INCREMENT,
  `queimage` text NOT NULL,
  `Question` text NOT NULL,
  `quiz_level` int(11) NOT NULL,
  `OptionA` text NOT NULL,
  `OptionB` text NOT NULL,
  `OptionC` text NOT NULL,
  `OptionD` text NOT NULL,
  `RightAns` text NOT NULL,
  PRIMARY KEY (`Que_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ique_bank`
--

INSERT INTO `ique_bank` (`Que_ID`, `queimage`, `Question`, `quiz_level`, `OptionA`, `OptionB`, `OptionC`, `OptionD`, `RightAns`) VALUES
(1, 'eiffel tower (1).png', 'who is this architect?', 1, 'stephen sauvestre', 'Shah Jahan ', 'Qin Shi Huang', 'Fidiyas', 'A'),
(2, 'logos-quiz-sm-0049.jpg', 'This symbol stands for? ', 1, 'Ferrari', 'Lamborghini', 'Volvo', 'Lexus', 'A'),
(3, 'logos-quiz-sm-0051.jpg', 'Words MOTOR and COMPANY in orange with a rectangular name patch in the middle?', 1, 'Harley Davidson', 'Aston Martin', 'Porsche', 'Nissan', 'A'),
(4, 'logos-quiz-sm-0053.jpg', '''Letter P in red standing on a multi-colored letter S'' picture use for? ', 1, 'PlayStation', 'PolyGon', 'Sega', 'Atari', 'A'),
(5, 'logos-quiz-sm-0076.jpg', 'Impression of a mother holding a child on a globe represents?', 1, 'Unicef', 'WHO', 'WFP', 'ICRC', 'A'),
(6, 'logos-quiz-sm-0001.jpg', 'blue colored bird logo stands for?', 1, 'Facebook', 'Twitter', 'Orkut', 'hi5', 'B'),
(7, 'logos-quiz-0002.jpg', 'Letter a with an orange arrow\r\nimage stands for', 1, 'amazon', 'snapdeal', 'flipkart', 'myntra', 'A'),
(8, 'logos-quiz-sm-0003.jpg', 'This logo represents?', 1, 'Dell', 'Intel', 'HP', 'LG', 'B'),
(9, 'logos-quiz-sm-0004.jpg', 'Which automobile company''s symbol is this?', 1, 'Audi', 'Volkswagen', 'BMW', 'Mercedes', 'C'),
(10, 'logos-quiz-sm-0005.jpg', 'This logo for?', 1, 'Nestle', 'Espresso', 'Starbucks', 'McCafe', 'C'),
(11, 'logos-quiz-sm-0006.jpg', 'This logo represents?', 1, 'McDonalds', 'Dominos', 'Burger King', 'Subway', 'A'),
(12, 'logos-quiz-sm-0007.jpg', 'For which brand ''A man with a mustache and red tie'' use? ', 1, 'Pringles', 'Lays', 'Walker', 'Kurkure', 'A'),
(13, 'logos-quiz-sm-0008.jpg', 'This logo represents?', 1, 'Kelloggs', 'Kraft', 'ConAgra', 'General Mills', 'A'),
(14, 'logos-quiz-sm-0012.jpg', 'For which brand use this image?', 1, 'Reebok', 'Puma', 'Skechers', 'Adidas', 'A'),
(15, 'logos-quiz-sm-0029.jpg', 'This logo represents which company?', 1, 'Polo', 'Hollister', 'Lacoste', 'Levis', 'D'),
(16, 'logos-quiz-sm-0028.jpg', 'Image stands for?', 1, 'Canon', 'Cocacola', 'Costco', 'Casio', 'A'),
(17, 'logos-quiz-sm-0033.jpg', 'This logo represents_company?', 1, 'Peugeot', 'Citroen', 'Opel', 'Lexus', 'B'),
(18, 'logos-quiz-sm-0034.jpg', 'This image use for?', 1, 'Dell', 'IBM', 'Siemens', 'HP', 'D'),
(19, 'logos-quiz-sm-0037.jpg', 'Brown and gold shield logo used for?', 1, 'United Parcel Service', 'Royal Mail', 'DHL', 'FedEx Exress', 'A'),
(20, 'logos-quiz-sm-0045.jpg', 'Peacock with multi-colored feathers represents?', 1, 'NBC', 'CNN', 'ABC', 'MBC', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `ique_level`
--

CREATE TABLE IF NOT EXISTS `ique_level` (
  `Level_id` int(11) NOT NULL AUTO_INCREMENT,
  `Level_name` varchar(500) NOT NULL,
  PRIMARY KEY (`Level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ique_level`
--

INSERT INTO `ique_level` (`Level_id`, `Level_name`) VALUES
(1, 'General Knowledge');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
  `userID` int(5) NOT NULL AUTO_INCREMENT,
  `userName` text NOT NULL,
  `Email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`userID`, `userName`, `Email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
