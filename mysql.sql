CREATE TABLE `user` (user_id int AUTO_INCREMENT PRIMARY KEY,
                    first_name varchar(50),
                    last_name varchar(50),
                    email varchar(50),
                    `password` varchar(255),
                    UNIQUE KEY `email` (`email`))ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE cars (car_id int AUTO_INCREMENT PRIMARY KEY,
                  car_name varchar(40),
                  car_type varchar(40),
                  `status` ENUM('available','reserved'),
                  fk_office_id int,
                   module varchar(40)
                  );

CREATE TABLE address(address_id int AUTO_INCREMENT PRIMARY KEY,
                    zip int,
                    city varchar(40),
                    country varchar(40),
                    area varchar(40));

create TABLE PHP_car_rental_agency(id int AUTO_INCREMENT PRIMARY KEY,
                                  office_name varchar(40),
                                  fk_address_id int,
                                  fk_user_id int
                                  );


INSERT INTO `cars`( `car_name`, `car_type`, `status`, `module`) VALUES 
('TESLA','Sport car','','2017'),
('MASDA','family car','','2015'),
('HUNDAI','race car','','2018'),
('Bentely','family car','','2016'),
('Jaguar','Sport car','','2017'),
('TVR','work car','','2016'),
('Vauxhall','race car','','2013'),
('Peugeot','family car','','2012'),
('Bugatti','family car','','2018'),
('Lancia','race car','','2017'),
('Maserati','Sport car','','2018'),
('Lexus','work car','','2016'),
('Subaru','transport car','','2012'),
('Cadlilac','family car','','2016'),
('Hummer','family car','','2011'),
('Pontiac','transport car','','2016'),
('Saturn ','race car','','2014'),
('Jeep','transport car','','2017'),
('Clysler','Sport car','','2014'),
('KIA','Sport car','','2017');

INSERT INTO `address`( `zip`, `city`, `country`, `area`) VALUES 
(1140,'Wien','Österreich','Linzerstraße 63'),
(8320,'Linz','Österreich','alterseestraße 30'),
(6350,'Salzburg','Österreich','burggasse 40'),
(7720,'Graz','Österreich','Dornbach 13');


INSERT INTO `php_car_rental_agency`(`office_name`, `fk_address_id`) VALUES 
('Carsrental',1),
('Goldencar',2),
('zakicar',3),
('Carsrental',4);

ALTER TABLE php_car_rental_agency add FOREIGN KEY (fk_address_id) REFERENCES address(address_id);

ALTER TABLE cars ADD FOREIGN KEY (fk_office_id) REFERENCES php_car_rental_agency(id);

CREATE TABLE customer(customer_id int AUTO_INCREMENT PRIMARY KEY,
                     location varchar(40));

$result = $conn->query("SELECT php_car_rental_agency.id,php_car_rental_agency.office_name,address.zip,address.city,address.country,address.area FROM php_car_rental_agency INNER JOIN `address` on php_car_rental_agency.fk_address_id = address.address_id");

INSERT INTO `customer`(`location`, `fk_car_id`) VALUES 
('Landstrasse-Hauptstrasse  1/1',20),
('Landstrasse-Hauptstrasse  1/1',12),
('pillgramgasse 17',10),
('linzerstraße  63',7),
('pillgramgasse 17',6),
('Kaertner Ring 1',18),
('Kaertner Ring 1',4),
('linzerstraße  63',3),
('linzerstraße  63',14);


alter TABLE customer add FOREIGN KEY (fk_car_id) REFERENCES cars(car_id);

SELECT customer.location, count(customer.location) as 'Number of Cars' FROM customer INNER JOIN cars on customer.fk_car_id = cars.car_id GROUP BY customer.location;

SELECT cars.car_name, customer.location FROM cars LEFT JOIN customer on cars.car_id = customer.fk_car_id ;
"SELECT cars.car_id,cars.car_name,cars.car_type,cars.module,php_car_rental_agency.office_name,cars.status FROM cars INNER JOIN php_car_rental_agency ON cars.fk_office_id  = php_car_rental_agency.id INNER JOIN customer on php_car_rental_agency.
            WHERE location = $filt "