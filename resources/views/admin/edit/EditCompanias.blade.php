@extends('adminlte::page')
@section('content_header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop
@section('content')

    <form action="{{ route('Cenviar') }}" method="POST">
        @csrf
    <h2>Editar Companias</h2>
    <div class="row g-3">
      <div class="col-sm-3">
        <input type="hidden" name="id" value="{{$Stop->id}}"  >
      <input class="form-control form-control-lg" type="text"  placeholder="{{$Stop->company_name}}" aria-label=".form-control-lg example" name="company_name">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
    </form>
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

@stop