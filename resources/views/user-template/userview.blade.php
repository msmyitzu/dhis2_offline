  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <div class="header_bar" style="margin: 0;padding: 0;width: 100%;height: 50px;background-color: rgb(44, 102, 147);">
    <ul class="nav navbar-nav" >
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu" >
        <a href="#" class="" data-toggle="" style="color: #fff;" disable >
          <img src="{{ asset('img/logo.png') }}" class="user-image" width=18 height=18 alt="User Image">
          <span class="card-title" > Malaria Case-Based Reporting for VBDC Myanmar </span>
        </a>
      </li>
      <li>
        <a href="/home" class="" id="" style="color: #fff;">Go To HomePage</a>
      </li>
    </ul>
  </div>
  <div class="row md-3">
    <div class="col-md-12">
      <div class="content-wrapper" style="min-height: 1135.88px;">
        <!-- Content Header (Page header) -->
        <section class="content" style="margin: 8px;">
          <div class="row">
            <div class="col-md-3">
              <!-- Profile Image -->
              <div class="box box-info" style="padding: 8px; border-width:2px;border-style:solid;border-color:#aaaef0;">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle text-center"
                  src="{{ asset('img/profile.png') }}" alt="User profile picture" style="margin: 0 auto;width: 100px;padding: 1px;border: 3px solid #d2d6de">
                  <h3 class="profile-username text-center"  style="margin-top: 10px;">{{ $userinfo->email }} </h3>
                  <p class="text-muted text-center" style="margin: 10px;"> MCBRS Staff  </p>
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b> Township </b>
                      <a class="pull-right"> {{ $userinfo->township_code }} </a>
                    </li>
                    <li class="list-group-item">
                      <b> Health Facility </b>
                      <a class="pull-right"> {{ $userinfo->health_facility_code }} </a>
                    </li>
                    <li class="list-group-item">
                      <b> Sub Center </b>
                      <a class="pull-right"> {{ $userinfo->sub_center_code }}</a>
                    </li>
                    <li class="list-group-item">
                      <b> Village </b>
                      <a class="pull-right"> {{ $userinfo->village_code }}</a>
                    </li>
                  </ul>


                  <a href="#" class="btn btn-primary btn-block">
                    <b> Sign-Off and Restart </b>
                  </a>
                </div>

                <div class="box box-primary ">
              <div class="box-header with-border">
                <h4 class="box-title">Other Information </h4>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <strong><i class="fa fa-pencil margin-r-5"></i> Global Data </strong>
                <p style="margin-top: 2px;">
                  <span class="label label-danger" style="margin-right: 2px;"> Nat </span>
                  <span class="label label-success" style="margin-right: 2px;"> Reg </span>
                  <span class="label label-success" style="margin-right: 2px;"> DIT </span>
                  <span class="label label-info" style="margin-right: 2px;"> Twn </span>
                  <span class="label label-warning" style="margin-right: 2px;"> HCF </span>
                  <span class="label label-primary" style="margin-right: 2px;"> SC </span>
                  <span class="label label-primary" style="margin-right: 2px;"> VHV </span>
                </p>
                <br>
                <a href="#" class="btn btn-primary btn-block">
                    <b> All Download </b>
                  </a>
                <!-- <hr style="color: black;">
                <strong><i class="fa fa-file-text-o margin-r-5"></i> App Info</strong>
                <p>
                  Version - 1.0.0 <br>
                  Release date - 01/01/2024 <br>
                </p> -->
              </div>
              <!-- /.box-body -->
            </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->



            <div class="col-md-9" style="padding: 8px; border-width:2px;border-style:solid;border-color:#aaaef0;">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                      <h4 class="box-title"> Get Data form MCBRS Online Result </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <th> ID </th>
                            <th> Level </th>
                            <th> Level Type  </th>
                            <th> Count </th>
                            <th> Date </th>
                            <th> Status</th>
                            <th> Action</th>

                          </tr>
                          @foreach($countinfo as $index => $count)
                            <tr role="row" class="odd">
                                <td> {!! $index+1 !!} </td>
                                <td>{{ $count['level'] }}</td>
                                <td>{{ $count['lable'] }}</td>
                                <td>{{ $count['count'] }}</td>
                                <td>{{ date('d-m-Y', strtotime( $count['date'] )) }}</td>
                                <td>
                                  <span class="label label-success"> accept </span>
                                </td>
                                <td>
                                  <button class="label label-info"> DownLoad </button>
                                </td>
                            </tr>
                          @endforeach


                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
