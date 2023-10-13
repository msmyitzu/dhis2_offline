<div class="tab-pane active" id="data_entry">
    <div class="row">
        <div class="col-md-7">
            <div class="text-center" style="border: 1px solid #E3E3E3; background-color:#FBFBFB">
                <h5>ပုံစံအချက်အလက်များကိုသေချာရွေးချယ်ပါ။</h5>
                <form class="form-horizontal" id="frm-patient-register-form" method="post" action="patient-register-form">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">ပုံစံအမျိုးအစား</label>
                            <div class="col-md-8">
                                <select class="table-control select2" name="select_lp_form_cat" id="select_lp_form_cat"
                                    style="width: 100%;" onChange="change_rhcsc_label(this.value)" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">ပုံစံအမှတ်</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control num-only" placeholder="0000"
                                    style="text-align:center;" min="1000" max="9999" maxlength="4"
                                    id="form_number" name="form_number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">ပြည်နယ်/တိုင်းဒေသကြီး</label>
                            <div class="col-md-8">
                                <select class="form-control select2" name="select_lp_state_region"
                                    id="select_lp_state_region" required <?php
                                    if(session("role_id") != "3"){
                                    //No need to load all townships since current login is tagged to only one township
                                ?>
                                    onChange="load_lp_township('select_lp_township_de', this.value, '<?= csrf_token() ?>','')"
                                    <?php
                                    }
                                ?> style="width: 100%;">
                                    <option value="0">ရွေးရန်</option>
                                    @foreach ($lp_state_region as $sr)
                                        <option value="{{ $sr->sr_code }}" <?php echo session('role_id') == '3' ? 'selected' : ''; ?>>
                                            {{ $sr->sr_name }} | {{ $sr->sr_name_mmr }}
                                        </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">မြို့နယ်</label>
                            <div class="col-md-8">
                                <?php
                                if(session("role_id") == "3"){
                            ?>
                                <select name="select_lp_township_de" id="select_lp_township_de" required
                                    onChange="load_tbl_hfm('select_tbl_hfm_de', this.value, '<?= csrf_token() ?>')"
                                    class="form-control select2 select_lp_township_de" style="width: 100%;">
                                    <option value="0">ရွေးရန်</option>
                                    @foreach ($lp_township as $ts)
                                        <option value="{{ $ts->ts_code }}" <?php echo session('role_id') == '3' ? 'selected' : ''; ?>>
                                            {{ $ts->ts_name }} | {{ $ts->ts_name_mmr }}
                                        </option>
                                    @endforeach
                                </select>
                                <?php
                                } else {
                            ?>
                                <select name="select_lp_township_de" id="select_lp_township_de" required
                                    onChange="load_tbl_hfm('select_tbl_hfm_de', this.value, '<?= csrf_token() ?>')"
                                    class="form-control select2 select_lp_township_de" style="width: 100%;">
                                    <option selected="selected">ရွေးရန်</option>
                                </select>
                                <?php
                                }
                            ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" id="rhc_label" class="col-md-4 control-label"
                                style="word-wrap: anywhere;"></label>
                            <div class="col-md-8">
                                <select name="select_tbl_hfm_de" id="select_tbl_hfm_de" required
                                    onChange="load_hfm('select_hfm_de', this.value, '<?= csrf_token() ?>')"
                                    class="form-control select2" style="width: 100%;">
                                    <option selected="selected">ရွေးပါ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" id="sc_label" class="col-md-4 control-label"
                                style="word-wrap: anywhere;"></label>
                            <div class="col-md-8">
                                <select name="select_hfm_de" id="select_hfm_de" class="form-control select2"
                                    style="width: 100%;" required>
                                    <option selected="selected">ရွေးပါ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">လ/ခုနှစ်</label>
                            <div class="col-md-8 date" style="padding-right: 15px; padding-left: 15px">
                                <input type="text" class="form-control text-center" id="form-date" name="form-date"
                                    autocomplete=off placeholder="လ / ခုနှစ်" readonly>
                            </div>
                        </div>


                    </div>
                    <div class="box-footer">
                        <div class="col-md-6">
                            <!--a href="javascript" class="btn btn-block btn-default" style="padding: 25px;">Goto Form<br>
                                ပုံစံသို့သွားရန်</a-->
                            <button type="button" class="btn btn-block btn-default" style="padding: 25px;"
                                id="btn_submit_data_entry_form"
                                onclick="submit_data_entry_form('<?= session('role_id') ?>');">
                                Goto Form<br>
                                ပုံစံသို့သွားရန်
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-default" style="padding: 25px;"
                                onclick="clear_data_entry();">
                                Refresh<br>ပြန်ရှင်းရန်
                            </button>
                        </div>
                        <!-- <div class="col-md-4">
                                <button type="button" class="btn btn-block btn-default" style="padding: 25px;"
                                onclick="delete_data_entry_form()">
         Delete Form<br>ပုံစံဖျက်ရန်
        </button>
                            </div> -->
                    </div>
                    <input type="hidden" id="cf_code" name="cf_code" />
                    <input type="hidden" id="cf_link_code" name="cf_link_code" />
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="callout callout-info" style="text-align:center;">
                <h4>နောက်ဆုံး ဖြည့်သွင်းခဲ့သော အချက်အလက်</h4>

                <p id="last_corefacility_container">
                    <img src="img/default-loading.gif" style="width:20px;" />
                </p>
            </div>
        </div>
        <div class="col-md-12" style="text-align: center; margin-top: 10px;">
            <p style="font-size: 12px">
                ဤနေရာတွင် အချက်အလက်များထည့်သွင်းရန် ပုံစံတစ်ခုချင်းစီကို စစ်ဆေးပါ။ ပြီးလျှင် ညွှန်ကြားထားသည့်အတိုင်း
                ပုံစံအမှတ်တပ်ပေးပါ။ အပေါ်တွင် ရွေးချယ်ရမည့်နေရာများတွင် ပုံစံနှင့်သေချာတိုက်ဆိုင်စစ်ဆေးပြီး
                ရွေးချယ်ထည့်သွင်းပါ။ အကယ်၍ တစ်ခုခုမှားယွင်းရွေးချယ်ခဲ့လျှင်
                ပုံစံတစ်ခုလုံးပြန်ဖျက်ရမည်ဖြစ်ပြီး အစမှပြန်သွင်းရမည်ဖြစ်ပါသည်။ အထူးသဖြင့် - ပုံစံအမျိုးအစား၊ ပုံစံအမှတ်၊
                ကျန်းမာရေးဌာနခွဲ/စေတနာ့ဝန်ထမ်းကျေးရွာ၊ ပုံစံရှိလနှင့် ခုနှစ်တို့ကိုသေချာရွေးချယ်ပါ။
                ရွေးချယ်ထားသည့်အချက်အလက်များကို
                ပြန်ရှင်းချင်လျှင် “Refresh/ပြန်ရှင်းရန်” ကိုနှိပ်လိုက်ပါ။ အကွက်ထဲတွင်
                ရွေးချယ်ထားသောအချက်အလက်များရှင်းသွားပါမည်။ မှားထည့်မိသည့်ပုံစံကိုဖျက်လျှင်လည်း အချက်အလက်များကို
                သေချာရွေးချယ်ပါ။
            </p>
        </div>
        <!-- /.box-header with-border -->
    </div>
    <!-- /.row-->
</div>


