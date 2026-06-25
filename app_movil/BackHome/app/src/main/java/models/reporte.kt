package com.example.backhome.models

data class Reporte(
    val id_seguimiento: Int,
    val titulo: String,
    val descripcion: String,
    val estado_reporte: String,
    val estado_moderacion: String,
    val fecha_publicacion: String,
    val primer_nombre: String,
    val primer_apellido: String,
    val color: String,
    val sexo: String,
    val desc_animal: String
)