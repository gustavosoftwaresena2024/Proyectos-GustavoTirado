import pandas as pd 

#usando la funcion read_csv para leer el archivo csv
df = pd.read_csv("archivos\\datos.csv.txt")
df2 = pd.read_csv("archivos\\datos.csv.txt")

#obteniendo los datos de la columna nombre
nombres = df["nombre"]

#cadena = "0123456789"
#print(cadena[2:7])

#ordenando el dataframe por ela edad
df_orden_ascendente = df.sort_values("edad")

#ordenandolo de forma descendente
df_orden_descendente = df.sort_values("edad",ascending=False) 

#concatenando los 2 dataframes
df_concatenado = pd.concat([df,df2],)

#accediendo a las primeras 3 fila con head()
primeras_filas = df.head(3)

#accediendoa las últimas 3 filas con tail()
ultimas_filas = df.tail(3)

#accediendo a la cantidad de filas y columnas con shape
filas_totales,columnas_totales = df.shape

#obteniendo data estadistica del dataframe:
df_info = df.describe()

#accediendo a la edad de la fila 2  
elemento_especifico_loc = df.loc[2,"edad"]

#accediendo a la edad de la fila 2 con iloc
elemento_especifico_iloc = df.iloc[2,2]

#accediendo a todos los apellidos con loc
apellidos_loc = df.loc[:,"apellido"]

#accediendo a todos los apellidos con loc
apellidos = df.iloc[:,1]

#accediendo a la fila 3 con loc
fila_3 = df.loc[2,:]

#accediendo a la fila 3 con iloc
fila_3 = df.iloc[2,:]

#accediendo a la filas con edad mayor que 30
mayor_que_30 = df.loc[df["edad"]<30,:]

print(mayor_que_30)

