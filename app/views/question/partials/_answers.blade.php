
@for ($i = 0; $i < 4; $i++)
	 @if (isset($question->answers) && count($question->answers))
	 	{{--*/ $answerTextfieldName = 'answer.description.'.$question->answers[$i]->id /*--}}
	 @else
	 	{{--*/ $answerTextfieldName = 'answer.description.'.$i /*--}}
	 @endif

    <tr>
	    <td>
	    	{{ Form::radio(
	    		'answer.is_correct', 
	    		$i, 
	    		(isset($question->answers) && count($question->answers))?$question->answers[$i]->is_correct:null
	    	)}} 
	    </td>
		<td>
			{{ Form::Text(
				$answerTextfieldName,
				(isset($question->answers) && count($question->answers))? $question->answers[$i]->description:null, 
				[ 'class' => 'form-control', 'placeholder' => 'Enter answer value'] 
			)}} 
		</td>
	</tr>
@endfor