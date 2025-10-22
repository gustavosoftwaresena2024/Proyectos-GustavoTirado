import csv

with open("archivos\\datos.csv.txt") as archivo:
    reader = csv.reader(archivo)
    for row in reader:
        print(row)