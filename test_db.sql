CREATE DATABASE test;

USE test;

CREATE TABLE posts (
    userId INT(10) NOT NULL,
    id INT(10) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    body TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE comments (
    postId INT(10) NOT NULL,
    id INT(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    body TEXT,
    PRIMARY KEY (id)
)