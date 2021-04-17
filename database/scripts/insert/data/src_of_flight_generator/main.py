""" Python kód járatok generálására """


username = 'Szombati'
password = '1234'
dsn = 'localhost/pdborcl'
port = 1512
encoding = 'UTF-8'

import cx_Oracle
cx_Oracle.init_oracle_client(lib_dir=r"C:\Oracle\instantclient_19_10")

connection = None
try:
    connection = cx_Oracle.connect(
        username,
        password,
        dsn,
        encoding=encoding)

    # show the version of the Oracle Database
    print(connection.version)
except cx_Oracle.Error as error:
    print(error)
finally:
    # release the connection
    if connection:
        connection.close()