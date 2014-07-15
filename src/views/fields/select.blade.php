<div id="field-{{{ $field->name }}}" class="field {{{ $field->type }}}">
	{{ Form::rawLabel($field->id, $field->label.($field->is_required ? ' <em>*</em>' : '')) }}
	{{ Form::select($field->name, $field->options, $field->value, array('id' => $field->id, 'class' => (isset($field->classes) && $field->classes != '' ? ' '.$field->classes : '' ))) }}
</div>