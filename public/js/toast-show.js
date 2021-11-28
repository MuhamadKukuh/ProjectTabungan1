$('#ya').on('click',function(e){
	  e.preventDefault()
	  $('#liveToast').toast('show');
	  $('#main')[0].reset()
	})