<div class="tab-pane" id="health_facility_tab">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal text-center">
                <div class="box-body">
                    <div class="form-group">
                        <label for="" class="col-md-4 control-label">တိုင်းနှင့်ပြည်နယ်</label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="select_lp_state_region"                                  
                                
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
                                    <option value="{{ $sr->sr_code }}">
                                    {{ $sr->sr_name }} | {{ $sr->sr_name_mmr }}
                                    </option>
                                @endforeach
                            </select>

                            <!--select class="form-control select2" onChange="load_lp_township('select_lp_township_hf', this.value, '<?= csrf_token() ?>','')">
                                <option selected="selected">ရွေးပါ</option>
                                @foreach ($lp_state_region as $sr)
                                    <option value="{{ $sr->sr_code}}">
                                        {{ $sr->sr_name}} | {{ $sr->sr_name_mmr}}
                                    </option>
                                @endforeach
                            </select-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-4 control-label">မြို့နယ်</label>
                        <div class="col-md-8">
                            <?php
                                if(session("role_id") === "3"){
                            ?>
                                <select id="select_lp_township_hf" class="form-control select2 select_lp_township_hf" 
                                onChange="load_lp_hftype('<?= csrf_token() ?>')" style="width: 100%;">
                                    <option value="0">ရွေးရန်</option>
                                    
                                    @foreach($lp_township as $ts)
                                        <option value="{{ $ts->ts_code }}">
                                        {{ $ts->ts_name }} | {{ $ts->ts_name_mmr }}
                                        </option>
                                    @endforeach
                                </select>
                            <?php
                                } else {
                            ?>
                                <select id="select_lp_township_hf" class="form-control select2 select_lp_township_hf" 
                                onChange="load_lp_hftype('<?= csrf_token() ?>')">
                                </select>
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-4 control-label">ဌာနအမျိုးအစား</label>
                        <div class="col-md-8">
                            <select id="select_lp_hftype" class="form-control select2" onchange="load_healthfacility('health_facility_table_body')">
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="info-box bg-aqua" style="height: 100%;">
                <span class="info-box-icon"><i class="fa  fa-exclamation"></i></span>
                <div class="info-box-content text-center">
                    ဤကျန်းမာရေးဌာနစာရင်းကို <code>&lt;date-section&gt;</code> နေ့နောက်ဆုံးပြင်ဆင်ထားသော စာရင်းများထည့်သွင်းထားပါသည်။<br>
                    ဤနေရာတွင် မပါ၀င်သော ကျန်းမာရေးဌာနစာရင်းများ ရှိပါက ဗဟိုနှင့်တိုင်း/ပြည်နယ်တာဝန်ခံများကို ဆက်သွယ်အကြောင်းကြားပါ။
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="health_facility_table_container">
                <table id="health_facility_table" class="table table-bordered table-striped dataTable no-footer text-center" style="margin-top: 20px;">
                    <thead id='health_facility_table_head'>
                        <tr>
                            <th colspan="2" width="300">ကျန်းမာရေးဌာနအမည်</th>
                            <th>ပင်မကျန်းမာရေးဌာန</th>
                            <th>အဖွဲ့အစည်း</th>
                            <th>ဆက်သွယ်ရန်</th>
                        </tr>
                    </thead>
                    <tbody id="health_facility_table_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
