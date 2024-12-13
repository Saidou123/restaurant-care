CREATE DATABASE restaurant_care;

USE restaurant_care;

-- Customers Table
CREATE TABLE Customers (
    customerId INT AUTO_INCREMENT PRIMARY KEY,
    customerName VARCHAR(100) NOT NULL,
    contactInfo VARCHAR(200) NOT NULL
);

-- Reservations Table
CREATE TABLE Reservations (
    reservationId INT AUTO_INCREMENT PRIMARY KEY,
    customerId INT,
    reservationDate DATE NOT NULL,
    tableNumber INT NOT NULL,
    specialRequests TEXT,
    FOREIGN KEY (customerId) REFERENCES Customers(customerId) ON DELETE CASCADE
);

-- Preferences Table
CREATE TABLE Preferences (
    preferenceId INT AUTO_INCREMENT PRIMARY KEY,
    customerId INT,
    dietaryPreferences TEXT,
    FOREIGN KEY (customerId) REFERENCES Customers(customerId) ON DELETE CASCADE
);