import random

first_names = []

f = open('first_names_all.txt', 'r', encoding='utf-8')

for l in f:
    r = random.random()

    if r < 0.046 and l[0] != '-': # approx. 200 names
        first_names.append(l)

f.close()

f = open('first_names.txt', 'w', encoding='utf-8')

for name in first_names:
    f.write(name)

f.close()