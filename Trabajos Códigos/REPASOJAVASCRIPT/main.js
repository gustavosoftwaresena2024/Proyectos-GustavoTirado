// Alertas
alert("Soy Gustavo Tirado,un gran programador");

// Variables
let nombre = "Gustavo Tirado";
nombre = "Gustavo";

// Constantes
const apellido = "Tirado";

// otra variable 
let altura = 168 ;

// Mostrar por consola 
console.log(nombre);
console.log(altura);    

// Concatenación 
let concatenacion = nombre + " " + apellido;

// Seleccionar las elementos de la página
let datos = document.querySelector("#datos");
datos.innerHTML = `
<hr/>
<h1>soy la caja de datos</h1>
<h2>Mi nombre es: ${concatenacion} </h2>
<h3>Mido: ${altura}</h3>
`;

// Condiciones 
altura = 160;
if (altura >= 168){
    datos.innerHTML += "<h1>Eres una persona alta";
}else{
    datos.innerHTML += "<h1>Eres una persona baja";
}


// Bucles
for(let year = 2000; year <= 2024; year++){
    datos.innerHTML += `<h2>Estamos en el año: ${year}</h2>`;
}

// Arrays
let nombres = ["Harold", "Stiven", "Maria"];

let divNombres = document.querySelector("#nombres");

divNombres.innerHTML = nombres [1];
// divNombres.innerHTML = nombres [2];
divNombres.innerHTML = "<h1>Listado de nombres</h1><ul>";

nombres.forEach(nombre => {
 divNombres.innerHTML += "<li>"+nombre+"</li>"
});

divNombres.innerHTML += "</ul>"


//Funciones 

const miInformación = (nombre, altura) => {
    let misDatos = `
    <hr/>
    <h1>Soy la caja de datos</h1>
    <h2>Mi nombre es: ${nombre} </h2>
    <h3>Mido: ${altura}</h3>
    `;

    return misDatos;
}


console.log(miInformación ("Gustavo Tirado", 168));

const imprimir = () => {
    let datos = document.querySelector("#datos");
    datos.innerHTML += miInformación("Gustavo Tirado", 168);
}

imprimir();
imprimir();
imprimir();
imprimir();

