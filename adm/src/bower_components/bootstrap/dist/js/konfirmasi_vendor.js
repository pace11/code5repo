$(document).ready(function(){
    
$('#vendor_hapus').on('show.bs.modal', function (event) {
var div = $(event.relatedTarget)
var id = div.data('id')
var modal = $(this)

modal.find('#hapus-vendor').attr("href","?tampil=vendor_hapus&id="+id);
})}
);