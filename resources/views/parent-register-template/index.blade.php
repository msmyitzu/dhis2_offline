<!-- Font Awesome Icons -->
<link href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>

<div class="header_bar">
    <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="https://mcbrs-dev2.myanmarvbdc.com/" class="">
                <img src="{{ asset('img/mcbrs_logo.png') }}" class="user-image" alt="User Image">
                <span class="card-title"> Malaria Case-Based Reporting for VBDC Myanmar </span>
            </a>
        </li>
        <li>

            {{-- <a href="/uploadForm" class="" id="">Upload to Online</a> --}}
            <a href="/uploadview" class="" id="">Upload to Online</a>
        </li>
        <li>

            <a href="/userprofile" class="" id=""> Go to Profile </a>
        </li>

        <li>
            {{-- id="showPopupBtnDownload" --}}
            {{-- <a href="" class="upload_to_online_btn" onclick="downloadDataFromOnline()">Download from Online</a> --}}
        </li>

        <li class="signout_btn">
            <a href=" {{ url('/logout') }} ">Sign Out</a>
        </li>

    </ul>



</div>
@if ($message = Session::get('success'))
    <div class="alert alert-info alert-block text-center ct-margin">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($errors->has('error'))
    <div class="alert alert-danger text-center ct-margin">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $errors->first('error') }}</strong>
    </div>
@endif
<div class="" style="text-align:center;padding-bottom:15px;">
    <h4 class="form_head" style="font-weight: 600; color:rgb(44, 102, 147); padding-top:10px;align:center;">
        ပုံစံအချက်အလက်များကိုသေချာရွေးချယ်ပါ။</h4>
</div>

