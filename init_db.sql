-- Base de datos
CREATE DATABASE IF NOT EXISTS user_db;
USE user_db;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS user_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    fullname VARCHAR(100),
    dob DATE,
    phonenum VARCHAR(20),
    address TEXT,
    accdate DATE,
    image VARCHAR(255)
);

-- Tabla de administradores
CREATE TABLE IF NOT EXISTS admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_email VARCHAR(100),
    admin_password VARCHAR(255)
);

-- Tabla de conciertos
CREATE TABLE IF NOT EXISTS tblconcert (
    concert_id INT AUTO_INCREMENT PRIMARY KEY,
    concert_name VARCHAR(100),
    concert_date DATE,
    concert_time TIME,
    concert_artist VARCHAR(100),
    concert_desc TEXT,
    concert_genre VARCHAR(50),
    concert_venue VARCHAR(100),
    ub_price DECIMAL(10,2),
    lb_price DECIMAL(10,2),
    vip_price DECIMAL(10,2),
    genad_price DECIMAL(10,2),
    concert_contact VARCHAR(50),
    image VARCHAR(255)
);

-- Tabla de asientos
CREATE TABLE IF NOT EXISTS seats (
    seatid INT AUTO_INCREMENT PRIMARY KEY,
    seatname VARCHAR(10),
    section VARCHAR(50),
    price DECIMAL(10,2)
);

-- Tabla de asientos elegidos
CREATE TABLE IF NOT EXISTS chosenseats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    concertid INT,
    seatid INT,
    seatnames VARCHAR(50),
    status VARCHAR(20),
    FOREIGN KEY (concertid) REFERENCES tblconcert(concert_id),
    FOREIGN KEY (seatid) REFERENCES seats(seatid)
);

-- Tabla de compradores
CREATE TABLE IF NOT EXISTS tblbuyer (
    buyer_id INT AUTO_INCREMENT PRIMARY KEY,
    buyer_name VARCHAR(100),
    buyer_chosenseats VARCHAR(255),
    payment_mode VARCHAR(50),
    buyer_phonenum VARCHAR(20),
    concert_name VARCHAR(100),
    concert_id INT,
    concert_date DATE,
    tickets_qty INT,
    payment_date DATE,
    transaction_no VARCHAR(50),
    payment_price DECIMAL(10,2),
    status VARCHAR(20)
);

-- Tabla de pagos
CREATE TABLE IF NOT EXISTS tblpayment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid INT,
    cardnum VARCHAR(20),
    cardholder VARCHAR(100),
    monthexp INT,
    yearexp INT,
    cvv INT,
    cardtype VARCHAR(20),
    pin VARCHAR(10),
    FOREIGN KEY (userid) REFERENCES user_form(id)
);
