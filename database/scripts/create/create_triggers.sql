CREATE TRIGGER airlines_insert_into_countries
AFTER INSERT ON airlines
FOR EACH ROW
BEGIN
    INSERT INTO countries (country_name) VALUES(:new.country);
END;
/

CREATE TRIGGER airports_insert_into_countries
AFTER INSERT ON airports
FOR EACH ROW
BEGIN
    INSERT INTO countries (country_name) VALUES(:new.country);
END;
/

CREATE TRIGGER users_insert_into_countries
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    INSERT INTO countries (country_name) VALUES(:new.country);
END;
/