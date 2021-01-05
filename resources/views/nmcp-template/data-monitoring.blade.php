<div class="tab-pane" id="data_monitoring">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal text-center" method="post" action="" id="dm_form" target="_blank">
			{{ csrf_field() }}
                <div class="box-body">
					<div class="form-group" style="display:none;">
                        <label for="" class="col-md-6 control-label">ပုံစံအမျိုးအစား</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="select_lp_form_cat_dm" id="select_lp_form_cat_dm"
                            style="width: 100%;" required>
                            <option value="11" selected>0</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-6 control-label">ပြည်နယ်/တိုင်းဒေသကြီး</label>
                        <div class="col-md-6">
                            <select class="form-control select2" style="width: 100%" name="select_lp_stateregion_dm" id="select_lp_stateregion_dm"
							<?php 
                                if(session("role_id") != "3"){
                                //No need to load all townships since current login is tagged to only one township
                            ?>
                                onChange="load_lp_township('select_lp_township_hf', this.value, '<?=csrf_token();?>','')" 
                            <?php
                                }
                            ?>

                            style="width: 100%;">
                                <option value="0">ရွေးရန်</option>
                                @foreach($lp_state_region as $sr)
                                    <option value="{{ $sr->sr_code }}" <?php echo session('role_id') == '3' ? 'selected' : '' ?>>
                                    {{ $sr->sr_name }} | {{ $sr->sr_name_mmr }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-6 control-label">မြို့နယ်</label>
                        <div class="col-md-6">
                            
                            <?php
                                if(session("role_id") === "3"){
                            ?>
                                <select name="select_lp_township_dm" id="select_lp_township_dm"  required                                
                                class="form-control select2 select_lp_township_hf" style="width: 100%;">
                                    {{-- <option value="0">ရွေးရန်</option> --}}
                                    @foreach($lp_township as $ts)
                                        <option value="{{ $ts->ts_code }}">
                                        {{ $ts->ts_name }} | {{ $ts->ts_name_mmr }}
                                        </option>
                                    @endforeach
                                </select>

                            <?php
                                } else {
                            ?>
                                
                                <select name="select_lp_township_dm" id="select_lp_township_dm"  required
                                class="form-control select2 select_lp_township_hf" style="width: 100%;">
                                <option value="0">ရွေးရန်</option>
                                </select>

                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-6 control-label">လ / ခုနှစ်</label>
                        <div class="col-md-6 date"  style="padding-right: 15px; padding-left: 15px">
                            <input type="text" id="dm-form-date" name="dm-form-date" class="form-control text-center" autocomplete=off placeholder="လ / ခုနှစ်" readonly>
                        </div>
                    </div>
                </div>
            </form>
            <div style="border: 1px solid #E7E7E7; text-align: center; margin: 5px">
                <!-- <span class="label-primary pull-left" style="padding: 5px; max-resolution:5px; margin: 5px">VHV</span> -->
                <div style="margin: 5px;">

                    <!-- Remove After Feb/2020 Meeting -->
                    <!-- <button type="button" class="btn btn-block btn-default" onClick="show_check_under_5_years_and_pq_given_by_vh()"
					style="padding: 15px; white-space: normal;">
                    Check under 5 years and PQ given by VH<br>
                    (၅)နှစ်အောက်ကလေးကို PQ ပေးခြင်းစစ်ဆေးရန်
                    (VHV သီးသန့်)
                    </button> -->

                    <button type="button" class="btn btn-block btn-default" onClick="show_check_village_and_vhv_names_onlyvhv()"
					style="padding: 15px; white-space: normal;">
                    Check village and ICMV names( Only ICMV)<br>
                    စေတနာ့ဝန်ထမ်းအမည်နှင့် ကျေးရွာစစ်ဆေးရန် (ICMV သီးသန့်)
                    </button>
                </div>
            </div>
            <div style="border: 1px solid #E7E7E7;text-align: center; margin: 5px">
                {{-- <span class="label-primary pull-left" style="padding: 5px; margin: 5px;">BHS and VHV</span> --}}
                <div style="margin: 5px;">
                    {{-- <button type="button" class="btn btn-block btn-default" onClick="show_check_persons_with_pregnant_in_irrelevant_age()"
					style="padding: 15px; white-space: normal;">
                    Check a person with pregnancy in irrelevant age<br>
                    အသက်အရွယ်နှင့် ကိုယ်ဝန်ဆောင်စစ်ဆေးရန်
                    </button> --}}
                    {{-- <button type="button" class="btn btn-block btn-default" onClick="show_check_sex_and_pregnancy()" 
					style="padding: 15px; white-space: normal;">
                    Check sex and pregnancy<br>
                    ကျား/မ နှင့် ကိုယ်ဝန်ဆောင်စစ်ဆေးရန်
                    </button> --}}
                    {{-- <button type="button" class="btn btn-block btn-default"  onClick="show_check_patient_screening_date()" 
					style="padding: 15px; white-space: normal;">
                    Check patients blank screening date<br>
                    လူနာသွေးဖောက်ရက်စွဲမပါသည့်လူနာများအား စစ်ဆေးခြင်း
                    </button>
                    <button type="button" class="btn btn-block btn-default" onClick="show_check_not_exam_and_text_missing()"  
					style="padding: 15px; white-space: normal;">
                    Check not exam and test missing<br>
                    ငှက်ဖျား စစ်ဆေး/အဖြေ မထည့်ထားခြင်းစစ်ဆေးရန်
                    </button>
                    <button type="button" class="btn btn-block btn-default" onClick="show_find_duplicate_cases()" 
					style="padding: 15px; white-space: normal;">
                    Find Duplicate Cases<br>
                    လူနာစာရင်းထပ်ထည့်မိ့ခြင်းများရှာဖွေရန်
                    </button> --}}

                    <button type="button" class="btn btn-block btn-default" onClick="show_check_no_malaria_treatment_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check no malaria and treatment given<br>
                    ငှက်ဖျားပိုးမတွေ့ဘဲ ဆေးပေးထားခြင်း စစ်ဆေးရန်
                    </button>
                    
                    <button type="button" class="btn btn-block btn-default" onClick="show_check_malaria_pq_notgiven()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check malaria and PQ not given<br>
                    ငှက်ဖျားပိုးတွေ့ပြီး PQ ဆေးမပေးထားခြင်း စစ်ဆေးရန်
                    </button>

                    <button type="button" class="btn btn-block btn-default" onClick="show_check_pf_or_mix_and_act_not_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check Pf or Mix (+) and ACT not given or CQ given<br>
                    Pf သို့မဟုတ် Mix တွေ့ပြီး ACT မပေးခြင်း(သို့) CQ ပေးခြင်း စစ်ဆေးရန်
                    </button>
                    <button type="button" class="btn btn-block btn-default"  onClick="show_check_pv_and_cq_not_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check Pv + and ACT Given or CQ not given<br>
                    Pv တွေ့ပြီး CQ မပေးခြင်း(သို့) ACT ပေးခြင်း စစ်ဆေးရန်
                    </button>
                    <button type="button" class="btn btn-block btn-default"  onClick="show_check_persons_with_pregnant_and_pq_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check a person with pregnant and PQ given<br>
                    ကိုယ်ဝန်ဆောင်အမျိုးသမီးကို PQ ပေးခြင်း စစ်ဆေးရန်
                    </button>

                </div>
            </div>
        </div>
        <!--first column-->
        <div class="col-md-6">
            <div style="border: 1px solid #E7E7E7;text-align: center;">
                <!-- {{-- <span class="label-primary pull-left" style="padding: 5px; margin: 5px;">BHS and VHV</span> --}} -->
                <div style="margin: 5px;">

                    <button type="button" class="btn btn-block btn-default"  onClick="show_check_patient_screening_date()" 
					style="padding: 15px; white-space: normal;">
                    Check patients blank screening date<br>
                    လူနာသွေးဖောက်ရက်စွဲမပါသည့်လူနာများအား စစ်ဆေးခြင်း
                    </button>

                    <button type="button" class="btn btn-block btn-default"  onClick="show_check_patient_age_blank()" 
					style="padding: 15px; white-space: normal;">
                    Check patients age blank<br>
                    လူနာအသက်မထည့်သွင်းသည့်စာရင်းများအား စစ်ဆေးခြင်း
                    </button>

                    <button type="button" class="btn btn-block btn-default" onClick="show_check_not_exam_and_text_missing()"  
					style="padding: 15px; white-space: normal;">
                    Check not exam and test missing<br>
                    ငှက်ဖျား စစ်ဆေး/အဖြေ မထည့်ထားခြင်းစစ်ဆေးရန်
                    </button>
                    <button type="button" class="btn btn-block btn-default" onClick="show_find_duplicate_cases()" 
					style="padding: 15px; white-space: normal;">
                    Find Duplicate Cases<br>
                    လူနာစာရင်းထပ်ထည့်မိ့ခြင်းများရှာဖွေရန်
                    </button>

                    <!-- {{-- <button type="button" class="btn btn-block btn-default" onClick="show_check_no_malaria_treatment_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check no malaria and treatment given<br>
                    ငှက်ဖျားပိုးမတွေ့ဘဲ ဆေးပေးထားခြင်း စစ်ဆေးရန်
                    </button>
                    <button type="button" class="btn btn-block btn-default" onClick="show_check_pf_or_mix_and_act_not_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check Pf or Mix (+) and ACT not given or CQ given<br>
                    Pf သို့မဟုတ် Mix တွေ့ပြီး ACT မပေးခြင်း(သို့) CQ ပေးခြင်း စစ်ဆေးရန်
                    </button>
                    <button type="button" class="btn btn-block btn-default"  onClick="show_check_pv_and_cq_not_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check Pv + and CQ not given<br>
                    Pv တွေ့ပြီး CQ မပေးခြင်း စစ်ဆေးရန်
                    </button>
                    <button type="button" class="btn btn-block btn-default"  onClick="show_check_persons_with_pregnant_and_pq_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check a person with pregnant and PQ given<br>
                    ကိုယ်ဝန်ဆောင်အမျိုးသမီးကို PQ ပေးခြင်း စစ်ဆေးရန်
                    </button> --}} -->

                    <button type="button" class="btn btn-block btn-default" onClick="show_check_under_age_1_year_and_pq_given()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check under age 1 year and PQ given<br>
                    (၁)နှစ်အောက်ကလေးကို PQ ပေးခြင်း စစ်ဆေးရန်
                    </button>

                    <button type="button" class="btn btn-block btn-default" onClick="show_health_facilities_reported_and_forms_returned()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Health facilities reported and forms returned<br>
                    ပုံစံပို့သော ကျန်းမာရေးဌာနနှင့် ပုံစံအရေအတွက် စစ်ဆေးရန်
                    </button>

                    {{-- Remove at DEC
                    <button type="button" class="btn btn-block btn-default" onClick="show_check_form_number_for_each_health_facility()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Check form number of each health facility<br>
                    ကျန်းမာရေးဌာနတစ်ခုချင်းအလိုက် ပုံစံအမှတ်စစ်ဆေးရန်
                    </button> --}}

                    <button type="button" class="btn btn-block btn-default" onClick="show_number_of_records_in_each_paper_form()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Number of records in each paper form<br>
                    ပုံစံတစ်ခုတွင်ရှိသော သွေးဖောက်လူနာအရေအတွက် စစ်ဆေးရန်
                    </button>

                    {{-- Remove at DEC
                    <button type="button" class="btn btn-block btn-default"  onClick="show_number_of_months_reporting_delayed()"
					style="padding-top:15px;padding-bottom:15px; white-space: normal;">
                    Number of months reporting delayed<br>
                    ပုံစံရှိလနှင့် ပေးပို့သောလအရေအတွက် ခြားနားချက်စစ်ဆေးရန်
                    </button> --}}
                    
					<button type="button" class="btn btn-block btn-default" onClick="show_validate_10percent_of_data_entered_for_a_month()" 
					style="padding-top:15px;padding-bottom:15px; white-space: normal; margin-top: 5px;">
					Validate 10% of data entered for a month<br>
					ထည့်သွင်းပြီးသည့်ပုံစံထဲမှ (၁၀%) ကိုတိုက်ဆိုင်စစ်ဆေးရန်
					</button>
                </div>
            </div>
        </div>
        <!--second column-->
        <!--third column-->
     
        <div class="col-md-12">            
			<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            ပုံစံတစ်မျိုးစီကို အဆင့်တစ်ခုချင်း အစအဆုံးစစ်ဆေးပေးရမည်။ ၁၀% စစ်ဆေးတဲ့ဖိုင်ကို ကွန်ပျူတာတွင် သိမ်းဆည်းပါ။ Google Drive မှတဆင့် ပို့ရန်မလိုပါ။ ပုံစံတစ်ခုချင်းရှိ သွေးဖောက်လူနာအရေအတွက်ကို စစ်ပါ။
            </div>

        </div>
        <!--footer text-->
    </div>
</div>
