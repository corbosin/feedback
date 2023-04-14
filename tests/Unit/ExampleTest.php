<?php

use Tests\TestCase;

class FeedbackControllerTest extends TestCase
{
    public function test_send_feedback_returns_expected_result()
    {
        $data = [
            'name' => 'YA',
            'email' => 'ya@example.com',
            'theme' => 'theme',
            'message' => 'message',
            'attach' => null,
        ];

        $request = new \Illuminate\Http\Request($data);

        $feedbackController = new FeedbackController();
        $response = $feedbackController->send($request);

        $this->assertEquals($response->getStatusCode(), 302);
        $this->assertEquals($response->getSession()->get('status'), 'Ваше сообщение отправлено!');
    }
}