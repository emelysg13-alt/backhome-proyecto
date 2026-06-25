package com.example.backhome.models

data class Usuario(
    val id_persona: Int,
    val primer_nombre: String,
    val primer_apellido: String,
    val email: String,
    val numero_tel: String,
    val estado: String,
    val rol: String?
)