@extends('layouts.dashboard')

@section('content')
    @can('add_work_way')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>All work way List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Work way</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($works as $sl=>$work)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$work->add_way}}</td>
                                <td>
                                    <a href="{{route('work.way.delete', $work->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add work way</h3>
                </div>
                @if (session('work'))
                    <div class="alert alert-success">{{session('work')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('work.way.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Add work way</label>
                            <input type="text" class="form-control" name="add_way">
                            @error('add_way')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add work way</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection