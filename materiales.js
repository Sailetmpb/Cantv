function editarMaterial(codigo, nombre, disponibilidad) {
    document.getElementById('es_edicion').value = "1";
    document.getElementById('codigo_material').value = codigo;
    document.getElementById('nombre_material').value = nombre;
    document.getElementById('disponibilidad_material').value = disponibilidad;
    
    // Opcional: Desplazamiento suave al formulario
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function eliminarMaterial(codigo) {
    if (confirm("¿Estás seguro de que deseas eliminar este material?")) {
        window.location.href = "eliminar_material.php?codigo=" + codigo;
    }
}