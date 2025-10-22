
#creando una función simple
#def saludar():
  #  print("Hola Gustavo, ¿Cómo estás?")

#ejecutando la función simple
#saludar()

#creando una función que tenga parámetros
def saludar(nombre,sexo):
    sexo = sexo.lower()
    if (sexo == "mujer"):
        adjetivo = "reina"
    elif (sexo == "hombre"):
        adjetivo = "Genio"
    else:
        adjetivo = 'amor'
    
    print(f"Hola {nombre}, mi {adjetivo} ¿Cómo estás?")

saludar("Camila","mujer")
saludar("Gustavo","hombre")
saludar("Fran","no binario")

#crear una función que retorne valores
def crear_contraseña_random (num):
    chars = "abcdefghij"
    num_entero = str(num)
    num = int(num_entero[0])
    c1 = num - 2
    c2 = num
    c3 = num - 5
    contraseña = f"{chars[c1]}{chars[c2]}{chars[c3]}{num*2}"
    return contraseña,num

#desempaquetando la función
password,primer_numero = crear_contraseña_random(981)

#mostrando los resultados obtenidos y los datos utilizados para obtenerlos
print(f"Tu contraseña nueva es: {password}")
print(f"El número utilizado para crearla fue: {primer_numero}")
