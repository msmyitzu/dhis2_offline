<tr id="data_entry_row">
    <td style="font-size:10px; font-weight: bold;" P_Number="0"></td>
    <td>
        <input type="date" class="screening_date" id="date" oninput="adjustInputWidth(this)" name="date"
            placeholder="dd/mm/yyyy" required>
        {{-- <input  class="dentry_date" type="text" id=""  > --}}
    </td>
    <td><input type="text" id="" oninput="adjustInputWidth(this)" placeholder="အမည်" required></td>
    {{--  --}}
    <td><input id="age" name="age" type="number" pattern="\d*"  maxlength="3" onkeyup="checkAge(this),handleAge(this);" placeholder="အသက်" oninput =""
            class="age" required></td>
    <td><input type="text" id="" oninput="adjustInputWidth(this)" placeholder="အဘအမည်" required></td>
    {{-- <td> --}}
    {{-- <select name="address" id="" onchange="checkAddress(this);"> --}}
    {{-- <option value="">ရွေးပါ</option> --}}
    {{-- @foreach ($tbl_village as $location) --}}
    {{-- <option value="{{ $location->p_location }}"> --}}

    {{-- {{ $location->village_name_en }} &nbsp;& --}}
    {{-- </option> --}}
    {{-- @endforeach --}}
    {{-- </select> --}}
    {{-- </td> --}}

    <td>
        <select class="" name="address" id="" onclick="outsideTownShipResult(this);">
            {{-- <option value="" selected>ရွေးပါ</option> --}}
            <option value="" selected disabled>ရွေးပါ</option>
            <option value="Within Township">Within township</option>
            <option value="No (Outside Township)">No (Outside Township)</option>
            <option value="No (Outside Country)">No (Outside Country)</option>
        </select>
    </td>
    <td>
        <select class="" name="address" id="" onclick="outsideHFResult(this)">
            <option value="" disabled>မြို့နယ်(လက်ရှိနေရပ်လိပ်စာ)</option>
        </select>

    </td>
    {{-- <input type="text" name="address" id="dAddress1" oninput="adjustInputWidth(this)"  placeholder=""> --}}
    <td>
        <select class="" name="address" id="currentVillage" onclick="handleVillage(this)">
            <option value="" disabled selected>ကျေးရွာ/ရပ်ကွက်(လက်ရှိနေရပ်လိပ်စာ)</option>

        </select>
        {{-- <input type="text" name="address" id="dAddress2" oninput="adjustInputWidth(this)" placeholder=""> --}}
    </td>
    <td>
        {{-- <select class="" name="address" id="dAddress" onchange="location_changed(this)">
            <option value="" disabled selected>ကျေးရွာ/ရပ်ကွက်အမည်(လက်ရှိနေရပ်လိပ်စာ)</option>
            {{-- @foreach ($tbl_village as $v) --}}
            {{-- <option value="{{ $v->village_pcode }}">
                    {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                </option> --}}
            {{-- @endforeach --}}
            <!-- <option value="10">Other</option> -->

        {{-- </select>  --}}
        <input type="text" name="address" id="dAddress3" oninput="adjustInputWidth(this)" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း">
    </td>
    <td>
        <select class="" name="address" id="" onchange="currentHFResult(this)">
            <option value="" disabled selected>ရွေးပါ</option>
            <option value="" disabled>မြို့နယ်(အမြဲတမ်းနေရပ်လိပ်စာ)</option>
        </select>
        {{-- <input type="text" name="address" id="dAddress4" oninput="adjustInputWidth(this)" placeholder=""> --}}
    </td>
    <td>
        <select class="" name="address" id="" onclick="handleVil(this)">
            <option value="" disabled selected>ကျေးရွာ/ရပ်ကွက်(အမြဲတမ်းနေရပ်လိပ်စာ)</option>
        </select>
        {{-- <input type="text" name="address" id="dAddress5" oninput="adjustInputWidth(this)" placeholder=""> --}}
    </td>
    <td>

        <input type="text" name="address" class="other-address" id="permentVillage" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း">
    </td>
    <td>
        <select name="sextype" id="sextype" onclick="checkSex(this); adjustInputWidth(this)" class="sex">

            <option value="" selected disabled>ရွေးပါ</option>
            <option value="TT-Male">Male</option>
            <option value="TT-female">Female</option>

        </select>
    </td>
    <td>
        <select name="preg" id="preg" class="preg" onchange="checkPreg(this); adjustInputWidth(this);"
            required>

            <option value="" selected disabled>ရွေးပါ</option>
            {{-- <option value="N/A">N/A</option> --}}
            <option value="Yes">Yes</option>
            <option value="No">No</option>


        </select>
    </td>
    <td>
        <select name="rsc_test" id="rsc_test" onchange="checkTestResult(this); adjustInputWidth();" class=""
            required>
            <option value="not exam">Not Exam</option>
            <option value="neg">Negative</option>
            <option value="pf">Pf</option>
            <option value="pv">Pv</option>
            <option value="mixed">Mixed</option>
            <option value="pm">Pm</option>
            <option value="po">Po</option>

        </select>
    </td>
    <td>
        <select name="rdt_test" id="rdt_test" class="" onchange="checkTestResult(this); adjustInputWidth(this);"
            required>
            <option value="not exam">Not Exam</option>
            <option value="neg">Negative</option>
            <option value="pf">Pf</option>
            <option value="pv">Pv</option>
            <option value="mixed">Mixed</option>
        </select>
    </td>
    <td>
        <select name="out-patient" id="" oninput="adjustInputWidth(this)" style="width: 100%">
            <option value="Uncomplicated (OP)">Uncomplicated (OP)</option>
            <option value="Uncomplicated (IP)">Uncomplicated (IP)</option>
            <option value="Severe (OP)">Severe (OP)</option>
            <option value="Cerebral Malaria (IP)">Cerebral Malaria (IP)</option>
            <option value="Other Severe Complicated Malaria (IP)">Other Severe Complicated Malaria (IP)</option>
            <option value="N/A">N/A</option>
        </select>
    </td>
    <td>
        {{-- oninput="adjustInputWidth(this)" --}}
        <select name="ACT" id="act" onclick="handleACT(this);" class="acts">
            <option value="N/A" selected >N/A</option>
            <option value="ACT-6 tablets (1/2 strip)">ACT-6 tablets (1/2 strip)</option>
            <option value="ACT-6 tablets (1 strip)">ACT-6 tablets (1 strip)</option>
            <option value="ACT-12 tablets (1 strip)">ACT-12 tablets (1 strip)</option>
            <option value="ACT-18 tablets (1 strip)">ACT-18 tablets (1 strip)</option>
            <option value="ACT-24 tablets (1 strip)">ACT-24 tablets (1 strip)</option>
            <option value="Other ACT">Other ACT</option>
            <option value="Out of stock">Out of stock</option>
            {{-- <option value="N/A">N/A</option> --}}
        </select>
    </td>
    <td>
        <select name="CQ" id="cq" class="cq">
            <option value="N/A" selected>N/A</option>
            <option value="CQ - 1 tablet">CQ - 1 tablet</option>
            <option value="CQ - 4 tablets">CQ - 4 tablets</option>
            <option value="CQ - 5 tablets">CQ - 5 tablets</option>
            <option value="CQ - 7.5 tablets">CQ - 7.5 tablets</option>
            <option value="CQ - 10 tablets">CQ - 10 tablets</option>
            <option value="Out of stock">Out of stock</option>
            {{-- <option value="N/A">N/A</option> --}}
        </select>
    </td>
    <td><select name="PQ" id="pq" class="pq">

            <option value="N/A" selected>N/A</option>
            <option value="PQ - 1 tablet">PQ - 1 tablet</option>
            <option value="PQ - 2 tablets">PQ - 2 tablets</option>
            <option value="PQ - 4 tablets">PQ - 4 tablets</option>
            <option value="PQ - 6 tablets">PQ - 6 tablets</option>
            <option value="PQ - 7 tablets">PQ - 7 tablets</option>
            <option value="PQ - 14 tablets">PQ - 14 tablets</option>
            <option value="PQ - 21 tablets">PQ - 21 tablets</option>
            <option value="PQ - 28 tablets">PQ - 28 tablets</option>
            <option value="Out of stock">Out of stock</option>
            {{-- <option value="N/A">N/A</option> --}}
        </select>
        {{-- " <input type="text" id=""  placeholder="N/A" class="pq only-integer">oninput="adjustInputWidth(this)" --}}



    </td>
    <td>
        <select name="referral" id="" oninput="adjustInputWidth(this)">
            <option value="Yes">Yes</option>
            <option value="No" selected>No</option>
            {{-- @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach --}}
        </select>
    </td>
    <td>
        <select name="malaria-death" id="" onchange="checkMpdeath(this)">
            <option value="Yes">Yes</option>
            <option value="No" selected>No</option>
            {{-- @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach --}}
        </select>
    </td>
    <td>
        <select name="" id="t-given">
            <option value="<=24hr" selected>
                <=24hr </option>
            <option value=">24hr">
                >24hr
            </option>

        </select>
    </td>
    <td>
        <select name="travel" id="travel" onchange="handleTravelling(this)">
            <option value="No" selected>No</option>
            <option value="Yes">Yes</option>

        </select>
    </td>
    <td>
        <select name="job" id="job" oninput="adjustInputWidth(this)" required>
            <option value="" disabled selected>ရွေးပါ</option>
            <option value="Rubber Plantation">Rubber Plantation</option>
            <option value="Gardening">Gardening</option>
            <option value="Forest Related Job">Forest Related Job</option>
            <option value="Construction">Construction</option>
            <option value="Mining">Mining</option>
            <option value="Other">Other</option>

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
    

    //Start for township & village calling


    $(document).ready(function() {
        $('#data_select_township').change(function() {
            var selectedValue = $(this).val();
            getTownshipResult(selectedValue);
        });

        function getTownshipResult(selectedValue) {
            // Your existing AJAX call to populate the first select box remains unchanged

            // Add another AJAX call to populate the second select box
            $.ajax({
                type: "GET",
                url: "/api/township/" + selectedValue.substring(0, 6),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    console.log('hello mzh->',data);
                    $('#second_select_township').empty();


                    for (var i = 0; i < data.length; i++) {
                        var ele = document.createElement("option");
                        ele.value = data[i].township_mmr;
                        ele.innerHTML = data[i].township_name_en;
                        $('#second_select_township').append(ele);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });


    // $('#outsideCountry').click(function() {
    //             outsideHFResult($(this).val());
    //         });
    // selected value in district


function handleAge(age) {
    var inputValue = $(age).val().trim();
    var char = parseInt(inputValue, 10);

    if (isNaN(char) || char < 0 || inputValue.indexOf('.') !== -1) {
        $(age).val('');
    } else {
        $(age).val(char);
    }
}

function handleTravelling(yes){

    var tr = $(yes).closest('tr');
    var travel = tr.find('td:eq(23) select').val();
            // console.log(travel);
        if(travel == 'Yes'){
            // console.log('hello');

            alert('မှတ်ချက်တွင် ခရီးသွားရာဇဝင်ကိုဖော်ပြပါ');
        }

}

function handleACT(act){
    let tr = $(act).closest('tr');
    let other = tr.find('td:eq(17) select').val();
    if(other == 'Other ACT'){
        alert('မှတ်ချက်တွင် Other ACTဆေးဖြင့် ကုသမှုကိုဖော်ပြပါ');
    }
}

function handleVillage(vil){
        var tr = $(vil).closest('tr');
        let cur_other = tr.find('td:eq(7) select').val();
            if (cur_other == 'MMR012003_999999') {
            // tr.find('td:eq(11) input').prop('disabled', false);
            tr.find('td:eq(8) input').prop('disabled', false);
            }else{
                tr.find('td:eq(8) input').val('');
                tr.find('td:eq(8) input').prop('disabled', true);

            }

    }
    function handleVil(vil){
        var tr = $(vil).closest('tr');
        var per_other = tr.find('td:eq(10) select').val();
            if (per_other == 'MMR012003_999999') {
                tr.find('td:eq(11) input').prop('disabled', false);
            }else{
                tr.find('td:eq(11) input').val('');
                tr.find('td:eq(11) input').prop('disabled', true);

            }
    }

    // get Township Data form Database
function outsideTownShipResult(selectedValue) {

        var tr = $(selectedValue).closest('tr');
        if (selectedValue.value == 'No (Outside Township)') {
            $(selectedValue).show();
            tr.find('td:eq(11) input').val('');
            tr.find('td:eq(8) input').val('');
            tr.find('td:eq(11) input').prop('disabled', true);
            tr.find('td:eq(8) input').prop('disabled', true);
            currentTownShipResult(selectedValue,'national');


        }else if (selectedValue.value == 'No (Outside Country)') {
            $(selectedValue).show();
            tr.find('td:eq(6) select,td:eq(7) select').prop('disabled', false);
            tr.find('td:eq(11) input').val('');
            tr.find('td:eq(11) input').prop('disabled', false);
            tr.find('td:eq(9) select,td:eq(10) select').val('');
            tr.find('td:eq(9) select,td:eq(10) select').prop('disabled', true);
            tr.find('td:eq(8) input').val('');
            tr.find('td:eq(8) input').prop('disabled', true);
            currentTownShipResult(selectedValue,'national');

        } else {
            $(selectedValue).show();
            tr.find('td:eq(8) input').val('');
            tr.find('td:eq(11) input').val('');
            tr.find('td:eq(8) input').prop('disabled', true);
            tr.find('td:eq(11) input').prop('disabled', true);
            tr.find('td:eq(6) select,td:eq(7) select,td:eq(9) select,td:eq(10) select').val('');
            tr.find('td:eq(6) select,td:eq(7) select,td:eq(9) select,td:eq(10) select').prop('disabled', false);

        var tr = $(selectedValue).closest('tr');
        //console.log('thi mzh',tr);
        var list = tr.find('td:eq(6) > select, td:eq(9) > select');
        // console.log('hi',list);
        //alert('this is',list);
        // clearSelectList(list);+ "?type=" + selectedValue.value
        list.empty();


        $.ajax({
            type: "GET",
            url: "/api/outtownship/" + selectedValue.value,
            //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            success: function(data) {

                // console.log('thu thu ===>', data);

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");
                    ele.value = data[i].township_mmr;
                    ele.innerHTML = data[i].township_name_en;
                    list.append(ele);

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

        }

};


function currentTownShipResult(selectedValue,type = "current") {
        // call  ajax method to get data from database
        // clear data from select option set

        let url ;

        if(type == "current")
        {
            url = "api/currenttownship/" + selectedValue.value;
        }
        else{
            url = "api/nationaltownship";
        }

        var tr = $(selectedValue).closest('tr');
        console.log('thi mzh',tr);
        var list = tr.find('td:eq(6) > select, td:eq(9) > select');
        // var list = tr.find('td:eq(6) > select');
        //console.log('hi',list);
        //alert('this is',list);
        // clearSelectList(list);
        list.empty();

        $.ajax({
            type: "GET",
            url: url,
            //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,

            success: function(data) {

                console.log('thu', data);

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");

                    ele.value = data[i].township_mmr;
                    ele.innerHTML = data[i].township_name_en;

                    list.append(ele);

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
}





    // get Health Facility Data form Database
    function outsideHFResult(selectedValue,type = "outside") {


        let url ;

            if(type == "outside")
            {
                url = "/api/outhealthfacility/" + selectedValue.value.substring(0,9);
            }
            else{
                url = "/api/currenthealthfacility/" + selectedValue.value.substring(0,9);;
            }

        var tr = $(selectedValue).closest('tr');

        var list = tr.find('td:eq(7) > select');
        //clearSelectList(list);
        list.empty();

        $.ajax({
            type: "GET",
            url: url ,                    //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            success: function(data) {

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");
                    ele.value = data[i].health_facility_mmr;
                    ele.innerHTML = data[i].health_facility_name_en;
                    list.append(ele);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function currentHFResult(selectedValue ,type = "outside") {
        let url ;

            if(type == "outside")
            {
                url = "/api/outhealthfacility/" + selectedValue.value.substring(0,9);
            }
            else{
                url = "/api/currenthealthfacility/" + selectedValue.value.substring(0,9);;
            }

        var tr = $(selectedValue).closest('tr');

        var list = tr.find('td:eq(10) select');
        //clearSelectList(list);
        list.empty();

        $.ajax({
            type: "GET",
            url: url ,                    //this  should be replace by your server side method
            //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            success: function(data) {

                for (var i = 0; i < data.length; i++) {
                    var ele = document.createElement("option");
                    ele.value = data[i].health_facility_mmr;
                    ele.innerHTML = data[i].health_facility_name_en;
                    list.append(ele);
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



    //End for township & village calling

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

    // $("#data_entry_body tr td input").focus(function() {
    //     highlight_row(this);
    // });

    // $("#data_entry_body tr td select").focus(function() {
    //     highlight_row(this);
    // });

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
