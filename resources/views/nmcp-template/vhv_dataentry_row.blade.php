<tr>
    <td style="font-size:10px; font-weight: bold;" P_Number="0">1</td>
    <td><input class="dentry_date" type="text" placeholder="ရက်စွဲ" min="1" max="31" onchange="dateCheck(this)"></td>
    <td><input type="text" placeholder="အမည်" class="vhv-name"></td>
    <td><input type="text" placeholder="အသက်" class="agevhv dentry_age" onchange="checkAge(this)"></td>
    <td>
        <select name="address" id="" onblur="location_changed(this)">
                <option value="" selected>ရွေးပါ</option>
                @foreach ($tbl_village as $v)
                    <option value="{{ $v->village_pcode }}" >
                        {{ $v->village}} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                        <!-- {{ $v->village_mya_mmr3 }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract_mya_mmr3 }} -->
                    </option>
                @endforeach
                <option value="20">Other Within Township</option>
				<option value="30">Other Outside Township</option>
				{{-- <option value="10">Other</option> --}}
				<option value="99">Missing</option>
        </select>
    </td>
    <td><input type="text" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း" disabled="true"></td>
    <td>
        <select name="sex" class="sexvhv" onchange="checkSex(this)">
            <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_patient_sex as $sex)
                <option value="{{ $sex->Sex_Code }}">
                    {{ $sex->P_Sex }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="preg" class="pregvhv">
        <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="rdt" class="rdtvhv">
        <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_rdt_result as $rdt)
                <option value="{{ $rdt->r_code }}">
                    {{ $rdt->r_result }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="out-patient" id="" style="width: 100%">
        <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_in_out_cat as $ioc)
                <option value="{{ $ioc->ioc_code }}">
                    {{ $ioc->io_cat }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="ACT" class="actvhv">
        <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_act_code as $act)
                <option value="{{ $act->act_code }}">
                    {{ $act->act_treatment }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
		<input type="number" placeholder="ဆေးလုံးရေ" class="cqvhv only-integer" onchange=''>
	</td>
	<td>
		<input type="number" placeholder="ဆေးလုံးရေ" class="pqvhv only-integer" onchange=''>
	</td>
    <td>
        <select name="referral" id="">
        <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="malaria-death" onchange="checkMpdeath(this)">
        <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="" id="t-given">
            <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_treatment_given as $treatment)
                <option value="{{ $treatment->tg_code }}">
                    {{ $treatment->t_given }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="travel-log" id="travel-log">
        <option value="" selected>ရွေးပါ</option>
            @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
            @endforeach
    </td>
    <td>
        <select name="job" id="job">
		<option value="" selected>ရွေးပါ</option>
            @foreach ($lp_occupation as $job)
                <option value="{{ $job->occupation_id }}">
                    {{ $job->occupation_name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="text" placeholder="မှတ်ချက်(Optional)">
    </td>
    <td>
        <a href="javascript:void(0)" class="delete_icon" onclick="delete_row(this)" rowNo="">
            <li class="fa fa-trash-o"></li>
        </a>
    </td>
</tr>
<script>
    clickOnRow();
    var today = new Date() ;
    var dd = today.getDate() < 10 ? `0${today.getDate()}` : today.getDate() ;
    var mm = today.getMonth() < 9 ? `0${today.getMonth() + 1}` : today.getMonth() + 1 ;
    var yyyy = today.getFullYear();
    var maxDate = `${dd}-${mm}-${yyyy}` ;
    $('.dentry_date').inputmask('datetime', {
        inputFormat : 'dd-mm-yyyy',
        placeholder : '_',
        clearIncomplete: true,
        min : '09-09-0900',
        max : maxDate
    });

    // $(document).ready(function(){
    //     var table = document.getElementById('data_entry_body');
    //     var v = null ; var _id = null ;
    //     for(var i = 0, row ; row = table.rows[i]; i ++){
    //         v = row.cells[19].children[0].getAttribute('rowNo');
    //         _id = row.cells[1].children[0].className + v ;
    //         row.cells[1].children[0].setAttribute('id', _id);
    //     }
    //     var xxx = new custom_inputmask(_id, '_', '-');
    // });

	$(".dentry_age").on('keypress keyup blur', function(event){
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
    });

    // $(".only-integer").on('keypress keyup blur', function(event){
    //     if ((event.which < 48 || event.which > 57)) {
    //         if(event.which != 46){
    //             event.preventDefault();
    //         }
    //     }
    // });

    $("input").focus(function() {
        highlight_row(this);
    });

    $("select").focus(function() {
        highlight_row(this);
    });
</script>
