<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdicionFileController extends Controller
{
    private function basePath(Edicion $edicion): string
    {
        return "ediciones/edicion{$edicion->id}";
    }

    public function index(Edicion $edicion)
    {
        $files = collect(Storage::disk('public')->files($this->basePath($edicion)))
            ->map(fn($path) => [
                'name'         => basename($path),
                'size'         => Storage::disk('public')->size($path),
                'last_modified'=> Storage::disk('public')->lastModified($path),
                'delete_url'   => route('admin.ediciones.files.destroy', [$edicion, basename($path)]),
            ]);

        return response()->json($files);
    }

    public function store(Request $request, Edicion $edicion)
    {
        $request->validate([
            'files.*' => 'required|file|max:20480', // 20 MB por archivo
        ]);

        $uploaded = [];
        foreach ($request->file('files') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs($this->basePath($edicion), $name, 'public');
            $uploaded[] = $name;
        }

        return response()->json(['uploaded' => $uploaded]);
    }

    public function destroy(Edicion $edicion, string $file)
    {
        $path = $this->basePath($edicion) . '/' . $file;

        abort_unless(Storage::disk('public')->exists($path), 404);

        Storage::disk('public')->delete($path);

        return response()->json(['deleted' => $file]);
    }
}
