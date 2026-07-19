// Definimos los datos con el nombre regionesEstados
const regionesEstados = {
    "Región Capital": ["Distrito Capital", "Miranda", "La Guaira"],
    "Región Central": ["Aragua", "Carabobo", "Cojedes"],
    "Región Andes": ["Mérida", "Táchira", "Trujillo"],
    "Región Llanos": ["Apure", "Barinas", "Guárico"],
    "Región Occidente": ["Falcón", "Lara", "Portuguesa", "Yaracuy", "Zulia"],
    "Región Oriente": ["Anzoátegui", "Monagas", "Nueva Esparta", "Sucre"],
    "Región Guayana": ["Bolívar", "Amazonas", "Delta Amacuro"]
};

// Función que llena los estados al cambiar la region
function cargarEstados() {
    const region = document.getElementById("region").value;
    const estadoSelect = document.getElementById("estado");
    
    estadoSelect.innerHTML = '<option value="">Seleccione el estado</option>';

    if (region && regionesEstados[region]) {
        regionesEstados[region].forEach(function(estado) {
            let option = document.createElement("option");
            option.value = estado;
            option.textContent = estado;
            estadoSelect.appendChild(option);
        });
    }
}

// Inicializar regiones al cargar la pagina

document.addEventListener("DOMContentLoaded", () => {
    const selectRegion = document.getElementById("region");
    Object.keys(regionesEstados).forEach(region => {
        const option = document.createElement("option");
        option.value = region;
        option.textContent = region;
        selectRegion.appendChild(option);
    });
});

// Funcion para mostrar los datos en la tablas

function filtrarTabla() {
    let input = document.getElementById("buscador");
    let filter = input.value.toUpperCase();
    let table = document.getElementById("tablaRiesgosOperacionesRed");
    let tr = table.getElementsByTagName("tr");

    // Empezamos desde 1 para saltar el encabezado
    for (let i = 1; i < tr.length; i++) {
        let mostrarFila = false;
        let celdas = tr[i].getElementsByTagName("td");
        
        // Recorremos todas las celdas de la fila
        for (let j = 0; j < celdas.length; j++) {
            if (celdas[j]) {
                let txtValue = celdas[j].textContent || celdas[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    mostrarFila = true;
                    break; // Si encuentra coincidencia en cualquier columna, muestra la fila
                }
            }
        }
        tr[i].style.display = mostrarFila ? "" : "none";
    }
}

//Funcion que utilizaremos para exportar la tabla a un archivo que pueda abrirse en Excel

function exportarExcel() {
    let tabla = document.getElementById("tablaRiesgos"); // Asegúrate que tu tabla tenga este ID
    let contenido = tabla.outerHTML;
    
    // Crear un blob para la descarga
    let blob = new Blob(['\ufeff', contenido], { type: 'application/vnd.ms-excel' });
    let url = URL.createObjectURL(blob);
    let a = document.createElement('a');
    
    a.href = url;
    a.download = "Reporte_Riesgos.xls";
    a.click();
}

//Funcion para eliminar riesgos

function eliminarRiesgo(id) {
    if (confirm("¿Estás seguro de que deseas eliminar el riesgo #" + id + "?")) {
        // Usamos fetch para llamar a un nuevo archivo PHP de eliminación
        fetch('eliminar_riesgo.php?id=' + id)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("Riesgo eliminado correctamente");
                    location.reload(); // Recargamos para que desaparezca de la tabla
                } else {
                    alert("Error al eliminar: " + data.message);
                }
            });
    }
}


// Funcion que permite filtrar los datos para su modificacion

function buscarParaEditar() {
    console.log("El botón funciona y la función inició");
    let id = document.getElementById('id_busqueda').value;

    // Solicitamos los datos al servidor
    fetch('buscar_riesgo.php?id=' + id)
        .then(res => res.json())
        .then(data => {
            console.log("Datos recibidos del servidor:", data);
            if(data.error) {
                alert("No se encontró el riesgo");
            } else {

                // funcion que nos sirve para poder llenar cualquier campo, sea input o select
                function llenarCampo(name, valor) {
                    let elemento = document.querySelector('[name="' + name + '"]');
                    if (elemento) {
                        elemento.value = valor;
                    }
                }

                // Rellenamos los campos del formulario principal
                llenarCampo('numero_riesgo', data.numero_riesgo);
                llenarCampo('numero_incidente', data.numero_incidente);
                // 1. Llenamos la región primero
                llenarCampo('region', data.region);

                // 2. Disparamos el evento para que se carguen los estados automáticamente
                document.getElementById('region').dispatchEvent(new Event('change'));

                // 3. Pequeña espera para que los estados se dibujen antes de seleccionarlos
                setTimeout(function() {
                    llenarCampo('estado', data.estado);
                }, 100);
                llenarCampo('raiz_riesgo', data.raiz_riesgo);
                llenarCampo('afectacion', data.afectacion);
                llenarCampo('tramos', data.tramos);
                llenarCampo('prioridad', data.prioridad);
                llenarCampo('tipo_ejecucion', data.tipo_ejecucion);
                llenarCampo('planificacion_inicial', data.planificacion_inicial);
                llenarCampo('mes_ingreso', data.mes_ingreso);
                llenarCampo('disponibilidad_material', data.disponibilidad_material);

                // activamos el modo edicion: cambiamos el campo oculto a 1
                document.getElementById('es_edicion').value = "1";
                
                // Cambiamos el texto del boton de guardar para usarlo como boton de actualizar
                document.getElementById('btn-guardar').innerText = "Actualizar Registro";
            }
        });
    }