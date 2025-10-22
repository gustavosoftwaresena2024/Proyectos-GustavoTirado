
#abriendo el archivo con with open 
with open("archivos\\texto_gustavo.txt",encoding="UTF-8") as archivo:
    
    #leemos el archivo
    contenido = archivo.read()
    
    #mostramos el archivo
    print(contenido)
    
#no es necesario cerrarlo al usar with open
    