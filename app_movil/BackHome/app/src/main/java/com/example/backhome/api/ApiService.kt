package com.example.backhome.api

import com.example.backhome.models.Persona
import com.example.backhome.models.Reporte
import com.example.backhome.models.Usuario
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.GET
import retrofit2.http.POST
import retrofit2.http.Query

interface ApiService {

    @FormUrlEncoded
    @POST("login.php")
    suspend fun login(
        @Field("email") email: String,
        @Field("password") password: String
    ): Persona

    @GET("reportes.php")
    suspend fun obtenerReportes(
        @Query("busqueda") busqueda: String = ""
    ): List<Reporte>

    @GET("mis_reportes.php")
    suspend fun misReportes(
        @Query("cliente_id") clienteId: Int
    ): List<Reporte>

    @FormUrlEncoded
    @POST("crear_reporte.php")
    suspend fun crearReporte(
        @Field("titulo") titulo: String,
        @Field("descripcion") descripcion: String,
        @Field("estado_reporte") estadoReporte: String,
        @Field("sexo") sexo: String,
        @Field("color") color: String,
        @Field("desc_animal") descAnimal: String,
        @Field("cliente_id") clienteId: Int,
        @Field("direccion") direccion: String
    ): Persona

    @FormUrlEncoded
    @POST("eliminar_reporte.php")
    suspend fun eliminarReporte(
        @Field("id_seguimiento") idSeguimiento: Int
    ): Persona

    @FormUrlEncoded
    @POST("aprobar_reporte.php")
    suspend fun aprobarReporte(
        @Field("id_seguimiento") idSeguimiento: Int,
        @Field("estado_moderacion") estadoModeracion: String
    ): Persona

    @FormUrlEncoded
    @POST("editar_reporte.php")
    suspend fun editarReporte(
        @Field("id_seguimiento") idSeguimiento: Int,
        @Field("titulo") titulo: String,
        @Field("descripcion") descripcion: String,
        @Field("estado_reporte") estadoReporte: String,
        @Field("color") color: String,
        @Field("sexo") sexo: String
    ): Persona

    @FormUrlEncoded
    @POST("usuarios.php")
    suspend fun obtenerUsuarios(
        @Field("accion") accion: String = "listar"
    ): List<Usuario>

    @FormUrlEncoded
    @POST("usuarios.php")
    suspend fun cambiarEstadoUsuario(
        @Field("accion") accion: String = "cambiar_estado",
        @Field("id_persona") idPersona: Int,
        @Field("estado") estado: String
    ): Persona
}