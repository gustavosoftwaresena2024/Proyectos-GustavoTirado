
#creando una conjunto se puede modificar 
#conjunto = ["Gustavo Tirado", "GustavoTMolina",True,1.70]

#creando una tupla no se puede modificar
#tupla = ("Gustavo Tirado", "GustavoTMolina",True,1.70 "GustavoTmolina")

#esto es válido
#conjunto[3] "Tavito"

#esto no es válido
#tupla[3] "Tavito"

#creando un conjunto (set) (no se accede a  elementos por su indice, no almacena duplicados)
#conjunto = {"Gustavo Tirado", "GustavoTMolina",True,1.70, "GustavoTMolina"}

#print(conjunto[3]) -> no puede acceder al elemento


#creando un diccionario (dict)
diccionario = {
    'nombre' : "Gustavo Tirado",
    'Instagram' : "GustavoTMolina",
    'esta_emocionado' : True,
    'altura' : 1.72,
    'dato_duplicado' : "GustavoTMolina"
}

print(diccionario['nombre'])