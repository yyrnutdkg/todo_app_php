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
                        <td>本を読む</td>
                        <td>
                            <a href="" class="btn btn-outline-primary">編集</a>
                            <a href="" class="btn btn-outline-danger">削除</a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
