@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">タスクの追加</div>
                <h5 class="card-header">
                    <a href="{{ route('todo.index')}}" class="btn btn-outline-success">戻る</a>
                </h5>

                <div class="card-body">
                  <form method="POST" action="{{ route('todo.store') }}">
                    @csrf

                    <div class="form-group">
                      <label for="title">タイトル</label>
                      <input id="title" name="title" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label for="description">詳細メモ</label>
                      <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">
                        登録する
                      </button>
                    </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
