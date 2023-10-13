<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>VHV Patient Register Form</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.-->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet"
        href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}"> --}}
</head>

<body>
    <input type="hidden" id="cf_code" value="{{ $cf_code }}" />
    <input type="hidden" id="cf_link_code" value="{{ $cf_link_code }}" />
    <div class="wrap">
        <div class="row">
            <div class="header well text-center">
                <span style="float:left; font-size: 10px;">ပုံစံအမျိုးအစား - {{ $lp_form_cat_name }}</span>
                ငှက်ဖျားလူနာစစ်ဆေးကုသမှုမှတ်တမ်း/လချုပ်
                <span style="float:right; font-size: 10px;">Form Number - {{ $form_number }}</span>
            </div>

            <div class="first-row text-center">
                <label class="control-label top-label">တိုင်းဒေသကြီး/ပြည်နယ် <span
                        class="top-label-value">{{ $lp_state_region_name }}</span></label>
                <label class="control-label top-label">မြို့နယ် <span
                        class="top-label-value">{{ $lp_township_name }}</span></label>
                <label class="control-label top-label">မြို့နယ်ဆေးရုံ/တိုက်နယ်ဆေးရုံ/ ကျေးလက်ကျန်းမာရေးဌာန <span
                        class="top-label-value">{{ $tbl_hfm_sc_name }}</span></label>
                <label class="control-label top-label">ကျေးလက်ကျန်းမာရေးဌာနခွဲ/နယ်စပ်ဆေးပေးခန်း <span
                        class="top-label-value">{{ $hfm_name }}</span></label>
            </div>

            <div class="sec-row text-center">
                <?php
                    if(isset($tbl_org_vhv)){
						if (count($tbl_org_vhv) > 0) {
                        foreach($tbl_org_vhv as $vhv){
                ?>
                <div class="org-block">
                    <label for="" class="{{-- sec-label --}} mmtext-12">အဖွဲ့အစည်းအမည်</label>
                    <select name="org-name" id="org-id" class="{{-- sec-row-select --}}">
                        {{-- @if ($lp_form_cat_name == 'VHV NMCP')
                            <option value="25">VHV NMCP</option>
                        @else --}}
                        @foreach ($lp_org as $org)
                            <option value="{{ $org->org_id }}" <?php
                            echo $vhv->Org_id == $org->org_id ? 'selected' : ''; ?>>
                                {{ $org->organization }}
                            </option>
                        @endforeach
                        {{-- @endif --}}
                    </select>
                </div>
                <div class="village-block">
                    <label class="sec-label mmtext-12">ကျေးရွာ
                        <input id='vill_code'class="sec-row-label" value="{{ $vhv->Vill_Code }}">
                    </label>
                </div>
                <div class="vhv-block">
                    <label class="sec-label mmtext-12">စေတနာ့ဝန်ထမ်းအမည်
                        <input id="vhv_name" class="sec-row-label" value="{{ $vhv->VHV_Name }}"
                            org_vhvid='{{ $vhv->OrgVHV_ID }}'>
                    </label>
                </div>
                <div class="month-block">
                    <label class="sec-label mmtext-12">လ
                        <input id="frm_month" class="sec-row-label" value="{{ $form_month }}" disabled>
                    </label>
                </div>
                <div class="year-block">
                    <label class="sec-label mmtext-12">ခုနှစ်
                        <input id="frm_year" class="sec-row-label" value="{{ $form_year }}" disabled>
                    </label>
                </div>
                <?php
                    }}else{
                        // echo "this is plane table";
                ?>
                <div class="org-block">
                    <label for="" class="mmtext-12">အဖွဲ့အစည်းအမည်</label>
                    <select name="org-name" id="org-id" class="{{-- sec-row-select --}}" <?php echo $lp_form_cat == '2' ? 'disabled' : ''; ?>>
                        <option value="" <?php echo $lp_form_cat != '2' ? 'selected disabled' : ''; ?>>ရွေးပါ</option>
                        @foreach ($lp_org as $org)
                            <option value="{{ $org->org_id }}" <?php echo $lp_form_cat == '2' && $org->org_id == '25' ? 'selected' : ''; ?>>
                                {{ $org->organization }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="village-block">
                    <label class="sec-label mmtext-12">ကျေးရွာ
                        <input id='vill_code'class="sec-row-label" value="">
                    </label>
                </div>
                <div class="vhv-block">
                    <label class="sec-label mmtext-12">စေတနာ့ဝန်ထမ်းအမည်
                        <input id="vhv_name" class="sec-row-label" value="" org_vhvid="">
                    </label>
                </div>
                <div class="month-block">
                    <label class="sec-label mmtext-12">လ
                        <input id="frm_month" class="sec-row-label" value="{{ $form_month }}" disabled>
                    </label>
                </div>
                <div class="year-block">
                    <label class="sec-label mmtext-12">ခုနှစ်
                        <input id="frm_year" class="sec-row-label" value="{{ $form_year }}" disabled>
                    </label>
                </div>
                <?php } } ?>
            </div>
            <div class="col-md-12" style="padding: 0px;">
                <button class="btn btn-default btn-sm pull-right" id="add_row"
                    style="margin-top: 10px; margin-bottom: 10px;" onClick="add_row(this)"
                    {{ $review_mode ? 'disabled' : '' }}>
                    <?php
                    if ($review_mode) {
                        echo '<li class="fa fa-ban"></li> Not Allow Editing';
                    } else {
                        echo '<li class="fa fa-plus-square"></li> အသစ်တစ်ကြောင်းထပ်တိုးရန်';
                    }
                    ?>
                </button>
                <table class="table table-bordered dataTable" id="register-table">
                    <thead class="thead-dark mmtext-12">
                        <tr>
                            <th rowspan="2" width="20px">စဉ်</th>
                            <th rowspan="2" width="80px">ရက်စွဲ</th>
                            <th rowspan="2" width="100px">အမည်</th>
                            <th rowspan="2" width="35px">အသက်</th>
                            <th rowspan="2" width="150">လိပ်စာအပြည့်အစုံ</th>
                            <th rowspan="2" width="80">လိပ်စာရေးရန်</th>
                            <th rowspan="2" width="80">လိင် (ကျား/မ)</th>
                            <th rowspan="2" width="80">ကိုယ်၀န်ဆောင်</th>
                            <th rowspan="2" width="80">RDTဖြင့်စစ်ဆေး</th>
                            <th rowspan="2" width="90px">ပြင်ပ/အတွင်း</th>
                            <th colspan="3" width="150">ကုသပေးသော<br />ငှက်ဖျားဆေး</th>
                            <th rowspan="2" width="80">Referral</th>
                            <th rowspan="2" style="width: 50px">Mp(+) Malaria Death</th>
                            <th rowspan="2" style="width: 50px">Treatment Given</th>
                            <th rowspan="2" style="width: 80px">ခရီးသွားခြင်း (၂ပတ်-၁လအတွင်း)</th>
                            <th rowspan="2" style="width: 110px">အလုပ်အကိုင်</th>
                            <th rowspan="2" style="width: 70px;">Remark</th>
                            <th rowspan="2" style="width: 20px"></th>
                        </tr>
                        <tr>
                            <th width="50px">ACT</th>
                            <th width="50px">CQ</th>
                            <th width="50px">PQ</th>
                        </tr>
                    </thead>
                    <tbody id="data_entry_body">
                        <?php
                        if(isset($tbl_individual_case_temp))
                        foreach($tbl_individual_case_temp as $patient) {
                            list($year, $month, $day) = explode("-", $patient->Screening_Date);
                    ?>
                        <tr>
                            <td style="font-size:10px; font-weight: bold;" P_Number="<?= $patient->P_Number ?>"></td>
                            <td><input type="text" placeholder="ရက်စွဲ" class="dentry_date"
                                    value="<?= $day . '-' . $month . '-' . $year ?>"></td>
                            <td><input type="text" placeholder="အမည်" value="<?= $patient->Pt_Name ?>"></td>
                            <td><input type="text" placeholder="အသက်" value="<?= $patient->Age_Year ?>"
                                    class="agevhv dentry_age" onchange="checkAge(this)"></td>
                            <td>
                                <select name="address" id="" value="<?= $patient->Pt_Location ?>"
                                    onblur="location_changed(this)">
                                    <option value="">ရွေးပါ</option>
                                    @if ($patient->Pt_Location == 10)
                                        <option value="{{ $patient->Pt_Location }}" selected>Other</option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                                            </option>
                                        @endforeach
                                    @elseif($patient->Pt_Location == 20)
                                        <option value="{{ $patient->Pt_Location }}" selected>Other Within Township
                                        </option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                                            </option>
                                        @endforeach
                                        <option value="30">Other Outside Township</option>
                                        <option value="99">Missing</option>
                                    @elseif($patient->Pt_Location == 30)
                                        <option value="{{ $patient->Pt_Location }}" selected>Other Outside Township
                                        </option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                                            </option>
                                        @endforeach
                                        <option value="30">Other Outside Township</option>
                                        <option value="99">Missing</option>
                                    @elseif($patient->Pt_Location == 99)
                                        <option value="{{ $patient->Pt_Location }}" selected>Missing</option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                                            </option>
                                        @endforeach
                                        <option value="20">Other Within Township</option>
                                        <option value="30">Other Outside Township</option>
                                    @else
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}" <?php echo $v->village_pcode == $patient->Pt_Location ? 'selected' : ''; ?>>
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                                            </option>
                                        @endforeach
                                        <option value="20">Other Within Township</option>
                                        <option value="30">Other Outside Township</option>
                                        <option value="99">Missing</option>
                                        {{-- <option value="10">Other</option> --}}
                                    @endif
                                </select>
                            </td>
                            <td><input type="text" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း"
                                    value="<?= $patient->Pt_Address ?>"></td>
                            <td>
                                <select name="sex" class="sexvhv" onchange="checkSex(this)">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_patient_sex as $sex)
                                        <option value="{{ $sex->Sex_Code }}" <?php echo $sex->Sex_Code == $patient->Sex_Code ? 'selected' : ''; ?>>
                                            {{ $sex->P_Sex }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="preg" class="pregvhv">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_yesno as $yn)
                                        <option value="{{ $yn->YN_Code }}" <?php echo $yn->YN_Code == $patient->Preg_YN ? 'selected' : ''; ?>>
                                            {{ $yn->YesNo }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="rdt" class="rdtvhv">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_rdt_result as $rdt)
                                        <option value="{{ $rdt->r_code }}" <?php echo $rdt->r_code == $patient->RDT_Code ? 'selected' : ''; ?>>
                                            {{ $rdt->r_result }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="out-patient" id="" style="width: 100%">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_in_out_cat as $ioc)
                                        <option value="{{ $ioc->ioc_code }}" <?php echo $ioc->ioc_code == $patient->IOC_Code ? 'selected' : ''; ?>>
                                            {{ $ioc->io_cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="ACT" class="actvhv">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_act_code as $act)
                                        <option value="{{ $act->act_code }}" <?php echo $act->act_code == $patient->ACT_Code ? 'selected' : ''; ?>>
                                            {{ $act->act_treatment }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" value="{{ $patient->CQ_Code }}" class="cqvhv only-integer">
                            </td>
                            <td>
                                <input type="number" value="{{ $patient->PQ_Code }}" class="pqvhv only-integer">
                            </td>
                            <td>
                                <select name="referral">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_yesno as $yn)
                                        <option value="{{ $yn->YN_Code }}" <?php echo $yn->YN_Code == $patient->Referral_Code ? 'selected' : ''; ?>>
                                            {{ $yn->YesNo }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="malaria-death" onchange="checkMpdeath(this)">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_yesno as $yn)
                                        <option value="{{ $yn->YN_Code }}" <?php echo $yn->YN_Code == $patient->Malaria_Death ? 'selected' : ''; ?>>
                                            {{ $yn->YesNo }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="" id="t-given">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_treatment_given as $treatment)
                                        <option value="{{ $treatment->tg_code }}" <?php echo $treatment->tg_code == $patient->TG_Code ? 'selected' : ''; ?>>
                                            {{ $treatment->t_given }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="travel-log" id="travel-log">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_yesno as $yn)
                                        <option value="{{ $yn->YN_Code }}" <?php echo $yn->YN_Code == $patient->travel_yn ? 'selected' : ''; ?>>
                                            {{ $yn->YesNo }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="job" id="job">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($lp_occupation as $job)
                                        <option value="{{ $job->occupation_id }}" <?php echo $job->occupation_id == $patient->occupation ? 'selected' : ''; ?>>
                                            {{ $job->occupation_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" placeholder="မှတ်ချက်(Optional)"
                                    value="<?= $patient->Remark ?>">
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="delete_icon"
                                    onClick="delete_existing_row(<?= $patient->P_Number ?>,<?= $patient->sync ?>);"
                                    rowNo="">
                                    <li class="fa fa-trash-o"></li>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-success btn-sm" onclick="save_data_entry_vhv(this)">
                    <li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်
                </button>
                {{-- <button class="btn btn-default btn-sm" onclick = "close_page()">
                    မသိမ်းပဲပိတ်မည်
                </button> --}}
            </div>
        </div>
    </div>
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    {{-- <script src="{{ asset ('bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    {{-- <script src="{{ asset ('bower_components/select2/dist/js/select2.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/inputmask/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('js/bootbox.all.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/custom_inputmask.js') }}"></script>
    <script src="{{ asset('js/nmcp.js') }}"></script>
    <script>
        clickOnRow();
        $(function() {
            var today = new Date();
            var dd = today.getDate() < 10 ? `0${today.getDate()}` : today.getDate();
            var mm = today.getMonth() < 9 ? `0${today.getMonth() + 1}` : today.getMonth() + 1;
            var yyyy = today.getFullYear();
            var maxDate = `${dd}-${mm}-${yyyy}`;
            $('.dentry_date').inputmask('datetime', {
                inputFormat: 'dd-mm-yyyy',
                placeholder: '_',
                clearIncomplete: true,
                min: '09-09-0999',
                max: maxDate
            });

            $('#org-id').val() == '25' ? $('#vill_code').focus().select() : $('#org-id').focus().select();

            $('#health_facility_table').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });

            //Initialize Select2 Elements
            $('.select2').select2()
            // $('.dentry_date').datepicker({
            //     autoclose: true,
            //     format: 'dd-mm-yyyy',
            //     endDate: new Date(),
            //     todayHighlight: true,
            // }).on('change', function(){
            //     $(this).focus();
            // });
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            $('.dentry_date').blur((e) => {
                var d = e.target.value.split('-');
                if (d[2] === '999_') {
                    e.target.value = '999';
                }
            });

        });

        function save_data_entry_vhv(button) {

            $(button).prop("disabled", true);
            $(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');

            var org_field = $('#org-id').val();
            var vill_field = $('#vill_code').val();
            var vhv_field = $('#vhv_name').val();
            var errMsg = "";
            var errClass = {};
            if (org_field == "" || org_field == null) {
                errMsg += "<p>• အဖွဲ့အစည်းအမည် ရွေးပါ</p>";
                errClass['org_field'] = 'org-id';
            }
            if (vill_field == "") {
                errMsg += "<p>• ကျေးရွာအမည် ရေးပါ</p>";
                errClass['vill_field'] = 'vill_code';
            }
            if (vhv_field == "") {
                errMsg += "<p>• စေတနာ့ဝန်ထမ်းအမည် ရေးပါ</p>";
                errClass['vhv_field'] = 'vhv_name';
            }
            if (errMsg != "") {
                bootbox.alert(errMsg);
                $(button).prop("disabled", false);
                $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                $("#" + errClass['org_field']).css('background-color', '#FFC8C8');
                $("#" + errClass['vill_field']).css('background-color', '#FFC8C8');
                $("#" + errClass['vhv_field']).css('background-color', '#FFC8C8');
                return false;
            } else {
                var vhvname = document.getElementById('vhv_name').getAttribute('org_vhvid');
                if (vhvname == '') {
                    var data = {};
                    data["CF_Code"] = $("#cf_code").val();
                    data["cf_link_code"] = $('#cf_link_code').val();
                    data["Org_id"] = $("#org-id").val();
                    data["Vill_Code"] = $("#vill_code").val();
                    data["VHV_Name"] = $("#vhv_name").val();
                    var vhvData_to_post = JSON.stringify(data);
                    var save_update_org_check = $.ajax({
                        async: false,
                        type: "POST",
                        url: BACKEND_URL + "save_tbl_org_vhv",
                        headers: {
                            "X-CSRF_TOKEN": '{{ csrf_token() }}'
                        },
                        data: vhvData_to_post,
                        success: function(result) {
                            if (result == '1') {
                                console.log("save vhv success");
                            }
                        }
                    }).responseText;
                } else {
                    var data = {};
                    data["OrgVHV_ID"] = vhvname;
                    data["CF_Code"] = $("#cf_code").val();
                    data["cf_link_code"] = $('#cf_link_code').val();
                    data["Org_id"] = $("#org-id").val();
                    data["Vill_Code"] = $("#vill_code").val();
                    data["VHV_Name"] = $("#vhv_name").val();
                    var vhvData_to_update = JSON.stringify(data);
                    var save_update_org_check = $.ajax({
                        async: false,
                        type: "POST",
                        url: BACKEND_URL + "update_tbl_org_vhv",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        data: vhvData_to_update,
                        success: function(result) {
                            if (result == '1') {
                                console.log('update vhv success');
                            }
                        }
                    }).responseText;
                }
            }

            if (save_update_org_check == "1" || save_update_org_check == "2") {
                console.log('continuous to patient data saving funciton');
                var table = document.getElementById('data_entry_body');
                var alldata = [];
                var checker = "false";
                for (var i = 0, row; row = table.rows[i]; i++) {
                    //check if any column left empty
                    for (var j = 1, col; col = row.cells[j]; j++) {
                        if (col.children[0].value == "") {
                            $(button).prop("disabled", false);
                            $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                            col.children[0].style.background = "#FFC8C8";
                            checker = "true";
                        } else {
                            col.children[0].style.background = "white";
                        }
                    }

                    //Get all the data from controls inside <td>
                    var data = {};
                    data["CF_Code"] = $("#cf_code").val();
                    data["cf_link_code"] = $("#cf_link_code").val();
                    data["Row_No"] = row.cells[0].innerHTML;
                    //data["Screening_Date"] = $("#frm_year").val()+"-"+ $("#frm_month").val()+"-"+row.cells[1].children[0].value;

                    //Added on 2019-07-17
                    var dedt = row.cells[1].children[0].value.split("-");
                    //alert(isValidDate(dedt[0], dedt[1], dedt[2]));
                    if (isValidDate(dedt[0], dedt[1], dedt[2]) == true) {
                        data["Screening_Date"] = sortDate(row.cells[1].children[0].value);
                    } else {
                        bootbox.alert("Screening Date Format မှားယွင်းနေသည်။")
                            .on('hidden.bs.modal', function() {
                                row.cells[1].children[0].focus();
                            });
                        $(button).prop("disabled", false);
                        $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                        return false;
                    }
                    //Added on 2019-07-17 end

                    data["Screening_Date"] = sortDate(row.cells[1].children[0].value);
                    data["Pt_Name"] = row.cells[2].children[0].value;
                    data["Age_Year"] = row.cells[3].children[0].value;
                    data["Pt_Location"] = row.cells[4].children[0].value;
                    data["Pt_Address"] = row.cells[5].children[0].value;
                    data["Sex_Code"] = row.cells[6].children[0].value;
                    data["Preg_YN"] = row.cells[7].children[0].value;
                    data["Micro_Code"] = '7'; //default value
                    data["RDT_Code"] = row.cells[8].children[0].value;
                    data["IOC_Code"] = row.cells[9].children[0].value;
                    data["ACT_Code"] = row.cells[10].children[0].value;
                    data["CQ_Code"] = row.cells[11].children[0].value;
                    data["PQ_Code"] = row.cells[12].children[0].value;
                    data["Referral_Code"] = row.cells[13].children[0].value;
                    data["Malaria_Death"] = row.cells[14].children[0].value;
                    data["TG_Code"] = row.cells[15].children[0].value;
                    data["travel_yn"] = row.cells[16].children[0].value;
                    data["occupation"] = row.cells[17].children[0].value;
                    data["Remark"] = row.cells[18].children[0].value;

                    /* P_Number is 0, means this is a new record */
                    if (row.cells[0].getAttribute("P_Number") == "0") {
                        alldata.push(data);
                    }
                    /* P_Number is not 0, so this is an existing record. It will be updated with the new values. */
                    else {
                        if (checker == "true") {
                            $(button).prop("disabled", false);
                            $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                            return false;
                        } else {
                            data["P_Number"] = row.cells[0].getAttribute("P_Number");
                            var data_to_update = JSON.stringify(data);
                            console.log(data_to_update);
                            var xmlhttp1 = new XMLHttpRequest();
                            xmlhttp1.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    console.log(xmlhttp1.responseText);
                                    if (xmlhttp1.responseText == "1") {
                                        $(button).prop('disabled', false);
                                        $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                                        // bootbox.alert("Successfully updated!");
                                        // location.href = "/";
                                    } else {
                                        bootbox.confirm(xmlhttp1.responseText, function(result) {
                                            if (result == true) {
                                                //    bootbox.alert("go to home page");
                                                location.href = '/';
                                            } else {
                                                $(button).prop('disabled', false);
                                                $(button).html(
                                                    '<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                                                console.log(xmlhttp1.responseText);
                                            }
                                        });
                                    }
                                }
                            }
                            xmlhttp1.open("POST", BACKEND_URL + 'update_tbl_individual_case_temp');
                            xmlhttp1.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                            xmlhttp1.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                            xmlhttp1.send(data_to_update);
                        }
                    }
                }

                if (checker == "true") {
                    $(button).prop("disabled", false);
                    $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                    return false;
                } else {
                    $(button).prop("disabled", true);
                    $(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');
                    var data_to_post = JSON.stringify(alldata);
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if (xmlhttp.responseText == "1") {
                                $(button).prop('disabled', false);
                                $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                                bootbox.alert("Successfully saved!", function() {
                                    location.href = "/";
                                });
                            } else {
                                bootbox.confirm(xmlhttp.responseText, function(result) {
                                    if (result == false) {
                                        $(button).prop('disabled', false);
                                        $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                                    } else {
                                        location.href = '/';
                                    }
                                });
                            }
                        }
                    }

                    xmlhttp.open("POST", BACKEND_URL + 'save_tbl_individual_case_temp');
                    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xmlhttp.send(data_to_post);
                }
            } else {
                console.log(save_update_org_check);
                bootbox.confirm(save_update_org_check, function(result) {
                    if (result == false) {
                        $(button).prop('disabled', false);
                        $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                    } else {
                        location.href = '/';
                    }
                });
                // bootbox.alert('ကျေးရွာနှင့်စေတနာဝန်ထမ်းအမည်များသေချာစစ်ဆေးပါ');
                // console.log(save_update_org_check);
                // $(button).prop('disabled', false);
                // $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
            }
        }

        function save_tbl_total_patient() {
            var data = {};
            data["cf_link_code"] = $("#cf_link_code").val();
            data["Total_Outpatient"] = $("#txt_Total_Outpatient").val();
            data["U5_Outpatient"] = $("#txt_U5_Outpatient").val();
            data["Preg_Outpatient"] = $("#txt_Preg_Outpatient").val();
            data["Death_Facility"] = $("#txt_Death_Facility").val();
            data["Total_Inpatient"] = $("#txt_Total_Inpatient").val();
            data["U5_Inpatient"] = $("#txt_U5_Inpatient").val();
            data["Preg_Inpatient"] = $("#txt_Preg_Inpatient").val();
            var data_to_post = JSON.stringify(data);

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (xmlhttp.responseText == "1") {

                    } else {
                        bootbox.alert(xmlhttp.responseText);
                        return false;
                    }
                }
            }

            xmlhttp.open("POST", BACKEND_URL + 'save_tbl_total_patient_temp');
            xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xmlhttp.send(data_to_post);
        }

        function save_tbl_org_vhv() {
            var data = {}
            data["CF_Code"] = $("#cf_code").val();
            data["cf_link_code"] = $('#cf_link_code').val();
            data["Org_id"] = $("#org-id").val();
            data["Vill_Code"] = $("#vill_code").val();
            data["VHV_Name"] = $("#vhv_name").val();
            var vhvdata_to_post = JSON.stringify(data);

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (xmlhttp.responseText) {
                        console.log(xmlhttp.responseText);
                        return true;
                    } else {
                        bootbox.alert(xmlhttp.responseText);
                        return false;
                    }
                }
            }
            xmlhttp.open("POST", BACKEND_URL + 'save_tbl_org_vhv');
            xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xmlhttp.send(vhvdata_to_post);
            console.log(vhvdata_to_post);
        }

        function update_tbl_org_vhv(vhvname) {
            var data = {};
            data["OrgVHV_ID"] = vhvname;
            data["CF_Code"] = $("#cf_code").val();
            data["cf_link_code"] = $('#cf_link_code').val();
            data["Org_id"] = $("#org-id").val();
            data["Vill_Code"] = $("#vill_code").val();
            data["VHV_Name"] = $("#vhv_name").val();
            var vhvdata_to_update = JSON.stringify(data);

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (xmlhttp.responseText) {
                        console.log(xmlhttp.responseText);
                        return true;
                    } else {
                        console.log(xmlhttp.responseText);
                        return false;
                    }
                }
            }
            xmlhttp.open("POST", BACKEND_URL + 'update_tbl_org_vhv');
            xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xmlhttp.send(vhvdata_to_update);
            console.log(vhvdata_to_update);
        }

        function isValidDate(d, m, y) {
            var thirtyDaysMonth = [9, 4, 6, 11];

            if (parseInt(d) && parseInt(m) && parseInt(y)) {
                if (parseInt(d) === 9 && parseInt(m) === 9 && parseInt(y) === 999) {
                    return true;
                } else {
                    if (parseInt(y) > 9999 || parseInt(m) > 12 || parseInt(d) > 31 || parseInt(y) < 1900) {
                        return false;
                    }
                    if (thirtyDaysMonth.includes(parseInt(m))) {
                        if (parseInt(d) > 30) {
                            return false;
                        }
                    }
                    if (parseInt(m) == 2) {
                        if (parseInt(d) > 28) {
                            if (parseInt(y) % 4 == 0) {
                                return true;
                            }
                            return false;
                        }
                    }
                }
                return true;
            } else {
                return false;
            }
        }

        function checkBtn() {
            var btn = document.getElementById('add_row');
            var row_count = get_row();
            if (row_count >= 17) {
                $(btn).prop('disabled', true);
                $(btn).html('<li class="fa fa-ban"></li> Maximun');
            } else {
                $(btn).prop('disabled', false);
                $(btn).html('<li class="fa fa-plus-square"></li> အသစ်တစ်ကြောင်းတိုးရန်');
            }
        }

        function get_row() {
            var table = document.getElementById('data_entry_body');
            for (var i = 0, row; row = table.rows[i]; i++) {
                var row_count = row.cells[19].children[0].getAttribute('rowNo');
            }
            return row_count;
        }

        function add_row(btn) {
            $(btn).prop('disabled', true);
            $(btn).html('<li class="fa fa-spinner fa-spin"></li> ခေတ္တစောင့်ပါ');
            var table = document.getElementById('data_entry_body');
            var row_count = get_row();
            if (row_count >= 17) {
                bootbox.alert('Maximum');
                checkBtn();
            } else {
                $.ajax({
                    type: "GET",
                    url: "http://" + window.location.host + "/get_vhv_dataentry_row/{{ $lp_township_de }}",
                    data: "",
                    success: function(data) {
                        $("#data_entry_body").append(data);
                        set_row_numbers();
                        checkBtn();
                        set_focus();
                    },
                    error: function(error) {
                        bootbox.alert(error.statusText);
                        checkBtn();
                    }
                });
            }
        }

        function set_row_numbers() {
            var table = document.getElementById('data_entry_body');
            for (var i = 0, row; row = table.rows[i]; i++) {
                row.cells[0].innerHTML = i + 1;
                row.cells[19].children[0].setAttribute("rowNo", i + 1);
            }
        }

        function delete_row(btn) {
            var rowNum = $(btn).attr("rowNo");
            bootbox.confirm("Row အမှတ် " + rowNum + " တစ်ခုလုံးအား အပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ", function(result) {
                if (result == true) {
                    $(btn).closest('tr').remove();
                    set_row_numbers();
                }
                checkBtn();
            });
        }

        function delete_existing_row(p_number, sync) {
            if (sync == "1") {
                bootbox.alert(
                    "ဤအချက်အလက်သည် server ပေါ်သို့ပို့ဆောင်ပြီးဖြစ်ပါသဖြင့် ပြုပြင်ခြင်း၊ဖျက်ခြင်းများ ခွင့်မပြုပါ");
                return false;
            } else {
                $.ajax({
                    url: BACKEND_URL + 'delete_tbl_individual_by_code/' + p_number,
                    method: 'post',
                    headers: {
                        "X-CSRF_TOKEN": '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        alert(result);
                        $(btn).closest('tr').remove();
                        set_row_numbers();
                    }
                });
                checkBtn();
            }
        }

        function close_page() {
            bootbox.confirm("ယခုစာမျက်နှာအားပိတ်မည်။ သေချာပါက OK နှိပ်ပါ", function(result) {
                if (result == true) {
                    location.href = '/';
                }
            });
        }

        $(".dentry_age").on('keypress keyup blur', function(event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(".num-only").keyup(function() {
            var v = $(".num-only").val();

            if ($.isNumeric(v) == false) {
                v = v.substring(0, v.length - 1);
                $(".num-only").val(v);
            }
        });

        $(".num-only").change(function() {
            var v = $(".num-only").val();

            if ($.isNumeric(v) == false) {
                bootbox.alert("နံပါတ်များသာရိုက်သွင်းပါ");
                $(".num-only").val("");
            }
        });

        set_row_numbers();

        function sortDate(dGet) {
            var aSplit = dGet.split('-');
            var temp = aSplit[0];
            aSplit[0] = aSplit[2];
            aSplit[2] = temp;
            temp = '';
            return aSplit.join('-');
        }
    </script>
</body>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .org-block {
        width: 30%;
        float: left;
    }

    .org-block>label {
        width: 35%;
        float: left;
    }

    .org-block>select {
        width: 65%;
        float: left;
    }

    .village-block {
        width: 20%;
        float: left;
    }

    .vhv-block {
        width: 30%;
        float: left;
    }

    .month-block {
        width: 10%;
        float: left;
    }

    .year-block {
        width: 10%;
        float: left;
    }

    .sec-row-label {
        margin-right: 35px;
        border: none;
        border-bottom: 2px dotted gray;
        text-align: center;
        font-weight: 600;
        font-size: 12px;
        color: black;
        width: 45%;
    }

    .sec-row-label:focus {
        outline: none !important;
    }

    .sec-row-select {
        margin-right: 25px;
        width: 180px;
        font-size: 12px;
        font-weight: 600;
    }

    .delete_icon {
        margin: 3px;
        color: red;
    }

    .top-label-value {
        border-bottom: 2px dotted grey;
        padding: 5px 10px;
        font-weight: 600;
        color: black;
        font-size: 12px;
    }

    .top-label {
        font-size: 12px;
        margin-right: 20px;
        margin-bottom: 20px;
        color: #555;
        font-weight: 600;
    }

    .wrap {
        padding-right: 20px;
        padding-left: 20px;
        margin-right: auto;
        margin-left: auto;
    }

    .first-row,
    .sec-row,
    .third-row {
        margin-bottom: 15px;
    }

    .label-right {
        text-align: right;
    }

    .header {
        color: white;
        font-weight: 700;
        background: #D3492E;
    }

    .mmtext-12 {
        font-size: 12px;
        color: #555;
    }

    .mmtext-10 {
        font-size: 10px;
        color: #555;
    }

    table.dataTable thead tr {
        background-color: #4c4c4c;
        color: white;
    }

    .table>thead>tr>th,
    .table>tbody>tr>td {
        text-align: center;
        vertical-align: middle;
        padding: 2px;
        border: 1px solid grey;
        padding: 0px;
        margin: 0px;
        font-weight: normal;
    }

    input,
    select {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        padding: 0px;
        height: 30px;
        font-weight: 600;
    }

    tbody>tr>td>input {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        width: 100%;
        padding: 0px;
        margin: 0px;
        border: none;
        height: 30px;
        font-weight: 600;
    }

    tbody>tr>td>select {
        font-size: 12px;
        text-align: left;
        height: 20px;
        width: 100%;
        border: none;
        height: 30px;
        font-weight: 600;
    }

    tbody>tr>td>input:focus {
        font-size: 12px;
        color: #000;
        outline: none;
        background-color: #bdbdbd !important;
    }

    tbody>tr>td>select:focus {
        outline: none;
        background-color: #bdbdbd !important;
    }
</style>
<script>
    $("#data_entry_row tr td input").focus(function() {
        highlight_row(this);
    });

    $("#data_entry_row tr td select").focus(function() {
        highlight_row(this);
    });
</script>

</html>
