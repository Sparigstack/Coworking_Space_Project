<?php


use Illuminate\Support\Facades\Route;



// route related to booking payments 
Route::get('book_now','Payment\SpaceBookingController@Initiate')->name('book_now');
Route::get('my_bookings','BookingController@myBookings')->name('my_booking');
Route::post('booking-complete','Payment\SpaceBookingController@Complete');
Route::get('booking-successful','BookingController@thankYou')->name('booking-successful');


Route::post('meeting_availability','BookingController@checkMeetingAvailability')->name('checkMeetingAvailability');


Route::post('saveSeatingDetails','Payment\SpaceBookingController@saveSeatingDetails')->name('saveSeatingDetails');
Route::post('save_meeting_details','BookingController@saveMeetingDetails')->name('saveMeetingDetails');


///My spaces page
//get call for my spaces
Route::get('about_us','IndexController@about_us');
Route::get('contact_us','IndexController@contact_us');


Route::post('sendInquiry','IndexController@sendInquiry')->name('sendInquiry');
Route::post('mapOneToOne/{token}','Client\SpaceDetailsController@SpaceOneToOneMapping');
Route::get('privacyPolicy','IndexController@privacyPolicy');
Route::get('terms','IndexController@terms');
Route::get('sitemap','IndexController@sitemap');

//get call for invoice 
Route::get('/', 'IndexController@index')->name('home');
Route::get('generateInvoice', function () {
    return view('mails.createInvoicepdf');
});

Route::get('downloadPDF/{id}','Client\SpaceSeatingTypesController@downloadinvoicePDF');
