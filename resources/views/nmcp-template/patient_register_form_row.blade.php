<tr>
    <td style="font-size:10px; font-weight: bold;" P_Number="0"></td>
    <td>
        <input type="date" id="birthday myInput" oninput="adjustInputWidth(this)" name="birthday" placeholder="dd/mm/yyyy">
        {{-- <input class="dentry_date" type="text" id=""  > --}}
    </td>
    <td><input type="text" id="myInput" oninput="adjustInputWidth(this)" placeholder="အမည်"></td>
    <td><input id="dentry_age myInput" type="text" oninput="adjustInputWidth(this)" placeholder="အသက်" onchange="checkAge(this);" class="age"></td>
    <td><input type="text" id="myInput" oninput="adjustInputWidth(this)" placeholder="အဘအမည်"></td>
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
        <input type="text" name="address" id="dAddress myInput" oninput="adjustInputWidth(this)"  placeholder="မြို့နယ်(လက်ရှိနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress myInput" oninput="adjustInputWidth(this)" placeholder="ကျေးရွာ/ရပ်ကွက်(လက်ရှိနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress myInput" oninput="adjustInputWidth(this)" placeholder="ကျေးရွာ/ရပ်ကွက်အမည်(လက်ရှိနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress myInput" oninput="adjustInputWidth(this)" placeholder="မြို့နယ်(အမြဲတမ်းနေရပ်လိပ်စာ)">
    </td>
    <td>
        <input type="text" name="address" id="dAddress myInput" oninput="adjustInputWidth(this)" placeholder="ကျေးရွာ/ရပ်ကွက်(အမြဲတမ်းနေရပ်လိပ်စာ)">
    </td>
    <td><input type="text" class="other-address" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း" disabled="true"></td>
    <td>
        <select name="sex" id="myInput" oninput="adjustInputWidth(this)" onchange="checkSex(this);" class="sex">
            <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_patient_sex as $sex)
                <option value="{{ $sex->Sex_Code }}">
                    {{ $sex->P_Sex }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="preg" id="myInput" oninput="adjustInputWidth(this)" class="preg">
            <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="rcs" id="myInput" oninput="adjustInputWidth(this)" class="rcs">
            <option value="" selected>Not Exam</option>
            @foreach ($lp_micro_result as $rcs)
                <option value="{{ $rcs->mr_code }}">
                    {{ $rcs->m_result }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="rdt" id="myInput" oninput="adjustInputWidth(this)" class="rdt">
            <option value="" selected>Not Exam</option>
            @foreach ($lp_rdt_result as $rdt)
                <option value="{{ $rdt->r_code }}">
                    {{ $rdt->r_result }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="out-patient" id="myInput" oninput="adjustInputWidth(this)" style="width: 100%">
            <option value="" selected>N/A</option>
            @foreach ($lp_in_out_cat as $ioc)
                <option value="{{ $ioc->ioc_code }}">
                    {{ $ioc->io_cat }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="ACT" id="myInput" oninput="adjustInputWidth(this)" class="act">
            <option value="" selected>N/A</option>
            @foreach ($lp_act_code as $act)
                <option value="{{ $act->act_code }}">
                    {{ $act->act_treatment }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        {{-- <input type="text" id="myInput" oninput="adjustInputWidth(this)" placeholder="N/A" class="cq only-integer"> --}}
        <select name="" id="" class="cq only-integer">
            <option value="0">N/A</option>
            <option value="1">3</option>
            <option value="2">6</option>
            <option value="3">12</option>
            <option value="4">18</option>
            <option value="5">24</option>
            <option value="6">Not treated</option>
        </select>
    </td>
    <td>
        {{-- <input type="text" id="myInput" oninput="adjustInputWidth(this)" placeholder="N/A" class="pq only-integer"> --}}
        <select name="" id="" class="cq only-integer">
            <option value="0">N/A</option>
            <option value="1">3</option>
            <option value="2">6</option>
            <option value="3">12</option>
            <option value="4">18</option>
            <option value="5">24</option>
            <option value="6">Not treated</option>
        </select>
    </td>
    <td>
        <select name="referral" id="myInput" oninput="adjustInputWidth(this)">
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
        <select name="job" id="job myInput" oninput="adjustInputWidth(this)">
            <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_occupation as $job)
                <option value="{{ $job->occupation_id }}">
                    {{ $job->occupation_name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="text" id="myInput" oninput="adjustInputWidth(this)" placeholder="မှတ်ချက်">
    </td>
    <td style="padding-right: 20px; padding-left: 10px;">
        <a href="javascript:void(0)" id="delete_row" class="delete_icon" onclick="delete_row(this)" rowNo="1">
            <li class="fa fa-trash-o bg-white"></li>
        </a>
        {{-- <button class="delete_icon"
            id="delete_row" onClick="delete_row(this)" rowNo="1">
            <li class="fa fa-trash-o bg-dark"></li>
        </button> --}}
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
</script>
