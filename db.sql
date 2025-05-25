CREATE DATABASE IF NOT EXISTS `e-commerce`;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO categories (name) VALUES 
('Telefon'),
('Laptop'),
('Të tjera');


ALTER TABLE users ADD COLUMN is_admin TINYINT(1) DEFAULT 0;
UPDATE users SET is_admin = 1 WHERE email = 'ardona@gmail.com';-- e kom kriju ni user throw register form edhe tani e kom change to admin 

INSERT INTO products (name, price, image, category_id) VALUES
('iPhone 16 Pro', 999, 'images/product-1.jpg', 1),
('MacBook Air 15-inch with M3 chip', 1299, 'images/product-2.jpg', 2),
('PRO X SUPERLIGHT 2 DEX', 159, 'images/product-3.jpg', 3),
('BOSE QuietComfort Bluetooth Headphone', 119.99, 'images/product-4.jpg', 3),
('iPad Pro 11‑inch', 999.99, 'images/product-5.jpg', 3),
('ThinkPad E16 Gen 1 Laptop', 829.50, 'images/product-6.png', 2),
('HP Color LaserJet Pro MFP 3301fdw', 429.00, 'images/product-7.png', 3),
('PRIME Z890-P-CSM', 499.99, 'images/product-8.png', 3),
('Samsung Galaxy S24 Ultra', 1199, 'images/samsung-s24.jpg', 1),
('Google Pixel 8 Pro', 899, 'images/pixel-8.jpg', 1),
('Dell XPS 15', 1799, 'images/dell-xps.jpg', 2),
('ASUS ROG Zephyrus G14', 1699, 'images/rog-zephyrus.jpg', 2),
('Sony WH-1000XM5 Headphones', 399, 'images/sony-wh1000xm5.jpg', 3),
('Apple AirPods Pro 2', 279, 'images/airpods-pro.jpg', 3);
('Apple Watch Series 9', 399, 'images/product-8.jpg', 3),
('ASUS ROG Swift Gaming Monitor', 799, 'images/product-9.jpg', 3),
('DJI Mini 4 Pro', 759, 'images/product-10.jpg', 3),
('Razer Blackwidow V4 Pro', 229, 'images/product-11.jpg', 3),
('Amazon Echo Show 10', 259, 'images/product-12.jpg', 3),
('Canon EOS R6 Mark II', 2499, 'images/product-13.jpg', 3),
('Samsung 49" Odyssey G9', 1299, 'images/product-14.jpg', 3),
('Philips Hue Starter Kit', 199, 'images/product-15.jpg', 3),
('NVIDIA GeForce RTX 4080', 1599, 'images/product-16.jpg', 3),
('Meta Quest 3', 549, 'images/product-17.jpg', 3),
('Samsung 990 PRO 4TB SSD', 399, 'images/product-18.jpg', 3),
('PlayStation 5 Pro', 599, 'images/product-19.jpg', 3),
('ASUS ROG Rapture WiFi 7 Router', 699, 'images/product-20.jpg', 3);



ALTER TABLE products ADD COLUMN description TEXT;


