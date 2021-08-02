<!DOCTYPE html>
<html lang="en">
<head>
  <title>Technical Test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Form Disbursement</h2>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('send-disbursement') }}">
    @csrf
    <div class="form-group">
      <label for="bank_code">Bank Code:</label>
      <input type="text" class="form-control" id="bank_code" " name="bank_code" required>
    </div>
    <div class="form-group">
      <label for="account_number">Account Number:</label>
      <input type="text" class="form-control" id="account_number"  name="account_number" required>
    </div>
    <div class="form-group">
      <label for="amount">Amount:</label>
      <input type="number" class="form-control" id="amount"  name="amount" required>
    </div>
    <div class="form-group">
      <label for="remark">Remark:</label>
      <input type="text" class="form-control" id="remark"  name="remark">
    </div>
    
    <a href="{{route('home')}}"><button type="button" class="btn btn-default">Home</button></a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
