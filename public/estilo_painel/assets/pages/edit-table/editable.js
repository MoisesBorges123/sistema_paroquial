  'use strict';
 $(document).ready(function() {  
     

$('#example-1').Tabledit({

    editButton: false,
    deleteButton: false,
    hideIdentifier: true,
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'Ano'], [2, 'Janeiro'], [3,'Fevereiro'], [4,'Março'], [5,'Abril'], [6,'Maio'], [7,'Junho'], [8,'Julho'], [9,'Agosto'], [10,'Setembro'], [11,'Outubro'],[12,'Novembro'],[13,'Dezembro']]
    }
});
    $('#example-2').Tabledit({

        columns: {

          identifier: [0, 'id'],

          editable: [[1, 'First Name'], [2, 'Last Name']]

      }

  });
});
function add_row()
{
    var table = document.getElementById("example-1");
    var t1=(table.rows.length);
    var row = table.insertRow(t1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);

cell1.className='abc';
cell2.className='abc';

   $('<span class="tabledit-span" >Click Me To Edit</span><input class="tabledit-input form-control input-sm" type="text" name="First" value="undefined" disabled="">').appendTo(cell1);
     $('<span class="tabledit-span" >Click Me To Edit</span><input class="tabledit-input form-control input-sm" type="text" name="Last" value="undefined"  disabled="">').appendTo(cell2);
     $('<span class="tabledit-span" >@mdo</span><select class="tabledit-input form-control input-sm" name="Nickname"  disabled="" ><option value="1">@mdo</option><option value="2">@fat</option><option value="3">@twitter</option></select>').appendTo(cell3);

};

