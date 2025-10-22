ingreso_mensual = 81000
gasto_mensual = 80000

#if anidados y else if (elif)

if ingreso_mensual > 10000:
    if ingreso_mensual - gasto_mensual < 0:
        print("Oh no puede ser, estás en déficit")
    elif ingreso_mensual - gasto_mensual > 3000:
        print("Felicitaciones estás muy bien")
    else:
        print("Cuidado, estás gastando demasiado, y puedes quebrar financieramente")

elif ingreso_mensual > 1000:
    print("estás bien en latinoamérica")
    
elif ingreso_mensual > 500:
    print("estás bien en Argentina")

elif ingreso_mensual > 200:
    print("estás bien en Venezuela")

else:
    print("no estás bien económicamente")
   