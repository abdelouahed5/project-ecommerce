var qtyInput=document.getElementById("qty");
var btnPlus=document.querySelector(".counter-plus");
var btnMoin=document.querySelector(".counter-moin");
btnPlus.addEventListener("click",function(e){
    var qtyValue=parseInt(qtyInput.value);
    var qtyFinal=parseInt(qtyValue+1);
    if(qtyFinal>= 99){
        qtyFinal=99;
    }
    qtyInput.value=qtyFinal;
});
btnMoin.addEventListener('click',(e)=>{
    var qtyValue=parseInt(qtyInput.value);
    var qtyFianle=parseInt(qtyValue-1);
    if(qtyFianle<0){
        qtyFianle=0
    }
    qtyInput.value=qtyFianle;
});