@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <h5 class="card-header">
                    <a href="{{ route('todo.create')}}" class="btn btn-outline-success">Todoを追加する！</a>
                </h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <table>
                    <thead>
                        <th>Todoリスト</th>
                    </thead>
                    <tbody>
                      <tr>
                          <td>{{ $todo->title }}</td>
                          <td>{{ $todo->description }}</td>
                          @if ($todo->completed)
                            <td><p>タスク完了済</p></td>
                          @else
                            <td><p>タスク未完了</p></td>
                          @endif

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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection