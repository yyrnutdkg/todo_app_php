@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todoリスト一覧</div>
                <h5 class="card-header">
                    <a href="{{ route('todo.create')}}" class="btn btn-outline-success">Todoを追加する！</a>
                </h5>
                <div class="search m-2">
                    <form method="GET" action="{{ route('todo.index')}}">
                        <input type="search"  name="search-word"  value="{{request('search')}}" placeholder="キーワードを入力">
                        <input type="submit" value="検索" class="btn btn-outline-info">
                    </form>
                </div>


                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <table>
                    <thead>
                        <th>Todoリスト</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>タイトル</th>
                            <th>期限日</th>
                        </tr>
                        @forelse ($todos as $todo)
                        <tr>
                            <td>{{ $todo->title }}</td>
                            <td>{{ $todo->due_date }}</td>
                            <td>
                                <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-outline-success">詳細</a>
                            </td>
                            <td>
                                <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-outline-primary">編集</a>
                            </td>
                            <td>
                                <form action="{{ route('todo.destroy', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>タスクはありません！</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
