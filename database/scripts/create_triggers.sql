CREATE TRIGGER discount_valid_to
AFTER INSERT ON discounts
FOR EACH ROW
WHEN (discounts.valid_to IS NULL)
BEGIN
    NEW.valid_to = (SELECT takeoff_date FROM flights INNER JOIN discounts ON flights.id = discounts.flight_id LIMIT 1);
END
