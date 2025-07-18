DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
    id VARCHAR(128) PRIMARY KEY,
    user VARCHAR(255) NULL,
    ip VARCHAR(45) NULL,
    user_agent TEXT NULL,
    last_page TEXT NULL,
    data TEXT NOT NULL,
    last_activity INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT IGNORE INTO users (username, password) VALUES ('admin', '2bb80d537b1da3e38bd30361aa855686bde0eacd7162fef6a25fe97bf527a25b');
