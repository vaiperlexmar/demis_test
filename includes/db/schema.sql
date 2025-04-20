CREATE
    DATABASE IF NOT EXISTS demis_test;
USE demis_test;

CREATE TABLE users
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email   VARCHAR(255) NOT NULL,
    phone   VARCHAR(15)  NOT NULL
);
