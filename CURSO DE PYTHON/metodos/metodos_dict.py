diccionario = {
    "nombre" : 'Gustavo',
    "apellido" : 'Tirado',
    "subs" : 1000000
}

#nos devuelve un objeto dict_item
claves = diccionario.keys()

#obteniendo un elemento con get() (si no encuentra nada el programa continúa)
valor_de_kasdks = diccionario.get("kasdks")
print("hola papá, el programa continúa")

#eliminando todo el diccionario
#diccionario.clear()

#eliminando un elemento del diccionario
diccionario.pop("nombre")

#obteniendo un elemento dict_items iterable
diccionario_iterable = diccionario.items()

print(diccionario_iterable)