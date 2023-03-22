SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Table structure for table 'users'

CREATE TABLE `users`(
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `firstName` varchar(255) NOT NULL,
    `lastName` varchar(255) NOT NULL,
    `email` varchar(255)NOT NULL,
    `registration_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `profile_img` VARCHAR(255) DEFAULT NULL,
    `thumbnail_img` VARCHAR(255) DEFAULT NULL,
    `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);

CREATE TABLE `posts`(
    `post_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `type` ENUM('resort', 'backcountry') NOT NULL,
    `post_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `likes` INT DEFAULT 0,
    `post_img` VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY(username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `comments`(
    `comment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` INT NOT NULL,
    `post_id` INT NOT NULL,
    `content` TEXT NOT NULL,
    `comment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `likes` INT DEFAULT 0,
    FOREIGN KEY(username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE ON UPDATE CASCADE

);
-- insert admin users
INSERT INTO users (username, password, firstName, lastName, email, role) VALUES('alrick', 'alrick', 'alrick', 'vincent', 'alrick.vincent@gmail.com', 'admin');
INSERT INTO users (username, password, firstName, lastName, email, role) VALUES('will', 'will', 'will', 'garbutt', 'will.dkg@gmail.com', 'admin');
-- inser test user
INSERT INTO users(username, password, firstName, lastName, email, role) VALUES('test', 'test', 'test', 'test', 'will.dkg@gmail.com', 'user');
-- insert test post
INSERT INTO posts(username, title, content, type) VALUES ('test', 'test post', 'This is a test post to try functionalities and display', 'backcountry');