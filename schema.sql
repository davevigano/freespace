-- freespace database schema
-- Reconstructed from the queries in functions.php and index.php

CREATE DATABASE IF NOT EXISTS freespace CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE freespace;

CREATE TABLE IF NOT EXISTS post (
    post_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    post_title VARCHAR(250) NOT NULL,
    post_content TEXT NULL,
    post_author VARCHAR(20) NOT NULL,
    post_tags VARCHAR(50) NULL,
    post_creation_time DATETIME NOT NULL,
    post_likes INT NOT NULL DEFAULT 0,
    post_dislikes INT NOT NULL DEFAULT 0,
    PRIMARY KEY (post_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS comment (
    comment_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    comment_content TEXT NOT NULL,
    comment_author VARCHAR(20) NOT NULL,
    comment_creation_time DATETIME NOT NULL,
    post_code INT UNSIGNED NOT NULL,
    PRIMARY KEY (comment_id),
    KEY idx_post_code (post_code),
    CONSTRAINT fk_comment_post FOREIGN KEY (post_code) REFERENCES post(post_id) ON DELETE CASCADE
) ENGINE=InnoDB;
