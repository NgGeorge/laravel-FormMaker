<div id="field-{{{ $field->name }}}" class="field {{{ $field->type }}}">
	{{ Form::checkbox($field->name, 1, (is_array($field->value) && in_array(1, $field->value) ? true : false), array('id' => $field->id, 'class' => (isset($field->classes) && $field->classes != '' ? ' '.$field->classes : '' ))) }}
	{{ Form::rawLabel($field->id, $field->label.($field->is_required ? ' <em>*</em>' : '')) }}
</div>