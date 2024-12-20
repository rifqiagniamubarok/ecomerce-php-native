CREATE DATABASE bobakuy_db;

USE bobakuy_db;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    alamat VARCHAR(255),
    role ENUM('admin', 'user') NOT NULL DEFAULT 'admin'
);

CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE menu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    gambar VARCHAR(255),
    nama VARCHAR(255),
    harga INT
);

CREATE TABLE keranjang_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    menu_id INT NOT NULL,
    nama_menu VARCHAR(255) NOT NULL,
    jumlah INT NOT NULL,
    harga INT NOT NULL,
    total_harga INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (menu_id) REFERENCES menu(id)
);

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_jumlah INT NOT NULL,
    total_harga INT NOT NULL,
    status ENUM('menunggu_pembayaran','dibatalkan','diproses','diantar','diterima') NOT NULL DEFAULT 'menunggu_pembayaran',
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE transaksi_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    transaksi_id INT NOT NULL,
    nama_menu VARCHAR(255) NOT NULL,
    harga INT NOT NULL,
    total_harga INT NOT NULL,
    jumlah INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);