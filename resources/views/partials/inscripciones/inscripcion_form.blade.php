<form method="post" action="{{ route('inscripcion') }}" id="formulario">
    @csrf
    @include('partials.alerts')
    <input type="hidden" name="action" value="manejar_formulario">
    <div class="row gtr-uniform">
        <div class="col-12"><input type="checkbox" name="terminos" id="terminos" required><label for="terminos">Hemos leído y aceptado las bases</label>
            <ul>
                <li><a href="{{ asset('/ediciones/edicion' . \App\Models\Edicion::getEdicionActual()->id . '/basesOlimpiada.pdf') }}" download >Bases de la Olimpiada Informática</a></li>
                <li><a href="{{ asset('/ediciones/edicion' . \App\Models\Edicion::getEdicionActual()->id . '/basesModding.pdf') }}" download >Bases del Modding Regional</a></li>
                <li><a href="{{ asset('/ediciones/edicion' . \App\Models\Edicion::getEdicionActual()->id . '/basesC3Gamer.pdf') }}" download >Bases del C3Gamer</a></li>
            </ul>
        </div>
        <x-inscripciones.select-centro />
        <div class="col-12">
            <input type="text" name="prof_resp" id="prof_resp" placeholder="Profesor responsable*" value="{{ old('prof_resp') }}" required/>
        </div>
        <div class="col-12">
            <input type="text" name="email_prof_resp" id="email_prof_resp" placeholder="Correo Profesor responsable*" value="{{ old('email_prof_resp') }}" required/>
        </div>
        <x-inscripciones.select-ciclo />

        <x-inscripciones.select-categoria />

        <div class="col-12 {{ old('grupo') ? '' : 'oculto' }} grupo">
            <input type="text" name="grupo" id="grupo" placeholder="Nombre del grupo*" value="{{ old('grupo') }}" required/>
        </div>

        <x-inscripciones.alumno />

        <div class="col-12">
            <ul class="actions">
                <li><input type="submit" class="primary" value="Enviar Inscripción" /></li>
                <li><input type="reset" value="Reiniciar Formulario" /></li>
            </ul>
        </div>
        <span>(Los campos con * son obligatorios)</span>
    </div>
</form>
