<?php

use Illuminate\Support\Facades\Route;


/* * ************************ all routes for client panel are defined here   ******************** */

Route::get('client/bookings', 'BookingController@index')->name('client.bookings');


Route::get('client/mySpaces/{id}', 'Client\ClientSpacesController@spacesByClient');

Route::post('client/isActive','IndexController@isActiveurl');

//post call for space seating type
Route::post('client/updateSeatingTypes', 'Client\SpaceSeatingTypesController@updateSeatingTypes');

Route::post('client/updateMeetingRoom', 'Client\SpaceMeetingRoomsController@updateMeetingRoom');

///Space Payment Methods
//get call for space seating type
Route::get('client/spacePaymentMethods', 'Client\SpacePaymentMethodsController@spacePaymentMethods');
//post call for space seating type
Route::post('client/spacePaymentMethods', 'Client\SpacePaymentMethodsController@saveSpacePaymentMethod');

///Space Reviews Page
//get call for space reviews
Route::get('client/spaceReviews/page={pageCount}', 'Client\SpaceReviewsController@spaceReviews');

//send emails page 
// get call for sending multiple email to leads 
Route::get('client/sendEmail', 'Client\SendEmailsController@sendEmails')->name('sendEmail');
Route::post('client/sendEmailToLead', 'Client\SendEmailsController@sendEmailsToLeads')->middleware('redirectplanpage');
Route::get('client/pastEmail', 'Client\EmailsController@index')->name('client.pastEmail');
Route::get('client/email/{id?}', 'Client\EmailsController@emailDetails');



Route::get('previewInvoice', 'Client\SpaceSeatingTypesController@previewInvoice')->name('previewInvoice');
Route::get('client/inventory/{itemName?}/{category?}', 'Client\ClientSpacesController@inventoryManagment');
Route::post('saveInventoryItems','Client\ClientSpacesController@SaveInventoryItems');
Route::post('updateAutoReminder','Client\ClientSpacesController@updateAutoReminder');
Route::post('saveUpdatedInventory','Client\ClientSpacesController@saveUpdatedInventory');
Route::post('addInventory','Client\ClientSpacesController@addUserInventory');
Route::post('allocatedItemList','Client\ClientSpacesController@allocatedItemList');
Route::post('searchSpaceInventoryItems','Client\ClientSpacesController@searchSpaceInventoryItems');
Route::get('cronjobSample','Client\ClientSpacesController@CronjobSample');
Route::post('addInventoryStock','Client\ClientSpacesController@addInventoryStock');
Route::post('getInventoryStock','Client\ClientSpacesController@getInventoryStock');
Route::post('searchspaceinventorygraph','Client\SpaceRevenueReportsController@spaceRevenueReport');
