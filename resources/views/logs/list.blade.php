@extends('layouts.system-admin')

@section('style')
    .table-log{
    position:relative;
    width:100%;
    height: 750px;
    overflow-y: scroll;
    }
    .table-log table{
    position:absolute;
    width:1400px;
    height:100%;
    }

    @media screen and (max-width: 1400px) {
    .table-log{
    height:450px;
    overflow-x: scroll;
    overflow-y: scroll;
    }
@endsection
@section('content')

<?php $stt = 1; $id_user?>
<div class="table-log">
  <table class="table table-hover table-bordered" style="font-size: 13px;">
    <thead class="thead-dark">
      <tr class="text-center">
        <th scope="col">STT</th>
        <th scope="col">Id</th>
        <th scope="col">Subject</th>
        <th scope="col">Url</th>
        <th scope="col">Method</th>
        <th scope="col">Ip</th>
        <th scope="col">User_id</th>
        <th scope="col">User_name</th>
        <th scope="col">Time</th>
        <th scope="col">Agent</th>
        <th scope="col">Input</th>
      </tr>
    </thead>
    <tbody>
      @foreach($logs as $log)
          <tr>
            <th scope="row" style="color:DarkSlateGray"><?php echo $stt; $stt++ ?></th>
            <th scope="row">{{ $log->id }}</th>
            <td width="250px"><b style="color:DarkSlateGray">{{ $log->subject }}</b></td>
            <td>{{ $log->url }}</td>
            <td>{{ $log->method }}</td>
            <td>{{ $log->ip }}</td>
            <td>{{ $log->user_id }} <?php $id_user = $log->user_id ?></td>
            <td><a href="{{ route('Log Activity By User Id', $log->user_id) }}">{{ $log->user_name }}</a></td>
            <td width="140px">
                <p>{{ Carbon\Carbon::createFromTimeStamp(strtotime($log->created_at))->diffForHumans() }}</p>
                <p>{{ $log->created_at }}</p>
            </td>
            <td width="250px">{{ $log->agent }}</td>
            <td style="width:350px;word-break:break-all">{{ $log->input }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
<label for="inputState" style="color:#337ab7; font-weight:bold; margin-top:5px">Items total: <b style="color:Crimson">{{$logs->currentPage()*$itemsPerPage}}/{{$logs->total()}}</b> (item)</label>

  <div class="form-group col" style="padding-left:0px;">
    <label for="inputState" style="color:#337ab7; font-weight:bold">Items per page</label>
    <div class="row">
      <div class="col-md-2">
        <form action="
          <?php
            if($allLogs)
            {
              echo route('LAKA Log User Activities By Items Per Page');
            } else {echo route("Log Activity By User Id", $id_user);}
          ?>
        " method="GET">
            <select id="inputState" class="form-control" name="itemsPerPage" onchange="this.form.submit()">
              <option value="5" selected >5</option>
              <option value="10" <?php if($itemsPerPage==10){echo "selected";}?>>10</option>
              <option value="20" <?php if($itemsPerPage==20){echo "selected";}?>>20</option>
              <option value="50" <?php if($itemsPerPage==30){echo "selected";}?>>50</option>
              <option value="100" <?php if($itemsPerPage==100){echo "selected";}?>>100</option>
              <option value="150" <?php if($itemsPerPage==150){echo "selected";}?>>150</option>
            </select>
        </form>
      </div>
      <div class="col-md-10">
        {{ $logs->links() }}
      </div>
    </div>
  </div>





@endsection
