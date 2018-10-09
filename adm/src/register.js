//------------------------- Hapus KATEGORI ------------------------------
$(document).ready(function(){

$('#registerlist_hapus').on('show.bs.modal', function (event) {
var div = $(event.relatedTarget)
var id = div.data('id')
var modal = $(this)

modal.find('#hapus-registerlist').attr("href","?tampil=registerlist_hapus&id="+id);
})}
);                                                                                                                                                                                                                                                             