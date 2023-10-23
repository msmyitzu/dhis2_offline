

<tr>
    <td style="font-size:10px; font-weight: bold;" P_Number="0"></td>
    <td>
        <input type="date" id="birthday" oninput="adjustInputWidth(this)" name="birthday" placeholder="dd/mm/yyyy">
        {{-- <input class="dentry_date" type="text" id=""  > --}}
    </td>
    <td><input type="text" id="" oninput="adjustInputWidth(this)" placeholder="အမည်"></td>
    <td><input id="age" type="text" placeholder="အသက်" onchange="checkAge(this);" class="age"></td>
    <td><input type="text" id="" oninput="adjustInputWidth(this)" placeholder="အဘအမည်"></td>
    {{-- <td> --}}
    {{-- <select name="address" id="" onchange="checkAddress(this);"> --}}
    {{-- <option value="">ရွေးပါ</option> --}}
    @foreach ($lp_patient_location as $location)
        {{-- <option value="{{ $location->p_location }}"> --}}
        {{ $location->patient_location }} &nbsp;&
        {{-- </option> --}}
    @endforeach
    {{-- </select> --}}
    {{-- </td> --}}

    <td>
        <select class="" name="address" id="dAddress"  onchange="location_changed(this)">
            <option value="" selected>ရွေးပါ</option>
            @foreach ($tbl_village as $v)
                <option value="{{ $v->village_pcode }}">
                    {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                </option>
            @endforeach
            <!-- <option value="10">Other</option> -->
            <option value="20">Other Within Township</option>
            <option value="30">Other Outside Township</option>
            <option value="99">Missing</option>
        </select>
    </td>
    <td>
        <input type="text" name="address" id="dAddress1" oninput="adjustInputWidth(this)"  placeholder="မြို့နယ်(လက်ရှိနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress2" oninput="adjustInputWidth(this)" placeholder="ကျေးရွာ/ရပ်ကွက်(လက်ရှိနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress3" oninput="adjustInputWidth(this)" placeholder="ကျေးရွာ/ရပ်ကွက်အမည်(လက်ရှိနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress4" oninput="adjustInputWidth(this)" placeholder="မြို့နယ်(အမြဲတမ်းနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress5" oninput="adjustInputWidth(this)" placeholder="ကျေးရွာ/ရပ်ကွက်(အမြဲတမ်းနေရပ်လိပ်စာ)">
    </td>
    <td><input type="text" class="other-address" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း" disabled="true"></td>
    <td>
        <select name="sex" id="sex" onchange="checkSex(this); adjustInputWidth(this)" class="sex">

                <option value="choose">ရွေးပါ</option>
                <option value="male">Male</option>
                <option value="female">Female</option>

        </select>
    </td>
    <td>
        <select name="preg" id="preg" class="preg" onchange="checkPreg(this); adjustInputWidth(this);">

                {{-- <option value="">ရွေးပါ</option> --}}
                <option value="N/A">N/A</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>


        </select>
    </td>
    <td>
        <select name="rsc_test" id="rsc_test" onchange="checkTestResult(this); adjustInputWidth();" class="" >
            <option value="NotExam">Not exam</option>
            <option value="Negative">Negative</option>
            <option value="Pf">Pf</option>
            <option value="Pv">Pv</option>
            <option value="Mixed">Mixed</option>
            <option value="Pm">Pm</option>
            <option value="Po">Po</option>
        </select>
    </td>
    <td>
        <select name="rdt_test" id="rdt_test" class="" onchange="checkTestResult(this); adjustInputWidth(this);">
            <option value="NotExam">Not exam</option>
            <option value="Negative">Negative</option>
            <option value="Pf">Pf</option>
            <option value="Pv">Pv</option>
            <option value="Mixed">Mixed</option>
        </select>
    </td>
    <td>
        <select name="out-patient" id="" oninput="adjustInputWidth(this)"  style="width: 100%">
            <option value="" selected>N/A</option>
            @foreach ($lp_in_out_cat as $ioc)
                <option value="{{ $ioc->ioc_code }}">
                    {{ $ioc->io_cat }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        {{-- oninput="adjustInputWidth(this)" --}}
        <select name="ACT" id="act"  onchange="checkACT(this); adjustInputWidth(this);" class="acts"  >
           <option value="N/A">N/A</option>
           <option value="3">ACT-6 tablets(1/2 strip)</option>
           <option value="6">ACT-6 tablets(1 strip)</option>
           <option value="12">ACT-12 tablets(1 strip)</option>
           <option value="18">ACT-18 tablets(1 strip)</option>
           <option value="24">ACT-24 tablets(1 strip)</option>
           <option value="Other_ACT">Other ACT</option>
           <option value="Out">Out of stock</option>
           <option value="N/A">N/A</option>
        </select>
    </td>
    <td>
        {{-- <input type="text" id="" oninput="adjustInputWidth(this)" placeholder="N/A" class="cq only-integer"> oninput="adjustInputWidth(this)"--}}
        <select name="" id="cq" class="cq only-integer" onchange="checkCQ(this); adjustInputWidth(this);">
            <option value="N/A">N/A</option>
            <option value="1">CQ-1 tablets</option>
            <option value="4">CQ-4 tablets</option>
            <option value="5">CQ-5 tablets</option>
            <option value="7.5">CQ-7.5 tablets</option>
            <option value="10">CQ-10 tablets</option>
            <option value="Out">Out of stock</option>
            <option value="N/A">N/A</option>
        </select>
    </td>
    <td><select name="" id="pq" class="pq only-integer" onchange="filterPQ(this); adjustInputWidth(this);">
            <option value="N/A">N/A</option>
            <option value="1">PQ-1 tablets</option>
            <option value="2">PQ-2 tablets</option>
            <option value="4">PQ-4 tablets</option>
            <option value="6">PQ-6 tablets</option>
            <option value="7">PQ-7 tablets</option>
            <option value="14">PQ-14 tablets</option>
            <option value="21">PQ-21 tablets</option>
            <option value="28">PQ-28 tablets</option>
            <option value="Out">Out of stock</option>
            <option value="N/A">N/A</option>
        </select>
        {{--" <input type="text" id=""  placeholder="N/A" class="pq only-integer">oninput="adjustInputWidth(this)" --}}



    </td>
    <td>
        <select name="referral" id="" oninput="adjustInputWidth(this)">
            <option value="" selected>No</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="malaria-death" id="" onchange="checkMpdeath(this)">
            <option value="" selected>No</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="" id="t-given">
            <option value="" selected><=24hr</option>
            @foreach ($lp_treatment_given as $treatment)
                <option value="{{ $treatment->tg_code }}">
                    {{ $treatment->t_given }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="travel-log" id="travel-log">
            <option value="" selected>No</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="job" id="job" oninput="adjustInputWidth(this)">
            <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_occupation as $job)
                <option value="{{ $job->occupation_id }}">
                    {{ $job->occupation_name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="text" id="remark" oninput="adjustInputWidth(this)" placeholder="မှတ်ချက်">
    </td>
    <td style="padding-right: 20px; padding-left: 10px;">
        <a href="javascript:void(0)" id="delete_row" class="delete_icon" onclick="delete_row(this)" rowNo="1">
            <li class="fa fa-trash-o bg-white"></li>
        </a>

    </td>
</tr>
<script>
    clickOnRow();

    $(function() {
        var toDate = new Date();
        var dd = toDate.getDate() < 10 ? `0${toDate.getDate()}` : toDate.getDate();
        var mm = toDate.getMonth() < 9 ? `0${toDate.getMonth() + 1}` : toDate.getMonth() + 1;
        var yyyy = toDate.getFullYear();
        var maxDate = `${dd}-${mm}-${yyyy}`;

        // var formMonth = $("#frm_month").val();
        // var formYear = $("#frm_year").val();
        // var formDate = new Date(`${formMonth}-01-${formYear}`).getDate();
        // var lastMonthDate = new Date(new Date().setDate(formDate - 30));
        // var lmDay = lastMonthDate.getDate() < 10 ? `0${lastMonthDate.getDate()}` : lastMonthDate.getDate();
        // var lmMonth = lastMonthDate.getMonth() < 9 ? `0${lastMonthDate.getMonth() + 1}` : lastMonthDate.getMonth() + 1;
        // var lmYear = lastMonthDate.getFullYear();
        // var minDate = `${lmDay}-${lmMonth}-${lmYear}`;
        $('.dentry_date').inputmask('datetime', {
            inputFormat: 'dd-mm-yyyy',
            placeholder: '_',
            clearIncomplete: true,
            min: '09-09-0999',
            max: maxDate
        });
    });

    // $(document).ready(function() {
    //     var table = document.getElementById('data_entry_body');
    //     var v = null;
    //     var _id = null;
    //     for (var i = 0, row; row = table.rows[i]; i++) {
    //         v = row.cells[20].children[0].getAttribute('rowNo');
    //         _id = row.cells[1].children[0].className + v;
    //         row.cells[1].children[0].setAttribute('id', _id);
    //     }
    //     var zzz = new custom_inputmask(_id, '_', '-');
    // });

    $('#dAddress').change(function() {
        location_changed(this.value);
    });

    // $(".only-integer").on('keypress keyup blur', function(event){
    // 	// $(this).val($(this).val().replace(/[^\d][\.]+/, "")); //^\d*\.?\d+$ // original /[^\d].+/
    // 	if ((event.which < 48 || event.which > 57)) {
    //         if(event.which != 46){
    //             event.preventDefault();
    //         }
    //     }
    // });

    $(".dentry_age, .only-integer").on('keypress keyup blur', function(event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $("#data_entry_body tr td input").focus(function() {
        highlight_row(this);
    });

    $("#data_entry_body tr td select").focus(function() {
        highlight_row(this);
    });

    // function checkRDTTest() {
    //     var x = document.getElementById("rdt_test").value;
    //     var xx = document.getElementById("age").value;
    //     if (xx == 20) {
    //         document.getElementById("rdt_test").selectedIndex = 1;
    //     }
    //     alert(x);
    // }

    // function checkTestResult(){

    //     var x = document.getElementById("rsc_test").value;
    //     alert(x);
    //     if (x == "Negative") {
    //         document.getElementById("rdt_test").selectedIndex = 1;

    //     }else if (x == "Pf") {
    //         document.getElementById("rdt_test").selectedIndex = 2;

    //     }else if (x == "Pv") {
    //         document.getElementById("rdt_test").selectedIndex = 3;

    //     }

    // }
</script>
