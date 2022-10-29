CREATE DATABASE ecommerce_db;
use ecommerce_db;
CREATE TABLE users (
    id int(20) PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(70) unique,
    address varchar(150),
    phone_number varchar(15),
    email_address varchar(50),
    pass varchar(200),
    photo varchar(100)
);
CREATE TABLE products(
    title varchar(70),
    price_us int(5),
    id int(20) PRIMARY KEY AUTO_INCREMENT,
    discount decimal(5,4),
    images json,
     CONSTRAINT CH_discount_precent check(discount <= 1.0000)
);

CREATE TABLE orders(
    id int(10),
    user_id int(10) ,
    product_id int(10) ,
    state_ varchar(10),
    data_time timestamp default CURRENT_TIMESTAMP,
    CONSTRAINT FK_USER FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT FK_product FOREIGN KEY (product_id) REFERENCES products(id)
);