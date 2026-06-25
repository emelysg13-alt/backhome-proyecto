package com.example.backhome.api

import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory

object RetrofitClient {

    // Si pruebas en emulador usa 10.0.2.2
    // Si pruebas en celular real cambia por la IP de tu PC
    private const val URL = "http://10.0.2.2/backhome_api/"
    val api: ApiService by lazy {
        Retrofit.Builder()
            .baseUrl(URL)
            .addConverterFactory(GsonConverterFactory.create())
            .build()
            .create(ApiService::class.java)
    }
}