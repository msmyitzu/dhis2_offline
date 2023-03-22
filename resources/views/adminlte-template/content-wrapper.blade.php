{{-- <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!--nav-tabs-custom-->
                @if(Request::is('/patient-register-form'))
                    @include('nmcp-template.patient-register-from')
                @else
                    @include('adminlte-template/nav-tabs')
                @endif
                <!--nav-tabs-custom-->
            </div>
            <!-- Custom Tabs -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper --> --}}