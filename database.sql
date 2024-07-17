CREATE DATABASE php_login_management;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL ,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'admin'
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
) ENGINE=InnoDB;

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_jumlah INT NOT NULL,
    total_harga INT NOT NULL,
    status ENUM('menunggu_pembayaran', 'dibayar', 'dibatalkan') NOT NULL DEFAULT 'menunggu_pembayaran',
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

