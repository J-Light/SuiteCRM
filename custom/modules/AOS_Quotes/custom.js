$(document).ready(function(){
	alert('test')
    var grandTotalRow = document.getElementById("LBL_LINE_ITEMS").rows[6];
    grandTotalRow.deleteCell(2);
    grandTotalRow.deleteCell(2);
})
