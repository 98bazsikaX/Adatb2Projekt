CREATE TABLE users
(
    email VARCHAR(64),
    pwd VARCHAR(255) NOT NULL,
    phone_num VARCHAR(18) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    CONSTRAINT users_pk PRIMARY KEY (email)
);

CREATE TABLE airlines
(
    code CHAR(4),
    airline_name VARCHAR(50) NOT NULL,
    country VARCHAR(35) NOT NULL,
    CONSTRAINT airlines_pk PRIMARY KEY (code)
);

CREATE TABLE airplanes
(
    id NUMBER(4),
    airline_code CHAR(3),
    airplane_type VARCHAR(20) NOT NULL,
    capacity NUMBER(3) NOT NULL,
    CONSTRAINT airplanes_pk PRIMARY KEY (id, airline_code),
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
    CONSTRAINT airports_pk PRIMARY KEY (code)
);

CREATE TABLE flights
(
    id NUMBER(6),
    airplane_id NUMBER(4) NOT NULL,
    airplane_airline_code CHAR(3) NOT NULL,
    price NUMBER(6) NOT NULL,
    takeoff_date DATE NOT NULL,
    takeoff_airport_code CHAR(4) NOT NULL,
    landing_date DATE NOT NULL,
    landing_airport_code CHAR(4) NOT NULL,
    CONSTRAINT flights_pk PRIMARY KEY (id),
    CONSTRAINT fk_flig_airpl
        FOREIGN KEY (airplane_id, airplane_airline_code)
        REFERENCES airplanes(id, airline_code),
    CONSTRAINT fk_flig_airpo_takoff
        FOREIGN KEY (takeoff_airport_code)
        REFERENCES airports(code),
    CONSTRAINT fk_flig_airpo_landing
        FOREIGN KEY (landing_airport_code)
        REFERENCES airports(code)
);

CREATE TABLE purchases
(
    user_email VARCHAR(64),
    purchase_date DATE,
    flight_id NUMBER(6) NOT NULL,
    quantity NUMBER(2) NOT NULL,
    CONSTRAINT purchases_pk PRIMARY KEY (user_email, purchase_date),
    CONSTRAINT fk_purc_user
        FOREIGN KEY (user_email)
        REFERENCES users(email),
    CONSTRAINT fk_purc_flig
        FOREIGN KEY (flight_id)
        REFERENCES flights(id)
);

CREATE TABLE searches
(
    user_email VARCHAR(64),
    search_date DATE,
    takeoff_country VARCHAR(35) NOT NULL,
    takeoff_city VARCHAR(35) NOT NULL,
    landing_country VARCHAR(35) NOT NULL,
    landing_city VARCHAR(35) NOT NULL,
    from_date DATE NOT NULL,
    to_date DATE NOT NULL,
    CONSTRAINT searches_pk PRIMARY KEY (user_email, search_date),
    CONSTRAINT fk_sear_user
        FOREIGN KEY (user_email)
        REFERENCES users(email)
);