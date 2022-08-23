@extends('students.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Student</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Create New Student</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   <h1 class="alert alert-success" id="success-message"></h1>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Image</th>
            <th>Subject</th>
            <th>Percentage</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($students as $key => $student)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $student->name }}</td>
            <td><img src="{{ $student->image_path }}" width="40"></td>
            <td>{{ $student->subjects['name'] }}</td>
            <td>{{ ($student->score / 300) * 100}}</td>
            <td>
                <form action="{{ route('students.destroy',$student->id) }}" class="delete" method="POST">
   
                    <a class="btn btn-info" href="{{ route('students.show',$student->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
      
@endsection
@section('addjavascript')

<script >
$('.delete').submit(function() {
        var thistr = $(this);
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
              $(thistr).parents('tr').remove(); 
            }
        }
    });
    return false;
});


</script>
@endsection