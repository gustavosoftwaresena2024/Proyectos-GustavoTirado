
#creando las listas
frutas = ["banana","manzana","ciruela","pera","naranja","granada","durazno"]
cadena = "Hola Gustavo"
numeros = [2,5,8,10]
#evitando que se coma una manzana con la sentencia continue
for fruta in frutas:
    if fruta == 'manzana':
        continue
    print(f'me voy a comer una {fruta}')
    
#evitar que el bucle siga ejecutandose (el else no se ejecuta)
for fruta in frutas:
    print(f'Me voy a comer una {fruta}')
    if fruta == 'pera':
       break 

else:
       print("terminado")

#recorrer una cadena de texto

for letra in cadena:
    print(letra)


#for en una sola línea de código (duplicamos los número)
numeros_duplicados = [x*2 for x in numeros]
print(numeros_duplicados)