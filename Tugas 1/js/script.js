
$(function(){
  $('#year').text(new Date().getFullYear());
  // search simulation
  $('#searchForm').on('submit', function(e){
    e.preventDefault();
    var from = $('#from').val().trim(), to = $('#to').val().trim();
    if(!from||!to){ $('#searchResult').text('Masukkan kota asal dan tujuan.').show(); return; }
    $('#searchResult').text('Ditemukan beberapa jadwal dari '+from+' ke '+to+'.').show();
  });
  // contact form submit via AJAX when served via HTTP
  $('#contactForm').on('submit', function(e){
    var action = $(this).attr('action');
    if(location.protocol.startsWith('file')){
      e.preventDefault();
      $('#formMsg').removeClass().addClass('form-msg success').text('Form terkirim (simulasi). Untuk kirim nyata jalankan server PHP.').show();
      return;
    }
    e.preventDefault();
    $.post(action, $(this).serialize()).done(function(data){ $('#formMsg').removeClass().addClass('form-msg success').html(data).show(); $('#contactForm')[0].reset(); }).fail(function(){ $('#formMsg').removeClass().addClass('form-msg error').text('Gagal mengirim. Pastikan server PHP berjalan.').show(); });
  });
});
