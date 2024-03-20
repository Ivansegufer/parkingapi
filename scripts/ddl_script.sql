USE parking;

CREATE TABLE fares (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    establishment_id INT UNSIGNED NOT NULL,
    amount_per_hour DECIMAL(4, 2) NOT NULL
);

CREATE TABLE establishments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(100) NOT NULL,
    address VARCHAR(200) NOT NULL,
    total_stands INT NOT NULL,
    total_occupied_stands INT NOT NULL,
    fare DECIMAL(4, 2) NOT NULL
);

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(255) NOT NULL,
    profile_image VARCHAR(400),
    password CHAR(64) NOT NULL
);

CREATE TABLE cars (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    plate_number VARCHAR(10) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year SMALLINT NOT NULL,
    color VARCHAR(20) NOT NULL
);

CREATE TABLE movements (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    car_id INT UNSIGNED NOT NULL,
    establishment_id INT UNSIGNED NOT NULL,
    amount DECIMAL(8, 2),
    enter_date DATETIME NOT NULL,
    exit_date DATETIME
);

ALTER TABLE establishments ADD CONSTRAINT establishment_users_FK FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE fares ADD CONSTRAINT fare_establishments_FK FOREIGN KEY (establishment_id) REFERENCES establishments(id);
ALTER TABLE cars ADD CONSTRAINT car_users_FK FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE movements ADD CONSTRAINT movement_cars_FK FOREIGN KEY (car_id) REFERENCES cars(id);

ALTER TABLE establishments MODIFY COLUMN total_occupied_stands int(11) DEFAULT 0 NOT NULL;