USE parking;

CREATE TABLE fares (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    amount_per_hour DECIMAL(4, 2) NOT NULL
);

CREATE TABLE cars (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    plate_number VARCHAR(10) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year SMALLINT NOT NULL,
    color VARCHAR(20) NOT NULL
);

CREATE TABLE movements (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    car_id INT UNSIGNED NOT NULL,
    amount DECIMAL(8, 2),
    enter_date DATETIME NOT NULL,
    exit_date DATETIME
);

ALTER TABLE movements ADD CONSTRAINT movement_cars_FK FOREIGN KEY (car_id) REFERENCES cars(id);