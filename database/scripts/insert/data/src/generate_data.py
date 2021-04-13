import random
import unidecode
import datetime

class User:
    email_domains = ['gmail', 'yahoo', 'hotmail', 'msn', 'live', 'outlook']
    today_year = datetime.date.today().year

    def __init__(self, name):
        self.name = name
        self.gen_email()
        self.gen_password()
        self.gen_birth_date()
        self.gen_address()

    def gen_email(self):
        prefix = unidecode.unidecode(self.name.lower().replace(' ', ''))
        domain = User.email_domains[random.randint(0, len(User.email_domains) - 1)]

        self.email = prefix + '@' + domain + '.com'        

    def gen_password(self):
        self.password = unidecode.unidecode(self.name.lower().replace(' ', ''))

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

    def __str__(self):
        s = self.name + ' (' + self.birth_date + '):\n'
        s += '\tE-mail: ' + self.email + '\n'
        s += '\tPassword: ' + self.password + '\n'
        s += '\tAddress: ' + self.post_code + ' ' + self.city + ', ' + self.address + '\n'

        return s

def generate_name(f_names, l_names):
    f_name = f_names[random.randint(0, len(f_names) - 1)]
    l_name = l_names[random.randint(0, len(l_names) - 1)]
    name = f_name + ' ' + l_name

    return name

first_names = []
last_names = []

with open('names/first_names.txt', 'r', encoding='utf-8') as first_names_f:
    for l in first_names_f:
        name = l.strip()
        first_names.append(name)

with open('names/last_names.txt', 'r', encoding='utf-8') as last_names_f:
    for l in last_names_f:
        name = l.strip()
        last_names.append(name)

users = []

for _ in range(100):
    user_name = generate_name(first_names, last_names)
    users.append(User(user_name))

for u in users:
    print(u)