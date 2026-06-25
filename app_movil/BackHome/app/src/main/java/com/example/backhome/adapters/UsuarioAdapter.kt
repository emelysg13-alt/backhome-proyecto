package com.example.backhome.adapters

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.backhome.R
import com.example.backhome.models.Usuario

class UsuarioAdapter(
    private var lista: List<Usuario>,
    private val onCambiarEstado: (Usuario) -> Unit
) : RecyclerView.Adapter<UsuarioAdapter.ViewHolder>() {

    class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val nombre: TextView = view.findViewById(R.id.tvNombreUsuario)
        val email: TextView = view.findViewById(R.id.tvEmailUsuario)
        val estado: TextView = view.findViewById(R.id.tvEstadoUsuario)
        val rol: TextView = view.findViewById(R.id.tvRolUsuario)
        val btnEstado: Button = view.findViewById(R.id.btnCambiarEstado)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_usuario, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val usuario = lista[position]
        holder.nombre.text = "${usuario.primer_nombre} ${usuario.primer_apellido}"
        holder.email.text = usuario.email
        holder.estado.text = usuario.estado.uppercase()
        holder.rol.text = usuario.rol ?: "sin rol"

        if(usuario.estado == "activo"){
            holder.btnEstado.text = "Inactivar"
            holder.btnEstado.backgroundTintList =
                android.content.res.ColorStateList.valueOf(android.graphics.Color.parseColor("#D32F2F"))
        } else {
            holder.btnEstado.text = "Activar"
            holder.btnEstado.backgroundTintList =
                android.content.res.ColorStateList.valueOf(android.graphics.Color.parseColor("#2E7D32"))
        }

        holder.btnEstado.setOnClickListener {
            onCambiarEstado(usuario)
        }
    }

    override fun getItemCount() = lista.size

    fun actualizarLista(nuevaLista: List<Usuario>) {
        lista = nuevaLista
        notifyDataSetChanged()
    }
}