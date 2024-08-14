<?php

namespace App\Class;

class State
{
    public const STATE = [
        '3' => [
            'label' => 'In preparation',
            'email_subject' => 'Order in preparation',
            'email_template' => 'order_state_3.html',
        ],
        '4' => [
            'label' => 'Shipped',
            'email_subject' => 'Order shipped',
            'email_template' => 'order_state_4.html',
        ],
        '5' => [
            'label' => 'Canceled',
            'email_subject' => 'Order canceled',
            'email_template' => 'order_state_5.html',
        ],
    ];
}