$("document").ready(function(){
   flag = document.getElementById("flag")
    /*if (flag){
        $.notify({
            title:"Information",
            mesaage:""
        })
    }*/

    setTimeout(function(){
        $(flag ).remove();
    }, 5000 ); // 5 secs

});