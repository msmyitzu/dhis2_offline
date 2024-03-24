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
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="" data-toggle="" style="color: #fff;" disable>
          <img src="{{ asset('img/dhis2_icon.png') }}" class="user-image" width=18 height=18 alt="User Image">
          <span class="card-title"> Malaria Case-Based Reporting for VBDC Myanmar </span>
        </a>
      </li>
      <li>
        <a href="/home" class="" id="" style="color: #bfbfbf;"> Home </a>
      </li>
      <li>
        <a href="/profile" class="" id="" style="color: #bfbfbf;"> Data Control </a>
      </li>
      <li >
            <a href=" {{ url('/logout') }} " style="color: #bfbfbf;">Sign Out</a>
      </li>
    </ul>
  </div>
  <div class="row ">
    <div class="col-md-12 ">
      <div class="content-wrapper " style="min-height: 1135.88px;">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <div class="row ">
            <!-- /.col -->
            <div class="col-md-12">
              <div class="nav-tabs-custom" style="width:100%; margin: 10px;">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#activity" data-toggle="tab" aria-expanded="true"> CoreFacility / Nail </a>
                  </li>
                  <li class="">
                    <a href="#timeline" data-toggle="tab" aria-expanded="false"> Individual Case </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                    <!-- Post -->
                    <div class="col-md-12" style="padding: 8px; border-width:2px;border-style:solid;border-color:#aaaef0;margin-right:3px;">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="box">
                            <div class="box-header">
                              <h4 class="box-title">  CoreFacility / Nail </h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">
                                <tbody>
                                  <tr>
                                    <th> ID </th>
                                    <th> Sub Center </th>
                                    <th> Date </th>
                                    <th> Action</th>
                                  </tr>
                                  @foreach($data_core_nil_info as $index => $data)
                                  <tr role="row" class="odd">
                                    <td> {!! $index+1 !!} </td>
                                    <td> {{ $data->health_facility }} </td>
                                    <td> {{ !empty($data->report_month ) ? date('M-Y', strtotime( $data->report_month  )) : 'N/A'  }}</td>
                                    <td>

                                        <div class="buttons" style="width:max-content; align:center; padding-left:70px; padding-top:7px; padding-bottom:7px;">

                                            <a href="" style="padding-right:5px;">
                                            <button title="ပြင်ဆင်ရန်" id=""
                                                type="button"
                                                class="btn btn-info btn-xs" style="padding:5px;">
                                                {{-- form_form_{{ $data->pt_current_township }} --}}
                                                {{-- form_form_{{ $data->pt_current_township }} --}}
                                                ပြင်ဆင်ရန်
                                                {{-- <li class="fa fa-edit fa-1x"></li> --}}
                                            </button>
                                            </a>
                                        {{-- id="showPopupBtnUpload" --}}
                                       <a href="" style="padding-left:5px;">
                                        <button title="server ပေါ်သို့ပို့ဆောင်မည်" type="button"
                                        class="btn btn-success btn-xs" style="padding:5px;padding-left:5px;" id="">
                                        {{-- <i class="fa fa-upload upload_to_online_btn"></i> --}}
                                        {{-- onClick="dhis2postData('{{  $data->pt_current_township }}')" --}}
                                        server ပေါ်သို့ပို့ဆောင်မည်
                                    </button>
                                       </a>
                                    </div>

                                        {{-- <span class="label label-info"> edit </span> --}}
                                        {{-- <span class="label label-success" style="margin-left: 3px;"> upload </span> --}}
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
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="col-md-12" style="padding: 8px; border-width:2px;border-style:solid;border-color:#aaaef0;margin-right:3px;">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="box">
                            <div class="box-header">
                              <h4 class="box-title"> Individual Case </h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">
                                <tbody>
                                  <tr>
                                    <th> ID </th>
                                    <th> Sub Center </th>
                                    <th>Start Date </th>
                                    <th>End Date </th>
                                    <th> Count </th>
                                    <th> Action</th>




                                  </tr>
                                  @foreach($individualcase_info as $index => $data) <tr role="row" class="odd">




                                    <td> {!! $index+1 !!} </td>
                                    {{-- <td> {{ $data->cf_link_code }} </td> --}}
                                    <td> {{ $data->health_facility_name_en }} </td>
                                    <td> {{ $data->start_date }} </td>
                                    <td> {{ $data->end_date }} </td>
                                    {{-- <td> {{ !empty($data->updated_at ) ? date('M-Y', strtotime( $data->updated_at  )) : 'N/A'  }}</td> --}}
                                    <td> {{ $data->count }}</td>
                                    <td>

                                        <div class="buttons" style="width:max-content; align:center; padding-left:70px; padding-top:7px; padding-bottom:7px;">

                                            <a href="{{ 'formList/'. $data->pt_current_township }}" style="padding-right:5px;">
                                            <button title="ပြင်ဆင်ရန်" id="form_form_{{ $data->pt_current_township }}"
                                                type="button"
                                                class="btn btn-info btn-xs" style="padding:5px;">
                                                ပြင်ဆင်ရန်
                                                {{-- <li class="fa fa-edit fa-1x"></li> --}}
                                            </button>
                                            </a>
                                        {{-- id="showPopupBtnUpload" --}}
                                       <a href="" style="padding-left:5px;">
                                        <button title="server ပေါ်သို့ပို့ဆောင်မည်" type="button"
                                        class="btn btn-success btn-xs" style="padding:5px;padding-left:5px;" id=""
                                        onClick="dhis2postData('{{  $data->pt_current_township }}')">
                                        {{-- <i class="fa fa-upload upload_to_online_btn"></i> --}}
                                        server ပေါ်သို့ပို့ဆောင်မည်
                                    </button>
                                       </a>
                                    </div>

                                      {{-- <span class="label label-success"> edit </span>
                                      <span class="label label-success"> upload </span> --}}
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
                  </div>

                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
  <!------------ All Data ----------------------->
  <!-- Custom Alert Container -->
  <!-- Script Container -->
  <!-- jQuery 3 -->
  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../../bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <script>
    // National Data
  </script>
