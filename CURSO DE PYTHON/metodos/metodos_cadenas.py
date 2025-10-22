cadena1 = "Hola,Genio,soy,Gustavo"
cadena2 = "Bienvenido Genio"

#convierte a mayúscula
mayusc = cadena1.upper()

#convierte a minúscula
minus = cadena1.lower()

#primera letra en mayúscula
primer_letra_mayusc = cadena1.capitalize()

#buscamos una cadena en otra cadena, si no hay coincidencias devuelve -1
busqueda_find = cadena1.find("G")

#buscamos una cadena en otra cadena, si no hay coincidencias lanza una excepción
busqueda_index = cadena1.index("a")

#si es númerico devuelve true, sino devolvemos false
es_numerico = cadena1.isnumeric()

#si es alfanúmerico devolvemos True, sino devolvemos False
es_alfanumerico = cadena1.isalpha()

#contamos las coincidencias de una  cadena,dentro de otra cadena, devuelve la cantidad de coincidencias 
contar_coincidencias = cadena1.count("o")

#contamos cuantos caracteres tiene una cadena 
contar_caracteres = len(cadena1)

#verificamos si una cadena empieza con otra cadena dada, si es así devuelve True
empieza_con = cadena1.startswith("H")

#verificamos si una cadena termina con otra cadena dada, si es así devuelve True
termina_con = cadena1.endswith("Gustavo")

#si el valor 1, se encuentra en la cadena original, reemplaza el valor 1 de la misma, por el valor 2
cadena_nueva = cadena1.replace(","," ")

#separar cadenas con la cadena que le pasemos
cadena_separada = cadena1.split(",")

print(cadena_separada[1])
