SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Table structure for table 'users'

CREATE TABLE `users`(
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `firstname` varchar(255) NOT NULL,
    `lastName` varchar(255) NOT NULL,
    `email` varchar(255)NOT NULL,
    `registration_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `profile_img` VARCHAR(255) DEFAULT NULL,
    `thumbnail_img` VARCHAR(255) DEFAULT NULL
);

CREATE TABLE `posts`(
    `post_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `topic` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `post_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `likes` INT DEFAULT 0,
    `post_img` VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `comments`(
    `comment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `content` TEXT NOT NULL,
    `comment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `likes` INT DEFAULT 0,
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE ON UPDATE CASCADE

);