<?php
/**
 * Twitter Widget front-end module
 *
 * @category    Curry
 * @author      Sandeep Jain
 *
 */

class Project_Module_TwitterWidget extends Curry_Module {

    protected $title='';
    protected $twitter_id='';

    public function showFront(Curry_Twig_Template $template = null) {
        return $template->render(array(
            'Title' => $this->title,
            'TwitterId'	=> $this->twitter_id,
        ));
    }

    public function showBack() {
        $form = new Curry_Form_SubForm(array(
            'elements' => array(
                'title' => array('text', array(
                    'label' => 'Widget Title',
                    'required' => true,
                    'value' => $this->title,
                )),
                'twitter_id' => array('text', array(
                    'label' => 'Twitter Id @',
                    'required' => false,
                    'description' => 'Your twitter username without \'@\' mark',
                    'value' => $this->twitter_id,
                )),
            ),
        ));

        return $form;
    }

    public function saveBack(Zend_Form_SubForm $form) {
        $values = $form->getValues(true);
        $this->title = $values['title'];
        $this->twitter_id = $values['twitter_id'];
        $this->saveModule();
    }

} //endclass
