
#le pedimos al usuario que nos diga una frase (o varias)
frase = input("Dí una frase genio, y te calculo cuánto tardarías si tuvieras que decirla: ")

#creamos una conjunto con todas las palabras de la frase (se separan cada vez que haya un espacio en blanco)
palabras_separadas = frase.split(" ")

#usamos len() para ver la cantidad de elementos que hay en la conjunto
cantidad_de_palabras = len(palabras_separadas)

#en caso que tarde más de un minuto en decirlo, le decimos que pare un poco
if cantidad_de_palabras > 120:
    print("Un momento, tampoco de pedí un testamento")

#calculamos cuánto tardaría en decir las palabras y se lo decimos
print(f'Dijiste {cantidad_de_palabras} palabras, y tardarias {cantidad_de_palabras/2} segundos en decirlo')
print(f'Gustavo lo diria en {cantidad_de_palabras * 100 // 2*1.3 / 100} segundos')
