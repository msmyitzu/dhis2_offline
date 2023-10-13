<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <title>National Malerial Control Programme</title>
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="{{asset ('bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
        
        <!-- Select2 -->
        <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"-->
        <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Theme style -->
        <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <input type="hidden" id="hfm_count" value="{{ $tbl_hfm_count }}" />
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
                            
                            <div class="box">
                                <div class="box-header with-border">
                                <h3 class="box-title">ရယူရန်အချက်အလက်များ</h3>
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
                                                    <button type="button" class="btn btn-block btn-success btn-xs" id="df_button"
                                                    data-toggle="modal" data-target="#modal-default" onClick="$('#download_button').attr('onclick','sync_upload()');">
                                                        <li class="fa fa-cloud-download"> ရယူမည်</li>
                                                    </button>
                                                </td>
                                            </tr>  
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>အမျိုးအစား</th>
                                                <th>ကျန်းမာရေးဌာန(HF) အရေအတွက်</th>
                                                <th>စေတနာဝန်ထမ်းများ(ICMV) အရေအတွက်</th>
                                                <th>အရွယ်အစား (byte)</th>
                                                <th style="width: 40px"></th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 10px">1</td>
                                                    <td>ကျန်းမာရေးဌာနများ(HF) နှင့် စေတနာဝန်ထမ်းများ(ICMV)</th>
                                                    <td>{{ $hf_count }}</td>
                                                    <td>{{ $icmv_count }}</td>
                                                    <td>{{ $hfm_size }} - byte</td>
                                                    <td style="width: 40px">
                                                        <button type="button" class="btn btn-block btn-success btn-xs" id="dh_button"
                                                        data-toggle="modal" data-target="#modal-default" onClick="$('#download_button').attr('onclick','sync_hfm()');">
                                                            <li class="fa fa-cloud-download"> ရယူမည်</li>
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
        <!-- jQuery 3 -->
        <script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
        {{-- <script src="{{ asset ('bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Select2 -->     
        
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ asset ('bower_components/fastclick/lib/fastclick.js')}}"></script>
               
        <!-- DataTables -->
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset ('js/bootbox.all.min.js') }}"></script>
        <script src="{{ asset ('js/popper.min.js') }}"></script>
        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        
        <script>

            $( document ).ready(function() {
                
            });
           
           function sync_upload()
           {            
            $.ajax({
                xhr: function()
                {
                    var xhr = new window.XMLHttpRequest();
                    xhr.addEventListener("progress", function (evt) {
                        console.log(evt.lengthComputable); // false means /sync_data doesn not return header content-length
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //console.log(Math.round(percentComplete * 100) + "%");
                            $("#upload_progressbar").css("width",Math.round(percentComplete * 100) + "%");
                        }
                    }, false);
                    return xhr;
                },
                type: 'GET',
                url: "/sync_download",
                data: {},
                    beforeSend: function(){
                        $("#upload_progressbar").css("width", "20%");
                    },
                    fail: function(){
                        $("#upload_progressbar").css("width", "0%");
                        bootbox.alert("ရယူမှု မအောင်မြင်ပါ။ သင့်အင်တာနက် ဆက်သွယ်ရေးတည်ငြိမ်မှုရှိမှ ပြန်ပို့ပါ။");
                    },
                    success: function(data){
                        $('#modal-success').modal();
                    //    $(".modal-title").html('ရယူပြီးပါပြီ');
                       $(".btn").prop('disabled', false);
                    //    location.reload();
                    }
                });
           }

           function sync_hfm()
           { 
                $(".btn").prop("disabled", true);
                load_progress_bar();
                $.ajax({                
                    type: 'GET',
                    url: "/sync_tbl_hfm",
                    data: {"updateHfm" : {{ $haveUpdateHfm }}},
                    fail: function(){
                        $("#upload_progressbar").css("width", "0%");
                        bootbox.alert("ရယူမှု မအောင်မြင်ပါ။ သင့်အင်တာနက် ဆက်သွယ်ရေးတည်ငြိမ်မှုရှိမှ ပြန်ပို့ပါ။");
                    },
                    success: function(data){
                        // console.log(data);
                        $('#modal-success').modal();
                        // $(".modal-title").html('ရယူပြီးပါပြီ');
                        $(".btn").prop('disabled',false);
                        // location.reload();
                    }
                });
            }
           
           function load_progress_bar()
           {
                var hfm_count = $("#hfm_count").val();
                $("#upload_progressbar").css("width", "0%");

                setInterval(function(){
                    $.ajax({
                        url: "status.txt",
                        success: function (data){
                            var perc = 0;
                            if(parseInt(data) == parseInt(hfm_count)){
                                perc = 100;
                            }else{
                                perc = Math.round( (parseInt(data)*100)/parseInt(hfm_count) );
                                if(perc > 95){
                                    perc = 100;
                                }
                           }
                           //$("#tmp_cnt").html(perc + "%");                            
                            $("#upload_progressbar").css("width", perc + "%");
                        }
                    });
                }, 500);
            }



            //Below codes to get client internet speed
            //var imageAddr = "http://www.kenrockwell.com/contax/images/g2/examples/31120037-5mb.jpg"; 
            var imageAddr = "http://127.0.0.1:8000/img/speed-test.jpg";
            var downloadSize = 4730000; //bytes
            var speedPercentage = 0;

            function ShowProgressMessage(msg) {
                
                if (typeof msg == "string") {
                    $(".info-box-number").html(msg + " Kbps");
                } else {
                    for (var i = 0; i < msg.length; i++) {
                        $(".info-box-number").html(msg + " Kbps");

                        if(parseInt(msg) > 2500){
                            $("#speed_desc").html("ရယူရန်သင့်တော်ပါသည်");
                        }
                        else{
                            $("#speed_desc").html("ရယူရန်မသင့်တော်သေးပါ");
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

            function MeasureConnectionSpeed() {
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

            <?php if($size == 0){ ?>
                    $("#df_button").prop("disabled", true);
                    $("#df_button").prop("title", "အချက်အလက်အသစ်မရှိပါ");
            <?php }if($haveUpdateHfm && $client_hf_count > 0) { ?>
                $("#dh_button").html("<li class='fa fa-cloud-download'> Update</li>");
                $("#dh_button").prop("disabled", false);
            <?php } else if($client_hf_count == 0) { ?>
                $("#dh_button").html("<li class='fa fa-cloud-download'> ရယူမည်</li>");
                $("#dh_button").prop("disabled", false);
            <?php } else { ?>
                $("#dh_button").html("<li class='fa fa-ban'> အသစ်မရှိပါ</li>");
                $("#dh_button").prop("disabled", true);
            <?php } ?>

        </script>
        <style>
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
                <h4 class="modal-title">အချက်အလက်ရယူရန်အသင့်</h4>
              </div>
              <div class="modal-body">
                <!--p>မှတ်ချက်။ အချက်အလက်များအားမပို့ဆောင်မှီ သေချာစွာစစ်ဆေးပြီး မှန်ကန်မှပို့ပါ။</p-->

                <div class="alert alert-danger alert-dismissible">
                    <h4 id="tmp_cnt">အထူးသတိပြုရန်</h4>
                    အချက်အလက်ရယူနေစဉ်အတွင်း ယခုလက်ရှိစာမျက်နှာအား ပိတ်ခြင်း၊ Refresh လုပ်ခြင်း (လုံးဝ) မပြုလုပ်ရန် သတိပေးအပ်ပါသည်။
                </div>

                <div class="progress progress-sm active">
                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" 
                    id="upload_progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">                    
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">မရယူသေးပါ</button>
                <button type="button" class="btn btn-primary btn-success" onClick="sync_upload()" id="download_button">
                    <li class="fa fa-cloud-download"><span style="font-family: mmFont !important;">ရယူမည်</span></li>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ရယူခြင်းအောင်မြင်ပါသည်။</h4>
              </div>
              <div class="modal-body">
                <div class="alert alert-success alert-dismissible">
                    <h4>အချက်အလက်များ ရယူခြင်း အောင်မြင်ပါသည်။</h4>
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
