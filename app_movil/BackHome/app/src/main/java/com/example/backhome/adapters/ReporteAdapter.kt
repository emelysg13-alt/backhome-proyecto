package com.example.backhome.adapters

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.backhome.R
import com.example.backhome.models.Reporte

class ReporteAdapter(
    private var lista: List<Reporte>,
    private val onAprobar: ((Reporte) -> Unit)? = null,
    private val onEditar: ((Reporte) -> Unit)? = null,
    private val onEliminar: ((Reporte) -> Unit)? = null
) : RecyclerView.Adapter<ReporteAdapter.ViewHolder>() {

    class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val titulo: TextView = view.findViewById(R.id.tvTitulo)
        val estado: TextView = view.findViewById(R.id.tvEstado)
        val moderacion: TextView = view.findViewById(R.id.tvModeracion)
        val nombre: TextView = view.findViewById(R.id.tvNombre)
        val animal: TextView = view.findViewById(R.id.tvAnimal)
        val fecha: TextView = view.findViewById(R.id.tvFecha)
        val btnAprobar: Button = view.findViewById(R.id.btnAprobar)
        val btnEditar: Button = view.findViewById(R.id.btnEditar)
        val btnEliminar: Button = view.findViewById(R.id.btnEliminar)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_reporte, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val reporte = lista[position]
        holder.titulo.text = reporte.titulo
        holder.estado.text = reporte.estado_reporte.uppercase()
        holder.moderacion.text = reporte.estado_moderacion.uppercase()
        holder.nombre.text = "${reporte.primer_nombre} ${reporte.primer_apellido}"
        holder.animal.text = "${reporte.sexo} - ${reporte.color}"
        holder.fecha.text = reporte.fecha_publicacion

        // Si no hay funciones de admin, oculta los botones
        if(onAprobar == null){
            holder.btnAprobar.visibility = View.GONE
            holder.btnEditar.visibility = View.GONE
            holder.btnEliminar.visibility = View.GONE
        } else {
            holder.btnAprobar.setOnClickListener { onAprobar.invoke(reporte) }
            holder.btnEditar.setOnClickListener { onEditar?.invoke(reporte) }
            holder.btnEliminar.setOnClickListener { onEliminar?.invoke(reporte) }
        }
    }

    override fun getItemCount() = lista.size

    fun actualizarLista(nuevaLista: List<Reporte>) {
        lista = nuevaLista
        notifyDataSetChanged()
    }
}