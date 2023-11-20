{{-- @extends('parent-register-template/uploadForm') --}}

@section('form_table_section')
<table id="table_grab_section_corefacility" style="width:100%" class="table table-bordered nowrap">
    <thead>
        <tr>
            <!--th>No</th-->
            <th align="right">CF_Code</th>
            <th align="left">Form_name</th>
            <th align="right">Form_No</th>
            <th align="right">Form_Date</th>
            <th align="left">SC_Name_MM</th>
            <th align="left">RHC Name MM</th>
            <th align="left">TS_Name_MM</th>
            <th align="left">SR_Name_MM</th>
            <th align="left">DE_DateTime</th>
            <th align="left"></th>
            <!--th>Status</th-->
        </tr>
    </thead>
    <tbody id="grab_all_corefacility_container">
        @foreach($grab_all_corefacility as $key => $cf)
            <tr title="လူနာအချက်အလက်များကြည့်ရန် နှိပ်ပါ" id="tr_{{ $cf->cf_link_code }}"
            onClick="load_tbl_individual_case('{{ $cf->cf_link_code }}', this)">
                <td align="right" cf_code="{{ $cf->CF_Code }}">
                    {{ $cf->CF_Code }}
                </td>
                <td align="left">{{ $cf->form_name }}</td>
                <td align="right">{{ $cf->Form_No }}</td>
                <td align="right">{{ $cf->PMonth }} / {{ $cf->PYear }}</td>
                <td align="left" class="sc_name">{{ $cf->SC_Name_MM }}</td>
                <td align="left" class="sc_name">{{ $cf->hf_name_mm }}</td>
                <td align="left">{{ $cf->ts_name_mmr }}</td>
                <td align="left">{{ $cf->sr_name_mmr }}</td>
                <td align="left">{{ \Carbon\Carbon::parse($cf->DE_DateTime)->diffForHumans() }}</td>
                <td>
                <?php
                    if(session("role_id") != "3"){
                ?>
                <form id="form_{{ $cf->cf_link_code }}" method="POST">
                    <div class="btn-group" style="width:max-content">
                        <button title="ဖောင်သို့သွားရန်" type="button" class="btn btn-info btn-xs"
                            onClick = "goto_form('{{ $cf->cf_link_code }}')"><i class="fa fa-edit"></i>
                        </button>
                        <button title="ဖောင်ဖျက်ရန်" type="button" class="btn btn-danger btn-xs" cf_link_code="{{ $cf->cf_link_code }}"
                            onClick="delete_tbl_core_facility({{ $cf->cf_link_code }},'{{ $cf->SC_Name_MM }}',this)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </form>
                </td>
                <?php } else { ?>
                    <div class="btn-group" style="width:max-content">
                        <button title="ဖောင်သို့သွားရန်" type="button" class="btn btn-info btn-xs"
                            onClick="goto_form({{ $cf->cf_link_code }})">
                            <i class="fa fa-edit"></i>
                        </button>
                    </div>
                <?php } ?>
                <!--td>
                    <?php
                        switch($cf->sync){
                            case "0": echo "<span class='sync_offline'>offline</span>"; break;
                            case "1": echo "<span class='sync_online'>online</span>"; break;
                        }
                    ?>
                </td-->
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
