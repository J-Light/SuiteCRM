$(document).ready(function(){
    var taxTotalRow = document.getElementById("LBL_LINE_ITEMS").rows[6];
    taxTotalRow.deleteCell(2);
    taxTotalRow.deleteCell(2);
});