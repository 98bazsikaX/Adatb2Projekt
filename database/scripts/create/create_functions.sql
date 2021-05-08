CREATE OR REPLACE FUNCTION calc_discount (flight IN number)
return number IS retval number;
        tipus discounts.discount_type_name%TYPE;
        meny    discounts.amount%TYPE;
        helper number;
    BEGIN
        SELECT PRICE INTO retval FROM FLIGHTS WHERE ID=flight;
        SELECT COUNT(*) INTO helper FROM DISCOUNTS WHERE FLIGHT_ID=flight AND (SYSDATE BETWEEN VALID_FROM AND VALID_TO); --not tested TODO: test
        IF helper=0 THEN             
             return retval;
        END IF;
        SELECT DISCOUNT_TYPE_NAME, AMOUNT INTO tipus , meny FROM  DISCOUNTS WHERE FLIGHT_ID=flight;
        IF tipus='exact' THEN
            retval:=retval-meny;
        ELSIF tipus='percentage' THEN
            retval:= retval*((100-meny)/100);
        END IF;
        return retval;
    end;
    /