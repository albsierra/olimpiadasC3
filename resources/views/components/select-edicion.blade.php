<div>
<form method="POST" action="{{ route('sessions.setEdicion') }}">
    @csrf
    <label for="edicion-select">Edición a mostrar:</label>
    <select id="edicion-select" name="edicion_id" onchange="this.form.submit()">
        @foreach ($ediciones as $edicion)
            <option value="{{ $edicion->id }}" {{ session('edicion') && session('edicion')->id == $edicion->id ? 'selected' : '' }}>
                {{ $edicion->curso_escolar }}
            </option>
        @endforeach
    </select>
</form>
</div>
