@extends('layout')
 
@section('content')

<main id="main">
    <!-- ======= Intro Single ======= -->
  <section class="intro-single">
   <div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('properties.create') }}"> Create New Property</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($properties as $property)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $property->name }}</td>
            <td>{{ $property->description }}</td>
            <td>
                <form action="{{ route('properties.destroy',$property->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('properties.show',$property->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('properties.edit',$property->id) }}">Edit</a>
   
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $properties->links() !!}
   </div>
  </section>
</main> 
@endsection