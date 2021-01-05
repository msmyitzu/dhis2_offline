<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>National Malerial Control Program</title>
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset ('bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}">
        <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <!-- ./wrapper -->
        <div class="wrapper">
            <!-- Header -->
            @include('adminlte-template.header')
            <!-- Sider Bar -->
            @include('adminlte-template.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="info-box bg-aqua">
                                <span class="info-box-icon"><i class="fa fa-wifi"></i></span>
                                <div class="info-box-content">
                                <span class="info-box-text" style="font-size: 12px; padding: 3px;">သင့်လက်ရှိ အင်တာနက်မြန်နှုန်း</span>
                                <span class="info-box-number">163,921</span>
                                <div class="progress">
                                    <div class="progress-bar" id="speed-progress-bar" style="width: 0%"></div>
                                </div>
                                <span class="progress-description" id="speed_desc" style="font-size: 12px; margin:0px; padding:1px; 
                                box-sizing: border-box;">
                                    မြန်နှုန်းစစ်ဆေးနေသည်...
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="alert alert-warning alert-dismissible blink">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>သတိပြုရန်</h4>
                                အချက်အလက်များအားမပို့ဆောင်မှီ သေချာစွာစစ်ဆေးပြီး မှန်ကန်မှပို့ပါ။
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                <h3 class="box-title">ပို့ဆောင်ရန်အချက်အလက်များ</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>အမျိုးအစား</th>
                                                <th>ဖောင်အရေအတွက်</th>
                                                <th>လူနာအရေအတွက်</th>
                                                <th>အရွယ်အစား (byte)</th>
                                                <th style="width: 40px"></th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 10px">1</td>
                                                <td>ကုသမှုအချက်အလက်များ</th>
                                                <td>{{ $tbl_core_facility_count }}</td>
                                                <td>{{ $tbl_individual_case_count }}</td>
                                                <td>{{ $size }} - byte</td>
                                                <td style="width: 40px">
                                                    <button type="button" class="btn btn-block btn-success btn-xs"
                                                    data-toggle="modal" data-target="#modal-default">
                                                        <li class="fa fa-cloud-upload"> ပို့မည်</li>
                                                    </button>
                                                </td>
                                            </tr>                                 
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix"></div>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>  
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->
        <script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{ asset ('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset ('js/bootbox.all.min.js') }}"></script>
        <script src="{{ asset ('js/popper.min.js') }}"></script>
        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        <script>
           function sync_upload(btn)
           {
                $(btn).prop('disabled', true);
                // load_progress_bar();
                $.ajax({
                    xhr: function()
                    {
                        var xhr = new window.XMLHttpRequest();
                        // xhr.upload.onprogress = load_progress_bar ;
                        xhr.addEventListener("progress", function (evt) {
                            console.log('xhr onprgress state');
                            console.log("evt.lengthComputable :", evt.lengthComputable); // false means /sync_data doesn not return header content-length
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                console.log(Math.round(percentComplete * 100) + "%");
                                $("#upload_progressbar").css("width",Math.round(percentComplete * 100) + "%");
                            }
                        }, false);
                        return xhr;
                    },
                    type: 'GET',
                    url: "/sync_upload",
                    data: {},
                    beforeSend: function(){
                        load_progress_bar();
                        // $("#upload_progressbar").css("width", "20%");
                    },
                    fail: function(){
                        $("#upload_progressbar").css("width", "0%");
                        bootbox.alert("ပို့ဆောင်မှု မအောင်မြင်ပါ။ သင့်အင်တာနက် ဆက်သွယ်ရေးတည်ငြိမ်မှုရှိမှ ပြန်ပို့ပါ။");
                    },
                    success: function(data){
                        data = JSON.parse(data);
                        $('#core-count').html(data['tbl_core_facility'].length) ;
                        $('#indi-count').html(data['tbl_individual_case'].length) ;
                        var total_count = data['tbl_total_patient'].length ;
                        var org_count = data['tbl_org_vhv'].length ;
                        
                        $("#upload_progressbar").css("width", "90%");
                        $('#modal-success').modal();
                        $(".btn").prop('disabled',false);
                    }
                })
           }

           function load_progress_bar()
           {
                $("#upload_progressbar").css("width", "1%");
                var client_count = {{ $tbl_individual_case_count }} ;
                var c = 0 ;
                var inter = setInterval(syncing_data, 1000);
                function syncing_data() {                    
                    if( c < client_count ){
                        var perc = Math.round(c/client_count*100) ;
                        $("#upload_progressbar").css("width", perc + "%");
                        $('#syncing_bar_perc').html(perc + '%');
                        $('#syncing_bar').html(c + '/' + client_count);
                        c += 4 ;
                    }else{
                        clearInterval(inter);
                        $('#syncing_bar').html('Upload Complete, Wait a Second.');
                    }
                };
           }

            var imageAddr = "https://www.myanmarvbdc.com/img/speed-test.jpg";
            var downloadSize = 4730000; //bytes
            var speedPercentage = 0;
            function ShowProgressMessage(msg) {
                if (typeof msg == "string") {
                    $(".info-box-number").html(msg + " Kbps");
                } else {
                    for (var i = 0; i < msg.length; i++) {
                        $(".info-box-number").html(msg + " Kbps");
                        if(parseInt(msg) > 2500){
                            $("#speed_desc").html("ပို့ဆောင်ရန်သင့်ပါသည်");
                        }else{
                            $("#speed_desc").html("ပို့ဆောင်ရန်မသင့်သေးပါ");
                        }
                    }
                }
                speedPercentage = parseInt(msg) / 10000; //max speed is 10 mbps
                $("#speed-progress-bar").css("width", Math.round(speedPercentage * 100) + "%");  
            }

            function InitiateSpeedDetection() {
                ShowProgressMessage("0");
                window.setTimeout(MeasureConnectionSpeed, 1);
            };    

            if (window.addEventListener) {
                window.addEventListener('load', InitiateSpeedDetection, false);
            } else if (window.attachEvent) {
                window.attachEvent('onload', InitiateSpeedDetection);
            }

            function MeasureConnectionSpeed()
            {
                var startTime, endTime;
                var download = new Image();
                download.onload = function () {
                    endTime = (new Date()).getTime();
                    showResults();
                }
                
                download.onerror = function (err, msg) {
                    ShowProgressMessage("Invalid image, or error downloading");
                }
                
                startTime = (new Date()).getTime();
                var cacheBuster = "?nnn=" + startTime;
                download.src = imageAddr + cacheBuster;
                
                function showResults() {
                    var duration = (endTime - startTime) / 1000;
                    var bitsLoaded = downloadSize * 8;
                    var speedBps = (bitsLoaded / duration).toFixed(2);
                    var speedKbps = (speedBps / 1024).toFixed(2);
                    var speedMbps = (speedKbps / 1024).toFixed(2);
                    ShowProgressMessage([
                        speedKbps
                    ]);                    
                }
            }
            //Above codes to get client internet speed
            <?php
                if($size === 0){
            ?>
                    $(".btn").prop("disabled", true);
                    $(".btn").prop("title", "ပို့ရန်အချက်အလက်အသစ်မရှိပါ");
            <?php
                }
            ?>
        </script>
        <style>
            .blink {
                animation: blinker 3s step-start infinite;
            }
            @keyframes blinker {
                50% {
                    opacity: 0;
                }
            }
            
            tr{
                cursor:pointer;
            }
            /*tbody tr:nth-child(odd) {background: #F5F5F5}*/
            tr.selected{
                color: #EA4A2D;
                /*font-weight: bold;*/
                background-color: #FBFBA5;
            }
            .dataTables_wrapper .dataTables_paginate {
                float: right;
                text-align: right;
                margin-bottom: 5px;
            }

           .dataTables_wrapper .dataTables_filter {
                float: right;
                text-align: right;
                margin-bottom: 5px;
            }
            .dataTables_wrapper .dataTables_filter input {
                margin-left: 5px;
            }
            .dataTables_scrollHead{
                padding: 0px;
                margin: 0px;
            }
            .sync_offline{
                color: silver;
                font-weight:bold;
            }
            /*thead th { border-bottom: 2px solid #E86156;}*/
            

            tbody tr:hover{
                background-color: #FFFFCB;
            }
            
            .table{
                margin-bottom: 0px;
            }

            #table_tbl_hfm td{
                white-space: nowrap;
            }
        </style>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">အချက်အလက်ပို့ဆောင်ရန်အသင့်</h4>
              </div>
              <div class="modal-body">
                <!--p>မှတ်ချက်။ အချက်အလက်များအားမပို့ဆောင်မှီ သေချာစွာစစ်ဆေးပြီး မှန်ကန်မှပို့ပါ။</p-->
                <div class="alert alert-danger alert-dismissible">
                    <h4>အထူးသတိပြုရန်</h4>
                    အချက်အလက်ပို့ဆောင်နေစဉ်အတွင်း ယခုလက်ရှိစာမျက်နှာအား ပိတ်ခြင်း၊ Refresh လုပ်ခြင်း (လုံးဝ) မပြုလုပ်ရန် သတိပေးအပ်ပါသည်။
                </div>
                <div class="clearfix">
                    <small class="pull-left" id="syncing_bar_perc"></small>
                    <small class="pull-right" id="syncing_bar"></small>
                </div>
                <div class="progress progress-sm active">
                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" 
                    id="upload_progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">               
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">မပို့သေးပါ</button>
                <button type="button" class="btn btn-primary btn-success" onClick="sync_upload(this)">
                    <li class="fa fa-cloud-upload"><span style="font-family: mmFont !important;">ပို့မည်</span></li>
                </button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onclick="location.reload()">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ပို့ဆောင်မှုအောင်မြင်ပါသည်။</h4>
              </div>
              <div class="modal-body">
                <div class="alert alert-success alert-dismissible">
                    <h5>အချက်အလက်များ ပို့ဆောင်ခြင်း အောင်မြင်ပါသည်။</h5>
                    <dl class="dl-horizontal">
                        <dt>ဖောင်အရေအတွက် -</dt>
                        <dd id="core-count"></dd>
                        <dt>လူနာအရေအတွက် -</dt>
                        <dd id="indi-count"></dd>
                    </dl>
                    <p>အထက်ပါအချက်အလက်များပို့ဆောင်ပြီးပါပြီး။ အကယ်၍မကိုက်ညီပါက ထပ်မံပို့ဆောင်ပေးပါ။</p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-success" onClick="location.reload();">
                    <li class="fa fa-check-square-o"><span style="font-family: mmFont !important;"> ပိတ်မည်။</span></li>
                </button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </body>
    </html>
