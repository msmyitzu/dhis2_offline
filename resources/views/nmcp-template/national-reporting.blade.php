<div class="" id="">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="double-row col-md-8">
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="text-align: right;">Start Date</label>
                        <div class="col-md-4 input-group date" data-provide="datepicker">
                            <input type="text" class="form-control">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="text-align: right;">End Date</label>
                        <div class="col-md-4 input-group date" data-provide="datepicker">
                            <input type="text" class="form-control">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th"></i>
                            </span>
                        </div>
                    </div>
                    <div class="first-row col-md-6">
                        <button type="button" class="btn btn-block btn-default">
                            Summary of Examined Casec - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Summary of Confirmed Cases - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Export DHIS2 Data - National
                        </button>
                        <button class="btn btn-block btn-default">
                            PUDR Form B - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Export PUDR Annex E - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Check Malaria Death Individual
                        </button>
                    </div>
                    <div class="sec-row col-md-6">
                        <button type="button" class="btn btn-block btn-default">
                            Age Group BSE Result - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Age Group RDT Result - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Malaria Mortality and Morbidity - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Antenatal MMM - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Under 5 MMM - National
                        </button>
                        <button class="btn btn-block btn-default">
                            Species-wise Examination Result - National
                        </button>
                    </div>
                </div>
                <div class="third-row col-md-4">
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="text-align: right;padding-right: 5px; padding-left:0;">State and Region</label>
                        <select name="" id="" class="col-md-6 select2" style="width: 65%" onchange="load_lp_township('select_lp_township_de', this.value, '<?=csrf_token();?>')">
                        <option value="">Click to Choose</option>
                        @foreach ($lp_state_region as $sr)
                            <option value="{{ $sr->sr_code}}">
                                {{ $sr->sr_name}} | {{ $sr->sr_name_mmr}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <button class="btn btn-block btn-default">
                        Find Cases Duplicated
                    </button>
                    <button class="btn btn-block btn-default">
                        Delete / Edit Cases Duplicated
                    </button>
                    <button class="btn btn-block btn-default">
                        Export Dashboard Data
                    </button>
                    <div class="form-group" style="padding-top: 20px;">
                        <label class="col-md-4 control-label" style="text-align: right;padding-right:5px; padding-left:0;">Township</label>
                        <select name="" id="" class="col-md-6 select2 select_lp_township_de" style="width: 65%">
                        <option value="">Click to Choose</option>
                        </select>
                    </div>
                    <button class="btn btn-block btn-danger">
                        Delete Township Data - Period
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
