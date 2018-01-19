// membertree.php

function chooseCode(id)
{
	$('#membertree-choose-code').modal('toggle');
	$('#toreg-direct-upline').data('upline', id);
}

function makeMemberlink(data)
{
  $.ajax({
    url:data,
    type: 'POST',
    before:function(){
      $('.membertree .genealogy-content').html('<img class="loader" src=\'<?= asset("assets/imgs/loading-img.gif") ?>\' alt="Loading" />');
    },
    success:function(result){
      $('.membertree .genealogy-content').html(result);
    }
  });
}

function makeUnilevellink(data)
{
  $.ajax({
    url:data,
    type: 'POST',
    before:function(){
      $('.membertree .genealogy-content').html('<img class="loader" src=\'<?= asset("assets/imgs/loading-img.gif") ?>\' alt="Loading" />');
    },
    success:function(result){
      $('.membertree .genealogy-content').html(result);
    }
  });
}

// su- settings.php
function getUpdatesettingsmodal(group,name,value)
{
  var set_name = $('#su-' + group + '-settings input[name="name"]').val(name);
  var set_new_name = $('#su-' + group + '-settings input[name="new_name"]').val(name);
  var set_value = $('#su-' + group + '-settings input[name="value"]').val(value);

  $('#su-' + group + '-settings').modal('toggle');
} 


// ========================================================== //

// CHOSEN
$(document).ready(function () {
	$(".chosen-select").chosen();
});

// GENERAL STUFF =====================================

$(document).ready(function () {
	$('#reload-page').click(function () {
		location.reload(true); 
	});
});