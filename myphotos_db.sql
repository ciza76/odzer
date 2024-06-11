
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create database mvc_db;
use mvc_db;

--
-- Database: `stao04`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(1024) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `date_created`, `date_updated`) VALUES
(2, 9, 1, 'This is my second comment add some more text', NULL, '2023-05-26 12:34:51'),
(3, 9, 1, 'This is my third comment also', '2023-05-26 11:19:12', '2023-05-26 12:34:59'),
(4, 9, 2, 'a new comment by mary', '2023-05-26 11:20:33', NULL),
(5, 8, 2, 'my first comment here', '2023-05-26 11:34:51', NULL),
(6, 7, 1, 'testing a comment here', '2023-05-26 12:35:53', NULL),
(7, 9, 2, 'i can add a comment', '2023-05-26 12:37:51', '2023-05-26 12:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `post_id` int(11) DEFAULT 0,
  `disabled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `disabled`) VALUES
(1, 1, 9, 0),
(2, 1, 2, 0),
(3, 2, 4, 0),
(4, 2, 10, 0),
(5, 2, 9, 0),
(6, 2, 8, 1),
(7, 2, 7, 1),
(8, 2, 5, 0),
(9, 1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `image` varchar(1024) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `image1` varchar(1024) DEFAULT NULL,
  `image2` varchar(1024) DEFAULT NULL,
  `image3` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `user_id`, `image`, `date_created`, `date_updated`, `image1`, `image2`, `image3`) VALUES
(1, 'image title', 1, 'uploads/168476.jpg', '2024-06-08 16:07:26', NULL, NULL, NULL, NULL),
(2, 'Random pictures 2', 1, 'uploads/1684769271791a047636136702e25ba1096b11cfe7.jpg', '2024-06-08 17:27:51', NULL, NULL, NULL, NULL),
(3, 'Photo set 1', 1, 'uploads/16847692891c59efd01451b880.jpg', '2024-06-08 17:28:09', NULL, NULL, NULL, NULL),
(4, 'Photo set 2', 1, 'uploads/1684769380alicia-keys.jpg', '2024-06-08 17:29:40', NULL, NULL, NULL, NULL),
(5, 'My aunt2', 2, 'uploads/1684774660excited-smiling-curly-haired-girl-showing-credit-card-paying-online-order-using-smartphone_176420-20206.jpg', '2024-06-08 17:58:26', '2023-05-22 18:57:40', NULL, NULL, NULL),
(7, 'My sister', 1, 'uploads/1684776744young-beautiful-woman-with-curly-hair-isolated_273609-48109.png', '2024-06-08 19:32:24', NULL, NULL, NULL, NULL),
(8, 'Surprise! surprise', 2, 'uploads/1684777275photo-stupefied-dark-haired-girl-with-bated-breath-stares-with-bugged-eyes-being-shocked-by-high-prices_273609-17559.jpg', '2024-06-08 19:41:15', '2023-05-22 19:41:31', NULL, NULL, NULL),
(9, 'Some photo', 2, 'uploads/1684785097curly-man-with-broad-smile-shows-perfect-teeth-being-amused-by-interesting-talk-has-bushy-curly-dark-hair-stands-indoor-against-white-blank-wall_273609-17092.jpg', '2024-06-08 21:51:37', NULL, NULL, NULL, NULL),
(10, 'Worker', 2, 'uploads/1684785228builder-young-man-construction-uniform-safety-helmet-holding-wrench-pliers-looking-confused-with-hand-his-head-mistake-standing-blue-background_141793-140410.png', '2024-06-08 21:53:48', NULL, NULL, NULL, NULL),
(11, 'Random pictures', 1, 'uploads/1685399861confident-young-handsome-man-looking-camera-doing-stop-gesture-isolated-white-background_141793-131989.png', '2024-06-08 00:37:41', NULL, '', '', ''),
(12, 'Album 2', 1, '', '2023-05-30 00:43:27', NULL, 'uploads/1685400207confident-young-handsome-man-looking-camera-doing-stop-gesture-isolated-white-background_141793-131989.png', '', ''),
(13, 'Another post with multiple images', 1, 'uploads/1685400624close-up-shot-pretty-woman-with-perfect-teeth-dark-clean-skin-having-rest-indoors-smiling-happily-after-received-good-positive-news_273609-1248.jpg', '2024-06-08 00:50:24', NULL, 'uploads/1685400625confident-attractive-caucasian-guy-beige-pullon-smiling-broadly-while-standing-against-gray_176420-44508.jpg', 'uploads/1685400625confident-young-handsome-man-looking-camera-doing-stop-gesture-isolated-white-background_141793-131989.png', 'uploads/1685400625curly-man-with-broad-smile-shows-perfect-teeth-being-amused-by-interesting-talk-has-bushy-curly-dark-hair-stands-indoor-against-white-blank-wall_273609-17092.jpg'),
(14, 'Multiple images', 1, 'uploads/1685400842portrait-shocked-startled-adult-man-stares-bugged-eyes-camera-hears-big-news-dressed-casual-jumper-isolated-white-background-concerned-young-guy-feels-very-surprised-poses-indoor_273609-56819.jpg', '2024-06-08 00:54:02', NULL, 'uploads/1685400842positive-male-with-beard-mustache-blinks-with-eyes-smiles-grins-has-good-mood-after-noisy-party-with-friends_273609-8657.jpg', '', ''),
(15, 'Post 1', 1, 'uploads/1685401006young-beautiful-woman-with-curly-hair-isolated_273609-48109.png', '2023-05-30 00:56:46', NULL, 'uploads/1685401006young-woman-with-round-glasses-yellow-sweater_273609-7091.jpg', '', ''),
(16, 'Post 2', 1, 'uploads/1685401022curly-man-with-broad-smile-shows-perfect-teeth-being-amused-by-interesting-talk-has-bushy-curly-dark-hair-stands-indoor-against-white-blank-wall_273609-17092.jpg', '2024-06-08 00:57:02', NULL, 'uploads/1685401022excited-smiling-curly-haired-girl-showing-credit-card-paying-online-order-using-smartphone_176420-20206.jpg', 'uploads/1685401022funny-curious-man-makes-grimace-purses-lips-looks-doubtfully_273609-16678.jpg', ''),
(17, 'Post 3', 1, 'uploads/1685401038waist-up-portrait-handsome-serious-unshaven-male-keeps-hands-together-dressed-dark-blue-shirt-has-talk-with-interlocutor-stands-against-white-wall-self-confident-man-freelancer_273609-16320.jpg', '2024-06-08 00:57:18', NULL, 'uploads/1685401038young-bearded-man-with-striped-shirt_273609-5677.jpg', 'uploads/1685401038young-beautiful-woman-with-curly-hair-isolated_273609-48109.png', 'uploads/1685401039young-woman-with-round-glasses-yellow-sweater_273609-7091.jpg'),
(18, 'Post 4', 1, 'uploads/1685401081builder-young-man-construction-uniform-safety-helmet-holding-wrench-pliers-looking-confused-with-hand-his-head-mistake-standing-blue-background_141793-140410.png', '2024-06-08 00:58:01', NULL, 'uploads/1685401082candid-shot-serious-european-lady-makes-shush-gesture-keesp-index-finger-lips_273609-44692.jpg', 'uploads/1685401082cheerful-woman-looking-camera_23-2147774837.png', 'uploads/1685401082close-up-portrait-attractive-man-with-afro-hairstyle-stubble-wears-orange-anorak_273609-8595.jpg'),
(19, 'Images', 1, 'uploads/1685401177indoor-shot-positive-good-looking-caucasian-blond-man-with-beard-moustache-smirking_176420-17146.jpg', '2024-06-08 00:59:37', NULL, 'uploads/1685401177indoor-shot-worried-impatient-european-male-shirt_176420-24212.jpg', 'uploads/1685401177joyous-friendly-looking-smiling-girl-points-aside-with-happy-expression-toothy-smile-pleased-show-awesome-advertisement_273609-33977.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `date_created`, `date_updated`) VALUES
(1, 'Admin', 'email@email.com', 'admin', '$2y$10$OhLAxIKjtP/jSf/tUQwtTe/nWDDvB5qKzPZw5czXSJHFKfx0rtuCW', '2024-06-08 14:47:45', '2024-06-08 14:47:45'),
(2, 'Mary', 'mary@email.com', 'user', '$2y$10$41e7YyzQ6A5LrLKCOR3lEeXM9WJCNNE88qUr8CLiAFMak4YjZ18S2', '2024-06-08 15:04:01', '2024-06-08 14:47:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

use mvc_db;