  'use strict';
$(document).ready(function () {
//Basic alert
	document.querySelector('.sweet-1').onclick = function(){
		swal("Here's a message!", "It's pretty, isn't it?");
	};
	//success message
	document.querySelector('.alert-success-msg').onclick = function(){
		swal("Good job!", "You clicked the button!", "success");
	};

	//Alert confirm
	document.querySelector('.alert-confirm').onclick = function(){
		swal({
					title: "Are you sure?",
					text: "Your will not be able to recover this imaginary file!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false
				},
				function(){
					swal("Deleted!", "Your imaginary file has been deleted.", "success");
				});
	};

	//Success or cancel alert
	document.querySelector('.alert-success-cancel').onclick = function(){
		swal({
					title: "Excluir esse registro?",
					text: "Se você excluir esse registro não será possível recupera-lo! Tem certeza que deseja excluir?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, desejo excluir!",
					cancelButtonText: "No, cancel exclusão!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm) {
					if (isConfirm) {
                                            /*
                                                var x=  excluir_registro($(this).data('url'));
                                                if(x==true){
                                                    swal("Excluido!", "Your imaginary file has been deleted.", "success");                                                    
                                                }else{
                                                    swal("Problema", "Não foi possível excluir esse registro", "error");                                                    
                                                }
                                                */
					} else {
						swal("Cancelado!", "Exclusão cancelada.", "error");
					}
				});
	};
	//prompt alert
	document.querySelector('.alert-prompt').onclick = function(){
		swal({
			title: "An input!",
			text: "Write something interesting:",
			type: "input",
			showCancelButton: true,
			closeOnConfirm: false,
			inputPlaceholder: "Write something"
		}, function (inputValue) {
			if (inputValue === false) return false;
			if (inputValue === "") {
				swal.showInputError("You need to write something!");
				return false
			}
			swal("Nice!", "You wrote: " + inputValue, "success");
		});
	};

	//Ajax alert
	document.querySelector('.alert-ajax').onclick = function(){
		swal({
			title: "Ajax request example",
			text: "Submit to run ajax request",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true
		}, function () {
			setTimeout(function () {
				swal("Ajax request finished!");
			}, 2000);
		});
	};


		$('#openBtn').on('click',function () {
			$('#myModal').modal({
				show: true
			})
		});

		$(document).on('show.bs.modal', '.modal', function (event) {
			var zIndex = 1040 + (10 * $('.modal:visible').length);
			$(this).css('z-index', zIndex);
			setTimeout(function() {
				$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
			}, 0);
		});
	});
  