<div class="container">
	<div class="row app-frm app-top-30 bg-light border">
		
		<div class="col-md-6">
			<input type="text" id="taskName" placeholder="Nombre tarea" class="form-control app-obli">
		</div>

		<div class="col-md-4">
			<?php 
			if (is_array($data['categorias'])) {
				$categorias = '';
				foreach ($data['categorias'] as $k => $v) { 
					$categorias .= '
					<div class="form-check form-check-inline">
					 	<input class="form-check-input app-cat app-obli" type="checkbox" value="'. $v['id'] .'" >
					 	<label class="form-check-label" for="inlineCheckbox1">
					 		'. $v['nombre'] .'
					 	</label>
					</div>';
				}
				echo $categorias;
			}
			?>
			
		</div>

		<div class="col-md-2">
			<button class="btn btn-outline-dark btn-block" id="makeTask" data-action="newTask">
				<i class="far fa-paper-plane" aria-hidden="true"></i> Crear tarea
			</button>
		</div>

	</div>

	<!-- tasks table -->
	<div class="row app-frm app-top-30 bg-light border">

		<div class="col">
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					 <thead class="table-primary">
					 	<tr>
					 		<th>Task</th>
					 		<th>Category</th>
					 		<th>Delete</th>
					 	</tr>
					 </thead>
					 <tbody id="taskList">
					 	<?php 
					 	if (is_array($data['tareas'])) {

					 		$tareas = '';
					 		foreach($data['tareas'] as $k => $v){
					 			
					 			$tareas .= 
					 			'<tr id="task'.$v['id'].'">
					 				<td>'.$v['nombre'].'</td>
					 				<td>'.$v['cat_nom'].'</td>
					 				<td>
					 					<button class="btn btn-outline-danger btn-block app-action" data-action="delete" data-id="'.$v['id'].'">
					 						<i class="far fa-trash-alt" aria-hidden="true"></i> Delete
					 					</button>
					 				</td>
					 			</tr>';
					 		}
					 		echo $tareas;
					 	}
					 	?>
					 </tbody>
				</table>
			</div>
		</div>

	</div>
</div>


<!-- DELETE MODAL -->
<div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="deleteTaskModal" aria-hidden="true">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Delete task</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
	        	<p class="text-center">
                    <i class="fas fa-exclamation-triangle app-ico-big text-danger" aria-hidden="true"></i>
                </p>
                <p class="text-center">
                    Are you shure?                    
               	</p>
                <p>
                    <button class="btn btn-outline-danger btn-lg btn-block" data-id="" id="deleteTsk">
                        <i class="far fa-trash-alt" aria-hidden="true"></i> Delete  
                    </button>
                </p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">
	        	<i class="far fa-times-circle" aria-hidden="true"></i>
	        </button>
	      </div>
	    </div>
  	</div>
</div>