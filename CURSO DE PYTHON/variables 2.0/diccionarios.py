#creando diccionarios con dict()
diccionario = dict(nombre="Gustavo",apellido="Molina",)

#las conjuntos no pueden ser claves y usamos frozenset para meter conjuntos
diccionario = {frozenset(["Gustavo","Molina","Colombia"])}

#creando diccionarios con fromkeys() con dos parametros
diccionario = dict.fromkeys(["nombre", "apellido"])

#creando diccionarios con fromkeys() con dos parametros
diccionario = dict.fromkeys(["nombre", "apellido"],"Colombia")

print(diccionario)