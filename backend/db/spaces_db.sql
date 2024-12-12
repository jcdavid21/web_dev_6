-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2024 at 06:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spaces_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `acc_id` int(11) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_username` varchar(255) NOT NULL,
  `acc_password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`acc_id`, `acc_email`, `acc_username`, `acc_password`, `role_id`) VALUES
(2, 'jcdavid@gmail.com', 'jcdavid', '$2y$10$5d5FRnZ0.1lt8Sjtm6eqkeacLXHqU1eTV0TLaGd1CekLu9W6BjSHG', 1),
(3, 'chesca@gmail.com', 'Chesca', '$2y$10$VQP6fzmGhwa/YZz78lPVGeK0gFbMccfSmoAtp4PowDThTuyd9vdx.', 1),
(4, 'krizzy@gmail.com', 'krizzy', '$2y$10$TxsbmjT8CbvabkQoaRWQTOomEp9rCzI1jEWqRoWABxechE9H6VfgW', 1),
(5, 'golden@gmail.com', 'golden', '$2y$10$G3l8qyo4gPLHyekWVo6jG.FA4fBZmvaNGr7sDB5aWGuGLZh1N06Ze', 1),
(6, 'ayumi@gmail.com', 'ayumi', '$2y$10$Ixyfyx.63kC0sdoswvw8seaaNOI7KVWJwZKaCPoB.pe.ZOQtdhfT2', 1),
(7, 'rainierkahayon@gmail.com', 'rainiercatingco', '$2y$10$Y7y2du/0zPt7Ewda.CamKuwMxc4D.DmlZgdUIl2rgltsjfNg7Q5yi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_details`
--

CREATE TABLE `tbl_account_details` (
  `acc_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `job` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_details`
--

INSERT INTO `tbl_account_details` (`acc_id`, `full_name`, `birthdate`, `gender`, `job`, `profile_img`) VALUES
(2, 'Jc Davd', '2002-04-21', 'Male', 'Software Engineer', '../../imgs/profile/67598f069c5fe_1733922566.jpg'),
(3, 'Chesca Rosales', '2005-08-28', 'Female', 'Information Architect', '../../imgs/profile/6731efa29ee02_1731325858.jpg'),
(4, 'Krizzy', '2003-04-22', 'Female', NULL, NULL),
(5, 'Golden Miral', '2001-05-22', 'Male', NULL, NULL),
(6, 'ayumi', '2004-05-23', 'Female', NULL, NULL),
(7, 'Rainier Kahayon', '2004-03-12', 'male', 'Full-stack Developer', '../../imgs/profile/675a8699c9204_1733985945.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `comment_id` int(11) NOT NULL,
  `posted_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_date` date DEFAULT current_timestamp(),
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`comment_id`, `posted_id`, `comment`, `comment_date`, `acc_id`) VALUES
(23, 3, 'g gagi', '2024-12-06', 3),
(24, 1, 'sadasd', '2024-12-07', 3),
(25, 1, 'asdasd', '2024-12-07', 3),
(30, 3, 'ok', '2024-12-12', 7),
(35, 3, 'hahahah', '2024-12-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credentials`
--

CREATE TABLE `tbl_credentials` (
  `acc_id` int(11) NOT NULL,
  `credential_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_credentials`
--

INSERT INTO `tbl_credentials` (`acc_id`, `credential_title`) VALUES
(2, 'JPCS President'),
(3, 'Back-end Developer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_followed`
--

CREATE TABLE `tbl_followed` (
  `acc_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_followed`
--

INSERT INTO `tbl_followed` (`acc_id`, `followed_id`) VALUES
(7, 3),
(2, 3),
(2, 7),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_likes`
--

CREATE TABLE `tbl_likes` (
  `posted_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_likes`
--

INSERT INTO `tbl_likes` (`posted_id`, `acc_id`) VALUES
(1, 3),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notif_id` int(11) NOT NULL,
  `notif_activity` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `notif_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`notif_id`, `notif_activity`, `user_id`, `acc_id`, `notif_date`) VALUES
(7, 'followed you', 3, 2, '2024-12-13'),
(8, 'Commented on your post', 2, 3, '2024-12-13'),
(9, 'joined your space', 3, 2, '2024-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_status`
--

CREATE TABLE `tbl_post_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_post_status`
--

INSERT INTO `tbl_post_status` (`status_id`, `status_name`) VALUES
(1, 'Posted'),
(2, 'Draft');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_privacy`
--

CREATE TABLE `tbl_privacy` (
  `privacy_id` int(11) NOT NULL,
  `privacy_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_privacy`
--

INSERT INTO `tbl_privacy` (`privacy_id`, `privacy_name`) VALUES
(1, 'Public'),
(2, 'Private'),
(3, 'Only Me');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `review_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `review_message` varchar(255) NOT NULL,
  `review_date` date NOT NULL,
  `review_star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`review_id`, `acc_id`, `review_message`, `review_date`, `review_star`) VALUES
(1, 3, 'Magandaaa', '2024-12-10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spaces`
--

CREATE TABLE `tbl_spaces` (
  `space_id` int(11) NOT NULL,
  `space_name` varchar(255) NOT NULL,
  `space_img` varchar(255) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_spaces`
--

INSERT INTO `tbl_spaces` (`space_id`, `space_name`, `space_img`, `acc_id`) VALUES
(1, 'Technology', '../imgs/spaces/reddit-logo.png', 2),
(2, 'Gaming', '../../imgs/spaces/space_675b02ae14de66.43455991.png', 2),
(3, 'Health and Wellness', '../imgs/spaces/reddit-logo.png', 2),
(4, 'History and Archeology', '../imgs/spaces/reddit-logo.png', 3),
(5, 'Culture', '../../imgs/spaces/space_675b05f9aaeb90.73026306.png', 3),
(6, 'Science and Nature', '../imgs/spaces/reddit-logo.png', 3),
(7, 'Home Improvement', '../imgs/spaces/reddit-logo.png', 4),
(8, 'Food and Cooking', '../imgs/spaces/reddit-logo.png', 4),
(9, 'Parenting and Family', '../imgs/spaces/reddit-logo.png', 4),
(10, 'Crafts and Art', '../imgs/spaces/reddit-logo.png', 5),
(11, 'Music and Performing Arts', '../imgs/spaces/reddit-logo.png', 5),
(12, 'Education and Career', '../imgs/spaces/reddit-logo.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spaces_joined`
--

CREATE TABLE `tbl_spaces_joined` (
  `space_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_spaces_joined`
--

INSERT INTO `tbl_spaces_joined` (`space_id`, `acc_id`) VALUES
(4, 2),
(5, 2),
(6, 2),
(1, 3),
(3, 3),
(10, 4),
(11, 4),
(12, 4),
(7, 5),
(8, 5),
(9, 5),
(1, 7),
(2, 7),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spaces_post`
--

CREATE TABLE `tbl_spaces_post` (
  `posted_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `posted_date` date NOT NULL,
  `posted_caption` varchar(255) NOT NULL,
  `posted_likes` int(11) DEFAULT 0,
  `posted_share` int(11) DEFAULT 0,
  `posted_img` varchar(255) NOT NULL,
  `posted_privacy` int(11) DEFAULT 1,
  `post_status` int(11) NOT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `space_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_spaces_post`
--

INSERT INTO `tbl_spaces_post` (`posted_id`, `post_title`, `posted_date`, `posted_caption`, `posted_likes`, `posted_share`, `posted_img`, `posted_privacy`, `post_status`, `post_tags`, `space_id`, `acc_id`) VALUES
(1, 'Technology', '2024-10-10', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum consequatur neque ea, laudantium deserunt veritatis sequi mollitia ipsum exercitationem id dolore omnis atque blanditiis quaerat sunt aperiam a voluptatum iure.', 1, 0, '../imgs/post images/post-1.avif', 1, 1, '#Tech#Coding', 1, 2),
(2, 'Programming', '2024-11-06', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum consequatur neque ea, laudantium deserunt veritatis sequi mollitia ipsum exercitationem id dolore omnis atque blanditiis quaerat sunt aperiam a voluptatum iure.', 0, 0, '../imgs/post images/post-2.avif', 1, 1, '#Fyp', 1, 2),
(3, 'Play', '2024-11-06', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum consequatur neque ea, laudantium deserunt veritatis sequi mollitia ipsum exercitationem id dolore omnis atque blanditiis quaerat sunt aperiam a voluptatum iure.', 1, 0, '../imgs/post images/post-3.avif', 1, 1, '#Gaming', 3, 3),
(4, 'Health', '2024-11-06', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum consequatur neque ea, laudantium deserunt veritatis sequi mollitia ipsum exercitationem id dolore omnis atque blanditiis quaerat sunt aperiam a voluptatum iure.', 0, 0, '../imgs/post images/post-4.avif', 2, 1, '#technology', 2, 3),
(8, 'Food', '2024-11-11', 'asdsadas', 0, 0, '../../imgs/post images/Screenshot 2024-11-10 at 7.56.14 PM.png', 1, 2, '#Food,#Health', 3, 2),
(9, 'Technology', '2024-11-11', 'Lorem', 0, 0, '../../imgs/post images/reddit-logo-2436.png', 3, 1, '#tech', 1, 3),
(10, 'Gaming', '2024-11-11', 'ahddhdhdahkdah', 0, 0, '../../imgs/post images/reddit-logo-2436.png', 1, 2, '#fun', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE `tbl_subscription` (
  `subs_id` int(11) NOT NULL,
  `subs_type` int(11) NOT NULL,
  `subs_start_month` date NOT NULL,
  `subs_end_month` date NOT NULL,
  `subs_receipt_img` varchar(255) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subscription`
--

INSERT INTO `tbl_subscription` (`subs_id`, `subs_type`, `subs_start_month`, `subs_end_month`, `subs_receipt_img`, `acc_id`) VALUES
(3, 2, '2024-12-12', '2025-12-12', '../../imgs/receipts/receipt.jpeg', 3),
(4, 2, '2024-12-12', '2025-12-12', '../../imgs/receipts/receipt.jpeg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriptions_type`
--

CREATE TABLE `tbl_subscriptions_type` (
  `subs_type` int(11) NOT NULL,
  `subs_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subscriptions_type`
--

INSERT INTO `tbl_subscriptions_type` (`subs_type`, `subs_name`) VALUES
(1, 'Monthly'),
(2, 'Yearly');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `tbl_post_status`
--
ALTER TABLE `tbl_post_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_privacy`
--
ALTER TABLE `tbl_privacy`
  ADD PRIMARY KEY (`privacy_id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_spaces`
--
ALTER TABLE `tbl_spaces`
  ADD PRIMARY KEY (`space_id`);

--
-- Indexes for table `tbl_spaces_post`
--
ALTER TABLE `tbl_spaces_post`
  ADD PRIMARY KEY (`posted_id`);

--
-- Indexes for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  ADD PRIMARY KEY (`subs_id`);

--
-- Indexes for table `tbl_subscriptions_type`
--
ALTER TABLE `tbl_subscriptions_type`
  ADD PRIMARY KEY (`subs_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_post_status`
--
ALTER TABLE `tbl_post_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_privacy`
--
ALTER TABLE `tbl_privacy`
  MODIFY `privacy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_spaces`
--
ALTER TABLE `tbl_spaces`
  MODIFY `space_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_spaces_post`
--
ALTER TABLE `tbl_spaces_post`
  MODIFY `posted_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `subs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_subscriptions_type`
--
ALTER TABLE `tbl_subscriptions_type`
  MODIFY `subs_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
