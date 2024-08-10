@foreach($grupos as $linea)
      @if($linea->NOM_GRUPO_1 != null && trim($linea->NOM_GRUPO_1) != "")
   		<div class="row form-group">
   			<label class="control-label col-md-4">{{$linea->NOM_GRUPO_1}}*</label>
   			<div class="col-md-8">
   				<input type="text" name="VAL_GRUPO1" id="VAL_GRUPO1" class="form-control" 
   				value="{{($datos_modal[0]['val_grupo1'] != "") ? $datos_modal[0]['val_grupo1'] : ''}}"
   				/>
   			</div>
   			<div class="help_grupo1"></div>
   		</div>
   	@endif
   	@if($linea->NOM_GRUPO_2 != null && trim($linea->NOM_GRUPO_2) != "")
   		<div class="row form-group">
   			<label class="control-label col-md-4">{{$linea->NOM_GRUPO_2}}*</label>
   			<div class="col-md-8">
   				<input type="text" name="VAL_GRUPO2" id="VAL_GRUPO2" class="form-control"
   				value="{{($datos_modal[0]['val_grupo2'] != "") ? $datos_modal[0]['val_grupo2'] : ''}}"/>
   			</div>
   			<div class="help_grupo2"></div>
   		</div>
   	@endif
   	@if($linea->NOM_GRUPO_3 != null && trim($linea->NOM_GRUPO_3) != "")
   		<div class="row form-group">
   			<label class="control-label col-md-4">{{$linea->NOM_GRUPO_3}}*</label>
   			<div class="col-md-8">
   				<input type="text" name="VAL_GRUPO3" id="VAL_GRUPO3" class="form-control"
   				value="{{($datos_modal[0]['val_grupo3'] != "") ? $datos_modal[0]['val_grupo3'] : ''}}"/>
   			</div>
   			<div class="help_grupo3"></div>
   		</div>
   	@endif
   	@if($linea->NOM_GRUPO_4 != null && trim($linea->NOM_GRUPO_4) != "")
   		<div class="row form-group">
   			<label class="control-label col-md-4">{{$linea->NOM_GRUPO_4}}*</label>
   			<div class="col-md-8">
   				<input type="text" name="VAL_GRUPO4" id="VAL_GRUPO4" class="form-control"
   				value="{{($datos_modal[0]['val_grupo4'] != "") ? $datos_modal[0]['val_grupo4'] : ''}}"/>
   			</div>
   			<div class="help_grupo4"></div>
   		</div>
   	@endif
   	@if($linea->NOM_GRUPO_5 != null && trim($linea->NOM_GRUPO_5) != "")
   		<div class="row form-group">
   			<label class="control-label col-md-4">{{$linea->NOM_GRUPO_5}}*</label>
   			<div class="col-md-8">
   				<input type="text" name="VAL_GRUPO5" id="VAL_GRUPO5" class="form-control"
   				value="{{($datos_modal[0]['val_grupo5'] != "") ? $datos_modal[0]['val_grupo5'] : ''}}"/>
   			</div>
   			<div class="help_grupo5"></div>
   		</div>
   	@endif
@endforeach