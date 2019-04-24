

CREATE DATABASE IF NOT EXISTS dndoodle;


USE dndoodle;




CREATE TABLE dnd_user
(
    user_id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name   VARCHAR(32) NOT NULL,
    user_gid    VARCHAR(64),
    user_pass   BINARY(60)
    user_email  VARCHAR(128),
);
