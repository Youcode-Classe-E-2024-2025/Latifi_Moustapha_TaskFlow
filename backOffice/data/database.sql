-- Création de la base de données
CREATE DATABASE IF NOT EXISTS taskFlow;
USE taskFlow;

-- Création de la table Users
CREATE TABLE IF NOT EXISTS Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);


-- Création de la table Tasks
CREATE TABLE IF NOT EXISTS Tasks (
    task_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(55) NOT NULL,
    description TEXT,
    status ENUM('todo', 'in progress', 'done') DEFAULT 'todo',
    category ENUM('simple', 'bug', 'feature') DEFAULT 'simple',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE SET NULL
);

-- Création de la table de jointure Users_Tasks
CREATE TABLE IF NOT EXISTS Users_Tasks (
    Users_Tasks_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    task_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (task_id) REFERENCES Tasks(task_id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_task (user_id, task_id)
);

