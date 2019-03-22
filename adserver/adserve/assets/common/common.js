/*  $(document).ready(function () {
		//Data Table
		console.log('#example2');
        $('#example2').dataTable({
			
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
		
		// Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
		CKEDITOR.replace('editor2');
		CKEDITOR.replace('editor3');
		CKEDITOR.replace('editor4');
		CKEDITOR.replace('editor5');
		CKEDITOR.allowedContent = true;
      }); */
	  

/*slots in classes jqueries*/
function addslot()
{
	//alert('1');
	cloneItemRow();
}
 // Clones a new item row
    function cloneItemRow() {
        var row = $('#new-item').clone().appendTo('#item-table');
		row.removeAttr('id').addClass('item').show();
        row.find('input[name="item_name"]').addClass('item-lookup').typeahead(null, settings);
        typeaheadTrigger();
        iCheck();           
    }
 // Add a new item row if no items currently exist
   /*  if (!itemCount) {
        cloneItemRow();
    } */

function deleteSlot(cid,id)
{
//Defining $http service for deleting a list 
		 var r=confirm("Do you want to delete this time slot?")
   		 if (r==true)
		 {
			 window.location = siteurl+uname+"/classes/"+cid+"/deleteslot/"+id;
		 }
		 else
		 return false;
}