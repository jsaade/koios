<?php 

namespace Acme\Validation;
use Illuminate\Validation\Validator as IlluminateValidator;
use Subscriber;

class ValidatorExtended extends IlluminateValidator 
{
	
    protected $validation_messages = array(
        //Question Validation
        "answers_required" => "The answers for this question are required.",
        "correct_answer_required" => "One answer should be set as correct.",
        "username_unique_per_app" => "The username is already taken.",
        "email_unique_per_app" => "The email is already taken.",
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
        $answers = get_keys_startingwith_as_subarray($this->input, 'answer_description');
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
        return isset($this->input['answer_is_correct']);
    }
 
    /**
     * Validates that the subscriber username is unique for this app
     * @param  [type] $attribute [description]
     * @param  [type] $value     [description]
     * @return [type]            [description]
     */
    protected function validateUsernameUniquePerApp($attribute, $value)
    {
        $app_id   = $this->input['application_id'];
        $username = $this->input['username'];

        $subscriber = Subscriber::whereUsername($username)->whereApplicationId($app_id)->first();
        if($subscriber)
            return false;

        return true;
    }

    /**
     * Validates that the subscriber email is unique for this app
     * @param  [type] $attribute [description]
     * @param  [type] $value     [description]
     * @return [type]            [description]
     */
    protected function validateEmailUniquePerApp($attribute, $value)
    {
        $app_id   = $this->input['application_id'];
        $email = $this->input['email'];

        $subscriber = Subscriber::whereEmail($email)->whereApplicationId($app_id)->first();
        if($subscriber)
            return false;

        return true;
    }
}

?>