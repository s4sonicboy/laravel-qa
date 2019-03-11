<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel Bootstrap Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h2>User&#39;s Form</h2>

      <div class="flash-message">

        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </p>
          @endif
        @endforeach
      </div>

      <form action="{{url('/userdata')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="name_user">Name:</label>
          <input type="text" class="form-control" id="name_user" placeholder="Enter Name" name="name_user">
        </div>
        <div class="form-group">
          <label for="mobile_user">Mobile:</label>
          <input type="text" class="form-control" id="mobile_user" placeholder="Enter Mobile" name="mobile_user">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group input-group">
          <label for="userImg">Profile Image:</label>
          <input type="file" class="form-control" id="userImg" placeholder="Enter email" name="userImg">
        </div>
        <div class="form-group input-group">
          <label for="userBook">Select Box:</label>
          <select name="userBook" id="userBook">
              <option value="">Select Book</option>
              <option value="book1">Book 1</option>
              <option value="book2">Book 2</option>
              <option value="book3">Book 3</option>
              <option value="book4">Book 4</option>
          </select>
        </div>
        <!-- <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        </div> -->
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Book</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @php ($i = 1)
            @foreach ($name as $users)

            <tr>
              <td>{{ $i }}</td>
              <td>{{ $users['name'] }}</td>
              <td>{{ $users['mobile'] }}</td>
              <td>{{ $users['email'] }}</td>
              <td>{{ $users['books']['book'] }}</td>
              <td>
                @if (!empty($users['user_img']))
                  <img src="{{ asset('public/pro_data/'.$users['user_img']) }}" width="50" height="50" alt="" srcset="" class="img-circle" /> </td>
                @else
                  <img src="{{ asset('public/pro_data/placeholder.png') }}" width="50" height="50" alt="" srcset="" class="img-responsive img-circle" /> </td>
                @endif
              <td>
                {{--  <a class="text-info" href="{{url('/edit-users/'.$users['id'])}}"><i class="fa fa-edit"></i> Edit</a> |
                <a class="text-danger" href="{{url('/delete-users/'.$users['id'])}}"><i class="fa fa-trash"></i> Delete</a>  --}}
                <a class="text-info" href="{{url('/edit-users/'.$users['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a class="text-danger" href="{{url('/delete-users/'.$users['id'])}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @php ($i++)
            @endforeach

          </tbody>
        </table>
    </div>
  </div>

</div>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
  </script
</body>
</html>
