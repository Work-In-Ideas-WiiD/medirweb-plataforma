import pandas as pd
import csv

ficheiro = open('novo.csv', 'r')
reader = csv.reader(ficheiro)
for linha in reader:
    print(linha)