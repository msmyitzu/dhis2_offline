(function(){

    const BASE_URL = "http://" + window.location.host + "/";

    const CSRF = document.querySelector('meta[name="_token"]').content;

    handleUpdateStatus() ;

    if(window.navigator.onLine){
        setInterval(() => get_update_hfm(), 15000);
    }else{
        clearInterval();
        console.log("Offline");
    }

    var get_update_hfm = function(){
        var xmlHttp = new XMLHttpRequest() ;
        xmlHttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                if (xmlHttp.responseText == "99") {
                    localStorage.setItem("updateHfm", '0');
                    // document.querySelector('#span-syncd').style.display = 'none' ;
                    handleUpdateStatus() ;
                } else if(xmlHttp.responseText == "11"){
                    localStorage.setItem("updateHfm", '1');
                    // document.querySelector('#span-syncd').style.display = 'block' ;
                    handleUpdateStatus();
                }else{
                    console.log(xmlHttp.responseText);
                }
            }
        }
        xmlHttp.open("GET", BASE_URL + 'check_server_hfm');
       
        xmlHttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlHttp.setRequestHeader('X-CSRF-TOKEN', CSRF);
        xmlHttp.send();
    }
})();

function handleUpdateStatus() {
    document.querySelector('#span-syncd').style.display = localStorage.getItem('updateHfm') == '1' ? 'block' : 'none';
}
