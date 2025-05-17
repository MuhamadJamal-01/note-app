-- init.sql

CREATE DATABASE my_user_notes_db;

USE my_user_notes_db;

CREATE TABLE app_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE user_notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    content TEXT,
    category VARCHAR(100),
    note_date DATE,
    FOREIGN KEY (user_id) REFERENCES app_users(id) ON DELETE CASCADE
);
