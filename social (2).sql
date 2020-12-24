-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2020 at 11:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followers_id2` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`, `followers_id2`, `status`) VALUES
(33, 10, 11, 11, 1),
(35, 10, 15, 15, 1),
(39, 15, 10, 10, 1),
(42, 10, 20, 20, 1),
(43, 15, 20, 20, 1),
(44, 20, 10, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `Id` int(11) NOT NULL,
  `likers_id` int(11) NOT NULL,
  `user_id` int(200) NOT NULL,
  `likes` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`Id`, `likers_id`, `user_id`, `likes`) VALUES
(26, 11, 10, 1),
(30, 11, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `posted_by` varchar(180) NOT NULL,
  `profile` text NOT NULL,
  `posted_on` datetime NOT NULL,
  `post_name` varchar(250) NOT NULL,
  `post_path` text NOT NULL,
  `post_caption` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes` int(220) NOT NULL,
  `reports` int(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `posted_by`, `profile`, `posted_on`, `post_name`, `post_path`, `post_caption`, `user_id`, `likes`, `reports`) VALUES
(17, 'sukhvinder_kaur', 'profiles/sukhvinder_kaur.jpeg', '2020-08-26 17:51:08', 'call-of-duty-black-ops-4.jpg', 'users_data/sukhvinder_kaur/', '', 15, 1, 1),
(26, 'tajinder_singh', '', '2020-08-29 20:04:27', 'dmc.jpg', 'users_data/tajinder_singh/', '', 10, 3, 0),
(30, 'tajinder_singh', 'profiles/tajinder_singh.jpeg', '2020-12-16 12:10:30', 'joker-movie-2019-poster-0n.jpg', 'users_data/tajinder_singh/', 'This is the Joker', 10, 1, 0),
(33, 'sukhvinder_kaur', 'profiles/sukhvinder_kaur.jpeg', '2020-12-23 00:37:38', 'joker-movie-2019-poster-0n.jpg', 'users_data/sukhvinder_kaur/', '', 15, 0, 2),
(34, 'tajinder_singh', 'profiles/tajinder_singh.jpeg', '2020-12-24 13:53:18', 'erik-mclean-ZRns2R5azu0-unsplash.jpg', 'users_data/tajinder_singh/', 'DownTown', 10, 0, 0),
(35, 'salman_khan', '', '2020-12-24 14:01:33', 'Salman_Khan.jpg', 'users_data/salman_khan/', '', 20, 0, 0),
(36, 'salman_khan', '', '2020-12-24 14:01:41', 'salman_khan (1).jpg', 'users_data/salman_khan/', '', 20, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `pic_id` int(11) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `First_name` varchar(25) NOT NULL,
  `Last_name` varchar(25) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) NOT NULL,
  `profile_name` varchar(50) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `First_name`, `Last_name`, `Username`, `Email`, `Password`, `signup_date`, `profile_pic`, `profile_name`, `num_posts`, `status`) VALUES
(9, 'Chotu', 'Golu', 'chotu_golu', 'cute@gmail.com', 'cute123', '2020-08-12', 'Assets/Images/profile_pics/defaults/head_pete_river.png', '', 0, 0),
(10, 'Tajinder', 'Singh', 'tajinder_singh', 'tejinder@gmail.com', 'teji123', '2020-08-14', 'profiles/tajinder_singh.jpeg', 'tajinder_singh.jpeg', 3, 0),
(11, 'Akshay', 'Kumar', 'akshay', 'akshay@gmail.com', 'akshay123', '2020-08-19', 'profiles/akshay_kumar.jpeg', 'akshay_kumar.jpeg', 1, 0),
(12, 'Vardaan', 'Kapania', 'vardaan_kapania', 'vardaan@gmail.com', 'vardaan123', '2020-08-21', '', '', 0, 0),
(15, 'Sukhvinder', 'Kaur', 'katrina', 'sukhvinder@gmail.com', 'sonu123', '2020-08-21', 'profiles/katrina.jpeg', 'katrina.jpeg', 2, 0),
(19, 'Admin', 'Master', 'admin_master', 'admin@gmail.com', 'admin123', '2020-12-20', '', '', 0, 1),
(20, 'Salman', 'Khan', 'salman_khan', 'salman@gmail.com', 'salman123', '2020-12-24', 'profiles/salman_khan.jpeg', 'salman_khan.jpeg', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `follow` (`followers_id2`),
  ADD KEY `user_fetch` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `Post_id` (`Id`),
  ADD KEY `Post_of` (`user_id`),
  ADD KEY `liker_id` (`likers_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pics_id` (`pic_id`),
  ADD KEY `user_id` (`us_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `follow` FOREIGN KEY (`followers_id2`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `user_fetch` FOREIGN KEY (`user_id`) REFERENCES `posts` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `Post_id` FOREIGN KEY (`Id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Post_of` FOREIGN KEY (`user_id`) REFERENCES `posts` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `liker_id` FOREIGN KEY (`likers_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `pics_id` FOREIGN KEY (`pic_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`us_id`) REFERENCES `posts` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
