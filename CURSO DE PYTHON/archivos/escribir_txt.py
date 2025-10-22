
with open('archivos\\texto_gustavo.txt','w',encoding="UTF-8") as archivo:
    #sobreescribiendo el archivo
    #archivo.write("Hola gustavo bienvenido a antioquia")
    
    #agregando 2 lineas con writelines
    archivo.writelines([" - Hola genio como estas\n"," - Colombia el mejor pais\n"])
    
    #agregando otras 2 lineas
    archivo.writelines([" - No se porque dijiste eso\n"," - yo tampoco"])