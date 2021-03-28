CREATE OR REPLACE TRIGGER insert_on_discounts
BEFORE INSERT ON discounts
FOR EACH ROW
DECLARE
    v_valid_to discounts.valid_to%TYPE;
BEGIN
    SELECT takeoff_date - 1 INTO v_valid_to FROM flights INNER JOIN discounts ON flights.id = discounts.flight_id;
    :new.valid_to := v_valid_to;
END;
/