CREATE TABLE `user` (
  `user_id` int PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255) UNIQUE  NOT NULL,
  `password` varchar(255)  NOT NULL,
  `username` varchar(255) UNIQUE NOT NULL,
  `fullname` varchar(255)  NOT NULL,
  `phone` varchar(10) UNIQUE NOT NULL,
  `address` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `created_at` DATETIME DEFAULT (now()),
  `is_active` boolean DEFAULT true
);
