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
      <br>
      <br>
    <b>Technical Test By Abd. Majid Hamid</b>
    <h2>List Disbursement</h2>
    @if (\Session::has('success'))
      <div class="alert alert-success">
          {!! \Session::get('success') !!}
          
      </div>
    @endif
    @if (\Session::has('error'))
      <div class="alert alert-danger">
          {!! \Session::get('error') !!}
          
      </div>
    @endif
  <a href="{{route('form-disbursement')}}"><button type="button" class="btn btn-primary">Send Disbursement</button></a>
    <table class="table">
      <thead>
        <tr>
          <th>id</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Timestamp</th>
          <th>Bank Code</th>
          <th>Account Number</th>
          <th>Beneficiary Name</th>
          <th>Remark</th>
          <th>Receipt</th>
          <th>Time Served</th>
          <th>Fee</th>
          <th>Check Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($disbursements as $item)
        <tr>
          <td>{{$item->id}}</td>
          <td>{{$item->amount}}</td>
          <td>{{$item->status}}</td>
          <td>{{$item->timestamp}}</td>
          <td>{{$item->bank_code}}</td>
          <td>{{$item->account_number}}</td>
          <td>{{$item->beneficiary_name}}</td>
          <td>{{$item->remark}}</td>
          <td>
            @if(!empty($item->receipt))
            <a href="{{$item->receipt}}">Link</a>
            @endif
          
          </td>
          <td>{{$item->time_served? $item->time_served : "0000-00-00 00:00:00"}}</td>
           <td>{{$item->fee}}</td>
          <td>
              <a href="{{route('check-disbursement', $item->id)}}"><button type="button" class="btn btn-primary">Check</button></a>
          </td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>

</body>

</html>