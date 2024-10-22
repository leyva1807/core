<?php

namespace App\Http\Controllers\Admin;

use App\Models\TitularTarjeta;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TitularTarjetaRequest;
use Illuminate\Support\Facades\Log;

/**
 * Controlador para gestionar los titulares de tarjeta.
 */
class TitularTarjetaController extends Controller
{
    /**
     * Muestra un listado paginado de los titulares de tarjeta.
     */
    public function index()
    {
        $titularTarjetas = TitularTarjeta::paginate(10); // Pagina de 10 en 10
        $pageTitle = 'Titulares de Tarjetas'; // Título de la página

        return view('admin.titular-tarjeta.index', compact('titularTarjetas', 'pageTitle'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Índice de paginación
    }

    /**
     * Muestra el formulario para crear un nuevo titular de tarjeta.
     */
    public function create()
    {
        return view('admin.titular-tarjeta.create', ['titularTarjeta' => new TitularTarjeta()]);
    }

    /**
     * Almacena un nuevo titular de tarjeta en la base de datos.
     */
    public function store(TitularTarjetaRequest $request): RedirectResponse
    {
        try {
            TitularTarjeta::create($request->validated()); // Almacena datos validados
            return redirect()->route('TitularTarjeta.index')
                ->with('success', 'Titular de tarjeta creado correctamente.');
        } catch (\Exception $e) {
            Log::error("Error al crear el titular: " . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear el titular.');
        }
    }

    /**
     * Muestra los detalles de un titular específico.
     */
    public function show($id)
    {
        try {
            $titularTarjeta = TitularTarjeta::findOrFail($id); // Obtiene o lanza excepción
            return view('admin.titular-tarjeta.show', compact('titularTarjeta'));
        } catch (\Exception $e) {
            Log::error("Error al mostrar el titular: " . $e->getMessage());
            return redirect()->route('TitularTarjeta.index')
                ->with('error', 'Titular no encontrado.');
        }
    }

    /**
     * Muestra el formulario para editar un titular de tarjeta.
     */
    public function edit($id)
    {
        try {
            $titularTarjeta = TitularTarjeta::findOrFail($id); // Busca por ID
            return view('admin.titular-tarjeta.edit', compact('titularTarjeta'));
        } catch (\Exception $e) {
            Log::error("Error al cargar el formulario de edición: " . $e->getMessage());
            return redirect()->route('TitularTarjeta.index')
                ->with('error', 'Titular no encontrado.');
        }
    }

    /**
     * Actualiza la información del titular en la base de datos.
     */
    public function update(TitularTarjetaRequest $request, TitularTarjeta $titularTarjeta)
    {
        try {
            $titularTarjeta->update($request->validated()); // Actualiza con datos validados
            return redirect()->route('TitularTarjeta.index')
                ->with('success', 'Titular de tarjeta actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error("Error al actualizar el titular: " . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar el titular.');
        }
    }

    /**
     * Elimina un titular de tarjeta de la base de datos.
     */
    public function destroy($id)
    {
        try {
            $titularTarjeta = TitularTarjeta::findOrFail($id);
            $titularTarjeta->delete(); // Elimina el registro
            return redirect()->route('TitularTarjeta.index')
                ->with('success', 'Titular de tarjeta eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error("Error al eliminar el titular: " . $e->getMessage());
            return redirect()->route('TitularTarjeta.index')
                ->with('error', 'Error al eliminar el titular.');
        }
    }
}