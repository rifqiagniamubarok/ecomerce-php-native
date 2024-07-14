CREATE DATABASE php_login_management;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL ,
    password VARCHAR(255) NOT NULL
) ENGINE InnoDB;

CREATE TABLE sessions(
    id VARCHAR(255) PRIMARY KEY ,
    user_id INT NOT NULL
)ENGINE InnoDB;

ALTER TABLE sessions
ADD CONSTRAINT fk_sessions_user
    FOREIGN KEY (user_id)
        REFERENCES users(id);

CREATE TABLE menu(
    id INT PRIMARY KEY AUTO_INCREMENT,
    gambar VARCHAR(255),
    nama VARCHAR(255),
    harga INT
) ENGINE InnoDB;

CREATE TABLE keranjang(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_pembeli VARCHAR(255),
    email VARCHAR(255),
    total INT,
    dibayar ENUM('sudah', 'menunggu_pembayaran', 'belum')
) ENGINE InnoDB;

CREATE TABLE keranjang_item(
    id INT PRIMARY KEY AUTO_INCREMENT,
    keranjang_id INT,
    menu_id INT,
    qty INT,
    harga INT,
    total_harga INT,
    FOREIGN KEY (keranjang_id) REFERENCES keranjang(id),
    FOREIGN KEY (menu_id) REFERENCES menu(id)
) ENGINE InnoDB;
