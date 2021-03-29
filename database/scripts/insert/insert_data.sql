INSERT ALL
    -- Insert into roles table
    INTO roles (id, role_name) VALUES (0, 'user')
    INTO roles (id, role_name) VALUES (5, 'admin')
    -- Insert into discount types
    INTO discount_types (discount_name, multiplier) VALUES ('exact', 1.00)
    INTO discount_types (discount_name, multiplier) VALUES ('percentage', 0.01)
    -- Insert into seat states
    INTO seat_states (id, state_name) VALUES (0, 'inactive')
    INTO seat_states (id, state_name) VALUES (1, 'active')
    INTO seat_states (id, state_name) VALUES (2, 'occupied')
    -- Insert into purchase states
    INTO purchase_states (id, state_name) VALUES (0, 'inactive')
    INTO purchase_states (id, state_name) VALUES (1, 'active')
    INTO purchase_states (id, state_name) VALUES (2, 'cancelled')
    INTO purchase_states (id, state_name) VALUES (3, 'noncancellable')
    -- Insert into airlines
    -- European airlines
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('AUA', 'Austrian Airlines AG', 'Austrian', 'Austria')
    INTO airlines (code, airline_name, country) VALUES ('ATW', 'Air Antwerp', 'Belgium')
    INTO airlines (code, airline_name, country) VALUES ('CTN', 'Croatia Airlines Ltd.', 'Croatia')
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('CSA', 'Czech Airlines j.s.c.', 'CSA', 'Czech Republic')
    INTO airlines (code, airline_name, country) VALUES ('FIN', 'Finnair', 'Finland')
    INTO airlines (code, airline_name, country) VALUES ('AFR', 'Air France', 'France')
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('DLH', 'Deutsche Lufthansa AG', 'Lufthansa', 'Germany')    
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('WZZ', 'Wizz Air Hungary Ltd.', 'Wizz Air', 'Hungary')
    INTO airlines (code, airline_name, country) VALUES ('ICE', 'Icelandair', 'Iceland')
    INTO airlines (code, airline_name, country) VALUES ('AZA', 'Alitalia', 'Italy')
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('KLM', 'KLM Royal Dutch Airlines', 'KLM', 'Netherlands')
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('NAX', 'Norwegian Air Shuttle ASA', 'Norwegian', 'Norway')
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('LOT', 'LOT Polish Airlines', 'LOT', 'Poland')
    INTO airlines (code, airline_name, country) VALUES ('IBE', 'Iberia', 'Spain')
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('SAS', 'Scandinavian Airlines', 'SAS', 'Sweden')
    INTO airlines (code, airline_name, country) VALUES ('JAS', 'Jet Aviation', 'Switzerland')
    INTO airlines (code, airline_name, country) VALUES ('THY', 'Turkish Airlines', 'Turkey')
    INTO airlines (code, airline_name, airline_name_abbr, country) VALUES ('BAW', 'British Airways', 'BA', 'United Kingdom')
    -- Insert into airports
    -- Austrian airports
    INTO airports (code, airport_name, country, city) VALUES ('LOWG', 'Graz Airport', 'Austria', 'Graz')
    INTO airports (code, airport_name, country, city) VALUES ('LOWI', 'Innsbruck Airport', 'Austria', 'Innsbruck')
    INTO airports (code, airport_name, country, city) VALUES ('LOWK', 'Klagenfurt Airport', 'Austria', 'Klagenfurt')
    INTO airports (code, airport_name, country, city) VALUES ('LOWZ', 'Linz Airport', 'Austria', 'Linz')
    INTO airports (code, airport_name, country, city) VALUES ('LOWS', 'Salzburg Airport', 'Austria', 'Salzburg')
    -- Belgian airports
    INTO airports (code, airport_name, country, city) VALUES ('EBAW', 'Antwerp International Airport', 'Belgium', 'Antwerp')
    INTO airports (code, airport_name, country, city) VALUES ('EBBR', 'Brussels Airport', 'Belgium', 'Brussels')
    -- Croatian airports
    INTO airports (code, airport_name, country, city) VALUES ('LDDU', 'Dubrovnik Airport', 'Croatia', 'Dubrovnik')
    INTO airports (code, airport_name, country, city) VALUES ('LDOS', 'Osijek Airport', 'Croatia', 'Osijek')
    INTO airports (code, airport_name, country, city) VALUES ('LDRI', 'Rijeka Airport', 'Croatia', 'Rijeka')
    INTO airports (code, airport_name, country, city) VALUES ('LDSP', 'Split Airport', 'Croatia', 'Split')
    INTO airports (code, airport_name, country, city) VALUES ('LDZD', 'Zadar Airport', 'Croatia', 'Zadar')
    INTO airports (code, airport_name, country, city) VALUES ('LDZA', 'Zagreb Airport', 'Croatia', 'Zagreb')
    -- Czech airports
    INTO airports (code, airport_name, country, city) VALUES ('LKPR', 'Václav Havel Airport Prague', 'Czech Republic', 'Prague')
    INTO airports (code, airport_name, country, city) VALUES ('LKMT', 'Ostrava Airport', 'Czech Republic', 'Ostrava')
    INTO airports (code, airport_name, country, city) VALUES ('LKKV', 'Karlovy Vary Airport', 'Czech Republic', 'Karlovy Vary')
    -- Finnish airports
    INTO airports (code, airport_name, country, city) VALUES ('EFHK', 'Helsinki-Vantaa Airport', 'Finland', 'Helsinki')
    INTO airports (code, airport_name, country, city) VALUES ('EFIV', 'Ivalo Airport', 'Finland', 'Ivalo')
    INTO airports (code, airport_name, country, city) VALUES ('EFKT', 'Kittilä Airport', 'Finland', 'Kittilä')
    INTO airports (code, airport_name, country, city) VALUES ('EFKU', 'Kuopio Airport', 'Finland', 'Kuopio')
    -- French airports
    INTO airports (code, airport_name, country, city) VALUES ('LFMK', 'Carcassonne Airport', 'France', 'Carcassonne')
    INTO airports (code, airport_name, country, city) VALUES ('LFCR', 'Rodez-Aveyron Airport', 'France', 'Rodez')
    INTO airports (code, airport_name, country, city) VALUES ('LFML', 'Marseille Provence Airport', 'France', 'Marseille')
    INTO airports (code, airport_name, country, city) VALUES ('LFSL', 'Brive-Souillac Airport', 'France', 'Brive-la-Gaillarde')
    -- German airports
    INTO airports (code, airport_name, country, city) VALUES ('EDSB', 'Karlsruhe/Baden-Baden Airport', 'Germany', 'Baden-Baden')
    INTO airports (code, airport_name, country, city) VALUES ('EDDB', 'Berlin Brandenburg Airport', 'Germany', 'Berlin')
    INTO airports (code, airport_name, country, city) VALUES ('EDLW', 'Dortmund Airport', 'Germany', 'Dortmund')
    INTO airports (code, airport_name, country, city) VALUES ('EDDF', 'Frankfurt Airport', 'Germany', 'Frankfurt am Main')
    INTO airports (code, airport_name, country, city) VALUES ('EDHI', 'Hamburg Airport', 'Germany', 'Hamburg')
    INTO airports (code, airport_name, country, city) VALUES ('EDDS', 'Stuttgart Airport', 'Germany', 'Stuttgart')
    -- Hungarian airports
    INTO airports (code, airport_name, country, city) VALUES ('LHBP', 'Budapest Ferenc Liszt International Airport', 'Hungary', 'Budapest')
    INTO airports (code, airport_name, country, city) VALUES ('LHDC', 'Debrecen International Airport', 'Hungary', 'Debrecen')
    INTO airports (code, airport_name, country, city) VALUES ('LHPR', 'Győr-Pér International Airport', 'Hungary', 'Győr-Pér')
    -- Icelandic airports
    INTO airports (code, airport_name, country, city) VALUES ('BIHU', 'Húsavík Airport', 'Iceland', 'Húsavík')
    INTO airports (code, airport_name, country, city) VALUES ('BIKF', 'Keflavík International Airport', 'Iceland', 'Keflavík')
    INTO airports (code, airport_name, country, city) VALUES ('BIRK', 'Reykjavík Airport', 'Iceland', 'Reykjavík')
    -- Italian airports
    INTO airports (code, airport_name, country, city) VALUES ('LIBP', 'Abruzzo Airport', 'Italy', 'Pescara')
    INTO airports (code, airport_name, country, city) VALUES ('LIBC', 'Crotone Airport', 'Italy', 'Crotone')
    INTO airports (code, airport_name, country, city) VALUES ('LIPE', 'Bologna-Borgo Panigale Airport', 'Italy', 'Bologna')
    INTO airports (code, airport_name, country, city) VALUES ('LIMP', 'Parma Airport', 'Italy', 'Parma')
    INTO airports (code, airport_name, country, city) VALUES ('LIRF', 'Rome-Fiumicino Airport', 'Italy', 'Rome')
    INTO airports (code, airport_name, country, city) VALUES ('LIMC', 'Milan-Malpensa Airport', 'Italy', 'Milan')
    INTO airports (code, airport_name, country, city) VALUES ('LIPZ', 'Venice Marco Polo Airport', 'Italy', 'Venice')
    -- Dutch airports
    INTO airports (code, airport_name, country, city) VALUES ('EHAM', 'Amsterdam Airport Schiphol', 'Netherlands', 'Amsterdam')
    INTO airports (code, airport_name, country, city) VALUES ('EHEH', 'Eindhoven Airport', 'Netherlands', 'Eindhoven')
    INTO airports (code, airport_name, country, city) VALUES ('EHGG', 'Groningen Airport Eelde', 'Netherlands', 'Groningen')
    INTO airports (code, airport_name, country, city) VALUES ('EHRD', 'Rotterdam The Hague Airport', 'Netherlands', 'Rotterdam')
    -- Norwegian airports
    INTO airports (code, airport_name, country, city) VALUES ('ENBR', 'Bergen Airport, Flesland', 'Norway', 'Bergen')
    INTO airports (code, airport_name, country, city) VALUES ('ENEV', 'Harstad/Narvik Airport, Evenes', 'Norway', 'Harstad')
    INTO airports (code, airport_name, country, city) VALUES ('ENCN', 'Kristiansand Airport, Kjevik', 'Norway', 'Kristiansand')
    INTO airports (code, airport_name, country, city) VALUES ('ENGM', 'Oslo Airport, Gardermoen', 'Norway', 'Oslo')
    INTO airports (code, airport_name, country, city) VALUES ('ENZV', 'Stavanger Airport, Sola', 'Norway', 'Stavanger')
    -- Polish airports
    INTO airports (code, airport_name, country, city) VALUES ('EPWA', 'Warsaw Chopin Airport', 'Poland', 'Warsaw')
    INTO airports (code, airport_name, country, city) VALUES ('EPMO', 'Warsaw Modlin Airport', 'Poland', 'Warsaw')
    INTO airports (code, airport_name, country, city) VALUES ('EPKK', 'Kraków John Paul II International Airport', 'Poland', 'Kraków')
    INTO airports (code, airport_name, country, city) VALUES ('EPKT', 'Katowice Airport', 'Poland', 'Katowice')
    -- Spain airports
    INTO airports (code, airport_name, country, city) VALUES ('LEBL', 'Josep Tarradellas Barcelona–El Prat Airport', 'Spain', 'Barcelona')
    INTO airports (code, airport_name, country, city) VALUES ('LEBB', 'Bilbao Airport', 'Spain', 'Bilbao')
    INTO airports (code, airport_name, country, city) VALUES ('LEMD', 'Madrid-Bajaras Airport', 'Spain', 'Madrid')
    INTO airports (code, airport_name, country, city) VALUES ('LEMG', 'Málaga Airport', 'Spain', 'Málaga')
    -- Swedish airports
    INTO airports (code, airport_name, country, city) VALUES ('ESGG', 'Göteborg Landvetter Airport', 'Sweden', 'Gothenburg')
    INTO airports (code, airport_name, country, city) VALUES ('ESMS', 'Malmö Airport', 'Sweden', 'Malmö')
    INTO airports (code, airport_name, country, city) VALUES ('ESSA', 'Stockholm Arlanda Airport', 'Sweden', 'Stockholm')
    INTO airports (code, airport_name, country, city) VALUES ('ESSB', 'Stockholm Bromma Airport', 'Sweden', 'Stockholm')
    -- Swiss airports
    INTO airports (code, airport_name, country, city) VALUES ('LFSB', 'EuroAirport Basel Mulhouse Freiburg', 'Switzerland', 'Basel')
    INTO airports (code, airport_name, country, city) VALUES ('LSGG', 'Geneva Airport', 'Switzerland', 'Geneva')
    INTO airports (code, airport_name, country, city) VALUES ('LSZH', 'Zurich Airport', 'Switzerland', 'Zürich')
    -- Turkish airports
    INTO airports (code, airport_name, country, city) VALUES ('LTAC', 'Ankara Esenboga Airport', 'Turkey', 'Ankara')
    INTO airports (code, airport_name, country, city) VALUES ('LTAI', 'Antalya Airport', 'Turkey', 'Antalya')
    INTO airports (code, airport_name, country, city) VALUES ('LTFM', 'Istanbul Airport', 'Turkey', 'Istanbul')
    -- Airports of the United Kingdom
    INTO airports (code, airport_name, country, city) VALUES ('EGNX', 'East Midlands Airport', 'England', 'Castle Donington')
    INTO airports (code, airport_name, country, city) VALUES ('EGGW', 'Luton Airport', 'England', 'Luton')
    INTO airports (code, airport_name, country, city) VALUES ('EGLC', 'London City Airport', 'England', 'London')
    INTO airports (code, airport_name, country, city) VALUES ('EGCC', 'Manchester Airport', 'England', 'Manchester')
    INTO airports (code, airport_name, country, city) VALUES ('EGNM', 'Leeds Bradford Airport', 'England', 'Leeds')
    INTO airports (code, airport_name, country, city) VALUES ('EGAA', 'Belfast International Airport', 'Northern Ireland', 'Aldergrove')
    INTO airports (code, airport_name, country, city) VALUES ('EGPD', 'Aberdeen International Airport', 'Scotland', 'Aberdeen')
    INTO airports (code, airport_name, country, city) VALUES ('EGPH', 'Edinburgh Airport', 'Scotland', 'Edinburgh')
    INTO airports (code, airport_name, country, city) VALUES ('EGPK', 'Glasgow International Airport', 'Scotland', 'Paisley')
    INTO airports (code, airport_name, country, city) VALUES ('EGFF', 'Cardiff Airport', 'Wales', 'Rhoose')
SELECT * FROM dual;