<div class="form-group">
	{!! Form::label('name', 'Nombre'); !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('slug', 'URL amigable'); !!}
	{!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('name', 'Descripción'); !!}
	{!! Form::textarea('description', null, ['class' => 'form-control', 'rows'=>'3', 'cols'=>'5']) !!}
</div>
<hr>

<div class="form-group">
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i>
	GUARDAR
	</button>
</div>