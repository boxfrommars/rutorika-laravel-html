<?php

require_once __DIR__ . '/Base.php';

class FormTest extends Base
{
    public function testForm()
    {
        $html = Form::open(['url' => '/formurl']);
        $html .= Form::close();
        $this->assertContains('/formurl', $html);
        $this->assertContains('<form method="POST"', $html);
        $this->assertContains('name="_token"', $html);
        $this->assertContains('</form>', $html);
    }
}