UPDATE products SET description = 'iPhone 16 Pro është telefoni më i ri nga Apple, me procesor A18 Bionic, kamerë të trefishtë 48MP, ekran Super Retina XDR 6.7 inch, dhe teknologjinë më të fundit të sigurisë. Përfshin Face ID të përmirësuar dhe mbështetje për 5G.' WHERE name LIKE '%iPhone 16 Pro%';
UPDATE products SET description = 'MacBook Air 15-inch me çipin M3 ofron performancë të jashtëzakonshme me efikasitet të lartë të energjisë. Ekrani Liquid Retina, tastiera Magic Keyboard, dhe bateria që zgjat deri në 18 orë e bëjnë atë zgjedhjen perfekte për profesionistët.' WHERE name LIKE '%MacBook Air%';
UPDATE products SET description = 'PRO X SUPERLIGHT 2 DEX është një maus gaming me sensor HERO 25K, peshë ultra të lehtë prej vetëm 63g, dhe lidhje wireless LIGHTSPEED. Ofron deri në 70 orë jetëgjatësi të baterisë dhe është i përshtatshëm për të gjitha stilet e lojërave.' WHERE name LIKE '%PRO X SUPERLIGHT%';
UPDATE products SET description = 'BOSE QuietComfort ofron cilësi të jashtëzakonshme të zërit dhe anulim të zhurmës. Me komoditet superior dhe bateri që zgjat deri në 24 orë, këto kufje janë perfekte për udhëtime dhe përdorim të përditshëm.' WHERE name LIKE '%BOSE%';
UPDATE products SET description = 'iPad Pro 11-inch kombinon fuqinë e çipit M2 me ekranin Liquid Retina. Përfshin Face ID, kamera të avancuara, dhe mbështet Apple Pencil gjenerata e dytë. Ideal për krijimtari dhe produktivitet.' WHERE name LIKE '%iPad Pro%';
UPDATE products SET description = 'ThinkPad E16 Gen 1 është laptop biznesi me procesor Intel Core të gjeneratës së 13-të, ekran 16 inch FHD, dhe tastierë të njohur ThinkPad. Përfshin veçori të avancuara të sigurisë dhe ndërtim të qëndrueshëm.' WHERE name LIKE '%ThinkPad%';
UPDATE products SET description = 'HP Color LaserJet Pro MFP 3301fdw është printer multifunksional me shpejtësi të lartë printimi, skaner, kopjues dhe faks. Ofron cilësi të shkëlqyer printimi dhe kosto të ulët për faqe.' WHERE name LIKE '%LaserJet%';
UPDATE products SET description = 'PRIME Z890-P-CSM është pllakë amë e avancuar që mbështet procesorët më të fundit Intel. Përfshin WiFi 6E, PCIe 5.0, dhe veçori të shumta për performancë dhe qëndrueshmëri optimale.' WHERE name LIKE '%PRIME Z890%';
UPDATE products SET description = 'Samsung Galaxy S24 Ultra është telefoni më i avancuar i Samsung me S Pen të integruar, ekran Dynamic AMOLED 2X 6.8 inch, sistem kamerash 200MP, dhe veçori të shumta AI.' WHERE name LIKE '%S24 Ultra%';
UPDATE products SET description = 'Google Pixel 8 Pro shquhet për kamerën e tij të jashtëzakonshme dhe përpunimin AI të imazheve. Përfshin ekran OLED 120Hz, procesor Tensor G3, dhe përditësime të garantuara për 7 vjet.' WHERE name LIKE '%Pixel 8%';
UPDATE products SET description = 'Dell XPS 15 është laptop premium me ekran OLED 4K, procesor Intel Core i9, kartë grafike NVIDIA RTX, dhe ndërtim alumini. Ideal për krijues përmbajtjeje dhe profesionistë.' WHERE name LIKE '%Dell XPS%';
UPDATE products SET description = 'ASUS ROG Zephyrus G14 është laptop gaming kompakt me procesor AMD Ryzen, kartë grafike NVIDIA RTX, dhe ekran 14 inch 144Hz. Perfekt për gaming në lëvizje.' WHERE name LIKE '%Zephyrus%';
UPDATE products SET description = 'Sony WH-1000XM5 janë kufje wireless me anulimin më të mirë të zhurmës në industri. Ofrojnë cilësi të lartë audio, komoditet superior, dhe 30 orë jetëgjatësi të baterisë.' WHERE name LIKE '%WH-1000XM5%';
UPDATE products SET description = 'Apple AirPods Pro 2 ofrojnë cilësi të jashtëzakonshme të zërit, anulim aktiv të zhurmës, modalitet transparence adaptiv, dhe rezistencë ndaj ujit. Përfshijnë gjurmimin hapësinor të zërit dhe integrimin e përsosur me ekosistemin Apple.' WHERE name LIKE '%AirPods Pro%';
UPDATE products SET description = 'Ora inteligjente e avancuar me monitorim të plotë të shëndetit, matje të rrahjeve të zemrës, nivelin e oksigjenit në gjak dhe shumë funksione të tjera shëndetësore.' WHERE name LIKE '%Apple Watch Series 9%';
UPDATE products SET description = 'Monitor gaming 27-inç me rezolucion 4K, shkallë rifreskimi 144Hz, teknologji G-Sync dhe ngjyra të jashtëzakonshme për përvojën më të mirë në lojëra.' WHERE name LIKE '%ASUS ROG Swift%';
UPDATE products SET description = 'Dron kompakt me kamerë 4K, sistem të shmangies së pengesave, kohë fluturimi deri në 34 minuta dhe kontroll të lehtë për përdorim profesional.' WHERE name LIKE '%DJI Mini 4%';
UPDATE products SET description = 'Tastierë mekanike për gaming me ndriçim RGB të personalizueshëm, çelësa mekanikë të cilësisë së lartë dhe mbështetëse për duar për komfort maksimal.' WHERE name LIKE '%Blackwidow V4%';
UPDATE products SET description = 'Ekran inteligjent me ndjekje të lëvizjes, asistent virtual Alexa të integruar, cilësi të lartë zëri dhe mundësi për video thirrje.' WHERE name LIKE '%Echo Show%';
UPDATE products SET description = 'Kamerë profesionale pa pasqyrë me sensor full-frame, sistem fokusimi të avancuar, stabilizim të integruar dhe cilësi superiore të fotografive.' WHERE name LIKE '%Canon EOS R6%';
UPDATE products SET description = 'Monitor gaming ultra i gjerë 49-inç me ekran të lakuar, shkallë rifreskimi 240Hz dhe teknologji QLED për ngjyra mahnitëse.' WHERE name LIKE '%Odyssey G9%';
UPDATE products SET description = 'Sistem ndriçimi inteligjent me urë kontrolli dhe llamba LED të personalizueshme për të krijuar atmosferën perfekte në shtëpinë tuaj.' WHERE name LIKE '%Hue Starter%';
UPDATE products SET description = 'Kartë grafike e gjeneratës së fundit për gaming dhe renderim profesional, me teknologji ray tracing dhe performancë të jashtëzakonshme.' WHERE name LIKE '%RTX 4080%';
UPDATE products SET description = 'Pajisje VR e avancuar me mundësi për realitet të përzier, kontrollorë të përmirësuar dhe një bibliotekë të gjerë aplikacionesh dhe lojërash.' WHERE name LIKE '%Meta Quest%';
UPDATE products SET description = 'Disk SSD ultra i shpejtë me kapacitet 4TB, teknologji PCIe 4.0 dhe shpejtësi lexim-shkrim mahnitëse për performancë maksimale.' WHERE name LIKE '%990 PRO%';
UPDATE products SET description = 'Konsola e lojërave e gjeneratës së ardhshme me mbështetje për rezolucion 8K, grafika të avancuara dhe performancë superiore në lojëra.' WHERE name LIKE '%PlayStation 5%';
UPDATE products SET description = 'Router gaming i avancuar me teknologji WiFi 7, mbulim të gjerë, tri banda frekuencash dhe optimizim të dedikuar për lojëra online.' WHERE name LIKE '%Rapture WiFi%';

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    zip VARCHAR(20) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10,2),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

ALTER TABLE order_items ADD COLUMN image VARCHAR(255);
ALTER TABLE order_items ADD COLUMN name VARCHAR(255);


CREATE TABLE visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    page_url VARCHAR(255),
    visit_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    session_id VARCHAR(255),
    is_logged_in BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

ALTER TABLE visits ADD COLUMN is_logged_in TINYINT(1) NOT NULL DEFAULT 0;