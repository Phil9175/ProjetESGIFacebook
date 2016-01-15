$(document).ready(function(){        
	$('li img').on('click',function(){
		var src = $(this).attr('src');
		var img = '<img src="' + src + '" class="img-responsive" style="height: 500px; width: 100%;"/>';
		var nom = $(this).parent().data('id');
		
		//start of new code new code
		var index = $(this).parent('li').index();   
		
		var html = '';
		html += img;                
		html += '<div style="height:50px;clear:both;display:block;">';
		if(nom == "")
		{
			html += '<div id="nom" align="center"><strong>Votre photo</strong></div><br>';
		}
		else // on a cliqué sur la gallery ou il y'a toutes les photos des participants
		{
			html += '<a class="controls next" href="'+ (index+2) + '">suivant &raquo;</a>';
			html += '<a class="controls previous" href="' + (index) + '">&laquo; prec</a>';
			html += '<div id="nom" align="center"></div><br>';
		}
		

		html += '<div class="fb-like" data-href="'+src+'" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false">';
		html += '</div>';
		
		$('#myModal').modal();
		$('#myModal').on('shown.bs.modal', function(){
			$('#myModal .modal-body').html(html);
			//new code
			$('a.controls').trigger('click');
		})
		$('#myModal').on('hidden.bs.modal', function(){
			$('#myModal .modal-body').html('');
		});
		
   });
	$("body").delegate(".redirectToPhoto", "click",  function(e) {
		$("#myModal").modal('hide');
	});
	
})
  
$(document).on('click', 'a.controls', function(){
	var index = $(this).attr('href');
	var src = $('ul.row li:nth-child('+ index +') img').attr('src');             
	
	var nom = $('ul.row li:nth-child('+ index +')').data('id');
	
	$("#nom").html('<div align="center"><a class="redirectToPhoto" href="#ancreNom-'+ nom +'">'+ nom +'</a> </div>');

	$('.modal-body img').attr('src', src);
	
	var newPrevIndex = parseInt(index) - 1; 
	var newNextIndex = parseInt(newPrevIndex) + 2; 
	
	if($(this).hasClass('previous')){               
		$(this).attr('href', newPrevIndex); 
		$('a.next').attr('href', newNextIndex);
	}else{
		$(this).attr('href', newNextIndex); 
		$('a.previous').attr('href', newPrevIndex);
	}
	
	var total = $('ul.row li').length + 1; 
	//hide next button
	if(total === newNextIndex){
		$('a.next').hide();
	}else{
		$('a.next').show()
	}            
	//hide previous button
	if(newPrevIndex === 0){
		$('a.previous').hide();
	}else{
		$('a.previous').show()
	}
	
	
	return false;
});