/*
* App object, stores Util functions
*/
var oliApp = {
	emptyErrorCheck : function(){
		let error = false;
		$('.app-obli').each(function(){
			if ($(this).val() == '') {
				$(this).addClass('is-invalid');
				error = true;
			}else{
				$(this).removeClass('is-invalid');
			}
		});


		return error === true ? true : false;
	},
	emptyCheckboxError : function(checkBoxClass){
		let data = this.getCheckboxVal(checkBoxClass);
		if(data == ''){
			$(checkBoxClass).parent().addClass('bg-danger');
			return false;
		}else{
			$(checkBoxClass).parent().removeClass('bg-danger');
		}

		return true;
	},
	getCheckboxVal : function(checkBoxClass){
		let data = '';
		$(checkBoxClass).each(function(){
			//get checked values
			if($(this).prop('checked') ){
				data += $(this).val() + ',';
			}
		});

		return data;
	},
	alertMessage : function(alertType, shortMessage){
		let alertMsg = '<div class="alert '+ alertType +' alert-dismissible fade show app-alert-msg" role="alert">'+
						shortMessage +
  						'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
							'<span aria-hidden="true">&times;</span>'+
						'</button>'
						'</div>';

		$('body').append(alertMsg);

		//remove all alerts after x seconds
		setTimeout(function(){$('.app-alert-msg').remove();},5000);
	},
	loader : function(){
		let loader = '<div class="app-loader"><img src="assets/img/loader.gif"></div>';
		$('body').append(loader);
	},
	loaderRemove : function(){
		$('.app-loader').remove();
	},
	newTaskData : function(){
		let data = [];
		data[0] = $('#taskName').val();
		data[1] = this.getCheckboxVal('.app-cat');
	
		return data;
	},
	insertNewTask : function(data){
		try{
			let json = JSON.parse(data)
			let tableRow = '<tr>'+
				'<td>'+json[0].nombre+'</td>'+
				'<td>'+json[0].cat_nom+'</td>'+
				'<td>'+ 
					'<button class="btn btn-outline-danger btn-block app-action" data-action="delete" data-id="'+json[0].id+'">'+
 						'<i class="far fa-trash-alt" aria-hidden="true"></i> Delete'+
 					'</button>'+
				'</td>'+
			'</tr>';
			$('#taskList').prepend(tableRow);
		}catch(e){
			this.alertMessage('alert-danger','Error inserting last task, please refresh.');
		}
	}
}
/*
* Register click event on make task event
*/
if($('#makeTask').length){
	$('#makeTask').on('click', function(){

		//check empty fields errors
		let error = oliApp.emptyErrorCheck();
		let emptyCheck = oliApp.emptyCheckboxError('.app-cat');

		//stop script on empty fields
		if(error){return false;}
		if(emptyCheck == false){return false;}

		//get tasks category
		let category = oliApp.getCheckboxVal('.app-cat');

		//send data to server
		let data =  JSON.stringify(oliApp.newTaskData());
		let action = $('#makeTask').attr('data-action');
		oliApp.loader();
		$.post('makeTask.php',{action:action, data:data}).done(function(data){
			if(data != 1){
				oliApp.alertMessage('alert-success', 'Task stored ;)');
				oliApp.insertNewTask(data);
			}else{
				oliApp.alertMessage('alert-danger', 'Task was not stored ');
			}
		}).fail(function(){
			oliApp.alertMessage('alert-danger', 'Task was not stored ');
		})
		oliApp.loaderRemove();
	});
}

/*
* register click on delete button
*/
if($('.app-action').length){
	$('.app-action').each(function(){
		$(this).on('click', function(){
			let id = $(this).attr('data-id');
			$('#deleteTsk').attr('data-id', id);
			$('#deleteTaskModal').modal('show');
		});
	});
}

/*
* delete task
*/
if($('#deleteTsk').length){
	$('#deleteTsk').on('click', function(){
		let id = $('#deleteTsk').attr('data-id');
		let action = 'deleteTask';

		oliApp.loader();
		$.post('deleteTask.php',{action:action, id:id}).done(function(data){
			$('#deleteTaskModal').modal('hide');
			if(data == 1){
				oliApp.alertMessage('alert-success', 'Task deleted ;)');
				$('#task' + id).remove();
			}else{
				oliApp.alertMessage('alert-danger', 'Task was not deleted ');
			}
		}).fail(function(){
			oliApp.alertMessage('alert-danger', 'Task was not deleted ');
		})
		oliApp.loaderRemove();
	});
}

