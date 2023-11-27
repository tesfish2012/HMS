<?php  
$router->group(['prefix' => 'hms/apis/v1'], function () use ($router) {
    
    $router->group(['prefix' => 'rooms'], function () use ($router) { //Duplicate this uri for other nanoservices.
        $router->get('', ['uses' => 'RoomController@index']);
        $router->get('all', ['uses' => 'RoomController@all']);
        $router->get('{id}', ['uses' => 'RoomController@show']);
        $router->get('where/{attribute}/{value}', ['uses' => 'RoomController@query']);

        $router->post('', ['uses' => 'RoomController@store']);
        $router->put('{id}', ['uses' => 'RoomController@update']);
        $router->put('{id}/toggle-status', ['uses' => 'RoomController@toggleStatus']);

        $router->delete('empty-trash', ['uses' => 'RoomController@emptyTrash']);
        $router->delete('{id}', ['uses' => 'RoomController@trash']);
        $router->delete('{id}/restore', ['uses' => 'RoomController@restore']);
        $router->delete('{id}/delete', ['uses' => 'RoomController@delete']);
    });
});





$router->group(['prefix' => 'hms/apis/v1/'], function () use ($router) {
    
    $router->group(['prefix' => 'testimonial'], function () use ($router) { //Duplicate this uri for other nanoservices.
        $router->get('', ['uses' => 'TestimonialController@index']);
        $router->get('all', ['uses' => 'TestimonialController@all']);
        $router->get('{id}', ['uses' => 'TestimonialController@show']);
        $router->get('where/{attribute}/{value}', ['uses' => 'TestimonialController@query']);

        $router->post('', ['uses' => 'TestimonialController@store']);
        $router->put('{id}', ['uses' => 'TestimonialController@update']);
        $router->put('{id}/toggle-status', ['uses' => 'TestimonialController@toggleStatus']);

        $router->delete('empty-trash', ['uses' => 'TestimonialController@emptyTrash']);
        $router->delete('{id}', ['uses' => 'TestimonialController@trash']);
        $router->delete('{id}/restore', ['uses' => 'TestimonialController@restore']);
        $router->delete('{id}/delete', ['uses' => 'TestimonialController@delete']);
        

    });
});


//booking   Apis
$router->group(['prefix' => 'hms/apis/v1/'], function () use ($router) {
    
    $router->group(['prefix' => 'booking'], function () use ($router) { //Duplicate this uri for other nanoservices.
        $router->get('', ['uses' => 'BookingController@index']);
        $router->get('all', ['uses' => 'BookingController@all']);
        $router->get('{id}', ['uses' => 'BookingController@show']);
        $router->get('where/{att}/{val}', ['uses' => 'BookingController@query']);

        $router->post('', ['uses' => 'BookingController@store']);
        $router->put('cancel/{id}', ['uses' => 'BookingController@cancelBooking']);
        $router->put('{id}', ['uses' => 'BookingController@update']);
        $router->put('{id}/toggle-status', ['uses' => 'BookingController@toggleStatus']);

        $router->delete('empty-trash', ['uses' => 'BookingController@emptyTrash']);
        $router->delete('{id}', ['uses' => 'BookingController@trash']);
        $router->delete('{id}/restore', ['uses' => 'BookingController@restore']);
        $router->delete('{id}/delete', ['uses' => 'BookingController@delete']);
        
    });
});


//service subscription   Apis
$router->group(['prefix' => 'hms/apis/v1/'], function () use ($router) { 
    $router->group(['prefix' => 'service_subscription'], function () use ($router) { //Duplicate this uri for other nanoservices.
        $router->get('', ['uses' => 'ServiceSubscriptionController@index']);
        $router->get('all', ['uses' => 'ServiceSubscriptionController@all']);
        $router->get('{id}', ['uses' => 'ServiceSubscriptionController@show']);
        $router->get('where/{att}/{val}', ['uses' => 'ServiceSubscriptionController@query']);

        $router->post('', ['uses' => 'ServiceSubscriptionController@store']);
        $router->put('{id}', ['uses' => 'ServiceSubscriptionController@update']);
        $router->put('{id}/toggle-status', ['uses' => 'ServiceSubscriptionController@toggleStatus']);

        $router->delete('empty-trash', ['uses' => 'ServiceSubscriptionController@emptyTrash']);
        $router->delete('{id}', ['uses' => 'ServiceSubscriptionController@trash']);
        $router->delete('{id}/restore', ['uses' => 'ServiceSubscriptionController@restore']);
        $router->delete('{id}/delete', ['uses' => 'ServiceSubscriptionController@delete']);
        
    });


        //apis for payment reception and payment
    $router->group(['prefix' => 'payment_receipt'], function () use ($router) { //Duplicate this uri for other nanoservices.
        $router->get('', ['uses' => 'PaymentReceiptController@index']);
        $router->get('all', ['uses' => 'PaymentReceiptController@all']);
        $router->get('{id}', ['uses' => 'PaymentReceiptController@show']);
        $router->get('where/{att}/{val}', ['uses' => 'PaymentReceiptController@query']);

        $router->post('', ['uses' => 'PaymentReceiptController@store']);
        $router->put('{id}', ['uses' => 'PaymentReceiptController@update']);
        $router->put('{id}/toggle-status', ['uses' => 'PaymentReceiptController@toggleStatus']);

        $router->delete('empty-trash', ['uses' => 'PaymentReceiptController@emptyTrash']);
        $router->delete('{id}', ['uses' => 'PaymentReceiptController@trash']);
        $router->delete('{id}/restore', ['uses' => 'PaymentReceiptController@restore']);
        $router->delete('{id}/delete', ['uses' => 'PaymentReceiptController@delete']);
        
    });
});