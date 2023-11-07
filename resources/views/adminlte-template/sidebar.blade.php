<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="position:fixed;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/bower_components/img/user/default.PNG" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
                <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Malaria Surveillance System</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="li_chart" class="active"><a href="/chart"><i class="fa fa-circle-o"></i> ပင်မစာမျက်နှာ</a></li>
                    {{-- <li id="li_dataentry" class="active"><a href="/"><i class="fa fa-circle-o"></i> အချက်အလက်ဖြည့်သွင်းရန်</a></li> --}}
                    <li id="li_dataentry" class="active"><a href="{{ route('parent-register') }}"><i class="fa fa-circle-o"></i> အချက်အလက်ဖြည့်သွင်းရန် - v2</a></li>

                    {{-- <li id="li_dataentry_2" class="active"><a href="/entry_2"><i class="fa fa-circle-o"></i> အချက်အလက်ဖြည့်သွင်းရန်_2</a></li> --}}
                    {{-- <li id="li_forms" class=""><a href="/forms"><i class="fa fa-circle-o"></i> ကုသမှုအချက်အလက်များ (Server) </a></li> --}}
                    {{-- <li id="li_offline-forms" class=""><a href="/offline-forms"><i class="fa fa-circle-o"></i> ကုသမှုအချက်အလက်များ (Offline)</a></li> --}}
                    {{-- <li id="li_health-facilities" class=""><a href="/health-facilities"><i class="fa fa-circle-o"></i> ကျန်းမာရေးဌာနများ</a></li> --}}
                    <li id="li_users" class=""><a href="/users"><i class="fa fa-circle-o"></i> အသုံးပြုသူများ</a></li>
                    <li id="li_sync" class=""><a href="/sync"><i class="fa fa-circle-o"></i> အချက်အလက်ပို့ဆောင်ရန်</a></li>
                    <li id="li_syncd" class="">
                        <a href="/syncd"><i class="fa fa-circle-o"></i> အချက်အလက်ရယူရန်
                            <span class="pull-right-container" id="span-syncd" hidden>
                                <small class="label pull-right bg-green">Update</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="footer">
            Version {{ config('app.version') }}
            <p>Powered by AGGA.IO</p>
        </div>
    </section>
    <!-- /.sidebar -->
</aside>
<style>
    .footer {
        height:30px;
        width:100%;
        position:absolute;
        bottom:0;
        color: #8aa4af;
        text-align: center;
        letter-spacing: 0.1em;
        font-weight: 700;
        font-size: 12px;
        opacity: 0.50;
        margin-bottom: 5px ;
    }
</style>
<script src="{{ asset ('js/client_server_check.js')}}"></script>
<script>

    var currentRoute = window.location.pathname.substr(1);

    if(currentRoute == ""){
        //it is dataentry
        reset_menu_class();
        document.getElementById('li_dataentry').classList.add("active");
    }
    else if(currentRoute == "li_dataentry_2"){
		reset_menu_class();
		document.getElementById('li_dataentry_2').classList.add("active");
	}
    else if(currentRoute == "chart"){
		reset_menu_class();
		document.getElementById("li_chart").classList.add("active");
	}
	else {
        reset_menu_class();
        var liName = "li_" + currentRoute;
        document.getElementById(liName).classList.add("active");
    }

    function reset_menu_class(){
        // document.getElementById("li_chart").classList.remove("active");
        document.getElementById("li_dataentry").classList.remove("active");
        document.getElementById("li_dataentry_2").classList.remove("active");
        document.getElementById("li_health-facilities").classList.remove("active");
        //document.getElementById("li_users").classList.remove("active");
        document.getElementById("li_forms").classList.remove("active");
        document.getElementById("li_offline-forms").classList.remove("active");
        document.getElementById("li_sync").classList.remove("active");
        document.getElementById("li_syncd").classList.remove("active");
    }

    document.getElementById('li_sync').addEventListener('click', (event) => {
        event.preventDefault();
        if(navigator.onLine){
            window.location.href = window.location.origin + '/sync' ;
        }else{
            bootbox.alert('<h3 class="text-center">Please Connect with Internet.</h3>');
        }
    });
    document.getElementById('li_syncd').addEventListener('click', (event) => {
        event.preventDefault();
        if(navigator.onLine){
            window.location.href = window.location.origin + '/syncd' ;
        }else{
            bootbox.alert('<h3 class="text-center">Please Connect with Internet.</h3>');
        }
    });
</script>
