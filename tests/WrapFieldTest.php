<?php

require_once __DIR__ . '/Base.php';

class WrapFieldTest extends Base
{
    /**
     * @dataProvider getFieldProvider
     *
     * @param $fieldName
     * @param $fieldTitle
     * @param $fieldValue
     * @param array  $options
     * @param string $helpText
     */
    public function testTextField($fieldName, $fieldTitle, $fieldValue = null, $options = [], $helpText = '')
    {
        Form::open(['url' => '/formurl']);
        $field = Form::textField($fieldTitle, $fieldName, $fieldValue, $options, $helpText);
        Form::close();

        $control = Form::text($fieldName, $fieldValue, $this->appendClassToOptions('form-control', $options));
        $this->assertEquals(Form::field($fieldTitle, $fieldName, $control, $helpText), $field);
    }

    /**
     * @dataProvider getFieldProvider
     *
     * @param $fieldName
     * @param $fieldTitle
     * @param $fieldValue
     * @param array  $options
     * @param string $helpText
     */
    public function testTextareaField($fieldName, $fieldTitle, $fieldValue = null, $options = [], $helpText = '')
    {
        Form::open(['url' => '/formurl']);
        $field = Form::textareaField($fieldTitle, $fieldName, $fieldValue, $options, $helpText);
        Form::close();

        $control = Form::textarea($fieldName, $fieldValue, $this->appendClassToOptions('form-control', $options));
        $this->assertEquals(Form::field($fieldTitle, $fieldName, $control, $helpText), $field);
    }

    public function testWrap()
    {
        Form::open(['url' => '/formurl']);
        $field = Form::field('Field Title', 'textfield', 'control', 'help text');
        Form::close();

        $this->assertContains('<label for="textfield" class="col-md-3 control-label">Field Title</label>', $field);
        $this->assertContains('<p class="help-block">help text</p>', $field);
        $this->assertContains('control', $field);
    }

    /**
     * @return array
     */
    public function getFieldProvider()
    {
        return [
            ['fieldname', 'field title', 'value', ['class' => 'some-class', 'data-wapa' => 'chchch', 'Help!']],
            ['fieldname', 'field title'],
        ];
    }

    protected function setDefaultOptions($options)
    {
        return $this->appendClassToOptions('form-control', $options);
    }

    protected function appendClassToOptions($class, array $options = [])
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' ' : '';
        $options['class'] .= $class;

        return $options;
    }
}
