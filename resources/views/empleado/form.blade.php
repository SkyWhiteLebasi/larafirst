<h1>{{$modo}} empleados</h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
    <ul>
        @foreach ( $errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>


@endif
        

<div class="form-group">
<label for="nombre"> Nombre </label>
<input type="text" class="form-control" name="nombre" value=" {{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }} " id="nombre">

</div>

<div class="form-group">
<label for="apellido_p"> Apellido Paterno </label>
<input type="text" class="form-control" name="apellido_p" value="{{ isset($empleado->apellido_p)?$empleado->apellido_p:old('apellido_p') }}" id="apellido_p">

</div>
<div class="form-group">
<label for="apellido_m"> Apellido Materno </label>
<input type="text" class="form-control" name="apellido_m" value="{{isset($empleado->apellido_m)?$empleado->apellido_m:old('apellido_m') }}" id="apellido_m">

</div>
<div class="form-group">
<label for="correo"> Correo electrónico </label>
<input type="text" class="form-control"name="correo" value="{{ isset($empleado->correo)?$empleado->correo:old('correo') }}" id="correo">

</div>
<div class="form-group">
<label for="status"> Status </label>
<input type="text" class="form-control" name="status" value="{{ isset($empleado->status)?$empleado->status:old('status') }}" id="status">

</div>
<div class="form-group">
<label for="foto"> Foto </label>
@if(isset($empleado->foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto}}" width="100px" alt="">
@endif
<input type="file" class="form-control" name="foto" value="" id="foto">
</div>
<br>
<br>
<input type="submit" class="btn btn-primary" value="{{$modo}} datos">
<a href="{{ url('empleado/')}}" class="btn btn-success"> Regresar </a>