<main>
    <div class="tab-pane active " id="data_entry">
        <div class="row">
            @if (!isset($tbl_nil))


                <div class=""style="margin-left:25px;">
                    {{-- <div class="text-center" style="border: 1px solid #E3E3E3;      background-color:#FBFBFB"> --}}
                    {{-- <h5>ပုံစံအချက်အလက်များကိုသေချာရွေးချယ်ပါ။</h5> --}}
                    <form class="form_styling" id="frm-patient-register-form" method="post"
                        action="patient-register-form" style="font-weight: 600;">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row" style="">
                                {{-- justify-content-evenly --}}
                                <div class="form-group col-md-5" id="service_provider">
                                    <label for="" class="control-label"style="padding-bottom:10px;">Service
                                        Provider
                                        *</label>
                                    <div class="">
                                        <select class="form-control select2" name="select_lp_form_cat"
                                            id="select_lp_form_cat" style="height:50px; padding-left:10px;"
                                            onclick="load_icmv_village('select_lp_form_cat',this.value)">
                                            <option value="0" disabled selected>Service Provider</option>
                                            <option value="Basic Health Staff">Basic Health Staff</option>
                                            <option value="ICMV">ICMV</option>
                                            <option value="GP">GP</option>
                                            <option value="Private Outlet">Private Outlet</option>
                                            <option value="Other Ministry">Other Ministry</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-md-5" id="data_entry_type">
                                    <label for="" class="control-label" style="padding-bottom:10px;">Data Entry
                                        Type
                                        *</label>
                                    <div class="">
                                        <select id="dataEntry" name="dataEntry" class="form-control select2"
                                            style=" height:50px;">
                                            <option value="" selected disabled>Data Entry</option>
                                            <option value="Clinic data">Clinic data (OP/IP) and Carbonless register
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5" id="state_region" hidden>
                                    <label for="" class=" control-label"
                                        style="padding-bottom:10px;">ပြည်နယ်/တိုင်းဒေသကြီး *</label>
                                    <div class="">
                                        <select class="form-control select2" style="height:50px;"
                                            name="select_lp_state_region" id="data_select_region">
                                            <option value="0" disabled>ရွေးပါ</option>
                                            {{-- @foreach ($data_region as $region) --}}
                                                {{-- <option value="{{ $region->region_mmr }}">{{ $region->region_name_en }}
                                                </option> --}}
                                            {{-- @endforeach --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-5" id="state_district" hidden>
                                    <label for="" class=" control-label"
                                        style="padding-bottom:10px;">ခရိုင်</label>
                                    <div class="">
                                        <select class="form-control select2" style="height:50px;"
                                            name="select_lp_state_region" id="data_select_district">
                                            <option value="0" disabled>ရွေးပါ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-5" id="township">
                                    <label for="" class=" control-label"
                                        style="padding-bottom:10px;">မြို့နယ်
                                        *</label>
                                    <div class="">
                                        <select name="select_lp_township_de" id="data_select_township"
                                            class="form-control select2 select_lp_township_de" style="height:50px;">
                                            <option value="0" disabled selected>ရွေးပါ</option>
                                                {{-- @foreach ($data_township as $township)
                                                <option value="{{ $data_township->township_mmr }}">
                                                    {{ $data_township->township_name_en }}
                                                </option>
                                                @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-5" id="rhc_health">
                                    <label for="" id="rhc_label" class="control-label"
                                        style="word-wrap: anywhere; padding-bottom:10px;">မြို့နယ်/တိုက်နယ်ဆေးရုံ/ကျန်းမာရေးဌာန
                                        *</label>
                                    <div class="">
                                        <select name="select_tbl_hfm_de" id="data_select_hf"
                                            class="form-control select2" style="height:50px;">
                                            <option selected="" disabled>ရွေးပါ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-5" id="sc_health">
                                    <label for="" id="sc_label" class="control-label"
                                        style="word-wrap: anywhere; padding-bottom:10px;">
                                        ကျန်းမာရေးဌာနခွဲ *</label>
                                    <div class="">
                                        <select name="select_hfm_de" id="data_select_subcenter"
                                            class="form-control select2" style="height:50px;">
                                            <option selected="selected" disabled>ရွေးပါ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="form-group col-md-2" style="margin-top:35px; display:none; "
                                    id="icmvSelect">
                                    <label for="icmvSelect" class=" control-label" style="padding-bottom:10px;">ICMV
                                        village *</label>
                                    <div class="icmbSelects" style="">
                                        <select id="data_select_village" name="icmvOption"
                                            class="form-control select2" style="height:50px;">
                                            <option value="" disabled>ရွေးပါ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" style="margin-top:35px;" id="rp_month">
                                    <label for="" class="control-label"
                                        style="padding-bottom:10px;">အစီရင်ခံသည့်
                                        လ/ခုနှစ် *</label>
                                    <div class="month">
                                        <input type="month" id="start" name="start" id="handleMonth"
                                        max="<?= date('Y-m') ?>"
                                            class="form-control text-center" style="height:50px;" autocomplete=off onchange="handleMonth(this)" >

                                    </div>



                                </div>

                                <div class="form-group col-md-3"style="margin-top:20px;" id="bloodTest">
                                    <label for="" class=" control-label"
                                        style="text-align:left;
                                padding-bottom:10px;">ယခုလအတွင်း
                                        ငှက်ဖျားလူနာ<br>သွေးဖောက်စစ်ဆေးမှုရှိပါသလား*</label>
                                    <div class="">
                                        <select name="chooseOption" id="chooseOption"
                                            onclick="showConditionalSelect()" class="form-control select2"
                                            style="height:50px;">
                                            <option value=""selected disabled>ရွေးပါ</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-2" style="margin-top:35px; display:none;"
                                    id="conditionalSelect">
                                    <label for="conditionalOption" class=" control-label"
                                        style="padding-bottom:10px;">Activities *</label>
                                    <div class="data" style="">
                                        <select id="conditionalOption" name="conditionalOption"
                                            class="form-control select2" style="height:50px;">
                                            <option value="" selected disabled>ရွေးပါ</option>
                                            <option value="PCD">PCD</option>
                                            <option value="ACD">ACD</option>
                                            <option value="RACD">RACD</option>
                                            <option value="PACD">PACD</option>
                                            <option value="Mass Screening">Mass Screening</option>
                                            <option value="Larger Screenig">Larger Screening</option>
                                            <option value="Mobile Clinic">Mobile Clinic</option>
                                            <option value="Screening Point">Screening Point</option>
                                            <option value="option9">Survey</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>


                        @extends('nmcp-template.patient-register-form')
                        {{-- @extends('data-entry.patient-register-form') --}}

                        <input type="hidden" id="cf_code" name="cf_code" />
                        <input type="hidden" id="cf_link_code" name="cf_link_code" />
                    </form>
                </div>
            @else
                <span class="hidden" id="township_edit">{{ $tbl_core->township_mmr }}</span>
                <input type="text" id="township_edit" value="{{ $tbl_core->township_mmr }}">
            @endif


        </div>
        <div class="col-md-6">

        </div>

        <!-- /.box-header with-border -->
    </div>
    <!-- /.row-->
    </div>
    <div class="row">


        {{-- <div class="first-row" style="text-align: center;"> --}}
        {{-- <label class="control-label top-label">အထွေထွေဆေးခန်းလာပြင်ပလူနာသစ်ပေါင်း (ပြင်ပ)*</label> --}}
        <div class=""
            style="border: 1px solid #fff; box-shadow: grey 3px 3px 1px; border-radius: 10px; background-color:white; color:#000;"
            >

            <div class="text-center" style="padding: 20px">
                {{-- <span style="float:left; font-size: 10px;">ပုံစံအမျိုးအစား - </span> --}}
                {{-- {{ $lp_form_cat_name }} --}}
                <h3>ငှက်ဖျားလူနာစစ်ဆေးကုသမှုမှတ်တမ်း /လချုပ်</h3>
                <hr>
                {{-- / <span style="float:right; font-size: 10px;">Form No - </span> --}}
                {{-- {{ $form_number }} --}}
            </div>

            <table class="" style="margin-left:20px;">

                @if (isset($tbl_nil))
                    <tbody align="left">
                        <input type="hidden" id="ic_id_code" name="ic_id_code" value = "{{ $tbl_nil->cf_id }}" />
                        <tr style="padding-bottom:20px;">
                            <td style="padding:10px; padding-right:50px; margin-right:20px;">

                                <small style="font-weight: 700; font-size: 15px; padding-right:10px; ">
                                    အထွေထွေဆေးခန်းလာပြင်ပလူနာသစ်ပေါင်း(ပြင်ပ)* - </small>
                                <input type="text" id="txt_total_outpatient"
                                    value="{{ $tbl_nil->total_outpatient }}" style="width: 20%;padding-left:10px;">

                            </td>
                            <td style="padding:10px 50px 10px 30px;  margin-right:20px">

                                <small style="font-weight: 700; font-size: 15px; padding-right:10px;">
                                    ငါးနှစ်အောက်အထွေထွေဆေးခန်းလာ(ပြင်ပ)
                                    - </small>
                                <input type="text" id="txt_total_child_out" value="{{ $tbl_nil->u5_outpatient }}"
                                    style="width: 20%; ">

                            </td>
                            <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                <small style="font-weight: 700; font-size: 15px; padding-right:10px;">
                                    ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(ပြင်ပ)
                                    - </small>
                                <input type="text" id="txt_total_preg_out"
                                    value="{{ $tbl_nil->preg_outpatient }}" style="width: 20%; margin-right:20px;">

                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                <small style="font-weight: 700; font-size: 15px; padding-right:10px;">
                                    ဆေးရုံတက်အတွင်းလူနာသစ်ပေါင်း - </small>
                                <input type="number" id="txt_total_inpatient"
                                    value="{{ $tbl_nil->total_inpatient }}" style="width: 20%; ">
                            </td>
                            <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                <small style="font-weight: 700; font-size: 15px;"> ငါးနှစ်အောက်အထွေထွေဆေးခန်းလာ(အတွင်း)
                                    - </small>
                                <input type="number" id="txt_total_in_child" value="{{ $tbl_nil->u5_inpatient }}"
                                    style="width: 20%; ">

                            </td>
                            <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                <small style="font-weight: 700; font-size: 15px;">
                                    ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(အတွင်း)
                                    - </small>
                                <input type="number" id="txt_total_preg_in" value="{{ $tbl_nil->preg_inpatient }}"
                                    style="width: 20%; margin-right:20px; ">

                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                <small style="font-weight: 700; font-size: 15px;"> ဆေးရုံတွင်သေဆုံးသူစုစုပေါင်း -
                                </small>
                                <input type="number" id="txt_total_death_in" value="{{ $tbl_nil->death_facility }}"
                                    style="width: 20%; ">

                            </td>
                            <td></td>
                        </tr>


                    </tbody>
                @else
                    <div id="nilTable">
                        <tbody align="left">
                            <tr style="padding-bottom:20px;">
                                <td style="padding:10px; padding-right:50px; margin-right:20px;">

                                    <small style="font-weight: 700; font-size: 15px; padding-right:10px; ">
                                        အထွေထွေဆေးခန်းလာပြင်ပလူနာသစ်ပေါင်း(ပြင်ပ)* - </small>
                                    <input type="number" id="txt_total_outpatients" oninput="maxLengthCheckTop(this)"
                                        value="" style="width: 20%;padding-left:10px;">



                                </td>
                                <td style="padding:10px 50px 10px 30px;  margin-right:20px">

                                    <small style="font-weight: 700; font-size: 15px; padding-right:10px;">
                                        ငါးနှစ်အောက်အထွေထွေဆေးခန်းလာ(ပြင်ပ)
                                        - </small>
                                    <input type="number" id="txt_total_childs_out" oninput="maxLengthCheckTco(this)"
                                        value="" style="width: 20%; ">

                                </td>
                                <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                    <small style="font-weight: 700; font-size: 15px; padding-right:10px;">
                                        ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(ပြင်ပ)
                                        - </small>
                                    <input type="number" id="txt_total_pregs_out" oninput="maxLengthCheckTpo(this)"
                                        value="" style="width: 20%; margin-right:20px;">

                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                    <small style="font-weight: 700; font-size: 15px; padding-right:10px;">
                                        ဆေးရုံတက်အတွင်းလူနာသစ်ပေါင်း - </small>
                                    <input type="number" id="txt_total_inpatients" oninput="maxLengthCheckTip(this)"
                                        value="" style="width: 20%; ">
                                </td>
                                <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                    <small style="font-weight: 700; font-size: 15px;"> ငါးနှစ်အောက်အထွေထွေဆေးခန်းလာ(အတွင်း)
                                        - </small>
                                    <input type="number" id="txt_total_in_childs" oninput="maxLengthCheckTic(this)"
                                        value="" style="width: 20%; ">

                                </td>
                                <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                    <small style="font-weight: 700; font-size: 15px;">
                                        ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(အတွင်း)
                                        - </small>
                                    <input type="number" id="txt_total_pregs_in" oninput="maxLengthCheckTpi(this)"
                                        value="" style="width: 20%; margin-right:20px; ">

                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding:10px 50px 10px 30px; margin-right:20px">

                                    <small style="font-weight: 700; font-size: 15px;"> ဆေးရုံတွင်သေဆုံးသူစုစုပေါင်း -
                                    </small>
                                    <input type="number" id="txt_total_deaths_in" oninput="maxLengthCheckTdi(this)"
                                        value="" style="width: 20%; ">

                                </td>
                                <td></td>
                            </tr>


                        </tbody>
                    </div>

                @endif
            </table>
        </div>


        {{-- <span class="top-label-value"></span> --}}
        {{-- {{ $lp_state_region_name }} --}}







        {{-- </div> --}}


        <?php
                if(isset($tbl_total_patient_temp)){
                    if(count($tbl_total_patient_temp) > 0){
                        //echo "this is tbl greater than zero";
                        foreach($tbl_total_patient_temp as $tp){
            ?>
        <table width='100%' id='tbl_iop'>
            <tbody id='tbody_iop'>
                <tr>
                    <td>အထွေထွေဆေးခန်းလာပြင်ပလူနာသစ်ပေါင်း</td>
                    <td><input class="" type="number" id='txt_Total_Outpatient'
                            value={{ $tp->Total_Outpatient }}></td>
                    <td>ငါးနှစ်အောက်အထွေထွေဆေးခန်းလာ(ပြင်ပ)</td>
                    <td><input class="" type="number" id='txt_U5_Outpatient'
                            value="{{ $tp->U5_Outpatient }}"></td>
                    <td>ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(ပြင်ပ)</td>
                    <td><input class="" type="number" id='txt_Preg_Outpatient'
                            value="{{ $tp->Preg_Outpatient }}" onblur="chNumOut()"></td>
                    <td></td>
                    <td></td>
                    <td>လ</td>
                    <td><input type="text" id='frm_month'value='{{ $form_month }}' disabled></td>
                </tr>

            </tbody>
        </table>
        <?php
                }}else{
                    //echo "this is plane table";
            ?>
        <table width='100%' id='tbl_iop'>
            <tbody id='tbody_iop'>
                <tr>
                    <td>အထွေထွေဆေးခန်းလာပြင်ပ
                        လူနာသစ်ပေါင်း</td>
                    <td><input type="number" class="" id='txt_Total_Outpatient' /></td>
                    <td>ငါးနှစ်အောက်အထွေထွေဆေးခန်းလာ(ပြင်ပ)</td>
                    <td><input type="number" class="" id='txt_U5_Outpatient' value="0"></td>
                    <td style="margin-right: 20px;">ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(ပြင်ပ)</td>
                    <td><input type="number" inputmode="numeric" pattern="[0-9]*" class=""
                            id='txt_Preg_Outpatient' value="0" onblur="chNumOut()"></td>
                    <td></td>
                    <td></td>
                    <td>လ</td>
                    <td><input type="number" id='frm_month'value='{{ $form_month }}' disabled></td>
                </tr>

            </tbody>
        </table>
        <?php }} ?>


        <div id="dEntryTable">

            <button class="btn btn-default btn-sm pull-right newsBtn"
                style="margin-top: 20px; margin-bottom: 10px; margin-right:30px; padding:10px;" id="add_row"
                onClick="add_row(this)">
                <li class="fa fa-plus-square text-white" style="margin-right:20px;"></li>အသစ်တစ်ကြောင်းထပ်တိုးရန်
            </button>
            <div class="col-md-12 table-container" style="padding: 10px;">
                <div class="">
                    <table class="table table-bordered dataTable" id="dynamicInput" id="register-table"
                        style="background-color: rgb(120, 120, 114); justify-content:center">
                        <thead class="mmtext-12">
                            <tr>
                                <th rowspan="2" width="20px">စဉ်</th>
                                <th rowspan="2" width="80px">ရက်စွဲ</th>
                                <th rowspan="2">အမည်</th>
                                <th rowspan="2" width="35px">အသက်</th>
                                <th rowspan="2" width="100px">အဘအမည်</th>
                                <th rowspan="2" width="150">ကျန်းမာရေးဌာန<br>အတွင်းရှိရွာ<br>
                                    (ဟုတ်/မဟုတ်)</th>
                                <th rowspan="2" width="100">မြို့နယ်<br>
                                    (လက်ရှိနေရပ်လိပ်စာ)</th>
                                <th rowspan="2" width="100">ကျေးရွာ/ရပ်ကွက်<br>
                                    (လက်ရှိနေရပ်လိပ်စာ)</th>
                                <th rowspan="2" width="100">ကျေးရွာ/ရပ်ကွက်အမည်<br>
                                    (လက်ရှိနေရပ်လိပ်စာ)</th>
                                <th rowspan="2" width="100">မြို့နယ်<br>
                                    (အမြဲတမ်းနေရပ်လိပ်စာ)</th>
                                <th rowspan="2" width="100">ကျေးရွာ/ရပ်ကွက်<br>
                                    (အမြဲတမ်းနေရပ်လိပ်စာ)</th>
                                <th rowspan="2" width="100">ကျေးရွာ/ရပ်ကွက်အမည်<br>
                                    (အမြဲတမ်းနေရပ်လိပ်စာ)</th>
                                <th rowspan="2" width="80">လိင်<br>(ကျား/မ)</th>
                                <th rowspan="2" width="80">ကိုယ်၀န်ဆောင်</th>
                                <th rowspan="2" width="70px">မှန်ဘီလူးဖြင့်စစ်ဆေး</th>
                                <th rowspan="2" width="70px">RDTဖြင့်စစ်ဆေး</th>
                                <th rowspan="2" width="90px">ပြင်ပ/အတွင်း</th>
                                <th colspan="3" width="150" height="20px">ကုသပေးသော<br />ငှက်ဖျားဆေး</th>
                                <th rowspan="2" width="80">Referral</th>
                                <th rowspan="2" width="50px">Mp(+) <br>Malaria Death</th>
                                <th rowspan="2" width="50px">Treatment Given</th>
                                <th rowspan="2" width="80px">ခရီးသွားခြင်း <br>(၂ပတ်-၁လအတွင်း)</th>
                                <th rowspan="2" width="110px">အလုပ်အကိုင်</th>
                                <th rowspan="2" width="70px">မှတ်ချက်</th>
                                <th rowspan="2" style="width: 20px"></th>
                            </tr>
                        </thead>
                        <thead class="mmtext-12">
                            <tr class="engRows">
                                <th rowspan="2" width="20px">Sr</th>
                                <th rowspan="2" width="80px">Date</th>
                                <th rowspan="2" width="100px">Name</th>
                                <th rowspan="2" width="35px">Age</th>
                                <th rowspan="2" width="100px">Father's Name</th>
                                <th rowspan="2" width="150">Patient who lives<br> in the village<br>
                                    within the Sub-center
                                    (Yes/No)</th>
                                <th rowspan="2" width="100">Township<br>
                                    (Current Address)</th>
                                <th rowspan="2" width="100">Village/Ward<br>
                                    (Current Address)</th>
                                <th rowspan="2" width="100">Village/Ward Name<br>
                                    (Current Address)</th>
                                <th rowspan="2" width="100">Township<br>
                                    (Permanent Address)</th>
                                <th rowspan="2" width="100">Village/Ward<br>
                                    (Permanent Address)</th>
                                <th rowspan="2" width="100">Village/Ward Name<br>
                                    (Permanent Address)</th>
                                <th rowspan="2" width="80">Sex</th>
                                <th rowspan="2" width="80">Pregnant</th>
                                <th rowspan="2" width="70px">Exam by Microscope</th>
                                <th rowspan="2" width="70px">Exam by RDT</th>
                                <th rowspan="2" width="90px">OP/IP</th>
                                <th colspan="3" width="150" height="20px">Treatment by<br>
                                    Malaria Drug</th>
                                <th rowspan="2" width="80">Referral</th>
                                <th rowspan="2" width="50px">Mp(+) <br>Malaria Death</th>
                                <th rowspan="2" width="50px">Treatment Given</th>
                                <th rowspan="2" width="80px">Travelling
                                </th>
                                <th rowspan="2" width="110px">Occupation</th>
                                <th rowspan="2" width="70px">Remark</th>
                                <th rowspan="2" style="width: 20px"></th>
                            </tr>
                            <tr class="engRows">
                                <th width="100px">ACT</th>
                                <th width="100px">CQ</th>
                                <th width="100px">PQ</th>
                        </thead>

                        <tbody id="data_entry_body">

                            @if (isset($tbl_individual_cases))
                                @foreach ($tbl_individual_cases as $cases)
                                    <tr id="data_entry_row">
                                        <td style="font-size:10px; font-weight: bold;" P_Number="0">
                                            {{ $cases->ic_id }}
                                        </td>
                                        <td>
                                            <input type="date" id="date" oninput="adjustInputWidth(this)"
                                                name="date" max="<?= date('Y-m-d') ?>" placeholder="dd/mm/yyyy"
                                                value="{{ $cases->screening_date }}" required>

                                        </td>
                                        <td><input type="text" id="" oninput="adjustInputWidth(this)"
                                                placeholder="အမည်" value="{{ $cases->pt_Name }}" required></td>
                                        <td><input id="age" type="text" placeholder="အသက်"
                                                onchange="checkAge(this);" class="age" required=""
                                                value="{{ $cases->pt_age }}"></td>
                                        <td><input type="text" id="" oninput="adjustInputWidth(this)"
                                                placeholder="အဘအမည်" value="{{ $cases->pt_father_name }}" required>
                                        </td>


                                        <td>
                                            <select class="" name="address" id=""
                                                onchange="outsideTownShipResult(this);">

                                                <option value="" disabled>ရွေးပါ</option>
                                                <option value="Within Township"
                                                    {{ $cases->pt_address == 'Within Township' ? 'selected' : '' }}>
                                                    Within township</option>
                                                <option value="No (Outside Township)"
                                                    {{ $cases->pt_address == 'No (Outside Township))' ? 'selected' : '' }}>
                                                    No (Outside Township)</option>
                                                <option value="No (Outside Country)"
                                                    {{ $cases->pt_address == 'No (Outside Country)' ? 'selected' : '' }}>
                                                    No (Outside Country)</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="" name="address" id=""
                                                onchange="outsideHFResult(this)">
                                                {{-- --}}
                                                <option value="{{ $cases->pt_current_township }}" selected>
                                                    {{ $cases->pt_current_township }}</option>
                                                {{-- <option value="" selected disabled> မြို့နယ်(လက်ရှိနေရပ်လိပ်စာ)</option> --}}
                                            </select>

                                        </td>

                                        <td>
                                            <select class="" name="address" id="">
                                                <option value="{{ $cases->pt_current_village }}" selected>
                                                    {{ $cases->pt_current_village }}</option>
                                                {{-- <option value="" selected disabled>ကျေးရွာ/ရပ်ကွက်(လက်ရှိနေရပ်လိပ်စာ)</option> --}}

                                            </select>

                                        </td>
                                        <td>
                                            <select class="" name="address" id="dAddress" disabled
                                                onchange="location_changed(this)">
                                                <option value="{{ $cases->pt_current_ward }}" selected>
                                                    {{ $cases->pt_current_ward }}</option>

                                            </select>

                                        </td>
                                        <td>
                                            <select class="" name="address" id=""
                                                onchange="currentHFResult(this)">
                                                <option value="{{ $cases->pt_permanent_township }}" selected>
                                                    {{ $cases->pt_permanent_township }}</option>
                                                {{-- <option value="" selected>မြို့နယ်(အမြဲတမ်းနေရပ်လိပ်စာ)</option> --}}
                                            </select>

                                        </td>
                                        <td>
                                            <select class="" name="address" id=""
                                                onchange="location_changed(this)">
                                                <option value="{{ $cases->pt_permanent_village }}" selected>
                                                    {{ $cases->pt_permanent_village }}</option>
                                                {{-- <option value="" selected>ကျေးရွာ/ရပ်ကွက်(အမြဲတမ်းနေရပ်လိပ်စာ)</option> --}}
                                            </select>

                                        </td>
                                        <td>
                                            <input type="text" class="other-address"
                                                value="{{ $cases->pt_permanent_ward }}"
                                                placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း" disabled="true">
                                        </td>
                                        <td>
                                            <select name="sex" id="sex"
                                                onchange="checkSex(this); adjustInputWidth(this)" class="sex">

                                                <option value="" selected disabled>ရွေးပါ</option>
                                                <option value="TT-Male"
                                                    {{ $cases->Sex_Code == 'TT-Male' ? 'selected' : '' }}>Male</option>
                                                <option value="TT-female"
                                                    {{ $cases->Sex_Code == 'TT-female' ? 'selected' : '' }}>Female
                                                </option>

                                            </select>
                                        </td>
                                        <td>
                                            <select name="preg" id="preg" class="preg"
                                                onchange="checkPreg(this); adjustInputWidth(this);" required>

                                                <option value="" disabled>ရွေးပါ</option>
                                                {{-- <option value="N/A">N/A</option> --}}
                                                <option value="Yes"
                                                    {{ $cases->Preg_YN == 'Yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="No"
                                                    {{ $cases->Preg_YN == 'No' ? 'selected' : '' }}>
                                                    No</option>


                                            </select>
                                        </td>
                                        <td>
                                            <select name="rsc_test" id="rsc_test"
                                                onchange="checkTestResult(this); adjustInputWidth();" class=""
                                                required>
                                                <option value="not exam"
                                                    {{ $cases->Micro_Code == 'not exam' ? 'selected' : '' }}>Not Exam
                                                </option>
                                                <option value="neg"
                                                    {{ $cases->Micro_Code == 'neg' ? 'selected' : '' }}>Negative
                                                </option>
                                                <option value="pf"
                                                    {{ $cases->Micro_Code == 'pf' ? 'selected' : '' }}>Pf</option>
                                                <option value="pv"
                                                    {{ $cases->Micro_Code == 'pv' ? 'selected' : '' }}>Pv</option>
                                                <option value="mixed"
                                                    {{ $cases->Micro_Code == 'mixed' ? 'selected' : '' }}>Mixed
                                                </option>
                                                <option value="pm"
                                                    {{ $cases->Micro_Code == 'pm' ? 'selected' : '' }}>Pm</option>
                                                <option value="po"
                                                    {{ $cases->Micro_Code == 'po' ? 'selected' : '' }}>Po</option>

                                            </select>
                                        </td>
                                        <td>
                                            <select name="rdt_test" id="rdt_test" class=""
                                                onchange="checkTestResult(this); adjustInputWidth(this);" required>
                                                <option value="not exam"
                                                    {{ $cases->RDT_Code == 'not exam' ? 'selected' : '' }}>Not Exam
                                                </option>
                                                <option value="neg"
                                                    {{ $cases->RDT_Code == 'neg' ? 'selected' : '' }}>Negative</option>
                                                <option value="pf"
                                                    {{ $cases->RDT_Code == 'pf' ? 'selected' : '' }}>
                                                    Pf</option>
                                                <option value="pv"
                                                    {{ $cases->RDT_Code == 'pv' ? 'selected' : '' }}>
                                                    Pv</option>
                                                <option value="mixed"
                                                    {{ $cases->RDT_Code == 'mixed' ? 'selected' : '' }}>Mixed</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="out-patient" id=""
                                                oninput="adjustInputWidth(this)" style="width: 100%">
                                                <option value="Uncomplicated (OP)"
                                                    {{ $cases->IOC_Code == 'TUncomplicated (OP)' ? 'selected' : '' }}>
                                                    Uncomplicated (OP)</option>
                                                <option value="Uncomplicated (IP)"
                                                    {{ $cases->IOC_Code == 'Uncomplicated (IP)' ? 'selected' : '' }}>
                                                    Uncomplicated (IP)</option>
                                                <option value="Severe (OP)"
                                                    {{ $cases->IOC_Code == 'Severe (OP)' ? 'selected' : '' }}>Severe
                                                    (OP)
                                                </option>
                                                <option value="Cerebral Malaria (IP)"
                                                    {{ $cases->IOC_Code == 'Cerebral Malaria (IP)' ? 'selected' : '' }}>
                                                    Cerebral Malaria (IP)</option>
                                                <option value="Other Severe Complicated Malaria (IP)"
                                                    {{ $cases->IOC_Code == 'Other Severe Complicated Malaria (IP' ? 'selected' : '' }}>
                                                    Other Severe Complicated Malaria (IP)</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </td>
                                        <td>
                                            {{-- oninput="adjustInputWidth(this)" --}}
                                            <select name="ACT" id="act" onchange="adjustInputWidth();"
                                                class="acts">
                                                <option value="N/A"
                                                    {{ $cases->ACT_Code == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                <option value="ACT-6 tablets (1/2 strip)"
                                                    {{ $cases->ACT_Code == 'ACT-6 tablets (1/2 strip)' ? 'selected' : '' }}>
                                                    ACT-6 tablets (1/2 strip)</option>
                                                <option value="ACT-6 tablets (1 strip)"
                                                    {{ $cases->ACT_Code == 'ACT-6 tablets (1 strip)' ? 'selected' : '' }}>
                                                    ACT-6 tablets (1 strip)</option>
                                                <option value="ACT-12 tablets (1 strip)"
                                                    {{ $cases->ACT_Code == 'ACT-12 tablets (1 strip)' ? 'selected' : '' }}>
                                                    ACT-12 tablets (1 strip)</option>
                                                <option value="ACT-18 tablets (1 strip)"
                                                    {{ $cases->ACT_Code == 'ACT-18 tablets (1 strip)' ? 'selected' : '' }}>
                                                    ACT-18 tablets (1 strip)</option>
                                                <option value="ACT-24 tablets (1 strip)"
                                                    {{ $cases->ACT_Code == 'ACT-24 tablets (1 strip)' ? 'selected' : '' }}>
                                                    ACT-24 tablets (1 strip)</option>
                                                <option value="Other ACT"
                                                    {{ $cases->ACT_Code == 'Other ACT' ? 'selected' : '' }}>Other ACT
                                                </option>
                                                <option value="Out of stock"
                                                    {{ $cases->ACT_Code == 'Out of stock' ? 'selected' : '' }}>Out of
                                                    stock</option>
                                                <option value="N/A"
                                                    {{ $cases->ACT_Code == 'N/A' ? 'selected' : '' }}>N/A</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="CQ" id="cq" class="cq">
                                                <option value="N/A"
                                                    {{ $cases->CQ_Code == 'N/A' ? 'selected' : '' }}>
                                                    N/A</option>
                                                <option value="CQ - 1 tablet"
                                                    {{ $cases->CQ_Code == 'CQ - 1 tablet' ? 'selected' : '' }}>CQ - 1
                                                    tablet</option>
                                                <option value="CQ - 4 tablets"
                                                    {{ $cases->CQ_Code == 'CQ - 4 tablets' ? 'selected' : '' }}>CQ - 4
                                                    tablets</option>
                                                <option value="CQ - 5 tablets"
                                                    {{ $cases->CQ_Code == 'CQ - 5 tablets' ? 'selected' : '' }}>CQ - 5
                                                    tablets</option>
                                                <option value="CQ - 7.5 tablets"
                                                    {{ $cases->CQ_Code == 'CQ - 7.5 tablets' ? 'selected' : '' }}>CQ -
                                                    7.5 tablets</option>
                                                <option value="CQ - 10 tablets"
                                                    {{ $cases->CQ_Code == 'CQ - 10 tablets' ? 'selected' : '' }}>CQ -
                                                    10
                                                    tablets</option>
                                                <option value="Out of stock"
                                                    {{ $cases->CQ_Code == 'Out of stock' ? 'selected' : '' }}>Out of
                                                    stock</option>
                                                <option value="N/A"
                                                    {{ $cases->CQ_Code == 'N/A' ? 'selected' : '' }}>
                                                    N/A</option>
                                            </select>
                                        </td>
                                        <td><select name="PQ" id="pq" class="pq">

                                                <option value="N/A"
                                                    {{ $cases->PQ_Code == 'N/A' ? 'selected' : '' }}>
                                                    N/A</option>
                                                <option value="PQ - 1 tablet"
                                                    {{ $cases->PQ_Code == 'PQ - 1 tablet' ? 'selected' : '' }}>PQ - 1
                                                    tablet</option>
                                                <option value="PQ - 2 tablets"
                                                    {{ $cases->PQ_Code == 'PQ - 2 tablets' ? 'selected' : '' }}>PQ - 2
                                                    tablets</option>
                                                <option value="PQ - 4 tablets"
                                                    {{ $cases->PQ_Code == 'PQ - 4 tablets' ? 'selected' : '' }}>PQ - 4
                                                    tablets</option>
                                                <option value="PQ - 6 tablets"
                                                    {{ $cases->PQ_Code == 'PQ - 6 tablets' ? 'selected' : '' }}>PQ - 6
                                                    tablets</option>
                                                <option value="PQ - 7 tablets"
                                                    {{ $cases->PQ_Code == 'PQ - 7 tablets' ? 'selected' : '' }}>PQ - 7
                                                    tablets</option>
                                                <option value="PQ - 14 tablets"
                                                    {{ $cases->PQ_Code == 'PQ - 14 tablets' ? 'selected' : '' }}>PQ -
                                                    14
                                                    tablets</option>
                                                <option value="PQ - 21 tablets"
                                                    {{ $cases->PQ_Code == 'PQ - 21 tablets' ? 'selected' : '' }}>PQ -
                                                    21
                                                    tablets</option>
                                                <option value="PQ - 28 tablets"
                                                    {{ $cases->PQ_Code == 'PQ - 28 tablets' ? 'selected' : '' }}>PQ -
                                                    28
                                                    tablets</option>
                                                <option value="Out of stock"
                                                    {{ $cases->PQ_Code == 'Out of stock' ? 'selected' : '' }}>Out of
                                                    stock</option>
                                                <option value="N/A"
                                                    {{ $cases->PQ_Code == 'N/A' ? 'selected' : '' }}>N/A</option>
                                            </select>
                                            {{-- " <input type="text" id=""  placeholder="N/A" class="pq only-integer">oninput="adjustInputWidth(this)" --}}



                                        </td>
                                        <td>
                                            <select name="referral" id="" oninput="adjustInputWidth(this)">
                                                <option value="Yes"
                                                    {{ $cases->Referral_Code == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No"
                                                    {{ $cases->Referral_Code == 'No' ? 'selected' : '' }}>No</option>
                                                {{-- @foreach ($lp_yesno as $yn)
                                        <option value="{{ $yn->YN_Code }}">
                                            {{ $yn->YesNo }}
                                        </option>
                                    @endforeach --}}
                                            </select>
                                        </td>
                                        <td>
                                            <select name="malaria-death" id=""
                                                onchange="checkMpdeath(this)">
                                                <option value="" selected disabled>ရွေးပါ</option>
                                                <option value="Yes"
                                                    {{ $cases->Malari_Death == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No"
                                                    {{ $cases->Malari_Death == 'No' ? 'selected' : '' }} selected>No
                                                </option>
                                                {{-- @foreach ($lp_yesno as $yn)
                                        <option value="{{ $yn->YN_Code }}">
                                            {{ $yn->YesNo }}
                                        </option>
                                    @endforeach --}}
                                            </select>
                                        </td>
                                        <td>
                                            <select name="" id="t-given">
                                                <option value="<=24hr"
                                                    {{ $cases->TG_Code == '<=24hr' ? 'selected' : '' }}>
                                                    <=24hr </option>
                                                        {{-- @foreach ($lp_treatment_given as $treatment)
                                        <option value="{{ $treatment->tg_code }}">
                                            {{ $treatment->t_given }}
                                        </option>
                                    @endforeach --}}
                                            </select>
                                        </td>
                                        <td>
                                            <select name="travel-log" id="travel-log">
                                                <option value="{{ $cases->travel_yn }}" selected>No</option>
                                                {{-- @foreach ($lp_yesno as $yn)
                                        <option value="{{ $yn->YN_Code }}">
                                            {{ $yn->YesNo }}
                                        </option>
                                    @endforeach --}}
                                            </select>
                                        </td>
                                        <td>
                                            <select name="job" id="job" oninput="adjustInputWidth(this)"
                                                required>
                                                <option value="" disabled>ရွေးပါ</option>

                                                <option value="{{ $cases->occupation }}">{{ $cases->occupation }}
                                                </option>

                                                <option value="Gardening"
                                                    {{ $cases->occupation == 'Gardening' ? 'selected' : '' }}>
                                                    Gardening
                                                </option>
                                                <option value="Forest Related Job"
                                                    {{ $cases->occupation == 'Forest Related Job' ? 'selected' : '' }}>
                                                    Forest Related Job</option>
                                                <option value="Construction"
                                                    {{ $cases->occupation == 'Construction' ? 'selected' : '' }}>
                                                    Construction</option>
                                                <option value="Mining"
                                                    {{ $cases->occupation == 'Mining' ? 'selected' : '' }}>Mining
                                                </option>
                                                <option value="Other"
                                                    {{ $cases->occupation == 'Other' ? 'selected' : '' }}>Other
                                                </option>



                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="remark" oninput="adjustInputWidth(this)"
                                                placeholder="မှတ်ချက်" value="{{ $cases->Remark }}">
                                        </td>
                                        <td style="padding-right: 20px; padding-left: 10px;">
                                            <a href="javascript:void(0)" id="delete_row" class="delete_icon"
                                                onclick="delete_row(this)" rowNo="1">
                                                <li class="fa fa-trash-o bg-white"></li>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif



                            <?php
                        if(isset($tbl_individual_case_temp))
                        foreach($tbl_individual_case_temp as $patient) {
                            list($year, $month, $day) = explode("-", $patient->Screening_Date);
                            //echo $patient->P_Number; return false;
                        ?>
                            <tr>
                                <td style="font-size:10px; font-weight: bold;" P_Number="<?= $patient->P_Number ?>">
                                    <?= $patient->Row_No ?>
                                </td>

                                <td>
                                    <input type="text" id="datepicker" class="form-control text-center"
                                        style="height: 50px;" autocomplete="off">

                                </td>

                                <td>
                                    <input type="text" id="" oninput="adjustInputWidth(this)"
                                        placeholder="အမည်" value="">
                                </td>
                                <td>
                                    {{-- oninput="adjustInputWidth(this)" --}}
                                    <input type="text" id="ageInput" maxlength="3" placeholder="အသက်"
                                        class="age dentry_age" onchange="checkAge(this)">
                                </td>
                                <td><input type="text" id="" oninput="adjustInputWidth(this)"
                                        placeholder="အဘအမည်"></td>
                                <td>
                                    <select name="address" id="" oninput="adjustInputWidth(this)"
                                        onblur="location_changed(this)" {{ $review_mode ? 'disabled' : '' }}>

                                        <option value="{{ $patient->Pt_Location }}">Other</option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_mmr }}">
                                                {{ $v->village_name_en }} &nbsp;&nbsp;&nbsp;&nbsp;|
                                                {{ $v->village_name_mm }}
                                            </option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <select name="address" id="" onblur="location_changed(this)"
                                        {{ $review_mode ? 'disabled' : '' }}>

                                        <option value="{{ $patient->Pt_Location }}">Other</option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;|
                                                {{ $v->village_tract }}
                                            </option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <select name="address" id="" onblur="location_changed(this)"
                                        {{ $review_mode ? 'disabled' : '' }}>

                                        <option value="{{ $patient->Pt_Location }}">Other</option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;|
                                                {{ $v->village_tract }}
                                            </option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <select name="address" id="" onblur="location_changed(this)"
                                        {{ $review_mode ? 'disabled' : '' }}>
                                        @if ($patient->Pt_Location == 10)
                                            <option value="">Other</option>
                                        @else
                                            <input type="text">
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select name="address" id="" onblur="location_changed(this)"
                                        {{ $review_mode ? 'disabled' : '' }}>

                                        <option value="{{ $patient->Pt_Location }}">Other</option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;|
                                                {{ $v->village_tract }}
                                            </option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <select name="address" id="" onblur="location_changed(this)"
                                        {{ $review_mode ? 'disabled' : '' }}>

                                        <option value="{{ $patient->Pt_Location }}">Other</option>
                                        @foreach ($tbl_village as $v)
                                            <option value="{{ $v->village_pcode }}">
                                                {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;|
                                                {{ $v->village_tract }}
                                            </option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <input type="text" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း"
                                        value="<?= $patient->Pt_Address ?>"{{ $review_mode ? 'disabled' : '' }}>
                                </td>
                                {{-- <td>
                            <select name="sex" class="sex" id="sex" onchange="checkSex(this)">
                                <option value="choose">ရွေးပါ</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </td> --}}
                                <td>
                                    <select name="preg" class="preg" id="preg" onchange="checkPreg(this)">
                                        {{-- <option value="">ရွေးပါ</option> --}}
                                        <option value="N/A" selected>N/A</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>

                                </td>
                                <td>

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
                                    <select name="ACT" class="act">
                                        <option value="">ရွေးပါ</option>
                                        @foreach ($lp_act_code as $act)
                                            <option value="{{ $act->act_code }}" <?php echo $act->act_code == $patient->ACT_Code ? 'selected' : ''; ?>>
                                                {{ $act->act_treatment }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="cq only-integer">
                                        <option value="0">N/A</option>
                                        <option value="1">3</option>
                                        <option value="2">6</option>
                                        <option value="3">12</option>
                                        <option value="4">18</option>
                                        <option value="5">24</option>
                                        <option value="6">Not treated</option>
                                    </select>
                                    {{-- <input type="text" value="{{ $patient->CQ_Code }}"
                                {{ $review_mode ? 'disabled' : '' }} class="cq only-integer"> --}}
                                </td>
                                <td>
                                <td>
                                    <select name="" id="pq" class="pq only-integer">
                                        <option value="1">3</option>
                                        <option value="2">6</option>
                                        <option value="3">12</option>
                                        <option value="4">18</option>
                                        <option value="5">24</option>
                                        <option value="6">Not treated</option>
                                    </select>

                                </td>
                                <td>
                                    <select name="referral" {{ $review_mode ? 'disabled' : '' }} id="">
                                        <option value="" disabled>ရွေးပါ</option>
                                        @foreach ($lp_yesno as $yn)
                                            <option value="{{ $yn->YN_Code }}" <?php echo $yn->YN_Code == $patient->Referral_Code ? 'selected' : ''; ?>>
                                                {{ $yn->YesNo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="malaria-death" onchange="checkMpdeath(this)"
                                        {{ $review_mode ? 'disabled' : '' }}>
                                        <option value="" disabled>ရွေးပါ</option>
                                        @foreach ($lp_yesno as $yn)
                                            <option value="{{ $yn->YN_Code }}" <?php echo $yn->YN_Code == $patient->Malaria_Death ? 'selected' : ''; ?>>
                                                {{ $yn->YesNo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="t-given">
                                        <option value="" disabled>ရွေးပါ</option>
                                        @foreach ($lp_treatment_given as $treatment)
                                            <option value="{{ $treatment->tg_code }}" <?php echo $treatment->tg_code == $patient->TG_Code ? 'selected' : ''; ?>>
                                                {{ $treatment->t_given }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="travel-log" id="travel-log" style="width: 50px">
                                        <option value="" disabled>ရွေးပါ</option>
                                        @foreach ($lp_yesno as $yn)
                                            <option value="{{ $yn->YN_Code }}" <?php echo $yn->YN_Code == $patient->travel_yn ? 'selected' : ''; ?>>
                                                {{ $yn->YesNo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="job" id="job">
                                        <option value="" disabled>ရွေးပါ</option>
                                        @foreach ($lp_occupation as $job)
                                            <option value="{{ $job->occupation_id }}" <?php echo $job->occupation_id == $patient->occupation ? 'selected' : ''; ?>>
                                                {{ $job->occupation_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                {{-- <td>
                            <input type="text" placeholder="Remark" value="<?= $patient->Remark ?>"
                                {{ $review_mode ? 'disabled' : '' }}>
                        </td> --}}
                                <td>
                                    <a href="javascript:void(0);" class="delete_icon"
                                        onclick="delete_existing_row(<?= $patient->P_Number ?>,<?= $patient->sync ?>, this);"
                                        rowNo="">
                                        <li class="fa fa-trash-o"></li>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

{{--  --}}
        </div>

        <div class="col-md-12" style="text-align: center; margin-bottom:30px;margin-top:25px;">

            <button class="btn btnColor save_btn" style="padding:10px;" onclick="save_data_entry(this)">
                <li class="fa fa-save"></li> အားလုံးသိမ်းမည်
            </button>

        </div>


    </div>
</main>

{{-- fontawsome 6.4.2 js 1 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- for js --}}


<script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    var handle_date = ['','']

    function formatDate(date) {
    var d = date
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

    function handleMonth(input)
    {
        let handle_month = $(input).val();
        let yearMonthArray = handle_month.split('-');
        let year = parseInt(yearMonthArray[0])
        let month = parseInt(yearMonthArray[1]) - 1;

        let end_date = new Date(year,month + 1,0);
        let start_date = new Date(year,month -1 ,1);

        console.log('called')

        handle_date = [
            start_date,end_date
        ];

        formatScreening()
        return [
            start_date,end_date
        ]
    }

    function formatScreening(value_reset = true)
    {

        let start_date = handle_date[0] ?? "";
        let end_date = handle_date[1] ?? "";

        $(".screening_date").each( function(index,element)  {
            if(value_reset)
            {
                $(element).val('');
            }
           $(element).attr('min',formatDate(start_date));
           $(element).attr('max',formatDate(end_date));
        })
    }



    $(document).ready(function(){

    })

    function maxLengthCheckTop(object) {
        // console.log('there');
        var tpa_out = document.getElementById("txt_total_outpatients");

        if (tpa_out.value === '' || tpa_out.value < 0 || tpa_out.value === '00' || tpa_out.value === '000' || tpa_out
            .value > 9999) {
            tpa_out.value = '';
        } else {

            if (tpa_out.value !== '0') {
                tpa_out.value = parseInt(tpa_out.value, 10).toString();
            }
        }
    }

    function maxLengthCheckTco(object) {
        var ttc_out = document.getElementById("txt_total_childs_out");

        if (ttc_out.value === '' || ttc_out.value < 0 || ttc_out.value === '00' || ttc_out.value === '000' || ttc_out
            .value > 9999) {
            ttc_out.value = '';
        } else {

            if (ttc_out.value !== '0') {
                ttc_out.value = parseInt(ttc_out.value, 10).toString();
            }
        }
    }

    function maxLengthCheckTpo(object) {
        var ttp_out = document.getElementById("txt_total_pregs_out");

        if (ttp_out.value === '' || ttp_out.value < 0 || ttp_out.value === '00' || ttp_out.value === '000' || ttp_out
            .value > 9999) {
            ttp_out.value = '';
        } else {

            if (ttp_out.value !== '0') {
                ttp_out.value = parseInt(ttp_out.value, 10).toString();
            }
        }
    }

    function maxLengthCheckTip(object) {
        var ttp_in = document.getElementById("txt_total_inpatients");

        if (ttp_in.value === '' || ttp_in.value < 0 || ttp_in.value === '00' || ttp_in.value === '000' || ttp_in.value >
            9999) {
            ttp_in.value = '';
        } else {

            if (ttp_in.value !== '0') {
                ttp_in.value = parseInt(ttp_in.value, 10).toString();
            }
        }
    }

    function maxLengthCheckTic(object) {
        var ttc_in = document.getElementById("txt_total_in_childs");

        if (ttc_in.value === '' || ttc_in.value < 0 || ttc_in.value === '00' || ttc_in.value === '000' || ttc_in.value >
            9999) {
            ttc_in.value = '';
        } else {

            if (ttc_in.value !== '0') {
                ttc_in.value = parseInt(ttc_in.value, 10).toString();
            }
        }
    }

    function maxLengthCheckTpi(object) {
        var ttp_in = document.getElementById("txt_total_pregs_in");

        if (ttp_in.value === '' || ttp_in.value < 0 || ttp_in.value === '00' || ttp_in.value === '000' || ttp_in.value >
            9999) {
            ttp_in.value = '';
        } else {

            if (ttp_in.value !== '0') {
                ttp_in.value = parseInt(ttp_in.value, 10).toString();
            }
        }
    }

    function maxLengthCheckTdi(object) {
        var ttd_in = document.getElementById("txt_total_deaths_in");

        if (ttd_in.value === '' || ttd_in.value < 0 || ttd_in.value === '00' || ttd_in.value === '000' || ttd_in.value >
            9999) {
            ttd_in.value = '';
        } else {

            if (ttd_in.value !== '0') {
                ttd_in.value = parseInt(ttd_in.value, 10).toString();
            }
        }
    }
</script>

<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}">
</script>
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}">
</script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/dist/js/demo.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/nmcp.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootbox.all.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<script>
    function load_tbl_hfm(target_control_id, ts_code, token, form_type = null) {

        //alert('thisejrwo');
        let form_cat = $('#select_lp_form_cat').val();


        let hf_types = [];

        if (form_cat == 2 || form_cat == 3) {
            hf_types = ['SC', 'MH', 'SU'];
        }

        try {
            var form_code = "";

            if ($("#select_lp_form_cat").val() == "0") {
                bootbox.alert("<p>• ပုံစံအမျိုးအစားရွေးပါ</p>");
                return false;
            }

            $("#" + target_control_id).html("<option>Loading...</option>");
            $("#" + target_control_id).prop("disabled", true);

            $.ajax({
                type: "GET",
                url: BACKEND_URL + 'get_grab_hfconnect/' + ts_code,
                data: {
                    hf_types: hf_types
                },
                success: function(data) {
                    //console.log('mzh', data);
                    $("#" + target_control_id).html("");

                    $("#" + target_control_id).append("<option value='0'> ရွေးရန် </option>");
                    $("#" + target_control_id).prop("disabled", false);

                    jQuery.each(data, function(i, val) {
                        var opt = "<option value='" + val.HF_Code + "'>" + val.hf_name + " | " + val
                            .hf_name_mm + "</option>";
                        $("#" + target_control_id).append(opt);
                    });
                }
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    }

    function yesno(yncode) {
        switch (yncode) {
            case 0:
                return "No";
                break;
            case 1:
                return "Yes";
                break;
            case 7:
                return "N/A";
                break;
            case 9:
                return "Missing";
                break;
        }
    }


    function adjustInputWidth(input) {
        // if (input.value.length <= 15 || input.value.length === 0) {
        //     input.style.width = "20ch"; // Default width
        // } else {
        //     input.style.width = `${input.value.length + 2}ch`;
        // }
    }


    clickOnRow();

    $(document).ready(function() {
        var table = document.getElementById('data_entry_body');
        var v = null;
        var _id = null;
        for (var i = 0, row; row = table.rows[i]; i++) {
            v = row.cells[20].children[0].getAttribute('rowNo');
            _id = row.cells[1].children[0].className + v;
            row.cells[1].children[0].setAttribute('id', _id);
        }
        var zzz = new custom_inputmask(_id, '_', '-');
    });



    // start 16/8/23 add by me

    function checkrcs(rdt) {
        // console.log('test',rdt);
        var tr = $(rdt).closest('tr');
        var rcs = tr.find('td:eq(8) select').val();
        if (rdt.value == '0' || rdt.value == '7' || rdt.value == '9') {
            if (rcs == '0' || rcs == '7' || rcs == '9') {
                //set all fields to N/A
                tr.find(
                        'td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input'
                    )
                    .css('background-color', 'white');
                tr.find('td:eq(10) select').prop('selectedIndex', 6); //in,out patient
                tr.find('td:eq(11) select').prop('selectedIndex', 8); //ACT
                tr.find('td:eq(12) input').val('N/A').attr('value', 7); //CQ
                tr.find('td:eq(13) input').val('N/A').attr('value', 7); //PQ
                tr.find('td:eq(14) select').prop('selectedIndex', 3); //Referral
                tr.find('td:eq(15) select').prop('selectedIndex', 3); //MMD
                tr.find('td:eq(16) select').prop('selectedIndex', 9); //TG
                tr.find('td:eq(17) select').prop('selectedIndex', 3); //Travel Record
                tr.find('td:eq(18) select').prop('selectedIndex', 7); //Occupation
                tr.find('td:eq(19) input').val('N/A'); //Remark
                tr.find('td:eq(19) input').focus();
            }
        } else {
            // go in/out field
            tr.find(
                    'td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input'
                )
                .css('background-color', '#FFC8C8');
            tr.find('td:eq(10) select').focus();
            tr.find('td:eq(10) select').prop('selectedIndex', 0); //in,out patient
            tr.find('td:eq(11) select').prop('selectedIndex', 0); //ACT
            tr.find('td:eq(12) input').val('');
            tr.find('td:eq(12) input').attr('placeholder', 'ဆေးလုံးရေ'); //CQ
            tr.find('td:eq(13) input').val('');
            tr.find('td:eq(13) input').attr('placeholder', 'ဆေးလုံးရေ'); //PQ
            tr.find('td:eq(14) select').prop('selectedIndex', 0); //Referral
            tr.find('td:eq(15) select').prop('selectedIndex', 0); //MMD
            tr.find('td:eq(16) select').prop('selectedIndex', 0); //TG
            tr.find('td:eq(17) select').prop('selectedIndex', 0); //Travel Record
            tr.find('td:eq(18) select').prop('selectedIndex', 0); //Occupation
            tr.find('td:eq(19) input').val('');
            tr.find('td:eq(19) input').attr('placeholder', 'ရေးပါ');
        }

    }

    // $(document).ready(function(){
    //     var table = document.getElementById('data_entry_body');
    //     var v = null ; var _id = null ;
    //     for(var i = 0, row ; row = table.rows[i]; i ++){
    //         v = row.cells[20].children[0].getAttribute('rowNo');
    //         _id = row.cells[1].children[0].className + v ;
    //         row.cells[1].children[0].setAttribute('id', _id);
    //     }
    //     var zzz = new custom_inputmask(_id, '_', '-');
    // });

    $("#data_entry_body tr td input").on('focus', function() {
        //highlight_row(this);
    });

    $("#data_entry_body tr td select").on('focus', function() {
        //highlight_row(this);
    });

    // $(document).ready(function(){
    //     var tb = document.getElementById('data_entry_body');
    //     for (var i = 0, row ; row = tb.rows[i]; i ++){
    //         row.cells[12].children[0].value = yesno(row.cells[12].children[0].value);
    //         row.cells[13].children[0].value = yesno(row.cells[13].children[0].value);
    //     }
    // });




    function save_data_entry(button) {
        //  alert('hello i am new1111');
        //$(button).prop("disabled", true);
        //$(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');
        //tpa check
        var data = {};
        var aa = [];
        var cf_id_code = $("#ic_id_code").val();




        // console.log(cf_id_code);

        if (typeof cf_id_code === 'undefined') {
            // alert('cf_id_code is undefined');

            data["service_provider"] = document.getElementById("select_lp_form_cat").value;
            data["data_entry"] = document.getElementById("dataEntry").value;
            data["state_region"] = document.getElementById("data_select_region").value;
            data["township"] = document.getElementById("data_select_township").value;
            data["rhc_health"] = document.getElementById("data_select_hf").value;
            data["sc_health"] = document.getElementById("data_select_subcenter").value;
            data["icmv_select"] = document.getElementById("data_select_village").value;
            data["rp_month"] = document.getElementById("start").value;
            data["blood_test"] = document.getElementById("chooseOption").value;
            data["condition"] = document.getElementById("conditionalOption").value;

            //data["cf_link_code"] = $("#cf_link_code").val();
            data["Total_Outpatient"] = $("#txt_total_outpatients").val();
            data["U5_Outpatient"] = $("#txt_total_childs_out").val();
            data["Preg_Outpatient"] = $("#txt_total_pregs_out").val();
            data["Total_Inpatient"] = $("#txt_total_inpatients").val();
            data["U5_Inpatient"] = $("#txt_total_in_childs").val();
            data["Preg_Inpatient"] = $("#txt_total_pregs_in").val();
            data["Death_Facility"] = $("#txt_total_deaths_in").val();
            data["ic_id_code"] = $("#ic_id_code").val();

            var table = document.getElementById('data_entry_body');
            // {{-- console.log('mmrr',table); --}}
            for (var i = 0; i < table.rows.length; i++) {
                var row = table.rows[i];
                // console.log('count=>',table.rows);
                // var checker = "false";

                var rowdata = {};

                rowdata["date"] = row.cells[1].children[0].value;
                rowdata["Pt_Name"] = row.cells[2].children[0].value;
                rowdata["Age_Year"] = row.cells[3].children[0].value;
                rowdata["Pt_Father_Name"] = row.cells[4].children[0].value;
                rowdata["Pt_Location"] = row.cells[5].children[0].value;
                rowdata["Pt_Address"] = row.cells[6].children[0].value;
                rowdata["Pt_Address1"] = row.cells[7].children[0].value;
                rowdata["Pt_Address2"] = row.cells[8].children[0].value;
                rowdata["Pt_Address3"] = row.cells[9].children[0].value;
                rowdata["Pt_Address4"] = row.cells[10].children[0].value;
                rowdata["Pt_Address5"] = row.cells[11].children[0].value;
                rowdata["Sex_Code"] = row.cells[12].children[0].value;
                rowdata["Preg_YN"] = row.cells[13].children[0].value;
                rowdata["Micro_Code"] = row.cells[14].children[0].value;
                rowdata["RDT_Code"] = row.cells[15].children[0].value;
                rowdata["IOC_Code"] = row.cells[16].children[0].value;
                rowdata["ACT_Code"] = row.cells[17].children[0].value;
                rowdata["CQ_Code"] = row.cells[18].children[0].value;
                rowdata["PQ_Code"] = row.cells[19].children[0].value;
                rowdata["Referral_Code"] = row.cells[20].children[0].value;
                rowdata["Malaria_Death"] = row.cells[21].children[0].value;
                rowdata["TG_Code"] = row.cells[22].children[0].value;
                rowdata["travel_yn"] = row.cells[23].children[0].value;
                rowdata["occupation"] = row.cells[24].children[0].value;
                rowdata["Remark"] = row.cells[25].children[0].value;
                aa.push(rowdata);
            }
            data['patient'] = aa;
            var data_to_post = data
            console.log('there=>', data);

            var save_update_check = $.ajax({
                async: false,
                type: "POST",
                headers: {
                    "X-CSRF_TOKEN": '{{ csrf_token() }}'
                },
                url: BACKEND_URL + "save_tbl_total_patient_temp/",
                data: data_to_post,
                success: function(result) {

                    if (result == "400") {
                        alert('The patient is existing . Please check and Entry again.')
                    }
                    // return;
                    // console.log('this=>',data);

                    if(result == "nils data save successfully"){
                        alert('Nil report form save successlully');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                    if (result == "1") {
                        alert('saved data to tbl_individual_case successfully');
                        // console.log("save success");
                        save_update_check = true;
                        setTimeout(() => {
                            location.reload();
                        }, 1500);

                    }else {
                        // alert('this is new!!!!;')
                        console.log(result);
                    }
                },
                error: function(error) {
                    console.log(error);
                    if(error?.status == 422)
                    {
                        // alert(error?.responseText)
                        alert('အချက်အလက်များကိုပြည့်စုံစွာဖြည့်သွင်းပါ');
                    }
                    else{

                        alert("failed to save")
                    }
                }
            }).responseText;

        } else {

            // data["Total_Outpatient"] = $("#txt_total_outpatient").val();
            // data["U5_Outpatient"] = $("#txt_total_child_out").val();
            // data["Preg_Outpatient"] = $("#txt_total_preg_out").val();
            // data["Total_Inpatient"] = $("#txt_total_inpatient").val();
            // data["U5_Inpatient"] = $("#txt_total_in_child").val();
            // data["Preg_Inpatient"] = $("#txt_total_preg_in").val();
            // data["Death_Facility"] = $("#txt_total_death_in").val();
            data["ic_id_code"] = $("#ic_id_code").val();

            var table = document.getElementById('data_entry_body');
            // {{-- console.log('mmrr',table); --}}
            for (var i = 0; i < table.rows.length; i++) {
                var row = table.rows[i];
                // var checker = "false";

                var rowdata = {};

                rowdata["date"] = row.cells[1].children[0].value;
                rowdata["Pt_Name"] = row.cells[2].children[0].value;
                rowdata["Age_Year"] = row.cells[3].children[0].value;
                rowdata["Pt_Father_Name"] = row.cells[4].children[0].value;
                rowdata["Pt_Location"] = row.cells[5].children[0].value;
                rowdata["Pt_Address"] = row.cells[6].children[0].value;
                rowdata["Pt_Address1"] = row.cells[7].children[0].value;
                rowdata["Pt_Address2"] = row.cells[8].children[0].value;
                rowdata["Pt_Address3"] = row.cells[9].children[0].value;
                rowdata["Pt_Address4"] = row.cells[10].children[0].value;
                rowdata["Pt_Address5"] = row.cells[11].children[0].value;
                rowdata["Sex_Code"] = row.cells[12].children[0].value;
                rowdata["Preg_YN"] = row.cells[13].children[0].value;
                rowdata["Micro_Code"] = row.cells[14].children[0].value;
                rowdata["RDT_Code"] = row.cells[15].children[0].value;
                rowdata["IOC_Code"] = row.cells[16].children[0].value;
                rowdata["ACT_Code"] = row.cells[17].children[0].value;
                rowdata["CQ_Code"] = row.cells[18].children[0].value;
                rowdata["PQ_Code"] = row.cells[19].children[0].value;
                rowdata["Referral_Code"] = row.cells[20].children[0].value;
                rowdata["Malaria_Death"] = row.cells[21].children[0].value;
                rowdata["TG_Code"] = row.cells[22].children[0].value;
                rowdata["travel_yn"] = row.cells[23].children[0].value;
                rowdata["occupation"] = row.cells[24].children[0].value;
                rowdata["Remark"] = row.cells[25].children[0].value;
                aa.push(rowdata);

            }
            data['patient'] = aa;
            var data_to_post = JSON.stringify(data);
            //  console.log('there=>',data);
            var save_update_check = $.ajax({
                async: false,
                type: "POST",
                headers: {
                    "X-CSRF_TOKEN": '{{ csrf_token() }}'
                },
                url: BACKEND_URL + "save_tbl_individual_case_temp_edit/",
                data: data_to_post,
                success: function(result) {
                    // alert('data=>');
                    if (result == "1") {
                        // return;
                        alert('Updated data to tbl_individual_case successfully');
                        // console.log("save success");

                        //save_update_check = true;
                        setTimeout(() => {
                            //location.reload();
                            location.href = '/uploadForm';

                        }, 1000);


                    } else {
                        // alert('this is new!!!!;')
                        console.log(result);
                    }
                },
                error: function(error)
                {
                    console.log(error);
                }
            }).responseText;
            //console.log('this is =>',cf_id_code);
        }

    }




    // ------------------------------------

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

    function sortDate(dGet) {
        var aSplit = dGet.split('-');
        var temp = aSplit[0];
        aSplit[0] = aSplit[2];
        aSplit[2] = temp;
        temp = '';
        return aSplit.join('-');
    }

    function checkBtn() {
        var btn = document.getElementById('add_row');
        var row_count = get_row();
        console.log('aaaaaa',row_count);
        if (row_count >= 20) {
        $(btn).prop('disabled', true);
        $(btn).html('<li class="fa fa-ban"></li> now maximun row');
        } else {
        $(btn).prop('disabled', false);
        $(btn).html('<li class="fa fa-plus-square"></li> အသစ်တစ်ကြောင်းထပ်တိုးရန်');
        }
    }

    function get_row() {
        //console.log(get_row);
        var table = document.getElementById('data_entry_body');
        for (var i = 0, row; row = table.rows[i]; i++) {
            var row_count = row.cells[26].children[0].getAttribute('rowNo');
        }
        return row_count;
    }


    // return rowCount;
    //}


    function add_row(btn) {

        var row_count = get_row();
        checkBtn();


            var cf_id_code = $("#ic_id_code").val();


            // console.log(cf_id_code);
            if (typeof cf_id_code === 'undefined') {

                var select_lp_township_de = document.getElementById('data_select_township');
                var value = select_lp_township_de.value;
            } else {

                var value = $('#township_edit').text();

            }

            console.log(value);

            //var select_lp_township_de_text = e.options[e.selectedIndex].text;
            //console.log('aaaaaa',select_lp_township_de_text);
            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_patient_dataentry_row/" + value,
                //url: "/dhis-offline-app/public/get_patient_dataentry_row/" + value,
                //url: "/dhis-offline-app/public/get_patient_dataentry_row/0",
                // alert('this will new rowlll');
                success: function(data) {
                    //alert('this isopeirepw');get_patient_dataentry_row
                    //console.log("myitzu", data);
                    $("#data_entry_body").append(data);
                    set_row_numbers();
                    checkBtn();
                    formatScreening(false);

                    // set_focus();
                },
                error: function(error) {
                    bootbox.alert(error.statusText);
                    checkBtn();
                }
            });

    }


    function set_row_numbers() {
        var table = document.getElementById('data_entry_body');
        for (var i = 0, row; row = table.rows[i]; i++) {
            row.cells[0].innerHTML = i + 1;
            row.cells[26].children[0].setAttribute("rowNo", i + 1);
        }
    }

    set_row_numbers();



    function delete_row(btn) {
        // alert('this is deleted111',btn);
        var rowNum = $(btn).attr("rowNo");
        // confirm("Row အမှတ် " + rowNum + " တစ်ခုလုံးအား အပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ", function(c) {
        //     if (c == true) {
        //         $(btn).closest('tr').remove();
        //         set_row_numbers();
        //     }

        //  });

        if (confirm("Row အမှတ် " + rowNum + " တစ်ခုလုံးအား အပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ") == true) {
            $(btn).closest('tr').remove();
            set_row_numbers();
        }
        checkBtn();

    }





    function delete_existing_row(p_number, sync, btn) {
        if (sync == "1") {
            alert(
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
        // bootbox.alert("Call delete function of controller!");
    }

    function close_page() {
        confirm("ယခုစာမျက်နှာအားပိတ်မည်။ သေချာပါက OK နှိပ်ပါ", function(result) {
            if (result == true) {
                location.href = "/";
            }
        });
    }

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
            alert("နံပါတ်များသာရိုက်သွင်းပါ");
            $(".num-only").val("");
        }
    });

    // $('.only-integer').on('keypress keyup blur', function(e) {
    //     if (e.which < 48 || e.which > 57) {
    //         if (e.which != 46) {
    //             e.preventDefault();
    //         }
    //     }
    // });


    $(".only-integer").on('keypress keyup blur', function(event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    // $(".dentry_age").on('keypress keyup blur', function(event) {
    //     $(this).val($(this).val().replace(/[^\d].+/, ""));
    //     if ((event.which < 48 || event.which > 57)) {
    //         event.preventDefault();
    //     }
    // });

    function chNumOut() {
        var out_u5 = parseInt($('#txt_U5_Outpatient').val());
        var out_preg = parseInt($('#txt_Preg_Outpatient').val());
        var out_total = parseInt($('#txt_Total_Outpatient').val());

        if (out_total < (out_u5 + out_preg)) {
            alert("ထည့်သွင်းသောစာရင်းမှားယွင်းနေသည်။").on('hidden.bs.modal', () => {
                $('#txt_Total_Outpatient').css('background', '#FFC8C8').focus();
            });
        } else {
            $('#txt_Total_Outpatient').css('background', '#FFFFFF');
            $('#txt_Preg_Outpatient').css('background', '#FFFFFF');
            $('#txt_U5_Outpatient').css('background', '#FFFFFF');
        }
    }

    function chNumIn() {
        var in_u5 = parseInt($('#txt_U5_Inpatient').val());
        var in_preg = parseInt($('#txt_Preg_Inpatient').val());
        var in_total = parseInt($('#txt_Total_Inpatient').val());
        if (in_total < (in_u5 + in_preg)) {
            alert("ထည့်သွင်းသောစာရင်းမှားယွင်းနေသည်။").on('hidden.bs.modal', () => {
                $('#txt_Total_Inpatient').css('background', '#FFC8C8').focus();
            });
        } else {
            $('#txt_Total_Inpatient').css('background', '#FFFFFF');
            $('#txt_Preg_Inpatient').css('background', '#FFFFFF');
            $('#txt_U5_Inpatient').css('background', '#FFFFFF');
        }
    }

    set_row_numbers();
</script>
<style>
    .user-image {
        margin: 10px !important;



    }

    .card-title {
        margin-top: 10px !important;
    }


    .header_bar {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 50px;
        background-color: rgb(44, 102, 147);

    }

    .navbar {
        list-style: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        /* Adjust as needed */
        color: white;
        /* Adjust as needed */
        padding: 10px;
        /* Adjust as needed */
    }

    .select_styles {
        border: 2px solid black;
        border-radius: 20px;
        shadow box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
    }

    .upload_to_online_btn {
        margin-left: auto;
        /* Pushes the "Upload to Online" list item to the right */
    }


    .back_arrow {
        float: left;
        padding: 15px 15px;
        font-size: 15px;
        color: #fff;

    }

    .back_arrow:hover {
        font-size: 20px;
        color: rgb(192, 193, 197);
    }

    .tableCell {
        align-items: left;
        justify-content: space-between;
        display: flex;
    }

    .box-body {
        margin-left: 20%;
        margin-right: 10%;
    }

    table.dataTable thead tr th {
        text-align: center;
        padding: 5px;
    }

    .table-container {
        /* margin: 20px; */
        padding: 20px;

        overflow-x: auto;
        width: 100%;
        max-width: 100%;
        margin-bottom: 10px;
        overflow-y: scroll;
    }

    table {
        width: 100%;
        white-space: nowrap;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #tbl_iop {
        font-size: 12px !important;
        font-weight: 600 !important;
        color: #555 !important;
    }

    #tbl_iop>#tbody_iop>tr:nth-child(odd),
    #tbl_iop>#tbody_iop>tr:nth-child(even) {
        text-align: right !important;
    }

    #tbody_iop>tr>td>input {
        font-size: 12px;
        font-weight: 600;
        border: none !important;
        width: 40px !important;
        height: 30px;
        border-bottom: 1px dotted gray !important;
    }

    #tbody_iop>tr>td>input:focus {
        outline: none !important;
    }

    table.dataTable thead tr {
        background-color: #5c5c5c;
        color: white;
    }

    .engRows {
        background-color: #7c6c6c !important;
    }

    .sec-row-input {
        font-size: 12px;
        border: none;
        border-bottom: 2px dotted blue;
        font-weight: 600;
        text-align: center;
        width: 35px;
    }

    .sec-label {}

    .delete_icon {
        margin: 3px;
        color: red;
    }

    .top-label-value {
        border-bottom: 2px dotted grey;
        padding: 5px 10px;
        font-weight: 600;
        color: black;
    }

    .top-label {
        font-size: 12px;
        margin-right: 35px;
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
        padding: 0 5px;
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
        font-weight: normal;
    }

    .mmtext-10 {
        font-size: 10px;
        color: #555;
    }

    .mmtext-8 {
        font-size: 8px;
        color: #555;
    }

    .custom-col-1 {
        width: 8.333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-2 {
        width: 16.66666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-3 {
        width: 25%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-4 {
        width: 33.33333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-5 {
        width: 41.666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-6 {
        width: 50%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-7 {
        width: 58.333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-8 {
        width: 66.666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-9 {
        width: 75%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-10 {
        width: 83.333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-11 {
        width: 91.666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }



    .table>thead>tr>th,
    .table>tbody>tr>td {
        text-align: center;
        vertical-align: middle;
        padding: 2px;
        border: 1px solid grey;
        padding: 0px;
        margin: 0px;
        font-weight: 600;
    }


    #data_entry_body>tr>td>select {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        padding: 0px;
        width: 100%;
        height: 50px !important;
    }

    #act,
    #cq,
    #pq {
        width: 100px !important;
    }

    #data_entry_body>tr>td>input {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        width: 100%;
        padding: 0px;
        margin: 0px;
        border: none;
        height: 50px !important;
        font-weight: 600;
    }

    #data_entry_body>tr>td>select {
        font-size: 12px;
        text-align: left;
        height: 20px;
        width: 100%;
        border: none;
        height: 50px;
        font-weight: 600;
    }

    #data_entry_body>tr>td>input:focus {
        font-size: 12px;
        color: #000;
        outline: none;
        background-color: #bdbdbd !important;
    }

    #data_entry_body>tr>td>select:focus {
        outline: none;
        background-color: #bdbdbd !important;

    }

    .newsBtn {
        color: white !important;
        background: linear-gradient(#1565c0, #0650a3) #2b61b3 !important;
    }

    .newsBtn:hover {
        color: white !important;
        border: 1px solid blue !important;
    }

    .btnColor {
        color: white !important;
        border: none !important;
        background: linear-gradient(#1565c0, #0650a3) #2b61b3;
    }

    .btnColor:hover {
        color: white !important;
        border: 2px solid blue !important;
        padding: 12px !important;

    }
</style>
<!-- Offline Data get -->
<script>
    // Start for index blade
    $(document).ready(function() {
        // selected value in region
        $('#data_select_region').click(function() {
            // getDisctictResult($(this).val());
            getTownShipResult($(this).val());
        });


        // selected value in district
        // $('#data_select_district').click(function() {

        // });

        // selected value in township
        $('#data_select_township').click(function() {
            getHFResult($(this).val());
        });

        // selected value in healthfacility
        $('#data_select_hf').click(function() {
            getSubCenterResult($(this).val());
        });

        $('#data_select_subcenter').click(function() {
            getVillageResult($(this).val());
        });

    });

    function downloadDataFromOnline() {
        alert('Are you sure to download data from online');

        // $(button).prop("disabled", true);
        // $(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');

        $.ajax({
            type: "GET",
            url: "/api/downloadDataFromOnline/", //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,

            success: function(data) {
                alert('Download From Online Successfully');
            },

            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }


        });

    }

    // get District Data form Database
    // function getDisctictResult(selectedValue) {
    //     // call  ajax method to get data from database
    //     // clear data from select option set
    //     var list = document.getElementById("data_select_district");
    //     clearSelectList(list);

    //     $.ajax({
    //         type: "GET",
    //         url: "/api/district/" + selectedValue, //this  should be replace by your server side method
    //         //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
    //         contentType: "application/json; charset=utf-8",
    //         dataType: "json",
    //         async: false,
    //         success: function(data) {
    //             console.log(data);
    //             for (var i = 0; i < data.length; i++) {
    //                 var ele = document.createElement("option");
    //                 ele.value = data[i].district_name_mmr;
    //                 ele.innerHTML = data[i].district_name_en;
    //                 document.getElementById("data_select_district").appendChild(ele);
    //             }
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             // alert(errorThrown);
    //         }
    //     });
    // }

    // get Township Data form Database
    function getTownShipResult(selectedValue) {
        // call  ajax method to get data from database
        // clear data from select option set
        var list = document.getElementById("data_select_township");
        clearSelectList(list);

        $.ajax({
            type: "GET",
            url: "/api/township/" + selectedValue.substring(0,
                6), //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",

            async: false,
            success: function(data) {
                //console.log(data);
                //alert(data.township_mmr);

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");
                    ele.value = data[i].township_mmr;
                    ele.innerHTML = data[i].township_name_en;
                    document.getElementById("data_select_township").appendChild(ele);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    // get Health Facility Data form Database
    function getHFResult(selectedValue) {
        // call  ajax method to get data from database
        // clear data from select option set
        var list = document.getElementById("data_select_hf");
        clearSelectList(list);

        $.ajax({
            type: "GET",
            url: "/api/healthfacility/" + selectedValue.substring(0,
                9), //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            success: function(data) {
                console.log(data);
                //alert(data.township_mmr);

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");
                    ele.value = data[i].health_facility_mmr;
                    ele.innerHTML = data[i].health_facility_name_en;
                    document.getElementById("data_select_hf").appendChild(ele);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    // get Subcenter Data form Database
    function getSubCenterResult(selectedValue) {
        // call  ajax method to get data from database
        // clear data from select option set
        var list = document.getElementById("data_select_subcenter");
        clearSelectList(list);

        $.ajax({
            type: "GET",
            url: "/api/subcenter/" + selectedValue.substring(0,
                11), //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            success: function(data) {
                // alert('this is sc');
                // console.log(data);
                //alert(data.township_mmr);

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");
                    ele.value = data[i].sub_center_mmr;
                    ele.innerHTML = data[i].sub_center_name_en;
                    document.getElementById("data_select_subcenter").appendChild(ele);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function getVillageResult(selectedValue) {
        // call  ajax method to get data from database
        // clear data from select option set
        var list = document.getElementById("data_select_village");
        clearSelectList(list);

        $.ajax({
            type: "GET",
            url: "/api/vhv/" + selectedValue.substring(0,
                14), //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            success: function(data) {
                console.log();
                //alert('this is village');

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");
                    ele.value = data[i].village_mmr;
                    ele.innerHTML = data[i].village_name_en;
                    document.getElementById("data_select_village").appendChild(ele);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function clearSelectList(list) {
        // when length is 0, the evaluation will return false.
        while (list.options.length) {
            // continue to remove the first option until no options remain.
            list.remove(0);
        }
    }

    //End for index blade
</script>
