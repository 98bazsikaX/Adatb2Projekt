CREATE OR REPLACE FUNCTION calc_discount (flight IN number)
return number IS retval number;
    --DECLARE
        tipus discounts.discount_type_name%TYPE;
        meny    discounts.amount%TYPE;
        ---price_s flights.price%type;
        helper number;
    BEGIN
        SELECT PRICE INTO retval FROM FLIGHTS WHERE ID=flight;
        SELECT COUNT(*) INTO helper FROM DISCOUNTS WHERE FLIGHT_ID=flight;
        IF helper=0 THEN             
             return retval;
        END IF;
        SELECT DISCOUNT_TYPE_NAME, AMOUNT INTO tipus , meny FROM  DISCOUNTS WHERE FLIGHT_ID=flight;
        return retval;
        IF tipus='exact' THEN
            retval:=retval-meny;
        ELSIF tipus='percentage' THEN
            retval:= retval*meny;
        END IF;
        return retval;
    end;
    /