<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>ToDo - Edit</title>
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <script src="{{ asset('js/app.js') }}"></script>
  </head>
  <body class="">
    <div class="container mt-3">
      <h1>ToDo - Edit</h1>
    </div>
    <div class="container mt-3">
      <div class="container mb-4">
      {!! Form::open(['route' => ['todos.update', $todo->id], 'method' => 'POST']) !!}
      {{ csrf_field() }}
      {{ method_field('PUT') }}
        <div class="row">
          {{ Form::text('updateTodo', $todo->todo, ['class' => 'form-control col-7 mr-4']) }}
          {{ Form::date('updateDeadline', $todo->deadline, ['class' => 'mr-4']) }}
          {{ Form::submit('Update', ['class' => 'btn btn-primary mr-3']) }}
          <a href="{{ route('todos.index') }}" class="btn btn-danger">Back</a>
        </div>
      {!! Form::close() !!}
    </div>
      {{-- Display an error --}}
      @if ($errors->has('updateTodo'))
        <p class='alert alert-danger'>{{ $errors->first('updateTodo') }} </p>
      @endif

      @if ($errors->has('newDeadline'))
        <p class='alert alert-danger'>{{ $errors->first('newDeadline') }}</p>
      @endif
    </div>

  </body>
</html>
