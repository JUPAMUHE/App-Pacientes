<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\TiposDocumento;
use App\Models\Genero;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('tiposDocumento', 'genero', 'departamento', 'municipio')->get();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $tipos_documento = TiposDocumento::all();
        $generos = Genero::all();
        $departamentos = Departamento::all();
        return view('pacientes.create', compact('tipos_documento', 'generos', 'departamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
            'numero_documento' => 'required|unique:pacientes',
            'nombre1' => 'required|string',
            'nombre2' => 'required|string',
            'apellido1' => 'required|string',
            'apellido2' => 'required|string',
            'genero_id' => 'required|exists:generos,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $nombreArchivo = Str::uuid() . '.' . $extension;
            $rutaImagen = $foto->storeAs('pacientes', $nombreArchivo, 'public');
            $data['foto'] = $rutaImagen;
        }
    
        Paciente::create($data);

        return redirect()->route('pacientes.index')->with('success', '¡Paciente registrado correctamente!.');
    }

    public function edit($id){
        $paciente = Paciente::findOrFail($id);
        $tipos_documento = TiposDocumento::all();
        $generos = Genero::all();
        $departamentos = Departamento::all();
        return view('pacientes.edit', compact('paciente', 'tipos_documento', 'generos', 'departamentos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
            'numero_documento' => 'required|unique:pacientes,numero_documento,' . $id,
            'nombre1' => 'required|string',
            'apellido1' => 'required|string',
            'genero_id' => 'required|exists:generos,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
    
        $paciente = Paciente::findOrFail($id);
    
        $data = $request->except(['foto']);
    
        if ($request->hasFile('foto')) {
            if ($paciente->foto && Storage::disk('public')->exists($paciente->foto)) {
                Storage::disk('public')->delete($paciente->foto);
            }
        
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $nombreArchivo = Str::uuid() . '.' . $extension;
            $rutaImagen = $foto->storeAs('pacientes', $nombreArchivo, 'public');
        
            $data['foto'] = $rutaImagen;
        }
    
        $paciente->update($data);
        return redirect()->route('pacientes.index')->with('success', '¡Paciente actualizado correctamente!');
    }
    

    public function destroy($id){
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', '¡Paciente eliminado correctamente!.');
    }
}
