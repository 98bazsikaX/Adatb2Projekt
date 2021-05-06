CREATE OR REPLACE TRIGGER check_num_of_seats
AFTER INSERT ON seats
FOR EACH ROW
DECLARE
    id airplanes.id%TYPE;
    max_seats airplanes.capacity%TYPE;
BEGIN
    SELECT airplanes.id, airplanes.capacity INTO id, max_seats FROM airplanes INNER JOIN flights ON airplanes.id = flights.airplane_id INNER JOIN seats ON :new.flight_id = seats.flight_id;

    IF :new.seat > max_seats THEN
        DELETE FROM seats WHERE :new.flight_id = id AND :new.seat > max_seats;
    END IF;
END;
/

CREATE OR REPLACE TRIGGER check_tickets
    AFTER UPDATE ON PURCHASES
    FOR EACH ROW
BEGIN
    IF :NEW.PURCHASE_STATE = 2 THEN
        DELETE FROM TICKETS WHERE PURCHASE_ID=:NEW.ID;
    end if;
END;
/