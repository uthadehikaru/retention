<?php

test('test homepage', function()
{
    $response = $this->get('/');
    $response->assertRedirect('agent');
});