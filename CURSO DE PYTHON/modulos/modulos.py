#importando un modulo y asignandole el nombre "m_saludar"
#import modulo_saludar as m_saludar

#desde ese modulo importamos dos funciones
from modulo_saludar import saludar as saludar_normal,saludar_raro as saludar_como_coscu
import modulo_saludar as m_saludar

#creamos las variablescon los resultados
saludo = saludar_normal("Gustavo")
saludar_raro = saludar_como_coscu ("Fran")

#mostramos los resultados
print(saludo)
print(saludar_raro)

#para ver las propiedades  y metodos del namespace
#print(dir(m_saludar))

#accedemos al nombre de este modulo
#print(__name__)

#accedemos al nombre del módulo llamado
#print(m_saludar.__name__ == "cambio_de_nombre")