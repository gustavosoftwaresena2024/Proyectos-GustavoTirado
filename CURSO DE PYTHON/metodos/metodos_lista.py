
#creando una conjunto con list()
conjunto = list([34,56,23,True])

#devuelve la cantidad de elementos de la conjunto 
cantidad_elemento = len(conjunto)

#agregando un elemento a la conjunto
conjunto.append(65)

#agregando un elemento a la conjunto en un indice especifico
conjunto.insert(2,"TOMA MAMA")

#agregando varios elementos a la conjunto
conjunto.extend([False,2030])

#eliminando un elemento de conjunto (por su indice)
conjunto.pop(3) #-1 para eliminar el último, -2 para eliminar el anteúltimo, y así sucecivamente

#removiendo un elemento de la conjunto por su valor 
conjunto.remove("TOMA MAMA")

#eliminando todos los elementos de la conjunto
#conjunto.clear()

#ordenando la conjunto de forma ascendente (si usamos el parámetro reverse=True lo ordena en el reversa)
conjunto.sort()

#inviertiendo los elementos de una conjunto
conjunto.reverse()

#verificando si un elemento esta en la conjunto
elemento_encontrado = list.index(56)

print()