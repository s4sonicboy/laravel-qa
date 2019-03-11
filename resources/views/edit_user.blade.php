<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Laravel Bootstrap Form</title>
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
      <h2>Edit User&#39;s Form</h2>

      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </p>
          @endif
        @endforeach
      </div>

      <form action="{{url('/update-userdata')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="userID" id="userID" value="{{$userData['id']}}" />
        @csrf
        <div class="form-group">
          <label for="name_user">Name:</label>
          <input type="text" value="{{$userData['name']}}" class="form-control" id="name_user" placeholder="Enter Name" name="name_user">
        </div>
        <div class="form-group">
          <label for="mobile_user">Mobile:</label>
          <input type="text" value="{{$userData['mobile']}}" class="form-control" id="mobile_user" placeholder="Enter Mobile" name="mobile_user">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" value="{{$userData['email']}}" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
          <label for="email">Password:</label>
          <input type="password" value="{{$userData['password']}}" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>
        <div class="form-group input-group">
            <label for="userBook">Select Box:</label>
            <select name="userBook" id="userBook">
                <option value="">Select Book</option>
                <option value="book1" <?php echo ($userData['books']['book'] == 'book1') ? 'selected="selected"' : ''; ?>>Book 1</option>
                <option value="book2" <?php echo ($userData['books']['book'] == 'book2') ? 'selected="selected"' : ''; ?>>Book 2</option>
                <option value="book3" <?php echo ($userData['books']['book'] == 'book3') ? 'selected="selected"' : ''; ?>>Book 3</option>
                <option value="book4" <?php echo ($userData['books']['book'] == 'book4') ? 'selected="selected"' : ''; ?>>Book 4</option>
            </select>
          </div>
        <div class="form-group">
            <label for="userImg">Profile Image:</label>
            <input type="file" class="form-control" id="userImg" placeholder="Enter email" name="userImg">
            <br>
            <input type="hidden" name="hideImg" id="hideImg" value="{{$userData['user_img']}}" />
          </div>
          <div class="form-group">
            <img src="{{ asset('public/pro_data/'.$userData['user_img']) }}" width="100" alt="" srcset="" class="img-responsive img img-thumbnail" />
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-info">Update</button>
        <a href="{{url('/')}}" type="submit" class="btn btn-danger">Cancel</a>
      </form>
    </div>
  </div>

</div>

</body>
</html>
