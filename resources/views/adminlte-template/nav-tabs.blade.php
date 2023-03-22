<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <!-- <li class="active"><a href="#health_facility_tab" data-toggle="tab">Health Facility</a></li> -->
        <li class="active"><a href="#data_entry" data-toggle="tab">Data Entry</a></li>
        <li><a href="#data_monitoring" data-toggle="tab">Data Monitoring</a></li>
        <!-- <li><a href="#indicators" data-toggle="tab">Indicators</a></li> -->
        <li><a href="#township_reporting" data-toggle="tab">Reporting</a></li>
        <!-- <li><a href="#national_reporting" data-toggle="tab">National Reporting</a></li> -->
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
    </ul>
    <div class="tab-content" style="width: 100%; border: 1px solid #bdbdbd;">
        <!-- health_facility_tab -->
        {{-- @include('nmcp-template/health-facility') --}}
        <!-- health_facility_tab -->
        
        <!-- data_entry_tab-->
        @include('nmcp-template/data-entry')
        <!-- data_entry_tab-->

        <!-- data_monitoring -->
        @include('nmcp-template/data-monitoring')
        <!-- data_monitoring -->
        
        <!-- indicators -->
        <!--indicators -->

        <!--township_reporting-->
        @include('nmcp-template/township-reporting')
        <!--township_reporting-->

        <!-- national_reporting -->
        <!-- @include('nmcp-template/national-reporting') -->
        <!-- national_reporting -->
    </div>
</div>
<!--nav-tabs-custom-->