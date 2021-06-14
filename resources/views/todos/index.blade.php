<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>ToDo lists</title>
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <script src="{{ asset('js/app.js') }}"></script>
      {{-- Toastr --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  </head>
  <body class="">
    <div class="container mt-3">
      <h1>ToDo List</h1>
    </div>
    <div class="container mt-3">
      <div class="container mb-4">
      {!! Form::open(['route' => 'todos.store', 'method' => 'POST']) !!}
      {{ csrf_field() }}
      <div class="row">
        {{ Form::text('newTodo', null, ['class' => 'form-control col-8 mr-5']) }}
        {{ Form::date('newDeadline', null, ['class' => 'mr-5'])}}
        {{ Form::submit('Add New', ['class' => 'btn btn-primary']) }}
      </div>
      {!! Form::close() !!}
      </div>
      {{-- Display an error --}}
      @if ($errors->has('newTodo'))
        <p class='alert alert-danger'>{{ $errors->first('newTodo') }} </p>
      @endif

      @if ($errors->has('newDeadline'))
        <p class='alert alert-danger'>{{ $errors->first('newDeadline') }}</p>
      @endif

      <table class='table'>
        <thead>
          <tr>
            <th scope='col' style='width:60%'>ToDo</th>
            <th scope='col'>Limit</th>
            <th scope='col'></th>
            <th scope='col'></th>
          </tr>
        </thead>
        <tbody>
          @foreach($todos as $todo)
            <tr>
              <th scope='row' class='todo'>{{ $todo->todo }}</th>
              <td>{{ $todo->deadline }}</td>
              <td><a href=" {{ route('todos.edit', $todo->id) }} " class='btn btn-primary'>Edit</a></td>
              {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST']) !!}
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
                <td>{{ Form::submit('Delete'), ['class' => 'btn btn-danger'] }}</td>
              {!! Form::close() !!}
           </tr>
          @endforeach
        </tbody>
      </table>
    </div>
{!! Toastr::message() !!}
  </body>
</html>
