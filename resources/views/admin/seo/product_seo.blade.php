@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                 <h3>Update Product Page SEO</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('product.seo.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="hidden" name="seo_id" value="{{$seos->id}}">
                            <input type="text" class="form-control" name="title" value="{{$seos->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" class="form-control" name="desp" value="{{$seos->desp}}">
                        </div>
                        <div class="mb-3">
                            <label>Tag</label>
                            <input type="text" class="form-control" name="tag" value="{{$seos->tag}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update SEO</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection