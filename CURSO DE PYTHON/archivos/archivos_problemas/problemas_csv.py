#cambiar el tipo de datos de una columna
import pandas as pd
df = pd.read_csv("archivos_problemas\\datos.csv.txt")

#convertir a string los datos de una columna
df['edad'] = df['edad'].astype(str)

#mostrar el tipo de datos del primer elemento de la columna edad
#print(type(df['edad'][0]))

#reemplazando los datos"Molina" por "Genio"
df['apellido'].replace("Molina","Genio",inplace=True)

#eliminando las filas con datos vacios
df = df.dropna()

#eliminando las filas repetidas
df = df.drop_duplicates()

#creando un CSV con el dataframe resultante (limpio)
df.to_csv("archivos_problemas\\datos_limpios.csv.txt") 

print(df)

#mostrando la columna apellido
#print(df['apellido'])