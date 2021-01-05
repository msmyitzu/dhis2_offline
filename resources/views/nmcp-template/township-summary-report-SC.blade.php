<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Township Summary Report by Sub Center</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{asset ('bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"-->
    <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Theme style -->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .header{
            background: #acc;
            padding: 10px;
            margin: 10px;
            font-weight: bold;
        }

        .label-group{
            padding: 5px;
            margin: 10px;
        }
        .custom-th > tr > th{
            text-align: center;
            /* background: #555; */
            /* color: #aaa; */
        }

        .page-num{
            text-align: end;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="header text-center">
                <h4>မြို့နယ်တွင်းရှိ ကျန်းမာရေးဌာနခွဲ/စေတနာ့ဝန်ထမ်းအလိုက်ငှက်ဖျားရောဂါစာရင်းချုပ်</h4>
            </div>
            <div class="label-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-md-6">ပြည်နယ်/တိုင်းဒေသကြီး</label>
                        <input type="text" class="col-md-6">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-md-3">မြို့နယ်</label>
                        <input type="text" class="col-md-8">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-md-3">ခုနှစ်</label>
                        <input type="text" class="col-md-8">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-md-3">လ</label>
                        <input type="text" class="col-md-8">
                    </div>
                </div>
            </div>
            <table class="table table-responsive">
                <thead class="custom-th">
                    <tr>
                        <th>ကျန်းမာရေးဌာန</th>
                        <th>ကျန်းမာရေးဌာနခွဲ/စေတနာ့ဝန်ထမ်း</th>
                        <th>စစ်ဆေးသူပေါင်း</th>
                        <th>ပိုးတွေ့</th>
                        <th>PF</th>
                        <th>PV</th>
                        <th>MIX</th>
                        <th>အခြားပိုး</th>
                        <th>ငှက်ဖျားသေဆုံး</th>
                    </tr>
                </thead>
                <tbody class="custom-tb">
                    <tr>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="col-md-5 text-center" colspan="2" style="color: #000;">မြို့နယ်ငှက်ဖျားရောဂါစာရင်းချုပ်</td>
                        <td class="col-md-1"><input type="text" class="form-control"></td>
                        <td class="col-md-1"><input type="text" class="form-control"></td>
                        <td class="col-md-1"><input type="text" class="form-control"></td>
                        <td class="col-md-1"><input type="text" class="form-control"></td>
                        <td class="col-md-1"><input type="text" class="form-control"></td>
                        <td class="col-md-1"><input type="text" class="form-control"></td>
                        <td class="col-md-1"><input type="text" class="form-control"></td>
                    </tr>
                </tfoot>
            </table>
            <div class="footer">
                <div class="timestemp col-md-6">
                    <h6>timestemp place</h6>
                </div>
                <div class="page-num col-md-6">
                    <h6>Page 1 of 1</h6>
                </div>
            </div>
        </div>
    </div>
</body>
</html>