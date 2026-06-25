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
import com.example.backhome.adapters.UsuarioAdapter
import com.example.backhome.api.RetrofitClient
import com.example.backhome.models.Reporte
import kotlinx.coroutines.launch

class AdminActivity : AppCompatActivity() {

    private lateinit var reporteAdapter: ReporteAdapter
    private lateinit var usuarioAdapter: UsuarioAdapter
    private lateinit var recycler: RecyclerView
    private var viendoReportes = true

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_admin)

        recycler = findViewById(R.id.recyclerReportes)
        val etBusqueda = findViewById<EditText>(R.id.etBusqueda)
        val btnBuscar = findViewById<Button>(R.id.btnBuscar)
        val btnVerReportes = findViewById<Button>(R.id.btnVerReportes)
        val btnVerUsuarios = findViewById<Button>(R.id.btnVerUsuarios)
        val btnCrearReporte = findViewById<Button>(R.id.btnCrearReporte)

        recycler.layoutManager = LinearLayoutManager(this)

        // Carga reportes al inicio
        cargarReportes("")

        btnVerReportes.setOnClickListener {
            viendoReportes = true
            cargarReportes("")
        }

        btnVerUsuarios.setOnClickListener {
            viendoReportes = false
            cargarUsuarios()
        }

        btnBuscar.setOnClickListener {
            if(viendoReportes){
                cargarReportes(etBusqueda.text.toString())
            } else {
                cargarUsuarios()
            }
        }

        btnCrearReporte.setOnClickListener {
            mostrarDialogoCrearReporte()
        }
    }

    private fun cargarReportes(busqueda: String) {
        lifecycleScope.launch {
            try {
                val reportes = RetrofitClient.api.obtenerReportes(busqueda)
                reporteAdapter = ReporteAdapter(
                    reportes,
                    onAprobar = { reporte -> aprobarReporte(reporte) },
                    onEditar = { reporte -> mostrarDialogoEditar(reporte) },
                    onEliminar = { reporte -> eliminarReporte(reporte) }
                )
                recycler.adapter = reporteAdapter
            } catch (e: Exception) {
                Toast.makeText(this@AdminActivity, "Error al cargar reportes", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun cargarUsuarios() {
        lifecycleScope.launch {
            try {
                val usuarios = RetrofitClient.api.obtenerUsuarios()
                usuarioAdapter = UsuarioAdapter(usuarios) { usuario ->
                    val nuevoEstado = if(usuario.estado == "activo") "bloqueado" else "activo"
                    lifecycleScope.launch {
                        try {
                            RetrofitClient.api.cambiarEstadoUsuario(
                                idPersona = usuario.id_persona,
                                estado = nuevoEstado
                            )
                            Toast.makeText(this@AdminActivity, "Estado actualizado", Toast.LENGTH_SHORT).show()
                            cargarUsuarios()
                        } catch (e: Exception) {
                            Toast.makeText(this@AdminActivity, "Error", Toast.LENGTH_SHORT).show()
                        }
                    }
                }
                recycler.adapter = usuarioAdapter
            } catch (e: Exception) {
                Toast.makeText(this@AdminActivity, "Error al cargar usuarios", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun aprobarReporte(reporte: Reporte) {
        val opciones = arrayOf("Aprobar", "Rechazar")
        AlertDialog.Builder(this)
            .setTitle("Moderar reporte")
            .setItems(opciones) { _, which ->
                val estado = if(which == 0) "aprobado" else "rechazado"
                lifecycleScope.launch {
                    try {
                        RetrofitClient.api.aprobarReporte(reporte.id_seguimiento, estado)
                        Toast.makeText(this@AdminActivity, "Reporte $estado", Toast.LENGTH_SHORT).show()
                        cargarReportes("")
                    } catch (e: Exception) {
                        Toast.makeText(this@AdminActivity, "Error", Toast.LENGTH_SHORT).show()
                    }
                }
            }.show()
    }

    private fun eliminarReporte(reporte: Reporte) {
        AlertDialog.Builder(this)
            .setTitle("Eliminar reporte")
            .setMessage("¿Seguro que deseas eliminar '${reporte.titulo}'?")
            .setPositiveButton("Eliminar") { _, _ ->
                lifecycleScope.launch {
                    try {
                        RetrofitClient.api.eliminarReporte(reporte.id_seguimiento)
                        Toast.makeText(this@AdminActivity, "Reporte eliminado", Toast.LENGTH_SHORT).show()
                        cargarReportes("")
                    } catch (e: Exception) {
                        Toast.makeText(this@AdminActivity, "Error", Toast.LENGTH_SHORT).show()
                    }
                }
            }
            .setNegativeButton("Cancelar", null)
            .show()
    }

    private fun mostrarDialogoEditar(reporte: Reporte) {
        val view = layoutInflater.inflate(R.layout.dialog_reporte, null)
        val etTitulo = view.findViewById<EditText>(R.id.etTitulo)
        val etDescripcion = view.findViewById<EditText>(R.id.etDescripcion)
        val etEstado = view.findViewById<EditText>(R.id.etEstado)
        val etColor = view.findViewById<EditText>(R.id.etColor)
        val etSexo = view.findViewById<EditText>(R.id.etSexo)

        etTitulo.setText(reporte.titulo)
        etDescripcion.setText(reporte.descripcion)
        etEstado.setText(reporte.estado_reporte)
        etColor.setText(reporte.color)
        etSexo.setText(reporte.sexo)

        AlertDialog.Builder(this)
            .setTitle("Editar reporte")
            .setView(view)
            .setPositiveButton("Guardar") { _, _ ->
                lifecycleScope.launch {
                    try {
                        RetrofitClient.api.editarReporte(
                            idSeguimiento = reporte.id_seguimiento,
                            titulo = etTitulo.text.toString(),
                            descripcion = etDescripcion.text.toString(),
                            estadoReporte = etEstado.text.toString(),
                            color = etColor.text.toString(),
                            sexo = etSexo.text.toString()
                        )
                        Toast.makeText(this@AdminActivity, "Reporte actualizado", Toast.LENGTH_SHORT).show()
                        cargarReportes("")
                    } catch (e: Exception) {
                        Toast.makeText(this@AdminActivity, "Error", Toast.LENGTH_SHORT).show()
                    }
                }
            }
            .setNegativeButton("Cancelar", null)
            .show()
    }

    private fun mostrarDialogoCrearReporte() {
        val view = layoutInflater.inflate(R.layout.dialog_reporte, null)
        val etTitulo = view.findViewById<EditText>(R.id.etTitulo)
        val etDescripcion = view.findViewById<EditText>(R.id.etDescripcion)
        val etEstado = view.findViewById<EditText>(R.id.etEstado)
        val etColor = view.findViewById<EditText>(R.id.etColor)
        val etSexo = view.findViewById<EditText>(R.id.etSexo)

        AlertDialog.Builder(this)
            .setTitle("Crear reporte")
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
                            clienteId = 1,
                            direccion = "Sin dirección"
                        )
                        Toast.makeText(this@AdminActivity, "Reporte creado", Toast.LENGTH_SHORT).show()
                        cargarReportes("")
                    } catch (e: Exception) {
                        Toast.makeText(this@AdminActivity, "Error", Toast.LENGTH_SHORT).show()
                    }
                }
            }
            .setNegativeButton("Cancelar", null)
            .show()
    }
}