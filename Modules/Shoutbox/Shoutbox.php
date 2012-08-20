/**
 * Front-end module for building shoutbox
 *
 * @category    Curry
 * @author      Sandeep Jain
 *
 */

<?php
class Project_Module_Shoutbox extends Curry_Module {

    protected $title = '';

    protected $messages = array();

    public function showFront(Curry_Twig_Template $template=null){

        $messages = Curry_Array::objectsToArray($this->messages, null);

        return $template->render(array(
            'Messages'=> $messages,
            'Title' => $this->title,
        ));
    }

    public function showBack(){
        $messageForm = new Curry_Form_Dynamic(array(
        'legend' => 'Entry',
            'elements' => array(
                'title' => array('text',array(
                    'label' => 'Title',
                    'required' => true,
                )),
                'text' => array('tinyMCE',array(
                    'label' => 'Text',
                    'required' => true,
                )),
            )
        ));

        $form = new Curry_Form_SubForm(array(
            'elements' => array(
                'title' => array('text', array(
                    'label' => 'Shoutbox Title',
                    'required' => true,
                    'value' => $this->title,
                )),
            ),
        ));


        $form->addSubForm(new Curry_Form_MultiForm(array(
            'legend' => 'Shoutbox Messages',
            'cloneTarget' => $messageForm,
            'defaults' => $this->messages
        )), 'messages');

        return $form;
    }


    public function saveBack(Zend_Form_SubForm $form) {
        $values = $form->getValues(true);
        $this->messages = $values['messages'];
        $this->title = $values['title'];
        $this->saveModule();
    }
}
