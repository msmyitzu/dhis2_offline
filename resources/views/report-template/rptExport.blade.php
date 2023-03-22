<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.1/xlsx.full.min.js"></script> --}}
	{{-- <script src="https://fastcdn.org/FileSaver.js/1.1.20151003/FileSaver.min.js"></script> --}}
	<script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
	<script src="{{asset('js/xlsx.core.min.js')}}"></script>
	<script src="{{asset('js/FileSaver.js')}}"></script>
	<script src="{{asset('js/bootbox.all.min.js')}}"></script>
</head>
<body>
	<?php //echo json_encode($data); return false; ?>
	<script>
        try{
            var data = '<?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>';
		    var fileName = '{{ $header_text }}';
            data = data.replace(/\'/g,"");
            data = data.replace(/\\n/g, "\\n")
                        .replace(/\\'/g, "\\'")
                        .replace(/\\"/g, '\\"')
                        .replace(/\\&/g, "\\&")
                        .replace(/\\r/g, "\\r")
                        .replace(/\\t/g, "\\t")
                        .replace(/\\b/g, "\\b")
                        .replace("N\/A", "")
                        .replace("\r\n", "")
                        .replace(/\\/g, " ")
                        .replace(/\\f/g, "\\f");
            // document.write(data);
            //console.log(data);
		    data = JSON.parse(data);
		    var keys = Object.keys(data);
			
		    var wb = XLSX.utils.book_new();
			var wbout;
		    keys.forEach(function(element){
			    wb.SheetNames.push(element);        
			    var ws = XLSX.utils.json_to_sheet(data[element]);
			    wb.Sheets[element] = ws;
			    wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
		    });

		    saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), fileName+".xlsx");
        }
        catch(ex){
            bootbox.alert("Too many data for Excel or invalid data. This may caused by invalid characters in data. Such as comma(,) or collon" + ex);
            //window.close();
        }
		
		
		function s2ab(s) {  
			var buf = new ArrayBuffer(s.length);
			var view = new Uint8Array(buf);
			for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
			return buf;                
		}
	</script>

	
</body>
</html>
