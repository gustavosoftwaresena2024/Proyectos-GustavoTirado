#creando una función de 3 parámetros
#def frase(nombre,apellido,adjetivo):
 #   return f'Hola {nombre} {apellido}, sos muy {adjetivo}'


#utilizando keyword arguments
#frase_resultante = frase("Gustavo","Molina","Genio")
#print(frase_resultante)

#creando la misma función con un parámetro opcional y unvalor por defecto
def frase(nombre,apellido,adjetivo = "tonto"):
    return f'Hola {nombre} {apellido}, sos muy {adjetivo}'
frase_resultante = frase("Gustavo","Molina",adjetivo="inteligente")
print(frase_resultante)