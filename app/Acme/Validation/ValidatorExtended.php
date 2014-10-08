<?php 

namespace Acme\Validation;
use Illuminate\Validation\Validator as IlluminateValidator;

class ValidatorExtended extends IlluminateValidator 
{
	
    protected $validation_messages = array(
        //Question Validation
        "answers_required" => "The answers for this question are required.",
        "correct_answer_required" => "One answer should be set as correct."
    );
    protected $input = [];
 
    public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
        parent::__construct( $translator, $data, $rules, $messages, $customAttributes );
        $this->input = $data;
        $this->setCustomMessages($this->validation_messages);
    }
 
    /**
     * Validates when creating a question that all answers are set
     * @param  [type] $attribute [description]
     * @param  [type] $value     [description]
     * @return [type]            [description]
     */
    protected function validateAnswersRequired($attribute, $value)
    {
        $valid = true;
        $answers = $this->input['answer_desc'];
        foreach($answers as $answer)
            if(!trim($answer))
                $valid = false;

        return $valid;
    }

    /**
     * Validates when creating a question that one answer is set to correct
     * @param  [type] $attribute [description]
     * @param  [type] $value     [description]
     * @return [type]            [description]
     */
    protected function validateCorrectAnswerRequired($attribute, $value)
    {
        return isset($this->input['is_correct']);
    }
 
}

?>