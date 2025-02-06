jQuery(document).ready(function($) {
    var $formSearch = $('.form-search');
    var $listResult = $('.list-result');
    var $inputSearch = $('.input-search');
    var $blockSpinner = $('.block-sppiner');
    var $btnSearch = $('.btn-search');
  
    $(document).on('click', function(event) {
      $formSearch.removeClass('active');
      $listResult.addClass('d-none');
    });
  
    $formSearch.on('click', function(event) {
      event.stopPropagation();
      $(this).addClass('active');
      var searchQuery = $inputSearch.val();
      if (searchQuery.length > 2 &&  $listResult.find('.search-item').length > 0) {
        $listResult.removeClass('d-none');
      }
    });
  
    var debounceTimeout;
    $inputSearch.on('keyup', function() {
      var searchQuery = $(this).val();
  
      clearTimeout(debounceTimeout);
  
      if (searchQuery.length > 2) {
        $blockSpinner.removeClass('d-none').addClass('d-flex');
        $btnSearch.addClass('d-none');
  
        debounceTimeout = setTimeout(function() {
          $.ajax({
            url: ajax_search.ajax_url,
            type: 'GET',
            data: {
              action: 'live_search',
              query: searchQuery
            },
            success: function(data) {
              $blockSpinner.addClass('d-none').removeClass('d-flex');
              $btnSearch.removeClass('d-none');
              $listResult.html(data).removeClass('d-none');
            }
          });
        }, 300);
      } else {
        $listResult.addClass('d-none');
      }
    });
  });