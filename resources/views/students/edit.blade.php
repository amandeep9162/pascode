@extends('students.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Student</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  <h1 class="alert alert-success " id="success-message"></h1>
    <form action="{{ route('students.update',$student->id) }}" enctype="multipart/form-data" id="editform" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$student->name}}" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control" >
            </div>
            <div class="form-group">
                <img src="{{ asset($student->image_path) }}" width="40">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject:</strong>
                <select class="form-control" name="subject" required>
                    <option value="">Select any subject</option>
                    @foreach($subjects as $subject)
                    <option value="{{$subject['id']}}" {{ ( $student->subject == $subject['id']) ? 'selected' : '' }}>{{$subject['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Score:</strong>
                <input type="number" name="score" class="form-control" value="{{$student->score}}" placeholder="Score" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
   
    </form>
@endsection
@section('addjavascript')

<script >
$('#editform').submit(function() {

    // need to get form data as below
    var formData = new FormData($(this)[0]);

    $.ajax({
        data: formData,
        contentType: false,
        processData: false,
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        success: function(response) {
            console.log(response);
            if (response) {
              $('#success-message').show(); 
              $('#success-message').text(response.success); 
            }
        }
    });
    return false;
});


</script>
@endsection