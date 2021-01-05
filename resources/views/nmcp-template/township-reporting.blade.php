<div class="tab-pane" id="township_reporting">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
			<form class="form-horizontal text-center" method="post" action="" id="rpt_form" target="_blank">
			{{ csrf_field() }}
                <!-- first coloum -->
                <div class="col-md-6">
                    <!--h6 class="text-center">ဤနေရာတွင်ငှက်ဖျားရောဂါစာရင်းချုပ်ကိုကာလပိုင်းခြားလိုက်ကြည့်ရှု့နိုင်ပါသည်။ စာရင်းစတင်သည့်ရက်နှင့်ပြီးဆုံးသည့်ရက်ကိုရွှေးချယ်ပါ။</h6-->
                    <div class="callout callout-info">
						<p>
							ဤနေရာတွင်ငှက်ဖျားရောဂါစာရင်းချုပ်ကိုကာလပိုင်းခြားလိုက်ကြည့်ရှု့နိုင်ပါသည်။ စာရင်းစတင်သည့်ရက်နှင့်ပြီးဆုံးသည့်ရက်ကိုရွှေးချယ်ပါ။
						</p>
					</div>
					<div class="box-body">
                        <div class="form-group">
                            <label class="col-md-5 control-lable">တိုင်းနှင့်ပြည်နယ်</label>
                            <div class="col-md-6">
                                <select class="form-control select2" style="width: 100%;" name="rpt_lp_stateregion" 
								id="rpt_lp_stateregion"
								<?php 
									if(session("role_id") != "3"){
								?>
									onChange="load_lp_township('select_lp_township_hf', this.value, '<?=csrf_token();?>','')" 
								<?php
									}
								?>
								>
                                    <option value="" selected="selected">ရွှေးပါ</option>
                                    @foreach ($lp_state_region as $sr)
                                        <option value="{{ $sr->sr_code}}" <?php echo session('role_id') == '3' ? 'selected' : '' ?>>
                                            {{ $sr->sr_name}} | {{ $sr->sr_name_mmr}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-lable">မြို့နယ်</label>
                            <div class="col-md-6">
                                <!--select name="rpt_lp_township" id="rpt_lp_township" style="width: 100%"
								class="form-control select2 select_lp_township_hf">
                                </select-->
								<?php
									if(session("role_id") == "3"){
								?>
									<select name="rpt_lp_township" id="rpt_lp_township"  required                                
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
									<select name="rpt_lp_township" id="rpt_lp_township"  required
                                    class="form-control select2 select_lp_township_hf" style="width: 100%;">
                                        <option value="0">ရွေးရန်</option>
									</select>
								<?php
									}
								?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">စတင်သည့်ရက်</label>
                            <div class="col-md-6 date">
                                <input type="text" class="form-control rpt_datepicker text-center" id="rpt_sdate" autocomplete=off name='rpt_sdate' placeholder="စတင်သည့်ရက်" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">ပြီးဆုံးသည့်ရက်</label>
                            <div class="col-md-6 date">
                                <input type="text" class="form-control rpt_datepicker text-center" id="rpt_edate" autocomplete=off name='rpt_edate' placeholder="ပြီးဆုံးသည့်ရက်" readonly>
                            </div>
                        </div>

                        <div class="form-group">
							<label class="col-md-5 control-lable">စာရင်းချုပ်အမျိုးအစား</label>
							<div class="col-md-6">
								<select id='rpt_type' name="rpt_type" class="select2 form-control col-md-8" style="width: 100%;" onchange="load_reportpage(this.value, '<?= csrf_token() ?>')">
									<option selected="selected" value="default">စာရင်းချုပ်အမျိုးအစားရွှေးပါ</option>
									<option value="reportby_sc">ကျန်းမာရေးဌာနခွဲအလိုက် အစီရင်ခံစာ</option>
									<option value="reportby_rhc">ကျန်းမာရေးဌာနအလိုက် အစီရင်ခံစာ</option>

                                    <?php if(session("role_id") == "1" || session("role_id") == "2"){ ?>
									    <!-- <option value="reportby_township">မြို့နယ်အလိုက် အစီရင်ခံစာ</option> -->
                                    <?php } ?>

								</select>
							</div>
						</div>
                    </div>

                    <div style='border:1px solid green; padding:5px'>
                        <button type="button" class="btn btn-block btn-default" onClick="show_summary_by_ag_form_type()">
                            Summary by Age Group From Type<br>
                            ပုံစံအမျိုးအစားနှင့် အသက်အုပ်စုစာရင်းချုပ်
                        </button>
                        <button type="button" class="btn btn-block btn-default" onClick="show_hf_reported_by_period()">
                            HF Reported by Period<br>
                            ကျန်းမာရေးဌာနအလိုက် သတင်းပေးပို့ခြင်း
                        </button>
                    </div>

                    {{-- <div style='border:1px solid lightblue; padding: 5px; margin-bottom:10px'>
                        <button type="button" class="btn btn-block btn-default" onClick="show_ts_summary_by_period()" disabled>
                            Township Summary by Period<br>
                            မြို့နယ်ကာလပိုင်းခြားစာရင်းချုပ်
                        </button>
                        <button type="button" class="btn btn-block btn-default" onClick="show_summary_report_sc()" disabled>
							Summary Report - SC<br>
							ကျန်းမာရေးဌာနခွဲအလိုက် လစဥ်စာရင်းအချုပ်
						</button>
						<button type="button" class="btn btn-block btn-default" onClick="show_summary_report_rhc()" disabled>
							Summary Report - RHC<br>
							ကျန်းမာရေးဌာနအလိုက် လစဥ်စာရင်းအချုပ်
                        </button>
                        <button type="button" class="btn btn-block btn-default" onClick="show_list_of_hf_no_reports()" disabled>
                            List of HF, No Reports<br>
                            ပုံစံပေးပို့ခြင်းမရှိသော ကျန်းမာရေးဌာနများ
                        </button>
					</div> --}}
                </div>
                <!-- first coloum -->

				<div class="col-md-6">
					<div style="">
						<div class="callout callout-warning">
							<p>
								ဤနေရာသည် မြို့နယ်များ၏ လစဥ်အချက်အလက်များ/ပုံစံများကို ထုတ်ယူရန်နေရာဖြစ်သည်။
							</p>
						</div>
						<!-- <div class="form-group">
							<label class="col-md-5 control-label" align="right">ရက်စွဲ (လ/ခုနှစ်)</label>
							<div class="col-md-6 input-group date" style="padding-right: 0px; padding-left: 0px">
								<input type="text" class="form-control col-md-8" id="rpt-form-date" name="rpt-form-date" 
								autocomplete=off readonly="true" required>
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-th"></i>
								</span>
							</div>
						</div>
						<div class="form-group">
                            <label class="col-md-5 control-lable">စာရင်းချုပ်အမျိုးအစား</label>
                            <div class="col-md-6" style="padding-right:0; padding-left: 0;">
                                <select class="select2 form-control col-md-8" style="width: 100%;" onchange="load_reportpage(this.value, '<?= csrf_token() ?>')">
                                    <option selected="selected" value="default">စာရင်းချုပ်အမျိုးအစားရွှေးပါ</option>
                                    <option value="reportby_sc">ကျန်းမာရေးဌာနခွဲအလိုက် အစီရင်ခံစာ</option>
                                    <option value="reportby_rhc">ကျန်းမာရေးဌာနအလိုက် အစီရင်ခံစာ</option>
                                    <option value="reportby_township">မြို့နယ်အလိုက် အစီရင်ခံစာ</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <button type="button" class="btn btn-block btn-default" onClick="show_summary_report_sc()">
                                ကျန်းမာရေးဌာနခွဲအလိုက် လစဥ်စာရင်းအချုပ်
                            </button>
                            <button type="button" class="btn btn-block btn-default" onClick="show_summary_report_rhc()">
                                ကျန်းမာရေးဌာနအလိုက် လစဥ်စာရင်းအချုပ်
                            </button>
                        </div> -->
                    </div>
				</div>
                <!-- second coloum -->
                <div class="col-md-6" id="report_sc_page" style='padding-top: 20px;display:none;'>
                    <div style="border: 1px solid goldenrod;">
                        <div style="padding: 5px; color: dodgerblue;">
                            <h6 id="report_title_id">ကျန်းမာရေးဌာနခွဲအလိုက် လစဥ်အစီရင်ခံစာ -</h6>
                        </div>
                        <div style="padding: 5px;">
							<button type="button" class="btn btn-block btn-default" onClick="show_age_group_bse_result_sc()">
								Age Group BSE Result - SC<br>
								အသက်အုပ်စုအလိုက် မှန်ဘီလူးစစ်ဆေးစာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_age_group_rdt_result_sc()">
								Age Group RDT Result - SC<br>
								အသက်အုပ်စုအလိုက် RDT ဖြင့်စစ်ဆေးသောစာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_malaria_mortality_and_morbidity_sc()">
								Malaria Mortality and Morbidity - SC<br>
								ငှက်ဖျား ဖြစ်/သေ စာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_antenatal_mmm_sc()">
								Antenatal MMM - SC<br>
								ကိုယ်ဝန်ဆောင် ငှက်ဖျား ဖြစ်/သေ စာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_under5_mmm_sc()">
								Under 5 MMM - SC<br>
								(၅)နှစ်အောက် ငှက်ဖျား ဖြစ်/သေ စာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default"  onClick="show_species_wise_examination_result_sc()">
								Species-wise Examination Result - SC<br>
								ငှက်ဖျားပိုးအမျိုးအစား အလိုက်စစ်ဆေးသော စာရင်း
							</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="report_rhc_page" style='padding-top: 20px;display:none;'>
                    <div style="border: 1px solid goldenrod;">
                        <div style="padding: 5px; color: dodgerblue;">
                            <h6 id="report_title_id">ကျန်းမာရေးဌာနအလိုက် လစဥ်အစီရင်ခံစာ -</h6>
                        </div>
                        <div style="padding: 5px;">
							<button type="button" class="btn btn-block btn-default" onClick="show_age_group_bse_result_sc()">
								Age Group BSE Result - RHC<br>
								အသက်အုပ်စုအလိုက် မှန်ဘီလူးစစ်ဆေးစာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_age_group_rdt_result_sc()">
								Age Group RDT Result - RHC<br>
								အသက်အုပ်စုအလိုက် RDT ဖြင့်စစ်ဆေးသောစာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_malaria_mortality_and_morbidity_sc()">
								Malaria Mortality and Morbidity - RHC<br>
								ငှက်ဖျား ဖြစ်/သေ စာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_antenatal_mmm_sc()">
								Antenatal MMM - RHC<br>
								ကိုယ်ဝန်ဆောင် ငှက်ဖျား ဖြစ်/သေ စာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default" onClick="show_under5_mmm_sc()">
								Under 5 MMM - RHC<br>
								(၅)နှစ်အောက် ငှက်ဖျား ဖြစ်/သေ စာရင်း
							</button>
							<button type="button" class="btn btn-block btn-default"  onClick="show_species_wise_examination_result_sc()">
								Species-wise Examination Result - RHC<br>
								ငှက်ဖျားပိုးအမျိုးအစား အလိုက်စစ်ဆေးသော စာရင်း
							</button>
                        </div>
                    </div>
                </div>
                <!-- second coloum -->
                <!-- third coloum -->
                <div class="col-md-6" id="report_by_township" style='padding-top: 20px;display:none;'>
                    <div style="border: 1px solid dodgerblue;">
                        <div style="padding: 5px; color: dodgerblue;">
                            <h6>မြို့နယ်အလိုက် လစဥ်အစီရင်ခံစာ -</h6>
                        </div>
                        <div style="padding: 5px;">

                            <button type="button" class="btn btn-block btn-default" onClick="show_townships_reported_by_period()">
                            Townships Reported by Period
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="show_summary_examined_report_period()">
                            Summary Examined Report - Period (To be removed)
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="show_summary_case_report_period()">
                            Summary Case Report - Period (To be removed)
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="show_summary_report_period_sr()">
                            Summary Report Period - SR (Combined view of above two tabs)
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="show_summary_report_of_hf_sr()">
                            Summary Report of HF - SR
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="show_township_hf_reported_percent()">
                            Township HF Reported Percent
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="show_generate_pudr_form_b()">
                            Generate PUDR Form B
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="show_generate_pudr_annex_e()">
                            Generate PUDR Annex E
                            </button>

                            <!--button type="button" class="btn btn-block btn-default">
                            Generate DHIS2 Import File
                            </button-->

                            <button type="button" class="btn btn-block btn-default" onClick="show_data_in_text_sr()">
                            Data in Text - SR
                            <br>
                            အချက်အလက်များကို စာသားပုံစံဖြင့်ကြည့်ရှုရန်
                            </button>

                            <button type="button" class="btn btn-block btn-default" onClick="download_data_in_text_sr()">
                            Download Dataset - SR                            
                            </button>

                            <!--button type="button" class="btn btn-block btn-default">
                            Synchronize Data
                            </button>

                            <button type="button" class="btn btn-block btn-danger">
                            Malaria Death
                            </button-->
                        </div>
                    </div>
                </div>
			</form>
            </div>
        </div>
    </div>
</div>
<style>
	.control-lable{
		text-align: right;
	}
</style>
<script> 
</script>
