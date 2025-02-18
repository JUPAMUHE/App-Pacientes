<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\TiposDocumento;
use App\Models\Genero;
use App\Models\Departamento;
use App\Models\Municipio;

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
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', '¡Paciente registrado correctamente!.');
    }

    public function edit($id){
        $paciente = Paciente::findOrFail($id);
        $tipos_documento = TiposDocumento::all();
        $generos = Genero::all();
        $departamentos = Departamento::all();
        return view('pacientes.edit', compact('paciente', 'tipos_documento', 'generos', 'departamentos'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
            'numero_documento' => 'required|unique:pacientes,numero_documento,' . $id,
            'nombre1' => 'required|string',
            'apellido1' => 'required|string',
            'genero_id' => 'required|exists:generos,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', '¡Paciente actualizado correctamente!.');
    }

    public function destroy($id){
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', '¡Paciente eliminado correctamente!.');
    }
}
