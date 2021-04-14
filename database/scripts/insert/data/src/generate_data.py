import random
import unidecode
import datetime
import bcrypt

class User:
    email_domains = ['gmail', 'yahoo', 'hotmail', 'msn', 'live', 'outlook']
    today_year = datetime.date.today().year
    area_codes = ['1', '20', '25', '30', '70']

    def __init__(self, name):
        self.name = name
        self.gen_email()
        self.gen_password()
        self.gen_birth_date()
        self.gen_address()
        self.gen_phone_num()

    def gen_email(self):
        prefix = unidecode.unidecode(self.name.lower().replace(' ', ''))
        domain = User.email_domains[random.randint(0, len(User.email_domains) - 1)]

        self.email = prefix + '@' + domain + '.com'        

    def gen_password(self):
        pwd = unidecode.unidecode(self.name.lower().replace(' ', ''))

        self.password = pwd

    def gen_birth_date(self):
        year = random.randint(1940, User.today_year - 18)
        month = random.randint(1, 12)

        if month == 2:
            day = random.randint(1, 28)
        elif month == 4 or 6 or 9 or 11:
            day = random.randint(1, 30)
        else:
            day = random.randint(1, 31)
            
        self.birth_date = str(year) + '-' + ('0' if month / 10 < 1 else '') + str(month) + '-' + ('0' if day / 10 < 1 else '') + str(day)

    def gen_address(self):
        cities = []
        addresses = []
        suffixes = []

        with open('cities.txt', 'r', encoding='utf-8') as f:
            for l in f:
                cities.append(l.strip())

        city = cities[random.randint(0, len(cities) - 1)].split(',')

        self.post_code = city[0]
        self.city = city[1]

        with open('addresses.txt', 'r', encoding='utf-8') as f:
            for l in f:
                addresses.append(l.strip())

        address = addresses[random.randint(0, len(addresses) - 1)]

        with open('address_suffixes.txt', 'r', encoding='utf-8') as f:
            for l in f:
                suffixes.append(l.strip())

        suffix = suffixes[random.randint(0, len(suffixes) - 1)]

        self.address = address + ' ' + suffix

    def gen_phone_num(self):
        area_code = User.area_codes[random.randint(0, len(User.area_codes) - 1)]
        number = str(random.randint(0, 999999 if area_code == '25' else 9999999))

        phone_number = '+36' + area_code

        for _ in range(0, 6 - len(number) if area_code == '25' else 7 - len(number)):
            phone_number += '0'

        self.phone_num = phone_number + number

    def __str__(self):
        s = self.name + ' (' + self.birth_date + '):\n'
        s += '\tE-mail: ' + self.email + '\n'
        s += '\tPassword: ' + self.password + '\n'
        s += '\tAddress: ' + self.post_code + ' ' + self.city + ', ' + self.address + '\n'
        s += '\tPhone number: ' + self.phone_num + '\n'

        return s

def read_names(f_names, l_names):
    first_names_file = input('Keresztnevek listája (txt): ')
    last_names_file = input('Vezetéknevek listája (txt): ')

    with open('names/' + first_names_file + '.txt', 'r', encoding='utf-8') as first_names_f:
        for l in first_names_f:
            name = l.strip()
            f_names.append(name)

    with open('names/' + last_names_file + '.txt', 'r', encoding='utf-8') as last_names_f:
        for l in last_names_f:
            name = l.strip()
            l_names.append(name)

def generate_name(f_names, l_names):
    f_name = f_names[random.randint(0, len(f_names) - 1)]
    l_name = l_names[random.randint(0, len(l_names) - 1)]
    name = f_name + ' ' + l_name

    return name

def write_users(users):
    with open('../users.txt', 'w', encoding='utf-8') as f:
        for u in users:
            name = u.name.split(' ')

            f.write('INTO users (email, pwd, phone_num, first_name, last_name, birth_date, country, post_code, city, home_address, role_id) ')
            f.write('VALUES (')
            f.write('\'' + u.email + '\', ')
            f.write('\'' + u.password + '\', ')
            f.write('\'' + u.phone_num + '\', ')
            f.write('\'' + name[0] + '\', ')
            f.write('\'' + name[1] + '\', ')
            f.write('TO_DATE(\'' + u.birth_date + '\', \'yyyy-mm-dd\'), ')
            f.write('\'Hungary\', ')
            f.write('\'' + u.post_code + '\', ')
            f.write('\'' + u.city + '\', ')
            f.write('\'' + u.address + '\', ')
            f.write(str(0) + ')\n')

first_names = []
last_names = []

read_names(first_names, last_names)

users = []

for _ in range(100):
    user_name = generate_name(first_names, last_names)
    users.append(User(user_name))

for u in users:
    print(u)

write_users(users)