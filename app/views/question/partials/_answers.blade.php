
@if( !isset($answers))
	@for ($i = 0; $i < 4; $i++)
	    <tr>
		    <td>
		    	{{ Form::radio('is_correct[]', $i, null) }} 
		    </td>
			<td>
				{{ Form::TextGroup("answer_desc", null, [ 'class' => 'form-control', 'placeholder' => 'Enter answer value'] ) }} 
			</td>
		</tr>
	@endfor
@else
	@foreach($answers as $answer)
		<tr>
		    <td>
		    	{{ Form::radio('is_correct[]', $answer->id, $answer->is_correct) }} 
		    </td>
			<td>
				{{ Form::TextGroup("answer_desc", $answer->description, [ 'class' => 'form-control', 'placeholder' => 'Enter answer value'] ) }} 
			</td>
		</tr>
	@endforeach
@endif