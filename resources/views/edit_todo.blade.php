@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $todo -> title }}の修正</div>
                <h5 class="card-header">
                    <a href="{{ route('todo.index')}}" class="btn btn-outline-success">戻る</a>
                </h5>

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
                  <form method="POST" action="{{ route('todo.update', $todo->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                      <label for="title">タイトル</label>
                      <input id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $todo->title }}" >
                      @error('title')
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="description">詳細メモ</label>
                      <textarea name="description" id="description" cols="30" rows="10" class="form-control" >{{ $todo->description }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="description">期限日</label>
                      <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $todo->due_date  }}" />
                      @error('title')
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        @if ($todo->completed)
                          <input type="checkbox" class="form-check-input" name="completed" id="completed" value="{{ $todo->completed }}" checked>
                        @else
                          <input type="checkbox" class="form-check-input" name="completed" id="completed" value="{{ $todo->completed }}">
                        @endif
                        <label for="completed">
                          完了したらチェック
                        </label>
                      </div>
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
