CREATE TABLE roles
(
    id NUMBER(1),
    role_name VARCHAR(20) NOT NULL,
    CONSTRAINT role_pk
        PRIMARY KEY (id)
);

CREATE TABLE users
(
    email VARCHAR(64),
    pwd VARCHAR(255) NOT NULL,
    phone_num VARCHAR(18) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    birth_date DATE NOT NULL,
    country VARCHAR(35) NOT NULL,
    post_code VARCHAR(10) NOT NULL,
    city VARCHAR(40) NOT NULL,
    home_address VARCHAR(40) NOT NULL,
    role_id NUMBER(1) NOT NULL,
    last_login DATE DEFAULT sysdate NOT NULL,
    CONSTRAINT user_pk
        PRIMARY KEY (email),
    CONSTRAINT fk_user_role
        FOREIGN KEY (role_id)
        REFERENCES roles(id)
);

CREATE TABLE airlines
(
    code CHAR(3),
    airline_name VARCHAR(50) NOT NULL,
    airline_name_abbr VARCHAR(20),
    country VARCHAR(35) NOT NULL,
    CONSTRAINT airl_pk
        PRIMARY KEY (code)
);

CREATE SEQUENCE airplanes_seq START WITH 1;

CREATE TABLE airplanes
(
    id NUMBER(6) DEFAULT airplanes_seq.nextval NOT NULL,
    airplane_id NUMBER(4) NOT NULL,
    airline_code CHAR(3) NOT NULL,
    airplane_type VARCHAR(20) NOT NULL,
    capacity NUMBER(3) NOT NULL,
    CONSTRAINT airpl_pk
        PRIMARY KEY (id),
    CONSTRAINT airpl_unique
        UNIQUE (airplane_id, airline_code),
    CONSTRAINT fk_airpl_airl
        FOREIGN KEY (airline_code)
        REFERENCES airlines(code)
);

CREATE TABLE airports
(
    code CHAR(4),
    airport_name VARCHAR(64) NOT NULL,
    country VARCHAR(35) NOT NULL,
    city VARCHAR(35) NOT NULL,
    CONSTRAINT airpo_pk
        PRIMARY KEY (code)
);

CREATE SEQUENCE flights_seq START WITH 1;

CREATE TABLE flights
(
    id NUMBER(6) DEFAULT flights_seq.nextval NOT NULL,
    airplane_id NUMBER(6) NOT NULL,
    price NUMBER(6) NOT NULL,
    takeoff_date DATE NOT NULL,
    takeoff_airport_code CHAR(4) NOT NULL,
    landing_date DATE NOT NULL,
    landing_airport_code CHAR(4) NOT NULL,
    CONSTRAINT flig_pk
        PRIMARY KEY (id),
    CONSTRAINT fk_flig_airpl
        FOREIGN KEY (airplane_id)
        REFERENCES airplanes(id),
    CONSTRAINT fk_flig_airpo_takeoff
        FOREIGN KEY (takeoff_airport_code)
        REFERENCES airports(code),
    CONSTRAINT fk_flig_airpo_landing
        FOREIGN KEY (landing_airport_code)
        REFERENCES airports(code)
);

CREATE TABLE discount_types
(
    discount_name VARCHAR(20),
    multiplier NUMBER(3, 2) NOT NULL,
    CONSTRAINT disc_type_pk
        PRIMARY KEY (discount_name)
);

CREATE SEQUENCE discounts_seq START WITH 1;

CREATE TABLE discounts
(
    id NUMBER(6) DEFAULT discounts_seq.nextval NOT NULL,
    flight_id NUMBER(6) NOT NULL,
    discount_type_name VARCHAR(20) NOT NULL,
    amount NUMBER(6, 1) NOT NULL,
    valid_from DATE DEFAULT sysdate NOT NULL,
    valid_to DATE, -- TODO: add trigger
    CONSTRAINT disc_pk
        PRIMARY KEY (id),
    CONSTRAINT disc_unique
        UNIQUE (flight_id, valid_from),
    CONSTRAINT fk_disc_flig
        FOREIGN KEY (flight_id)
        REFERENCES flights(id),
    CONSTRAINT fk_disc_disc_type
        FOREIGN KEY (discount_type_name)
        REFERENCES discount_types(discount_name)
);

