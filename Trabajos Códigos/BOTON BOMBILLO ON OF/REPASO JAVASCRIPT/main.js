
var nombre = "Gustavo Tirado";
var altura = 170;

/*

var concatenacion = nombre + "" + altura;

var datos = document.getElementById("datos");
datos.innerHTML = `
<h1>Hola soy la caja de datos</h1>
<h2>Mi nombre es: ${nombre}</h2>
<h3>Mido: ${altura} cm</h3>
`;

if(altura >= 190){
    datos.innerHTML += `<h1>
    Eres una persona ALTA
    </h1>`
}else{
    datos.innerHTML += `<h1>
    Eres una persona BAJITA
    </h1>`;
}
for(var i= 2000; i<=2020; i++){
    // bloque de instrucciones 
    datos.innerHTML += "<h2>Estamos en el año: "+i;
}
*/

function MuestraMiNombre(nombre,altura){
    var misDatos = `
    <h1>Soy la caja de datos</h1>
    <h2>Mi nombre es: ${nombre}</h2>
    <h3>Mido: ${altura} cm</h3>
`;

    return misDatos; 
}

function imprimir(){
    var datos = document.getElementById("datos");
    datos.innerHTML = MuestraMiNombre("Gustavo Tirado", 170 cm);
}


imprimir();

var nombres = ['Gustavo', 'Esteban','Carlos'];
alert(nombres[1]);
