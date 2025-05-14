<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resultado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'palmares',
    ];

    public function edicion()
    {
        return $this->belongsTo(Edicion::class, 'id');
    }

    /**
     * Genera el contenido inicial del campo palmarés como una tabla HTML.
     *
     * @return string
     */
    public static function getPalmaresEsqueleto()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        $html = '<table class="table table-bordered">';
        $html .= '<thead><tr>';

        // Encabezado de la tabla con los nombres de las categorías
        foreach ($categorias as $categoria) {
            $html .= '<th>' . htmlspecialchars($categoria->nombre) . '</th>';
        }

        $html .= '</tr></thead>';
        $html .= '<tbody><tr>';

        // Cuerpo de la tabla con listas numeradas vacías
        foreach ($categorias as $categoria) {
            $html .= '<td><ol>';
            for ($i = 1; $i <= 3; $i++) {
                $html .= '<li>Vencedor ' . $i . '</li>';
            }
            $html .= '</ol></td>';
        }

        $html .= '</tr></tbody>';
        $html .= '</table>';

        return $html;
    }

    public static function getResultadosMoodle()
    {
        // Necesito hacer una consulta con una conexión distinta a la que Laravel tiene por defecto y hacer una consulta a una vista

        $resultados = DB::connection('moodle')->table('resultadosolimpiadas')->get();
        return $resultados;
    }
}
