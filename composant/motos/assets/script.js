function PrintElem(elem,lg)
{
    var mywindow = window.open('', 'PRINT', 'height=800,width=800');
    var dir = (lg=='ar')?'dir="rtl"':'';
    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
	mywindow.document.write('<style>.no-imp { display:none;} .modal-title {font-size:32px;padding:25px 5px;}  ');
    mywindow.document.write('  </style> ');
    mywindow.document.write('</head><body '+dir+' >');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
/****************************/

function ajax_send(donnees,elem) {
$.ajax({
            type:'POST',
            url:'send_ajx.php?option=outils', 
            data: donnees,
			dataType: 'json',
            success:function(data){
			 
               
				 
               $("#modal-body").empty().append(data.content);
			   $("#ModalLabel").empty().append(data.title);
			   
			   console.log(data);
				 return data ;
				 
				  
				 
				 
            },
            error:function(jqXHR, exception){
             var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
            alert("Erreur : "+msg);
            }
        });

}