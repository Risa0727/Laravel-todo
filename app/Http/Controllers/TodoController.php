<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // orderByRaw('columnName is null asc'): NULLを後ろに回すことができる
      $todos = Todo::orderByRaw('deadline IS NULL ASC')->orderBy('deadline')->get();

      return view('todos.index', [
        'todos' => $todos,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'newTodo' => 'required|max:100',
          'newDeadline' => 'nullable|after:"now"',
        ]);

        Todo::create([
          'todo' => $request->newTodo,
          'deadline' => $request->newDeadline,
        ]);

        Toastr::success('New task has been added.');

        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);

        return view('todos.edit', [
          'todo' => $todo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'updateTodo' => 'required|max:100',
          'updateDeadline' => 'nullable|after:"now"',
        ]);

        $todo = Todo::find($id);

        $todo->todo = $request->updateTodo;
        $todo->deadline = $request->updateDeadline;

        $todo->save();

        Toastr::success('The task has been updated.');

        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        $todo->delete();

        Toastr::success('The task has been deleted.');
        
        return redirect()->route('todos.index');
    }
}
