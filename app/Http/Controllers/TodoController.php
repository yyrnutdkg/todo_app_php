<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search-word');
        $query = Todo::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc');
        }else{
            $query->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc');
        }

        $todos = $query->get();
        return view('home', compact('todos', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_todo');
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
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'completed' =>'nullable',
            'due_date' => 'nullable|date|after:yesterday'
        ]);

        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->due_date = $request->input('due_date');
        $todo->user_id = Auth::user()-> id;
        $todo->save();

        return back()->with('success', 'タスクを作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return view('show_todo')->with('todo', $todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->first();
        return view('edit_todo', compact('todo'));
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
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'completed' =>'nullable',
            'due_date' => 'nullable|date|after:today'
        ]);

        $todo = Todo::find($id);
        if (auth()->user()->id != $todo->user_id) {
            return redirect(route('todo.index'))->with('error', '許可されていない操作です。');
        }
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->due_date = $request->input('due_date');

        if($request->has('completed')){
            $todo->completed = true;
        }else{
            $todo->completed = false;
        }

        $todo->save();

        return redirect(route('todo.index'))->with('success', 'タスクを修正しました');;
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
        if (auth()->user()->id != $todo->user_id) {
            return redirect(route('todo.index'))->with('error', '許可されていない操作です。');
        }

        $todo->delete();
        return redirect()->route('todo.index');
    }
}
