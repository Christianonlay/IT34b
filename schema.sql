CREATE TABLE users(
    user_id INT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,
    user_role(`admin`, `user`, `guest`) NOT NULL DEFAULT 'user'

    --Email verification verification fields
    user_is_verified TINYINT(1) NOT NULL DEFAULT 0,
    user_verification_token VARCHAR(255) DEFAULT NULL,
    user_email_verification_expires DATETIME DEFAULT NULL,

    --Date parameters
    user_create_at DEFAULT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_update_at DEFAULT TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);

CREATE TABLE IF NOT EXISTS users_activity (
    user_activity_log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_activity_log_status ENUM('success', 'failure') DEFAULT 'success',


    --client parameters
    user_activity_log_ip_address VARCHAR(45),
    user_activity_log_user VARCHARR(255),
    user_activity_log_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    --INDEXES
    INDEX idx_user_id (user_id),
    INDEX idx_action(user_activity_log_action),
    INDEX idx_created_at(user_activity_log_created_at), 
    ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




);