/*
Boots_table
 @description  Javascript library to make HMTL tables editable, using Bootstrap
 @version 1.0
 @autor Tito Hinostroza
 @updated 2017-08-15
*/
  "use strict";
    //variables globales
  var $tab_en_edic = null;  //table that is edited
  var params = null;  //parámetros
  var colsEdi =null;
  var newColHtml = '<div class="btn-group pull-right">'+
'<button id="bEdit" type="button" class="btn btn-sm btn-default" onclick="rowEdit(this);">' +
'<span class="glyphicon glyphicon-pencil" > </span>'+
'</button>'+
'<button id="bElim" type="button" class="btn btn-sm btn-default" onclick="rowElim(this);">' +
'<span class="glyphicon glyphicon-trash" > </span>'+
'</button>'+
'<button id="bAcep" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowAcep(this);">' + 
'<span class="glyphicon glyphicon-ok" > </span>'+
'</button>'+
'<button id="bCanc" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowCancel(this);">' + 
'<span class="glyphicon glyphicon-remove" > </span>'+
'</button>'+
    '</div>';
  var colEdicHtml = '<td name="buttons">'+newColHtml+'</td>'; 
    
  $.fn.SetEditable = function (options) {
    var defaults = {
        columnsEd: null,    //index td editable, if null all td editables Ex.: "1,2,3,4,5"
        $addButton: null,  //Jquery object of the Add button
        onEdit: function() {},   //edit event
        onDelete: function() {}, //elimination event
        onAdd: function() {}     //aggregation event
    };
    params = $.extend(defaults, options);
    this.find('thead tr').append('<th name="buttons"></th>');  //empty header
    this.find('tbody tr').append(colEdicHtml);
    $tab_en_edic = this;  //saves reference
    //Process parameter "addButton"
    if (params.$addButton != null) {
        //Parameter was provided
        params.$addButton.click(function() {
            rowAgreg();
        });
    }
    //Process parameter "columnsEd"
    if (params.columnsEd != null) {
        //Extracts fields
        colsEdi = params.columnsEd.split(',');
    }
  };
function IterarCamposEdit($cols, tarea) {
//Iterate for the editable fields of a row
    var n = 0;
    $cols.each(function() {
        n++;
        if ($(this).attr('name')=='buttons') return;  //excludes button column
        if (!EsEditable(n-1)) return;   //number of editable field
        tarea($(this));
    });
    
    function EsEditable(idx) {
    //Indicates if the last column is set to be editable
        if (colsEdi==null) {  //it was not defined
            return true;  //all are editable
        } else {  //there are fields filter
//alert('verifying: ' + idx);
            for (var i = 0; i < colsEdi.length; i++) {
              if (idx == colsEdi[i]) return true;
            }
            return false;  //no se encontró
        }
    }
}
function FijModoNormal(but) {
    $(but).parent().find('#bAcep').hide();
    $(but).parent().find('#bCanc').hide();
    $(but).parent().find('#bEdit').show();
    $(but).parent().find('#bElim').show();
    var $row = $(but).parents('tr');  //access the row
    $row.attr('id', '');  //remove mark
}
function FijModoEdit(but) {
    $(but).parent().find('#bAcep').show();
    $(but).parent().find('#bCanc').show();
    $(but).parent().find('#bEdit').hide();
    $(but).parent().find('#bElim').hide();
    var $row = $(but).parents('tr');  //access the row
    $row.attr('id', 'editing');  //indicates that it is in edition

}
function ModoEdicion($row) {
    if ($row.attr('id')=='editing') {
        return true;
    } else {    
        return false;
    }
}
function rowAcep(but) {
//Accept changes to the edition
    var $row = $(but).parents('tr');  //access the row
    var $cols = $row.find('td');  //read fields
    if (!ModoEdicion($row)) return;  //It is already in edition
    //It is in edition. The edition must be finalized
    IterarCamposEdit($cols, function($td) {  //iterate through the columns
      // var cont = $td.find('input').val(); //read input content
      var cont = $td.find('textarea').val(); //read textarea content
      $td.html(cont);  //fixes content and removes controls
    });
    FijModoNormal(but);
    params.onEdit($row);
}
function rowCancel(but) {
//Reject changes to the edition
    var $row = $(but).parents('tr');  //access the row
    var $cols = $row.find('td');  //read fields
    if (!ModoEdicion($row)) return;  //It is already in edition
    //It is in edition. The edition must be finalized
    IterarCamposEdit($cols, function($td) {  //iterate through the columns
        var cont = $td.find('div').html(); //read div content
        $td.html(cont);  //fixes content and removes controls
    });
    FijModoNormal(but);
}
function rowEdit(but) {  //Start editing a row
    var $row = $(but).parents('tr');  //access the row
    var $cols = $row.find('td');  //read fields
    if (ModoEdicion($row)) return;  //It is already in edition
    //Put in edit mode
    IterarCamposEdit($cols, function($td) {  //iterate through the columns
        var cont = $td.html(); //read content
        var div = '<div style="display: none;">' + cont + '</div>';  //save content
        // var input = '<input  class="form-control input-sm"  value="' + cont + '">';
        // var input = '<input  class="form-control custom-control input-sm"  value="' + cont + '">';
        var input = '<textarea  rows="3" class="form-control " >' + cont + '</textarea>';
        $td.html(div + input);  //ffija contenido
    });
    FijModoEdit(but);
}
function rowElim(but) {  //Delete the current row
    var $row = $(but).parents('tr');  //access the row
    $row.remove();
    params.onDelete();
}
function rowAgreg() {  //Add row to the table $tab_en_edic
    var $filas = $tab_en_edic.find('tbody tr');
    if ($filas.length==0) {
        //There are no rows of data. You have to create them complete
        var $row = $tab_en_edic.find('thead tr');  //header
        var $cols = $row.find('th');  //read fields
        //build html
        var htmlDat = '';
        $cols.each(function() {
            if ($(this).attr('name')=='buttons') {
                //It is column of buttons
                htmlDat = htmlDat + colEdicHtml;  //add buttons
            } else {
                htmlDat = htmlDat + '<td></td>';
            }
        });
        $tab_en_edic.find('tbody').append('<tr>'+htmlDat+'</tr>');
    } else {
        //There are other rows, we can clone the last row, to copy the buttons
        var $ultFila = $tab_en_edic.find('tr:last');
        $ultFila.clone().appendTo($ultFila.parent());  
        $ultFila = $tab_en_edic.find('tr:last');
        var $cols = $ultFila.find('td');  //lee campos
        $cols.each(function() {
            if ($(this).attr('name')=='buttons') {
                //It is column of buttons
            } else {
                $(this).html('');  //clean content
            }
        });
    }
}
function TableToCSV(separator) {  //Convert table to CSV
    
    var datFil = '';
    var tmp = '';
    $tab_en_edic.find('tbody tr').each(function() {
        //Finish the edition if it exists
        if (ModoEdicion($(this))) {
            $(this).find('#bAcep').click();  //accept edition
        }
        var $cols = $(this).find('td');  //read fields
        datFil = '';
        $cols.each(function() {
            if ($(this).attr('name')=='buttons') {
                //It is column of buttons
            } else {
                datFil = datFil + $(this).html() + separator;
            }
        });
        if (datFil!='') {
            datFil = datFil.substr(0, datFil.length-separator.length); 
        }
        tmp = tmp + datFil + '\n';
    });
    return tmp;
}
