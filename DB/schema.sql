CREATE TABLE user (
    user_id AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) UNIQUE NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role('admin','manager','user') DEFAULT 'user' ,
    

    -- Email verification feilds
    user_is_verified TINYINT(1) DEFAULT 0,
    user_verification_token VARCHAR(64),
    user_email_verification_expires DATETIME NULL,
     
    -- date Parameters
    user_create_at DEFAULT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_updated_at DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;  
);

CREATE TABLE IF NOT EXIST user_activity_logs(
    user_activity_logs_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    user_email VARCHAR(255),
    user_activity_log_action VARCHAR(50) NOT NULL,
    user_activity_log_status ENUM('success','failed') DEFAULT 'success',

    -- Client parameters
    user_activity_log_ip_address VARCHAR(45),
    user_activity_log_user VARCHAR(255),
    user_activity_log_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Indexes
    INDEX idx_user_id(user_id),
    INDEX idx_action(user_activity_log_action),
    INDEX idx_create_at(user_activity_log_created_at)
) ENGINE=InnDB DEFAULT CHARSET=utf8mb4;