CREATE TABLE purchase_states
(
    id NUMBER(1),
    state_name VARCHAR(20) NOT NULL,
    CONSTRAINT purc_states_pk
        PRIMARY KEY (id)
);

CREATE SEQUENCE purchases_seq START WITH 1;

CREATE TABLE purchases
(
    id NUMBER(6) DEFAULT purchases_seq.nextval NOT NULL,
    user_email VARCHAR(64) NOT NULL,
    flight_id NUMBER(6) NOT NULL,
    quantity NUMBER(2) NOT NULL,
    purchase_date DATE DEFAULT sysdate NOT NULL,
    purchase_state NUMBER(1) NOT NULL,
    CONSTRAINT purc_pk
        PRIMARY KEY (id),
    CONSTRAINT purc_unique
        UNIQUE (user_email, purchase_date),
    CONSTRAINT fk_purc_user
        FOREIGN KEY (user_email)
        REFERENCES users(email),
    CONSTRAINT fk_purc_flig
        FOREIGN KEY (flight_id)
        REFERENCES flights(id),
    CONSTRAINT fk_purc_purc_states
        FOREIGN KEY (purchase_state)
        REFERENCES purchase_states(id)
);

CREATE SEQUENCE tickets_seq START WITH 1;

CREATE TABLE tickets
(
    id NUMBER(6) DEFAULT tickets_seq.nextval NOT NULL,
    purchase_id NUMBER(6) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    birth_date DATE NOT NULL,
    CONSTRAINT tick_pk
        PRIMARY KEY (id),
    CONSTRAINT tick_unique
        UNIQUE (purchase_id, first_name, last_name, birth_date),
    CONSTRAINT fk_tick_purc
        FOREIGN KEY (purchase_id)
        REFERENCES purchases(id)
);

CREATE SEQUENCE searches_seq START WITH 1;

CREATE TABLE searches
(
    id NUMBER(6) DEFAULT searches_seq.nextval NOT NULL,
    user_email VARCHAR(64) NOT NULL,
    takeoff_country VARCHAR(35) NOT NULL,
    takeoff_city VARCHAR(35) NOT NULL,
    landing_country VARCHAR(35) NOT NULL,
    landing_city VARCHAR(35) NOT NULL,
    from_date DATE NOT NULL,
    to_date DATE NOT NULL,
    search_date DATE DEFAULT sysdate NOT NULL,
    CONSTRAINT sear_pk
        PRIMARY KEY (id),
    CONSTRAINT sear_unique
        UNIQUE (user_email, search_date),
    CONSTRAINT fk_sear_user
        FOREIGN KEY (user_email)
        REFERENCES users(email)
);

CREATE SEQUENCE countries_seq START WITH 1;

CREATE TABLE countries
(
    id NUMBER(3) DEFAULT countries_seq.nextval NOT NULL,
    country_name VARCHAR(35) NOT NULL,
    CONSTRAINT coun_pk
        PRIMARY KEY (id)
);

CREATE SEQUENCE cities_seq START WITH 1;

CREATE TABLE cities -- TODO: add trigger
(
    id NUMBER(6) DEFAULT cities_seq.nextval NOT NULL,
    country_id NUMBER(3) NOT NULL,
    city_post_code VARCHAR(10) NOT NULL,
    city_name VARCHAR(40) NOT NULL,
    CONSTRAINT citi_pk
        PRIMARY KEY (id),
    CONSTRAINT fk_citi_coun
        FOREIGN KEY (country_id)
        REFERENCES countries(id),
    CONSTRAINT citi_unique
        UNIQUE (country_id, city_post_code, city_name)
);