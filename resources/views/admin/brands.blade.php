@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Brands</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.index') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Brands</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <a class="tf-button style-1 w208" href="{{ route('admin.brands-add') }}"><i
                        class="icon-plus"></i>Add new</a>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    @if(Session::has('status'))
                        <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Products</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand )
                            <tr>
                                <!-- <td>{{ $loop->iteration }}</td> -->
                                <td>{{ $brand->brand_id }}</td> 
                                <td>
                                    <div class="image">
                                        <img src="{{asset('uploads/brands')}}/{{$brand->image}}" alt="{{$brand->name}}" class="image">
                                    </div>
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{ $brand->name }}</a>
                                    </div>
                                </td>
                                <td>{{ $brand->slug }}</td>
                                <td><a href="#" target="_blank">1</a></td>
                                <td>
                                    <div class="list-icon-function">
                                        <a href="{{ route('admin.brands-edit', ['brand_id'=> $brand->brand_id])}}" 
                                                <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                            <form action="{{ route('admin.brands-delete',['brand_id'=> $brand->brand_id])}}" method="POST"> 
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{$brands->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("scripts")
<script>
    $(document).ready(function(){
        $('.delete').on('click', function(e){
            e.preventDefault(); 
            var form =  $(this).closest('form'); 
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data",
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            }).then(function(result) {
                if (result) {
                    form.submit(); 
                }
            });
        });
    });
</script>
@endpush