-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2016 at 01:19 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uber`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `description`, `name`, `date`, `location`, `latitude`, `longitude`) VALUES
(1, 'Some event description 1', 'Some event name 1', '21-6-2016 at 14:00', 'firstEventImage.jpg', '55.6669809', '12.5783811'),
(2, 'Some event description 2', 'Some event name 2', '25-5-2016 at 13:00', 'SecondEventImage.jpg', '55.6669809', '12.5783811'),
(3, 'Some event description 1', 'Some event name 1', '26-6-2016 at 19:00', 'ThirdEventImage.jpg', '55.6669809', '12.5783811'),
(4, 'ACDC Concert at Forum', 'Forum Concert', '15-5-2016 at 14:45', 'ajlfjasldjalsd', '55.682046', '12.552844'),
(5, 'asd', 'sfsdf', 'sdf', 'SK', '52.254296682031296', '-106.97013018471148'),
(6, 'ashkjhkj', 'asdjhasd', 'sfhgggggggg', 'AB', '54.76228197050857', '-116.11075518471148'),
(7, 'TE DESCRIPTIObn', 'TE NAME', '23-4-2012', 'AB', '55.46601771706194', '-117.86856768471148'),
(8, 'asdhj', 'ashjd', 'asj', 'BC', '59.87757401825261', '-120.32950518471148'),
(9, 'adshj', 'asdh', 'asd', 'SK', '57.503658488905145', '-109.43106768471148'),
(10, 'adshj', 'asdh', 'asd', 'SK', '57.503658488905145', '-109.43106768471148');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE IF NOT EXISTS `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `event_id` int(11) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `name`, `description`, `date`, `location`, `event_id`, `latitude`, `longitude`) VALUES
(1, 'test meeting 2', 'test description 2', '', 'http://maps.googleapis.com/maps/api/staticmap?center=40.7248,-73.99597&zoom=17&format=png&sensor=false&size=280x280&maptype=roadmap&style=element:geometry.fill|color:0xf4f4f4&markers=color:red|40.7248,-73.99597&scale=2', 0, '0', '0'),
(2, 'asdhasd', 'ashdauhd', '', 'http://maps.googleapis.com/maps/api/staticmap?center=40.7248,-73.99597&zoom=17&format=png&sensor=false&size=280x280&maptype=roadmap&style=element:geometry.fill|color:0xf4f4f4&markers=color:red|40.7248,-73.99597&scale=2', 0, '0', '0'),
(3, 'test meeting with l l', 'test meeting with l l', 'test meeting with l l', 'test meeting with l l', 0, '0', '0'),
(4, 'asdbm', 'hashdghjg', 'hjasdhjg', 'ghjasghdghj', 0, 'asdgjgh', 'adshgj'),
(5, 'asd2', 'asd2', 'asd2', 'asd2', 9, 'asd2', 'asd2'),
(6, 'asd22', '222', '222', '2', 9, '2', '22'),
(7, 'Distortion', 'Distortion Event', '25-5-2016 at 14:00', 'Region Syddanmark', 0, '55.19102813103137', '10.363858190288624'),
(8, 'Test', 'Test', 'Test', 'Sakha Republic', 0, '60.83387615514753', '132.09236981528852');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `photourl` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `photourl`) VALUES
(1, 'someone', 'someone@someone.com', 'https://lh3.googleusercontent.com/-EF9BoynKc9w/AAAAAAAAAAI/AAAAAAAAAAA/1au5roMkCC4/photo.jpg'),
(2, 'someone two', 'someonetwo@someone.com', 'https://lh3.googleusercontent.com/-EF9BoynKc9w/AAAAAAAAAAI/AAAAAAAAAAA/1au5roMkCC4/photo.jpg'),
(3, 'someone Three', '', 'https://mir-s3-cdn-cf.behance.net/project_modules/disp/f24d9e10316483.560e2d8d6608f.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_events`
--

CREATE TABLE IF NOT EXISTS `user_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
