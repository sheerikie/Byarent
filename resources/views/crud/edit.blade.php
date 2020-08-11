@extends('layout')
   
@section('content')
<main id="main">
    <!-- ======= Intro Single ======= -->
  <section class="intro-single">
   <div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Property</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('properties.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('properties.update',$property->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('put') }}
      
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $property->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $property->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    <select class="form-control" name="type">
                        <option value="1">Sell</option>
                        <option value="2">Rent</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="number" value="{{ $property->price }}" name="price" class="form-control" placeholder="Price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
    
    
                <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
                </div>
    
    
                <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
                </div>
    
                <strong>Add Image Url:</strong>
                <p></p>
                <div class="table-responsive">  
                    <table class="table table-bordered" id="dynamic_field">  
                        <tr>  
                            <td><input type="text" name="image[]" placeholder="Enter Image Src" class="form-control name_list" /></td>  
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                        </tr>  
                    </table>  
                  
                </div>
    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
   </div>
  </section>
</main>
@endsection