// Sticky header saat scroll
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) {
    $('.main-header').addClass('sticky');
    // $('body').css('padding-top', $('.main-header').outerHeight() + 'px');
  } else {
    $('.main-header').removeClass('sticky');
    // $('body').css('padding-top', '0');
  }
});

$(document).ready(function(){
  // Toggle search form on mobile
  if ($(window).width() < 768) {
    $('#searchIconLink').on('click', function(e){
      e.preventDefault();
      $('.navbar-search-form-custom').toggleClass('hidden');
      // Fokus ke input jika ingin
      // if (!$('.navbar-search-form-custom').hasClass('hidden')) {
      //   $('.navbar-search-form-custom input[type="text"]').focus();
      // }
    });
  } else {
    // Di desktop, form selalu terlihat, sembunyikan ikon search
    $('#searchIconLink').hide();
    $('.navbar-search-form-custom').removeClass('hidden');
  }

  // Handle window resize to switch behavior
  $(window).on('resize', function(){
    if ($(window).width() < 768) {
      $('#searchIconLink').show();
      if (!$('.navbar-search-form-custom').hasClass('manually-toggled')) {
        $('.navbar-search-form-custom').addClass('hidden');
      }
    } else {
      $('#searchIconLink').hide();
      $('.navbar-search-form-custom').removeClass('hidden');
    }
  });
});

// Di script.js atau inline script
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) { // Angka 100 bisa disesuaikan
    $('.main-header').addClass('sticky');
    // Jika navbar punya tinggi tertentu, beri padding ke body agar konten tidak tertutup
    // $('body').css('padding-top', $('.main-header').outerHeight() + 'px');
  } else {
    $('.main-header').removeClass('sticky');
    // $('body').css('padding-top', '0');
  }
});
// Note: Untuk padding-top body, lebih baik ada placeholder element
// atau hitung tinggi navbar saat sticky ditambahkan.

@media (max-width: 767px) {
  .carousel-inner > .item > img {
    height: 200px; /* Lebih pendek di mobile */
  }
}