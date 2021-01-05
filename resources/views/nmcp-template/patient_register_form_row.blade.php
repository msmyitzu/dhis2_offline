<tr>
        <td style="font-size:10px; font-weight: bold;" P_Number="0"></td>
        <td>
			<input class="dentry_date" type="text" placeholder="ရက်စွဲ">
		</td>
        <td><input type="text" placeholder="အမည်" class='bhs-name'></td>
        <td><input class="age dentry_age" type="text" placeholder="အသက်" onchange="checkAge(this);"></td>
        <td>
            <select name="address" id="dAddress" onblur="location_changed(this);">
                <option value="" selected>ရွေးပါ</option>
                @foreach ($tbl_village as $v)
                    <option value="{{ $v->village_pcode }}" >
                        {{ $v->village }} &nbsp;&nbsp;&nbsp;&nbsp;| {{ $v->village_tract }}
                    </option>
                @endforeach
				<option value="20">Other Within Township</option>
				<option value="30">Other Outside Township</option>
				{{-- <option value="10">Other</option> --}}
				<option value="99">Missing</option>
            </select>
        </td>
        <td><input type="text" placeholder="ရွာ-မြို့-ပြည်-နယ်-တိုင်း" disabled ="true"></td>
        <td>
            <select name="sex" class="sex" onchange="checkSex(this);">
                <option value="" selected>ရွေးပါ</option>
                @foreach ($lp_patient_sex as $sex)
                    <option value="{{ $sex->Sex_Code }}">
                        {{ $sex->P_Sex }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="preg" class="preg" >
            <option value="" selected>ရွေးပါ</option>
                @foreach ($lp_yesno as $yn)
                <option value="{{ $yn->YN_Code }}">
                    {{ $yn->YesNo }}
                </option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="rcs" class="rcs">
                <option value="" selected>ရွေးပါ</option>
                @foreach ($lp_micro_result as $rcs)
                    <option value="{{ $rcs->mr_code }}">
                        {{ $rcs->m_result }}
                    </option>
                @endforeach          
            </select>
        </td>
        <td>
            <select name="rdt" class="rdt" >
                <option value="">ရွေးပါ</option>
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
            <select name="ACT" class="act" >
                <option value="" selected>ရွေးပါ</option>
                @foreach ($lp_act_code as $act)
                    <option value="{{ $act->act_code }}">
                        {{ $act->act_treatment }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" placeholder="ဆေးလုံးရေ" class="cq only-integer">
        </td>
        <td>
            <input type="number" placeholder="ဆေးလုံးရေ" class="pq only-integer">
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
            <select name="malaria-death" id="" onchange="checkMpdeath(this)">
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
            </select>
        </td>
        <td>
            <select name="job" id="job" >
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
            <a href="javascript:void(0)" class="delete_icon" onClick="delete_row(this);" rowNo="">
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

        var formMonth = $("#frm_month").val() ;
        var formYear = $("#frm_year").val() ;
        var formDate = new Date(`${formMonth}-01-${formYear}`).getDate();
        var lastMonthDate = new Date(new Date().setDate(formDate - 30)) ;
        var lmDay = lastMonthDate.getDate() < 10 ? `0${lastMonthDate.getDate()}` : lastMonthDate.getDate() ;
        var lmMonth = lastMonthDate.getMonth() < 9 ? `0${lastMonthDate.getMonth() + 1}` : lastMonthDate.getMonth() + 1 ;
        var lmYear = lastMonthDate.getFullYear();
        var minDate = `${lmDay}-${lmMonth}-${lmYear}` ;
        $('.dentry_date').inputmask('datetime', {
            inputFormat : 'dd-mm-yyyy',
            placeholder : '_',
            clearIncomplete: true,
            min : '09-09-0999',
            max : maxDate,
        });

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

		$('#dAddress').change(function(){
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

        $(".dentry_age").on('keypress keyup blur', function(event){
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $( "#data_entry_body tr td input" ).focus(function() {
            highlight_row(this);
        });
    
        $( "#data_entry_body tr td select" ).focus(function() {
            highlight_row(this);
        });
    </script>