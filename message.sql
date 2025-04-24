-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS todo_list;

-- Use the created database
USE todo_list;

-- Create the table if it doesn't exist
CREATE TABLE IF NOT EXISTS tasks (
	    id INT AUTO_INCREMENT PRIMARY KEY,
	    title VARCHAR(255) NOT NULL,
	    status ENUM('pending', 'completed') DEFAULT 'pending',
	    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	);

	-- Create the new user 'ayub' with a secure password (change 'securepassword' to your desired password)
CREATE USER IF NOT EXISTS 'ayub'@'%' IDENTIFIED BY 'ayubp';

-- Grant all privileges to the new user on the todo_list database
GRANT ALL PRIVILEGES ON todo_list.* TO 'ayub'@'%';

-- Flush privileges to ensure the changes take effect
FLUSH PRIVILEGES;

