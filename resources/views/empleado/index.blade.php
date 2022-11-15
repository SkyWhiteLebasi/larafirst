@extends('layouts.app')

@section('content')
<div class="container">


    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
    @endif
    





<a href="{{ url('empleado/create')}}" type="button" class="btn btn-primary"> Registrar empleado</a>
<br>
<br>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Status</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
        <tr>
            
               
           
            <td> {{$empleado->id}} </td>
            <td> <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto}}" width="100px" alt=""></td>
            <td> {{$empleado->nombre}} </td>
            <td> {{$empleado->apellido_m}} </td>
            <td> {{$empleado->apellido_p}} </td>
            <td> {{$empleado->correo}} </td>
            <td> {{$empleado->status}} </td>
            <td> 
                <a href="{{ url('/empleado/'.$empleado->id.'/edit'),  }}" class="btn btn-warning">editar</a>
                 |
                <form action="{{ url('/empleado/'.$empleado->id) }}" class="d-inline" method ="POST">
                    @csrf
                    {{method_field('DELETE')}}
                    <input type="submit" class="btn btn-danger" onclick ="return confirm('¿quieres borrar we?')" value="borrar">
                </form>
            </td>
          
        </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links()!!} <!--en controlador de empleado, en la función index se tiene el paginate y este se realciona con links -->
</div>
@endsection