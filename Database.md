
Struktur Database Beserta isinya
------------------------------------------------

CREATE DATABASE db_servis;
USE db_servis;

-- Tabel: admin
CREATE TABLE admin (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (id, email, password) VALUES
(3, 'admin@gmail.com', 'admin123');


-- Tabel: antrian
CREATE TABLE antrian (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    tanggal DATE DEFAULT CURDATE(),
    status ENUM('pending','selesai') DEFAULT 'pending',
    telepon VARCHAR(13)
);

INSERT INTO antrian (id, nama, tanggal, status, telepon) VALUES
(1, 'Budi', '2025-07-11', NULL, '0812-0101-901'),
(2, 'Siti', '2025-07-11', NULL, '0878-6271-972'),
(3, 'Hafiz Fauzan', '2025-07-11', NULL, '0826-9172-009'),
(4, 'Doni', '2025-07-11', NULL, '0877-8266-918'),
(17, 'Robi jae', '2025-07-11', 'pending', '0865-7523-432'),
(18, 'Talia zahra', '2025-07-11', 'pending', '0843-3200-112'),
(19, 'iryad maulana', '2025-07-11', 'pending', '0857-7381-017'),
(21, 'Awan setiawan', '2025-07-11', 'pending', '0812-3682-908'),
(27, 'lalaa', '2025-07-14', 'pending', '0099887766'),
(38, 'Fanny', '2025-07-15', NULL, '08111'),
(39, 'fany', '2025-07-15', 'pending', '009900'),
(42, 'Budi', '2025-07-20', '', '0800-0011-110'),
(43, 'dimas', '2025-07-20', '', '0812-0101-901'),
(44, 'dummy', '2025-07-22', 'pending', '009900');


-- Tabel: kategori_servis
CREATE TABLE kategori_servis (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama_servis VARCHAR(100) NOT NULL,
    harga_default INT(11) NOT NULL
);

INSERT INTO kategori_servis (id, nama_servis, harga_default) VALUES
(1, 'Tune Up', 150000),
(2, 'Bore Up', 300000),
(3, 'Brake Maintenace', 100000),
(4, 'Stroke Up', 350000),
(5, 'Overhaul', 500000),
(6, 'Oil Engine And Transmissions', 75000),
(7, 'Maintenance Suspension', 200000),
(8, 'Spooring Balancing', 250000);



-- Tabel: pelanggan
CREATE TABLE pelanggan (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(13)
);

INSERT INTO pelanggan (id, nama, alamat, telepon) VALUES
(4, 'Budi', NULL, '0812-0101-901'),
(5, 'Siti', NULL, '0878-6271-972'),
(13, 'Doni', NULL, '0877-8266-918'),
(14, 'Hafiz Fauzan', NULL, '0826-9172-009'),
(18, 'addfd', NULL, '084644'),
(20, 'dummy', NULL, '009900'),
(21, 'Fanny', NULL, '08111'),
(23, 'Hafiz Dimas', NULL, '0812-0101-901');


-- Tabel: kendaraan
CREATE TABLE kendaraan (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT(11),
    no_polisi VARCHAR(20) NOT NULL,
    merk VARCHAR(50),
    tipe VARCHAR(50),
    tahun INT(11)
);


INSERT INTO kendaraan (id, id_pelanggan, no_polisi, merk, tipe, tahun) VALUES
(1, 4, 'B 1121', 'Mitsubishi Galant', 'Galant v6', 2012),
(2, 5, 'K 1314 NA', 'Mitsubishi Pajero', 'Sport', 2018),
(3, 13, 'AA 0192 RDK', 'Toyota Fortuner', '4x4', 2020),
(4, 13, 'B 1331 KK', 'Toyota Kijang Inova', 'newborn', 208),
(5, 18, 'B 1134 RR', 'honda civic', 'R', 2024),
(6, 23, 'B 1 NG', 'Ford Raptor', '4x4', 2018);

-- Tabel: servis
CREATE TABLE servis (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_kendaraan INT(11),
    tanggal_servis DATE,
    jenis_servis VARCHAR(100),
    biaya INT(11)
);

INSERT INTO servis (id, id_kendaraan, tanggal_servis, jenis_servis, biaya) VALUES
(1, 1, '2025-07-13', 'Tune up (ringan)', 650000),
(2, 2, '2025-07-13', 'Tune up', 3800000),
(3, 3, '2025-07-13', 'Turun Mesin/Overhaul', 5950000),
(4, 4, '2025-07-16', 'Bore up', 7890000),
(5, 5, '2025-07-14', 'Stroke up', 12000000),
(6, 1, '2025-07-20', 'Tune Up', 150000),
(7, 6, '2025-07-22', 'Tune Up', 150000);
