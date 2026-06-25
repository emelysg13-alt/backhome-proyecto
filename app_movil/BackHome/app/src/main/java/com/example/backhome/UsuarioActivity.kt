package com.example.backhome

import android.app.AlertDialog
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.backhome.adapters.ReporteAdapter
import com.example.backhome.api.RetrofitClient
import kotlinx.coroutines.launch

class UsuarioActivity : AppCompatActivity() {

    private lateinit var adapter: ReporteAdapter
    private var clienteId = 0

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_usuario)

        clienteId = intent.getIntExtra("cliente_id", 0)

        val recycler = findViewById<RecyclerView>(R.id.recyclerMisReportes)
        val btnCrear = findViewById<Button>(R.id.btnCrearReporteUsuario)

        recycler.layoutManager = LinearLayoutManager(this)
        cargarMisReportes(recycler)

        btnCrear.setOnClickListener {
            mostrarDialogoCrear()
        }
    }

    private fun cargarMisReportes(recycler: RecyclerView) {
        lifecycleScope.launch {
            try {
                val reportes = RetrofitClient.api.misReportes(clienteId)
                adapter = ReporteAdapter(reportes)
                recycler.adapter = adapter
            } catch (e: Exception) {
                Toast.makeText(this@UsuarioActivity, "Error al cargar reportes", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun mostrarDialogoCrear() {
        val view = layoutInflater.inflate(R.layout.dialog_reporte, null)
        val etTitulo = view.findViewById<EditText>(R.id.etTitulo)
        val etDescripcion = view.findViewById<EditText>(R.id.etDescripcion)
        val etEstado = view.findViewById<EditText>(R.id.etEstado)
        val etColor = view.findViewById<EditText>(R.id.etColor)
        val etSexo = view.findViewById<EditText>(R.id.etSexo)

        AlertDialog.Builder(this)
            .setTitle("Crear Reporte")
            .setView(view)
            .setPositiveButton("Crear") { _, _ ->
                lifecycleScope.launch {
                    try {
                        RetrofitClient.api.crearReporte(
                            titulo = etTitulo.text.toString(),
                            descripcion = etDescripcion.text.toString(),
                            estadoReporte = etEstado.text.toString(),
                            sexo = etSexo.text.toString(),
                            color = etColor.text.toString(),
                            descAnimal = etDescripcion.text.toString(),
                            clienteId = clienteId,
                            direccion = "Sin dirección"
                        )
                        Toast.makeText(this@UsuarioActivity, "Reporte creado", Toast.LENGTH_SHORT).show()
                        cargarMisReportes(findViewById(R.id.recyclerMisReportes))
                    } catch (e: Exception) {
                        Toast.makeText(this@UsuarioActivity, "Error al crear", Toast.LENGTH_SHORT).show()
                    }
                }
            }
            .setNegativeButton("Cancelar", null)
            .show()
    }
}