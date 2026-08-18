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