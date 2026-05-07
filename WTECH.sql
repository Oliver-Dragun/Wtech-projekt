CREATE TABLE product_categories (
                                    id integer PRIMARY KEY,
                                    name varchar(63) NOT NULL
);

CREATE TABLE addresses (
                           id integer PRIMARY KEY,
                           street_address varchar(255) NOT NULL,
                           apartment varchar(127),
                           city varchar(127) NOT NULL,
                           postal_code varchar(15) NOT NULL,
                           country varchar(127) NOT NULL
);

CREATE TABLE users (
                       id integer PRIMARY KEY,
                       name varchar(63) NOT NULL,
                       surname varchar(63) NOT NULL,
                       phone_number varchar(31),
                       email varchar(127) NOT NULL UNIQUE,
                       password varchar(255) NOT NULL,
                       is_admin boolean NOT NULL DEFAULT false,
                       address_id integer
);

CREATE TABLE products (
                          id integer PRIMARY KEY,
                          name varchar(255) NOT NULL,
                          description text NOT NULL,
                          category_id integer NOT NULL,
                          effect varchar(63) NOT NULL,
                          grade varchar(31) NOT NULL,
                          price integer NOT NULL,
                          created_at timestamp
);

CREATE TABLE product_photos (
                                id integer PRIMARY KEY,
                                product_id integer,
                                number smallint NOT NULL,
                                img text NOT NULL
);

CREATE TABLE shipping_methods (
                                  id integer PRIMARY KEY,
                                  name varchar(127) NOT NULL,
                                  price integer NOT NULL
);

CREATE TABLE order_statuses (
                                id integer PRIMARY KEY,
                                name varchar(63) NOT NULL
);

CREATE TABLE orders (
                        id integer PRIMARY KEY,
                        user_id integer NOT NULL,
                        name varchar(63),
                        surname varchar(63),
                        email varchar(127),
                        phone_number varchar(31),
                        sum integer,
                        shipping_address_id integer,
                        shipping_method_id integer,
                        date timestamp,
                        status_id integer
);

CREATE TABLE order_items (
                             id integer PRIMARY KEY,
                             product_id integer NOT NULL,
                             order_id integer NOT NULL,
                             quantity smallint NOT NULL
);

CREATE TABLE reviews (
                         id integer PRIMARY KEY,
                         user_id integer NOT NULL,
                         product_id integer NOT NULL,
                         body text NOT NULL,
                         rating smallint NOT NULL,
                         date timestamp NOT NULL
);

ALTER TABLE users
    ADD FOREIGN KEY (address_id) REFERENCES addresses (id);

ALTER TABLE products
    ADD FOREIGN KEY (category_id) REFERENCES product_categories (id);

ALTER TABLE product_photos
    ADD FOREIGN KEY (product_id) REFERENCES products (id);

ALTER TABLE orders
    ADD FOREIGN KEY (user_id) REFERENCES users (id);

ALTER TABLE orders
    ADD FOREIGN KEY (shipping_address_id) REFERENCES addresses (id);

ALTER TABLE orders
    ADD FOREIGN KEY (shipping_method_id) REFERENCES shipping_methods (id);

ALTER TABLE orders
    ADD FOREIGN KEY (status_id) REFERENCES order_statuses (id);

ALTER TABLE order_items
    ADD FOREIGN KEY (product_id) REFERENCES products (id);

ALTER TABLE order_items
    ADD FOREIGN KEY (order_id) REFERENCES orders (id);

ALTER TABLE reviews
    ADD FOREIGN KEY (user_id) REFERENCES users (id);

ALTER TABLE reviews
    ADD FOREIGN KEY (product_id) REFERENCES products (id);

