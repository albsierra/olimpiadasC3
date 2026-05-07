
<div class="col-12">
    <select name="categoria" id="categoria"  {{ $oldValue ? '' : 'disabled' }} required>
        <option value="" default>- Selecciona la categoría en la que participará el grupo/alumno -</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ $categoria->id == $oldValue ? 'selected' : '' }}>
                {{ $categoria->nombre }}
                @if(@isset($categoria->numInscritos) && $categoria->numInscritos > 0)
                    ({{ $categoria->numInscritos }} inscritos)
                @endif
            </option>
        @endforeach
    </select>
</div>
